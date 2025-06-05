# IEEE CS Platform – BAU Chapter

![Cover Image]([[https://github.com/fuadTamim1/IEEE-CS-BAU/tree/main/public/assets/img/screenshot.jpg](https://github.com/fuadTamim1/IEEE-CS-BAU/blob/main/public/assets/img/screenshot.jpg?raw=true)](https://raw.githubusercontent.com/fuadTamim1/IEEE-CS-BAU/refs/heads/main/public/assets/img/screenshot.jpg))

## Summary

The IEEE CS platform for our college chapter is a website designed to centralize and showcase the chapter’s information, activities, projects, events, and workshops. It helps members organize their work, collaborate more efficiently, and stay informed about ongoing efforts within the community.

---

## Tools Used

### Planning

* Trello – Task and project management
* Miro – Brainstorming and visual collaboration

### Backend

* Laravel (PHP) – Framework for handling routing, logic, and APIs
* MySQL – Relational database for data storage and queries

### Frontend

* HTML, CSS, JavaScript – Structure, design, and basic interactivity
* Blade Template Engine – Used with Laravel to create dynamic content

---

## How to Run the Project

You can set up and run this project locally by following these steps:

### 1. Clone the Repository

```bash
git clone https://github.com/fuadTamim1/IEEE-CS-BAU.git
cd IEEE-CS-BAU
```

### 2. Install Dependencies

Make sure PHP, Composer, and MySQL are installed on your machine.

```bash
composer install
```

### 3. Set Up Environment Configuration

Copy the example environment file:

```bash
cp .env.example .env
```

Then edit the `.env` file to match your local database settings:

```
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### 4. Generate the Application Key

```bash
php artisan key:generate
```

### 5. Run Migrations and Seed Data

```bash
php artisan migrate --seed
```

### 6. Serve the Application

```bash
php artisan serve
```

The application should now be running at: `http://127.0.0.1:8000`

---

## Project Status

This project is still under active development. Feedback and suggestions are always welcome.
