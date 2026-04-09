	</main><!-- #main -->

	<footer class="bg-[#f8fafc] text-slate-900 overflow-hidden relative border-t border-slate-200">
        <!-- Subtle Scientific Background (Ultra-low opacity for light theme) -->
        <div class="absolute inset-0 z-0 opacity-[0.02] scientific-grid pointer-events-none"></div>

		<div class="container max-w-[1400px] xl:max-w-[1600px] 2xl:max-w-[1720px] mx-auto py-16 sm:py-24 px-6 sm:px-10 relative z-10">
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
				
				<!-- Column 1: Scientific Identity (Span 6) -->
				<div class="lg:col-span-6 space-y-8 flex flex-col items-center sm:items-start text-center sm:text-left">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="block group">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/main logo  - Edited.png" alt="<?php bloginfo( 'name' ); ?>" class="footer-logo h-24 sm:h-32 xl:h-40 w-auto transition-transform group-hover:scale-105 duration-500">
					</a>
					<div class="space-y-6 max-w-xl">
                        <p class="text-base text-slate-500 leading-relaxed font-medium">
                            Halo Peptideco sets the gold standard for research synthesis. Every compound is batch-verified in cGMP facilities to ensure undisputed laboratory integrity and pharmaceutical-grade purity across every requisition.
                        </p>
                        <!-- Purity Badges -->
                        <div class="flex items-center justify-center sm:justify-start gap-4 pt-2">
                             <div class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-xl shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-[#38bdf8] animate-pulse"></span>
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-950">cGMP Protocol</span>
                             </div>
                             <div class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-xl shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-500">&ge;99% HPLC PURITY</span>
                             </div>
                        </div>
                    </div>
				</div>

				<!-- Column 2: Research Database (Span 3) -->
				<div class="lg:col-span-3">
					<h4 class="text-[11px] font-display font-bold tracking-[0.3em] uppercase text-slate-900 mb-8 border-l-3 border-[#38bdf8] pl-4">Research Tools</h4>
					<ul class="space-y-5">
						<li><a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="text-[14px] text-slate-500 hover:text-[#38bdf8] transition-all duration-300 flex items-center gap-3 group font-medium"><span class="w-0 group-hover:w-5 h-[2px] bg-[#38bdf8] transition-all duration-300"></span>Primary Catalog</a></li>
						<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="text-[14px] text-slate-500 hover:text-[#38bdf8] transition-all duration-300 flex items-center gap-3 group font-medium"><span class="w-0 group-hover:w-5 h-[2px] bg-[#38bdf8] transition-all duration-300"></span>Operational Ethics</a></li>
						<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="text-[14px] text-slate-500 hover:text-[#38bdf8] transition-all duration-300 flex items-center gap-3 group font-medium"><span class="w-0 group-hover:w-5 h-[2px] bg-[#38bdf8] transition-all duration-300"></span>Direct Consultation</a></li>
						<li><a href="<?php echo esc_url( home_url( '/faq' ) ); ?>" class="text-[14px] text-slate-500 hover:text-[#38bdf8] transition-all duration-300 flex items-center gap-3 group font-medium"><span class="w-0 group-hover:w-5 h-[2px] bg-[#38bdf8] transition-all duration-300"></span>Technical Support</a></li>
					</ul>
				</div>

				<!-- Column 3: Compliance & Legal (Span 3) -->
				<div class="lg:col-span-3">
					<h4 class="text-[11px] font-display font-bold tracking-[0.3em] uppercase text-slate-900 mb-8 border-l-3 border-[#38bdf8] pl-4">Compliance</h4>
					<ul class="space-y-5">
						<li><a href="<?php echo esc_url( home_url( '/terms' ) ); ?>" class="text-[14px] text-slate-500 hover:text-[#38bdf8] transition-all duration-300 flex items-center gap-3 group font-medium"><span class="w-0 group-hover:w-5 h-[2px] bg-[#38bdf8] transition-all duration-300"></span>Service Framework</a></li>
						<li><a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>" class="text-[14px] text-slate-500 hover:text-[#38bdf8] transition-all duration-300 flex items-center gap-3 group font-medium"><span class="w-0 group-hover:w-5 h-[2px] bg-[#38bdf8] transition-all duration-300"></span>Data Protection</a></li>
						<li><a href="<?php echo esc_url( home_url( '/refund' ) ); ?>" class="text-[14px] text-slate-500 hover:text-[#38bdf8] transition-all duration-300 flex items-center gap-3 group font-medium"><span class="w-0 group-hover:w-5 h-[2px] bg-[#38bdf8] transition-all duration-300"></span>Fulfillment Policies</a></li>
					</ul>
				</div>
			</div>

			<!-- Legal Disclaimer -->
			<div class="mt-20 pt-10 border-t border-slate-200">
				<div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                    <div class="lg:col-span-8">
                        <p class="text-[11px] text-slate-400 text-center lg:text-left leading-relaxed uppercase tracking-[0.2em] font-bold">
                            <span class="text-slate-900 font-extrabold mr-3">Research Directive:</span> 
                            All products are for laboratory research use only. Not for human consumption, diagnostics, or therapeutic applications. Compliance with local research protocols is mandatory.
                        </p>
                    </div>
                    <div class="lg:col-span-4 lg:text-right text-center">
                        <p class="text-[11px] text-slate-400 uppercase tracking-widest font-black">
                            &copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. Laboratory Registry.
                        </p>
                    </div>
                </div>
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
