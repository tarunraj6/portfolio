$ErrorActionPreference = "Stop"

Write-Host "Starting Portable WordPress Setup..." -ForegroundColor Cyan

# Define directories
$baseDir = "c:\Users\Capricorn\Desktop\ecom"
$phpDir = "$baseDir\php"
$wpDir = "$baseDir\wordpress"
$pluginDir = "$wpDir\wp-content\plugins\sqlite-database-integration"

# 1. Download and extract PHP
if (-not (Test-Path $phpDir)) {
    Write-Host "Downloading PHP 8.2 (Portable)..." -ForegroundColor Yellow
    $phpZip = "$baseDir\php.zip"
    Invoke-WebRequest -Uri "https://windows.php.net/downloads/releases/archives/php-8.2.19-Win32-vs16-x64.zip" -OutFile $phpZip
    Write-Host "Extracting PHP..." -ForegroundColor Yellow
    Expand-Archive -Path $phpZip -DestinationPath $phpDir
    Remove-Item $phpZip
} else {
    Write-Host "PHP already downloaded." -ForegroundColor Green
}

# 2. Configure PHP
Write-Host "Configuring PHP..." -ForegroundColor Yellow
$phpIni = "$phpDir\php.ini"
Copy-Item "$phpDir\php.ini-development" $phpIni

$iniContent = Get-Content $phpIni
$iniContent = $iniContent -replace "^;extension_dir = `"ext`"", "extension_dir = `"ext`""
$iniContent = $iniContent -replace "^;extension=curl", "extension=curl"
$iniContent = $iniContent -replace "^;extension=fileinfo", "extension=fileinfo"
$iniContent = $iniContent -replace "^;extension=gd", "extension=gd"
$iniContent = $iniContent -replace "^;extension=mbstring", "extension=mbstring"
$iniContent = $iniContent -replace "^;extension=openssl", "extension=openssl"
$iniContent = $iniContent -replace "^;extension=pdo_sqlite", "extension=pdo_sqlite"
$iniContent = $iniContent -replace "^;extension=sqlite3", "extension=sqlite3"
Set-Content -Path $phpIni -Value $iniContent

# 3. Download and extract WordPress
if (-not (Test-Path $wpDir)) {
    Write-Host "Downloading WordPress..." -ForegroundColor Yellow
    $wpZip = "$baseDir\wp.zip"
    Invoke-WebRequest -Uri "https://wordpress.org/latest.zip" -OutFile $wpZip
    Write-Host "Extracting WordPress..." -ForegroundColor Yellow
    Expand-Archive -Path $wpZip -DestinationPath $baseDir
    Remove-Item $wpZip
} else {
    Write-Host "WordPress already downloaded." -ForegroundColor Green
}

# 4. Download and setup SQLite plugin
if (-not (Test-Path $pluginDir)) {
    Write-Host "Downloading SQLite Database Integration plugin..." -ForegroundColor Yellow
    $sqliteZip = "$baseDir\sqlite.zip"
    Invoke-WebRequest -Uri "https://downloads.wordpress.org/plugin/sqlite-database-integration.zip" -OutFile $sqliteZip
    Write-Host "Extracting SQLite Plugin..." -ForegroundColor Yellow
    Expand-Archive -Path $sqliteZip -DestinationPath "$wpDir\wp-content\plugins"
    Remove-Item $sqliteZip
} else {
    Write-Host "SQLite plugin already downloaded." -ForegroundColor Green
}

# 5. Enable SQLite by copying db.copy to wp-content/db.php
$dbDropIn = "$wpDir\wp-content\db.php"
if (-not (Test-Path $dbDropIn)) {
    Write-Host "Enabling SQLite Database Integration..." -ForegroundColor Yellow
    Copy-Item "$pluginDir\db.copy" $dbDropIn
}

Write-Host "Setup Complete! You can now run Start-Server.ps1" -ForegroundColor Green
