<?php
// Using token-based authentication
include_once("_common/header.php");
?>

        <!-- CONTENT START -->
        <div class="page-content">
             
            <!-- SECTION CONTENT START -->
            <div class="section-full p-tb80 inner-page-padding">
                <div class="container">
                    <div class="section-content">
                        <div class="row">
                        	<div class="col-md-6 col-sm-6">
                            	<span class="contact-form cons-contact-form">
                                    <div class="contact-one m-b30">
                                    
                                    <div class="section-head">
                                        <div class="mt-separator-outer separator-left">
                                            <div class="mt-separator">
                                                <h2 class="text-uppercase sep-line-one "><span class="font-weight-300 text-primary">Forgot</span> Password</h2>
                                            </div>
                                        </div>
                                    </div>                   
                                                                        
                                    <!-- Step 1: Request code -->
                                    <div id="step-1">
                                        <div class="form-group">
                                            <input name="email" type="email" class="form-control" required placeholder="Enter your email address" id="email">
                                        </div>
                                   
                                        <div class="form-group error-msg-div" style="color: red; display: none;" id="error_msg_div_1"></div>
                                        <div class="form-group success-msg-div" style="color: green; display: none;" id="success_msg_div_1"></div>
                                    
                                    	<div class="text-left">
                                            <button type="button" class="site-button btn-effect" id="request_code_btn">Send Code</button>
                                            <div class="dot_loader loader" id="loader_1" style="display: none; margin: 20px;"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Step 2: Code verification and new password -->
                                    <div id="step-2" style="display: none;">
                                        <div class="form-group">
                                            <input name="code" type="text" class="form-control" required placeholder="Enter the 6-digit code sent to your email" id="code">
                                        </div>

                                        <div class="form-group">
                                            <input name="new_password" type="password" class="form-control" required placeholder="New Password" id="new_password">
                                        </div>

                                        <div class="form-group">
                                            <input name="confirm_password" type="password" class="form-control" required placeholder="Confirm New Password" id="confirm_password">
                                        </div>
                                   
                                        <div class="form-group error-msg-div" style="color: red; display: none;" id="error_msg_div_2"></div>
                                        <div class="form-group success-msg-div" style="color: green; display: none;" id="success_msg_div_2"></div>
                                    
                                    	<div class="text-left">
                                            <button type="button" class="site-button btn-effect" id="reset_password_btn">Reset Password</button>
                                            <div class="dot_loader loader" id="loader_2" style="display: none; margin: 20px;"></div>
                                        </div>
                                    </div>

                                    <div class="form-group" style="padding-top: 10px; font-size: 16px">
                                        <br>
                                        <a href="login"><u>Back to login</u></a>  
                                    </div>

                                    </div>
                                </span>
                            </div>                        
                        </div>
                    </div>
                </div>
           </div>
        </div>
        <!-- CONTENT END -->

<?php
include_once("_common/footer.php");
?>
<script type="text/javascript" src="js/forgot_password.js?v=<?php echo rand(1,1000); ?>"></script>
