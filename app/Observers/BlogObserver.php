<?php

namespace App\Observers;

use App\Mail\newPost;
use App\Models\Blog;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BlogObserver
{
    /**
     * Handle the Blog "created" event.
     */
    public function created(Blog $blog): void
    {
        if (get_setting("enable_sending_emails"))
            Mail::to('user@example.com')->send(new newPost());
        // Notification::make()->title("sending email success!")->success()->send();
        Log::info('Blog Post Created:', ['id' => $blog->id]);
    }

    /**
     * Handle the Blog "updated" event.
     */
    public function updated(Blog $blog): void
    {
        Log::info('Blog Post Updated:', ['id' => $blog->id]);
        // Notification::make()->title("done!")->body("updated Blog $blog->id Success.")->send();
    }

    /**
     * Handle the Blog "deleted" event.
     */
    public function deleted(Blog $blog): void
    {
        Log::info('Blog Post Deleted:', ['id' => $blog->id]);
    }

    /**
     * Handle the Blog "restored" event.
     */
    public function restored(Blog $blog): void
    {
        //
    }

    /**
     * Handle the Blog "force deleted" event.
     */
    public function forceDeleted(Blog $blog): void
    {
        //
    }
}
