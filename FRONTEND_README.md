# ShowTix Frontend - Dokumentasi

## 🎫 Tentang Project

ShowTix adalah platform pemesanan tiket konser yang dibangun dengan **Laravel 12** dan **Filament 5**. Frontend ini dirancang dengan referensi desain dari **Kiostix** dan menggunakan **Tailwind CSS** untuk styling yang elegan dan responsif.

## 🎨 Desain & Branding

### Color Palette
Menggunakan kombinasi warna dari logo ShowTix:
- **Primary Blue**: `#003D82` - Warna utama untuk tombol dan highlight
- **Primary Orange**: `#FF6600` - Warna aksen untuk CTA dan alert
- **Dark Blue**: `#001f42` - Untuk text dan dark backgrounds
- **Light Blue**: `#0052a3` - Untuk gradients dan hover states

### Typography
- **Display Font**: Poppins (untuk headings)
- **Body Font**: Inter (untuk regular text)

## 📁 Struktur Project

```
resources/views/
├── layouts/
│   └── app.blade.php              # Master layout dengan navbar & footer
├── home.blade.php                  # Halaman utama
├── search.blade.php                # Halaman hasil pencarian
├── concerts/
│   └── detail.blade.php            # Detail konser
├── cart/
│   └── index.blade.php             # Keranjang belanja
├── checkout/
│   └── index.blade.php             # Form checkout
├── payment/
│   ├── index.blade.php             # Halaman pembayaran
│   └── success.blade.php           # Konfirmasi sukses
├── dashboard/
│   └── index.blade.php             # Dashboard user
└── auth/
    ├── login.blade.php             # Halaman login
    └── register.blade.php          # Halaman register

app/Http/Controllers/
├── HomeController.php              # Listing & search konser
├── ConcertController.php           # Detail konser
├── CartController.php              # Manajemen keranjang
├── CheckoutController.php          # Proses checkout
├── PaymentController.php           # Proses pembayaran
└── DashboardController.php         # Dashboard user
```

## 🚀 Fitur Utama

### 1. Halaman Beranda (Home)
- **Hero Section** dengan Call-to-Action
- **Filter & Search** untuk mencari konser
- **Featured Concerts** - konser dengan penjualan tertinggi
- **Upcoming Concerts** - konser yang akan datang
- **Why Choose Us** - section keunggulan platform
- Responsive design untuk semua perangkat

### 2. Halaman Detail Konser
- Poster konser dengan gallery
- Informasi lengkap (tanggal, waktu, lokasi)
- Daftar artis yang tampil
- Pilihan kategori tiket dengan harga
- Quantity selector dengan validasi
- Sidebar dengan ringkasan harga
- Trust badges untuk keamanan

### 3. Keranjang Belanja (Cart)
- Tampilan item dengan poster konser
- Kontrol jumlah tiket (tambah/kurang)
- Opsi hapus item
- Ringkasan harga dengan breakdown fee
- Input kode promo
- Proceed to checkout button

### 4. Checkout
- Form data pribadi (nama, email, telepon)
- Form alamat pengiriman
- **Pilihan Metode Pembayaran**:
  - Transfer Bank
  - E-Wallet (GoPay, OVO, Dana)
  - Kartu Kredit
  - Cicilan 0%
- Terms & conditions checkbox
- Order summary sidebar

### 5. Pembayaran (Payment)
- **Progress indicator** untuk step pembayaran
- **Status card** dengan countdown timer
- **Instruksi pembayaran** untuk setiap metode:
  - Nomor rekening dengan copy button
  - E-wallet selection
  - QRIS QR code
- **Form verifikasi manual** pembayaran
- **Order summary** dengan countdown
- Support contact information

### 6. Konfirmasi Sukses
- Success animation dengan checkmark
- Nomor pesanan (reference number)
- Daftar tiket yang dibeli
- Data pemesan
- Langkah selanjutnya
- Tombol untuk lihat tiket atau kembali

### 7. Dashboard User
- **Welcome header** dengan nama user
- **Quick statistics**:
  - Total konser ditonton
  - Total tiket
  - Total belanja
  - Konser mendatang
- **Tabbed interface**:
  - Konser mendatang
  - Riwayat pembelian
  - Pengaturan (profile, keamanan, preferensi)

### 8. Autentikasi
- **Login** dengan social login (Google, Facebook) atau email
- **Register** dengan validasi password
- Password visibility toggle
- Password strength indicators
- Remember me functionality

## 🛠️ Installation & Setup

### Prerequisites
- PHP 8.2+
- Laravel 12
- Composer
- Node.js & npm
- MySQL/MariaDB

### Setup Steps

1. **Clone Repository**
```bash
cd c:\xampp\htdocs\ShowTix
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Environment Configuration**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Setup**
```bash
php artisan migrate
php artisan migrate:fresh --seed  # Optional: untuk dummy data
```

5. **Build Assets**
```bash
npm run dev      # Development
npm run build    # Production
```

6. **Run Server**
```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

## 📱 Responsiveness

Frontend fully responsive untuk:
- **Mobile** (320px - 768px)
- **Tablet** (768px - 1024px)
- **Desktop** (1024px+)

Menggunakan Tailwind CSS breakpoints:
- `sm:` (640px)
- `md:` (768px)
- `lg:` (1024px)
- `xl:` (1280px)

## 🔐 Security Features

- Form validation di frontend
- CSRF protection dengan @csrf
- Session-based cart management
- User authentication middleware
- Permission checks untuk akses dashboard

## 💳 Payment Integration

Frontend siap untuk integrasi dengan payment gateway seperti:
- **Midtrans** (payment aggregator)
- **Doku** (payment platform)
- **Bank-specific** APIs

Webhook endpoint tersedia di: `/webhook/payment`

## 🎨 Component Reusability

### Custom CSS Classes (Tailwind)
```css
.btn-primary       /* Blue primary button */
.btn-outline-primary /* Blue outline button */
.btn-orange        /* Orange CTA button */
.badge-orange      /* Orange badge */
.badge-blue        /* Blue badge */
.card-concert      /* Concert card styling */
.gradient-text     /* Gradient text effect */
.shimmer           /* Loading shimmer effect */
```

## 📊 Data Flow

```
Home (Browse)
    ↓
Concert Detail (Select & Customize)
    ↓
Add to Cart
    ↓
View Cart
    ↓
Checkout (Fill Personal Data)
    ↓
Payment (Choose Method & Pay)
    ↓
Success (Get Ticket)
    ↓
Dashboard (View Ticket & History)
```

## 🔧 Customization

### Mengubah Warna
Edit warna di `resources/views/layouts/app.blade.php`:
```css
:root {
    --primary-blue: #003D82;
    --primary-orange: #FF6600;
}
```

### Menambah Event/Concert
Data events disimpan di database `konsers` table. Admin dapat menambah via Filament Dashboard.

### Mengubah Text & Language
Semua text dapat disesuaikan di blade templates. Untuk full localization, implementasikan Laravel's localization features.

## 📈 Performance Tips

1. **Image Optimization**
   - Gunakan WebP format untuk images
   - Implement lazy loading
   - Use CDN untuk images

2. **Caching**
   - Cache concert listings
   - Cache static assets
   - Use browser caching

3. **Database Optimization**
   - Add indexes ke frequently queried fields
   - Use eager loading untuk relations

## 🐛 Troubleshooting

### Cart tidak menyimpan data?
- Pastikan sessions middleware aktif
- Check `config/session.php` settings

### Images tidak tampil?
- Pastikan images sudah ter-upload ke `storage/app/public`
- Run: `php artisan storage:link`
- Update poster path di database

### Styling tidak bekerja?
- Run: `npm run dev` untuk rebuild assets
- Clear browser cache
- Check Vite configuration

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Filament Documentation](https://filamentphp.com/docs)
- [Font Awesome Icons](https://fontawesome.com/icons)

## 👥 Team & Support

Untuk pertanyaan atau bug reports, silakan hubungi tim development.

## 📝 License

Proprietary - ShowTix Team

---

**Last Updated**: 2026-06-14
**Version**: 1.0.0
