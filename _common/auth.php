<?php
/**
 * Token/Authentication Check Helper
 * Works with the existing token-based authentication system
 */

/**
 * Check if user has a valid auth token in localStorage (client-side)
 * This is a client-side check via JavaScript
 */
function has_auth_token_client_side() {
    // This is checked via JavaScript, not PHP
    // Return placeholder - actual check happens in JS
    return false;
}

/**
 * Check if user is authenticated based on Authorization header
 * Used for API endpoints
 */
function is_authenticated_api() {
    $headers = apache_request_headers();
    return isset($headers['Authorization']) && !empty($headers['Authorization']);
}

/**
 * Get auth token from Authorization header
 */
function get_auth_token() {
    $headers = apache_request_headers();
    return isset($headers['Authorization']) ? $headers['Authorization'] : null;
}

?>
