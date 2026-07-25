<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProformaRequest;
use App\Models\Proforma;
use App\Models\QuoteRequest;
use App\Mail\ProformaSent;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\SvgWriter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class ProformaController extends Controller
{
    public function create(QuoteRequest $quoteRequest): View
    {
        if ($quoteRequest->proforma) {
            return redirect()->route('admin.proformas.show', $quoteRequest->proforma);
        }
        $quoteRequest->load('items');
        return view('admin.proformas.create', ['quote' => $quoteRequest]);
    }

    public function store(StoreProformaRequest $request, QuoteRequest $quoteRequest): RedirectResponse
    {
        if ($quoteRequest->proforma) {
            return redirect()->route('admin.proformas.show', $quoteRequest->proforma);
        }

        $data = $request->validated();
        $vatRate = (float) config('app.vat_rate', env('APP_VAT_RATE', 15));

        $subtotal = 0;
        $itemPayload = [];
        foreach ($data['items'] as $itemInput) {
            $quoteItem = $quoteRequest->items()->find($itemInput['quote_item_id']);
            if (! $quoteItem) {
                continue;
            }
            $unitPrice = (float) $itemInput['unit_price'];
            $lineTotal = $unitPrice * $quoteItem->quantity;
            $subtotal += $lineTotal;
            $itemPayload[] = [
                'product_id' => $quoteItem->product_id,
                'product_name' => $quoteItem->product_name,
                'unit_of_measure' => $quoteItem->unit_of_measure,
                'quantity' => $quoteItem->quantity,
                'unit_price' => $unitPrice,
                'total_price' => $lineTotal,
            ];
        }

        $vat = round($subtotal * ($vatRate / 100), 2);
        $total = round($subtotal + $vat, 2);

        $proforma = Proforma::create([
            'quote_request_id' => $quoteRequest->id,
            'proforma_number' => Proforma::generateNextNumber(),
            'issue_date' => now()->toDateString(),
            'validity_date' => now()->addDays(30)->toDateString(),
            'payment_terms' => $data['payment_terms'],
            'delivery_time' => $data['delivery_time'],
            'bank_details' => $data['bank_details'],
            'notes' => $data['notes'] ?? null,
            'subtotal' => $subtotal,
            'vat' => $vat,
            'total' => $total,
        ]);

        foreach ($itemPayload as $row) {
            $proforma->items()->create($row);
        }

        $quoteRequest->update(['status' => 'processed']);

        $pdf = $this->generatePdf($proforma->fresh('items'));

        if ($request->boolean('send_email')) {
            Mail::to($quoteRequest->email)->send(new ProformaSent($quoteRequest, $proforma, $pdf->output()));
        }

        return redirect()->route('admin.proformas.show', $proforma)
            ->with('status', 'Proforma ' . $proforma->proforma_number . ' generated successfully.');
    }

    public function show(Proforma $proforma): View
    {
        $proforma->load(['items', 'quoteRequest']);
        return view('admin.proformas.show', ['proforma' => $proforma]);
    }

    public function download(Proforma $proforma)
    {
        $pdf = $this->generatePdf($proforma->load('items'));
        return $pdf->download($proforma->proforma_number . '.pdf');
    }

    public function stream(Proforma $proforma)
    {
        $pdf = $this->generatePdf($proforma->load('items'));
        return $pdf->stream($proforma->proforma_number . '.pdf');
    }

    public function verify(Proforma $proforma)
    {
        return $this->generatePdf($proforma->load('items'))
            ->stream($proforma->proforma_number . '.pdf');
    }

    protected function generatePdf(Proforma $proforma): \Barryvdh\DomPDF\PDF
    {
        $proforma->load(['items', 'quoteRequest']);
        $verificationUrl = URL::signedRoute('proformas.verify', [
            'proforma' => $proforma->proforma_number,
        ]);
        $verificationQr = Builder::create()
            ->writer(new SvgWriter)
            ->data($verificationUrl)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
            ->size(180)
            ->margin(8)
            ->build();

        $pdf = Pdf::loadView('pdf.proforma', [
            'proforma' => $proforma,
            'currency' => config('app.currency', 'ETB'),
            'currency_symbol' => config('app.currency_symbol', 'Br'),
            'app_name' => config('app.name', 'Cooper Trading'),
            'verification_url' => $verificationUrl,
            'verification_qr' => $verificationQr->getDataUri(),
        ]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf;
    }
}
