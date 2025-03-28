<x-base-layout>
    <!--===== HERO AREA START =====-->
    <x-hero :title="$blog->title" :breadcrumbs="[['label' => 'Blog', 'url' => route('blogs')], ['label' => $blog->title]]" />


    <!--===== HERO AREA START =====-->

    <!--===== BLOG DETAILS AREA START =====-->

    <div class="blog-details-area sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="blog-details-content">
                        <article>
                            <div class="details-content">
                                <div class="image">
                                    <img class="blog-cover-image" src="{{ asset('storage/' . $blog->image) }}"
                                        alt="blog image">
                                </div>
                                <div class="vl-blog12-meta mt-24">
                                    <a href="#" class="date"><img src="assets/img/icons/date1.svg"
                                            alt=""> {{ $blog->created_at->format('m/d/y') }} </a>
                                    <a href="#" class="author"><img src="assets/img/icons/author1.svg"
                                            alt=""> {{ $blog->author->name }}</a>
                                </div>
                            </div>
                        </article>

                        <article>
                            <div class="details-content mt-40 lh-lg fs-5">
                                {!! $blog->content !!}
                            </div>
                        </article>


                        {{-- Quote --}}
                        {{-- <div class="details-author-area mt-40">
                            <p>"The future belongs to those who embrace change, innovate with purpose, and build
                                solutions that inspire progress."</p>
                            <div class="author-info">
                                <div class="thumb">
                                    <img src="assets/img/blog/details-author.png" alt="">
                                </div>
                                <div class="text">
                                    <a href="#">Alex Carey</a>
                                </div>
                            </div>
                        </div> --}}

                        <div class="details-border"></div>
                        <div class="details-content">
                            <div class="details-social-tags">
                                <div class="tags">
                                    <ul>
                                        <li class="text"> Tags:</li>
                                        @foreach ($blog->tags as $t)
                                            <li class="tag"><a href="#{{ $t }}">#{{ $t }}</a>
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
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title ?? 'Check this out!') }}"
                                                target="_blank">
                                                <i class="fa-brands fa-x-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="icon">
                                            <a href="https://www.linkedin.com/shareArticle?url={{ urlencode(url()->current()) }}&title={{ urlencode($blog->title ?? 'Interesting Read') }}"
                                                target="_blank">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- blog comments --}}
                        {{-- 
                        <div class="details-border"></div>

                        <div class="comment-area heading2">
                            <h3>Blog Comments (2)</h3>
                            <div class="details-single-comment mt-30">
                                <div class="top-area">
                                    <div class="author-area">
                                        <div class="author-image">
                                            <img src="assets/img/blog/comment-box-image1.png" alt="">
                                        </div>
                                        <div class="text">
                                            <a href="#" class="date"><img src="assets/img/icons/date1.svg"
                                                    alt=""> 8 December 2024</a>
                                            <h4><a href="#">Alex Robertson</a></h4>
                                        </div>
                                    </div>
                                    <div class="reply">
                                        <a href="#"><i class="fa-solid fa-reply"></i> Reply</a>
                                    </div>
                                </div>
                                <p>In today’s dynamic business landscape, organizations face numerous challenges that
                                    require strategic thinking and expert guidance. Business consulting serves as a
                                    crucial resource, providing companies with the insights an tools necessary.</p>
                            </div>

                            <div class="details-single-comment mt-30 ml-30 sm:ml-0">
                                <div class="top-area">
                                    <div class="author-area">
                                        <div class="author-image">
                                            <img src="assets/img/blog/comment-box-image2.png" alt="">
                                        </div>
                                        <div class="text">
                                            <a href="#" class="date"><img src="assets/img/icons/date1.svg"
                                                    alt=""> 8 December 2024</a>
                                            <h4><a href="#">Theo Hernandez</a></h4>
                                        </div>
                                    </div>
                                    <div class="reply">
                                        <a href="#"><i class="fa-solid fa-reply"></i> Reply</a>
                                    </div>
                                </div>
                                <p>At Advicx, our consulting services are tailored to meet the unique needs of each
                                    client, focusing on areas such as operational efficiency, market expansion, and
                                    digital transformation. By leveraging data analytics and.</p>
                            </div>
                        </div>


                        <div class="contact-details-form heading2 mt-40">
                            <h3>Leave a Reply</h3>
                            <p class="mt-12">Provide clear contact information, including phone number, email, and
                                address.</p>
                            <form action="#">
                                <div class="row mt-16">
                                    <div class="col-md-6">
                                        <div class="single-input">
                                            <input type="text" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input">
                                            <input type="text" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input">
                                            <input type="email" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input">
                                            <input type="number" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-input">
                                            <select class="wide">
                                                <option value="1">Service Type</option>
                                                <option value="2">Option 1</option>
                                                <option value="3">Option 2</option>
                                                <option value="4">Option 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-input">
                                            <textarea rows="5" placeholder="How can we help you?"></textarea>
                                        </div>
                                        <div class="button mt-30">
                                            <button class="theme-btn3" type="submit">Send <span class="arrow1"><i
                                                        class="fa-solid fa-arrow-right"></i></span><span
                                                    class="arrow2"><i
                                                        class="fa-solid fa-arrow-right"></i></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> --}}


                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--===== BLOG DETAILS AREA END =====-->

    <!--===== BLOG AREA START =====-->

    <div class="blog sp sec-bg1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto text-center">
                    <div class="heading2">
                        <h2>More Services</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                @foreach ($otherBlogs as $blog)
                    <div class="col-lg-6">
                        <x-blog-card :blog=$blog />
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!--===== BLOG AREA END =====-->
</x-base-layout>
