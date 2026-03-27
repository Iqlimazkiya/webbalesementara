# Website Bale Hinggil

Website manajemen fasilitas apartemen Bale Hinggil berbasis Laravel 12. Mendukung layanan CO (Cleaning Order), DI (Dekorasi Interior), WO (Work Order/Maintenance), manajemen tipe unit, dashboard admin lengkap dengan analitik pengunjung/booking/aktivitas, form kontak, tracking klik CTA/booking, homepage dinamis, dan proteksi akses admin rahasia (gerbang burung). Di bawah ini instruksi run untuk Laragon (direkomendasikan).

<p align=\"center\"><a href=\"https://laravel.com\" target=\"_blank\"><img src=\"https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg\" width=\"400\" alt=\"Laravel Logo\"></a></p>

## Lingkungan (.env)

- Copy `.env.example` ke `.env` jika ada, atau buat manual dari `.env`.
- Isi kredensial
- Settings lain seperti `whatsapp_number` bisa diatur via Admin > Settings.

## Jalankan Lokal (Laragon)

1. `composer install`
2. `npm install && npm run build`
3. `php artisan key:generate`
4. `php artisan migrate --seed`
5. Start (Apache + MySQL) atau `php artisan serve`
6. App URL: http://localhost (atau http://127.0.0.1:8000)

**Demo Login Admin:**

- Masukkan `GATE_SECRET` (default: `bhgate`).
- Buka login form, klik **burung biru**.
- Animasi gerbang → login:
    - Email: `ahmadchoirul598@gmail.com`
    - Password: `password`
- Masuk `/admin/dashboard`.

## Fitur Utama (Ringkasan)

- **Frontend User**:
    - Homepage dinamis: Hero video/teks, gallery fasilitas/kolam/playground, Google Maps lokasi, berita YT+artikel, tombol layanan, kontak jam operasional/divisi/WA.
    - Layanan: Form CO/DI/WO (pilih unit, pesan), daftar tipe unit.
    - Profile: Edit foto/info/password.
    - Auth: Login/register (Laravel Breeze).
- **Admin Panel (/admin)**:
    - Dashboard: Statistik realtime (pengunjung hari/minggu/bulan, klik booking/CTA per unit, pesan unread, chart Mazer).
    - CRUD: Layanan CO/DI/WO/Unit (upload foto hero/slide/galeri, preview changes).
    - Homepage editor: Update hero/about/fasilitas/berita/lokasi/CTA.
    - Settings: Konfigurasi global (WA number dll).
    - Pesan Kontak: View/read/delete unread.
    - Aktivitas Log: Riwayat semua aksi admin.
    - Profile admin: Edit foto/password.
- **Tracking Otomatis**:
    - Pengunjung harian (Visitor model).
    - Klik CTA/booking per unit/tanggal (CtaClick/BookingClick).
- **Proteksi**: Gerbang rahasia (GATE_SECRET) + auth.

## Mapping Menu → Controller → Model

### Public Routes

| Menu       | Route            | Controller             | Model                   |
| ---------- | ---------------- | ---------------------- | ----------------------- |
| Home       | `/`              | HomeController         | Homepage/ContactMessage |
| Layanan CO | `/layanan-co`    | LayananCOController    | LayananCO               |
| Unit       | `/tipe-unit`     | UnitController         | Unit                    |
| WO/DI      | `/layanan-wo/di` | LayananWO/DIController | LayananWO/DI            |

### Admin Routes (`/admin/*`)

| Menu       | Route               | Controller               | Model          |
| ---------- | ------------------- | ------------------------ | -------------- |
| Dashboard  | `/admin`            | DashboardController      | All tracking   |
| Layanan CO | `/admin/layananco`  | AdminLayananCOController | LayananCO      |
| Unit       | `/admin/unit`       | AdminUnitController      | Unit           |
| Homepage   | `/admin/home`       | AdminHomepageController  | Homepage       |
| Pesan      | `/admin/messages`   | MessageController        | ContactMessage |
| Aktivitas  | `/admin/activities` | ActivityController       | Activity       |
| Settings   | `/admin/settings`   | SettingController        | Setting        |

## Perintah Umum

- Clear cache: `php artisan config:clear && php artisan cache:clear && php artisan view:clear`
- Reset demo: `php artisan migrate:fresh --seed`
- Build assets: `npm run build`
- Serve: `php artisan serve`

## Catatan

- **Demo Data**: Seeders lengkap (admin, units, layanan, homepage, dashboard). Gunakan `migrate --seed`.
- **Gerbang Rahasia**: Lindungi /admin via GATE_SECRET (.env). Klik burung di home → masukkan kode → login.
- **Assets**: Tailwind/Vite/Alpine/Mazer. Edit `resources/css/js` → `npm run dev/build`.
- **Tracking**: Auto-log pengunjung/klik via models. Chart di dashboard via Carbon/Mazer.
- **Siap Produksi**: Tambah email notif/pembayaran/backup. Gunakan Laragon full atau Forge/Vapor.

## Tentang Laravel

Laravel adalah framework web dengan sintaks elegan. [Dokumentasi](https://laravel.com/docs).

## Kontribusi

Lihat [Laravel Contributing](https://laravel.com/docs/contributions).

## Lisensi

MIT License. © Bale Hinggil Team.
