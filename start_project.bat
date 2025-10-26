@echo off
title Jalankan Project Laravel Kansai Paint
echo =========================================
echo 🚀 Menyiapkan Project Laravel Kansai Paint...
echo =========================================

REM Pastikan composer dan php sudah tersedia
where php >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ PHP tidak ditemukan! Pastikan PHP sudah terpasang.
    pause
    exit /b
)

where composer >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ Composer tidak ditemukan! Pastikan Composer sudah terpasang.
    pause
    exit /b
)

echo ✅ PHP dan Composer ditemukan.
echo -----------------------------------------

REM Jalankan composer install
if not exist vendor (
    echo 📦 Menginstal dependency via Composer...
    composer install
)

REM Cek apakah file database.sqlite sudah ada
if not exist database (
    mkdir database
)

if not exist database\database.sqlite (
    echo 🗂️ Membuat file database SQLite baru...
    type nul > database\database.sqlite
)

REM Jalankan migrasi
echo ⚙️ Menjalankan migrasi database...
php artisan migrate --force

REM Jalankan server Laravel
echo 🌐 Menjalankan server Laravel...
start http://127.0.0.1:8000
php artisan serve

pause
