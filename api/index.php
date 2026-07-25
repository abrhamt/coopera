<?php

// On Vercel: the only writable directory is /tmp, and it's per-instance.
// Copy the seeded SQLite file (bundled during build) into /tmp on first hit.
if (getenv('VERCEL') === '1' && (getenv('DB_CONNECTION') ?: 'sqlite') === 'sqlite') {
    $tmpDb = '/tmp/database.sqlite';
    if (!file_exists($tmpDb)) {
        $bundled = __DIR__ . '/../database/database.sqlite';
        if (file_exists($bundled)) {
            @copy($bundled, $tmpDb);
        } else {
            @touch($tmpDb);
        }
    }
}

require __DIR__ . '/../public/index.php';
