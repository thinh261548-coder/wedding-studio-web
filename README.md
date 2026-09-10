# Wedding Studio Website

Professional Wedding Studio Website built with PHP + MySQL, featuring Admin Panel and responsive design.

## Features

### User Features
- User registration & login
- Browse wedding packages
- View gallery with multiple images
- Book appointment/inquiry
- User dashboard
- Responsive design

### Admin Features
- Complete CRUD operations
- Manage packages, galleries, services
- User management
- Inquiry management
- Upload multiple images
- Rich text editor for content
- Dashboard analytics

## Technology Stack
- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5
- **Editor**: TinyMCE

## Installation

1. Clone the repository
2. Create database from `database/schema.sql`
3. Configure `.env` file
4. Run the application

## Project Structure
```
├── public/
│   ├── index.php
│   ├── uploads/
│   └── assets/
├── app/
│   ├── config/
│   ├── controllers/
│   ├── models/
│   └── views/
├── admin/
│   ├── index.php
│   ├── controllers/
│   └── views/
├── database/
│   └── schema.sql
└── .env.example
```
