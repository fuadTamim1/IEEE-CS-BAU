<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Route as RouteObject;

Route::macro('underDevelopment', function (bool $enabled = false) {
    if ($enabled && $this instanceof RouteObject) {
        $this->middleware('under.development');
    }
    return $this;
});

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

Route::middleware(['under.development'])->group(function() {
    Route::get('/workshops', [PageController::class, "WorkshopsPage"])->name("workshops");
    Route::get('/resources', [PageController::class, "ResourcesPage"])->name("resources");
});


// Route::middleware(['auth', 'verified'])->group(function() {
//         Route::prefix("dashboard")->group(function () {
//             // Route::get('/', function () {
//             //     return redirect()->to('admin');
//             // })->name('dashboard');
//         });
//     }
// );
Route::post('/contact/send', [MailController::class, 'send'])->name('contact.send');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// In routes/web.php

Route::get('/test-filament', function () {
    return \App\Models\User::first()?->canAccessPanel(app(\Filament\Panel::class))
        ? 'Has access'
        : 'Access denied';
});

Route::view('/coming-soon', 'basetheme.coming-soon')->name('coming-soon');

require __DIR__ . '/auth.php';
