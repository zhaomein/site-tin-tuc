@extends('layout')

@section('main')

    <div id="content" class="site-content container"></div>
    <div class="newspaper-x-header-widget-area">
      <div id="newspaper_x_header_module-2" class="widget newspaper_x_widgets">
          <div class="newspaper-x-recent-posts container">
            <ul>  
                @php($index = 0)
                @foreach($randomPosts as $post)
                  @if($index++ == 0)
                    <li class="blazy b-loaded" id="newspaper-x-recent-post-0" style="background-image: url({{get_post_thumb($post)}});">
                      <div class="newspaper-x-post-info">
                          <h1>
                            <a href="{{get_post_link($post)}}">{{$post->title}}</a>
                          </h1>
                          <span class="newspaper-x-category">
                          <a href="{{get_category_link($post->category)}}">{{$post->category->name}}</a>
                          </span>
                          <span class="newspaper-x-date">{{get_post_date($post)}}</span>
                      </div>
                    </li>
                  @else
                    <li class="blazy b-loaded" id="newspaper-x-recent-post-1" style="background-image: url({{get_post_thumb($post)}});">
                      <div class="newspaper-x-post-info">
                          <h6>
                            <a href="{{get_post_link($post)}}">{{$post->title}}</a>
                          </h6>
                          <span class="newspaper-x-category">
                          <a href="{{get_category_link($post->category)}}">{{$post->category->name}}</a>
                          </span>
                          <span class="newspaper-x-date">{{get_post_date($post)}}</span>
                      </div>
                    </li>
                  @endif
                @endforeach
            </ul>
          </div>
      </div>
    </div>

    <div class="container site-content">
      <div class="row">
          <div class="col-md-12 newspaper-x-content newspaper-x-with-sidebar">
            <div id="newspaper_x_widget_posts_c-2" class="widget newspaper_x_widgets">
                <h3 class="widget-title"><span>Bài viết mới</span></h3>
                <div class="row newspaper-x-layout-c-row">
                  @foreach($lastestPosts as $post)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="newspaper-x-blog-post-layout-c">
                          <div class="newspaper-x-image">
                              <a href="{{get_post_link($post)}}">
                              <img width="550" height="360" src="{{get_post_thumb($post)}}" class="attachment-newspaper-x-recent-post-big size-newspaper-x-recent-post-big wp-post-image" alt=""> </a>
                          </div>
                          <div class="newspaper-x-title">
                              <h4>
                                <a href="{{get_post_link($post)}}">{{$post->title}}</a>
                              </h4>
                          </div>
                          <span class="newspaper-x-category">
                          <a href="{{get_category_link($post->category)}}">{{$post->category->name}}</a>
                          </span>
                          <span class="newspaper-x-date">{{get_post_date($post)}}</span>
                          <div class="newspaper-x-content">{{$post->desc}}</div>
                        </div>
                    </div>
                  @endforeach
                </div>
            </div>

            @foreach ($postInCats as $section) 
              <div id="newspaper_x_widget_posts_b-3" class="widget newspaper_x_widgets">
                  <h3 class="widget-title"><span>{{$section['catname']}}</span></h3>
                  <div class="row newspaper-x-layout-b-row">
                    @foreach($section['posts'] as $index => $post)
                      @if($index >= 3) @break @endif
                      <div class="col-md-4 col-xs-6">
                          <div class="newspaper-x-blog-post-layout-b">
                            <div class="newspaper-x-image">
                                <a href="{{get_post_link($post)}}">
                                <img width="550" height="360" src="{{get_post_thumb($post)}}" class="attachment-newspaper-x-recent-post-big size-newspaper-x-recent-post-big wp-post-image" alt=""> </a>
                            </div>
                            <div class="newspaper-x-title">
                                <h4>
                                  <a href="{{get_post_link($post)}}">{{$post->title}}</a>
                                </h4>
                            </div>
                            <span class="newspaper-x-author">
                            <a href="{{get_category_link($post->category)}}">{{$post->category->name}}</a>
                            </span>
                            <span class="newspaper-x-date">{{get_post_date($post)}}</span>
                            <div class="newspaper-x-content">
                                {{$post->desc}} <a href="{{get_post_link($post)}}">...</a> 
                            </div>
                          </div>
                      </div>
                    @endforeach
                  </div>
              </div>

              @if(count($section['posts']) > 3)
                <?php unset($section['posts'][0], $section['posts'][1], $section['posts'][2]) ?>
                <div id="newspaper_x_widget_posts_d-3" class="widget newspaper_x_widgets">
                    <div class="row newspaper-x-layout-b-row">
                      @foreach($section['posts'] as $post)
                        <div class="col-md-4 col-xs-6 ">
                            <div class="newspaper-x-blog-post-layout-b border">
                              <div class="row">
                                  <div class="col-sm-5 col-xs-12">
                                    <div class="newspaper-x-image">
                                        <a href="{{get_post_link($post)}}">
                                        <img width="550" height="360" src="{{get_post_thumb($post)}}" class="attachment-newspaper-x-recent-post-big size-newspaper-x-recent-post-big wp-post-image" alt=""> </a>
                                    </div>
                                  </div>
                                  <div class="col-sm-7 col-xs-12">
                                    <div class="newspaper-x-title">
                                        <h3>
                                          <a href="{{get_post_link($post)}}">{{$post->title}}</a>
                                        </h3>
                                    </div>
                                    <span class="newspaper-x-date">{{get_post_date($post)}}</span>
                                  </div>
                              </div>
                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>
              @endif
            @endforeach
          </div>
      </div>
    </div>



@endsection
