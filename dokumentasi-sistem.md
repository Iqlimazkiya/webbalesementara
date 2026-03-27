#  Dokumentasi Sistem Website Bale Hinggil

##  Arsitektur Sistem

```
┌─────────────────────────────────────────────────────────────────────────┐
│                          WEBSITE BALE HINGGIL                           │
│                Manajemen Fasilitas Apartemen Bale Hinggil               │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                         │
│   ┌─────────────┐                         ┌─────────────┐               │
│   │    ADMIN    │     │    GUEST    │              │
│   │  Dashboard  │                         │ Homepage    │               │
│   └──────┬──────┘                         └──────┬──────┘               │
│          │                                       │                      │
│          ▼                                       ▼                      │
│   ┌─────────────────────────────────────────────────────────┐           │
│   │                    SHARED MODELS                        │           │
│   │ Unit • LayananCO/DI/WO • Homepage • Tracking • Settings │           │
│   └─────────────────────────────────────────────────────────┘           │
│                                                                         │
└─────────────────────────────────────────────────────────────────────────┘
```

---

##  Role & Permissions

### 1. **GUEST**

| Menu             | Akses | Deskripsi                           |
| ---------------- | ----- | ----------------------------------- |
| Homepage         | ✅    | Hero, fasilitas, Maps, layanan CTAs |
| Layanan CO/DI/WO | ✅    | Form pengajuan                      |
| Tipe Unit        | ✅    | List unit                           |

### **ADMIN**

| Menu         | Akses | Deskripsi                       |
| ------------ | ----- | ------------------------------- |
| Dashboard    | ✅    | Stats/charts pengunjung/booking |
| Layanan CRUD | ✅    | Edit CO/DI/WO (foto/preview)    |
| Unit CRUD    | ✅    | Manage/reorder unit             |
| Homepage     | ✅    | Edit hero/fasilitas/berita      |
| Pesan        | ✅    | Read/unread contact forms       |
| Aktivitas    | ✅    | Log semua aksi                  |
| Settings     | ✅    | Global config                   |
| Profile      | ✅    | Edit foto/password              |

**Akses Admin**: kode GATE_SECRET → Burung biru → login.

---

##  Alur Sistem Utama

### Alur Sistem Utama (List)

1. **Akses Admin**: Home → input GATE_SECRET → klik burung biru → login → /admin/dashboard
2. **Pesan Kontak**: Guest submit form di home → simpan ContactMessage → admin read
3. **Edit Konten**: Admin → Layanan/Homepage/Unit → upload foto → preview → save → log Activity
4. **Tracking**: Auto visitor count, klik CTA/booking per unit → update charts dashboard
5. **Pesan**: Auto unread badge → admin read/delete → log activity

---

---

## 🔗 Routes Lengkap

Lihat `routes/web.php` atau README.md.

---
