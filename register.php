<?php
include_once("_common/header.php");
include_once("_common/profession_options.php");
$professionOptions = get_aaan_professions();
?>

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
                <div class="row" id="reg_form">
                    <div class="col-md-6 col-sm-6">
                        <span class="contact-form cons-contact-form">
                            <div class="contact-one m-b30">

                                <!-- TITLE START -->
                                <div class="section-head">
                                    <div class="mt-separator-outer separator-left">
                                        <div class="mt-separator">
                                            <h2 class="text-uppercase sep-line-one "><span class="font-weight-300 text-primary">Member</span> Registration.</h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="text" class="form-control" required id="email">
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input name="phone" type="text" class="form-control" required id="phone" maxlength="11">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="password" class="form-control" required id="password">
                                </div>

                                <div class="form-group">
                                    <label>Firstname</label>
                                    <input name="firstname" type="text" class="form-control" required id="firstname">
                                </div>

                                <div class="form-group">
                                    <label>Lastname</label>
                                    <input name="lastname" type="text" class="form-control" required id="lastname">
                                </div>

                                <div class="form-group">
                                    <label>Username (Optional)</label>
                                    <input name="username" type="text" class="form-control" id="username">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6" style="margin-bottom: 15px;">
                                            <label>Day of Birth</label>
                                            <select name="dob_day" class="form-control" id="dob_day" onchange="updateDob()">
                                                <option value="">Select Day</option>
                                                <?php for($i=1; $i<=31; $i++) { $val = str_pad($i, 2, '0', STR_PAD_LEFT); echo "<option value='$val'>$i</option>"; } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>Month of Birth</label>
                                            <select name="dob_month" class="form-control" id="dob_month" onchange="updateDob()">
                                                <option value="">Select Month</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="dob" id="dob" value="">
                                    <script>
                                        function updateDob() {
                                            var day = document.getElementById('dob_day').value;
                                            var month = document.getElementById('dob_month').value;
                                            if(day && month) {
                                                document.getElementById('dob').value = day + '/' + month;
                                            } else {
                                                document.getElementById('dob').value = '';
                                            }
                                        }
                                    </script>
                                </div>

                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control" required id="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Profession</label>
                                    <select name="profession" class="form-control" required id="profession">
                                        <option value="">Select Profession</option>
                                        <?php foreach ($professionOptions as $professionOption): ?>
                                            <option value="<?php echo htmlspecialchars($professionOption, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($professionOption, ENT_QUOTES, 'UTF-8'); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Organization Type</label>
                                    <select name="organization_type" class="form-control" required id="organization_type">
                                        <option value="">Select Organization Type</option>
                                        <option value="Public">Public</option>
                                        <option value="Private">Private</option>
                                        <option value="NGO">NGO</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Name of Organization</label>
                                    <input name="organization_name" type="text" class="form-control" required id="organization_name">
                                </div>

                                <div class="form-group">
                                    <label>Cadre</label>
                                    <input name="current_role" type="text" class="form-control" required id="current_role">
                                </div>

                                <div class="form-group">
                                    <label>Program Completed at Australia</label>
                                    <input name="australia_program" type="text" class="form-control" required id="australia_program">
                                </div>

                                <div class="form-group">
                                    <label>Institution Attended in Australia</label>
                                    <input name="australia_institution" type="text" class="form-control" required id="australia_institution">
                                </div>

                                <div class="form-group">
                                    <label>Area of Expertise</label>
                                    <select name="expertise" class="form-control" required id="expertise">
                                        <option value="">Select Area of Expertise</option>
                                        <option value="Agribusiness">Agribusiness</option>
                                        <option value="Accounting">Accounting</option>
                                        <option value="Education">Education</option>
                                        <option value="Health">Health</option>
                                        <option value="Climate Change">Climate Change</option>
                                        <option value="Environmental Management">Environmental Management</option>
                                        <option value="Renewable Energy">Renewable Energy</option>
                                        <option value="Sustainable Mining">Sustainable Mining</option>
                                        <option value="Climate Finance">Climate Finance</option>
                                        <option value="Development Finance">Development Finance</option>
                                        <option value="Public Policy">Public Policy</option>
                                        <option value="International Trade and Policy">International Trade and Policy</option>
                                        <option value="Agriculture">Agriculture</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Current Country of Residence</label>
                                    <select name="country" class="form-control" required id="country">
                                        <option value="">Select Country</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Nigeria">Nigeria</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>State of Residence</label>
                                    <select name="state" class="form-control" required id="state">
                                        <option value="">Select State</option>
                                    </select>
                                </div>


                                <div class="form-group" style="padding: 12px; border-radius: 4px; display: none;" id="error_msg_div">

                                </div>

                                <div class="text-left">

                                    <button name="submit" type="submit" value="Submit" class="site-button btn-effect" id="register">Register
                                    </button>

                                    <div class="dot_loader" id="register_loader" style="display: none; margin: 20px;"></div>

                                </div>


                                <div class="form-group" style="margin-top: 20px; font-size: 16px">
                                    <a href="login"><u>Back to Login</u></a>
                                </div>

                            </div>
                        </span>
                    </div>

                </div>


                <!-- <div class="row" id="confirm_form" style="display: none">
                            <div class="col-md-6 col-sm-6">
                                <span class="contact-form cons-contact-form">

                                    <div class="contact-one m-b30">
                                    
                                        
                                        <div class="section-head">
                                            <div class="mt-separator-outer separator-left">
                                                <div class="mt-separator">
                                                    <h2 class="text-uppercase sep-line-one "><span class="font-weight-300 text-primary">Confirm</span> Registration</h2>
                                                </div>
                                            </div>
                                        </div>                   
                                   
                                        <div class="form-group">
                                            <input name="code" type="text" class="form-control" required placeholder="Code" id="code">
                                        </div>
                                    
                                        <div class="text-left">

                                            <button name="submit" type="submit" value="Submit" class="site-button btn-effect" id="confirm_reg">
                                                Confirm
                                            </button>

                                            <div class="dot_loader" id="confirm_loader" style="display: none; margin: 20px;">
                                                
                                            </div>

                                        </div>


                                        <div class="form-group" style="margin-top: 20px; font-size: 16px">
                                          <a href="registration"><u>Back to Login</u></a>  
                                        </div>

                                    </div>
                                </span>
                            </div>                        
                                               
                        </div> -->





                <div class="row" id="confirm_form" style="display: none">
                    <div class="col-md-6 col-sm-6">
                        <span class="contact-form cons-contact-form">

                            <div class="contact-one m-b30">

                                <!-- TITLE START -->
                                <div class="section-head">
                                    <div class="mt-separator-outer separator-left">
                                        <div class="mt-separator">
                                            <h2 class="text-uppercase sep-line-one "><span class="font-weight-300 text-primary">Thanks</span> for Registering</h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    Thanks for registering. We will get back to you soon after reviewing your registration.
                                </div>


                                <div class="form-group" style="margin-top: 20px; font-size: 16px">
                                    <a href="login"><u>Back to Login</u></a>
                                </div>

                            </div>
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
<script type="text/javascript" src="js/register.js?v=<?php echo rand(1, 1000); ?>"></script>
