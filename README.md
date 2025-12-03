# Destinify

Sistem Rekomendasi Destinasi Wisata menggunakan metode AHP (Analytical Hierarchy Process) berbasis Laravel.

## Prasyarat

Pastikan sistem Anda sudah terinstall:
- PHP >= 8.1
- Composer
- Node.js & NPM
- SQLite (atau database lain sesuai preferensi)

## Cara Setup

### 1. Clone Repository

```bash
git clone https://github.com/FathimatusZN/destinify.git
cd destinify
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Konfigurasi Environment

```bash
# Copy file .env.example menjadi .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Buka file `.env` dan sesuaikan konfigurasi database. Untuk SQLite (default):

```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

Pastikan file `database/database.sqlite` sudah ada. Jika belum:

```bash
touch database/database.sqlite
```

Atau jika menggunakan MySQL/PostgreSQL, sesuaikan konfigurasi:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=destinify
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Migrasi Database & Seeding

```bash
# Jalankan migrasi
php artisan migrate

# Jalankan seeder untuk data awal
php artisan db:seed
```

### 6. Build Assets

```bash
# Development
npm run dev

# Atau untuk production
npm run build
```

### 7. Jalankan Aplikasi

```bash
# Jalankan Laravel development server
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Struktur Database

Aplikasi ini menggunakan beberapa tabel utama:
- `tb_kriteria` - Data kriteria penilaian
- `tb_alternatif` - Data destinasi wisata
- `tb_rel_kriteria` - Relasi perbandingan kriteria (AHP)
- `tb_user_input` - Input preferensi user
- `tb_hasil_perhitungan` - Hasil perhitungan rekomendasi

## Fitur Utama

- **Dashboard**: Tampilan utama aplikasi
- **Master Kriteria**: Kelola kriteria penilaian destinasi
- **Master Alternatif**: Kelola data destinasi wisata
- **Pembobotan**: Proses pembobotan kriteria menggunakan AHP
- **Rekomendasi**: Sistem rekomendasi destinasi berdasarkan preferensi user

## Troubleshooting

### Error: "Permission denied" saat migrasi

```bash
# Berikan permission untuk folder storage dan bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### Error saat `composer install`

```bash
# Hapus folder vendor dan composer.lock, lalu install ulang
rm -rf vendor composer.lock
composer install
```

### Assets tidak muncul

```bash
# Clear cache dan rebuild assets
php artisan cache:clear
php artisan config:clear
npm run build
```

## Teknologi yang Digunakan

- **Framework**: Laravel 11.x
- **Frontend**: Blade, Tailwind CSS, Vite
- **Database**: SQLite (default) / MySQL / PostgreSQL
- **Metode**: Analytical Hierarchy Process (AHP)

## Kontak

[@FathimatusZN](https://github.com/FathimatusZN)
