<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, "HomePage"])->name('home');
Route::get('/about', [PageController::class, "AboutPage"])->name('about');
Route::get('/blog', [PageController::class, "BlogPage"])->name('blogs');
Route::get('/blog/{slug}', [PageController::class, "ShowBlogPage"])->name("blogs.show");

Route::get('/projects', [PageController::class, "ProjectsPage"])->name('projects');
Route::get('/projects/{project:slug}', [PageController::class, "ShowProjectPage"])->name("projects.show");

Route::get('/events', [PageController::class, "EventsPage"])->name('events');
Route::get('/events/{event:slug}', [PageController::class, "ShowEventPage"])->name('events.show');
Route::get('/ourteam', [PageController::class, "TeamPage"])->name('ourteam');
Route::get('/contact', [PageController::class, "ContactPage"])->name('contact');
// Route::get('/soon', [PageController::class, "SoonPage"])->name('soon');

Route::get('/leaderboard', [PageController::class, "LeaderboardPage"])->name('leaderboard');
Route::get('/leaderboard/week/{id}', [PageController::class, "LeaderboardPage"])->name('leaderboard.show');

Route::middleware(['auth', 'verified'])->group(function() {
        Route::prefix("dashboard")->group(function () {
            Route::get('/', function () {
                return redirect()->to('admin');
            })->name('dashboard');
        });
    }
);
Route::post('/contact/send', [MailController::class, 'send'])->name('contact.send');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
