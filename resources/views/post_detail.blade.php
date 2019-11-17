@extends('layout')

@section('main')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3&appId=156321928365097&autoLogAppEvents=1"></script>
<div class="container site-content single-post">
    <div class="row">
        <div id="primary" class="content-area col-md-8 col-sm-8 col-xs-12 newspaper-x-sidebar">
            <main id="main" class="site-main" role="main">
                <div class="newspaper-x-breadcrumbs"><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="/"><span itemprop="title">Trang chủ </span></a></span><span class="newspaper-x-breadcrumb-sep">/</span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="{{get_category_link($post->category)}}"><span itemprop="title">{{$post->category->name}}</span></a></span><span class="newspaper-x-breadcrumb-sep">/</span><span class="breadcrumb-leaf">{{$post->title}}</span></div>
                
                <article id="post-108" class="post-108 post type-post status-publish format-standard has-post-thumbnail hentry category-editorial">
                    <header class="entry-header">
                        <div class="newspaper-x-image">
                            <img width="700" height="490" src="{{get_post_thumb($post)}}" class="attachment-newspaper-x-single-post size-newspaper-x-single-post wp-post-image" alt=""> 
                        </div>
                        <div class="newspaper-x-post-meta">
                            <div><span class="newspaper-x-category"> <a href="{{get_author_link($post->user)}}">{{$post->user->fullname}}</a></span><span class="newspaper-x-date">{{get_post_date($post)}} </span></div>
                        </div>
                        <h2 class="entry-title">{{$post->title}}</h2>
                    </header>
                    <div class="entry-content">
                        {!! $post->content !!}
                    </div>
                    <div class="fb-comment" style="margin: 40px -5px 20px; width: 100%">
                        <div class="fb-comments" data-href="{{Request::url()}}" data-width="100%" data-numposts="5"></div>
                    </div>
                    <div class="newspaper-x-related-posts">
                        <div class="row">
                            <div class="col-lg-11 col-sm-10 col-xs-12 newspaper-x-related-posts-title">
                                <h3><span>Bài viết liên quan</span></h3>
                            </div>
                        </div>
                        <div class="owlCarousel owl-carousel owl-theme owl-loaded owl-drag" data-slider-id="108" id="owlCarousel-108" data-slider-items="3" data-slider-speed="400" data-slider-auto-play="1" data-slider-navigation="false">
                            <div class="owl-stage-outer">
                                @foreach($relatedPosts as $p)
                                    <div class="item">
                                        <a href="{{get_post_link($p)}}"><img width="550" height="360" src="{{get_post_thumb($p)}}" class="attachment-newspaper-x-recent-post-big size-newspaper-x-recent-post-big wp-post-image" alt=""></a>
                                        <div class="newspaper-x-related-post-title"><a href="{{get_post_link($p)}}">{{$p->title}}</a></div>
                                        <div class="newspaper-x-related-posts-date">{{get_post_date($p)}}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </article>
            </main>
        </div>
        @include('sidebar')
    </div>
</div>
@endsection

                   
