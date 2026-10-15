# install.ps1 - PRUEBA
function Write-Utf8NoBom {
    param([string]$Path, [string]$Content)
    $full = [System.IO.Path]::GetFullPath((Join-Path (Get-Location) $Path))
    $dir = Split-Path $full -Parent
    if (-not (Test-Path $dir)) { New-Item -ItemType Directory -Force -Path $dir | Out-Null }
    [System.IO.File]::WriteAllText($full, $Content, [System.Text.UTF8Encoding]::new($false))
    Write-Host "  OK -> $Path" -ForegroundColor Green
}

Write-Host ""
Write-Host "Probando script..." -ForegroundColor Cyan
Write-Host ""

Write-Utf8NoBom ".env" @'
APP_NAME=Banco Senati
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=banco_senati
DB_USERNAME=root
DB_PASSWORD=
DB_CHARSET=utf8mb4
'@

Write-Utf8NoBom ".env.example" @'
APP_NAME=Banco Senati
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=banco_senati
DB_USERNAME=root
DB_PASSWORD=
DB_CHARSET=utf8mb4
'@

Write-Host ""
Write-Host "Listo!" -ForegroundColor Green