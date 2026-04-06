	</main><!-- #main -->

	<footer class="border-t border-border bg-card">
		<div class="container mx-auto py-16 px-4">
			<div class="grid grid-cols-1 md:grid-cols-4 gap-10 text-left">
				<!-- Brand -->
				<div class="space-y-4">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/main logo  - Edited.png" alt="<?php bloginfo( 'name' ); ?>" class="footer-logo h-48 w-auto">
					</a>
					<p class="text-sm text-muted-foreground leading-relaxed">
						Premium research-grade peptides synthesized in cGMP facilities. 
						All products are HPLC verified with ≥99% purity.
					</p>
				</div>

				<!-- Quick Links -->
				<div>
					<h4 class="text-sm font-display font-semibold tracking-wider uppercase text-foreground mb-4">Quick Links</h4>
					<ul class="space-y-3">
						<li><a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="text-sm text-muted-foreground hover:text-primary transition-colors">Shop All</a></li>
						<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="text-sm text-muted-foreground hover:text-primary transition-colors">About Us</a></li>
						<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="text-sm text-muted-foreground hover:text-primary transition-colors">Contact</a></li>
						<li><a href="<?php echo esc_url( home_url( '/faq' ) ); ?>" class="text-sm text-muted-foreground hover:text-primary transition-colors">FAQ</a></li>
					</ul>
				</div>

				<!-- Categories -->
				<div>
					<h4 class="text-sm font-display font-semibold tracking-wider uppercase text-foreground mb-4">Categories</h4>
					<ul class="space-y-3">
						<?php
						$categories = get_terms( array(
							'taxonomy' => 'product_cat',
							'hide_empty' => false,
							'number' => 5,
						) );
						if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
							foreach ( $categories as $category ) {
								echo '<li><a href="' . esc_url( get_term_link( $category ) ) . '" class="text-sm text-muted-foreground hover:text-primary transition-colors">' . esc_html( $category->name ) . '</a></li>';
							}
						} else {
							echo '<li><a href="' . esc_url( home_url( '/shop' ) ) . '" class="text-sm text-muted-foreground hover:text-primary transition-colors">Muscle Growth</a></li>';
							echo '<li><a href="' . esc_url( home_url( '/shop' ) ) . '" class="text-sm text-muted-foreground hover:text-primary transition-colors">Fat Loss</a></li>';
						}
						?>
					</ul>
				</div>

				<!-- Policies -->
				<div>
					<h4 class="text-sm font-display font-semibold tracking-wider uppercase text-foreground mb-4">Policies</h4>
					<ul class="space-y-3">
						<li><a href="<?php echo esc_url( home_url( '/terms' ) ); ?>" class="text-sm text-muted-foreground hover:text-primary transition-colors">Terms & Conditions</a></li>
						<li><a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>" class="text-sm text-muted-foreground hover:text-primary transition-colors">Privacy Policy</a></li>
						<li><a href="<?php echo esc_url( home_url( '/refund' ) ); ?>" class="text-sm text-muted-foreground hover:text-primary transition-colors">Refund Policy</a></li>
						<li><a href="<?php echo esc_url( home_url( '/shipping' ) ); ?>" class="text-sm text-muted-foreground hover:text-primary transition-colors">Shipping Policy</a></li>
					</ul>
				</div>
			</div>

			<!-- Disclaimer -->
			<div class="mt-12 pt-8 border-t border-border">
				<p class="text-xs text-muted-foreground text-center leading-relaxed max-w-3xl mx-auto">
					<strong class="text-primary uppercase">Research Use Only</strong> — All products sold on this website are intended strictly for laboratory and research purposes. 
					They are not intended for human consumption, veterinary use, or any therapeutic applications. 
					By purchasing, you agree to use these products solely for in vitro research.
				</p>
				<p class="text-xs text-muted-foreground text-center mt-4">
					© <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
				</p>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<!-- Toast Notifications Container -->
<div id="toast-container" class="fixed bottom-8 right-8 z-[1000] flex flex-col gap-3 pointer-events-none w-full max-w-[420px] px-6 md:px-0"></div>

<!-- Mini Cart Drawer -->
<div id="cart-drawer-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[200] opacity-0 invisible transition-all duration-300"></div>

<div id="cart-drawer" class="fixed top-0 right-0 w-full max-w-md h-screen bg-white z-[210] translate-x-full transition-all duration-500 ease-in-out shadow-2xl flex flex-col">
    <!-- Header -->
    <div class="p-6 border-b border-border flex items-center justify-between">
        <h2 class="text-xl font-display font-bold text-foreground">Your Cart</h2>
        <button id="cart-close" class="p-2 text-muted-foreground hover:text-primary transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
    </div>

    <!-- Content -->
    <div class="flex-1 overflow-y-auto custom-scrollbar" id="mini-cart-content">
        <?php if ( class_exists( 'WooCommerce' ) ) : ?>
            <?php woocommerce_mini_cart(); ?>
        <?php endif; ?>
    </div>
</div>

<?php wp_footer(); ?>



</body>
</html>
