<?php
include_once("_common/header_member.php");
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
                                <h2 class="text-black text-uppercase sep-line-one"><span class="font-weight-300 text-primary"></span> My Profile</h2>
                            </div>
                        </div>
                    </div>

                    <div class="section-content m-b30">
                        <div class="bg-white block-shadow p-a30" style="border-radius: 8px;">
                            <div class="row">
                                <div class="col-md-4 col-sm-5 text-center m-b20">
                                    <img id="profile_photo" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20viewBox%3D%220%200%20240%20240%22%3E%3Crect%20width%3D%22240%22%20height%3D%22240%22%20fill%3D%22%23eef2f7%22/%3E%3Ccircle%20cx%3D%22120%22%20cy%3D%2288%22%20r%3D%2248%22%20fill%3D%22%2399a3b3%22/%3E%3Cpath%20d%3D%22M40%20210c12-44%2050-68%2080-68s68%2024%2080%2068%22%20fill%3D%22%2399a3b3%22/%3E%3C/svg%3E" alt="Profile photo" style="width: 220px; height: 220px; object-fit: cover; border-radius: 12px; border: 1px solid #ddd;">
                                </div>
                                <div class="col-md-8 col-sm-7">
                                    <h3 id="profile_fullname" style="margin-top: 10px; margin-bottom: 8px;">Member Name</h3>
                                    <h5 id="profile_job_title" style="color: #666; margin-bottom: 20px;">Job Title</h5>
                                    <p id="profile_about" style="min-height: 60px; color: #555;">Profile information will appear here.</p>
                                    <a href="profile_edit" class="site-button button-sm radius-no text-uppercase font-weight-600" style="padding: 10px 18px; font-size: 16px;">Update Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-content m-b50">
                        <div class="bg-white block-shadow p-a30" style="border-radius: 8px;">
                            <div id="profile_message" style="display:none; margin-bottom: 20px;"></div>
                            <div id="no-more-tables">
                                <table class="table-striped table-condensed cf mt-responsive-table">
                                    <tbody>
                                        <tr><td data-title="Username">Username</td><td data-title="Value" id="view_username">-</td></tr>
                                        <tr><td data-title="First Name">First Name</td><td data-title="Value" id="view_firstname">-</td></tr>
                                        <tr><td data-title="Last Name">Last Name</td><td data-title="Value" id="view_lastname">-</td></tr>
                                        <tr><td data-title="Other Names">Other Names</td><td data-title="Value" id="view_othernames">-</td></tr>
                                        <tr><td data-title="Gender">Gender</td><td data-title="Value" id="view_gender">-</td></tr>
                                        <tr><td data-title="Date of Birth">Date of Birth</td><td data-title="Value" id="view_dob">-</td></tr>
                                        <tr><td data-title="Email">Email</td><td data-title="Value" id="view_email">-</td></tr>
                                        <tr><td data-title="Phone">Phone</td><td data-title="Value" id="view_phone">-</td></tr>
                                        <tr><td data-title="Alternate Phone">Alternate Phone</td><td data-title="Value" id="view_phone2">-</td></tr>
                                        <tr><td data-title="Marital Status">Marital Status</td><td data-title="Value" id="view_marital_status">-</td></tr>
                                        <tr><td data-title="Profession">Profession</td><td data-title="Value" id="view_profession">-</td></tr>
                                        <tr><td data-title="Professional Description">Professional Description</td><td data-title="Value" id="view_profession_desc">-</td></tr>
                                        <tr><td data-title="Organization Type">Organization Type</td><td data-title="Value" id="view_organization_type">-</td></tr>
                                        <tr><td data-title="Name of Organization">Name of Organization</td><td data-title="Value" id="view_organization_name">-</td></tr>
                                        <tr><td data-title="Cadre">Cadre</td><td data-title="Value" id="view_current_role">-</td></tr>
                                        <tr><td data-title="Program Completed at Australia">Program Completed at Australia</td><td data-title="Value" id="view_australia_program">-</td></tr>
                                        <tr><td data-title="Institution Attended in Australia">Institution Attended in Australia</td><td data-title="Value" id="view_australia_institution">-</td></tr>
                                        <tr><td data-title="Area of Expertise">Area of Expertise</td><td data-title="Value" id="view_expertise">-</td></tr>
                                        <tr><td data-title="Current Country of Residence">Current Country of Residence</td><td data-title="Value" id="view_country">-</td></tr>
                                        <tr><td data-title="State of Residence">State of Residence</td><td data-title="Value" id="view_state">-</td></tr>
                                        <tr><td data-title="City">City</td><td data-title="Value" id="view_city">-</td></tr>
                                        <tr><td data-title="Address">Address</td><td data-title="Value" id="view_address">-</td></tr>
                                        <tr><td data-title="About">About</td><td data-title="Value" id="view_about">-</td></tr>
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

<?php
include_once("_common/footer_member.php");
?>
<script type="text/javascript" src="js/profile.js?v=<?php echo rand(1,1000); ?>"></script>
