#!/usr/bin/env bash
set -euo pipefail

echo "==> [vercel-build] start"

# 1. Generate APP_KEY if not provided via Vercel env
if [ -z "${APP_KEY:-}" ]; then
    export APP_KEY="base64:$(php -r 'echo base64_encode(random_bytes(32));')"
    echo "==> [vercel-build] generated APP_KEY"
fi

# 2. Materialize .env for the build (Vercel runtime env vars will override at runtime)
cat > .env <<EOF
APP_NAME="Cooper Trading"
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=false
APP_URL=https://coopera.razielcc.com
APP_TIMEZONE=Africa/Addis_Ababa
APP_CURRENCY=ETB
APP_CURRENCY_SYMBOL=Br
APP_VAT_RATE=15
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US
APP_MAINTENANCE_DRIVER=env
BCRYPT_ROUNDS=12
LOG_CHANNEL=errorlog
LOG_LEVEL=warning
DB_CONNECTION=sqlite
SESSION_DRIVER=cookie
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
CACHE_STORE=array
CACHE_PREFIX=
MAIL_MAILER=log
MAIL_FROM_ADDRESS="info@cooperatrading.com"
MAIL_FROM_NAME="Cooper Trading"
ADMIN_EMAIL=admin@cooperatrading.com
VERCEL=1
EOF

# 3. Composer install (no dev, no scripts — we run them explicitly)
echo "==> [vercel-build] composer install"
composer install --optimize-autoloader --no-dev --no-scripts --no-interaction

# 4. Run Laravel post-autoload scripts (package discovery, etc.)
php artisan package:discover --ansi || true

# 5. Fresh migrate + seed into the bundled SQLite file
echo "==> [vercel-build] migrate --seed"
php artisan migrate:fresh --seed --force --no-interaction

# 6. Build frontend assets
echo "==> [vercel-build] npm build"
npm ci --no-audit --no-fund
npm run build

# 7. Cache config / routes / views for production
echo "==> [vercel-build] optimize"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> [vercel-build] done"
