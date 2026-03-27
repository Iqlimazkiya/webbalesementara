# Fitur-Fitur Aplikasi Website Bale Hinggil

## Platform Manajemen Fasilitas Apartemen

---

##  Daftar Fitur Lengkap

### 1. Frontend & Backend

- Arsitektur Laravel 12 lengkap
- Tailwind/Vite/Alpine/Mazer admin
- Proteksi gate (GATE_SECRET + burung animasi)

### 2. Homepage Dinamis

- Hero video full background + teks 3 baris + CTA
- Gallery fasilitas (kolam, playground, gym) multi-foto
- Google Maps lokasi akses
- Berita (YT embed + artikel + foto)
- Tombol layanan CO/DI/WO
- Kontak jam operasional + divisi + sosmed/WA
- Contact Form → ContactMessage (nama/email/divisi/pesan)

### 3. Layanan Pengguna

#### Layanan CO/WO/DI (Content & Stack)

- Page layanan: Hero foto, panel expand/collapse tarif (JS stack), galeri foto/slide (carousel)
- Admin CRUD: Upload foto hero/slide/galeri, preview
- landing info (expand panel via layanan.js)

### 4. Manajemen Unit

- List tipe unit (nama_tipe)
- CRUD admin (move up/down, page settings)
- Link ke layanan/booking

### 5. Dashboard Admin

- Statistik realtime:
    - Pengunjung hari kemarin/hari ini (+persen)
    - Klik booking total/hari ini
    - Pesan unread
    - Aktivitas terbaru
- Chart:
    - Harian (Sen-Ming)
    - Mingguan
    - Bulanan (Jan-Des)
    - Booking per unit (pie/bar)

### 6. CRUD Admin Layanan

- **Layanan CO/DI/WO**:
    - Edit foto hero, slide carousel, galeri
    - Preview changes sebelum save
    - Activity log auto
- **Unit**: CRUD + reorder + page layout

### 7. Tracking & Analytics

- **Visitor**: Auto count harian (model Visitor)
- **CTA Click**: Klik tombol layanan (CtaClick)
- **Booking Click**: Klik booking per unit/tanggal (BookingClick)

### 8. Manajemen Pesan & Aktivitas

- **Pesan Kontak**: List/read/delete, unread badge
- **Aktivitas Log**: Semua aksi admin (ActivityLogger helper)

### 9. Homepage Editor Admin

- Update hero video/teks/CTA
- About foto + teks
- Fasilitas/berita multi-item + foto
- Lokasi Maps + akses
- Background layanan

### 10. Settings Global

- Key-value (whatsapp_number dll)
- Edit/hapus via admin

### 11. Profile User/Admin

- Upload foto profil
- Edit info/password
- Breeze auth full

### 12. Gate Protection

- Animasi burung (2 lokasi)
- Input GATE_SECRET (.env)
- Scene gerbang terbuka

---

## Tech Stack

- **Backend**: Laravel 12, Eloquent, Carbon charts
- **Frontend**: Tailwind CSS, Alpine.js, Vite
- **Admin**: Mazer template + Chart.js
- **Tracking**: Auto via middleware/models
