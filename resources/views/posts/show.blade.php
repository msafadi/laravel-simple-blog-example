<x-front-layout :title="$post->title">

    <!-- content
    ================================================== -->
    <section class="s-content">

        <div class="row">
            <div class="column large-12">

                <article class="s-content__entry format-standard">

                    <div class="s-content__media">
                        <div class="s-content__post-thumb">
                            <img src="{{ Storage::disk('public')->url($post->featured_image_path) }}" alt="">
                        </div>
                    </div> <!-- end s-content__media -->

                    <div class="s-content__entry-header">
                        <h1 class="s-content__title s-content__title--post">{{ $post->title }}</h1>
                    </div> <!-- end s-content__entry-header -->

                    <div class="s-content__primary">

                        <div class="s-content__entry-content">

                            <p class="lead">{{ $post->content }}</p>

                        </div> <!-- end s-entry__entry-content -->

                        <div class="s-content__entry-meta">

                            <div class="entry-author meta-blk">
                                <div class="author-avatar">
                                    <img class="avatar" src="images/avatars/user-06.jpg" alt="">
                                </div>
                                <div class="byline">
                                    <span class="bytext">Posted By</span>
                                    <a href="#0">{{ $post->user->name }}</a>
                                </div>
                            </div>

                            <div class="meta-bottom">
                                
                                <div class="entry-cat-links meta-blk">
                                    <div class="cat-links">
                                        <span>In</span> 
                                        @foreach ($post->categories as $category)
                                        <a href="#">{{ $category->title }}</a> 
                                        @endforeach
                                    </div>

                                    <span>On</span>
                                    {{ $post->published_at }}
                                </div>

                                <div class="entry-tags meta-blk">
                                    <span class="tagtext">Tags</span>
                                    <a href="#">orci</a>
                                    <a href="#">lectus</a>
                                    <a href="#">varius</a>
                                    <a href="#">turpis</a>
                                </div>

                            </div>

                        </div> <!-- s-content__entry-meta -->

                        <div class="s-content__pagenav">
                            <div class="prev-nav">
                                <a href="#" rel="prev">
                                    <span>Previous</span>
                                    Tips on Minimalist Design 
                                </a>
                            </div>
                            <div class="next-nav">
                                <a href="#" rel="next">
                                    <span>Next</span>
                                    A Practical Guide to a Minimalist Lifestyle.
                                </a>
                            </div>
                         </div> <!-- end s-content__pagenav -->

                    </div> <!-- end s-content__primary -->
                </article> <!-- end entry -->

            </div> <!-- end column -->
        </div> <!-- end row -->


        <!-- comments
        ================================================== -->
        <div class="comments-wrap">

            <div id="comments" class="row">
                <div class="column large-12">

                    <h3>{{ $post->comments()->count() }} Comments</h3>

                    <!-- START commentlist -->
                    <ol class="commentlist">
                        @foreach ($post->comments()->where('status', 'published')->latest()->get() as $comment)
                        <li class="depth-1 comment">

                            <div class="comment__avatar">
                                <img class="avatar" src="images/avatars/user-02.jpg" alt="" width="50" height="50">
                            </div>

                            <div class="comment__content">

                                <div class="comment__info">
                                    <div class="comment__author">{{ $comment->user_name }}</div>

                                    <div class="comment__meta">
                                        <div class="comment__time">{{ $comment->created_at }}</div>
                                        <div class="comment__reply">
                                            <a class="comment-reply-link" href="#0">Reply</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="comment__text">
                                <p>{{ $comment->content }}</p>
                                </div>

                            </div>

                        </li>  <!-- end comment level 1 -->
                        @endforeach
                    </ol>
                    <!-- END commentlist -->

                </div> <!-- end col-full -->
            </div> <!-- end comments -->


            <div class="row comment-respond">

                <!-- START respond -->
                <div id="respond" class="column">

                    <h3>
                    Add Comment 
                    <span>Your email address will not be published.</span>
                    </h3>

                    <form name="contactForm" id="contactForm" method="post" action="{{ route('posts.comments', $post->id) }}" autocomplete="off">
                        @csrf
                        <fieldset>

                            <div class="form-field">
                                <input name="cName" id="cName" class="h-full-width h-remove-bottom" placeholder="Your Name" value="" type="text">
                            </div>

                            <div class="form-field">
                                <input name="cEmail" id="cEmail" class="h-full-width h-remove-bottom" placeholder="Your Email" value="" type="text">
                            </div>

                            <div class="form-field">
                                <input name="cWebsite" id="cWebsite" class="h-full-width h-remove-bottom" placeholder="Website" value="" type="text">
                            </div>

                            <div class="message form-field">
                                <textarea name="cMessage" id="cMessage" class="h-full-width" placeholder="Your Message"></textarea>
                            </div>

                            <br>
                            <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large h-full-width" value="Add Comment" type="submit">

                        </fieldset>
                    </form> <!-- end form -->

                </div>
                <!-- END respond-->

            </div> <!-- end comment-respond -->

        </div> <!-- end comments-wrap -->


    </section> <!-- end s-content -->


</x-front-layout>