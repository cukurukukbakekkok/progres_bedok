# 📊 Penjelasan Tampilan Kuota untuk Siswa

## 🎯 Apa itu Kuota?
Kuota adalah **jumlah maksimal siswa yang bisa daftar** di setiap gelombang pendaftaran. Setiap gelombang memiliki kuota yang berbeda sesuai kebutuhan sekolah.

---

## 👀 Tampilan Kuota di Form Pendaftaran Siswa

Saat siswa membuka halaman form pendaftaran (`/siswa/pendaftaran`), mereka akan melihat:

### 1. **Dropdown Pilih Gelombang**
```
📋 Pilih Gelombang Pendaftaran
┌─────────────────────────────────────────────────────┐
│ -- Pilih Gelombang --                          ▼ │
│ Gelombang 1 (01 Dec 2025 - 15 Dec 2025) - 50/100 sisa
│ Gelombang 2 (16 Dec 2025 - 31 Dec 2025) - 20/80 sisa
│ Gelombang 3 (01 Jan 2026 - 15 Jan 2026) - 0/50 sisa ❌ KUOTA HABIS
└─────────────────────────────────────────────────────┘
```

**Penjelasan:**
- Format: `Nama Gelombang (Tanggal) - Sisa/Kuota sisa`
- Contoh: `Gelombang 1 - 50/100 sisa` = dari 100 kuota, tersisa 50 tempat
- Hanya gelombang dengan **status AKTIF** yang ditampilkan
- Gelombang dengan kuota habis juga ditampilkan tapi di INFO CARD-nya akan ada warning

---

### 2. **Info Card Gelombang** (Muncul saat gelombang dipilih)
```
┌─────────────────────────────────────┐
│ 📊 INFORMASI GELOMBANG              │
├─────────────────────────────────────┤
│ Kuota Total      │      Sisa Kuota   │
│    100 siswa     │      50 siswa     │
├──────────────────┼──────────────────┤
│ Sudah Terdaftar  │  Ketersediaan     │
│    50 siswa      │  ✅ Terbuka       │
├─────────────────────────────────────┤
│ Persentase Terisi                   │
│ ████████████████░░░░░░░░░░░░ 50%   │ ← Progress Bar
│                                     │
│ Keterangan:                         │
│ "Pendaftaran untuk calon siswa yang │
│  ingin masuk ke program RPL dan TITL"
└─────────────────────────────────────┘
```

**Penjelasan:**
- **Kuota Total**: Berapa banyak tempat yang disediakan untuk gelombang ini
- **Sisa Kuota**: Berapa banyak tempat yang masih kosong (= Kuota - Sudah Terdaftar)
- **Sudah Terdaftar**: Berapa banyak siswa yang sudah terdaftar
- **Ketersediaan**: Status gelombang
  - ✅ **Terbuka** = masih bisa daftar
  - ⚠️ **Tinggal Sedikit** = kuota sisa <= 10%
  - ❌ **Kuota Habis** = tidak bisa daftar lagi
- **Progress Bar**: Visual persentase pemakaian kuota
  - Warna **Hijau** (0-30%) = banyak tempat kosong
  - Warna **Kuning** (30-60%) = tempat cukup
  - Warna **Orange** (60-80%) = hampir penuh
  - Warna **Merah** (80-100%) = hampir habis / habis

---

### 3. **Warna Progress Bar Berdasarkan Status**

| Persentase | Warna  | Makna |
|-----------|--------|-------|
| 0-30%     | 🟢 Hijau | Banyak tempat tersedia |
| 30-60%    | 🟡 Kuning | Tempat cukup tersedia |
| 60-80%    | 🟠 Orange | Mendekati penuh |
| 80-100%   | 🔴 Merah | Hampir habis / habis |

---

## 🔄 Apa Terjadi Saat Siswa Daftar?

1. **Siswa isi form dan submit**
2. **Sistem cek:**
   - Apakah gelombang masih AKTIF?
   - Apakah kuota masih > 0?
3. **Jika YA:**
   - ✅ Pendaftaran diterima
   - 📉 Kuota berkurang 1 (otomatis)
   - 🏷️ Siswa dapat KODE PENDAFTARAN unik
4. **Jika TIDAK:**
   - ❌ Pendaftaran ditolak
   - ⚠️ Pesan error: "Gelombang tidak tersedia atau kuota habis"

---

## 📱 Tampilan di Halaman Biodata Siswa

Setelah daftar, siswa bisa lihat data mereka di `/siswa/biodata`:

```
┌────────────────────────────────────┐
│ 📄 BIODATA CALON SISWA             │
├────────────────────────────────────┤
│ Kode Pendaftaran: REG-20251202-00001│ ← Unik per siswa!
│ Nama Lengkap: John Doe             │
│ NISN: 1234567890123                │
│ Jurusan: RPL                       │
│ Status Pembayaran: Menunggu         │
│ Status Berkas: Belum Valid         │
│ Status Kelulusan: Menunggu Keputusan│
└────────────────────────────────────┘
```

---

## 📊 Tampilan di Admin (Untuk Perbandingan)

Admin bisa lihat sisa kuota di halaman gelombang:

```
GELOMBANG LIST:
┌─────────────┬──────┬──────────────────────┐
│ Nama        │ Sisa │ Progress             │
├─────────────┼──────┼──────────────────────┤
│ Gelombang 1 │50/100│ ████████████░░░░░░░░ 50% │
│ Gelombang 2 │ 0/50 │ ████████████████████ 100% │ ← HABIS, AUTO NONAKTIF
└─────────────┴──────┴──────────────────────┘
```

---

## ⚙️ Cara Kerja Backend (Teknis)

```php
// Saat siswa submit form:
1. Cek: Gelombang aktif?        ✓
2. Cek: Kuota > 0?              ✓
3. Buat record CalonSiswa       ✓
4. Kurangi kuota: kuota - 1     ✓
5. Jika kuota = 0, set status = 'nonaktif' ✓
6. Redirect dengan success message ✓
```

---

## 💡 Contoh Skenario Real

### Skenario 1: Gelombang Masih Ada Tempat
```
Gelombang: RPL (Kuota 100)
Sudah terdaftar: 45 siswa
Sisa: 55 siswa

Siswa: "Saya mau daftar"
→ Bisa! Progress bar 45%
→ Setelah daftar: sisa jadi 54 siswa, progress bar jadi 46%
```

### Skenario 2: Gelombang Hampir Penuh
```
Gelombang: TITL (Kuota 50)
Sudah terdaftar: 49 siswa
Sisa: 1 siswa

Siswa 1: "Saya mau daftar"
→ Bisa! Progress bar 98%
→ Setelah daftar: sisa jadi 0, progress bar 100%, status AUTO = 'nonaktif'

Siswa 2: "Saya juga mau daftar"
→ TIDAK BISA! Error: "Gelombang tidak tersedia atau kuota habis"
```

---

## 🎯 Kesimpulan

✅ **Siswa bisa:**
- Lihat berapa banyak tempat tersisa
- Lihat seberapa penuh gelombang (progress bar)
- Tahu apakah bisa daftar atau kuota sudah habis
- Mendapatkan kode pendaftaran unik setelah sukses daftar

✅ **Sistem otomatis:**
- Mengurangi kuota saat ada pendaftaran
- Menutup gelombang (status = nonaktif) saat kuota habis
- Mencegah pendaftaran melebihi kuota
- Menampilkan visual yang jelas dan intuitif

