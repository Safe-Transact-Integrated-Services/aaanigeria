<?php
include_once("_common/header.php");
?>

<!-- CONTENT START -->
<div class="page-content">

    <!-- INNER PAGE BANNER -->
    <div class="mt-bnr-inr overlay-wraper bg-parallax bg-top-center" data-stellar-background-ratio="0.5" style="background-image:url(images/banner/1.jpg);">
        <div class="overlay-main bg-black opacity-07"></div>
        <div class="container">
            <div class="mt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        <h2 class="m-b0">Get In Touch</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->

                <div>
                    <ul class="mt-breadcrumb breadcrumb-style-2">
                        <li><a href="index">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>

                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

    <!-- SECTION CONTENTG START -->
    <div class="section-full p-tb80 inner-page-padding">
        <!-- LOCATION BLOCK-->
        <div class="container">

            <div class="section-content">
                <div class="row">
                    <!-- CONTACT FORM-->
                    <div class="col-md-7 col-sm-6">
                        <span class="contact-form cons-contact-form">
                            <div class="contact-one m-b30">

                                <!-- TITLE START -->
                                <div class="section-head">
                                    <div class="mt-separator-outer separator-left">
                                        <div class="mt-separator">
                                            <h2 class="text-uppercase sep-line-one "><span class="font-weight-300 text-primary">Contact</span> Us</h2>
                                        </div>
                                    </div>
                                    <p>Have questions, ideas, or want to collaborate? Use the form below to drop us a message.</p>
                                </div>
                                <!-- TITLE END -->

                                <div class="form-group">
                                    <input id="contact_name" name="username" type="text" class="form-control" required placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <input id="contact_email" name="email" type="email" class="form-control" required placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <input id="contact_subject" name="subject" type="text" class="form-control" required placeholder="Subject">
                                </div>

                                <div class="form-group">
                                    <textarea id="contact_message" name="message" rows="4" class="form-control" required placeholder="Message"></textarea>
                                </div>

                                <div id="contact_alert" style="display:none; padding:10px; margin-bottom:15px; border-radius:4px;"></div>

                                <div class="text-left">
                                    <button id="btn_submit_contact" name="submit" type="submit" value="Submit" class="site-button btn-effect">
                                        Send Message
                                    </button>
                                </div>

                            </div>
                        </span>
                    </div>

                    <!-- CONTACT INFO -->
                    <div class="col-md-5 col-sm-6">
                        <div class="contact-info m-b30">
                            <!-- TITLE START -->
                            <div class="section-head">
                                <div class="mt-separator-outer separator-left">
                                    <div class="mt-separator">
                                        <h2 class="text-uppercase sep-line-one "><span class="font-weight-300 text-primary">Contact</span> Info</h2>
                                    </div>
                                </div>
                            </div>
                            <!-- TITLE END -->
                            <div class="bg-dark p-a20 text-white">
                                <div class="mt-icon-box-wraper left p-b40">
                                    <div class="icon-xs"><i class="fa fa-phone"></i></div>
                                    <div class="icon-content">
                                        <h5 class="m-t0 font-weight-500">Phone number</h5>
                                        <p>(+234) 803-7132-683</p>
                                    </div>
                                </div>

                                <div class="mt-icon-box-wraper left p-b40">
                                    <div class="icon-xs"><i class="fa fa-envelope"></i></div>
                                    <div class="icon-content">
                                        <h5 class="m-t0 font-weight-500">Email address</h5>
                                        <p>info@aaanigeria.com</p>
                                    </div>
                                </div>

                                <div class="mt-icon-box-wraper left">
                                    <div class="icon-xs"><i class="fa fa-map-marker"></i></div>
                                    <div class="icon-content">
                                        <h5 class="m-t0 font-weight-500">Address info</h5>
                                        <p>Haven Estate, Life Camp, Abuja.</p>
                                    </div>
                                </div>
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
include_once("_common/footer.php");
?>
<script>
    $('#btn_submit_contact').on('click', function(e) {
        e.preventDefault();

        let username = $('#contact_name').val().trim();
        let email = $('#contact_email').val().trim();
        let subject = $('#contact_subject').val().trim();
        let message = $('#contact_message').val().trim();
        let alertBox = $('#contact_alert');

        alertBox.hide();

        if (username === '' || email === '' || subject === '' || message === '') {
            alertBox.html('Please fill all fields.').css({
                'display': 'block',
                'background': '#f8d7da',
                'color': '#721c24'
            });
            return;
        }

        let btn = $(this);
        let originalText = btn.html();
        btn.html('<i class="fa fa-spinner fa-spin"></i> Sending...').prop('disabled', true);

        $.ajax({
            type: "POST",
            url: base_url + "user/submit_contact",
            data: {
                username: username,
                email: email,
                subject: subject,
                message: message
            },
            success: function(response) {
                if (response.status === 200 || response.status === '200') {
                    alertBox.html('Your message has been sent successfully! We will get back to you shortly.').css({
                        'display': 'block',
                        'background': '#d4edda',
                        'color': '#155724'
                    });
                    $('#contact_name').val('');
                    $('#contact_email').val('');
                    $('#contact_subject').val('');
                    $('#contact_message').val('');
                } else {
                    alertBox.html(response.msg || 'There was an issue sending your message. Please try again.').css({
                        'display': 'block',
                        'background': '#f8d7da',
                        'color': '#721c24'
                    });
                }
            },
            error: function(xhr, status, error) {
                alertBox.html('An unexpected error occurred. Please try again later.').css({
                    'display': 'block',
                    'background': '#f8d7da',
                    'color': '#721c24'
                });
            },
            complete: function() {
                btn.html(originalText).prop('disabled', false);
            }
        });
    });
</script>