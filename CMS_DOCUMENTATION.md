# Laravel Blog CMS - Dokumentasi Lengkap

## Ringkasan
CMS Blog berbasis Laravel 12 dengan template TailAdmin yang telah terintegrasi. Sistem ini menyediakan fitur lengkap untuk mengelola blog dan website dengan antarmuka admin yang modern.

## Fitur Utama

### 1. **Manajemen Posts**
- Create, Read, Update, Delete (CRUD) posts
- Kategori dan tags untuk organisasi konten
- Featured posts
- Status: Draft, Published, Scheduled
- Featured image upload
- View counter
- SEO-friendly slugs

### 2. **Manajemen Categories**
- CRUD categories
- Deskripsi kategori
- Tracking jumlah posts per kategori
- Auto-generate slug

### 3. **Manajemen Pages**
- CRUD static pages
- Status: Draft, Published
- Custom slugs
- View counter

### 4. **Manajemen Media**
- Upload dan kelola file media
- Support berbagai tipe file (image, document, video, audio)
- Tracking ukuran file
- Metadata lengkap

### 5. **Blog Frontend**
- Homepage dengan daftar posts
- Single post view
- Category archive
- Tag archive
- Static pages
- Responsive design

## Struktur Database

### Tables
1. **users** - User authentication
2. **categories** - Post categories
3. **posts** - Blog posts
4. **pages** - Static pages
5. **tags** - Post tags
6. **post_tag** - Many-to-many relationship
7. **media** - Media library

## Routes

### Admin Routes (Prefix: /admin)
```
GET    /admin/posts              - List all posts
GET    /admin/posts/create       - Create post form
POST   /admin/posts              - Store new post
GET    /admin/posts/{id}         - View post
GET    /admin/posts/{id}/edit    - Edit post form
PUT    /admin/posts/{id}         - Update post
DELETE /admin/posts/{id}         - Delete post

GET    /admin/categories         - List all categories
POST   /admin/categories         - Store new category
GET    /admin/categories/{id}/edit - Edit category
PUT    /admin/categories/{id}    - Update category
DELETE /admin/categories/{id}    - Delete category

GET    /admin/pages              - List all pages
GET    /admin/pages/create       - Create page form
POST   /admin/pages              - Store new page
GET    /admin/pages/{id}         - View page
GET    /admin/pages/{id}/edit    - Edit page form
PUT    /admin/pages/{id}         - Update page
DELETE /admin/pages/{id}         - Delete page

GET    /admin/media              - List all media
POST   /admin/media              - Upload media
DELETE /admin/media/{id}         - Delete media
```

### Public Routes
```
GET    /                         - Blog homepage
GET    /post/{slug}              - Single post
GET    /category/{slug}          - Category archive
GET    /tag/{slug}               - Tag archive
GET    /page/{slug}              - Static page
```

## Models & Relationships

### Post Model
- belongsTo: Category, User
- belongsToMany: Tags
- hasMany: Media (polymorphic)

### Category Model
- hasMany: Posts

### Page Model
- belongsTo: User
- hasMany: Media (polymorphic)

### Tag Model
- belongsToMany: Posts

### Media Model
- morphTo: Mediable (Post or Page)

## Controllers

### Admin Controllers
1. **PostController** - Mengelola posts
2. **CategoryController** - Mengelola categories
3. **PageController** - Mengelola pages
4. **MediaController** - Mengelola media

### Public Controllers
1. **BlogController** - Menampilkan blog frontend

## Views

### Admin Views (resources/views/admin/)
```
posts/
  ├── index.blade.php    - List posts
  ├── create.blade.php   - Create post form
  ├── edit.blade.php     - Edit post form
  └── show.blade.php     - View post details

categories/
  └── index.blade.php    - List & manage categories

pages/
  ├── index.blade.php    - List pages
  └── form.blade.php     - Create/Edit page form
```

### Public Views (resources/views/blog/)
```
├── layout.blade.php     - Main layout
├── index.blade.php      - Homepage
├── show.blade.php       - Single post
├── category.blade.php   - Category archive
├── tag.blade.php        - Tag archive
└── page.blade.php       - Static page
```

## Instalasi & Setup

### 1. Clone & Install Dependencies
```bash
composer install
npm install
```

### 2. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Configuration
Edit `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Run Migrations & Seed
```bash
php artisan migrate:fresh --seed
```

### 5. Storage Link
```bash
php artisan storage:link
```

### 6. Build Assets
```bash
npm run build
```

### 7. Start Development Server
```bash
php artisan serve
```

## Default Credentials

Setelah seeding, gunakan kredensial berikut untuk login:
- **Email**: admin@example.com
- **Password**: password

## Sample Data

Seeder akan membuat:
- 1 Admin user
- 5 Categories (Technology, Travel, Food, Lifestyle, Business)
- 20 Posts dengan konten sample
- 5 Pages (About, Contact, Privacy Policy, Terms of Service, FAQ)
- 10 Tags
- Relasi posts-tags secara random

## Fitur Tambahan

### 1. Auto-Generate Slugs
Slug otomatis dibuat dari title menggunakan JavaScript di form

### 2. View Counter
Setiap kali post/page dibuka, view counter akan bertambah

### 3. Featured Posts
Posts dapat ditandai sebagai featured untuk highlight di homepage

### 4. Status Management
- **Draft**: Belum dipublikasikan
- **Published**: Sudah dipublikasikan
- **Scheduled**: Dijadwalkan untuk publish

### 5. SEO Friendly
- Clean URLs dengan slugs
- Meta descriptions (excerpt)
- Proper heading structure

## Helper Functions

### MenuHelper
Located in `app/Helpers/MenuHelper.php`
- `getCategories()` - Get all categories with post count
- `getRecentPosts($limit)` - Get recent published posts
- `getTags()` - Get all tags with post count

## Customization

### Mengubah Template
Template menggunakan TailAdmin. Untuk customization:
1. Edit file di `resources/views/layouts/`
2. Modify Tailwind classes sesuai kebutuhan
3. Run `npm run build` untuk compile

### Menambah Field Baru
1. Buat migration: `php artisan make:migration add_field_to_table`
2. Update model dengan fillable/casts
3. Update controller validation
4. Update views dengan field baru

### Menambah Fitur
1. Buat controller: `php artisan make:controller FeatureController`
2. Tambahkan routes di `routes/web.php`
3. Buat views di `resources/views/`
4. Update navigation jika perlu

## Best Practices

1. **Validation**: Selalu validate input di controller
2. **Authorization**: Implement policies untuk access control
3. **Image Optimization**: Compress images sebelum upload
4. **Caching**: Cache queries yang sering digunakan
5. **Backup**: Regular database backups
6. **Security**: Keep Laravel dan dependencies updated

## Troubleshooting

### Error: View not found
```bash
php artisan view:clear
php artisan config:clear
```

### Error: Storage link
```bash
php artisan storage:link
```

### Error: Permission denied
```bash
chmod -R 775 storage bootstrap/cache
```

## Development Roadmap

### Phase 1 (Current) ✅
- Basic CMS functionality
- Posts, Categories, Pages management
- Blog frontend
- Media library

### Phase 2 (Future)
- User roles & permissions
- Comments system
- Search functionality
- RSS feed
- Sitemap generation

### Phase 3 (Future)
- Multi-language support
- Advanced SEO tools
- Analytics dashboard
- Email notifications
- Social media integration

## Support & Documentation

- Laravel Documentation: https://laravel.com/docs
- TailAdmin Documentation: Check template files
- Tailwind CSS: https://tailwindcss.com/docs

## License

This CMS is built on Laravel framework which is open-sourced software licensed under the MIT license.

---

**Created with Laravel 12 & TailAdmin Template**
**Version: 1.0.0**
**Last Updated: May 29, 2026**