$(document).ready(function() {

    $("#register").on('click', register);
    $("#confirm_reg").on('click', register);

    // Add field-level email validation and availability check on blur
    $("#email").on('blur', validateEmailField);
    $("#email").on('input', resetEmailAvailabilityState);
    $("#username").on('blur', validateUsernameField);
    $("#username").on('input', resetUsernameAvailabilityState);

    // Add field-level phone validation on blur
    $("#phone").on('blur', validatePhoneField);

    // Add field-level password validation on blur and input
    $("#password").on('blur input', validatePasswordField);

    // Keep the register button active while still validating on submit
    $("#register").prop("disabled", false).css({
        opacity: "1",
        cursor: "pointer"
    });

    // Handle country change to populate states
    $("#country").on('change', populateStates);

    // Check if the auth_token exists in localStorage
    if (localStorage.getItem('auth_token') != "" || localStorage.getItem('auth_token') != null) {

        //check if the token is valid
        $.ajax({

            type: "POST",
            url: base_url+"user/does_token_exist",
            data: {
                
            },
            headers: {
                'Authorization': localStorage.getItem('auth_token')
            },
            success: function(response) {

                // Check if login was successful
                if (response.status == 200) {

                    window.location.href = "user";  // Redirect to the login page

                } else {

                    localStorage.clear();

                }

            },
            error: function(xhr, status, error) {

                localStorage.clear();

            }

        });

    }else{



    }

});

var emailAvailabilityState = "unknown";
var emailAvailabilityMessages = {
    available: "Email available",
    exists: "Email has an existing account"
};
var usernameAvailabilityState = "unknown";
var usernameAvailabilityMessages = {
    available: "Username available",
    exists: "Username already exists"
};

// State data for countries
var stateData = {
    Australia: [
        "Australian Capital Territory",
        "New South Wales",
        "Northern Territory",
        "Queensland",
        "South Australia",
        "Tasmania",
        "Victoria",
        "Western Australia"
    ],
    Nigeria: [
        "Abia",
        "Adamawa",
        "Akwa Ibom",
        "Anambra",
        "Bauchi",
        "Bayelsa",
        "Benue",
        "Borno",
        "Cross River",
        "Delta",
        "Ebonyi",
        "Edo",
        "Ekiti",
        "Enugu",
        "FCT",
        "Gombe",
        "Imo",
        "Jigawa",
        "Kaduna",
        "Kano",
        "Katsina",
        "Kebbi",
        "Kogi",
        "Kwara",
        "Lagos",
        "Nasarawa",
        "Niger",
        "Ogun",
        "Ondo",
        "Osun",
        "Oyo",
        "Plateau",
        "Rivers",
        "Sokoto",
        "Taraba",
        "Yobe",
        "Zamfara"
    ]
};

function populateStates() {
    var country = $.trim($("#country").val());
    var stateElement = $("#state");
    var isSelect = stateElement.is("select");
    
    if (country === "Others") {
        if (isSelect) {
            var inputHtml = '<input type="text" name="state" class="form-control" required placeholder="State of residence" id="state">';
            stateElement.replaceWith(inputHtml);
        } else {
            $("#state").val('');
        }
    } else {
        if (!isSelect) {
            var selectHtml = '<select name="state" class="form-control" required placeholder="State of residence" id="state"><option value="">State of residence</option></select>';
            stateElement.replaceWith(selectHtml);
        }

        // Re-fetch the element after possible replacement
        stateElement = $("#state");

        // Clear current options except the first one
        stateElement.find('option:not(:first)').remove();
        stateElement.val('');
        
        // Populate states based on selected country
        if (country && stateData[country]) {
            stateData[country].forEach(function(state) {
                stateElement.append('<option value="' + state + '">' + state + '</option>');
            });
        }
    }
}

function validateEmail(email) {
    // Email regex pattern for validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validateEmailField() {
    var email = $.trim($("#email").val());
    var emailInput = $("input[name='email']");

    // Clear previous error state
    emailInput.removeClass("input-error");
    removeEmailMessage();

    if (email === "") {
        emailInput.addClass("input-error");
        showEmailMessage("Email is required", "#c9302c");
    } else if (!validateEmail(email)) {
        emailInput.addClass("input-error");
        showEmailMessage("Please provide a valid email address", "#c9302c");
    } else {
        checkEmailAvailability(email);
    }
}

function validatePassword(password) {
    // Password must be at least 6 characters
    return password.length >= 6;
}

function validateUsernameField() {
    var username = $.trim($("#username").val());
    var usernameInput = $("input[name='username']");

    usernameInput.removeClass("input-error");
    removeUsernameMessage();

    if (username === "") {
        usernameAvailabilityState = "unknown";
        return;
    }

    checkUsernameAvailability(username);
}

function validatePhone(phone) {
    // Phone number regex pattern - accepts 10-15 digits, optional +, spaces, hyphens, parentheses
    // Format examples: 1234567890, +234 803 123 4567, +1-202-555-0173, (123) 456-7890
    const phoneRegex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
    return phoneRegex.test(phone.replace(/\s/g, ''));
}

function validatePhoneField() {
    var phone = $.trim($("#phone").val());
    var phoneInput = $("input[name='phone']");
    var phoneFormGroup = phoneInput.closest(".form-group");

    // Clear previous error state
    phoneInput.removeClass("input-error");
    phoneFormGroup.next(".phone-error-msg").remove();

    if (phone === "") {
        phoneInput.addClass("input-error");
        phoneFormGroup.after('<div class="phone-error-msg" style="color: red; font-size: 12px; margin-top: 5px; margin-bottom: 15px;">Phone number is required</div>');
    } else if (!validatePhone(phone)) {
        phoneInput.addClass("input-error");
        phoneFormGroup.after('<div class="phone-error-msg" style="color: red; font-size: 12px; margin-top: 5px; margin-bottom: 15px;">Please provide a valid phone number (e.g., 1234567890 or +234 803 123 4567)</div>');
    }
}

function validatePasswordField() {
    var password = $("#password").val();
    var passwordInput = $("input[name='password']");
    var passwordFormGroup = passwordInput.closest(".form-group");

    // Clear previous error state
    passwordInput.removeClass("input-error");
    passwordFormGroup.next(".password-error-msg").remove();

    if (password === "") {
        passwordInput.addClass("input-error");
        passwordFormGroup.after('<div class="password-error-msg" style="color: red; font-size: 12px; margin-top: 5px; margin-bottom: 15px;">Password is required</div>');
    } else if (!validatePassword(password)) {
        passwordInput.addClass("input-error");
        passwordFormGroup.after('<div class="password-error-msg" style="color: red; font-size: 12px; margin-top: 5px; margin-bottom: 15px;">Password must be at least 6 characters</div>');
    }
}

function removeEmailMessage() {
    $("#email-status-msg").remove();
}

function showEmailMessage(message, color) {
    var emailFormGroup = $("#email").closest(".form-group");
    removeEmailMessage();
    emailFormGroup.after('<div id="email-status-msg" class="email-error-msg" style="color: ' + color + '; font-size: 12px; margin-top: 5px; margin-bottom: 15px;">' + message + '</div>');
}

function removeUsernameMessage() {
    $("#username-status-msg").remove();
}

function showUsernameMessage(message, color) {
    var usernameFormGroup = $("#username").closest(".form-group");
    removeUsernameMessage();
    usernameFormGroup.after('<div id="username-status-msg" class="username-error-msg" style="color: ' + color + '; font-size: 12px; margin-top: 5px; margin-bottom: 15px;">' + message + '</div>');
}

function resetEmailAvailabilityState() {
    emailAvailabilityState = "unknown";
    removeEmailMessage();
    $("#email").removeClass("input-error");
}

function resetUsernameAvailabilityState() {
    usernameAvailabilityState = "unknown";
    removeUsernameMessage();
    $("#username").removeClass("input-error");
}

function checkEmailAvailability(email) {
    emailAvailabilityState = "checking";
    showEmailMessage("Checking email...", "#7d8784");

    $.ajax({
        type: "POST",
        url: base_url + "user/check_if_email_exist",
        data: {
            email: email
        },
        success: function(response) {
            if ($.trim($("#email").val()) !== email) {
                return;
            }

            if (response && response.exists === true) {
                emailAvailabilityState = "exists";
                $("#email").addClass("input-error");
                showEmailMessage(emailAvailabilityMessages.exists, "#c9302c");
            } else {
                emailAvailabilityState = "available";
                $("#email").removeClass("input-error");
                showEmailMessage(emailAvailabilityMessages.available, "#2e7d32");
            }
        },
        error: function() {
            if ($.trim($("#email").val()) !== email) {
                return;
            }

            emailAvailabilityState = "unknown";
            showEmailMessage("Unable to check email right now", "#c9302c");
        }
    });
}

function checkUsernameAvailability(username) {
    usernameAvailabilityState = "checking";
    showUsernameMessage("Checking username...", "#7d8784");

    $.ajax({
        type: "POST",
        url: base_url + "user/is_username_available",
        data: {
            username: username
        },
        success: function(response) {
            if ($.trim($("#username").val()) !== username) {
                return;
            }

            if (response && parseInt(response.status, 10) === 200) {
                usernameAvailabilityState = "available";
                $("#username").removeClass("input-error");
                showUsernameMessage(usernameAvailabilityMessages.available, "#2e7d32");
            } else {
                usernameAvailabilityState = "exists";
                $("#username").addClass("input-error");
                showUsernameMessage(usernameAvailabilityMessages.exists, "#c9302c");
            }
        },
        error: function() {
            if ($.trim($("#username").val()) !== username) {
                return;
            }

            usernameAvailabilityState = "unknown";
            showUsernameMessage("Unable to check username right now", "#c9302c");
        }
    });
}

function register() {

    // Get values of the input fields
    var email = $.trim($("#email").val());
    var password = $("#password").val();
    var phone = $.trim($("#phone").val());
    var firstname = $.trim($("#firstname").val());
    var lastname = $.trim($("#lastname").val());
    var username = $.trim($("#username").val());
    var dob = $.trim($("#dob").val());
    var gender = $.trim($("#gender").val());
    var profession = $("#profession").val();
    var country = $.trim($("#country").val());
    var state = $.trim($("#state").val());
    var organization_type = $.trim($("#organization_type").val());
    var organization_name = $.trim($("#organization_name").val());
    var current_role = $.trim($("#current_role").val());
    var australia_program = $.trim($("#australia_program").val());
    var australia_institution = $.trim($("#australia_institution").val());
    var expertise = $.trim($("#expertise").val());

    // Reset styles
    $("input").removeClass("input-error");
    $("select").removeClass("input-error");
    $(".email-error-msg").remove();
    $(".phone-error-msg").remove();
    $(".password-error-msg").remove();

    let hasError = false;
    let errorMessage = "";

    // Check for blank fields
    if (email === "") {
        $("input[name='email']").addClass("input-error");
        hasError = true;
        errorMessage = "Email is required";
    } else if (!validateEmail(email)) {
        $("input[name='email']").addClass("input-error");
        hasError = true;
        errorMessage = "Please provide a valid email address";
    } else if (emailAvailabilityState === "exists") {
        $("input[name='email']").addClass("input-error");
        hasError = true;
        errorMessage = emailAvailabilityMessages.exists;
    }

    if (username !== "" && usernameAvailabilityState === "exists") {
        $("input[name='username']").addClass("input-error");
        hasError = true;
        errorMessage = usernameAvailabilityMessages.exists;
    }

    if (password === "") {
        $("input[name='password']").addClass("input-error");
        hasError = true;
        errorMessage = "Password is required";
    } else if (!validatePassword(password)) {
        $("input[name='password']").addClass("input-error");
        hasError = true;
        errorMessage = "Password must be at least 6 characters";
    }

    if (firstname === "") {
        $("input[name='firstname']").addClass("input-error");
        hasError = true;
        errorMessage = "Please fill in all fields";
    }

    if (lastname === "") {
        $("input[name='lastname']").addClass("input-error");
        hasError = true;
        errorMessage = "Please fill in all fields";
    }

    if (phone === "") {
        $("input[name='phone']").addClass("input-error");
        hasError = true;
        errorMessage = "Phone number is required";
    } else if (!validatePhone(phone)) {
        $("input[name='phone']").addClass("input-error");
        hasError = true;
        errorMessage = "Please provide a valid phone number";
    }

    if (profession === "") {
        $("select[name='profession']").addClass("input-error");
        hasError = true;
        errorMessage = "Please select a profession";
    }

    if (country === "") {
        $("select[name='country']").addClass("input-error");
        hasError = true;
        errorMessage = "Please select a country";
    }

    if (state === "") {
        $("input[name='state']").addClass("input-error");
        hasError = true;
        errorMessage = "Please fill in all fields";
    }

    if (hasError) {
        $("#error_msg_div").show();
        $("#error_msg_div").html(errorMessage);
        return;
    }

    $("#register_loader").show();
    $("#register").hide();
    $("#error_msg_div").hide();

    // Send the registration request
    $.ajax({

        type: "POST",
        url: base_url+"user/user_registration2",
        data: {
            email: email,
            password: password,
            firstname: firstname,
            lastname: lastname,
            username: username,
            dob: dob,
            gender: gender,
            profession: profession,
            state: state,
            country: country,
            phone: phone,
            organization_type: organization_type,
            organization_name: organization_name,
            current_role: current_role,
            australia_program: australia_program,
            australia_institution: australia_institution,
            expertise: expertise
        },
        success: function(response) {

            // Check if registration was successful
            if (response.status == 200 || response.status === 200) {

                // Show success message with countdown
                var redirectSeconds = 3;
                var successMsg = '<span style="color: green;">Registration successful! Please check your email for further instructions.<br>Redirecting to login page in <strong id="countdown">' + redirectSeconds + '</strong> seconds...</span>';
                $("#error_msg_div").show();
                $("#error_msg_div").html(successMsg).css('background-color', '#d4edda').css('border', '1px solid #c3e6cb');
                
                // Countdown timer
                var countdownInterval = setInterval(function() {
                    redirectSeconds--;
                    $("#countdown").text(redirectSeconds);
                    if (redirectSeconds <= 0) {
                        clearInterval(countdownInterval);
                        window.location.href = "login";
                    }
                }, 1000);
                
                // Clear form fields
                $("#reg_form")[0].reset();
                
                // Hide loader and button
                $("#register_loader").hide();
                $("#register").hide();

            } else {

                $("#register_loader").hide();
                $("#register").show();

                $("#error_msg_div").show();
                $("#error_msg_div").css('background-color', '#f8d7da').css('border', '1px solid #f5c6cb');
                
                // Display the error message from the server
                var errorMsg = response.msg || "Registration failed. Please try again.";
                $("#error_msg_div").html('<span style="color: #721c24;">' + errorMsg + '</span>');
            }

        },
        error: function(xhr, status, error) {

            $("#register_loader").hide();
            $("#register").show();

            $("#error_msg_div").show();
            $("#error_msg_div").css('background-color', '#f8d7da').css('border', '1px solid #f5c6cb');
            
            // Try to parse the error response
            var errorMsg = "An error occurred during registration. Please try again.";
            
            try {
                if (xhr.responseJSON) {
                    errorMsg = xhr.responseJSON.msg || xhr.responseJSON.message || errorMsg;
                } else if (xhr.responseText) {
                    var response = JSON.parse(xhr.responseText);
                    errorMsg = response.msg || response.message || errorMsg;
                }
            } catch (e) {
                // If JSON parsing fails, use generic message based on status
                if (xhr.status === 500) {
                    errorMsg = "Server error (500). There's an issue on the server. Please contact support.";
                } else if (xhr.status === 400) {
                    errorMsg = "Invalid request. Please check your input and try again.";
                } else if (xhr.status === 409) {
                    errorMsg = "Email already exists. Please use a different email or login.";
                }
            }
            
            $("#error_msg_div").html('<span style="color: #721c24;">' + errorMsg + '</span>');
            
        }
    });

}


function confirm_reg(){

}
