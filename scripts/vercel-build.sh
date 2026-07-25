#!/usr/bin/env bash
set -euo pipefail

echo "==> [vercel-build] start"

# 1. Generate APP_KEY if not provided via Vercel env
if [ -z "${APP_KEY:-}" ]; then
    if command -v php &> /dev/null; then
        export APP_KEY="base64:$(php -r 'echo base64_encode(random_bytes(32));')"
    elif command -v openssl &> /dev/null; then
        export APP_KEY="base64:$(openssl rand -base64 32)"
    else
        export APP_KEY="base64:$(head -c 32 /dev/urandom | base64)"
    fi
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

# 3. Composer install (if composer is available in build environment)
if command -v composer &> /dev/null; then
    echo "==> [vercel-build] composer install"
    composer install --optimize-autoloader --no-dev --no-scripts --no-interaction
else
    echo "==> [vercel-build] composer not found in build environment; vercel-php builder will install dependencies during function deployment"
fi

# 4. Run Laravel commands (if php is available in build environment)
if command -v php &> /dev/null; then
    echo "==> [vercel-build] running artisan commands"
    php artisan package:discover --ansi || true
    php artisan migrate:fresh --seed --force --no-interaction || true
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
else
    echo "==> [vercel-build] php not found in build environment; skipping build-time artisan commands"
fi

# 5. Build frontend assets
echo "==> [vercel-build] npm build"
npm ci --no-audit --no-fund
npm run build

echo "==> [vercel-build] done"
