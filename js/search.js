/*=====================================
Search Functionality - Website Wide
======================================*/

// Wait for jQuery to be available
function initSearchWhenReady() {
    if (typeof jQuery === 'undefined') {
        console.warn('jQuery not loaded yet, retrying in 100ms...');
        setTimeout(initSearchWhenReady, 100);
        return;
    }
    
    console.log('jQuery loaded - version:', jQuery.fn.jquery);
    var $ = jQuery;
    
    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        $(document).on('ready', function() {
            console.log('DOM ready - initializing search...');
            initializeSearch($);
        });
    } else {
        console.log('DOM already ready - initializing search...');
        initializeSearch($);
    }
}

// Start checking for jQuery immediately
console.log('Search.js loaded, checking for jQuery...');
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSearchWhenReady);
} else {
    initSearchWhenReady();
}

function initializeSearch($) {
    console.log('Initializing search functionality...');
    console.log('jQuery version:', $.fn.jquery);
    
    // Verify elements exist
    console.log('Search modal (#search):', $('#search').length > 0);
    console.log('Search form (#searchform):', $('#searchform').length > 0);
    console.log('Search button (.search-btn):', $('.search-btn').length > 0);
    console.log('Search icon (#open-search-modal, .open-search):', $('#open-search-modal, .open-search').length > 0);
    
    // Use document delegation for all event handlers to ensure they work even for dynamically loaded content
    
    // Handle search icon click to open search modal
    $(document).on('click', '#open-search-modal, .open-search', function(e) {
        console.log('✓ Search icon clicked');
        e.preventDefault();
        e.stopPropagation();
        $('#search').show().addClass('open');
        $('#searchform input[name="q"]').focus();
        console.log('✓ Search modal opened');
    });
    
    // Handle search form submission
    $(document).on('submit', '#searchform', function(e) {
        console.log('✓ Search form submitted');
        e.preventDefault();
        performSearch($);
    });
    
    // Handle search button click
    $(document).on('click', '.search-btn', function(e) {
        console.log('✓ Search button clicked');
        e.preventDefault();
        performSearch($);
    });
    
    // Handle close button for search modal
    $(document).on('click', '#search .close', function(e) {
        console.log('✓ Search close button clicked');
        e.preventDefault();
        closeSearch($);
    });
    
    // Close search when clicking outside the search modal
    $(document).on('click', function(e) {
        if($('#search').hasClass('open') && !$(e.target).closest('#search').length && !$(e.target).closest('.open-search').length && !$(e.target).closest('a[href*="search"]').length) {
            console.log('✓ Closing search - clicked outside');
            closeSearch($);
        }
    });
    
    // Handle Enter key in search input
    $(document).on('keypress', '#searchform input[name="q"]', function(e) {
        if (e.which === 13) { // Enter key
            console.log('✓ Enter key pressed in search input');
            e.preventDefault();
            performSearch($);
        }
    });
    
    console.log('✓ Search functionality initialized successfully');
}

function performSearch($) {
    
    var searchQuery = $.trim($('#searchform input[name="q"]').val());
    var searchResultsContainer = $('#search-results-container');
    
    console.log('Perform search called with query:', searchQuery);
    
    // Validation: Check if search query is empty
    if (searchQuery === '') {
        showSearchError($, 'Please enter a search term');
        return false;
    }
    
    // Validation: Check minimum length
    if (searchQuery.length < 2) {
        showSearchError($, 'Search term must be at least 2 characters');
        return false;
    }
    
    // Clear previous errors
    $('#search-error').remove();
    
    // Close search modal
    closeSearchModal($);
    
    // Show loading state
    if (!searchResultsContainer.length) {
        // Create container in the page-content area or after the header
        if ($('.page-content').length) {
            $('.page-content').prepend('<div id="search-results-container" style="margin: 20px; padding: 20px; background: #f9f9f9; border-radius: 4px;"></div>');
        } else {
            // Fallback: create after the header
            $('header').after('<div id="search-results-container" style="margin: 20px; padding: 20px; background: #f9f9f9; border-radius: 4px;"></div>');
        }
        searchResultsContainer = $('#search-results-container');
    }
    
    searchResultsContainer.html('<div class="search-loading" style="text-align: center; padding: 20px;"><i class="fa fa-spinner fa-spin"></i> Searching...</div>');
    
    // Log search query for debugging
    console.log('Searching for: ' + searchQuery);
    
    // Perform backend search across all pages
    performBackendSearch($, searchQuery, searchResultsContainer);
    
}

function performBackendSearch($, searchQuery, searchResultsContainer) {
    
    // Try multiple API endpoints
    var apiUrls = [
        'search-api.php',
        '/search-api.php',
        './search-api.php',
        'api/search'
    ];
    
    console.log('Attempting backend search for:', searchQuery);
    console.log('Base URL:', base_url);
    
    // Try first URL
    tryApiCall($, 0, apiUrls, searchQuery, searchResultsContainer);
    
}

function tryApiCall($, index, apiUrls, searchQuery, searchResultsContainer) {
    
    if (index >= apiUrls.length) {
        // All API endpoints failed, fall back to frontend search
        console.warn('All backend API endpoints failed, using frontend search');
        performFrontendSearch($, searchQuery, searchResultsContainer);
        return;
    }
    
    var apiUrl = apiUrls[index];
    console.log('Trying API endpoint (' + (index + 1) + '/' + apiUrls.length + '):', apiUrl);
    
    $.ajax({
        url: apiUrl,
        type: 'POST',
        dataType: 'json',
        data: {
            q: searchQuery
        },
        timeout: 3000,
        success: function(response) {
            if (response && response.status === 200) {
                console.log('✓ Backend API successful:', apiUrl);
                displaySearchResults($, response.data || [], searchQuery, searchResultsContainer);
            } else {
                console.warn('Invalid response from API, trying next endpoint...');
                tryApiCall($, index + 1, apiUrls, searchQuery, searchResultsContainer);
            }
        },
        error: function(xhr, status, error) {
            console.warn('✗ API endpoint failed (' + (index + 1) + '/' + apiUrls.length + '):', apiUrl, 'Error:', status);
            // Try next URL
            tryApiCall($, index + 1, apiUrls, searchQuery, searchResultsContainer);
        }
    });
    
}

// Frontend search as fallback
function performFrontendSearch($, searchQuery, searchResultsContainer) {
    
    console.log('Performing frontend search for:', searchQuery);
    
    var results = [];
    var searchRegex = new RegExp(escapeRegex(searchQuery), 'gi');
    var foundElements = [];
    
    // Search in headings (h1, h2, h3, h4, h5, h6)
    $('h1, h2, h3, h4, h5, h6').each(function() {
        var elementText = $(this).text().trim();
        if (elementText && searchRegex.test(elementText)) {
            var description = elementText.substring(0, 150);
            var link = window.location.href.split('#')[0];
            
            if (!foundElements.includes(elementText)) {
                results.push({
                    title: elementText,
                    description: description,
                    page: window.location.pathname.split('/').pop(),
                    link: link
                });
                foundElements.push(elementText);
            }
            
            searchRegex.lastIndex = 0;
        }
    });
    
    // Search in paragraphs
    $('p, .content, .text, article, section').each(function() {
        var elementText = $(this).text().trim();
        if (elementText && elementText.length > 10 && searchRegex.test(elementText)) {
            var title = $(this).closest('section, article, div').find('h1, h2, h3, h4, h5, h6').first().text().trim() || 'Page Content';
            var description = elementText.substring(0, 150) + '...';
            var link = window.location.href.split('#')[0];
            
            var resultKey = title + description.substring(0, 50);
            if (!foundElements.includes(resultKey)) {
                results.push({
                    title: title,
                    description: description,
                    page: window.location.pathname.split('/').pop(),
                    link: link
                });
                foundElements.push(resultKey);
            }
            
            searchRegex.lastIndex = 0;
        }
    });
    
    console.log('Frontend search found', results.length, 'results');
    
    // Display results
    displaySearchResults($, results, searchQuery, searchResultsContainer);
}

function displaySearchResults($, results, searchQuery, searchResultsContainer) {
    
    var resultsHtml = '<div id="search-results">';
    
    // Display search summary
    resultsHtml += '<div style="margin-bottom: 20px; border-bottom: 2px solid #007bff; padding-bottom: 15px;">';
    resultsHtml += '<h4>Search Results for "<strong>' + escapeHtml(searchQuery) + '</strong>"</h4>';
    resultsHtml += '<p style="color: #666; font-size: 14px;">Found ' + results.length + ' result(s)</p>';
    resultsHtml += '<button type="button" class="close-search-results btn btn-sm btn-secondary" style="float: right;">Close</button>';
    resultsHtml += '<div style="clear: both;"></div>';
    resultsHtml += '</div>';
    
    // Check if results are empty
    if (!results || results.length === 0) {
        resultsHtml += '<div style="padding: 15px; text-align: center; color: #999;">';
        resultsHtml += '<p>No results found for your search. Please try different keywords.</p>';
        resultsHtml += '</div>';
    } else {
        
        // Display each result
        resultsHtml += '<ul style="list-style: none; padding: 0; margin: 0;">';
        
        results.forEach(function(result, index) {
            resultsHtml += '<li style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #eee;">';
            
            // Use the link from the API response (already has correct format)
            var resultLink = result.link;
            
            resultsHtml += '<a href="' + resultLink + '" class="search-result-link" style="text-decoration: none; color: #007bff;">';
            
            // Highlight the search term in title
            var highlightedTitle = highlightSearchTerm(result.title, searchQuery);
            resultsHtml += '<h5 style="margin: 0 0 8px 0; color: #007bff;">' + highlightedTitle + '</h5>';
            
            // Highlight the search term in description/snippet
            var highlightedDescription = highlightSearchTerm(result.description, searchQuery);
            resultsHtml += '<p style="margin: 5px 0; color: #666; font-size: 13px; line-height: 1.5;">' + highlightedDescription + '</p>';
            
            resultsHtml += '</a>';
            
            // Show the page info
            resultsHtml += '<small style="color: #999;">From: ' + escapeHtml(result.title) + '</small>';
            resultsHtml += '</li>';
        });
        
        resultsHtml += '</ul>';
        
    }
    
    resultsHtml += '</div>';
    
    // Display results
    searchResultsContainer.html(resultsHtml);
    
    // Attach close button handler
    $(document).on('click', '.close-search-results', function(e) {
        e.preventDefault();
        searchResultsContainer.fadeOut('fast', function() {
            searchResultsContainer.html('');
        });
    });
    
    // Attach search result link handlers - explicit click handling for navigation
    $(document).on('click', '.search-result-link', function(e) {
        var href = $(this).attr('href');
        if (href) {
            console.log('✓ Search result link clicked: ' + href);
            // Allow default behavior to navigate
            window.location.href = href;
            return true;
        }
    });
    
    // Scroll to results container
    $('html, body').animate({
        scrollTop: searchResultsContainer.offset().top - 100
    }, 500);
    
}

function showSearchError($, errorMsg) {
    
    var searchResultsContainer = $('#search-results-container');
    
    if (!searchResultsContainer.length) {
        $('header').after('<div id="search-results-container" style="margin-top: 20px; padding: 20px; background: #f9f9f9; border-radius: 4px;"></div>');
        searchResultsContainer = $('#search-results-container');
    }
    
    var errorHtml = '<div id="search-error" style="padding: 15px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; margin-bottom: 15px;">';
    errorHtml += '<strong><i class="fa fa-exclamation-circle"></i> Error:</strong> ' + errorMsg;
    errorHtml += '</div>';
    
    searchResultsContainer.html(errorHtml);
    
    // Scroll to error
    $('html, body').animate({
        scrollTop: searchResultsContainer.offset().top - 100
    }, 500);
    
}

function closeSearchModal($) {
    
    // Hide the search modal without hash
    $('#search').removeClass('open').hide();
    
}

function closeSearch($) {
    
    // Clear search input
    $('#searchform input[name="q"]').val('');
    
    // Close search modal
    closeSearchModal($);
    
}

function highlightSearchTerm(text, searchTerm) {
    
    if (!text || !searchTerm) {
        return escapeHtml(text);
    }
    
    // Create regex to highlight search term (case-insensitive)
    var regex = new RegExp('(' + escapeRegex(searchTerm) + ')', 'gi');
    var highlighted = escapeHtml(text).replace(regex, '<mark style="background-color: #ffeb3b; padding: 2px 4px; border-radius: 2px; font-weight: bold; color: #000;">$1</mark>');
    
    return highlighted;
    
}

function escapeHtml(text) {
    
    if (!text) return '';
    
    var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    
}

function escapeRegex(text) {
    
    return text.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    
}
