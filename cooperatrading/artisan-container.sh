#!/usr/bin/env bash
# Wrapper to run Laravel artisan and composer commands inside the PHP container.
# Usage: ./artisan-container.sh <command> [args...]
# Examples:
#   ./artisan-container.sh php artisan migrate
#   ./artisan-container.sh composer require vendor/package

set -e

PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
USER_ID="$(id -u)"
GROUP_ID="$(id -g)"

docker run --rm \
  --user "${USER_ID}:${GROUP_ID}" \
  -v "${PROJECT_DIR}:/app" \
  -w /app \
  -e HOME=/tmp \
  composer:latest \
  "$@"
