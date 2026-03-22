<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Event;
use App\Models\Leaderboard;
use App\Models\Member;
use App\Models\Project;
use App\Models\Workshop;
use App\Models\WorkshopFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function HomePage()
    {
        $recentPosts = Blog::published()
            ->with(['author', 'authorMember', 'category'])
            ->latest('created_at')
            ->take(4)
            ->get(["id", "title", "slug", "image", "created_at", "author_id", "author_member_id", "status"]);
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
        return Member::query()
            ->orderByDesc('order')
            ->orderBy('name')
            ->get();
    }

    public function AboutPage()
    {
        $members = $this->getMembers();
        return view('basetheme.about', ["members" => $members]);
    }

    public function TeamPage()
    {
        $allMembers = $this->getMembers();

        $committeeMembers = $allMembers->filter(function (Member $member) {
            return strcasecmp((string) $member->title, 'Member') !== 0;
        })->values();

        $regularMembers = $allMembers->filter(function (Member $member) {
            return strcasecmp((string) $member->title, 'Member') === 0;
        })->values();

        return view('basetheme.team', [
            'committeeMembers' => $committeeMembers,
            'regularMembers' => $regularMembers,
        ]);
    }

    public function BlogPage()
    {
        $blogs = Blog::published()->with(['author', 'authorMember'])->paginate(8);

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
        $blog = Blog::published()->whereSlug($slug)->with(['author', 'authorMember'])->firstOrFail();

        $otherBlogs = Blog::published()
            ->where("slug", "!=", $slug)
            ->latest()
            ->with(['author:id,name', 'authorMember:id,name'])
            ->take(2)
            ->get(["slug", "title", "image", "created_at", "author_id", "author_member_id"]);

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
        $status = request('status', 'all');
        $now = Carbon::now();

        $baseQuery = Workshop::published();
        $workshopsQuery = (clone $baseQuery);

        if ($status === 'upcoming') {
            $workshopsQuery->whereNotNull('start_at')->where('start_at', '>', $now);
        } elseif ($status === 'ongoing') {
            $workshopsQuery->whereNotNull('start_at')->where('start_at', '<=', $now)
                ->where(function ($query) use ($now) {
                    $query->whereNull('end_at')->orWhere('end_at', '>=', $now);
                });
        } elseif ($status === 'past') {
            $workshopsQuery->where(function ($query) use ($now) {
                $query->where('end_at', '<', $now)
                    ->orWhere(function ($q) use ($now) {
                        $q->whereNull('end_at')->whereNotNull('start_at')->where('start_at', '<', $now);
                    });
            });
        }

        $workshops = $workshopsQuery->latest('start_at')->latest('created_at')->paginate(9)->withQueryString();

        $totalPublishedCount = (clone $baseQuery)->count();
        $upcomingCount = (clone $baseQuery)->whereNotNull('start_at')->where('start_at', '>', $now)->count();
        $ongoingCount = (clone $baseQuery)->whereNotNull('start_at')->where('start_at', '<=', $now)
            ->where(function ($query) use ($now) {
                $query->whereNull('end_at')->orWhere('end_at', '>=', $now);
            })->count();
        $pastCount = (clone $baseQuery)->where(function ($query) use ($now) {
            $query->where('end_at', '<', $now)
                ->orWhere(function ($q) use ($now) {
                    $q->whereNull('end_at')->whereNotNull('start_at')->where('start_at', '<', $now);
                });
        })->count();

        return view('basetheme.workshops', [
            'workshops' => $workshops,
            'activeStatus' => $status,
            'totalPublishedCount' => $totalPublishedCount,
            'upcomingCount' => $upcomingCount,
            'ongoingCount' => $ongoingCount,
            'pastCount' => $pastCount,
        ]);
    }

    public function ShowWorkshopPage(Workshop $workshop)
    {
        abort_if(!$workshop->is_published, 404);

        $relatedWorkshops = Workshop::published()
            ->where('id', '!=', $workshop->id)
            ->latest('start_at')
            ->take(3)
            ->get();

        $feedback = $workshop->feedback()->with('user:id,name')->paginate(8);

        return view('basetheme.workshop-details', [
            'workshop' => $workshop,
            'relatedWorkshops' => $relatedWorkshops,
            'feedback' => $feedback,
        ]);
    }

    public function SubmitWorkshopFeedback(Request $request, Workshop $workshop)
    {
        $validated = $request->validate([
            'author_name' => ['nullable', 'string', 'max:90'],
            'author_email' => ['nullable', 'email', 'max:190'],
            'rating' => ['nullable', 'integer', 'between:1,5'],
            'comment' => ['required', 'string', 'min:6', 'max:2000'],
        ]);

        if (!Auth::check() && empty($validated['author_name'])) {
            return back()->withErrors([
                'author_name' => 'Please provide your name to submit feedback.',
            ])->withInput();
        }

        $authUser = Auth::user();

        WorkshopFeedback::create([
            'workshop_id' => $workshop->id,
            'user_id' => $authUser?->id,
            'author_name' => $authUser?->name ?? $validated['author_name'] ?? null,
            'author_email' => $authUser?->email ?? $validated['author_email'] ?? null,
            'rating' => $validated['rating'] ?? null,
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Thanks for your feedback.');
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
