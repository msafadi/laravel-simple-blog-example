<x-front-layout title="Home Page" home="1">
    
    <!-- hero
    ================================================== -->
    <section id="hero" class="s-hero">

        <div class="s-hero__slider">

            <div class="s-hero__slide">

                <div class="s-hero__slide-bg" style="background-image: url('images/slide1-bg-3000.jpg');"></div>

                <div class="row s-hero__slide-content animate-this">
                    <div class="column">
                        <div class="s-hero__slide-meta">
                            <span class="cat-links">
                                <a href="#0">Lifestyle</a>
                                <a href="#0">Design</a>
                            </span>
                            <span class="byline"> 
                                Posted by 
                                <span class="author">
                                    <a href="#0">Jonathan Doe</a>
                                </span>
                            </span>
                        </div>
                        <h1 class="s-hero__slide-text">
                            <a href="#0">
                                Tips and Ideas to Help You Start Freelancing.
                            </a>
                        </h1>
                    </div>
                </div>

            </div> <!-- end s-hero__slide -->

            <div class="s-hero__slide">

                <div class="s-hero__slide-bg" style="background-image: url('images/slide2-bg-3000.jpg');"></div>

                <div class="row s-hero__slide-content animate-this">
                    <div class="column">
                        <div class="s-hero__slide-meta">
                            <span class="cat-links">
                                <a href="#0">Work</a>
                            </span>
                            <span class="byline"> 
                                Posted by 
                                <span class="author">
                                    <a href="#0">Juan Dela Cruz</a>
                                </span>
                            </span>
                        </div>
                        <h1 class="s-hero__slide-text">
                            <a href="#0">
                                Minimalism: The Art of Keeping It Simple.
                            </a>
                        </h1>
                    </div>
                </div>

            </div> <!-- end s-hero__slide -->

            <div class="s-hero__slide"">

                <div class="s-hero__slide-bg" style="background-image: url('images/slide3-bg-3000.jpg');"></div>

                <div class="row s-hero__slide-content animate-this">
                    <div class="column">
                        <div class="s-hero__slide-meta">
                            <span class="cat-links">
                                <a href="#0">Health</a>
                                <a href="#0">Lifestyle</a>
                            </span>
                            <span class="byline"> 
                                Posted by 
                                <span class="author">
                                    <a href="#0">Jane Doe</a>
                                </span>
                            </span>
                        </div>
                        <h1 class="s-hero__slide-text">
                            <a href="#0">
                                10 Reasons Why Being in Nature Is Good For You.
                            </a>
                        </h1>
                    </div>
                </div>

            </div> <!-- end s-hero__slide -->

        </div> <!-- end s-hero__slider -->

        <div class="s-hero__social hide-on-mobile-small">
            <p>Follow</p>
            <span></span>
            <ul class="s-hero__social-icons">
                <li><a href="#0"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                <li><a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#0"><i class="fab fa-dribbble" aria-hidden="true"></i></a></li>
            </ul>
        </div> <!-- end s-hero__social -->

        <div class="nav-arrows s-hero__nav-arrows">
            <button class="s-hero__arrow-prev">
                <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" width="15" height="15"><path d="M1.5 7.5l4-4m-4 4l4 4m-4-4H14" stroke="currentColor"></path></svg>
            </button>
            <button class="s-hero__arrow-next">
               <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" width="15" height="15"><path d="M13.5 7.5l-4-4m4 4l-4 4m4-4H1" stroke="currentColor"></path></svg>
            </button>
        </div> <!-- end s-hero__arrows -->

    </section> <!-- end s-hero -->


    <!-- content
    ================================================== -->
    <section class="s-content s-content--no-top-padding">


        <!-- masonry
        ================================================== -->
        <div class="s-bricks">

            <div class="masonry">
                <div class="bricks-wrapper h-group">

                    <div class="grid-sizer"></div>

                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    @foreach ($posts as $post)
                    <article class="brick entry" data-aos="fade-up">
        
                        <div class="entry__thumb">
                            <a href="{{ route('posts.show', $post->slug) }}" class="thumb-link">
                                <img src="{{ Storage::disk('public')->url($post->featured_image_path) }}" alt="">
                            </a>
                        </div> <!-- end entry__thumb -->
        
                        <div class="entry__text">
                            <div class="entry__header">
                                <h1 class="entry__title"><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h1>
        
                                <div class="entry__meta">
                                    <span class="byline"">By:
                                        <span class='author'>
                                            <a href="#0">{{ $post->user->name }}</a>
                                    </span>
                                </span>
                                    <span class="cat-links">
                                        @foreach ($post->categories as $category)
                                        <a href="#">{{ $category->title }}</a> 
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                            <div class="entry__excerpt">
                                <p>{{ $post->content }}</p>
                            </div>
                            <a class="entry__more-link" href="{{ route('posts.show', $post->slug) }}">Read More</a>
                        </div> <!-- end entry__text -->
        
                    </article> <!-- end entry -->
                    @endforeach

                </div> <!-- end brick-wrapper -->

            </div> <!-- end masonry -->

            <div class="row">
                <div class="column large-12">
                    <nav class="pgn">
                        <ul>
                            <li>
                                <span class="pgn__prev" href="#0">
                                    Prev
                                </span>
                            </li>
                            <li><a class="pgn__num" href="#0">1</a></li>
                            <li><span class="pgn__num current">2</span></li>
                            <li><a class="pgn__num" href="#0">3</a></li>
                            <li><a class="pgn__num" href="#0">4</a></li>
                            <li><a class="pgn__num" href="#0">5</a></li>
                            <li><span class="pgn__num dots">…</span></li>
                            <li><a class="pgn__num" href="#0">8</a></li>
                            <li>
                                <span class="pgn__next" href="#0">
                                    Next
                                </span>
                            </li>
                        </ul>
                    </nav> <!-- end pgn -->
                </div> <!-- end column -->
            </div> <!-- end row -->

        </div> <!-- end s-bricks -->

    </section> <!-- end s-content -->

</x-front-layout>