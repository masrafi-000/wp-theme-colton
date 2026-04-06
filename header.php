<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
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
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/main logo  - Edited.png" alt="<?php bloginfo( 'name' ); ?>" class="h-12 md:h-20 w-auto transition-transform group-hover:scale-105 header-logo-img">
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
		<div class="hidden lg:hidden border-t border-border bg-background animate-fade-in relative z-[9999]" id="mobile-menu">
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
