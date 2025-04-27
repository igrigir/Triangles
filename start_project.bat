@echo off
SETLOCAL
cd /d "%~dp0"

echo -------------------------------------
echo  Symfony 5.4 Project Starter Script
echo -------------------------------------

:: Uđi u backend folder
cd backend

:: Pokreni server ako nije već pokrenut
set PORT_CHECK=""
for /f "tokens=5" %%a in ('netstat -ano ^| find ":8000" ^| find "LISTENING"') do (
    set PORT_CHECK=found
)

IF "%PORT_CHECK%"=="found" (
    echo Server is already running on port 8000.
) ELSE (
    IF NOT EXIST "vendor" (
        echo Vendor folder not found. Running Composer install...
        composer install
    ) ELSE (
        echo Vendor folder already exists. Skipping composer install.
    )

    echo Clearing Symfony cache...
    php bin/console cache:clear

    echo Starting PHP server on http://127.0.0.1:8000 ...
    start "PHP Server" cmd /k "php -S 127.0.0.1:8000 -t public"
    timeout /t 2 > nul
)

cd ..

:: ⚡ OTVORI frontend (index.html)
echo Opening frontend (index.html)...

start "" "frontend\index.html"

pause
