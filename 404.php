<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Colton_Research
 */

get_header();
?>

<div class="min-h-screen flex items-center justify-center text-center px-4">
	<div class="space-y-6">
		<h1 class="text-7xl md:text-9xl font-display font-bold text-primary/20">404</h1>
		<div class="space-y-2">
			<h2 class="text-3xl font-display font-bold text-foreground uppercase tracking-wider">Page Not Found</h2>
			<p class="text-muted-foreground max-w-md mx-auto">
				The research data you are looking for does not exist or has been moved to a different laboratory.
			</p>
		</div>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block bg-primary text-primary-foreground hover:bg-gold-light px-8 py-3 rounded-md font-semibold transition-colors">
			Back to Home
		</a>
	</div>
</div>

<?php
get_footer();
