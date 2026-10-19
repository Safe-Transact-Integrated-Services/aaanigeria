$(document).ready(function() {
    fetchViewedMemberProfile();
});

function fetchViewedMemberProfile() {
    var authHeaders = getViewedMemberAuthHeaders();
    if (!authHeaders.Authorization && !authHeaders.AUTHORIZATION) {
        showViewedMemberMessage("Please log in to view this member profile.", true);
        return;
    }

    var userId = getMemberProfileUserId();
    if (!userId) {
        showViewedMemberMessage("No member was selected.", true);
        return;
    }

    $.ajax({
        type: "GET",
        url: base_url + "profile/get_viewed_user_profile?user_id=" + encodeURIComponent(userId),
        headers: authHeaders,
        success: function(response) {
            if (response && response.data) {
                renderViewedMemberProfile(response.data, response.email || "");
            } else {
                showViewedMemberMessage(response && response.msg ? response.msg : "Unable to load this member profile.", true);
            }
        },
        error: function(xhr) {
            if (xhr && xhr.status === 401) {
                showViewedMemberMessage("Please log in to view this member profile.", true);
                return;
            }
            showViewedMemberMessage("Unable to load this member profile right now.", true);
        }
    });
}

function getViewedMemberAuthHeaders() {
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

function getMemberProfileUserId() {
    var params = new URLSearchParams(window.location.search || "");
    return $.trim(params.get("user_id") || "");
}

function renderViewedMemberProfile(profile, email) {
    var fullName = [profile.firstname, profile.othernames, profile.lastname].join(" ").replace(/\s+/g, " ").trim();
    var jobTitle = $.trim(profile.current_role || profile.profession_description || profile.profession || "");
    var about = $.trim(profile.about_me || profile.about || "");

    if (window.applySafeProfileImage) {
        window.applySafeProfileImage($("#member_profile_photo"), profile.photo_path || "");
    } else {
        $("#member_profile_photo").attr("src", $.trim(profile.photo_path || ""));
    }

    $("#member_profile_fullname").text(fullName || "Member");
    $("#member_profile_job_title").text(jobTitle || "Member");
    $("#member_profile_about").text(about || "No bio has been added yet.");

    $("#member_view_username").text(displayMemberValue(profile.username));
    $("#member_view_firstname").text(displayMemberValue(profile.firstname));
    $("#member_view_lastname").text(displayMemberValue(profile.lastname));
    $("#member_view_othernames").text(displayMemberValue(profile.othernames));
    $("#member_view_gender").text(displayMemberValue(profile.gender));
    $("#member_view_dob").text(formatMemberDisplayDate(profile.dob));
    $("#member_view_email").text(displayMemberValue(email || profile.email));
    $("#member_view_phone").text(displayMemberValue(profile.phone));
    $("#member_view_phone2").text(displayMemberValue(profile.phone2));
    $("#member_view_marital_status").text(displayMemberValue(profile.marital_status));
    $("#member_view_profession").text(displayMemberValue(profile.profession));
    $("#member_view_profession_desc").text(displayMemberValue(profile.profession_description));
    $("#member_view_organization_type").text(displayMemberValue(profile.organization_type));
    $("#member_view_organization_name").text(displayMemberValue(profile.organization_name));
    $("#member_view_current_role").text(displayMemberValue(profile.current_role));
    $("#member_view_australia_program").text(displayMemberValue(profile.australia_program));
    $("#member_view_australia_institution").text(displayMemberValue(profile.australia_institution));
    $("#member_view_expertise").text(displayMemberValue(profile.expertise));
    $("#member_view_country").text(displayMemberValue(profile.country));
    $("#member_view_state").text(displayMemberValue(profile.state));
    $("#member_view_city").text(displayMemberValue(profile.city_name || profile.city));
    $("#member_view_address").text(displayMemberValue(profile.address));
    $("#member_view_about").text(displayMemberValue(about));
}

function showViewedMemberMessage(message, isError) {
    $("#member_profile_message")
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

function displayMemberValue(value) {
    var normalized = $.trim(String(value == null ? "" : value));
    if (!normalized || normalized === "0" || normalized.toLowerCase() === "null" || normalized.toLowerCase() === "undefined") {
        return "-";
    }

    return normalized;
}

function formatMemberDisplayDate(dateValue) {
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
        return formatMemberDayMonth(dayPart, monthPart);
    }

    if (/^\d{2}\/\d{2}$/.test(value)) {
        return formatMemberDayMonth(parseInt(value.substring(0, 2), 10), parseInt(value.substring(3, 5), 10));
    }

    var date = new Date(value);
    if (isNaN(date.getTime())) {
        return value;
    }

    return formatMemberDayMonth(date.getDate(), date.getMonth() + 1);
}

function formatMemberDayMonth(day, month) {
    var monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    if (!day || !month || month < 1 || month > 12) {
        return "-";
    }

    return getMemberOrdinal(day) + " of " + monthNames[month - 1];
}

function getMemberOrdinal(day) {
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
