Write-Host "Starting Portable WordPress Server..." -ForegroundColor Cyan
Write-Host "Press Ctrl+C to stop the server." -ForegroundColor Yellow

$baseDir = "c:\Users\Capricorn\Desktop\ecom"
$phpExe = "$baseDir\php\php.exe"
$wpDir = "$baseDir\wordpress"

if (-not (Test-Path $phpExe)) {
    Write-Host "PHP not found. Please run Setup-WooCommerce.ps1 first." -ForegroundColor Red
    exit 1
}

Write-Host "Opening your browser to http://localhost:8000" -ForegroundColor Green
Start-Process "http://localhost:8000"

# Start the server
& $phpExe -S localhost:8000 -t $wpDir
