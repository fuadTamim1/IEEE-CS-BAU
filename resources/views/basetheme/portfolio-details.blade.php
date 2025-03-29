<x-base-layout>
    <!--===== HERO AREA START =====-->

    <x-hero :title="$project->title" background="{{ asset('images/project_bg.png') }}" :breadcrumbs="[['label' => 'projects', 'url' => route('projects')], ['label' => $project->slug]]" />

    <!--===== HERO AREA START =====-->

    <!--===== PORTFOLIO DETAILS AREA START =====-->

    <div class="portfolio-details-area sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-content ml-30 md:ml-0 sm:ml-0">
                        <article>
                            <div class="details-content">
                                <div class="image d-flex mx-auto">
                                    <img class="blog-cover-image" src="{{ asset('storage/' . $project->image) }}"
                                        alt="Cybersecurity Awareness Platform">
                                </div>
                                <div class="heading2 mt-24">
                                    <h3>Project Overview</h3>
                                    <p class="mt-16">{{ $project->description }}</p>
                                </div>

                                <div class="heading2 mt-24 lh-lg fs-5">
                                    {!! $project->content !!}
                                </div>
                            </div>

                        </article>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar-area">
                        {{-- <div class="_sidebar-widget _search">
                            <h3>Search</h3>
                            <form action="#" class="_relative">
                                <input type="search" placeholder="Search...">
                                <button><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div> --}}
                        <div class="_sidebar-widget _portfolio mt-40">
                            <h3>Portfolio Details</h3>
                            <div class="portfolio-list">
                                <ul>
                                    <li>Created By:
                                        @foreach (explode(',', $project->created_by) as $m)
                                            <span class="ms-0.5 mt-0.5 p-1">{{ $m }}
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            </span>
                                        @endforeach
                                    </li>
                                    <li>Category: <span>{{ $project->category->title }}</span></li>
                                    <li>Timeframe:
                                        <span>{{ $project->timeframe ? \Carbon\Carbon::parse($project->timeframe)->format('d M Y') : 'No Date' }}</span>
                                    </li>
                                    <li>Location: <span>{{ Str::limit($project->location, 100, '...') }}</span></li>
                                    <li>Cost: <span>{{ '$' . number_format($project->cost, 2) ?? 'N/A' }}</span></li>
                                </ul>
                            </div>
                        </div>

                        {{-- <div class="_sidebar-widget _contact mt-40">
                            <h3>Get A Free Quote</h3>
                            <div class="_contact-form mt-10">
                                <form action="#">
                                    <input type="text" placeholder="Your Name">
                                    <input type="email" placeholder="Email Address">
                                    <input type="number" placeholder="Phone Number">
                                    <textarea rows="5" placeholder="Your Message"></textarea>

                                    <button class="theme-btn3 mt-20" type="submit">Send <span class="arrow1"><i
                                                class="fa-solid fa-arrow-right"></i></span><span class="arrow2"><i
                                                class="fa-solid fa-arrow-right"></i></span></button>
                                </form>
                            </div>
                        </div> --}}

                    </div>
                </div>
                <div class="details-content mt-5">
                    <div class="details-social-tags">
                        <div class="tags">
                            <ul>
                                <li class="text"> Tags:</li>
                                @foreach ($project->tags as $t)
                                    <li class="tag mb-2"><a href="#{{ $t }}">#{{ $t }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="social-icons">
                            <ul>
                                <li class="text">Share:</li>
                                <li class="icon">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                        target="_blank">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="icon">
                                    <a href="https://www.instagram.com/?url={{ urlencode(url()->current()) }}"
                                        target="_blank">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="icon">
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($project->title ?? 'Check this out!') }}"
                                        target="_blank">
                                        <i class="fa-brands fa-x-twitter"></i>
                                    </a>
                                </li>
                                <li class="icon">
                                    <a href="https://www.linkedin.com/shareArticle?url={{ urlencode(url()->current()) }}&title={{ urlencode($project->title ?? 'Interesting Read') }}"
                                        target="_blank">
                                        <i class="fa-brands fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===== PORTFOLIO DETAILS AREA END =====-->

    <!--===== PORTFOLIO AREA START =====-->

    <div class="portfolio sp sec-bg1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto text-center">
                    <div class="heading2">
                        <h2>More Portfolio</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                @foreach ($otherProjects as $project)
                    <x-project-card :project="$project" />
                @endforeach
            </div>
        </div>
    </div>

    <!--===== PORTFOLIO AREA END =====-->
</x-base-layout>
