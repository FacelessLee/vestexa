@echo off
setlocal
set "ELECTRON_RUN_AS_NODE=1"
"C:\Users\Dell\AppData\Local\Programs\Antigravity IDE\Antigravity IDE.exe" "%~dp0node_modules\vite\bin\vite.js" build %*
