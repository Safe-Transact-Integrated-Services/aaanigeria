<?php
/**
 * Simple Search API Endpoint
 * Handles search requests from the frontend
 */

// Log all requests for debugging
error_log('[SEARCH-API] Request received at ' . date('Y-m-d H:i:s'));
error_log('[SEARCH-API] Method: ' . $_SERVER['REQUEST_METHOD']);
error_log('[SEARCH-API] Post data: ' . json_encode($_POST));

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Get search query
$searchQuery = isset($_POST['q']) ? trim($_POST['q']) : '';

error_log('[SEARCH-API] Search query: ' . $searchQuery);

// Validate search query
if(empty($searchQuery)) {
    http_response_code(400);
    echo json_encode([
        'status' => 400,
        'msg' => 'Search query is required'
    ]);
    error_log('[SEARCH-API] Empty search query');
    exit;
}

// Validate minimum length
if(strlen($searchQuery) < 2) {
    http_response_code(400);
    echo json_encode([
        'status' => 400,
        'msg' => 'Search term must be at least 2 characters'
    ]);
    error_log('[SEARCH-API] Search query too short: ' . strlen($searchQuery) . ' chars');
    exit;
}

// Search across all pages
$results = searchAllPages($searchQuery);

error_log('[SEARCH-API] Found ' . count($results) . ' results');

// Return results
http_response_code(200);
echo json_encode([
    'status' => 200,
    'msg' => 'Search completed',
    'data' => $results
]);
exit;

/**
 * Search across all website pages
 */
function searchAllPages($searchQuery) {
    $results = array();
    $rootPath = __DIR__;
    
    error_log('[SEARCH-API] Root path: ' . $rootPath);
    
    // List of pages to search
    $pages = array(
        'index.php' => 'Home',
        'aboutus.php' => 'About Us',
        'blog.php' => 'Blog',
        'gallery.php' => 'Gallery',
        'resources.php' => 'Resources',
        'opportunities.php' => 'Opportunities',
        'expatlocator.php' => 'Expat Locator',
        'profile.php' => 'Profile',
        'ausconnect.php' => 'Aus Connect',
        'wiln.php' => 'Women in Leadership Network'
    );
    
    $searchRegex = '/' . preg_quote($searchQuery, '/') . '/i';
    
    foreach($pages as $filename => $pageTitle) {
        $filePath = $rootPath . DIRECTORY_SEPARATOR . $filename;
        
        error_log('[SEARCH-API] Checking file: ' . $filePath . ' (exists: ' . (file_exists($filePath) ? 'yes' : 'no') . ')');
        
        if(file_exists($filePath)) {
            $content = file_get_contents($filePath);
            
            // Remove PHP tags for searching
            $textContent = strip_tags($content);
            $textContent = html_entity_decode($textContent);
            $textContent = preg_replace('/\s+/', ' ', $textContent);
            
            // Search for matches
            if(preg_match($searchRegex, $textContent)) {
                error_log('[SEARCH-API] Match found in: ' . $filename);
                
                // Extract relevant snippets around the match
                $matches = array();
                preg_match_all('/.{0,100}' . preg_quote($searchQuery, '/') . '.{0,100}/i', $textContent, $matches);
                
                if(!empty($matches[0])) {
                    // Get first match only to avoid duplicate results for same page
                    $snippet = trim(preg_replace('/\s+/', ' ', $matches[0][0]));
                    
                    // Convert filename to URL (remove .php extension)
                    $urlPage = str_replace('.php', '', $filename);
                    if ($urlPage === 'index') {
                        $urlPage = '';  // index becomes root
                    }
                    
                    $results[] = array(
                        'title' => $pageTitle,
                        'description' => $snippet,
                        'page' => $filename,
                        'link' => $urlPage
                    );
                }
            }
        }
    }
    
    // Limit to 20 results
    return array_slice($results, 0, 20);
}
?>