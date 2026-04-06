<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
    <script src="https://cdn.tailwindcss.com?plugins=typography,forms,aspect-ratio,line-clamp"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#f8fafc',
                        foreground: '#0f172a',
                        card: '#ffffff',
                        'card-foreground': '#0f172a',
                        primary: '#02669e',
                        'primary-foreground': '#f8fafc',
                        secondary: '#f1f5f9',
                        'secondary-foreground': '#0f172a',
                        muted: '#f8fafc',
                        'muted-foreground': '#64748b',
                        accent: '#02669e',
                        'accent-foreground': '#ffffff',
                        border: '#e2e8f0',
                        input: '#f8fafc',
                        ring: '#02669e',
                        brand: {
                            blue: '#02669e',
                            'blue-dark': '#014d7a',
                            green: '#22c55e',
                        }
                    },
                    fontFamily: {
                        display: ['Space Grotesk', 'sans-serif'],
                        body: ['Outfit', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fade-in 0.6s ease-out forwards',
                        'slide-up': 'slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                    },
                    keyframes: {
                        'fade-in': {
                            from: { opacity: 0 },
                            to: { opacity: 1 },
                        },
                        'slide-up': {
                            from: { opacity: 0, transform: 'translateY(20px)' },
                            to: { opacity: 1, transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer components {
            .glow-blue {
                box-shadow: 0 0 20px rgba(2, 102, 158, 0.15), 0 0 60px rgba(2, 102, 158, 0.05);
            }
            .bg-gradient-card {
                background: linear-gradient(145deg, #e0f2fe 0%, #f8fafc 45%, #ffffff 100%);
            }
            .text-gradient-brand {
                @apply bg-clip-text text-transparent bg-gradient-to-br from-[#02669e] to-[#0ea5e9];
            }
            .btn-hover-effect {
                @apply transition-all duration-300 hover:scale-105 active:scale-95 hover:shadow-lg hover:shadow-primary/20;
            }
            .reveal-on-scroll {
                @apply opacity-0 translate-y-8 transition-all duration-700 ease-out;
            }
            .reveal-on-scroll.is-visible {
                @apply opacity-100 translate-y-0;
            }
            
            /* WooCommerce Global */
            .woocommerce-breadcrumb {
                @apply text-sm text-muted-foreground mb-8 block;
            }
            .woocommerce-breadcrumb a {
                @apply hover:text-primary transition-colors;
            }
            
            /* Archive Sidebar */
            .colton-categories-sidebar {
                @apply space-y-4;
            }
            .colton-categories-sidebar h3 {
                @apply text-foreground font-display font-bold uppercase tracking-[0.2em] text-[12px] mb-8 !important;
            }
            .colton-categories-sidebar ul {
                @apply space-y-6;
            }
            .colton-categories-sidebar li a {
                @apply text-muted-foreground hover:text-primary transition-all duration-300 text-[14px] font-medium block !important;
            }
            .colton-categories-sidebar li a.active {
                @apply text-primary font-bold !important;
            }
            
            /* Archive Search */
            .woocommerce-product-search {
                @apply relative w-full;
            }
            .search-field {
                @apply w-full bg-white border border-border rounded-xl py-5 px-14 text-foreground focus:outline-none focus:border-primary/50 focus:bg-white transition-all duration-300 text-[15px] !important;
            }
            
            /* Archive */
            .woocommerce-result-count {
                @apply text-muted-foreground text-[12px] font-medium;
            }
            .woocommerce-ordering select {
                @apply bg-white border border-border rounded-lg py-3 px-6 text-foreground focus:outline-none focus:border-primary/50 transition-colors appearance-none cursor-pointer pr-12 text-[14px];
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 1rem center;
            }
            
            ul.products {
                @apply grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 !important;
            }
            ul.products::before, ul.products::after {
                display: none !important;
            }
            ul.products li.product {
                @apply w-full m-0 !important;
            }
            ul.products li.product .price {
                @apply text-primary font-bold !important;
            }
            ul.products li.product .button {
                @apply bg-primary text-primary-foreground hover:bg-accent rounded-lg py-3 px-6 transition-all duration-300 !important;
            }
            ul.products li.product img, .product-image-container img {
                @apply max-h-full w-auto object-contain mx-auto !important;
            }
            
            /* Single Product */
            .woocommerce-product-gallery {
                @apply bg-gradient-card rounded-xl border border-border p-8 md:p-12 flex items-center justify-center min-h-[300px] md:min-h-[500px] !important;
            }
            .woocommerce-product-gallery .woocommerce-product-gallery__image {
                @apply flex items-center justify-center w-full !important;
            }
            .woocommerce-product-gallery img {
                @apply max-h-[400px] w-auto object-contain hover:scale-105 transition-transform duration-500 !important;
            }
            
            .product_title {
                @apply font-display font-bold text-foreground text-4xl md:text-5xl mb-2 !important;
            }
            .price {
                @apply text-primary font-display font-bold text-2xl md:text-3xl block !important;
            }
            .price del {
                @apply text-muted-foreground text-lg line-through mr-2 font-normal !important;
            }
            .price ins {
                @apply text-primary no-underline !important;
            }
            
            .single_add_to_cart_button {
                @apply bg-primary text-primary-foreground hover:bg-accent transition-all duration-300 font-bold uppercase text-sm tracking-widest px-8 py-4 rounded-lg w-full flex items-center justify-center gap-2 mt-6 !important;
            }

            /* Tabs */
            .woocommerce-tabs ul.tabs {
                @apply flex gap-8 border-b border-border mb-8 !important;
            }
            .woocommerce-tabs ul.tabs li {
                @apply bg-transparent border-0 p-0 m-0 !important;
            }
            .woocommerce-tabs ul.tabs li a {
                @apply text-muted-foreground font-display font-bold uppercase tracking-widest text-xs py-4 block border-b-2 border-transparent transition-all !important;
            }
            .woocommerce-tabs ul.tabs li.active a {
                @apply text-primary border-primary !important;
            }

            /* WooCommerce Global Tweaks */
            .woocommerce div.product .product_title {
                @apply font-display font-bold text-foreground text-4xl md:text-5xl mb-2 !important;
            }
            .woocommerce div.product p.price, .woocommerce div.product span.price {
                @apply text-primary font-display font-bold text-3xl flex items-baseline gap-2 !important;
            }
            .woocommerce div.product .woocommerce-product-details__short-description {
                @apply text-muted-foreground leading-relaxed text-lg mb-8 !important;
            }
            .woocommerce div.product button.button.alt {
                @apply bg-primary text-primary-foreground hover:bg-accent transition-all duration-300 font-bold uppercase text-sm tracking-widest px-10 py-5 rounded-md flex items-center justify-center gap-3 !important;
            }
            
            /* Cart & Checkout Tables */
            .woocommerce table.shop_table {
                @apply border-collapse border-border w-full bg-card rounded-xl overflow-hidden !important;
            }
            .woocommerce table.shop_table thead {
                @apply bg-secondary/50 !important;
            }
            .woocommerce table.shop_table th {
                @apply text-foreground font-display font-semibold uppercase tracking-wider text-xs p-6 text-left border-b border-border !important;
            }
            .woocommerce table.shop_table td {
                @apply p-6 border-b border-border/50 text-foreground font-medium !important;
                background: transparent !important;
            }
            .woocommerce table.cart img {
                @apply w-24 h-24 object-contain bg-secondary/30 rounded-lg p-3 !important;
            }
            .woocommerce table.cart td.product-name a {
                @apply font-display font-bold text-foreground hover:text-primary transition-colors text-lg !important;
            }

            /* Cart Totals & Checkout Summary */
            .cart-collaterals, .woocommerce-checkout-review-order {
                @apply bg-card border border-border rounded-xl p-8 !important;
            }
            .woocommerce .cart-collaterals .cart_totals h2, #order_review_heading {
                @apply font-display font-bold text-foreground text-2xl mb-8 !important;
            }
            .woocommerce .cart-collaterals .cart_totals table td, .woocommerce-checkout-review-order-table td {
                @apply border-0 text-foreground font-display font-bold text-right p-2 !important;
                background: transparent !important;
            }
            .woocommerce .cart-collaterals .cart_totals .order-total td, .woocommerce-checkout-review-order-table .order-total td {
                @apply text-primary text-3xl !important;
            }

            /* Notices */
            .woocommerce-message, .woocommerce-info, .woocommerce-error {
                @apply bg-secondary border-l-4 border-primary text-foreground p-5 rounded-md mb-8 flex items-center gap-4 !important;
            }

            /* Cart & Checkout Layout */
            .woocommerce-cart-form {
                @apply bg-white border border-border rounded-xl overflow-hidden;
            }
            .checkout-button {
                @apply bg-primary text-primary-foreground hover:bg-accent transition-all duration-300 font-bold uppercase text-sm tracking-widest px-8 py-4 rounded-lg w-full flex items-center justify-center gap-2 !important;
            }
            .woocommerce-checkout, .wc-block-checkout {
                @apply flex flex-col lg:flex-row gap-12 !important;
                width: 100% !important;
                max-width: none !important;
            }
            #customer_details, .wc-block-checkout__main {
                @apply flex-grow space-y-8 !important;
            }
            #order_review_heading, #order_review, .wc-block-checkout__sidebar {
                @apply w-full lg:w-96 !important;
            }
            #order_review, .wc-block-checkout__sidebar {
                @apply bg-white border border-border rounded-xl p-8 !important;
            }
            #payment div.payment_box {
                @apply bg-white border border-border rounded-lg p-4 text-xs text-muted-foreground mt-4 !important;
            }
            #place_order {
                @apply bg-primary text-primary-foreground hover:bg-accent transition-all duration-300 font-bold uppercase text-sm tracking-widest px-8 py-4 rounded-lg w-full flex items-center justify-center gap-2 !important;
            }

            /* Account Page */
            .woocommerce-account .woocommerce-MyAccount-navigation {
                @apply mb-8 md:mb-0 !important;
            }
            .woocommerce-account .woocommerce-MyAccount-navigation ul {
                @apply space-y-2 !important;
            }
            .woocommerce-account .woocommerce-MyAccount-navigation li a {
                @apply block py-3 px-6 rounded-lg text-muted-foreground hover:bg-secondary hover:text-primary transition-all font-medium !important;
            }
            .woocommerce-account .woocommerce-MyAccount-navigation li.is-active a {
                @apply bg-primary text-primary-foreground !important;
            }
            .woocommerce-account .woocommerce-MyAccount-content {
                @apply bg-white border border-border rounded-xl p-8 !important;
            }
            
            /* Forms */
            .woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea {
                @apply w-full bg-secondary/30 border border-border rounded-lg py-3 px-4 focus:outline-none focus:border-primary/50 transition-all !important;
            }
            .woocommerce form .form-row label {
                @apply text-xs font-bold uppercase tracking-wider text-muted-foreground mb-2 block !important;
            }

            /* Custom Cart Drawer Scrollbar */
            .custom-scrollbar::-webkit-scrollbar {
                width: 4px;
            }
            .custom-scrollbar::-webkit-scrollbar-track {
                @apply bg-transparent;
            }
            .custom-scrollbar::-webkit-scrollbar-thumb {
                @apply bg-border rounded-full;
            }
            
            /* Checkout Field Layout Improvements */
            .woocommerce-billing-fields__field-wrapper p.form-row, .woocommerce-shipping-fields__field-wrapper p.form-row {
                @apply m-0 p-0 mb-6 !important;
            }
            .woocommerce form .form-row-first, .woocommerce form .form-row-last {
                @apply w-full md:w-[calc(50%-1rem)] inline-block !important;
            }
            .woocommerce form .form-row-wide {
                @apply w-full block !important;
            }

            /* Progress Stepper Line */
            .progress-stepper-line {
                background: linear-gradient(to right, #02669e 50%, #e2e8f0 50%);
            }

            /* Remove extra gallery zoom icons */
            .woocommerce-product-gallery__trigger {
                display: none !important;
            }
        }

        @utility animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
        }
        @utility animate-slide-up {
            animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Logo size – same on all pages (shop, cart, single product, etc.) */
        .site-header-logo img {
            height: 5rem !important;
            width: auto !important;
            max-height: none;
        }

        .footer-logo {
            height: 12rem;
            width: auto;
        }

        @media (max-width: 1024px) {
            .site-header-logo img {
                height: 4rem !important;
            }
        }

        @media (max-width: 640px) {
            .site-header-logo img {
                height: 3rem !important;
            }
        }
        /* Sticky Header Admin Bar Offset */
        .admin-bar header.sticky {
            top: 32px;
        }
        @media (max-width: 782px) {
            .admin-bar header.sticky {
                top: 46px;
            }
        }
    </style>
</head>

<body <?php body_class('bg-background text-foreground font-body antialiased'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col">
	<header class="sticky top-0 z-[100] border-b border-border bg-background/90 backdrop-blur-lg">
		<div class="container mx-auto flex items-center justify-between h-16 md:h-24 px-4 overflow-visible">
			<!-- Logo -->
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header-logo flex items-center gap-2 group">
				<?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/main logo  - Edited.png" alt="<?php bloginfo( 'name' ); ?>" class="h-12 md:h-20 w-auto transition-transform group-hover:scale-105 header-logo-img">
                <?php endif; ?>
			</a>

			<!-- Desktop nav -->
			<nav class="hidden md:flex items-center gap-8">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'fallback_cb'    => false,
						'link_before'    => '<span class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">',
						'link_after'     => '</span>',
					)
				);
				?>
                <!-- Fallback menu items if no menu is set -->
                <?php if ( ! has_nav_menu( 'menu-1' ) ) : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">Home</a>
                    <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">Shop</a>
                    <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">About Us</a>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">Contact</a>
                <?php endif; ?>
			</nav>

			<!-- Actions -->
			<div class="flex items-center gap-4 relative z-[120]">
				<div class="relative" id="header-search">
                    <button class="text-muted-foreground hover:text-primary transition-all duration-300 btn-hover-effect p-2 rounded-full relative z-[130]" id="search-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </button>
                    <div class="absolute right-0 md:right-0 top-full mt-0 md:mt-2 w-[calc(100vw-2rem)] sm:w-80 -mr-[calc((100vw-100%)/2)] md:mr-0 bg-card border border-border rounded-xl shadow-2xl overflow-hidden opacity-0 invisible translate-y-2 transition-all duration-300 z-[140]" id="search-dropdown">
                        <div class="p-4 border-b border-border">
                            <input type="text" placeholder="Search research data..." class="w-full bg-secondary/50 border border-border rounded-lg py-2 px-4 text-sm text-foreground focus:outline-none focus:border-primary/50" id="search-input">
                        </div>
                        <div id="search-results" class="max-h-96 overflow-y-auto">
                            <div class="p-6 text-center text-muted-foreground text-xs">Start typing to search...</div>
                        </div>
                    </div>
                </div>
				<button class="relative text-muted-foreground hover:text-primary transition-all duration-300 btn-hover-effect p-2 rounded-full relative z-[130]" id="cart-toggle">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
					<span class="cart-count-badge absolute top-0 right-0 bg-primary text-primary-foreground text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center <?php echo ( class_exists( 'WooCommerce' ) && WC()->cart->get_cart_contents_count() > 0 ) ? '' : 'hidden'; ?>">
						<?php echo class_exists( 'WooCommerce' ) ? WC()->cart->get_cart_contents_count() : '0'; ?>
					</span>
				</button>
				<a href="<?php echo function_exists( 'wc_get_page_id' ) ? esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) : '#'; ?>" class="text-muted-foreground hover:text-primary transition-all duration-300 btn-hover-effect p-2 rounded-full relative z-[130] flex items-center gap-2">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <?php if ( ! is_user_logged_in() ) : ?>
                        <span class="hidden lg:inline text-xs font-bold uppercase tracking-widest">Login / Register</span>
                    <?php endif; ?>
				</a>
				<button class="md:hidden text-muted-foreground relative z-[130]" id="mobile-menu-toggle">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
				</button>
			</div>
		</div>

		<!-- Mobile Menu -->
		<div class="hidden md:hidden border-t border-border bg-background animate-fade-in relative z-[9999]" id="mobile-menu">
			<nav class="flex flex-col p-4 gap-4">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'fallback_cb'    => false,
					)
				);
				?>
                <?php if ( ! has_nav_menu( 'menu-1' ) ) : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">Home</a>
                    <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">Shop</a>
                    <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">About Us</a>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">Contact</a>
                <?php endif; ?>
				<a href="<?php echo function_exists( 'wc_get_page_id' ) ? esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) : '#'; ?>" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">
					<?php echo is_user_logged_in() ? 'My Account' : 'Sign In'; ?>
				</a>
			</nav>
		</div>
	</header>

	<main id="primary" class="site-main flex-1 animate-fade-in">
