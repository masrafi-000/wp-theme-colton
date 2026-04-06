<?php
/**
 * Template Name: Policy Page
 *
 * @package Colton_Research
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! isset( $slug ) ) {
    get_header();
}
?>

<div class="min-h-screen">
	<div class="border-b border-border bg-card">
		<div class="container mx-auto py-12 px-4">
			<?php
			$subtitle = 'Legal';
			$slug = get_post_field( 'post_name', get_post() );
			
			if ( strpos( $slug, 'privacy' ) !== false ) {
				$subtitle = 'Your Data';
			} elseif ( strpos( $slug, 'refund' ) !== false ) {
				$subtitle = 'Returns';
			} elseif ( strpos( $slug, 'shipping' ) !== false ) {
				$subtitle = 'Delivery';
			}
			?>
			<p class="text-primary text-xs tracking-[0.3em] uppercase font-semibold mb-2"><?php echo esc_html( $subtitle ); ?></p>
			<h1 class="text-3xl md:text-5xl font-display font-bold text-foreground"><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="container mx-auto py-16 px-4 max-w-3xl reveal-on-scroll">
		<div class="prose prose-invert max-w-none space-y-6 text-muted-foreground text-sm leading-relaxed text-left">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</div>
	</div>
</div>

<style>
    .prose h2 {
        @apply text-lg font-display font-bold text-foreground mt-8 mb-4;
    }
    .prose p {
        @apply mb-4;
    }
</style>

<?php
get_footer();
