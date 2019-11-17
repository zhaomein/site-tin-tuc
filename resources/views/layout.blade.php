<!DOCTYPE html>
<!-- saved from url=(0033)https://colorlib.com/newspaper-x/ -->
<html lang="en-US">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="profile" href="https://gmpg.org/xfn/11">
      <title>
          <?php if(isset($title)) echo $title.' - '; ?>Tin tức thể thao cập nhật 24/7
      </title>
      <link rel="stylesheet" id="wp-block-library-css" href="/css/style.min.css" type="text/css" media="all">
      <!-- <link rel="stylesheet" id="contact-form-7-css" href="/css/styles.css" type="text/css" media="all"> -->
      <link crossorigin="anonymous" rel="stylesheet" id="newspaper-x-fonts-css" href="/css/font-web.css" type="text/css" media="all">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
      <link rel="stylesheet" id="bootstrap-css" href="/css/bootstrap.min.css" type="text/css" media="all">
      <link rel="stylesheet" id="bootstrap-theme-css" href="/css/bootstrap-theme.min.css" type="text/css" media="all">
      <!-- <link rel="stylesheet" id="newspaper-x-style-css" href="/css/style.css" type="text/css" media="all"> -->
      <link rel="stylesheet" id="newspaper-x-stylesheet-css" href="/css/style-web.css" type="text/css" media="all">
      <style id="newspaper-x-stylesheet-inline-css" type="text/css">
         .newspaper-x-header-widget-area{
         background: #0e0e11;
         }
      </style>
      <link rel="stylesheet" id="owl.carousel-css" href="/css/owl.carousel.min.css" type="text/css" media="all">
      <link rel="stylesheet" id="owl.carousel-theme-css" href="/css/owl.theme.default.css" type="text/css" media="all">

      <script type="text/javascript" src="/js/frontend.min.js"></script>
      <script type="text/javascript" src="/js/jquery.js"></script>
      <script type="text/javascript" src="/js/jquery-migrate.min.js"></script>
      <script type="text/javascript" src="/js/blazy.min.js"></script>

   <body class="home page-template-default page page-id-6 wp-custom-logo">
      <div id="page" class="site">
         <div class="top-header">
            <div class="container">
               <div class="row">
                  <div class="col-lg-8">
                     <section class="newspaper-x-news-ticker">
                        <span class="newspaper-x-module-title">
                        <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-bullhorn fa-stack-1x fa-inverse"></i>
                        </span>Tin mới</span>
                        <ul class="newspaper-x-news-carousel owl-carousel owl-theme owl-loaded owl-drag">
                            @foreach($lastestPosts as $p)
                                <li class="item">
                                    <a href="{{get_post_link($p)}}">{{$p->title}}</a>
                                </li>
                            @endforeach
                        </ul>
                     </section>
                  </div>
                  <div class="col-lg-4">
                     <form role="search" method="get" id="searchform" action="/search">
                        <label>
                        <span class="screen-reader-text">Tìm kiếm:</span>
                        <input class="search-field" placeholder="Từ khóa..." value="" name="q" type="search">
                        </label>
                        <button class="search-submit" value="Tìm" type="submit"><span class="fa fa-search"></span></button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <header id="masthead" class="site-header" role="banner">
            <div class="site-branding container">
               <div class="row">
                  <div class="col-md-4 header-logo">
                     <a href="/" class="custom-logo-link" rel="home"><img width="185" height="55" src="/images/newspaperx_logo_185x55_dark.png" class="custom-logo" alt="Newspaper X"></a> 
                  </div>
                  <div class="col-md-8 header-banner">
                     <a href="#">
                     <img width="729" height="90" src="/images/banner.webp" class="attachment-newspaper-x-wide-banner size-newspaper-x-wide-banner" alt=""> </a>
                  </div>
               </div>
            </div>
            <nav id="site-navigation" class="main-navigation" role="navigation">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="fa fa-bars"></span></button>
                        <div class="menu-primary-menu-container">
                           <ul id="primary-menu" class="menu nav-menu" aria-expanded="false">
                                @foreach($menuItems as $menu)
                                    <li id="menu-item-127" class="menu-item {{$menu['link']=='/'?'current-menu-item':''}}"><a href="{{$menu['link']}}" aria-current="page">{{$menu['name']}}</a></li>
                                @endforeach
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </nav>
        </header>

        @yield('main')               

         <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="back-to-top-area">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12 text-center">
                        <a href="javascript:void(0)" id="back-to-top" class="">
                        <span>Go Up</span>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="site-info ">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        © 2019 Website tin tức thể thao - phát triển bởi nhóm 2 FOSS
                        <nav id="footer-navigation" class="pull-right text-right hidden-xs">
                           <div class="menu">
                              <ul>
                                @foreach($menuItems as $menu)
                                    <li class="page_item page-item-132"><a href="{{$menu['link']}}">{{$menu['name']}}</a></li>
                                @endforeach
                              </ul>
                           </div>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
      </div>

      <script type="text/javascript" src="/js/owl.carousel.min.js"></script>
      <script type="text/javascript" src="/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="/js/navigation.js"></script>
      <script type="text/javascript" src="/js/scripts.js"></script>
      
   </body>
</html>