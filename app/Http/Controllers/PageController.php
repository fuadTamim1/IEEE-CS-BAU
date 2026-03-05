<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Event;
use App\Models\Leaderboard;
use App\Models\Member;
use App\Models\Project;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function HomePage()
    {
        $recentPosts = Blog::with(['author', 'category'])->orderBy('created_at')->take(4)->get(["id", "title", "slug", "image", "created_at", "author_id"]);
        $recentEvents = Event::orderBy('created_at')->take(5)->get(['id', 'title', 'image', 'slug', 'description', 'created_at']);


        // Path to your JSON file
        $filePath = resource_path('json/member_stories.json');

        // Read the content of the file
        $jsonContent = File::get($filePath);
        $members = $this->getMembers();

        // $memberStories = json_decode($jsonContent);
        // $memberStories = json_decode($jsonContent);
        return view('basetheme.home', ["posts" => $recentPosts, "members" => $members, "events" => $recentEvents]);
    }

    private function getMembers()
    {
        if (get_setting("show_only_team_admins")) {
            return Member::where("title", "!=", "Member")->orderBy("order", "DESC")->get();
        } else {
            return Member::all();
        }
    }

    public function AboutPage()
    {
        $members = $this->getMembers();
        return view('basetheme.about', ["members" => $members]);
    }

    public function TeamPage()
    {
        $members = $this->getMembers();
        return view('basetheme.team', ["members" => $members]);
    }

    public function BlogPage()
    {
        $blogs = Blog::with('author')->paginate(8);

        // Transform the items while preserving pagination
        $transformed = $blogs->getCollection()->transform(function ($model) {
            $model->content = Str::of($model->content)->stripTags()->trim()->words(35, '...');
            return $model;
        });

        // Set the transformed collection back to the paginator
        $blogs->setCollection($transformed);

        return view('basetheme.blog', ['blogs' => $blogs]);
    }

    public function ShowBlogPage($slug)
    {
        $blog = Blog::whereSlug($slug)->with('author')->first();
        $otherBlogs = Blog::where("slug", "!=", $slug)->latest()->with('author:id,name')->take(2)->get(["slug", "title", "image", "created_at"]);

        $blog->tags = explode(",", $blog->tags);

        return view('basetheme.blog-details', ['blog' => $blog, 'otherBlogs' => $otherBlogs]);
    }

    public function ProjectsPage()
    {
        return view('basetheme.portfolio');
    }

    public function ShowProjectPage(Project $project)
    {
        $project->tags = explode(',', $project->tags);
        $otherProjects = Project::where("slug", "!=", $project->slug)->latest()->take(3)->get(["slug", "title", "image", "category_id", "created_at"])
            ->load(['category:id,title']);;
        return view('basetheme.portfolio-details', ['project' => $project, 'otherProjects' => $otherProjects]);
    }

    public function EventsPage()
    {
        $events = Event::orderBy("created_at", "DESC")->take(12)->get();
        return view('basetheme.events', ["events" => $events]);
    }

    public function ShowEventPage(Event $event)
    {
        $otherEvents = Event::where("slug", "!=", $event->slug)->latest()->take(4)->get(["id", "title", "slug", "image"]);
        return view('basetheme.event-details1', ["event" => $event, "otherEvents" => $otherEvents]);
    }

    public function LeaderBoardPage($id = -1)
    {
        // Only eager load the member relationships that are needed in the view


        if (Leaderboard::count() > 0) {
            $currentLeaderboardQuery = Leaderboard::with(['member1', 'member2', 'member3']);
            if (Leaderboard::where('id', $id)->exists()) {
                $currentLeaderboard = $currentLeaderboardQuery->find($id);
            } else {
                $currentLeaderboard = $currentLeaderboardQuery->latestWeek();
            }

            $leaderboards = Leaderboard::with(['member1', 'member2', 'member3']) // Load relationships
                ->limit(15)
                ->where("id", "!=", $currentLeaderboard->id)
                ->select(['id', 'week_start_date', 'publish_at', 'member_1_id', 'member_2_id', 'member_3_id'])
                ->get();
        } else {
            $leaderboards = collect();
            $currentLeaderboard = null;
        }

        return view('basetheme.leaderboard', [
            "currentLeaderboard" => $currentLeaderboard,
            "leaderboards" => $leaderboards
        ]);
    }

    public function WorkshopsPage()
    {
        // Workshop        

        return view('basetheme.workshops');
    }

    public function ResourcesPage()
    {
        return view('basetheme.workshops');
    }


    public function ContactPage()
    {
        return view('basetheme.contact');
    }
}
