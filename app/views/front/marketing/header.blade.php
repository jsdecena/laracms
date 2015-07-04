    <a class="sr-only" href="#content"></a>

    <div class="header-background">

        <div class="btn-mobile-menu visible-sm visible-xs">
            <button type="button" class="menu-btn">
                <i class="icon-menu"></i>
                <span>Menu</span>
            </button>
        </div>

        <!-- Top Menu -->
        <nav class="social-menu navbar">
            <h2 class="hidden">Top Navigation</h2>

            <div class="container">

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div id="social-menu-navbar-collapse" class="collapse navbar-collapse">


                    <ul class="nav navbar-nav navbar-left visible-lg visible-md">

                        <li class="dropdown color-theme active">
                            <a href="{{URL::to('/')}}" class="dropdown-toggle" data-hover="dropdown">Editorial Category <b class="caret"></b><span class="nav-line"></span></a>
                            <ul class="dropdown-menu" data-dropdownanimation="true" data-animation="fadeInLeft">
                                <li><a href="{{URL::to('/')}}">Category 1</a></li>
                                <li><a href="{{URL::to('/')}}">Category 2</a></li>
                                <li><a href="{{URL::to('/')}}">Category 3</a></li>
                            </ul>

                        </li>

                        <li class="color-theme"><a href="{{URL::to('/')}}">Product Category <span class="nav-line"></span></a></li>

                        <li class="dropdown color-theme">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown">Location
                                <b class="caret"></b>
                                <span class="nav-line"></span>
                            </a>

                            <ul class="dropdown-menu" data-dropdownanimation="true" data-animation="fadeInLeft">
                                <li class="dropdown-submenu">
                                    <a href="#">Location Sub</a>
                                    <ul class="dropdown-menu" data-dropdownanimation="true" data-animation="fadeInLeft">
                                        <li><a href="#">Location Sub sub</a></li>
                                        <li><a href="#">Location Sub sub 2</a></li>
                                        <li><a href="#">Location Sub sub 3</a></li>
                                    </ul>
                                </li>

                                <li><a href="#">Location Again</a></li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right visible-lg visible-md visible-sm">

                        <li class="search dropdown">
                            <div class="mask-background animated lightSpeedIn"></div>

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-search"></i></a>
                            <ul class="dropdown-menu" data-dropdownanimation="true" data-animation="fadeInLeft">
                                <li>
                                    <form class="navbar-form navbar-right" role="search">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Search" required="required" />
                                            <button type="submit" class="btn-search"><i class="icon-search"></i></button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </li>

                        <li class="social-icons">
                            <ul class="list-inline clearfix">

                                <li class="tooltip_item fb-metro-but-16" data-toggle="tooltip" data-placement="bottom" title="facebook">
                                    <div class="mask-background" data-animation="lightSpeedIn"></div>
                                    <a href="#"><i class="zoc-facebook"></i></a>
                                </li>

                                <li class="tooltip_item twitter-metro-but-16" data-toggle="tooltip" data-placement="bottom" title="twitter">
                                    <div class="mask-background" data-animation="lightSpeedIn"></div>
                                    <a href="#"><i class="zoc-twitter"></i></a>
                                </li>

                                <li class="tooltip_item pinterest-metro-but-16" data-toggle="tooltip" data-placement="bottom" title="pinterest">
                                    <div class="mask-background animated lightSpeedIn"></div>
                                    <a href="#"><i class="zoc-pinterest"></i></a>
                                </li>

                                <li class="tooltip_item youtube-metro-but-16" data-toggle="tooltip" data-placement="bottom" title="youtube">
                                    <div class="mask-background animated lightSpeedIn"></div>
                                    <a href="#"><i class="zoc-youtube"></i></a>
                                </li>

                                <li class="tooltip_item instagram-metro-but-16" data-toggle="tooltip" data-placement="bottom" title="instagram">
                                    <div class="mask-background animated lightSpeedIn"></div>
                                    <a href="#"><i class="zoc-instagram"></i></a>
                                </li>

                                <li class="tooltip_item vk-metro-but-16" data-toggle="tooltip" data-placement="bottom" title="vk">
                                    <div class="mask-background animated lightSpeedIn"></div>
                                    <a href="#"><i class="zoc-vk"></i></a>
                                </li>

                            </ul>
                        </li>

                    </ul>

                </div>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <!-- Breaking News -->
        <section class="tkr-breaking-news hidden-xs">
            <div class="container">

                <div class="title">
                    <h3>Trending</h3>
                </div>

                <div id="divBreakingNewsTicker" class="content">
                    <ul id="js-news" class="js-hidden">
                        <li><a href="{{URL::to('/')}}">The Toni and Direk Paul Soriano Wedding</a></li>
                        <li><a href="{{URL::to('/')}}">Marian and Dingdong Wedding</a></li>
                        <li><a href="{{URL::to('/')}}">Heart and Chiz Wedding</a></li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Site Logo -->
        <header class="container header-logo">
            <div class="logo" itemscope itemtype="http://schema.org/Brand">
                <h1 class="hidden" itemprop="name">The Wedding Digest</h1>
                <a href="{{URL::to('/')}}">
                    <img itemprop="logo" class="site-logo" src="{{URL::to('themes/front/marketing/img/logo.gif')}}" data-src="{{URL::to('themes/front/marketing/img/logo.gif')}}" alt="main-logo" />
                    <img itemprop="logo" class="site-logo-retina" src="{{URL::to('themes/front/marketing/img/logo-retina.gif')}}" data-src="{{URL::to('themes/front/marketing/img/logo-retina.gif')}}" alt="main-logo" style="width: 160px; height: 90px;" />
                </a>
            </div>

            <div class="advertise-650 visible-lg pull-right">
                <a href="#"><img src="" data-src="holder.js/650x90/sky" /></a>
            </div>
        </header>

        <!-- #camera_wrap_1 -->
        <section id="camera_wrap_1" class="container camera_wrap camera_azure_skin">

            <div data-thumb="" data-src="img-samples/1045x500.png">
                <div class="camera_caption fadeFromBottom">
                    <h2 class="hidden">Slider Section</h2>

                    <div class="meta-info">
                        <span><i class="icon-user3"></i><a href="#">Serpentsoft</a></span>
                        <span><i class="icon-alarm2"></i>14 Aug 2013, 05:30 AM</span>
                        <span><i class="icon-library"></i><a href="pg-category.html">World</a></span>
                    </div>

                    <div class="rating">
                        <div class="stars retina x-3">
                            <div class="gray">
                                <i></i><i></i><i></i><i></i><i></i>
                            </div>

                            <div class="fill" style="width: 80%">
                                <div class="light">
                                    <i></i><i></i><i></i><i></i><i></i>
                                </div>
                            </div>

                        </div>
                    </div>

                    <h3><a href="#">Post With Featured Image</a></h3>
                    <!--<span class="btn-srp color-theme"><a href="#cat">Movies</a></span>-->

                </div>
            </div>

            <div data-thumb="" data-src="img-samples/1045x500.png">
                <div class="camera_caption fadeFromBottom">
                    <div class="meta-info">
                        <span><i class="icon-user3"></i><a href="#">Serpentsoft</a></span>
                        <span><i class="icon-alarm2"></i>25 Dec, 2013</span>
                        <span><i class="icon-library"></i><a href="pg-category.html">Sports</a></span>
                    </div>


                    <h3><a href="#">Post With Youtube Video</a></h3>

                </div>
            </div>
            
            <div data-thumb="" data-src="img-samples/1045x500.png">
                <div class="camera_caption fadeFromBottom">
                    <div class="meta-info">
                        <span><i class="icon-user3"></i><a href="#">Serpentsoft</a></span>
                        <span><i class="icon-alarm2"></i>25 Dec, 2013</span>
                        <span><i class="icon-library"></i><a href="pg-category.html">Fashion</a></span>
                    </div>

                    <div class="rating">
                        <div class="stars retina x-3">
                            <div class="gray">
                                <i></i><i></i><i></i><i></i><i></i>
                            </div>

                            <div class="fill" style="width: 50%">
                                <div class="light">
                                    <i></i><i></i><i></i><i></i><i></i>
                                </div>
                            </div>

                        </div>
                    </div>

                    <h3><a href="#">Post With Sound Cloud</a></h3>

                </div>
            </div>

            <div data-thumb="" data-src="img-samples/1045x500.png">
                <div class="camera_caption fadeFromBottom">
                    <div class="meta-info">
                        <span><i class="icon-user3"></i><a href="#">Serpentsoft</a></span>
                        <span><i class="icon-alarm2"></i>25 Dec, 2013</span>
                        <span><i class="icon-library"></i><a href="pg-category.html">Technology</a></span>
                    </div>

                    <div class="rating">
                        <div class="stars retina x-3">
                            <div class="gray">
                                <i></i><i></i><i></i><i></i><i></i>
                            </div>

                            <div class="fill" style="width: 60%">
                                <div class="light">
                                    <i></i><i></i><i></i><i></i><i></i>
                                </div>
                            </div>

                        </div>
                    </div>

                    <h3><a href="#">How Google Ruined 'What Time is the Super Bowl?</a></h3>

                </div>
            </div>
            
            <div data-thumb="" data-src="img-samples/1045x500.png">
                <div class="camera_caption fadeFromBottom">
                    <div class="meta-info">
                        <span><i class="icon-user3"></i><a href="#">Serpentsoft</a></span>
                        <span><i class="icon-alarm2"></i>25 Dec, 2013</span>
                        <span><i class="icon-library"></i><a href="pg-category.html">Technology</a></span>
                    </div>

                    <div class="rating">
                        <div class="stars retina x-3">
                            <div class="gray">
                                <i></i><i></i><i></i><i></i><i></i>
                            </div>

                            <div class="fill" style="width: 20%">
                                <div class="light">
                                    <i></i><i></i><i></i><i></i><i></i>
                                </div>
                            </div>

                        </div>
                    </div>

                    <h3><a href="#">4 Android Tablet Apps to Make Life Simpler</a></h3>

                </div>
            </div>
            
            <div data-thumb="" data-src="img-samples/1045x500.png">
                <div class="camera_caption fadeFromBottom">
                    <div class="meta-info">
                        <span><i class="icon-user3"></i><a href="#">Serpentsoft</a></span>
                        <span><i class="icon-alarm2"></i>25 Dec, 2013</span>
                        <span><i class="icon-library"></i><a href="pg-category.html">Internet</a></span>
                    </div>

                    <div class="rating">
                        <div class="stars retina x-3">
                            <div class="gray">
                                <i></i><i></i><i></i><i></i><i></i>
                            </div>

                            <div class="fill" style="width: 40%">
                                <div class="light">
                                    <i></i><i></i><i></i><i></i><i></i>
                                </div>
                            </div>

                        </div>
                    </div>

                    <h3><a href="#">10 Photos of Indonesia's Deadly Volcanic Eruption</a></h3>

                </div>
            </div>
        </section>

        <!-- Main Menu -->
        <nav class="main-menu navbar visible-lg visible-md" data-sticky-header="true">
            <h2 class="hidden">Main Navigation</h2>

            <div class="container">
                <div class="row">

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div id="main-menu-navbar-collapse" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">

                            <li class="dropdown color-theme active">
                                <a href="index.html" class="dropdown-toggle" data-hover="dropdown">Home <span class="nav-line"></span></a>
                                <ul class="dropdown-menu animated fadeInLeft">
                                    <li><a href="{{URL::to('/')}}">Sub Category</a></li>
                                    <li><a href="{{URL::to('/')}}">Sub Category</a></li>
                                    <li><a href="{{URL::to('/')}}">Sub Category</a></li>
                                </ul>

                            </li>

                            <li class="dropdown color-3">
                                <a href="#" class="dropdown-toggle" data-hover="dropdown">Categories<span class="nav-line"></span></a>
                                <ul class="dropdown-menu animated fadeInLeft">
                                    <li><a href="post-image.html">Featured Image</a></li>
                                    <li><a href="post-image-lighbox.html">Featured Image + Lightbox</a></li>
                                    <li><a href="post-video.html">Post With Video</a></li>

                                </ul>
                            </li>

                            <li class="dropdown color-2">
                                <a href="#" class="dropdown-toggle" data-hover="dropdown">Directories<span class="nav-line"></span></a>
                                <ul class="dropdown-menu animated fadeInLeft">
                                    <li><a href="post-review-stars.html">Stars</a></li>
                                    <li><a href="post-review-points.html">Points</a></li>
                                    <li><a href="post-review-percent.html">Percent</a></li>
                                </ul>
                            </li>

                            <li class="dropdown color-theme">
                                <a href="#" class="dropdown-toggle" data-hover="dropdown">Deals and Discounts<span class="nav-line"></span></a>
                                <ul class="dropdown-menu animated fadeInLeft">
                                    <li class="dropdown-submenu">
                                        <a href="#">Blog Pages</a>

                                        <ul class="dropdown-menu animated fadeInLeft">
                                            <li><a href="pg-blog-1.html">Style 1</a></li>
                                            <li><a href="pg-blog-2.html">Style 2</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="pg-category.html">Archive Page</a></li>

                                    <li><a href="pg-authors.html">Authors Page</a></li>

                                    <li><a href="pg-timeline.html">Timeline Page</a></li>

                                    <li><a href="pg-sitemap.html">Sitemap Page</a></li>

                                    <li><a href="pg-tags.html">Tags Page</a></li>

                                </ul>
                            </li>


                            <li class="dropdown color-2">
                                <a href="#" class="dropdown-toggle" data-hover="dropdown">E-Magazines<span class="nav-line"></span></a>
                                <ul class="dropdown-menu animated fadeInLeft">
                                    <li><a href="sb-left.html">Left Sidebar</a></li>
                                    <li><a href="sb-right.html">Right Sidebar</a></li>
                                    <li><a href="sb-none.html">Full Width</a></li>
                                </ul>
                            </li>


                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="color-theme"><a href="#"><i class="icon-shuffle"></i><span class="nav-line"></span></a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
            </div>
        </nav>


        <!-- Mobile Menu (Pushy Menu) -->
        <nav class="mobile-menu pushy pushy-left  animated fadeInLeft">
            <h2 class="hidden">Mobile Navigation</h2>

            <div class="close-button"><i class="icon-close"></i>Close</div>

            <ul class="menu-block">
                <li class="dropdown color-theme active">
                    <a href="index.html" class="dropdown-toggle">Home <span class="nav-line"></span></a>

                    <ul class="dropdown-menu animated fadeInLeft">
                        <li><a href="index.html">Right Sidebar (Default)</a></li>
                        <li><a href="index-sbleft.html">Left Sidebar</a></li>
                        <li><a href="index-fullwidth.html">Full Width</a></li>
                    </ul>
                </li>

                <li class="dropdown color-3">
                    <a href="#" class="dropdown-toggle">Categories<span class="nav-line"></span></a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li><a href="post-image.html">Featured Image</a></li>
                        <li><a href="post-image-lighbox.html">Featured Image + Lightbox</a></li>
                        <li><a href="post-video.html">Post With Video</a></li>

                    </ul>
                </li>

                <li class="dropdown color-2">
                    <a href="#" class="dropdown-toggle">Directories<span class="nav-line"></span></a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li><a href="post-review-stars.html">Stars</a></li>
                        <li><a href="post-review-points.html">Points</a></li>
                        <li><a href="post-review-percent.html">Percent</a></li>
                    </ul>
                </li>

                <li class="dropdown color-theme">
                    <a href="#" class="dropdown-toggle">Deals and Discounts<span class="nav-line"></span></a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li class="dropdown-submenu">
                            <a href="#">Blog Pages</a>

                            <ul class="dropdown-menu animated fadeInLeft">
                                <li><a href="pg-blog-1.html">Style 1</a></li>
                                <li><a href="pg-blog-2.html">Style 2</a></li>
                            </ul>
                        </li>

                        <li><a href="pg-category.html">Archive Page</a></li>

                        <li><a href="pg-authors.html">Authors Page</a></li>

                        <li><a href="pg-timeline.html">Timeline Page</a></li>

                        <li><a href="pg-sitemap.html">Sitemap Page</a></li>

                        <li><a href="pg-tags.html">Tags Page</a></li>

                    </ul>
                </li>

                <li class="dropdown color-2">
                    <a href="#" class="dropdown-toggle">E-Magazines<span class="nav-line"></span></a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li><a href="sb-left.html">Left Sidebar</a></li>
                        <li><a href="sb-right.html">Right Sidebar</a></li>
                        <li><a href="sb-none.html">Full Width</a></li>
                    </ul>
                </li>


            </ul>

            <ul class="menu-block">

                <li class="active color-theme"><a href="index.html">Home <span class="nav-line"></span></a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li><a href="index.html">Right Sidebar (Default)</a></li>
                        <li><a href="index-sbleft.html">Left Sidebar</a></li>
                        <li><a href="index-fullwidth.html">Full Width</a></li>
                    </ul>
                </li>

                <li class="color-theme"><a href="{{URL::to('/')}}">Product Category <span class="nav-line"></span></a></li>

                <li class="dropdown color-theme">
                    <a href="#" class="dropdown-toggle">Location<span class="nav-line"></span></a>

                    <ul class="dropdown-menu animated fadeInLeft">
                        <li class="dropdown-submenu">
                            <a href="#">Location Sub</a>
                            <ul class="dropdown-menu animated fadeInLeft">
                                <li><a href="#">Location Sub sub</a></li>
                                <li><a href="#">Location Sub sub 2</a></li>
                                <li><a href="#">Location Sub sub 3</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Location Again</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Mobile-Menu (Close) Site Overlay -->
        <div class="site-overlay"></div>
    </div>

    <div class="container main-site-container" itemscope itemtype="http://schema.org/CreativeWork">