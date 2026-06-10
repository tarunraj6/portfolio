$ErrorActionPreference = "Stop"
Set-Location "c:\Users\Capricorn\Desktop\ecom\wordpress"
$wpCli = "..\php\php.exe wp-cli.phar"

Write-Host "Importing products..."

$img1 = "C:\Users\Capricorn\.gemini\antigravity\brain\532b60db-0427-4878-b2d4-c15aef0d6b26\product_silk_dress_1781005766227.png"
$id1 = Invoke-Expression "$wpCli media import `"$img1`" --porcelain"
Invoke-Expression "$wpCli wc product create --name=`"Minimalist Silk Slip Dress`" --type=`"simple`" --regular_price=`"250.00`" --status=`"publish`" --images=`'[{`"id`":$id1}]`' --user=1"

$img2 = "C:\Users\Capricorn\.gemini\antigravity\brain\532b60db-0427-4878-b2d4-c15aef0d6b26\product_leather_jacket_1781005799316.png"
$id2 = Invoke-Expression "$wpCli media import `"$img2`" --porcelain"
Invoke-Expression "$wpCli wc product create --name=`"Sleek Black Leather Jacket`" --type=`"simple`" --regular_price=`"450.00`" --status=`"publish`" --images=`'[{`"id`":$id2}]`' --user=1"

$img3 = "C:\Users\Capricorn\.gemini\antigravity\brain\532b60db-0427-4878-b2d4-c15aef0d6b26\product_cashmere_sweater_1781005810946.png"
$id3 = Invoke-Expression "$wpCli media import `"$img3`" --porcelain"
Invoke-Expression "$wpCli wc product create --name=`"Oversized Cashmere Sweater`" --type=`"simple`" --regular_price=`"180.00`" --status=`"publish`" --images=`'[{`"id`":$id3}]`' --user=1"

Write-Host "Products imported successfully."
