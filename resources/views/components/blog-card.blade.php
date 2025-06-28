<div class="vl-blog-12-item mt-30" data-aos="fade-up" data-aos-duration="1100">
    <div class="row">
        <div class="col-lg-6">
            <div class=" vl-blog-12-thumb image-anime overflow-hidden _relative">
                <x-img :img="$blog->image ?? null" />
            </div>
        </div>
        <div class="col-lg-6">
            <div class="vl-blog-12-content heading2 h-100">
                <div class="vl-blog12-meta pb-16">
                    <a href="#" class="date"><img src="assets/img/icons/date1.svg" alt="">
                        {{ $blog->created_at->format('M d, y') }}
                    </a>
                    <a href="#" class="author"><img src="assets/img/icons/author1.svg" alt="">
                        {{ $blog->author->name }}</a>
                </div>
                <h4><a href="{{ url('blog/' . $blog->slug) }}">{{ $blog->title }}</a></h4>
                <p class="mt-16">{{ $blog->content }}</p>
                <a href=" {{ url('blog/' . $blog->slug) }}" class="learn">Read More <span
                        class="arrow1"><i class="fa-solid fa-arrow-right"></i></span><span class="arrow2"><i
                            class="fa-solid fa-arrow-right"></i></span></a>
            </div>
        </div>
    </div>
</div>
