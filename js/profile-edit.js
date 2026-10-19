$(document).ready(function() {
    $("#country").on("change", populateStates);
    $("#save_profile").on("click", saveProfile);
    $("#upload_photo_btn, #replace_photo_btn").on("click", function() {
        $("#profile_photo_input").trigger("click");
    });
    $("#profile_photo_input").on("change", handlePhotoSelection);
    $("#delete_photo_btn").on("click", deleteProfilePhoto);
    initializeDobInput();

    fetchProfileData();
});

var defaultPhoto = window.getDefaultProfilePlaceholder ? window.getDefaultProfilePlaceholder() : "";

function getProfileAuthHeaders() {
    if (window.getAuthHeaders) {
        return window.getAuthHeaders();
    }

    var token = $.trim(localStorage.getItem("auth_token") || "");
    if (!token || token === "null") {
        return {};
    }

    return {
        Authorization: token,
        AUTHORIZATION: token
    };
}

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

function fetchProfileData() {
    var authHeaders = getProfileAuthHeaders();
    if (!authHeaders.Authorization && !authHeaders.AUTHORIZATION) {
        showProfileEditMessage("You are not logged in. Please log in again.", true);
        return;
    }

    $.ajax({
        type: "GET",
        url: base_url + "profile/fetch_user_profile",
        headers: authHeaders,
        success: function(response) {
            if (response && response.data) {
                fillProfileForm(response.data, response.email || "");
            } else {
                showProfileEditMessage(response.msg || "Unable to load profile.", true);
            }
        },
        error: function() {
            showProfileEditMessage("Unable to load profile.", true);
        }
    });
}

function fillProfileForm(data, email) {
    $("#firstname").val(data.firstname || "");
    $("#lastname").val(data.lastname || "");
    $("#othernames").val(data.othernames || "");
    $("#username").val(data.username || "");
    $("#email").val(email || data.email || "");
    $("#gender").val(normalizeGender(data.gender || ""));
    setDobValue(data.dob || "");
    $("#marital_status").val(data.marital_status || "");
    $("#phone").val(data.phone || "");
    $("#phone2").val(data.phone2 || "");
    $("#profession").val(data.profession || "");
    $("#profession_desc").val(data.profession_description || "");
    $("#organization_type").val(data.organization_type || "");
    $("#organization_name").val(data.organization_name || "");
    $("#current_role").val(data.current_role || "");
    $("#australia_program").val(data.australia_program || "");
    $("#australia_institution").val(data.australia_institution || "");
    $("#expertise").val(data.expertise || "");
    $("#city").val(data.city || "");
    $("#address").val(data.address || "");
    $("#about_me").val(data.about_me || "");

    var country = data.country || "";
    if (country !== "Australia" && country !== "Nigeria" && country !== "Others" && country !== "") {
        country = "Others";
    }
    $("#country").val(country);
    populateStates(data.state || "");

    if (window.applySafeProfileImage) {
        window.applySafeProfileImage($("#profile_photo_preview"), data.photo_path || "");
    } else {
        $("#profile_photo_preview").attr("src", data.photo_path || defaultPhoto);
    }

    if (window.updateMemberSidebarProfile) {
        window.updateMemberSidebarProfile($.extend({}, data, { email: email || data.email || "" }));
    }
}

function normalizeGender(gender) {
    if (!gender) {
        return "";
    }
    var normalized = gender.toString().toLowerCase();
    if (normalized === "male") {
        return "Male";
    }
    if (normalized === "female") {
        return "Female";
    }
    return gender;
}

function populateStates(selectedState) {
    var country = $.trim($("#country").val());
    var stateElement = $("#state");
    var currentSelectedState = typeof selectedState === "string" ? selectedState : $.trim(stateElement.val());
    var isSelect = stateElement.is("select");

    if (country === "Others") {
        if (isSelect) {
            stateElement.replaceWith('<input type="text" class="form-control" placeholder="State of Residence" id="state">');
        }
        $("#state").val(currentSelectedState || "");
        return;
    }

    if (!isSelect) {
        stateElement.replaceWith('<select class="form-control" id="state"><option value="">-- Select --</option></select>');
    }

    stateElement = $("#state");
    stateElement.find("option:not(:first)").remove();
    stateElement.val("");

    if (country && stateData[country]) {
        $.each(stateData[country], function(_, state) {
            stateElement.append('<option value="' + escapeHtml(state) + '">' + escapeHtml(state) + "</option>");
        });
    }

    if (currentSelectedState) {
        stateElement.val(currentSelectedState);
    }
}

function saveProfile() {
    var firstname = $.trim($("#firstname").val());
    var lastname = $.trim($("#lastname").val());
    var username = $.trim($("#username").val());
    var gender = $.trim($("#gender").val());
    var dob = normalizeDobForSubmit($.trim($("#dob").val()));
    var maritalStatus = $.trim($("#marital_status").val());
    var phone = $.trim($("#phone").val());
    var phone2 = $.trim($("#phone2").val());
    var profession = $.trim($("#profession").val());
    var professionDesc = $.trim($("#profession_desc").val());
    var organizationType = $.trim($("#organization_type").val());
    var organizationName = $.trim($("#organization_name").val());
    var currentRole = $.trim($("#current_role").val());
    var australiaProgram = $.trim($("#australia_program").val());
    var australiaInstitution = $.trim($("#australia_institution").val());
    var expertise = $.trim($("#expertise").val());
    var country = $.trim($("#country").val());
    var state = $.trim($("#state").val());
    var city = $.trim($("#city").val());
    var address = $.trim($("#address").val());
    var aboutMe = $.trim($("#about_me").val());

    if (!firstname || !lastname || !gender) {
        showProfileEditMessage("First name, last name and gender are required.", true);
        return;
    }

    $("#save_profile").prop("disabled", true).text("Saving...");

    var authHeaders = window.getAuthHeaders ? window.getAuthHeaders() : {};
    authHeaders = getProfileAuthHeaders();
    if (!authHeaders.Authorization && !authHeaders.AUTHORIZATION) {
        $("#save_profile").prop("disabled", false).text("Save Changes");
        showProfileEditMessage("You are not logged in. Please log in again.", true);
        return;
    }

    $.ajax({
        type: "POST",
        url: base_url + "profile/update_profile",
        headers: authHeaders,
        data: {
            firstname: firstname,
            lastname: lastname,
            othernames: $.trim($("#othernames").val()),
            username: username,
            gender: gender,
            dob: dob,
            marital_status: maritalStatus,
            phone: phone,
            phone2: phone2,
            profession: profession,
            profession_desc: professionDesc,
            organization_type: organizationType,
            organization_name: organizationName,
            current_role: currentRole,
            australia_program: australiaProgram,
            australia_institution: australiaInstitution,
            expertise: expertise,
            country: country,
            state: state,
            city: city,
            address: address,
            about_me: aboutMe
        },
        success: function(response) {
            if (response.status === 200) {
                showProfileEditMessage(response.msg || "Profile updated successfully.", false);
                setTimeout(function() {
                    window.location.href = "profile";
                }, 800);
            } else {
                showProfileEditMessage(response.msg || "Profile update failed.", true);
            }
        },
        error: function(xhr) {
            var message = "Profile update failed.";
            if (xhr && xhr.responseJSON && xhr.responseJSON.msg) {
                message = xhr.responseJSON.msg;
            }
            showProfileEditMessage(message, true);
        },
        complete: function() {
            $("#save_profile").prop("disabled", false).text("Save Changes");
        }
    });
}

function handlePhotoSelection(event) {
    var file = event.target.files && event.target.files[0];
    if (!file) {
        return;
    }

    var reader = new FileReader();
    reader.onload = function(e) {
        uploadProfilePhoto(e.target.result);
    };
    reader.readAsDataURL(file);
}

function uploadProfilePhoto(base64File) {
    showProfileEditMessage("Uploading photo...", false);

    var authHeaders = window.getAuthHeaders ? window.getAuthHeaders() : {};
    authHeaders = getProfileAuthHeaders();
    if (!authHeaders.Authorization && !authHeaders.AUTHORIZATION) {
        showProfileEditMessage("You are not logged in. Please log in again.", true);
        return;
    }

    $.ajax({
        type: "POST",
        url: base_url + "profile/update_profile_picture",
        headers: authHeaders,
        data: {
            file: base64File
        },
        success: function(response) {
            if (response.status === 200 && response.data) {
                if (window.applySafeProfileImage) {
                    window.applySafeProfileImage($("#profile_photo_preview"), response.data.photo_path || "");
                } else {
                    $("#profile_photo_preview").attr("src", response.data.photo_path || defaultPhoto);
                }
                if (window.updateMemberSidebarProfile) {
                    window.updateMemberSidebarProfile({ photo_path: response.data.photo_path || "" });
                }
                showProfileEditMessage(response.msg || "Photo updated successfully.", false);
            } else {
                showProfileEditMessage(response.msg || "Photo upload failed.", true);
            }
        },
        error: function(xhr) {
            var message = "Photo upload failed.";
            if (xhr && xhr.responseJSON && xhr.responseJSON.msg) {
                message = xhr.responseJSON.msg;
            }
            showProfileEditMessage(message, true);
        },
        complete: function() {
            $("#profile_photo_input").val("");
        }
    });
}

function deleteProfilePhoto() {
    var authHeaders = window.getAuthHeaders ? window.getAuthHeaders() : {};
    authHeaders = getProfileAuthHeaders();
    if (!authHeaders.Authorization && !authHeaders.AUTHORIZATION) {
        showProfileEditMessage("You are not logged in. Please log in again.", true);
        return;
    }

    $.ajax({
        type: "POST",
        url: base_url + "profile/delete_profile_picture",
        headers: authHeaders,
        success: function(response) {
            if (response.status === 200) {
                if (window.applySafeProfileImage) {
                    window.applySafeProfileImage($("#profile_photo_preview"), "");
                } else {
                    $("#profile_photo_preview").attr("src", defaultPhoto);
                }
                if (window.updateMemberSidebarProfile) {
                    window.updateMemberSidebarProfile({ photo_path: "" });
                }
                showProfileEditMessage(response.msg || "Photo deleted successfully.", false);
            } else {
                showProfileEditMessage(response.msg || "Photo delete failed.", true);
            }
        },
        error: function() {
            showProfileEditMessage("Photo delete failed.", true);
        }
    });
}

function initializeDobInput() {
    var dobInput = $("#dob");
    dobInput.attr("type", "text");
    dobInput.attr("placeholder", "DD/MM");
    dobInput.on("input", function() {
        var digits = dobInput.val().replace(/\D/g, "").substring(0, 4);
        if (digits.length >= 3) {
            digits = digits.substring(0, 2) + "/" + digits.substring(2);
        }
        dobInput.val(digits);
    });
}

function setDobValue(value) {
    var dobInput = $("#dob");
    var cleanValue = $.trim(value || "");

    if (/^\d{4}-\d{2}-\d{2}$/.test(cleanValue)) {
        dobInput.val(cleanValue.substring(8, 10) + "/" + cleanValue.substring(5, 7));
        return;
    }

    dobInput.val("");
    dobInput.attr("placeholder", "DD/MM");
}

function normalizeDobForSubmit(value) {
    var cleanValue = $.trim(value || "");
    if (!cleanValue) {
        return "";
    }

    if (/^\d{2}\/\d{2}$/.test(cleanValue)) {
        var parts = cleanValue.split("/");
        return "0000-" + parts[1] + "-" + parts[0];
    }

    if (/^\d{2}\/\d{2}\/\d{4}$/.test(cleanValue)) {
        var slashParts = cleanValue.split("/");
        return "0000-" + slashParts[1] + "-" + slashParts[0];
    }

    if (/^\d{4}-\d{2}-\d{2}$/.test(cleanValue)) {
        return "0000-" + cleanValue.substring(5, 7) + "-" + cleanValue.substring(8, 10);
    }

    return "";
}

function showProfileEditMessage(message, isError) {
    $("#profile_edit_message")
        .stop(true, true)
        .show()
        .css({
            color: isError ? "#721c24" : "#155724",
            backgroundColor: isError ? "#f8d7da" : "#d4edda",
            border: "1px solid " + (isError ? "#f5c6cb" : "#c3e6cb"),
            padding: "12px",
            borderRadius: "4px"
        })
        .text(message);
}

function escapeHtml(text) {
    return $("<div>").text(text).html();
}
