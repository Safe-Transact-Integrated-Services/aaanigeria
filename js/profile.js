$(document).ready(function() {
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

function fetchProfileData() {
    var authHeaders = getProfileAuthHeaders();
    if (!authHeaders.Authorization && !authHeaders.AUTHORIZATION) {
        showProfileMessage("You are not logged in. Please log in again.", true);
        return;
    }

    $.ajax({
        type: "GET",
        url: base_url + "profile/fetch_user_profile",
        headers: authHeaders,
        success: function(response) {
            if (response && response.data) {
                renderProfile(response.data, response.email || "");
            } else {
                showProfileMessage(response.msg || "Unable to load profile details.", true);
            }
        },
        error: function() {
            showProfileMessage("Unable to load profile details right now.", true);
        }
    });
}

function renderProfile(profile, email) {
    var fullName = [profile.firstname, profile.othernames, profile.lastname].join(" ").replace(/\s+/g, " ").trim();
    var jobTitle = $.trim(profile.current_role || profile.profession_description || profile.profession || "");
    var about = $.trim(profile.about_me || profile.about || "");

    if (window.applySafeProfileImage) {
        window.applySafeProfileImage($("#profile_photo"), profile.photo_path || "");
    } else {
        $("#profile_photo").attr("src", $.trim(profile.photo_path || "") || defaultPhoto);
    }
    $("#profile_fullname").text(fullName || "Member");
    $("#profile_job_title").text(jobTitle || "Member");
    $("#profile_about").text(about || "No bio has been added yet.");

    $("#view_username").text(displayValue(profile.username));
    $("#view_firstname").text(displayValue(profile.firstname));
    $("#view_lastname").text(displayValue(profile.lastname));
    $("#view_othernames").text(displayValue(profile.othernames));
    $("#view_gender").text(displayValue(profile.gender));
    $("#view_dob").text(formatDisplayDate(profile.dob));
    $("#view_email").text(displayValue(email || profile.email));
    $("#view_phone").text(displayValue(profile.phone));
    $("#view_phone2").text(displayValue(profile.phone2));
    $("#view_marital_status").text(displayValue(profile.marital_status));
    $("#view_profession").text(displayValue(profile.profession));
    $("#view_profession_desc").text(displayValue(profile.profession_description));
    $("#view_organization_type").text(displayValue(profile.organization_type));
    $("#view_organization_name").text(displayValue(profile.organization_name));
    $("#view_current_role").text(displayValue(profile.current_role));
    $("#view_australia_program").text(displayValue(profile.australia_program));
    $("#view_australia_institution").text(displayValue(profile.australia_institution));
    $("#view_expertise").text(displayValue(profile.expertise));
    $("#view_country").text(displayValue(profile.country));
    $("#view_state").text(displayValue(profile.state));
    $("#view_city").text(displayValue(profile.city_name || profile.city));
    $("#view_address").text(displayValue(profile.address));
    $("#view_about").text(displayValue(about));

    if (window.updateMemberSidebarProfile) {
        window.updateMemberSidebarProfile($.extend({}, profile, { email: email || profile.email || "" }));
    }
}

function displayValue(value) {
    var normalized = $.trim(String(value == null ? "" : value));
    if (!normalized || normalized === "0" || normalized.toLowerCase() === "null" || normalized.toLowerCase() === "undefined") {
        return "-";
    }

    return normalized;
}

function showProfileMessage(message, isError) {
    $("#profile_message")
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

function formatDisplayDate(dateValue) {
    var value = $.trim(dateValue || "");
    if (!value || value === "0000-00-00" || value === "0000-00" || value === "00/00") {
        return "-";
    }

    if (/^\d{4}-\d{2}-\d{2}$/.test(value)) {
        var monthPart = parseInt(value.substring(5, 7), 10);
        var dayPart = parseInt(value.substring(8, 10), 10);
        if (!monthPart || !dayPart) {
            return "-";
        }
        return formatDayMonth(dayPart, monthPart);
    }

    if (/^\d{2}\/\d{2}$/.test(value)) {
        return formatDayMonth(parseInt(value.substring(0, 2), 10), parseInt(value.substring(3, 5), 10));
    }

    var date = new Date(value);
    if (isNaN(date.getTime())) {
        return value;
    }

    return formatDayMonth(date.getDate(), date.getMonth() + 1);
}

function formatDayMonth(day, month) {
    var monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    if (!day || !month || month < 1 || month > 12) {
        return "-";
    }

    return getOrdinal(day) + " of " + monthNames[month - 1];
}

function getOrdinal(day) {
    var value = parseInt(day, 10);
    if (isNaN(value) || value <= 0) {
        return "";
    }

    var remainder = value % 100;
    if (remainder >= 11 && remainder <= 13) {
        return value + "th";
    }

    switch (value % 10) {
        case 1:
            return value + "st";
        case 2:
            return value + "nd";
        case 3:
            return value + "rd";
        default:
            return value + "th";
    }
}
