<aside id="secondary" class="widget-area col-lg-4 col-md-4 col-sm-4 newspaper-x-sidebar" role="complementary">
   <div class="newspaper-x-blog-sidebar">
      <div id="search-4" class="widget widget_search">
         <form role="search" method="get" id="searchform" action="/search">
            <label>
            <span class="screen-reader-text">Tìm kiếm bài viết:</span>
            <input class="search-field" placeholder="Từ khóa..." value="" name="q" type="search">
            </label>
            <button class="search-submit" value="Tìm" type="submit"><span class="fa fa-search"></span></button>
         </form>
      </div>

      <div id="categories-5" class="widget widget_categories">
         <h3>Chuyên mục bài viết</h3>
         <ul>
             @foreach($menuItems as $menu)
                <li class="cat-item cat-item-2"><a href="{{$menu['link']}}">{{$menu['name']}}</a></li>
            @endforeach
         </ul>
      </div>
      <div id="newspaper_x_widget_posts_d-3" class="widget newspaper_x_widgets">
        <h3>Bài viết nổi bật</h3>
        <div class="row newspaper-x-layout-b-row">
            @foreach($trendingPosts as $p)
            <div class="col-md-12">
                <div class="newspaper-x-blog-post-layout-b border" style="margin-bottom: 15px">
                    <div class="row">
                        <div class="col-sm-5 col-xs-12">
                        <div class="newspaper-x-image" style="margin-bottom: 0">
                            <a href="{{get_post_link($p)}}">
                            <img width="550" height="360" src="{{get_post_thumb($p)}}" class="attachment-newspaper-x-recent-post-big size-newspaper-x-recent-post-big wp-post-image" alt=""> </a>
                        </div>
                        </div>
                        <div class="col-sm-7 col-xs-12">
                        <div class="newspaper-x-title">
                            <h3>
                                <a href="{{get_post_link($p)}}">{{$p->title}}</a>
                            </h3>
                        </div>
                        <span class="newspaper-x-date">{{get_post_date($p)}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
   </div>
</aside>