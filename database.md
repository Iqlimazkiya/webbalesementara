# Struktur Database - Website Bale Hinggil

##  Status: Semua Tabel & Model Siap

###  Tabel Utama (15+ tabel):

**Core (Auth):**

1. **users** - Admin (login gate-protected)
2. **units** - Tipe unit apartemen (nama_tipe)

**Layanan:** 3. **layanan_c_o_s** - Cleaning Order content 4. **layanan_d_i_s** - Dekorasi Interior content 5. **layanan_w_o_s** - Work Order content

**Content Dinamis:** 6. **home_pages** - Homepage data (hero, fasilitas, berita)

**Tracking:** 7. **visitors** - Pengunjung harian 8. **cta_clicks** - Klik CTA layanan 9. **booking_clicks** - Klik booking per unit 10. **activities** - Log aktivitas admin

**Komunikasi:** 11. **contact_messages** - Pesan form (unit_id, is_read)

**Config:** 12. **settings** - Key-value (whatsapp_number dll)

**Laravel Core:**

- cache, jobs, migrations, password_resets, sessions, failed_jobs

---

##  Relasi Model

```
User ── hasMany ── ContactMessage
Unit ── hasMany ── ContactMessage, BookingClick
Homepage ── JSON arrays (fasilitas[], berita[])
LayananCO/DI/WO ── foto arrays (hero, slide, galeri)
Setting ── key → value
Visitor/Activity/CtaClick/BookingClick ── timestamps
```

### Detail Relasi:

- **ContactMessage**: `belongsTo Unit` (unit_id)
- **BookingClick**: `belongsTo Unit`, `unit_nama`
- **Activity**: `belongsTo User` (admin yang action)

---

##  Data Demo (Seeder)

### Admin Login

```
Email: ahmadchoirul598@gmail.com
Password: password
```

### Seeders Auto:

- HomePageSeeder: Hero/fasilitas/berita demo
- UnitSeeder: Tipe unit sample
- LayananCO/DI/WO Seeder: Konten + foto demo
- DashboardSeeder: Settings WA dll

**Run:** `php artisan migrate --seed`

---

##  Struktur Tabel Kunci

### users

```
id, name, email, password, foto_profil, timestamps
```

### units

```
id, nama_tipe, sort_order, timestamps
```

### home_pages (single record)

```
hero_video/teks1/2/3/cta_*, about_foto/teks, fasilitas_foto/teks[], berita_yt/artikel/foto[], lokasi_*, layanan_foto_bg, timestamps
```

### layanan_c_o_s (single/singleton)

```
title, description, foto_hero, foto_slide[], foto_galeri[], timestamps
```

### contact_messages

```
unit_id, name, phone, email, subject, message, is_read, timestamps
```

### booking_clicks

```
unit_id, unit_nama, click_date, month, year, type, timestamps
```

### settings

```
key (whatsapp_number), value, timestamps
```

---

## Index Optimasi

- Composite: date/month/year di tracking
- Foreign key: unit_id di messages/clicks
- Status: is_read di messages

---
