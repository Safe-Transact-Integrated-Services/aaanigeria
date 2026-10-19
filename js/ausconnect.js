$(document).ready(function() {
    loadAussieConnectDirectory();
});

function loadAussieConnectDirectory() {
    var authHeaders = getAussieConnectAuthHeaders();

    if (!authHeaders.Authorization && !authHeaders.AUTHORIZATION) {
        showAussieConnectMessage("Please log in to view the AAAN member directory.", true);
        $("#aussie_connect_loading").hide();
        return;
    }

    $.ajax({
        type: "GET",
        url: base_url + "profile/member_directory",
        headers: authHeaders,
        success: function(response) {
            $("#aussie_connect_loading").hide();

            if (!response || !response.data) {
                showAussieConnectMessage((response && response.msg) ? response.msg : "Unable to load registered members right now.", true);
                return;
            }

            renderAussieConnectDirectory(response.data || []);
        },
        error: function(xhr) {
            $("#aussie_connect_loading").hide();
            if (xhr && xhr.status === 401) {
                showAussieConnectMessage("Please log in to view the AAAN member directory.", true);
                return;
            }
            showAussieConnectMessage("Unable to load registered members right now.", true);
        }
    });
}

function getAussieConnectAuthHeaders() {
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

function renderAussieConnectDirectory(members) {
    var $directory = $("#aussie_connect_directory");
    $directory.empty();
    $("#aussie_connect_count").text((members.length || 0) + " member" + ((members.length || 0) === 1 ? "" : "s"));

    if (!members.length) {
        showAussieConnectMessage("No registered members were found yet.", false);
        return;
    }

    $("#aussie_connect_message").hide();

    $.each(members, function(_, member) {
        var fullName = $.trim(member.full_name || [member.firstname, member.othernames, member.lastname].join(" "));
        var title = $.trim(member.member_title || member.current_role || member.profession_description || member.profession || "Member");
        var location = $.trim(member.member_location || "");
        var profileLink = "member_profile?user_id=" + encodeURIComponent(member.user_id || "");
        var photo = $.trim(member.photo_path || member.photo_path_mid || member.photo_path_lg || "");
        var safePhoto = photo || (window.getDefaultProfilePlaceholder ? window.getDefaultProfilePlaceholder() : "");

        var cardHtml = [
            '<div class="col-lg-4 col-md-6 col-sm-6 m-b30">',
                '<div class="aussie-member-card">',
                    '<div class="aussie-member-card__media">',
                        '<img class="aussie-member-card__photo" src="', safePhoto, '" alt="', escapeHtml(fullName || "Member"), '">',
                    '</div>',
                    '<div class="aussie-member-card__body">',
                        '<a class="aussie-member-card__name" href="', profileLink, '">', escapeHtml(fullName || "Member"), '</a>',
                        '<div class="aussie-member-card__title">', escapeHtml(title), '</div>',
                        '<div class="aussie-member-card__meta">', escapeHtml(location || "AAAN Member"), '</div>',
                    '</div>',
                '</div>',
            '</div>'
        ].join("");

        $directory.append(cardHtml);
    });

    if (window.applySafeProfileImage) {
        $(".aussie-member-card__photo").each(function() {
            window.applySafeProfileImage($(this), $(this).attr("src"));
        });
    }
}

function showAussieConnectMessage(message, isError) {
    $("#aussie_connect_message")
        .stop(true, true)
        .show()
        .css({
            color: isError ? "#721c24" : "#155724",
            backgroundColor: isError ? "#f8d7da" : "#d4edda",
            border: "1px solid " + (isError ? "#f5c6cb" : "#c3e6cb"),
            padding: "14px 16px",
            borderRadius: "8px",
            marginBottom: "24px"
        })
        .text(message);
}

function escapeHtml(value) {
    return String(value == null ? "" : value)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/\"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
