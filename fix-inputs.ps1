# fix-inputs.ps1
$path = Join-Path (Get-Location) "app\Views\layouts\app.php"

if (!(Test-Path $path)) {
    Write-Host "ERROR: No existe $path" -ForegroundColor Red
    exit 1
}

$content = [System.IO.File]::ReadAllText($path)

$inputFix = @'

/* Fix inputs editables en modales */
.modal .form-control,
.modal .form-select {
    pointer-events: auto !important;
    position: relative;
    z-index: 10;
}

.modal * {
    pointer-events: auto;
}

.modal-backdrop {
    z-index: 1040 !important;
}

.modal {
    z-index: 1050 !important;
}

/* Fix date input en modo oscuro */
input[type="date"] {
    color-scheme: dark;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    cursor: pointer;
}

/* Fix autofill */
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus {
    -webkit-text-fill-color: #e2e8f0;
    -webkit-box-shadow: 0 0 0 1000px rgba(15, 23, 42, .9) inset;
    transition: background-color 5000s ease-in-out 0s;
}

'@

if ($content -notmatch "Fix inputs editables en modales") {
    $content = $content -replace '</style>', "$inputFix</style>"
    [System.IO.File]::WriteAllText($path, $content, [System.Text.UTF8Encoding]::new($false))
    Write-Host "OK -> CSS de inputs aplicado en app.php" -ForegroundColor Green
} else {
    Write-Host "Ya estaba aplicado" -ForegroundColor Yellow
}