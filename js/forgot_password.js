$(document).ready(function() {

    $("#request_code_btn").on('click', requestCode);
    $("#reset_password_btn").on('click', resetPassword);

});

function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function requestCode() {
    var email = $.trim($("#email").val());
    
    $("#error_msg_div_1").hide();
    $("#success_msg_div_1").hide();

    if (email === "") {
        $("#error_msg_div_1").show().html("Please enter your email.");
        return;
    }
    if (!validateEmail(email)) {
        $("#error_msg_div_1").show().html("Please provide a valid email address.");
        return;
    }

    $("#loader_1").show();
    $("#request_code_btn").hide();

    $.ajax({
        type: "POST",
        url: base_url + "user/forgot_password",
        data: {
            email_address: email
        },
        success: function(response) {
            $("#loader_1").hide();
            $("#request_code_btn").show();
            
            if (response.status == 200) {
                // success
                $("#step-1").hide();
                $("#step-2").show();
                $("#success_msg_div_2").show().html("A recovery code has been sent to your email.");
            } else {
                $("#error_msg_div_1").show().html(response.msg || "Error occurred.");
            }
        },
        error: function(xhr, status, error) {
            $("#loader_1").hide();
            $("#request_code_btn").show();
            $("#error_msg_div_1").show().html("An error occurred. Please try again.");
        }
    });
}

function resetPassword() {
    var email = $.trim($("#email").val());
    var code = $.trim($("#code").val());
    var newPassword = $.trim($("#new_password").val());
    var confirmPassword = $.trim($("#confirm_password").val());

    $("#error_msg_div_2").hide();
    $("#success_msg_div_2").hide();

    if (code === "" || newPassword === "" || confirmPassword === "") {
        $("#error_msg_div_2").show().html("Please fill in all fields.");
        return;
    }

    if (newPassword !== confirmPassword) {
        $("#error_msg_div_2").show().html("Passwords do not match.");
        return;
    }

    if (newPassword.length < 6) {
        $("#error_msg_div_2").show().html("Password must be at least 6 characters.");
        return;
    }

    $("#loader_2").show();
    $("#reset_password_btn").hide();

    $.ajax({
        type: "POST",
        url: base_url + "user/update_password",
        data: {
            email: email,
            v_code: code,
            password: newPassword
        },
        success: function(response) {
            $("#loader_2").hide();
            
            if (response.status == 200 || response.msg === "Ok") {
                $("#success_msg_div_2").show().html("Password successfully updated! Redirecting to login...");
                setTimeout(function() {
                    window.location.href = "login";
                }, 2000);
            } else {
                $("#reset_password_btn").show();
                $("#error_msg_div_2").show().html(response.msg || "Error updating password.");
            }
        },
        error: function(xhr, status, error) {
            $("#loader_2").hide();
            $("#reset_password_btn").show();
            $("#error_msg_div_2").show().html("An error occurred. Please try again.");
        }
    });

}
