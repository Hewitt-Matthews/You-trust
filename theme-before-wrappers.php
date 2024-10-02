<?php
/**
 * Template partial used to add content to the page in Theme Builder.
 * Duplicates partial content from header.php in order to maintain
 * backwards compatibility with child themes.
 */

$product_tour_enabled = et_builder_is_product_tour_enabled();
$page_container_style = $product_tour_enabled ? ' style="padding-top: 0px;"' : '';
?>

<style id="loading-style">

    body,
    body * {
        display: none;
        animation-duration: 0s!important;
        transition-duration: 0s!important;
    }

</style>

<div id="page-container" class="hidden" <?php echo et_core_intentionally_unescaped( $page_container_style, 'fixed_string' ); ?>>
