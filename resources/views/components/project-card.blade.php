<div class="col-lg-4 col-md-6">
    <div class="portfolio-box">
        <div class="image-area">
            <div class="image">
                <img src="{{ asset('storage/'.$project->image) }}" alt="">
            </div>
            <a href="{{ url('projects/' . $project->slug) }}" class="arrow"><i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="content-area">
            <span>{{ $project->category->title }}</span>
            <a href="{{ url('projects/' . $project->slug) }}">{{ $project->title }}</a>
        </div>
    </div>
</div>
