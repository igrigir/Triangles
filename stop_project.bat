@echo off
echo -------------------------------------
echo  Stopping Symfony 5.4 Project Server
echo -------------------------------------

:: Find developer proces and kill it
for /f "tokens=5" %%a in ('netstat -ano ^| find ":8000" ^| find "LISTENING"') do (
    taskkill /PID %%a /F
)

echo PHP server on port 8000 stopped.
pause