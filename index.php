<?php
/**
 * The main template file
 *
 * @package Colton_Research
 */

get_header();
?>

<style>
    .hero-section { position: relative; height: 85vh; min-height: 600px; display: flex; align-items: center; overflow: hidden; background-color: black; }
    .hero-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.6); z-index: 1; }
    .hero-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; }
    .hero-container { position: relative; z-index: 10; width: 100%; max-width: 1400px; margin: 0 auto; padding: 0 4%; }
    .hero-content { text-align: left; color: white; max-width: 700px; }
    .hero-subtitle { color: #eab308; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 4px; margin-bottom: 20px; }
    .hero-title { font-size: 64px; font-weight: 700; line-height: 1.1; margin-bottom: 24px; }
    .hero-title span { color: #eab308; }
    .hero-desc { font-size: 18px; color: rgba(255,255,255,0.7); line-height: 1.6; margin-bottom: 32px; max-width: 500px; }
    .hero-btns { display: flex; gap: 16px; justify-content: flex-start; }
    .hero-btn { padding: 16px 40px; border-radius: 6px; font-weight: 700; text-transform: uppercase; text-decoration: none; transition: 0.3s; display: inline-block; }
    .hero-btn:hover { transform: translateY(-3px) scale(1.05); box-shadow: 0 10px 20px rgba(234, 179, 8, 0.2); }
    .hero-btn:active { transform: translateY(-1px) scale(0.98); }
    .hero-btn-primary { background: #eab308; color: black; }
    .hero-btn-secondary { border: 2px solid #eab308; color: #eab308; }
</style>

<!-- Hero -->
<section class="hero-section">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/hero-bg.jpg" alt="Laboratory research" class="hero-img" />
    <div class="hero-overlay"></div>
    <div class="hero-container">
        <div class="hero-content animate-slide-up">
            <p class="hero-subtitle">Premium Quality</p>
            <h1 class="hero-title">
                Research<br />
                <span>Peptides</span>
            </h1>
            <p class="hero-desc">
                Highest purity research peptides for scientific investigation. HPLC tested, cGMP manufactured.
            </p>
            <div class="hero-btns">
                <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="hero-btn hero-btn-primary">Shop Now</a>
                <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="hero-btn hero-btn-secondary">Learn More</a>
            </div>
        </div>
    </div>
</section>

	<!-- Trust Bar -->
	<section class="border-y border-border bg-card reveal-on-scroll">
		<div class="container mx-auto py-8 px-4">
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
				<div class="flex items-center gap-4">
					<div class="h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-primary"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-2.035-2.785A1 1 0 0 0 18.945 9H15"/><circle cx="7" cy="18" r="2"/><circle cx="17" cy="18" r="2"/></svg>
					</div>
					<div class="text-left">
						<p class="text-sm font-display font-semibold text-foreground">Free Delivery</p>
						<p class="text-xs text-muted-foreground">Orders over $200</p>
					</div>
				</div>
				<div class="flex items-center gap-4">
					<div class="h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-primary"><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/><circle cx="12" cy="8" r="6"/></svg>
					</div>
					<div class="text-left">
						<p class="text-sm font-display font-semibold text-foreground">≥98% Purity</p>
						<p class="text-xs text-muted-foreground">HPLC verified</p>
					</div>
				</div>
				<div class="flex items-center gap-4">
					<div class="h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-primary"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.5 3.8 17 5 19 5a1 1 0 0 1 1-1z"/></svg>
					</div>
					<div class="text-left">
						<p class="text-sm font-display font-semibold text-foreground">Secure Payment</p>
						<p class="text-xs text-muted-foreground">256-bit SSL encryption</p>
					</div>
				</div>
				<div class="flex items-center gap-4">
					<div class="h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-primary"><path d="M2 14a10 10 0 0 0 20 0"/><path d="M7 13.4V4c0-1.1.9-2 2-2s2 .9 2 2v10"/><path d="M13 13.4V4c0-1.1.9-2 2-2s2 .9 2 2v10"/><path d="M18 13.4V4c0-1.1.9-2 2-2s2 .9 2 2v10"/></svg>
					</div>
					<div class="text-left">
						<p class="text-sm font-display font-semibold text-foreground">Expert Support</p>
						<p class="text-xs text-muted-foreground">Research consultation</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Categories -->
	<section class="container mx-auto py-20 px-4 reveal-on-scroll">
		<div class="text-center mb-12">
			<p class="text-primary text-xs tracking-[0.3em] uppercase font-semibold mb-2">Browse By Purpose</p>
			<h2 class="text-3xl md:text-4xl font-display font-bold text-foreground">Research Categories</h2>
		</div>
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
			<?php
			$categories = get_terms( array(
				'taxonomy' => 'product_cat',
				'hide_empty' => false,
			) );

			if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
				foreach ( $categories as $category ) {
					echo '<a href="' . esc_url( get_term_link( $category ) ) . '" class="group p-6 rounded-lg bg-gradient-card border border-border hover:border-primary/40 transition-all duration-300 text-center">';
					echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-primary mx-auto mb-3 group-hover:scale-110 transition-transform"><path d="M4.5 3h15"/><path d="M6 3v16a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V3"/><path d="M6 14h12"/></svg>';
					echo '<h3 class="font-display font-semibold text-sm text-foreground group-hover:text-primary transition-colors">' . esc_html( $category->name ) . '</h3>';
					echo '</a>';
				}
			} else {
				// Fallback static categories
				$fallback_cats = array("Muscle Growth", "Fat Loss", "Recovery", "Anti-Aging Research", "Cognitive Research");
				foreach ($fallback_cats as $cat) {
					echo '<a href="' . esc_url( home_url( '/shop' ) ) . '" class="group p-6 rounded-lg bg-gradient-card border border-border hover:border-primary/40 transition-all duration-300 text-center">';
					echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-primary mx-auto mb-3 group-hover:scale-110 transition-transform"><path d="M4.5 3h15"/><path d="M6 3v16a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V3"/><path d="M6 14h12"/></svg>';
					echo '<h3 class="font-display font-semibold text-sm text-foreground group-hover:text-primary transition-colors">' . $cat . '</h3>';
					echo '</a>';
				}
			}
			?>
		</div>
	</section>

	<!-- Featured Products -->
	<section class="bg-card border-y border-border">
		<div class="container mx-auto py-20 px-4">
			<div class="flex items-end justify-between mb-12">
				<div class="text-left">
					<p class="text-primary text-xs tracking-[0.3em] uppercase font-semibold mb-2">Top Sellers</p>
					<h2 class="text-3xl md:text-4xl font-display font-bold text-foreground">Featured Products</h2>
				</div>
				<a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="hidden md:flex items-center gap-1 text-sm text-primary hover:text-gold-light font-medium transition-colors">
					View All <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="m9 18 6-6-6-6"/></svg>
				</a>
			</div>

			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
				<?php
				if ( class_exists( 'WooCommerce' ) ) {
					$args = array(
						'post_type' => 'product',
						'posts_per_page' => 4,
						'meta_query' => array(
							array(
								'key' => '_featured',
								'value' => 'yes',
							),
						),
					);
					$featured_query = new WP_Query( $args );

					if ( $featured_query->have_posts() ) {
						while ( $featured_query->have_posts() ) {
							$featured_query->the_post();
							wc_get_template_part( 'content', 'product' );
						}
						wp_reset_postdata();
					} else {
						// Fallback if no featured products
						$args = array(
							'post_type' => 'product',
							'posts_per_page' => 4,
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							wc_get_template_part( 'content', 'product' );
						endwhile;
						wp_reset_postdata();
					}
				} else {
					echo '<p class="text-muted-foreground col-span-full text-center">Install WooCommerce to see products here.</p>';
				}
				?>
			</div>
		</div>
	</section>
</div>

<style>
    .text-gradient-gold {
        background: linear-gradient(135deg, hsl(45, 80%, 55%), hsl(45, 70%, 70%));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .bg-gradient-card {
        background: linear-gradient(145deg, hsl(220, 18%, 12%) 0%, hsl(220, 18%, 8%) 100%);
    }
</style>

<?php
get_footer();
