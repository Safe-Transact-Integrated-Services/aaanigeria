<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once("_common/header.php");
?>

<!-- CONTENT START -->
<div class="page-content">
    <!-- INNER PAGE BANNER -->
    <div class="mt-bnr-inr overlay-wraper bg-parallax bg-top-center" data-stellar-background-ratio="0.5" style="background-image:url(images/banner/1.jpg);">
        <div class="overlay-main bg-black opacity-07"></div>
        <div class="container">
            <div class="mt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        <h2 class="m-b0">Creating lasting memories, showcasing the vibrant spirit of our community.</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->
                <div>
                    <ul class="mt-breadcrumb breadcrumb-style-2">
                        <li><a href="javascript:void(0);">Home</a></li>
                        <li>Project Masonry</li>
                    </ul>
                </div>
                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

    <!-- SECTION CONTENT START -->
    <div class="section-full p-tb80 bg-gray inner-page-padding">

        <!-- GALLERY CONTENT START -->
        <div class="container-fluid">
            <!-- PAGINATION START -->
            <div class="filter-wrap p-b30 text-center">
                <ul class="filter-navigation inline-navigation masonry-filter link-style text-uppercase">
                    <li class="active"><a data-filter="*" href="#" data-hover="All">All</a></li>
                </ul>
            </div>
            <!-- PAGINATION END -->

            <!-- GALLERY CONTENT START -->
            <div class="portfolio-wrap mfp-gallery work-grid row clearfix">
                <?php
                // Set the directory path where your images are stored
                $dir = 'images/gallery/latest_event/';

                // Check if the directory exists
                if (!is_dir($dir)) {
                    die("Directory does not exist: $dir");
                }

                // Scan the directory for files
                $images = scandir($dir);
                if ($images === false) {
                    die("Unable to read the directory: $dir");
                }

                // Filter out the '.' and '..' directories
                $images = array_diff($images, array('.', '..'));

                // If there are images, display them
                if (count($images) > 0):
                    // Loop through each image file and display it
                    foreach ($images as $image):
                        // Construct the full path to the image
                        $imagePath = $dir . $image;
                        // Only show the file if it's an image (check extension)
                        if (in_array(strtolower(pathinfo($image, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])):
                ?>
                            <div class="masonry-item cat-3 col-lg-3 col-md-4 col-sm-6 m-b30">
                                <div class="image-effect-one hover-shadow">
                                    <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($image) ?>" />
                                    <a class="mfp-link" href="<?= $imagePath ?>">
                                        <i class="fa fa-arrows-alt"></i>
                                    </a>
                                </div>
                            </div>
                <?php
                        endif;
                    endforeach;
                else:
                    echo "<p>No images found in the gallery.</p>";
                endif;
                ?>
            </div>
            <!-- GALLERY CONTENT END -->

            <div class="m-t50 text-center">
                <a href="#" class="site-button btn-effect">Load More</a>
            </div>

        </div>
        <!-- GALLERY CONTENT END -->

    </div>
    <!-- SECTION CONTENT END  -->

</div>
<!-- CONTENT END -->

<?php
include_once("_common/footer.php");
?>