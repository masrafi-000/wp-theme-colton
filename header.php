<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-background text-foreground font-body antialiased overflow-x-hidden'); ?>>
<?php wp_body_open(); ?>

<!-- Overlay backdrop (cart + mobile menu) -->
<div id="site-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[150] hidden opacity-0 transition-opacity duration-300"></div>

<!-- ===== MOBILE MENU SIDEBAR ===== -->
<div id="mobile-menu" class="fixed top-0 left-0 h-full w-full sm:w-[320px] bg-background z-[160] -translate-x-full transition-transform duration-300 ease-in-out flex flex-col shadow-2xl border-r border-border lg:hidden">
    <!-- Header -->
    <div class="flex items-center justify-between px-6 py-5 border-b border-border shrink-0">
        <h2 class="text-base font-semibold tracking-wide uppercase">Menu</h2>
        <button id="mobile-menu-sidebar-close" class="text-muted-foreground hover:text-primary transition-colors p-1 rounded-full hover:bg-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>
    <!-- Menu content -->
    <nav class="flex-1 overflow-y-auto px-4 py-6">
        <div class="flex flex-col gap-2">
            <?php
            wp_nav_menu([
                'theme_location' => 'menu-1',
                'container'      => false,
                'items_wrap'     => '%3$s',
                'fallback_cb'    => false,
            ]);
            ?>
            <?php if ( ! has_nav_menu( 'menu-1' ) ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary hover:bg-secondary transition-colors tracking-wide uppercase px-3 py-2.5 rounded-lg">Home</a>
                <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary hover:bg-secondary transition-colors tracking-wide uppercase px-3 py-2.5 rounded-lg">Shop</a>
                <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary hover:bg-secondary transition-colors tracking-wide uppercase px-3 py-2.5 rounded-lg">About Us</a>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary hover:bg-secondary transition-colors tracking-wide uppercase px-3 py-2.5 rounded-lg">Contact</a>
            <?php endif; ?>
            <a href="<?php echo function_exists('wc_get_page_id') ? esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) : '#'; ?>" class="text-sm font-medium text-muted-foreground hover:text-primary hover:bg-secondary transition-colors tracking-wide uppercase px-3 py-2.5 rounded-lg border-t border-border mt-2 pt-4">
                <?php echo is_user_logged_in() ? 'My Account' : 'Sign In'; ?>
            </a>
        </div>
    </nav>
</div>

<!-- ===== CART SIDEBAR ===== -->
<div id="cart-sidebar" class="fixed top-0 right-0 h-full w-full sm:w-[420px] bg-background z-[160] translate-x-full transition-transform duration-300 ease-in-out flex flex-col shadow-2xl border-l border-border">
    <!-- Header -->
    <div class="flex items-center justify-between px-6 py-5 border-b border-border shrink-0">
        <h2 class="text-base font-semibold tracking-wide uppercase">Your Cart</h2>
        <button id="cart-sidebar-close" class="text-muted-foreground hover:text-primary transition-colors p-1 rounded-full hover:bg-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>

    <!-- Cart body (WooCommerce fragment injected here) -->
    <div id="cart-sidebar-body" class="flex-1 overflow-y-auto px-6 py-4">
        <?php if ( class_exists( 'WooCommerce' ) ) : ?>
            <?php woocommerce_mini_cart(); ?>
        <?php else : ?>
            <p class="text-sm text-muted-foreground text-center mt-12">Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <!-- Footer actions -->
    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
    <div class="px-6 py-5 border-t border-border shrink-0 space-y-3">
        <div class="flex justify-between text-sm font-medium mb-1">
            <span class="text-muted-foreground uppercase tracking-wide text-xs">Subtotal</span>
            <span><?php wc_cart_totals_subtotal_html(); ?></span>
        </div>
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="block w-full text-center py-3 px-4 border border-border rounded-xl text-sm font-medium hover:bg-secondary transition-colors">View Cart</a>
        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="block w-full text-center py-3 px-4 bg-primary text-primary-foreground rounded-xl text-sm font-medium hover:bg-primary/90 transition-colors">Checkout</a>
    </div>
    <?php endif; ?>
</div>

<!-- ===== HEADER ===== -->
<div id="page" class="site min-h-screen flex flex-col">
    <header class="sticky top-0 z-[100] border-b border-border bg-background/90 backdrop-blur-lg">
        <div class="container mx-auto flex items-center justify-between h-16 md:h-24 px-4">

            <!-- Logo -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header-logo flex items-center gap-2 group shrink-0">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/main logo  - Edited.png" alt="<?php bloginfo( 'name' ); ?>" class="h-12 md:h-20 w-auto transition-transform group-hover:scale-105 header-logo-img">
                <?php endif; ?>
            </a>

            <!-- Desktop nav -->
            <nav class="hidden lg:flex items-center gap-8">
                <?php
                wp_nav_menu([
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'fallback_cb'    => false,
                    'link_before'    => '<span class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">',
                    'link_after'     => '</span>',
                ]);
                ?>
                <?php if ( ! has_nav_menu( 'menu-1' ) ) : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">Home</a>
                    <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">Shop</a>
                    <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">About Us</a>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors tracking-wide uppercase">Contact</a>
                <?php endif; ?>
            </nav>

            <!-- Actions -->
            <div class="flex items-center gap-1 sm:gap-2">

                <!-- Search -->
                <div class="relative" id="header-search">
                    <button class="text-muted-foreground hover:text-primary transition-all duration-200 p-2 rounded-full hover:bg-secondary" id="search-toggle" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </button>
                    <div id="search-dropdown" class="absolute right-0 top-full mt-2 w-[calc(100vw-2rem)] sm:w-80 bg-card border border-border rounded-xl shadow-2xl overflow-hidden opacity-0 invisible translate-y-2 transition-all duration-300 z-[140]">
                        <div class="p-4 border-b border-border">
                            <input type="text" placeholder="Search products..." class="w-full bg-secondary/50 border border-border rounded-lg py-2 px-4 text-sm focus:outline-none focus:border-primary/50" id="search-input" autocomplete="off">
                        </div>
                        <div id="search-results" class="max-h-80 overflow-y-auto">
                            <div class="p-6 text-center text-muted-foreground text-xs">Start typing to search…</div>
                        </div>
                    </div>
                </div>

                <!-- Cart -->
                <button class="relative text-muted-foreground hover:text-primary transition-all duration-200 p-2 rounded-full hover:bg-secondary" id="cart-toggle" aria-label="Open cart">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    <span id="cart-count-badge" class="absolute top-0 right-0 bg-primary text-primary-foreground text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center <?php echo ( class_exists('WooCommerce') && WC()->cart->get_cart_contents_count() > 0 ) ? '' : 'hidden'; ?>">
                        <?php echo class_exists('WooCommerce') ? WC()->cart->get_cart_contents_count() : '0'; ?>
                    </span>
                </button>

                <!-- Account -->
                <a href="<?php echo function_exists('wc_get_page_id') ? esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) : '#'; ?>" class="text-muted-foreground hover:text-primary transition-all duration-200 p-2 rounded-full hover:bg-secondary flex items-center gap-2" aria-label="Account">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <?php if ( ! is_user_logged_in() ) : ?>
                        <span class="hidden lg:inline text-xs font-bold uppercase tracking-widest">Login / Register</span>
                    <?php endif; ?>
                </a>

                <!-- Hamburger -->
                <button class="lg:hidden text-muted-foreground hover:text-primary transition-colors p-2 rounded-full hover:bg-secondary" id="mobile-menu-toggle" aria-label="Toggle menu" aria-expanded="false">
                    <svg id="hamburger-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                    <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
        </div>

    </header>

    <main id="primary" class="site-main flex-1">