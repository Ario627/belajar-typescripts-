# Laravel Web Portfolio

A complete web portfolio application built with Laravel 11 featuring project management, authentication, and a beautiful frontend.

## 🎯 Features

### Public Features
- **Homepage**: Showcases featured projects with modern design
- **Portfolio Listing**: Browse all projects with pagination and search
- **Project Details**: Detailed view of each project with related projects
- **About Page**: Profile, skills, and experience information
- **Contact Form**: Functional contact form with validation

### Admin Features
- **Dashboard**: Statistics overview (total, published, draft projects)
- **Project Management**: Full CRUD operations for portfolio projects
- **Authentication**: Secure login/register system
- **Image Upload**: Upload project images
- **Soft Deletes**: Restore deleted projects
- **Authorization**: Policy-based access control

### Technical Features
- **Search**: Real-time project search
- **Pagination**: Optimized listing with pagination
- **Responsive Design**: Mobile-friendly with Tailwind CSS
- **Featured Projects**: Highlight important projects
- **Technology Tags**: Categorize projects by technologies used
- **Project Status**: Draft, Published, Archived states
- **Comprehensive Comments**: Indonesian comments for learning

## 📋 Requirements

- PHP 8.3+
- Composer
- SQLite (default) or MySQL/PostgreSQL

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Ario627/belajar-typescripts-.git
   cd belajar-typescripts-
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   php artisan storage:link
   ```

5. **Start development server**
   ```bash
   php artisan serve
   ```

6. **Access the application**
   - Website: http://localhost:8000
   - Admin: http://localhost:8000/login

## 🔑 Demo Credentials

- **Email**: admin@portfolio.com
- **Password**: password

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   ├── PortfolioController.php
│   │   ├── ContactController.php
│   │   ├── Auth/
│   │   │   ├── LoginController.php
│   │   │   └── RegisterController.php
│   │   └── Admin/
│   │       └── ProjectController.php
│   ├── Models/
│   │   ├── Project.php
│   │   └── User.php
│   └── Policies/
│       └── ProjectPolicy.php
├── database/
│   ├── migrations/
│   │   └── 2025_11_09_045015_create_projects_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── ProjectSeeder.php
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── home.blade.php
│   ├── about.blade.php
│   ├── contact.blade.php
│   ├── portfolio/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   └── projects/
│   │       ├── index.blade.php
│   │       ├── create.blade.php
│   │       ├── edit.blade.php
│   │       └── _form.blade.php
│   └── errors/
│       ├── 404.blade.php
│       └── 500.blade.php
└── routes/
    └── web.php
```

## 🎓 Learning Resources

This project is designed for learning Laravel. Every file includes comprehensive comments explaining:

- **Eloquent ORM**: Models, relationships, scopes, accessors
- **Routing**: Resource routes, route groups, middleware
- **Controllers**: CRUD operations, validation, authorization
- **Blade Templates**: Layouts, components, directives
- **Authentication**: Login, register, logout functionality
- **Authorization**: Policies for access control
- **Database**: Migrations, seeders, relationships
- **File Upload**: Handling image uploads
- **Pagination**: Laravel's built-in pagination
- **Search**: Query filtering and search

## 🛠️ Technologies

- **Framework**: Laravel 11.46.1
- **PHP**: 8.3.6
- **Frontend**: Blade Templates, Tailwind CSS
- **Database**: SQLite (default)
- **Authentication**: Laravel built-in
- **Authorization**: Laravel Policies

## 📝 Routes

### Public Routes
- `GET /` - Homepage
- `GET /about` - About page
- `GET /portfolio` - Portfolio listing
- `GET /portfolio/{project}` - Project detail
- `GET /contact` - Contact form
- `POST /contact` - Submit contact form

### Auth Routes
- `GET /login` - Login form
- `POST /login` - Process login
- `GET /register` - Register form
- `POST /register` - Process registration
- `POST /logout` - Logout

### Admin Routes (Protected)
- `GET /admin` - Admin dashboard
- `GET /admin/projects` - Manage projects
- `GET /admin/projects/create` - Create project form
- `POST /admin/projects` - Store new project
- `GET /admin/projects/{project}/edit` - Edit project form
- `PUT /admin/projects/{project}` - Update project
- `DELETE /admin/projects/{project}` - Delete project
- `POST /admin/projects/{id}/restore` - Restore deleted project

## 🔧 Configuration

### Database
The application uses SQLite by default. To use MySQL/PostgreSQL:

1. Update `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=portfolio
   DB_USERNAME=root
   DB_PASSWORD=
   ```

2. Run migrations again:
   ```bash
   php artisan migrate:fresh --seed
   ```

### File Uploads
Images are stored in `storage/app/public/projects`. Make sure to run:
```bash
php artisan storage:link
```

## 🤝 Contributing

Feel free to submit issues and pull requests.

## 📄 License

This project is open-source and available under the MIT License.

## 👨‍💻 Author

Created as a learning project for Laravel development with comprehensive Indonesian comments.

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- PHP Community
