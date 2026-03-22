<article class="vl-blog-12-item ieee-blog-card mt-30" data-aos="fade-up" data-aos-duration="1100">
    <div class="row g-0 align-items-stretch">
        <div class="col-lg-5">
            <a href="{{ route('blogs.show', $blog->slug) }}" class="ieee-blog-card__thumb-link">
                <div class="vl-blog-12-thumb image-anime overflow-hidden _relative ieee-blog-card__thumb">
                    <x-img :img="$blog->image ?? null" alt="{{ $blog->title }}" />
                </div>
            </a>
        </div>
        <div class="col-lg-7">
            <div class="vl-blog-12-content heading2 h-100 ieee-blog-card__content">
                <div class="vl-blog12-meta pb-16 ieee-blog-card__meta">
                    <span class="date"><img src="{{ asset('assets/img/icons/date1.svg') }}" alt="Date icon">
                        {{ $blog->created_at->format('M d, Y') }}
                    </span>
                    <span class="author"><img src="{{ asset('assets/img/icons/author1.svg') }}" alt="Author icon">
                        {{ $blog->display_author_name }}</span>
                </div>

                <h4 class="ieee-blog-card__title">
                    <a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
                </h4>

                <p class="mt-16 ieee-blog-card__excerpt">
                    {{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 190) }}
                </p>

                <a href="{{ route('blogs.show', $blog->slug) }}" class="learn ieee-blog-card__read-more">Read More <span
                        class="arrow1"><i class="fa-solid fa-arrow-right"></i></span><span class="arrow2"><i
                            class="fa-solid fa-arrow-right"></i></span></a>
            </div>
        </div>
    </div>
</article>
