<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from 7xtheme.com/shapen/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 25 Mar 2022 14:51:14 GMT -->
<head>

<?php
// Define base_url function if it doesn't exist (in case CodeIgniter is not loaded)
if (!function_exists('base_url')) {
    function base_url($uri = '') {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        $base = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
        return $protocol . $host . $base . $uri;
    }
}
?>

	<!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />    
    <meta name="description" content="" />
    
    <!-- FAVICONS ICON -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    
    <!-- PAGE TITLE HERE -->
    <title>Australia Alumni Association of Nigeria</title>
    
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- [if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
	<![endif] -->
    
    <!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    
    <!-- FONTAWESOME STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <!-- OWL CAROUSEL STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">

    <!-- MAGNIFIC POPUP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/magnific-popup.min.css">
	
    <!-- LOADER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/loader.min.css"> 

    <!-- FLATICON STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/flaticon.min.css">	
    
    <!-- MAIN STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/style.css?v=30-0-99">

    <!-- Color Theme Change Css -->
    <link rel="stylesheet" class="skin" type="text/css" href="css/skin/skin-1.css?v=99-80-48">  
	


    <!-- Side Switcher Css-->
    <link rel="stylesheet" type="text/css" href="css/switcher.css">    

    <!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css" href="plugins/revolution/revolution/css/settings.css">
	
    <!-- REVOLUTION NAVIGATION STYLE -->
    <link rel="stylesheet" type="text/css" href="plugins/revolution/revolution/css/navigation.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">  
	<link href="https://fonts.googleapis.com/css?family=Poppins:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <script>
        // Set base_url for JavaScript access
        var base_url = '<?php echo base_url(); ?>';
    </script>

    <style>

        .input-error {
            border: 2px solid red;
        }

        .dot_loader {
          width: 15px;
          aspect-ratio: 1;
          border-radius: 50%;
          animation: l5 1s infinite linear alternate;
        }

        @keyframes l5 {
            0%  {box-shadow: 20px 0 #000, -20px 0 #0002;background: #000 }
            33% {box-shadow: 20px 0 #000, -20px 0 #0002;background: #0002}
            66% {box-shadow: 20px 0 #0002,-20px 0 #000; background: #0002}
            100%{box-shadow: 20px 0 #0002,-20px 0 #000; background: #000 }
        }
        
    </style>

</head>

<body>

	<div class="page-wraper"> 
       	
        <!-- HEADER START -->
        <header class="site-header header-style-1">
            <div class="top-bar bg-gray">
                <div class="container">
                    <div class="row">
                        <div class="mt-topbar-left clearfix">
                            <ul class="list-unstyled e-p-bx pull-right">
                                <li><i class="fa fa-envelope"></i> contact@aanigeria.com</li>
                                <li><i class="fa fa-phone"></i>(+234) 803-7132-683</li>
                                <!-- <li><i class="fa fa-clock-o"></i>Sun-Sat 9.45 am</li> -->
                            </ul>
                        </div>
                        <div class="mt-topbar-right clearfix">
                            <div class="appint-btn" id="auth_button_container">
                                <!-- This will be populated by JavaScript based on auth token -->
                                <a href="login" class="site-button">Member Login</a>
                                <a href="register" class="site-button" style="margin-left: 10px;">REGISTER TO JOIN US</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
            <div class="sticky-header main-bar-wraper">
                <div class="main-bar bg-white">
                    <div class="container">
                        <div class="logo-header">
                            <div class="logo-header-inner logo-header-one">
                                <a href="index">
                                    <img src="images/logologo.png?v=994" alt="" width="250px" />
                                </a>
                            </div>
                        </div>
                        <!-- NAV Toggle Button -->
                        <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                            <!-- ETRA Nav -->
                            <div class="extra-nav">
                                <div class="extra-cell">											
                                    <a href="javascript:void(0)" id="open-search-modal" class="open-search">
                                    	<i class="fa fa-search"></i>
                                    </a>
                                </div>
                                <div class="extra-cell">
                                    <a href="#" class="contact-slide-show"><i class="fa fa-angle-left arrow-animation"></i></a>
                                </div>                                
                            </div>
                            <!-- ETRA Nav -->

                            <!-- Contact Nav -->                            
                         	<div class="contact-slide-hide " style="background-image:url(images/background/bg-5.png)"> 
                                <div class="contact-nav">
                                     <a href="javascript:void(0)" class="contact_close">&times;</a>
                                     <div class="contact-nav-form p-a30">
                            			<div class="contact-info   m-b30">
                             
                                            <div class="mt-icon-box-wraper center p-b30">
                                                <div class="icon-xs m-b20 scale-in-center"><i class="fa fa-phone"></i></div>
                                                <div class="icon-content">
                                                    <h5 class="m-t0 font-weight-500">Phone number</h5>
                                                    <p>(+234) 803-7132-683</p>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-icon-box-wraper center p-b30">
                                                <div class="icon-xs m-b20 scale-in-center"><i class="fa fa-envelope"></i></div>
                                                <div class="icon-content">
                                                    <h5 class="m-t0 font-weight-500">Email address</h5>
                                                    <p>contact@aaanigeria.com</p>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-icon-box-wraper center p-b30">
                                                <div class="icon-xs m-b20 scale-in-center"><i class="fa fa-map-marker"></i></div>
                                                <div class="icon-content">
                                                    <h5 class="m-t0 font-weight-500">Address info</h5>
                                                    <p>Haven Estate, Life Camp, Abuja.</p>
                                                </div>
                                            </div>
                                        </div>                                          
                                        <div class="full-social-bg">
                                              <ul>
                                                    <li><a href="#" class="facebook"><i class="fa-brands fa-facebook"></i></a></li>
                                                    <li><a href="#" class="google"><i class="fa-brands fa-google"></i></a></li>
                                                    <li><a href="#" class="instagram"><i class="fa-brands fa-instagram"></i></a></li>
                                                    <!-- <li><a href="#" class="tumblr"><i class="fa-brands fa-tumblr"></i></a></li> -->
                                                    <li><a href="#" class="twitter"><i class="fa-brands fa-x-twitter"></i></a></li>
                                                    <li><a href="#" class="youtube"><i class="fa-brands fa-youtube"></i></a></li>
                                              </ul>
                                        </div>
                                        <div class="text-center">
                                            <h4 class="font-weight-600">&copy;  2019 7xtheme</h4> 
                                        </div>                                                                    			
                                     </div>
                                </div> 
                            </div>                               
                            <!-- SITE Search -->
                            <div id="search"> 
                                <span class="close"></span>
                                <form role="search" id="searchform">
                                    <div class="input-group">
                                        <input value="" name="q" type="search" placeholder="Type to search"/>
                                        <span class="input-group-btn"><button type="button" class="search-btn"><i class="fa fa-search arrow-animation"></i></button></span>
                                    </div>   
                                </form>
                            </div>
                            <!-- MAIN Vav -->
                            <div class="header-nav navbar-collapse collapse">
                                <ul class=" nav navbar-nav">
                                    <li>
                                        <a href="index">Home</a>
                                    </li>
                                    <!-- <li class="active">
                                        <a href="javascript:;">Home</a>
                                     <ul class="sub-menu">

                                            <li>
                                                <a href="index.html">Home-1</a>
                                            </li>
                                            <li>
                                                <a href="index-2.html">Home-2</a>
                                            </li>
                                            <li>
                                                <a href="index-3.html">Home-3 boxed style</a>
                                            </li> 
                                            <li>
                                                <a href="index-4.html">Home-4</a>
                                            </li>                                          
                                        </ul>                                                    
                                    </li> -->

                                    <li>
                                        <a href="aboutus">About us</a>
                                    </li> 
                                    <li>
                                        <a href="gallery">Gallery</a>
                                    </li>
                                    <li>
                                        <a href="opportunities">Opportunities</a>
                                    </li>
                                    <li>
                                        <a href="wiln">WILN</a>
                                    </li>
                                    <li>
                                        <a href="ausconnect">AUSSIE CONNECT</a>
                                    </li>
                                    <li>
                                        <a href="expatlocator">Expert Locator</a>
                                    </li>
                                    <li>
                                        <a href="blog">Blog</a>
                                    </li> 
                                    <!-- <li>
                                        <a href="javascript:;">Pages</a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="javascript:;">Blog</a>
                                                <ul class="sub-menu has-child">
                                                    <li><a href="blog-grid.html">Blog Grid</a></li>
                                                    <li><a href="blog-listing.html">Blog Listing</a></li>
                                                    <li><a href="blog-masonry.html">Blog Masonry</a></li>
                                                </ul>
                                            </li>                                        
                                            <li>
                                                <a href="faq.html">FAQ</a>
                                            </li>
                                            <li>
                                                <a href="error-404.html">Error 404</a>
                                            </li>                                            
                                            <li>
                                                <a href="contact-1.html">Contact us</a>
                                            </li>
                                        </ul>
                                    </li>  -->                                                                                                                                              
                                    <!-- <li>
                                        <a href="javascript:;">Post detail</a>
                                        <ul class="sub-menu">
                                            <li><a href="post-image.html">Post Image</a></li>
                                            <li><a href="post-gallery.html">Post Gallery</a></li>
                                            <li><a href="post-video.html">Post Video</a></li>
                                            <li><a href="post-right-sidebar.html">Post Right Sidebar</a></li>                                        
                                        </ul>                                    
                                    </li>  -->                                        

                                    <!-- <li>
                                        <a href="javascript:;">Projects</a>
                                        <ul class="sub-menu">
                                            <li><a href="project-grid.html">Project Grid</a></li>
                                            <li><a href="project-masonry.html">Project Masonry</a></li>
                                            <li><a href="project-carousel.html">Project Carousel</a></li>
                                            <li><a href="project-classic.html">Project Classic-1</a></li>
                                            <li><a href="project-classic2.html">Project Classic-2</a></li>
                                            <li><a href="project-detail.html">Project Detail</a></li>                                        
                                        </ul>
                                    </li> -->
                                    <!-- <li class="submenu-direction">
                                        <a href="javascript:;">Shortcodes</a>
                                        <ul class="sub-menu">
                                            <li><a href="accordian.html">Accordian</a></li>
                                            <li><a href="button.html">Button</a></li>
                                            <li><a href="icon_box.html">Icon box style</a></li>
                                            <li><a href="list_group.html">List group</a></li>
                                            <li><a href="modal_popup.html">Modal popup</a></li>
                                            <li><a href="tabs.html">Tabs</a></li>
                                            <li><a href="table.html">Table</a></li>
                                            <li><a href="video.html">Video  </a></li>
                                            <li><a href="icon-font.html">Icon Font </a></li> 
                                        </ul>                                    
                                    </li> -->                                
                                </ul>
                            </div>
                            
                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER END -->
