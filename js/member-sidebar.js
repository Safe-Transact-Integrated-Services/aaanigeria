(function(window, $) {
    if (!$) {
        return;
    }

    function getStoredAuthToken() {
        return $.trim(localStorage.getItem("auth_token") || "");
    }

    function getAuthHeaders() {
        var token = getStoredAuthToken();
        if (!token || token === "null") {
            return {};
        }

        return {
            Authorization: token,
            AUTHORIZATION: token
        };
    }

    function getDefaultProfilePlaceholder() {
        return "data:image/svg+xml;charset=UTF-8," + encodeURIComponent(
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240">' +
            '<rect width="240" height="240" fill="#eef2f7"/>' +
            '<circle cx="120" cy="88" r="48" fill="#99a3b3"/>' +
            '<path d="M40 210c12-44 50-68 80-68s68 24 80 68" fill="#99a3b3"/>' +
            "</svg>"
        );
    }

    function applySafeProfileImage($img, src) {
        if (!$img || !$img.length) {
            return;
        }

        $img.off("error.memberPlaceholder").on("error.memberPlaceholder", function() {
            if ($img.attr("src") !== getDefaultProfilePlaceholder()) {
                $img.attr("src", getDefaultProfilePlaceholder());
            }
        });

        $img.attr("src", $.trim(src || "") || getDefaultProfilePlaceholder());
    }

    function getProfileImageSource(profile) {
        if (!profile) {
            return "";
        }

        return $.trim(
            profile.photo_path ||
            profile.photo_path_mid ||
            profile.photo_path_lg ||
            ""
        );
    }

    function getFullName(profile) {
        if (!profile) {
            return "Member";
        }

        var fullName = $.trim([(profile.firstname || ""), (profile.lastname || "")].join(" "));
        if (fullName) {
            return fullName;
        }

        return $.trim(profile.username || profile.email || "Member");
    }

    function getTitle(profile) {
        if (!profile) {
            return "Member";
        }

        return $.trim(profile.profession_description || profile.profession || "Member");
    }

    function updateMemberSidebarProfile(profile) {
        var sidebarPhoto = $("#member_sidebar_photo");
        var sidebarName = $("#member_sidebar_name");
        var sidebarTitle = $("#member_sidebar_title");

        if (!sidebarPhoto.length && !sidebarName.length && !sidebarTitle.length) {
            return;
        }

        if (sidebarPhoto.length) {
            applySafeProfileImage(sidebarPhoto, getProfileImageSource(profile));
        }
        if (sidebarName.length) {
            sidebarName.text(getFullName(profile));
        }
        if (sidebarTitle.length) {
            sidebarTitle.text(getTitle(profile));
        }
    }

    function fetchSidebarProfile() {
        var authToken = getStoredAuthToken();
        if (!authToken || authToken === "null") {
            return;
        }

        $.ajax({
            type: "GET",
            url: base_url + "profile/fetch_user_profile",
            headers: getAuthHeaders(),
            success: function(response) {
                if (response && response.data) {
                    updateMemberSidebarProfile(response.data);
                }
            }
        });
    }

    window.getDefaultProfilePlaceholder = getDefaultProfilePlaceholder;
    window.applySafeProfileImage = applySafeProfileImage;
    window.getStoredAuthToken = getStoredAuthToken;
    window.getAuthHeaders = getAuthHeaders;
    window.updateMemberSidebarProfile = updateMemberSidebarProfile;

    $(function() {
        updateMemberSidebarProfile({});
        fetchSidebarProfile();
    });
})(window, window.jQuery);
