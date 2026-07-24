<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proforma extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_request_id',
        'proforma_number',
        'issue_date',
        'validity_date',
        'payment_terms',
        'delivery_time',
        'bank_details',
        'notes',
        'subtotal',
        'vat',
        'total',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'validity_date' => 'date',
        'subtotal' => 'decimal:2',
        'vat' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function quoteRequest(): BelongsTo
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ProformaItem::class);
    }

    public static function generateNextNumber(): string
    {
        $latest = static::orderByDesc('id')->first();
        $next = $latest ? ((int) substr($latest->proforma_number, -4)) + 1 : 1;
        return 'PROF-' . str_pad((string) $next, 4, '0', STR_PAD_LEFT);
    }
}
