<?php
include_once("_common/header_member.php");
include_once("_common/profession_options.php");
$professionOptions = get_aaan_professions();
?>

<div class="page-content">
    <div class="section-full p-tb80 inner-page-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <?php include_once("_common/menu_member.php"); ?>
                </div>
                <div class="col-md-9 col-sm-8">
                    <div class="section-head">
                        <div class="mt-separator-outer separator-left">
                            <div class="mt-separator">
                                <h2 class="text-black text-uppercase sep-line-one"><span class="font-weight-300 text-primary"></span> Edit Profile</h2>
                            </div>
                        </div>
                    </div>

                    <div class="section-content m-b30">
                        <div class="bg-white block-shadow p-a30" style="border-radius: 8px;">
                            <div class="row">
                                <div class="col-md-4 col-sm-5 text-center m-b20">
                                    <img id="profile_photo_preview" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20viewBox%3D%220%200%20240%20240%22%3E%3Crect%20width%3D%22240%22%20height%3D%22240%22%20fill%3D%22%23eef2f7%22/%3E%3Ccircle%20cx%3D%22120%22%20cy%3D%2288%22%20r%3D%2248%22%20fill%3D%22%2399a3b3%22/%3E%3Cpath%20d%3D%22M40%20210c12-44%2050-68%2080-68s68%2024%2080%2068%22%20fill%3D%22%2399a3b3%22/%3E%3C/svg%3E" alt="Profile photo" style="width: 220px; height: 220px; object-fit: cover; border-radius: 12px; border: 1px solid #ddd; margin-bottom: 15px;">
                                    <div>
                                        <input type="file" id="profile_photo_input" accept="image/*" style="display: none;">
                                        <button class="site-button button-sm radius-no" type="button" id="upload_photo_btn" style="margin-right: 8px; margin-bottom: 8px;">Upload</button>
                                        <button class="site-button button-sm radius-no" type="button" id="replace_photo_btn" style="margin-right: 8px; margin-bottom: 8px;">Replace</button>
                                        <button class="site-button button-sm radius-no" type="button" id="delete_photo_btn" style="background-color: #c9302c; border-color: #c9302c; margin-bottom: 8px;">Delete</button>
                                    </div>
                                    <p style="color: #777; font-size: 13px; margin-top: 10px;">Choose a photo from your system files.</p>
                                </div>
                                <div class="col-md-8 col-sm-7">
                                    <div id="profile_edit_message" style="display:none; margin-bottom: 20px;"></div>
                                    <table class="table-striped table-condensed cf mt-responsive-table">
                                        <tbody>
                                            <tr>
                                                <td data-title="Firstname">Firstname</td>
                                                <td data-title="Value"><input class="form-control" type="text" placeholder="Firstname" id="firstname"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Lastname">Lastname</td>
                                                <td data-title="Value"><input class="form-control" type="text" placeholder="Lastname" id="lastname"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Other Names">Other Names</td>
                                                <td data-title="Value"><input class="form-control" type="text" placeholder="Other Names" id="othernames"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Username">Username (Optional)</td>
                                                <td data-title="Value"><input class="form-control" type="text" placeholder="Username" id="username"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Email">Email</td>
                                                <td data-title="Value"><input class="form-control" type="email" placeholder="Email" id="email" readonly></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Gender">Gender</td>
                                                <td data-title="Value"><select class="form-control" id="gender">
                                                        <option value="">-- Select --</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Date of Birth">Date of Birth</td>
                                                <td data-title="Value"><input type="text" class="form-control" id="dob" placeholder="DD/MM" maxlength="5"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Marital Status">Marital Status</td>
                                                <td data-title="Value"><select class="form-control" id="marital_status">
                                                        <option value="">-- Select --</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Divorced">Divorced</option>
                                                        <option value="Widowed">Widowed</option>
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Phone">Phone</td>
                                                <td data-title="Value"><input type="number" class="form-control" id="phone" placeholder="Phone Number"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Alternate Phone">Alternate Phone</td>
                                                <td data-title="Value"><input type="number" class="form-control" id="phone2" placeholder="Alternate Phone"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Profession">Profession</td>
                                                <td data-title="Value">
                                                    <select class="form-control" id="profession">
                                                        <option value="">Select Profession</option>
                                                        <?php foreach ($professionOptions as $professionOption): ?>
                                                            <option value="<?php echo htmlspecialchars($professionOption, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($professionOption, ENT_QUOTES, 'UTF-8'); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td data-title="Professional Description">Professional Description</td>
                                                <td data-title="Value"><input type="text" class="form-control" id="profession_desc" placeholder="Professional Description"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Organization Type">Organization Type</td>
                                                <td data-title="Value"><select class="form-control" id="organization_type">
                                                        <option value="">-- Select --</option>
                                                        <option value="Public">Public</option>
                                                        <option value="Private">Private</option>
                                                        <option value="NGO">NGO</option>
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Name of Organization">Name of Organization</td>
                                                <td data-title="Value"><input type="text" class="form-control" id="organization_name" placeholder="Name of Organization"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Cadre">Cadre</td>
                                                <td data-title="Value"><input type="text" class="form-control" id="current_role" placeholder="Cadre"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Program Completed at Australia">Program Completed at Australia</td>
                                                <td data-title="Value"><input type="text" class="form-control" id="australia_program" placeholder="Program Completed at Australia"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Institution Attended in Australia">Institution Attended in Australia</td>
                                                <td data-title="Value"><input type="text" class="form-control" id="australia_institution" placeholder="Institution Attended in Australia"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Area of Expertise">Area of Expertise</td>
                                                <td data-title="Value"><input type="text" class="form-control" id="expertise" placeholder="Area of Expertise"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Current Country of Residence">Current Country of Residence</td>
                                                <td data-title="Value"><select class="form-control" id="country">
                                                        <option value="">-- Select --</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Nigeria">Nigeria</option>
                                                        <option value="Others">Others</option>
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td data-title="State of Residence">State of Residence</td>
                                                <td data-title="Value"><select class="form-control" id="state">
                                                        <option value="">-- Select --</option>
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td data-title="City">City</td>
                                                <td data-title="Value"><input type="text" class="form-control" id="city" placeholder="City"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="Address">Address</td>
                                                <td data-title="Value"><input type="text" class="form-control" id="address" placeholder="Address"></td>
                                            </tr>
                                            <tr>
                                                <td data-title="About">About Me</td>
                                                <td data-title="Value"><textarea class="form-control" rows="6" placeholder="About Me" id="about_me"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td data-title="Value">
                                                    <button class="site-button button-sm radius-no text-uppercase font-weight-600" type="button" style="padding: 10px; font-size: 18px" id="save_profile">Save Changes</button>
                                                    <a href="profile" class="site-button button-sm radius-no text-uppercase font-weight-600" style="padding: 10px; font-size: 18px; margin-left: 10px; background-color: #555; border-color: #555;">Cancel</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once("_common/footer_member.php");
?>
<script type="text/javascript" src="js/profile-edit.js?v=<?php echo rand(1, 1000); ?>"></script>
