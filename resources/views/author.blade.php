@extends('layout')

@section('main')
<div class="container site-content">
    <div class="row">
        <div id="primary" class="newspaper-x-content newspaper-x-archive-page col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <header class="col-xs-12">
                <h3 class="page-title"><span>Các bài viết của: {{$user->fullname}}</span></h3>
            </header>
            @if(count($posts) > 0)
                @for($i=0; $i < count($posts); $i+=2)
                    <?php $post=$posts[$i] ?>
                    <div class="row">
                        <div class="col-md-6">
                            <article id="post-61" class="post-61 post type-post status-publish format-standard has-post-thumbnail hentry category-events">
                                <header class="entry-header">
                                    <div class="newspaper-x-image">
                                        <a href="{{get_post_link($post)}}" rel="bookmark"><img width="550" height="360" src="{{get_post_thumb($post)}}" class="attachment-newspaper-x-recent-post-big size-newspaper-x-recent-post-big wp-post-image" alt=""></a> 
                                    </div>
                                    <h4 class="entry-title"><a href="{{get_post_link($post)}}" rel="bookmark">{{$post->title}}</a></h4>
                                    <div class="newspaper-x-post-meta">
                                        <div><span class="newspaper-x-category"> <a href="{{get_category_link($post->category)}}">{{$post->category->name}}</a></span><span class="newspaper-x-date">{{get_post_date($post)}}</span></div>
                                    </div>
                                </header>
                                <div class="entry-content">
                                    <p>{{$post->desc}}</p>
                                </div>
                                <footer class="entry-footer"></footer>
                            </article>
                        </div>
                        @if(isset($posts[$i+1]))
                            <?php $post=$posts[$i+1] ?>
                            <div class="col-md-6">
                                <article id="post-61" class="post-61 post type-post status-publish format-standard has-post-thumbnail hentry category-events" style="margin-bottom: 0">
                                    <header class="entry-header">
                                        <div class="newspaper-x-image">
                                            <a href="{{get_post_link($post)}}" rel="bookmark"><img width="550" height="360" src="{{get_post_thumb($post)}}" class="attachment-newspaper-x-recent-post-big size-newspaper-x-recent-post-big wp-post-image" alt=""></a> 
                                        </div>
                                        <h4 class="entry-title"><a href="{{get_post_link($post)}}" rel="bookmark">{{$post->title}}</a></h4>
                                        <div class="newspaper-x-post-meta">
                                            <div><span class="newspaper-x-category"> <a href="{{get_category_link($post->category)}}">{{$post->category->name}}</a></span><span class="newspaper-x-date">{{get_post_date($post)}}</span></div>
                                        </div>
                                    </header>
                                    <div class="entry-content">
                                        <p>{{$post->desc}}</p>
                                    </div>
                                    <footer class="entry-footer"></footer>
                                </article>
                            </div>
                        @endif
                    </div>
                @endfor
            @else
                <div class="col-md-12">
                    <h5>Không có bài viết nào khớp với từ khóa này.</h5>
                </div>
            @endif
            <div class="linksss" style="text-align: center">{{$posts->links()}}</div>
        </div>
        @include('sidebar')
    </div>
</div>
@endsection
