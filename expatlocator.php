<?php
include_once("_common/header.php");
include_once("_common/profession_options.php");
$professionOptions = get_aaan_professions();
?>



<!-- CONTENT START -->
        <div class="page-content ">
            <!-- INNER PAGE BANNER -->
            <div class="mt-bnr-inr overlay-wraper bg-parallax bg-top-center"  data-stellar-background-ratio="0.5"  style="background-image:url(images/banner/2.jpg);">
            	<div class="overlay-main bg-black opacity-07"></div>
                <div class="container">
                    <div class="mt-bnr-inr-entry">
                    	<div class="banner-title-outer">
                        	<div class="banner-title-name">
                        		<h2 class="m-b0">Helping Connect you to Experts</h2>
                            </div>
                        </div>
                        <!-- BREADCRUMB ROW -->                            
                        
                            <!-- <div>
                                <ul class="mt-breadcrumb breadcrumb-style-2">
                                    <li><a href="javascript:void(0);">Home</a></li>
                                    <li>Post Image</li>
                                </ul>
                            </div> -->
                        
                        <!-- BREADCRUMB ROW END -->                        
                    </div>
                </div>
            </div>
            <!-- INNER PAGE BANNER END -->
            
            <!-- SECTION CONTENT START -->
            <div class="section-full p-tb80 inner-page-padding">
                <div class="container">
 
                    <!-- OUR BLOG END -->
                                       
                    <div class="clear" id="comment-list">
                        <div class="comments-area" id="comments">


                            <!-- LEAVE A REPLY START -->
                            <div class="comment-respond m-t5" id="respond">

                                <h2 class="comment-reply-title" id="reply-title">Expert Locator
                                    <small>
                                        <a style="display:none;" href="#" id="cancel-comment-reply-link" rel="nofollow">Cancel reply</a>
                                    </small>
                                </h2>

                                <form class="comment-form bdr-1 bdr-solid bdr-gray p-a20" id="commentform" method="post" >
                            
                                    <p class="comment-form-author">
								    <label for="author">Profession Category <span class="required">*</span></label>
								    <select class="form-control" name="user-comment" id="profession_category" required>
								        <option value="" disabled selected>Select a profession</option>
								        <?php foreach ($professionOptions as $professionOption): ?>
								            <option value="<?php echo htmlspecialchars($professionOption, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($professionOption, ENT_QUOTES, 'UTF-8'); ?></option>
								        <?php endforeach; ?>
								    </select>
									</p>

                                    
                                    <p class="comment-form-email">
                                        <label for="email">Profession Description</label>
                                        <input class="form-control" type="text" value="" name="email" placeholder="Profession Description (Optional)"  id="profession_description">
                                    </p>
                                    
                                    <!-- <p class="comment-form-url">
                                        <label for="url">Website</label>
                                        <input class="form-control" type="text"  value=""  name="url"   placeholder="Website" id="url">
                                    </p> -->
                                    
                                    <p class="form-submit">
                                        <button class="site-button button-sm radius-no text-uppercase font-weight-600" type="button" onclick="performExpertSearch()">Search</button>
                                    </p>
                                    
                                </form>

                            </div>
                            <!-- LEAVE A REPLY END -->



                            <div class="p-tb30">

                                <!-- COMMENT LIST START -->
                                <!-- <ol class="comment-list">
                                    <li class="comment">
                                    	
                                        <div class="comment-body">
                                            <div class="comment-meta">
                                                <a href="javascript:void(0);">20 June 2019 at 8:15 am</a>
                                            </div>                                      
                                            <div class="comment-author vcard">
                                                <img  class="avatar photo" src="images/testimonials/pic1.jpg" alt="">
                                                <cite class="fn">Federico</cite>
                                                <span class="says">says:</span>
                                            </div>

                                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which  </p>
                                            <div class="reply">
                                                <a href="javscript:;" class="comment-reply-link letter-spacing-2 text-uppercase">View</a>
                                            </div>
                                      </div>
                                    </li>                                
                                    <li class="comment">
                                    	
                                        <div class="comment-body">
                                                                               
                                            <div class="comment-author vcard">
                                                <img  class="avatar photo" src="images/testimonials/pic4.jpg" alt="">
                                                <cite class="fn"> Schiocchet </cite>
                                                <span class="says">says:</span>
                                            </div>

                                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,  </p>
                                            <div class="reply">
                                                <a href="javscript:;" class="comment-reply-link letter-spacing-2 text-uppercase">View</a>
                                            </div>
                                        </div>
                                        
                                        
                                    </li>

                                </ol> -->
                                <!-- COMMENT LIST END -->
                                
                                
                           </div>
                        </div>
                    </div>

                        
                </div>
            </div>
            <!-- SECTION CONTENT END -->

        </div>
        <!-- CONTENT END -->


<script>
// Create a dedicated results container if it doesn't exist
function initializeExpertResultsContainer() {
    var resultsContainer = document.getElementById('expert-search-results');
    if (!resultsContainer) {
        resultsContainer = document.createElement('div');
        resultsContainer.id = 'expert-search-results';
        resultsContainer.className = 'p-tb30';
        
        // Insert after the comment form
        var commentForm = document.getElementById('respond');
        if (commentForm && commentForm.parentNode) {
            commentForm.parentNode.insertBefore(resultsContainer, commentForm.nextSibling);
        }
    }
    return resultsContainer;
}

function performExpertSearch() {
    // Get form values
    var professionCategory = document.getElementById('profession_category').value;
    var professionDescription = document.getElementById('profession_description').value;
    
    // Validate profession category is selected
    if (!professionCategory || professionCategory === '') {
        alert('Please select a profession category');
        return false;
    }
    
    console.log('=== Starting Expert Search ===');
    console.log('Category:', professionCategory);
    console.log('Description:', professionDescription);
    
    // Get or create results container - IMPORTANT: Always get fresh reference
    var resultArea = initializeExpertResultsContainer();
    console.log('Result area:', resultArea);
    console.log('Result area ID:', resultArea.id);
    
    // CRITICAL: Clear the container completely before showing loading
    resultArea.innerHTML = '';
    
    // Show loading message
    resultArea.innerHTML = '<div class="search-loading" style="text-align: center; padding: 20px; font-size: 16px;"><i class="fa fa-spinner fa-spin"></i> Searching for experts...</div>';
    
    // Scroll to results area
    setTimeout(function() {
        resultArea.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 100);
    
    // Prepare search parameters with cache-busting timestamp
    var searchData = {
        category: professionCategory,
        description: professionDescription,
        _ts: new Date().getTime()  // Cache-buster to force fresh response
    };
    
    // Use jQuery AJAX with cache disabled
    $.ajax({
        type: "POST",
        url: base_url + "search/expert_locator",
        data: searchData,
        dataType: 'json',
        cache: false,  // Disable caching
        timeout: 10000,
        success: function(response) {
            console.log('=== API Response Received ===');
            console.log('Full response:', response);
            console.log('Status:', response.status);
            console.log('Message:', response.msg);
            console.log('Data count:', response.data ? response.data.length : 0);
            
            // Get fresh container reference - IMPORTANT!
            var freshResultArea = document.getElementById('expert-search-results');
            if (!freshResultArea) {
                console.warn('WARNING: expert-search-results container not found, creating...');
                freshResultArea = initializeExpertResultsContainer();
            }
            
            console.log('Using container with ID:', freshResultArea.id);
            
            // Call display function with fresh container
            renderExpertSearchResults(response, freshResultArea);
        },
        error: function(xhr, status, error) {
            console.error('=== Search Error ===');
            console.error('Status:', xhr.status);
            console.error('Error:', error);
            console.error('Response Text:', xhr.responseText);
            
            var errorMsg = 'Search failed. Please try again.';
            try {
                if(xhr.responseJSON && xhr.responseJSON.msg) {
                    errorMsg = xhr.responseJSON.msg;
                }
            } catch(e) {
                console.error('Error parsing error response:', e);
            }
            
            // Get fresh container reference and update it
            var freshResultArea = document.getElementById('expert-search-results');
            if (freshResultArea) {
                freshResultArea.innerHTML = '<div class="alert alert-danger" style="padding: 20px; margin: 20px 0; color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 4px;"><strong>Error:</strong> ' + errorMsg + '</div>';
            }
        }
    });
    
    return false;
}

function renderExpertSearchResults(response, resultArea) {
    console.log('=== Rendering Expert Results ===');
    console.log('Result area element exists:', resultArea !== undefined && resultArea !== null);
    console.log('Response object:', response);
    
    if (!resultArea) {
        console.error('ERROR: Result area is null or undefined');
        return;
    }
    
    // FIRST: Completely clear the container to remove any previous results
    console.log('CLEARING PREVIOUS RESULTS...');
    resultArea.innerHTML = '';
    
    // Check response structure
    if (!response) {
        console.error('ERROR: Response is null or undefined');
        resultArea.innerHTML = '<div class="alert alert-danger">No response from server</div>';
        return;
    }
    
    console.log('Response status:', response.status);
    console.log('Response data exists:', response.data !== undefined && response.data !== null);
    console.log('Response data is array:', Array.isArray(response.data));
    if(Array.isArray(response.data)) {
        console.log('Response data length:', response.data.length);
    }
    
    // Check if we have data
    var expertList = response.data || [];
    
    if (!Array.isArray(expertList) || expertList.length === 0) {
        console.log('No experts found in response');
        resultArea.innerHTML = '<div class="alert alert-info" style="padding: 20px; margin: 20px 0; border: 1px solid #d1ecf1; border-radius: 4px; background-color: #d1ecf1; color: #0c5460;"><strong>No experts found</strong> matching your criteria. Please try a different search.</div>';
        return;
    }
    
    console.log('Building HTML for', expertList.length, 'experts');
    
    // Build results HTML
    var resultsHtml = '<div class="expert-results" style="margin-top: 20px;">';
    resultsHtml += '<h3 style="margin-bottom: 20px; color: #333;">Search Results (' + expertList.length + ' expert(s) found)</h3>';
    
    expertList.forEach(function(expert, index) {
        console.log('Processing expert', index + 1, ':', expert.name);
        
        resultsHtml += '<div class="expert-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px; background-color: #f9f9f9;">';
        resultsHtml += '<h4 style="margin-top: 0; margin-bottom: 10px; color: #007bff; font-size: 16px; font-weight: bold;">' + (expert.name || 'Unknown') + '</h4>';
        
        resultsHtml += '<p style="margin: 8px 0;"><strong>Category:</strong> ' + ((expert.category || '').charAt(0).toUpperCase() + (expert.category || '').slice(1)) + '</p>';
        
        if (expert.description && expert.description.trim() !== '') {
            resultsHtml += '<p style="color: #888; font-size: 13px; margin: 8px 0;"><strong>Description:</strong> ' + (expert.description || '').toLowerCase() + '</p>';
        }
        
        if (expert.location && expert.location.trim() !== '') {
            resultsHtml += '<p style="margin: 8px 0;"><strong>Location:</strong> ' + expert.location + '</p>';
        }
        
        if (expert.contact && expert.contact.trim() !== '') {
            resultsHtml += '<p style="margin: 8px 0;"><strong>Contact:</strong> <a href="tel:' + expert.contact + '" style="color: #007bff; text-decoration: none;">' + expert.contact + '</a></p>';
        }
        
        resultsHtml += '</div>';
    });
    
    resultsHtml += '</div>';
    
    console.log('Setting innerHTML on result area');
    console.log('HTML length:', resultsHtml.length);
    
    // Update the DOM with completely new HTML (replacing any previous content)
    resultArea.innerHTML = resultsHtml;
    
    console.log('=== Expert Results Display Complete ===');
}
</script>

<?php
include_once("_common/footer.php");
?>
