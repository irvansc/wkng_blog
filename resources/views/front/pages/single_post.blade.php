@extends('front.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Welcome to larablog')

@section('meta_tags')
<meta name="title" content="{{Str::ucfirst($posts->post_title)}}" />
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large,max-video-preview:-1" />
<meta name="description" content="{{Str::ucfirst(words($posts->post_content, 120))}}" />
<meta name="author" content="{{$posts->author->username}}" />
<link rel="canonical" href="{{ route('read_post',$posts->slug) }}">
<meta property="og:title" content="{{Str::ucfirst($posts->post_title)}}" />
<meta property="og:type" content="website" />
<meta property="og:description" content="{{Str::ucfirst(words($posts->post_content, 120))}}" />
<meta property="og:url" content="{{ route('read_post',$posts->slug) }}" />
<meta property="og:image" content="storage/images/post_images/thumbnails/resized_{{$posts->featured_image}}" />
<meta content='summary' name='twitter:card' />
<meta expr:content='data:blog.pageTitle' name='{{Str::ucfirst($posts->post_title)}}' />
<meta name='twitter:domain' content='{{ Request::getHost() }}' />
<meta name='twitter:card' content='summary' />
<meta name='twitter:title' content="{{Str::ucfirst($posts->post_title)}}" property="og:title" itemprop="name" />
<meta name='twitter:description' content="{{Str::ucfirst(words($posts->post_content, 120))}}" property="og:description" itemprop="description" />
<meta name='twitter:image' content='storage/images/post_images/thumbnails/resized_{{$posts->featured_image}}' />
@endsection

@section('content')


<div class="row">
    <div class="col-lg-8 mb-5 mb-lg-0">
        <article>
            <img loading="lazy" decoding="async" src="/storage/images/post_images/{{$posts->featured_image}}" alt="Post Thumbnail" class="w-100">
            <ul class="post-meta mb-2 mt-4">
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                        <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"></path>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z">
                        </path>
                        <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z">
                        </path>
                    </svg> <span>{{date_formatter($posts->created_at)}}</span>
                </li>
            </ul>
            <h1 class="my-3">{{$posts->post_title}}</h1>
            <ul class="post-meta mb-4">
                <li> <a href="{{ route('category_post',$posts->subcategory->slug) }}">{{$posts->subcategory->subcategory_name}}</a>
                </li>
            </ul>
            <div class="content text-left">
                <p>{!!$posts->post_content!!}</p>
            </div>
            @if ($posts->post_tags)
            @php
            $tagsString =$posts->post_tags;
            $tagsArray = explode(',',$tagsString);
            @endphp
            <div class="tags-container mt-4">
                <ul class="post-meta">
                    @foreach ($tagsArray as $tag)
                    <li><a href="{{ route('tag_post',$tag) }}">#{{$tag}}</a></li>

                    @endforeach
                </ul>
            </div>
            @endif

        </article>
        <hr>
        @if (count($related_post) > 0)

        <div class="widget-list mt-5">
            <h3 class="mb-3">Related posts</h3>
            @foreach ($related_post as $item)
            <a class="media align-items-center" href="{{ route('read_post', $item->slug) }}">
                <img loading="lazy" decoding="async" src="/storage/images/post_images/thumbnails/thumb_{{$item->featured_image}}" alt="{{$item->post_title}}" class="w-100">
                <div class="media-body ml-3">
                    <h3 style="margin-top:-5px">{{$item->post_title}}</h3>
                    <p class="mb-0 small">{!!Str::ucfirst(words($item->post_content, 10))!!}</p>
                </div>
            </a>
            @endforeach
        </div>
        @endif


        <div class="mt-5">
            <div id="disqus_thread"></div>
            <script>
                var disqus_config = function() {
                    this.page.url = "{{route('read_post',$posts->slug)}}"; // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = "{{$posts->id}}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };
                (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document
                        , s = d.createElement('script');
                    s.src = 'https://larablog-site-8.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();

            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="widget-blocks">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <div class="widget-body">
                            <img loading="lazy" decoding="async" src="/front/images/author.jpg" alt="About Me" class="w-100 author-thumb-sm d-block">
                            <h2 class="widget-title my-3">Hootan Safiyari</h2>
                            <p class="mb-3 pb-2">Hello, I’m Hootan Safiyari. A Content writter, Developer and Story
                                teller. Working as a Content writter at CoolTech Agency. Quam nihil …</p> <a href="about.html" class="btn btn-sm btn-outline-primary">Know
                                More</a>
                        </div>
                    </div>
                </div>
                @if (lates_sidebar_post() )

                <div class="col-lg-12 col-md-6">
                    <div class="widget">
                        <h2 class="section-title mb-3">Latest post</h2>
                        <div class="widget-body">
                            <div class="widget-list">
                                @foreach (lates_sidebar_post() as $item)

                                <a class="media align-items-center" href="{{ route('read_post',$item->slug) }}">
                                    <img loading="lazy" decoding="async" src="/storage/images/post_images/thumbnails/thumb_{{$item->featured_image}}" alt="{{$item->post_title}}" class="w-100">
                                    <div class="media-body ml-3">
                                        <h3 style="margin-top:-5px">{{$item->post_title}}</h3>
                                        <p class="small mb-0">{!!Str::ucfirst(words($item->post_content, 10))!!}</p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <x-category-list />

                <x-tag-list />

            </div>
        </div>

    </div>
</div>
@endsection
@push('stylesheets')
<link rel="stylesheet" href="/share_buttons/jquery.floating-social-share.css">
@endpush
@push('scripts')
<script src="/share_buttons/jquery.floating-social-share.js"></script>
<script>
    $("body").floatingSocialShare({
        buttons: [
            "facebook", "whatsapp", "twitter", "telegram", "pinterest"
        ]
        , text: "share with:"
        , url: "{{route('read_post', $posts->slug)}}"
    });

</script>
@endpush
