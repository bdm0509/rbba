<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

<div id="rotating_banner">
<?php if(function_exists('wp_content_slider')) { wp_content_slider(); } ?>
</div> <!-- #rotating_banner -->

<div id="quick_links">
 <?php
  // Get parent quick links page 
  $quick_links_page = get_page_by_title('Quick Links');
  $quick_links = get_pages('child_of=' . $quick_links_page->ID . '&sort_column=menu_order');

  foreach($quick_links as $quick_link) { 
   // Get some basic post data
   $post_link = get_page_link($quick_link->ID);
   $post_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($quick_link->ID), 'full');
?>
   <a href="<?php echo $post_link; ?>">
    <div class="quick_link" id="<?php echo $quick_link->post_name; ?>">
     <div class="quick_link_title"><?php echo strtoupper($quick_link->post_title); ?></div>
    </div>
   </a>

   <style type="text/css">
    #<?php echo $quick_link->post_name; ?> {
      background-image: url('<?php echo $post_thumbnail[0]; ?>');g
    }
   </style>
<?php  }
 ?>
</div> <!-- #quick_links -->

<?php get_footer(); ?>
