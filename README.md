<p align="center">
    <img src="https://raw.githubusercontent.com/ryzz123/art/main/20240902_234414.png" width="400" alt="Lumenity Logo">
</p>

<p align="center">
    <a href="https://packagist.org/packages/lumenity/framework"><img src="https://img.shields.io/packagist/dt/lumenity/framework" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/lumenity/framework"><img src="https://img.shields.io/packagist/v/lumenity/framework" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/lumenity/framework"><img src="https://img.shields.io/packagist/l/lumenity/framework" alt="License"></a>
</p>

Lumenity Framework adalah framework PHP yang dirancang sederhana, cepat, dan mudah digunakan. Ini dirancang untuk
menjadi kerangka kerja ringan yang dapat digunakan untuk membangun aplikasi web dengan cepat dan mudah. Ini dirancang
agar fleksibel dan dapat diperluas, sehingga Anda dapat dengan mudah menambahkan fitur dan fungsionalitas baru ke
aplikasi web Anda.

### Kebutuhan

- PHP ^8.2 atau lebih tinggi
- Composer
- Apache atau Nginx
- MySQL atau MariaDB
- Node.js dan NPM 
- Git

### Pemasangan

Untuk menginstal Lumenity Framework, Anda harus menginstal PHP ^8.2 atau lebih tinggi di sistem Anda. Anda juga perlu
menginstal Komposer di sistem Anda. Anda dapat menginstal Composer dengan mengikuti petunjuk di situs Composer. Setelah
Anda menginstal Composer, Anda dapat menginstal Lumenity Framework dengan menjalankan perintah berikut di terminal Anda

```bash
composer create-project lumenity/framework
```

Ini akan membuat direktori baru bernama `framework` di direktori kerja Anda saat ini dan menginstal Lumenity Framework di
direktori tersebut.

### Konfigurasi

Setelah Anda menginstal Lumenity Framework, Anda perlu mengonfigurasinya agar berfungsi dengan server web dan database
Anda. Anda dapat melakukan ini dengan mengedit file `.env` di direktori `app`. Anda dapat mengonfigurasi pengaturan
koneksi database, URL dasar aplikasi web Anda, dan pengaturan lainnya dalam file ini.

```bash
php artisan serve
```

Ini akan memulai server web di `http:127.0.0.1:3000` yang melayani aplikasi web Anda.
