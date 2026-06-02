# Laravel CMS - Dokumentasi

## Deskripsi
Sistem CMS (Content Management System) lengkap untuk blog dan website yang dibangun dengan Laravel 12, Tailwind CSS v4, dan Alpine.js.

## Fitur CMS

### 1. **Manajemen Posts (Artikel)**
- Buat, edit, dan hapus artikel
- Status: Draft, Published, Scheduled
- Featured posts (artikel unggulan)
- Upload featured image
- Kategori dan tags
- SEO meta tags (title, description, keywords)
- Excerpt (ringkasan artikel)
- View counter
- Soft delete (artikel bisa dipulihkan)

### 2. **Manajemen Categories (Kategori)**
- Kategori hierarki (parent-child)
- Aktif/non-aktif kategori
- Urutan kategori
- Deskripsi kategori

### 3. **Manajemen Pages (Halaman)**
- Halaman statis (About, Contact, dll)
- Template system
- Show/hide di menu
- Urutan halaman
- SEO meta tags

### 4. **Media Library**
- Upload file (gambar, dokumen, video)
- Bulk upload
- Preview media
- Informasi file (size, type, dll)

## Struktur Database

### Tables:
1. **posts** - Menyimpan artikel blog
2. **categories** - Kategori artikel
3. **pages** - Halaman statis
4. **tags** - Tag artikel
5. **post_tag** - Relasi many-to-many posts dan tags
6. **media** - File media yang diupload
7. **users** - User/admin

## Routes CMS

### Admin Routes (prefix: /admin)
```
GET    /admin/posts              - List semua posts
GET    /admin/posts/create       - Form create post
POST   /admin/posts              - Store post baru
GET    /admin/posts/{id}         - View detail post
GET    /admin/posts/{id}/edit    - Form edit post
PUT    /admin/posts/{id}         - Update post
DELETE /admin/posts/{id}         - Delete post

GET    /admin/categories         - List semua categories
GET    /admin/categories/create  - Form create category
POST   /admin/categories         - Store category baru
GET    /admin/categories/{id}/edit - Form edit category
PUT    /admin/categories/{id}    - Update category
DELETE /admin/categories/{id}    - Delete category

GET    /admin/pages              - List semua pages
GET    /admin/pages/create       - Form create page
POST   /admin/pages              - Store page baru
GET    /admin/pages/{id}         - View detail page
GET    /admin/pages/{id}/edit    - Form edit page
PUT    /admin/pages/{id}         - Update page
DELETE /admin/pages/{id}         - Delete page

GET    /admin/media              - Media library
POST   /admin/media              - Upload file
POST   /admin/media/bulk-upload  - Bulk upload files
DELETE /admin/media/{id}         - Delete media
```

## Models & Relationships

### Post Model
```php
- belongsTo: User, Category
- belongsToMany: Tags
- Scopes: published(), featured(), draft()
```

### Category Model
```php
- belongsTo: Category (parent)
- hasMany: Category (children), Posts
- Scopes: active(), parent()
```

### Page Model
```php
- belongsTo: User
- Scopes: published(), inMenu()
```

### Tag Model
```php
- belongsToMany: Posts
```

### Media Model
```php
- belongsTo: User
- Attributes: url, humanFileSize
- Methods: isImage(), isVideo(), isDocument()
```

## Instalasi

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Konfigurasi Database
Edit file `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
```

### 4. Run Migrations
```bash
php artisan migrate
```

### 5. Seed Database (Optional)
```bash
php artisan db:seed
```

Ini akan membuat:
- Admin user (email: admin@example.com, password: password)
- Sample categories
- Sample posts
- Sample pages
- Sample tags

### 6. Create Storage Link
```bash
php artisan storage:link
```

### 7. Build Assets
```bash
npm run build
```

### 8. Run Development Server
```bash
php artisan serve
```

Atau gunakan:
```bash
composer run dev
```

## Akses CMS

### Admin Panel
Akses menu CMS di sidebar:
- **Posts** - `/admin/posts`
- **Categories** - `/admin/categories`
- **Pages** - `/admin/pages`
- **Media Library** - `/admin/media`

### Default Admin Credentials (setelah seeding)
- Email: `admin@example.com`
- Password: `password`

## Fitur Keamanan

1. **CSRF Protection** - Semua form dilindungi CSRF token
2. **File Upload Validation** - Validasi tipe dan ukuran file
3. **SQL Injection Protection** - Menggunakan Eloquent ORM
4. **XSS Protection** - Blade templating auto-escape
5. **Soft Deletes** - Data tidak langsung terhapus permanen

## Customization

### Menambah Template Page Baru
Edit controller `PageController.php` dan tambahkan template di validation rules.

### Menambah Status Post Baru
Edit migration `create_posts_table.php` dan model `Post.php`.

### Menambah Field Baru
1. Buat migration baru: `php artisan make:migration add_field_to_table`
2. Update model fillable
3. Update controller validation
4. Update view form

## Best Practices

1. **Slug Generation** - Slug otomatis dibuat dari title jika tidak diisi
2. **Published Date** - Otomatis set saat status = published
3. **Image Upload** - Simpan di `storage/app/public/posts` atau `storage/app/public/media`
4. **SEO** - Selalu isi meta title, description, dan keywords
5. **Categories** - Gunakan kategori parent untuk organisasi yang lebih baik

## Troubleshooting

### Error: Class not found
```bash
composer dump-autoload
```

### Error: Permission denied (storage)
```bash
chmod -R 775 storage bootstrap/cache
```

### Error: Storage link not working
```bash
php artisan storage:link
```

### Error: NPM build failed
```bash
rm -rf node_modules package-lock.json
npm install
npm run build
```

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Tailwind CSS v4, Alpine.js
- **Database**: MySQL/PostgreSQL/SQLite
- **Build Tool**: Vite
- **Template Engine**: Blade

## Lisensi

Mengikuti lisensi Laravel dan TailAdmin template.

## Support

Untuk pertanyaan dan dukungan, silakan buka issue di repository atau hubungi tim development.