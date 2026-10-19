<?php
// Using token-based authentication
include_once("_common/header_member.php");
?>

<!-- Authentication Check -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var authToken = localStorage.getItem('auth_token');
    
    // If user doesn't have valid auth token, redirect to login
    if (!authToken || authToken === '' || authToken === 'null') {
        alert("You are not logged in. Please login to access resources.");
        window.location.href = 'login';
        return;
    }
    
    // Verify token is still valid
    $.ajax({
        type: "POST",
        url: base_url+"user/does_token_exist",
        headers: {
            'Authorization': authToken
        },
        success: function(response) {
            if (response.status !== 200) {
                // Token is invalid
                localStorage.clear();
                alert("Your session has expired. Please login again.");
                window.location.href = 'login';
            }
        },
        error: function() {
            // Token is invalid/API error
            localStorage.clear();
            alert("Authentication failed. Please login again.");
            window.location.href = 'login';
        }
    });
});
</script>

<!-- CONTENT START -->
<div class="page-content">
     
    <!-- SECTION CONTENTG START -->
    <div class="section-full p-tb80 inner-page-padding">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 col-sm-4">

                        <?php
                        include_once("_common/menu_member.php");
                        ?>
                                                                                                        
                    </div>

                    <div class="col-md-9 col-sm-8"> 

                        <!-- TITLE START -->
                        <div class="section-head">
                            <div class="mt-separator-outer separator-left">
                                <div class="mt-separator">
                                    <h2 class="text-black text-uppercase sep-line-one "><span class="font-weight-300 text-primary"></span> Resources</h2>
                                </div>
                            </div>
                        </div>                   
                        <!-- TITLE END -->                                    
                                         
                        <!-- ICON BOX -->
                        <div class="section-content m-b0">
                            
                            
                            <!-- ICON BOX -->
                                                                
                            <div class="row">

                                <!-- <div class="col-md-12 col-sm-12 m-b30">
                                    <div class="mt-icon-box-wraper bx-style-1 p-a20 left bg-white block-shadow">
                                        <div class="mt-icon-box-xs text-secondry bg-white radius bdr-1  bdr-solid scale-in-center">
                                            <span class="icon-cell text-secondry"><i class="fa fa-trophy"></i></span>
                                        </div>
                                        <div class="icon-content">
                                            <h4 class="mt-tilte">Notice Board</h4>
                                            <p>We are having a call to all our members to confirm their membership. Please comply if you receive a phone call from 08093421182</p>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-md-12 col-sm-12 m-b30">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Size</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>Association Constitution</td>
                                                <td>12kb</td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Australia Commission Document</td>
                                                <td>134kb</td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>Nigeria Locations Document</td>
                                                <td>1MB</td>
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
   
               
    <!-- SECTION CONTENT END -->
    
</div>
<!-- CONTENT END -->



<?php
include_once("_common/footer_member.php");
?>
<script type="text/javascript" src="js/user.js?v=<?php echo rand(1,1000); ?>"></script>