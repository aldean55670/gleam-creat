param([string]$filePath) (Get-Content $filePath) -replace "^pick 7a10c41","edit 7a10c41" | Set-Content $filePath
