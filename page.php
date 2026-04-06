<?php
/**
 * The template for displaying all pages
 *
 * @package Colton_Research
 */

get_header();

$slug = get_post_field( 'post_name', get_post() );

// Fail-safe: Automatically load the correct template based on slug if not explicitly set
if ( $slug === 'about' ) {
    include( get_template_directory() . '/template-about.php' );
    return;
} elseif ( $slug === 'contact' ) {
    include( get_template_directory() . '/template-contact.php' );
    return;
} elseif ( $slug === 'faq' ) {
    include( get_template_directory() . '/template-faq.php' );
    return;
} elseif ( $slug === 'terms' || $slug === 'privacy' || $slug === 'refund' || $slug === 'shipping' ) {
    include( get_template_directory() . '/template-policy.php' );
    return;
}
?>

<div class="container mx-auto py-20 px-4 min-h-[60vh]">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<header class="entry-header mb-12 text-center">
			<?php the_title( '<h1 class="text-4xl md:text-5xl font-display font-bold text-foreground">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content <?php echo ( is_cart() || is_checkout() || is_account_page() ) ? 'w-full max-w-none' : 'prose prose-invert max-w-none text-left'; ?>">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'colton-research' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	<?php endwhile; // End of the loop. ?>
</div>

<?php
get_footer();
