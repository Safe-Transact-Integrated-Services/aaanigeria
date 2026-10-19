<?php
include_once("_common/header.php");
?>


<!-- CONTENT START -->
<div class="page-content">

    <!-- INNER PAGE BANNER -->
    <div class="mt-bnr-inr overlay-wraper bg-parallax bg-top-center" data-stellar-background-ratio="0.5" style="background-image:url(images/gallery/meeting-4.jpg);">
        <div class="overlay-main bg-black opacity-07"></div>
        <div class="container">
            <div class="mt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        <h2 class="m-b0">Building our communities across Australia & Nigeria</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->

                <div>
                    <ul class="mt-breadcrumb breadcrumb-style-2">
                        <li><a href="javascript:void(0);">Home</a></li>
                        <!-- <li>About 1</li> -->
                    </ul>
                </div>

                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->







    <!-- TESTIMONIALS SECTION START -->
    <div class="section-full mobile-page-padding p-t80 p-b50 square_shape2 bg-cover" style="background-image:url(images/background/bg6.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12 p-b30" style="font-size: 16px;">
                    <p>Aussie Connect is our vibrant networking hub — a space where alumni reconnect, collaborate, and build lasting professional and social relationships.</p>
                    <p>Through structured networking sessions, industry roundtables, informal meet-ups, and digital engagement, Aussie Connect fosters meaningful conversations and partnerships. It is designed to strengthen bonds within our alumni community while opening doors to cross-sector collaboration.</p>
                    <p>Whether you are looking to mentor, be mentored, partner on a project, or simply reconnect with fellow alumni, Aussie Connect keeps our community engaged and active.</p>
                </div>
            </div>
            <div class="section-content">
                <div class="aussie-connect-toolbar">
                    <div>
                        <span class="aussie-connect-label">Member Directory</span>
                        <h3 class="aussie-connect-title">Registered AAAN Members</h3>
                        <p class="aussie-connect-subtitle">Browse the community and click any member name to open their full profile.</p>
                    </div>
                    <div class="aussie-connect-meta">
                        <span id="aussie_connect_count" class="aussie-connect-count">0 members</span>
                    </div>
                </div>

                <div id="aussie_connect_message" class="aussie-connect-message" style="display:none;"></div>
                <div id="aussie_connect_loading" class="aussie-connect-loading">Loading registered members...</div>
                <div id="aussie_connect_directory" class="row"></div>

                <!-- TITLE START -->
                <!-- <div class="section-head">
                    <div class="mt-separator-outer separator-center">
                        <div class="mt-separator">
                            <h2 class="text-uppercase sep-line-one "><span class="font-weight-300 text-primary">Executive</span> Committee</h2>
                        </div>
                    </div>
                </div> -->
                <!-- TITLE END -->

                <!-- TESTIMONIAL START -->
                <!-- <div class="owl-carousel testimonial-home"> -->
                <!-- <div class="item">
                        <div class="testimonial-2 m-a30 hover-animation-1">
                            <div class=" block-shadow bg-white p-a30">
                                <div class="testimonial-detail clearfix">
                                    <div class="testimonial-pic radius shadow scale-in-center"><img src="images/management/aadwer.jpg?v=34e2" width="100" height="100" alt=""></div>
                                    <h4 class="testimonial-name m-b5">Sydney, Alisa</h4>
                                    <span class="testimonial-position">Committe Chairman</span>
                                </div>
                                <div class="testimonial-text">
                                    <span class="fa fa-quote-right"></span>
                                    <p>I’m grateful for the opportunities this association provides. The events and workshops are fantastic, but it’s the camaraderie and shared passion that make it truly special.</p>
                                </div>
                            </div>
                        </div>
                    </div> -->
                <!-- <div class="item">
                        <div class="testimonial-2 m-a30  hover-animation-1">
                            <div class=" block-shadow bg-white p-a30">
                                <div class="testimonial-detail clearfix">
                                    <div class="testimonial-pic radius shadow scale-in-center"><img src="images//management/Jacob_KUUSU_Secretary_General.JPG?v=887" width="100" height="100" alt=""></div>
                                    <h4 class="testimonial-name m-b5">Jacob Kuusu</h4>
                                    <span class="testimonial-position">Committe Provost</span>
                                </div>
                                <div class="testimonial-text">
                                    <span class="fa fa-quote-right"></span>
                                    <p>The Australia Alumni Association feels like family. The shared experiences and collaborative spirit among members have not only helped my career but also created lifelong friendships.</p>
                                </div>
                            </div>
                        </div>
                    </div> -->
                <!-- <div class="item">
                        <div class="testimonial-2 m-a30  hover-animation-1">
                            <div class=" block-shadow bg-white p-a30">
                                <div class="testimonial-detail clearfix">
                                    <div class="testimonial-pic radius shadow scale-in-center"><img src="images/management/Dr_Osayande_OSAGIE_Alumni_Ambassador.jpg" width="100" height="100" alt=""></div>
                                    <h4 class="testimonial-name m-b5">Osayande Osagie -</h4>
                                    <span class="testimonial-position">Builder</span>
                                </div>                                    
                                <div class="testimonial-text">
                                    <span class="fa fa-quote-right"></span>
                                    <p>Being part of this community has opened so many doors for me. The support and encouragement I’ve received from fellow alumni inspire me every day to strive for more.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-2 m-a30  hover-animation-1">
                            <div class=" block-shadow bg-white p-a30">
                                <div class="testimonial-detail clearfix">
                                    <div class="testimonial-pic radius shadow scale-in-center"><img src="images/management/Fatima_Ibrahim_MAIKORE_Financial_Secretary/fatima_ibrahim.jpg?v=998-0-9" width="100" height="100" alt=""></div>
                                    <h4 class="testimonial-name m-b5">Fatima Ibrahim -</h4>
                                    <span class="testimonial-position">Business Person</span>
                                </div>                                    
                                <div class="testimonial-text">
                                    <span class="fa fa-quote-right"></span>
                                    <p>Joining the Australia Alumni Association of Nigeria has been transformative for me. The friendships I’ve built and the professional connections I’ve made have truly enriched my life.</p>
                                </div>
                            </div>
                        </div>
                    </div> -->
                <!-- <div class="item">
                        <div class="testimonial-2 m-a30  hover-animation-1">
                            <div class=" block-shadow bg-white p-a30">
                                <div class="testimonial-detail clearfix">
                                    <div class="testimonial-pic radius shadow scale-in-center"><img src="images/testimonials/pic5.jpg" width="100" height="100" alt=""></div>
                                    <h4 class="testimonial-name m-b5">Cuthbert Brain -</h4>
                                    <span class="testimonial-position">Business Person</span>
                                </div>                                    
                                <div class="testimonial-text">
                                    <span class="fa fa-quote-right"></span>
                                    <p>The template itself is very ext ended. excellent customer support!.  simply dummy text of the printing and industry. the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                                </div>
                            </div>
                        </div>
                    </div> -->

                <!-- </div> -->

            </div>
        </div>
        <!-- <div class="hilite-title text-left p-l50 text-uppercase text-pop-up-top">
            <strong>Executive Committee</strong>
        </div> -->
    </div>
    <!-- TESTIMONIALS SECTION END -->




</div>
<!-- CONTENT END -->


<?php
include_once("_common/footer.php");
?>
<script type="text/javascript" src="js/ausconnect.js?v=<?php echo @filemtime(__DIR__ . '/js/ausconnect.js'); ?>"></script>
