<?php
/**
 * Template Name: Home New Rev 2026
 *
 * Loops the ACF Flexible Content field 'home' and renders the matching
 * template part from rev-template-part/home-page-new/ for each row.
 */
get_header();
?>

<?php
if ( have_rows( 'page_builder' ) ) :
	while ( have_rows( 'page_builder' ) ) :
		the_row();

		$layout = get_row_layout();               // e.g. "hero_banner"
		$slug   = str_replace( '_', '-', $layout ); // -> "hero-banner"

		// Looks for rev-template-part/home-page-new/hero-banner.php etc.
		get_template_part( 'rev-template-part/home-new-2026/' . $slug );

	endwhile;
endif;
?>

<?php
get_footer();
?>