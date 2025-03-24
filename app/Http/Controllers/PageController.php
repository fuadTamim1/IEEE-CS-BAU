<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function HomePage()
    {
        $recentPosts = Blog::with(['author', 'category'])->orderBy('created_at')->take(3)->get();
        // Path to your JSON file
        $filePath = resource_path('json/member_stories.json');

        // Read the content of the file
        $jsonContent = File::get($filePath);

        $memberStories = json_decode($jsonContent);
        return view('basetheme.home', ["posts" => $recentPosts, "memberStories" => $memberStories]);
    }

    public function AboutPage()
    {
        return view('basetheme.about');
    }

    public function TeamPage()
    {
        return view('basetheme.team');
    }

    public function BlogPage()
    {
        $blogs = Blog::with('author')->paginate(8);
    
        // Transform the items while preserving pagination
        $transformed = $blogs->getCollection()->transform(function($model) {
            $model->content = Str::of($model->content)->stripTags()->trim()->words(35, '...');
            return $model;
        });
        
        // Set the transformed collection back to the paginator
        $blogs->setCollection($transformed);
        
        return view('basetheme.blog', ['blogs' => $blogs]);
    }

    public function ProjectsPage() {
        return view('basetheme.portfolio');
    }

    public function EventsPage() {
        $events = Event::orderBy("created_at")->take(12)->get();
        return view('basetheme.events', ["events" => $events]);
    }

    public function ContactPage()
    {
        return view('basetheme.contact');
    }
}
