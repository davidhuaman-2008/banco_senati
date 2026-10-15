# fix-intelephense.ps1
$root = Get-Location

function Add-Doc {
    param([string]$Path, [string]$Doc)
    $full = Join-Path $root $Path
    if (Test-Path $full) {
        $content = [System.IO.File]::ReadAllText($full)
        if ($content -notmatch [regex]::Escape($Doc.Trim())) {
            [System.IO.File]::WriteAllText($full, "$Doc`r`n$content", [System.Text.UTF8Encoding]::new($false))
            Write-Host "  OK -> $Path" -ForegroundColor DarkGray
        }
    }
}

Write-Host ""
Write-Host "Aplicando PHPDoc a vistas..." -ForegroundColor Cyan
Write-Host ""

Add-Doc "app\Views\clientes\index.php" @"
<?php /** @var array `$clientes */ ?>
"@

Add-Doc "app\Views\depositos\index.php" @"
<?php /** @var array `$depositos */ ?>
<?php /** @var array `$clientes */ ?>
"@

Add-Doc "app\Views\retiros\index.php" @"
<?php /** @var array `$retiros */ ?>
<?php /** @var array `$clientes */ ?>
"@

Add-Doc "app\Views\pagos\index.php" @"
<?php /** @var array `$pagos */ ?>
<?php /** @var array `$clientes */ ?>
"@

Add-Doc "app\Views\usuarios\index.php" @"
<?php /** @var array `$usuarios */ ?>
"@

Add-Doc "app\Views\dashboard\index.php" @"
<?php /** @var int `$totalClientes */ ?>
<?php /** @var int `$totalDepositos */ ?>
<?php /** @var int `$totalRetiros */ ?>
<?php /** @var int `$totalPagos */ ?>
"@

Add-Doc "app\Views\layouts\app.php" @"
<?php /** @var string `$view */ ?>
<?php /** @var string|null `$title */ ?>
"@

Write-Host ""
Write-Host "Listo! Recarga el navegador." -ForegroundColor Green
Write-Host ""
