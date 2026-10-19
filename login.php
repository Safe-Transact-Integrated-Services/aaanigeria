<?php
// Using token-based authentication
include_once("_common/header.php");
?>

<!-- JavaScript to check if user is already logged in -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var authToken = localStorage.getItem('auth_token');
    
    // If user has valid auth token, redirect to profile
    if (authToken && authToken !== '' && authToken !== 'null') {
        // Verify token is still valid by checking with API
        $.ajax({
            type: "POST",
            url: base_url+"user/does_token_exist",
            headers: {
                'Authorization': authToken
            },
            success: function(response) {
                if (response.status == 200) {
                    // Token is valid, redirect to profile
                    window.location.href = 'profile';
                }
            },
            error: function() {
                // Token is invalid, stay on login page
                localStorage.clear();
            }
        });
    }
});
</script>
        
        <!-- CONTENT START -->
        <div class="page-content">
        
            <!-- INNER PAGE BANNER -->
            <!-- <div class="mt-bnr-inr overlay-wraper bg-parallax bg-top-center"  data-stellar-background-ratio="0.5"  style="background-image:url(images/banner/4.jpg);">
            	<div class="overlay-main bg-black opacity-07"></div>
                <div class="container">
                    <div class="mt-bnr-inr-entry">
                    	<div class="banner-title-outer">
                        	<div class="banner-title-name">
                        		<h2 class="m-b0">Putting a plan to action, to assure your satisfaction!</h2>
                            </div>
                        </div>
                                                   
                        
                            <div>
                                <ul class="mt-breadcrumb breadcrumb-style-2">
                                    <li><a href="javascript:void(0);">Home</a></li>
                                    <li>Contact Us</li>
                                </ul>
                            </div>
                        
                                                
                    </div>
                </div>
            </div> -->
            <!-- INNER PAGE BANNER END -->
             
            <!-- SECTION CONTENTG START -->
            <div class="section-full p-tb80 inner-page-padding">
                <!-- LOCATION BLOCK-->
                <div class="container">
                
                    <!-- GOOGLE MAP & CONTACT FORM -->
                    <div class="section-content">
                        <!-- CONTACT FORM-->
                        <div class="row">
                        	<div class="col-md-6 col-sm-6">
                            	<span class="contact-form cons-contact-form">
                                    <form id="login_form" class="contact-one m-b30" novalidate>
                                    
                                    <!-- TITLE START -->
                                    <div class="section-head">
                                        <div class="mt-separator-outer separator-left">
                                            <div class="mt-separator">
                                                <h2 class="text-uppercase sep-line-one "><span class="font-weight-300 text-primary">Member</span> Login</h2>
                                            </div>
                                        </div>
                                    </div>                   
                                    <!-- TITLE END --> 
                                                                        
                                        <!-- <div class="form-group">
                                            <input name="username" type="text" required class="form-control" placeholder="Name">
                                        </div> -->
                                   
                                        <div class="form-group">
                                            <input name="email" type="text" class="form-control" required placeholder="Email" id="email">
                                        </div>

                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control" required placeholder="Password" id="password">
                                        </div>
                                   
                                        <div class="form-group" style="color: red; display: none;" id="error_msg_div">
                                            
                                        </div>
                                    
                                    	<div class="text-left">

                                            <button name="submit" type="submit" value="Submit" class="site-button btn-effect" id="login">Login
                                            </button>

                                            <div class="dot_loader" id="login_loader" style="display: none; margin: 20px;"></div>

                                        </div>


                                        <div class="form-group" style="padding-top: 10px;">
                                            <a href="forgot_password"><u>Forgot Password?</u></a>
                                        </div>

                                        <div class="form-group" style="color: ; display: ; margin-top: 20px; font-size: 16px" id="">
                                          <a href="register"><u>Register, if you don't have an account</u></a>  
                                        </div>

                                    </form>
                                </span>
                            </div>                        
                                               
                        </div>
                    </div>

                    <br><br>
                    
                    <!-- <div class="gmap-outline">
                        <div id="gmap_canvas2" class="google-map"></div>
                    </div> -->                    
                </div>
           </div>
         
            <!-- SECTION CONTENT END -->
            
        </div>
        <!-- CONTENT END -->

<?php
include_once("_common/footer.php");
?>
<script type="text/javascript" src="js/login.js?v=<?php echo rand(1,1000); ?>"></script>
