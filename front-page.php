<?php
/**
 * The front page template file
 *
 * @package Colton_Research
 */

get_header();
?>



<!-- Hero -->
<section class="relative lg:h-[calc(100vh-97px)] max-lg:h-[calc(100dvh-65px)] flex items-center overflow-hidden bg-[radial-gradient(circle_at_0%_0%,#0ea5e9_0%,#0b1120_55%,#020617_100%)] text-white w-full max-w-full m-0 p-0 [.admin-bar_&]:lg:h-[calc(100vh-97px-32px)] [.admin-bar_&]:max-[782px]:h-[calc(100dvh-65px-46px)]">
    <!-- Age Verification Modal -->
    <div id="age-verification-modal" class="fixed inset-0 z-[1100] hidden items-center justify-center p-4 bg-background/95 backdrop-blur-lg animate-fade-in">
        <div class="relative bg-white w-full max-w-lg rounded-[40px] p-12 text-center shadow-2xl border border-border overflow-hidden">
            <div class="relative space-y-10">
                <div class="flex justify-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/main logo  - Edited.png" alt="Logo" class="h-16 w-auto">
                </div>

                <div class="space-y-4">
                    <h2 class="text-3xl font-display font-extrabold text-foreground uppercase tracking-tight">
                        Age Verification
                    </h2>
                    <p class="text-muted-foreground text-lg">
                        You must be at least 21 years of age to enter this research facility.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <button onclick="verifyAge(true)" class="group relative bg-primary hover:bg-brand-blue-dark transition-all duration-500 rounded-2xl py-5 px-8 border border-primary overflow-hidden shadow-xl shadow-primary/20">
                        <span class="relative z-10 block font-display font-bold text-xl text-white">I AM 21+</span>
                    </button>
                    
                    <button onclick="verifyAge(false)" class="group relative bg-secondary hover:bg-secondary-foreground/10 transition-all duration-500 rounded-2xl py-5 px-8 border border-border overflow-hidden">
                        <span class="relative z-10 block font-display font-bold text-xl text-foreground">EXIT</span>
                    </button>
                </div>
                
                <p class="text-[10px] uppercase tracking-widest text-muted-foreground/60 italic">
                    [All research must be conducted by qualified individuals. By entering, you agree to our Terms of Service.]
                </p>
            </div>
        </div>
    </div>

    <!-- First Visit Popup -->
    <div id="first-visit-popup" class="fixed inset-0 z-[1000] hidden items-center justify-center p-4 bg-background/80 backdrop-blur-md animate-fade-in">
        <div class="relative bg-primary w-full max-w-lg rounded-[40px] p-12 text-center text-white shadow-2xl overflow-hidden group">
            <!-- Close Button -->
            <button id="close-popup" class="absolute top-6 right-6 text-white/60 hover:text-white transition-colors z-10">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>

            <!-- Decorative Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent pointer-events-none"></div>
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative space-y-8">
                <div class="flex justify-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/main logo  - Edited.png" alt="Logo" class="h-16 w-auto">
                </div>

                <div class="space-y-4">
                    <h2 class="text-4xl font-display font-extrabold leading-tight uppercase tracking-tight">
                        Get 5% Off Your<br />First Order!
                    </h2>
                    <p class="text-white/80 text-lg">
                        Join the Halo Peptideco community to receive <span class="text-white font-bold">5% off</span> your first order.
                    </p>
                </div>

                <!-- NOTE:  -->
                <form id="popup-newsletter-form" class="space-y-4">
                    <input 
                        type="email" 
                        placeholder="Enter Email Address Here" 
                        class="w-full bg-white/10 border border-white/20 rounded-2xl py-5 px-6 text-white placeholder:text-white/50 focus:outline-none focus:bg-white/20 focus:border-white/40 transition-all text-center"
                        required
                    />
                    <button type="submit" class="w-full bg-white text-primary font-bold py-5 rounded-2xl uppercase tracking-widest hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl">
                        Sign Up & Get 5% Off
                    </button>
                </form>

                <p class="text-[10px] uppercase tracking-widest text-white/40 italic">
                    [Can't combine with other discounts or subscriptions]
                </p>
            </div>
        </div>
    </div>

    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/BPC-157.png" alt="BPC-157 research peptide vial" class="absolute top-0 right-0 lg:w-[45%] max-lg:w-full lg:h-full max-lg:h-[40%] object-contain z-0 lg:opacity-100 max-lg:opacity-30 lg:translate-x-[5%] max-lg:translate-x-0 [filter:drop-shadow(0_0_100px_rgba(2,102_158,0.3))] pointer-events-none" />
    <div class="absolute inset-0 lg:bg-[radial-gradient(circle_at_30%_50%,rgba(15,23,42,0.3)_0%,rgba(15,23,42,0.8)_50%,rgba(15,23,42,1)_100%)] max-lg:bg-[radial-gradient(circle_at_50%_40%,rgba(15,23,42,0.6)_0%,rgba(15,23,42,1)_100%)] z-10"></div>
    <div class="relative z-10 w-full max-w-[1400px] mx-auto lg:px-[6%] px-6 sm:px-10 flex items-center min-h-0 lg:flex-row flex-col justify-center lg:h-auto h-full py-12 lg:py-0">
        <div class="lg:absolute lg:top-[30%] lg:left-[60%] lg:-translate-x-1/2 lg:-translate-y-1/2 relative z-20 max-w-[480px] w-full text-white text-center animate-fade-in mt-8 lg:mt-0 order-2 lg:order-none">
            <div class="flex gap-2.5 mb-5 max-sm:mb-4 bg-white/10 w-fit px-4 py-2 rounded-[20px] backdrop-blur-[4px] border border-white/10 mx-auto">
                <div class="w-2.5 h-2.5 rounded-full bg-white cursor-pointer transition-all duration-300 scale-[1.3] active review-dot" data-index="0"></div>
                <div class="w-2.5 h-2.5 rounded-full bg-white/30 cursor-pointer transition-all duration-300 review-dot" data-index="1"></div>
                <div class="w-2.5 h-2.5 rounded-full bg-white/30 cursor-pointer transition-all duration-300 review-dot" data-index="2"></div>
            </div>
            <div class="flex gap-1.5 text-[#facc15] mb-4 max-sm:mb-3 justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
            </div>
            <div class="relative h-[120px] sm:h-[140px] max-w-[320px] sm:max-w-full mx-auto overflow-hidden">
                <div class="absolute top-0 left-0 w-full opacity-100 visible translate-y-0 active review-item">
                    <p class="text-[clamp(13px,1.5vw,20px)] sm:text-[18px] leading-relaxed text-white font-medium [text-shadow:0_2px_10px_rgba(0,0,0,0.3)] line-clamp-4 max-sm:line-clamp-3">"I absolutely love this company. Real legitimate products, easy to access calculator guides, and fast shipping..."</p>
                </div>
                <div class="absolute top-0 left-0 w-full opacity-0 invisible transition-all duration-500 translate-y-4 review-item">
                    <p class="text-[clamp(13px,1.5vw,20px)] sm:text-[18px] leading-relaxed text-white font-medium [text-shadow:0_2px_10px_rgba(0,0,0,0.3)] line-clamp-4 max-sm:line-clamp-3">"The purity levels are unmatched. Every batch I've tested has exceeded my expectations for research consistency."</p>
                </div>
                <div class="absolute top-0 left-0 w-full opacity-0 invisible transition-all duration-500 translate-y-4 review-item">
                    <p class="text-[clamp(13px,1.5vw,20px)] sm:text-[18px] leading-relaxed text-white font-medium [text-shadow:0_2px_10px_rgba(0,0,0,0.3)] line-clamp-4 max-sm:line-clamp-3">"Excellent customer support and detailed CoA documentation. Makes my laboratory workflow much smoother."</p>
                </div>
            </div>
        </div>

        <div class="text-left lg:text-left text-center text-white max-w-[700px] lg:max-w-[800px] z-11 shrink-1 max-lg:mx-auto animate-slide-up order-1 lg:order-none">
            <p class="text-[#38bdf8] text-[clamp(12px,1.2vw,16px)] font-extrabold uppercase tracking-[4px] sm:tracking-[6px] mb-4 sm:mb-6 flex items-center gap-3 justify-center lg:justify-start"><?php echo esc_html( get_theme_mod( 'hero_subtitle', 'Premium Quality' ) ); ?></p>
            <?php 
            $hero_title = get_theme_mod( 'hero_title', 'Research Peptides' );
            $title_parts = explode( ' ', $hero_title );
            $last_word = array_pop( $title_parts );
            $main_title = implode( ' ', $title_parts );
            ?>
            <h1 class="text-[clamp(36px,6vw,96px)] font-extrabold leading-[1.05] sm:leading-[0.95] mb-6 sm:mb-10 text-white [text-shadow:0_4px_24px_rgba(0,0,0,0.5)] tracking-[-0.04em]">
                <?php echo esc_html( $main_title ); ?><br />
                <span class="text-[#38bdf8] relative inline-block mt-2 sm:mt-4"><?php echo esc_html( $last_word ); ?></span>
            </h1>
            <p class="text-[#e0f2fe] text-[clamp(14px,1.5vw,22px)] sm:text-[20px] leading-relaxed mb-10 sm:mb-12 max-w-[600px] mx-auto lg:mx-0 font-normal [text-shadow:0_2px_8px_rgba(0,0,0,0.4)] opacity-90">
                Research-only peptides with ≥99% purity, HPLC tested and batch-verified so your data is clean, repeatable, and publication-ready.
            </p>
            <div class="flex gap-4 sm:gap-6 justify-center lg:justify-start">
                <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="px-8 sm:px-12 py-3.5 sm:py-5 rounded-full font-extrabold uppercase transition-all duration-300 inline-flex items-center gap-4 text-[13px] sm:text-[15px] tracking-widest bg-primary text-white shadow-xl hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-primary/30 w-full sm:w-auto justify-center">
                    Shop Now
                    <span class="bg-white text-primary w-8 h-8 rounded-full flex items-center justify-center transition-transform duration-300 group-hover:rotate-45">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
v>
</section>

<!-- Trust Features Section -->
<section class="py-12 sm:py-20 bg-white border-b border-[#f1f5f9] mt-0 reveal-on-scroll">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-10 max-w-[1400px] mx-auto px-6 sm:px-[6%]">
        <div class="trust-item group transition-all duration-300 flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4">
            <div class="trust-icon-box bg-secondary p-4 sm:p-5 rounded-2xl group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 sm:w-6 sm:h-6"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
            </div>
            <div class="trust-content">
                <h4 class="text-sm sm:text-base font-bold transition-colors duration-300 group-hover:text-primary">Free Delivery</h4>
                <p class="text-[10px] sm:text-xs text-muted-foreground uppercase tracking-widest mt-1">Orders over $200</p>
            </div>
        </div>

        <div class="trust-item group transition-all duration-300 flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4">
            <div class="trust-icon-box bg-secondary p-4 sm:p-5 rounded-2xl group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 sm:w-6 sm:h-6"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
            </div>
            <div class="trust-content">
                <h4 class="text-sm sm:text-base font-bold transition-colors duration-300 group-hover:text-primary">≥99% Purity</h4>
                <p class="text-[10px] sm:text-xs text-muted-foreground uppercase tracking-widest mt-1">HPLC verified</p>
            </div>
        </div>

        <div class="trust-item group transition-all duration-300 flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4">
            <div class="trust-icon-box bg-secondary p-4 sm:p-5 rounded-2xl group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 sm:w-6 sm:h-6"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            </div>
            <div class="trust-content">
                <h4 class="text-sm sm:text-base font-bold transition-colors duration-300 group-hover:text-primary">Secure Pay</h4>
                <p class="text-[10px] sm:text-xs text-muted-foreground uppercase tracking-widest mt-1">SSL Encrypted</p>
            </div>
        </div>

        <div class="trust-item group transition-all duration-300 flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4">
            <div class="trust-icon-box bg-secondary p-4 sm:p-5 rounded-2xl group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 sm:w-6 sm:h-6"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </div>
            <div class="trust-content">
                <h4 class="text-sm sm:text-base font-bold transition-colors duration-300 group-hover:text-primary">Expert Help</h4>
                <p class="text-[10px] sm:text-xs text-muted-foreground uppercase tracking-widest mt-1">Fast Response</p>
            </div>
        </div>
    </div>
</section>

<!-- Next-Generation Section -->
<section class="py-24 bg-white overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8 text-left">
                <div class="space-y-4">
                    <span class="text-sm font-bold text-[#02669e] uppercase tracking-[2px] mb-4 block">Premium Quality</span>
                    <h2 class="text-[clamp(28px,4vw,48px)] font-extrabold leading-[1.1] text-[#0f172a] mb-6">Next-Generation Research Peptides</h2>
                    <p class="text-lg text-muted-foreground leading-relaxed max-w-lg">
                        Experience a breakthrough in research with our advanced peptide formulations. Crafted for scientists who demand the extraordinary.
                    </p>
                </div>
                <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="bg-[#02669e] text-white rounded-[50px] px-8 py-3 font-bold inline-flex items-center gap-3 transition-all duration-300 uppercase text-sm hover:bg-[#014d7a] hover:-translate-y-0.5">
                    Shop Now
                    <span class="bg-white text-[#02669e] w-7 h-7 rounded-full flex items-center justify-center text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                    </span>
                </a>
            </div>
            <div class="relative">
                <div class="rounded-[40px] overflow-hidden">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/BPC-157.png" alt="Research Peptides" class="w-full h-auto max-w-md mx-auto drop-shadow-2xl" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Research Categories -->
<section class="container mx-auto py-16 sm:py-24 px-6 reveal-on-scroll">
    <div class="text-center mb-10 sm:mb-16">
        <p class="text-primary text-[10px] sm:text-xs tracking-[0.3em] uppercase font-bold mb-3 sm:mb-4">Browse By Purpose</p>
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-foreground">Research Categories</h2>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-6">
        <?php
        $categories = get_terms( array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
        ) );

        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
            foreach ( $categories as $category ) {
                echo '<a href="' . esc_url( get_term_link( $category ) ) . '" class="group p-5 sm:p-8 rounded-[24px] bg-white border border-border hover:border-primary/40 transition-all duration-500 text-center shadow-sm hover:shadow-xl hover:shadow-primary/5">';
                echo '<div class="w-12 h-12 sm:w-16 sm:h-16 bg-secondary/50 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-500 text-primary">';
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 sm:h-8 sm:w-8"><path d="M4.5 3h15"/><path d="M6 3v16a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V3"/><path d="M6 14h12"/></svg>';
                echo '</div>';
                echo '<h3 class="font-display font-bold text-xs sm:text-sm text-foreground uppercase tracking-widest leading-snug group-hover:text-primary transition-colors">' . esc_html( $category->name ) . '</h3>';
                echo '</a>';
            }
        }
        ?>
    </div>
</section>

<!-- Featured Products -->
<section class="bg-[#f8fafc] border-y border-border reveal-on-scroll">
    <div class="container mx-auto py-16 sm:py-24 px-6 sm:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 sm:mb-16 gap-6">
            <div class="text-left">
                <p class="text-primary text-[10px] sm:text-xs tracking-[0.3em] uppercase font-bold mb-3 sm:mb-4">Top Sellers</p>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-foreground">Featured Products</h2>
            </div>
            <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="flex items-center gap-2 text-xs sm:text-sm text-primary hover:text-brand-blue-dark font-bold uppercase tracking-widest transition-colors group">
                View All <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 transition-transform group-hover:translate-x-1"><path d="m9 18 6-6-6-6"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-8">
            <?php
            if ( class_exists( 'WooCommerce' ) ) {
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                );
                $featured_query = new WP_Query( $args );

                if ( $featured_query->have_posts() ) {
                    while ( $featured_query->have_posts() ) {
                        $featured_query->the_post();
                        wc_get_template_part( 'content', 'product' );
                    }
                    wp_reset_postdata();
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Transparency Section -->
<section class="py-20 sm:py-32 bg-[#fafafa]">
    <div class="container mx-auto px-6 sm:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 sm:gap-20 mb-16 items-center">
            <div class="text-center lg:text-left">
                <span class="text-[11px] sm:text-xs font-bold text-primary uppercase tracking-[0.3em] mb-4 sm:mb-6 block">Certificates of Analysis</span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-display font-bold leading-tight text-foreground mb-6 sm:mb-8">Transparency You Can Trust</h2>
                <p class="text-sm sm:text-base md:text-lg text-muted-foreground leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    All products are supported by third-party laboratory testing and documented Certificates of Analysis. These reports confirm compound identity and purity, giving you direct access to the same data we use for internal quality verification.
                </p>
            </div>
            <div class="flex justify-center lg:justify-end">
                <div class="relative w-full max-w-sm sm:max-w-md">
                    <div class="absolute inset-0 bg-primary/10 rounded-[40px] rotate-3 -z-10"></div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/BPC-157.png" alt="Peptide Vial with COA" class="rounded-[40px] shadow-2xl w-full" />
                </div>
            </div>
        </div>

        <div class="flex flex-wrap justify-center sm:justify-start gap-3 sm:gap-4 mb-10 sm:mb-16" id="coa-tabs">
            <button class="coa-tab-btn active px-6 sm:px-10 py-3 sm:py-4 rounded-full bg-primary text-white font-bold text-[10px] sm:text-xs uppercase tracking-[0.1em] transition-all duration-300 shadow-lg shadow-primary/20" data-product="semaglutide">Semaglutide</button>
            <button class="coa-tab-btn px-6 sm:px-10 py-3 sm:py-4 rounded-full border border-border bg-white text-muted-foreground font-bold text-[10px] sm:text-xs uppercase tracking-[0.1em] transition-all duration-300 hover:border-primary/50 hover:text-primary shadow-sm" data-product="bpc157">BPC-157</button>
            <button class="coa-tab-btn px-6 sm:px-10 py-3 sm:py-4 rounded-full border border-border bg-white text-muted-foreground font-bold text-[10px] sm:text-xs uppercase tracking-[0.1em] transition-all duration-300 hover:border-primary/50 hover:text-primary shadow-sm" data-product="ipamorelin">Ipamorelin</button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-10 mb-12 sm:mb-20" id="coa-grid">
            <?php 
            $batches = array(
                array("name" => "Semaglutide 5mg", "batch" => "11102025SM", "purity" => "99.174%", "date" => "22 JAN 2026"),
                array("name" => "Semaglutide 10mg", "batch" => "1052026SM", "purity" => "99.524%", "date" => "16 FEB 2026"),
                array("name" => "Semaglutide 15mg", "batch" => "11092025SM", "purity" => "99.791%", "date" => "22 JAN 2026")
            );
            foreach ($batches as $b) :
            ?>
            <div class="bg-white rounded-[32px] border border-border p-8 sm:p-10 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-500 text-left">
                <div class="bg-primary/10 text-primary px-5 py-2.5 rounded-full mb-8 font-bold text-[10px] sm:text-xs uppercase tracking-widest inline-block"><?php echo $b['name']; ?></div>
                <div class="text-[13px] sm:text-sm text-muted-foreground leading-[2.2] space-y-1">
                    <p><strong class="text-foreground uppercase tracking-widest text-[11px] mr-2">Batch:</strong> <?php echo $b['batch']; ?></p>
                    <p><strong class="text-foreground uppercase tracking-widest text-[11px] mr-2">Purity:</strong> <span class="text-primary font-bold"><?php echo $b['purity']; ?></span></p>
                    <p><strong class="text-foreground uppercase tracking-widest text-[11px] mr-2">Date:</strong> <?php echo $b['date']; ?></p>
                    <p><strong class="text-foreground uppercase tracking-widest text-[11px] mr-2">Lab:</strong> Janoshik</p>
                    <p><strong class="text-foreground uppercase tracking-widest text-[11px] mr-2">Key:</strong> <?php echo substr(md5($b['name']), 0, 8); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center">
            <a href="#" class="bg-primary text-white rounded-full px-10 sm:px-14 py-4 sm:py-6 font-bold inline-flex items-center gap-3 transition-all duration-300 uppercase text-xs sm:text-sm tracking-[0.2em] shadow-xl shadow-primary/20 hover:bg-brand-blue-dark hover:-translate-y-1">
                Full Test Reports
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
            </a>
        </div>
    </div>
</section>

<!-- Simple Powerful Effective Section -->
<section class="bg-[#020617] text-white overflow-hidden">
    <div class="grid grid-cols-1 lg:grid-cols-2 items-center">
        <div class="relative h-[400px] sm:h-[500px] lg:h-[800px] flex items-center justify-center bg-radial-gradient">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/BPC-157.png" alt="Research Peptides" class="w-full h-auto max-w-[280px] sm:max-w-xs md:max-w-md lg:max-w-lg drop-shadow-[0_0_50px_rgba(2,102,158,0.5)] transition-transform duration-700 hover:scale-110" />
        </div>
        <div class="p-8 sm:p-16 lg:p-24 space-y-8 sm:space-y-12 text-center lg:text-left bg-[#020617]/50 lg:bg-transparent backdrop-blur-sm lg:backdrop-blur-none">
            <h2 class="text-4xl sm:text-6xl lg:text-8xl font-display font-extrabold leading-[1.1]">Simple.<br class="hidden sm:block" />Powerful.<br class="hidden sm:block" />Effective.</h2>
            <p class="text-base sm:text-xl text-white/50 max-w-md mx-auto lg:mx-0">Discover an intuitive way to elevate your research with Halo Peptideco.</p>
            <div class="flex justify-center lg:justify-start">
                <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="px-8 sm:px-12 py-3.5 sm:py-5 rounded-full font-extrabold uppercase transition-all duration-300 inline-flex items-center gap-4 text-[13px] sm:text-[15px] tracking-widest bg-primary text-white shadow-xl hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-primary/30 w-full sm:w-auto justify-center">
                    Explore Store
                    <span class="bg-white text-primary w-8 h-8 rounded-full flex items-center justify-center transition-transform duration-300 group-hover:rotate-45">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 sm:py-32 bg-white border-t border-border reveal-on-scroll">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="text-center mb-12 sm:mb-20 space-y-4">
            <span class="text-primary text-[10px] sm:text-xs font-bold uppercase tracking-[0.3em]">Support Center</span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-foreground">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-3 sm:space-y-4">
            <?php
            $faqs = array(
                array(
                    "q" => "What are research peptides?",
                    "a" => "Research peptides are synthetic amino acid chains used in scientific research and laboratory settings. They are designed for in vitro research purposes and are not intended for human consumption."
                ),
                array(
                    "q" => "What purity levels do your peptides have?",
                    "a" => "All of our peptides have a minimum purity of 98%, verified through HPLC analysis. Many products exceed 99% purity. Each order includes a Certificate of Analysis (CoA)."
                ),
                array(
                    "q" => "How are your peptides tested?",
                    "a" => "Every batch undergoes HPLC (High-Performance Chromatography) analysis, mass spectrometry verification, and endotoxin testing. We provide third-party validated Certificates of Analysis with every order."
                ),
                array(
                    "q" => "What payment methods do you accept?",
                    "a" => "We accept Visa, Mastercard, American Express, and debit cards through our secure payment gateway. All transactions are encrypted with 256-bit SSL."
                ),
                array(
                    "q" => "How long does shipping take?",
                    "a" => "Domestic orders typically ship within 1-2 business days and arrive within 3-5 business days. International shipping is available and typically takes 7-14 business days."
                ),
                array(
                    "q" => "Is there free shipping?",
                    "a" => "Yes! Orders over $200 qualify for free domestic shipping within the United States."
                ),
                array(
                    "q" => "What is your return policy?",
                    "a" => "Due to the nature of research chemicals, we accept returns only for damaged or incorrect items. Please contact us within 48 hours of receiving your order if there are any issues."
                ),
                array(
                    "q" => "How should peptides be stored?",
                    "a" => "Lyophilized peptides should be stored at -20°C for long-term storage. Reconstituted peptides should be kept at 2-8°C and used within the timeframe specified in the product documentation."
                )
            );

            foreach ($faqs as $i => $faq) :
            ?>
                <div class="border border-border rounded-2xl overflow-hidden faq-item transition-all duration-300 hover:border-primary/30 group">
                    <button class="w-full flex items-center justify-between p-5 sm:p-8 text-left hover:bg-secondary/20 transition-all duration-300 faq-toggle">
                        <span class="font-display font-bold text-foreground text-sm sm:text-base pr-6 leading-tight group-hover:text-primary transition-colors"><?php echo $faq['q']; ?></span>
                        <div class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-secondary flex items-center justify-center shrink-0 transition-all duration-300 faq-icon-wrapper group-hover:bg-primary group-hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 sm:h-5 sm:w-5 transition-transform faq-icon"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </button>
                    <div class="px-5 sm:px-8 pb-6 sm:pb-8 hidden faq-content animate-fade-in">
                        <p class="text-[13px] sm:text-base text-muted-foreground leading-relaxed"><?php echo $faq['a']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Peptide Resources Section -->
<section class="py-20 sm:py-32 bg-[#f8fafc] border-t border-border reveal-on-scroll">
    <div class="container mx-auto px-6 sm:px-8 text-center">
        <div class="mb-12 sm:mb-20 space-y-4">
            <p class="text-primary text-[10px] sm:text-xs tracking-[0.3em] uppercase font-bold mb-4">Laboratory Insights</p>
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-display font-bold text-foreground leading-tight">Peptide Resources</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-10">
            <!-- Resource 1: 7 Steps -->
            <article class="group bg-white rounded-[40px] overflow-hidden border border-border transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2 cursor-pointer text-left" onclick="openResourceModal('reconstitution-guide')">
                <div class="aspect-[4/3] sm:aspect-square bg-secondary/30 flex items-center justify-center p-12 transition-colors duration-500 group-hover:bg-primary/5">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/BPC-157.png" alt="Reconstitution Guide" class="w-full h-full object-contain drop-shadow-2xl transition-transform duration-700 group-hover:scale-110" />
                </div>
                <div class="p-8 sm:p-10 space-y-4 sm:space-y-6">
                    <span class="text-[10px] font-bold text-muted-foreground uppercase tracking-[0.2em] block">Jan 13, 2026 — Protocol</span>
                    <h3 class="text-xl sm:text-2xl font-display font-bold text-foreground group-hover:text-primary transition-colors leading-tight">7 Steps to Reconstitute Peptides</h3>
                    <p class="text-[13px] sm:text-sm text-muted-foreground leading-relaxed line-clamp-3">
                        A guide on peptides, their benefits, and step-by-step directions for reconstituting lyophilized (freeze-dried) peptides and instructions...
                    </p>
                </div>
            </article>

            <!-- Resource 2: Calculator -->
            <article class="group bg-white rounded-[40px] overflow-hidden border border-border transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2 cursor-pointer text-left" onclick="openResourceModal('peptide-calculator')">
                <div class="aspect-[4/3] sm:aspect-square bg-secondary/30 flex items-center justify-center p-12 transition-colors duration-500 group-hover:bg-primary/5">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/BPC-157.png" alt="Peptide Calculator" class="w-full h-full object-contain drop-shadow-2xl transition-transform duration-700 group-hover:scale-110" />
                </div>
                <div class="p-8 sm:p-10 space-y-4 sm:space-y-6">
                    <span class="text-[10px] font-bold text-muted-foreground uppercase tracking-[0.2em] block">Jan 15, 2026 — Tool</span>
                    <h3 class="text-xl sm:text-2xl font-display font-bold text-foreground group-hover:text-primary transition-colors leading-tight">Peptide Reconstitution Calculator</h3>
                    <p class="text-[13px] sm:text-sm text-muted-foreground leading-relaxed line-clamp-3">
                        Use our Peptide Reconstitution Calculator below. Simply select your parameters to accurately calculate dosages...
                    </p>
                </div>
            </article>

            <!-- Resource 3: BAC Water -->
            <article class="group bg-white rounded-[40px] overflow-hidden border border-border transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2 cursor-pointer text-left sm:col-span-2 lg:col-span-1" onclick="openResourceModal('bac-water-guide')">
                <div class="aspect-[4/3] sm:aspect-video lg:aspect-square bg-secondary/30 flex items-center justify-center p-12 transition-colors duration-500 group-hover:bg-primary/5">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/BPC-157.png" alt="BAC Water Guide" class="w-full h-full object-contain drop-shadow-2xl transition-transform duration-700 group-hover:scale-110" />
                </div>
                <div class="p-8 sm:p-10 space-y-4 sm:space-y-6">
                    <span class="text-[10px] font-bold text-muted-foreground uppercase tracking-[0.2em] block">Jan 02, 2026 — Guide</span>
                    <h3 class="text-xl sm:text-2xl font-display font-bold text-foreground group-hover:text-primary transition-colors leading-tight">Bacteriostatic Water Guide</h3>
                    <p class="text-[13px] sm:text-sm text-muted-foreground leading-relaxed line-clamp-3">
                        As peptides continue to grow in popularity each year, one of the most common questions people ask is: How much bacteriostatic...
                    </p>
                </div>
            </article>
        </div>
    </div>
</section>

	<!-- Newsletter -->
	<section class="border-t border-border bg-card">
		<div class="container mx-auto py-16 px-4 text-center">
			<p class="text-primary text-xs tracking-[0.3em] uppercase font-semibold mb-2">Stay Updated</p>
			<h2 class="text-2xl md:text-3xl font-display font-bold text-foreground mb-4">
				Subscribe for Research Updates
			</h2>
			<p class="text-muted-foreground mb-8 max-w-md mx-auto">
				Get notified about new products, research publications, and exclusive offers.
			</p>
			<form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto" id="newsletter-form">
                <div class="flex-1 relative">
				    <input
					    type="email"
					    placeholder="Enter your email"
                        name="email"
					    class="w-full px-4 py-3 rounded-lg bg-secondary border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary text-sm"
                        required
				    />
                </div>
				<button type="submit" class="bg-primary text-primary-foreground hover:bg-gold-light px-8 py-3 rounded-md font-semibold transition-colors">Subscribe</button>
                <?php wp_nonce_field( 'colton_newsletter_nonce', 'newsletter_nonce' ); ?>
			</form>
            <div id="newsletter-feedback" class="text-sm mt-4 h-5"></div>
		</div>
	</section>
</div>



<!-- Modals -->
<!-- Reconstitution Guide Modal -->
<div id="modal-reconstitution-guide" class="fixed inset-0 z-[1000] hidden items-center justify-center p-4 bg-background/80 backdrop-blur-sm animate-fade-in">
    <div class="bg-card w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-[32px] border border-border shadow-2xl">
        <div class="sticky top-0 bg-card p-6 border-b border-border flex items-center justify-between">
            <h2 class="text-2xl font-display font-bold text-foreground">7 Steps to Reconstitute Peptides</h2>
            <button onclick="closeResourceModal('reconstitution-guide')" class="p-2 hover:bg-secondary rounded-full transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="p-8 space-y-8">
            <div class="space-y-6">
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold shrink-0">1</div>
                    <p class="text-muted-foreground"><strong class="text-foreground">Sanitize Everything:</strong> Wipe the vial tops and your workspace with 70% isopropyl alcohol.</p>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold shrink-0">2</div>
                    <p class="text-muted-foreground"><strong class="text-foreground">Draw Solvent:</strong> Using a sterile syringe, draw the required amount of Bacteriostatic Water.</p>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold shrink-0">3</div>
                    <p class="text-muted-foreground"><strong class="text-foreground">Inject Slowly:</strong> Direct the needle at the side wall of the vial, not the powder directly.</p>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold shrink-0">4</div>
                    <p class="text-muted-foreground"><strong class="text-foreground">Release Pressure:</strong> Allow the air pressure to equalize before removing the needle.</p>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold shrink-0">5</div>
                    <p class="text-muted-foreground"><strong class="text-foreground">Mix Gently:</strong> Swirl or roll the vial between your palms. Do NOT shake.</p>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold shrink-0">6</div>
                    <p class="text-muted-foreground"><strong class="text-foreground">Inspect:</strong> Ensure the solution is clear and transparent with no particles.</p>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold shrink-0">7</div>
                    <p class="text-muted-foreground"><strong class="text-foreground">Store Properly:</strong> Place in a refrigerator at 2-8°C for stability.</p>
                </div>
            </div>
            <div class="bg-primary/5 p-6 rounded-2xl border border-primary/10">
                <p class="text-xs text-primary leading-relaxed">
                    <strong class="uppercase font-bold block mb-1">Important:</strong> Lyophilized peptides are extremely sensitive. Shaking or exposing them to heat can degrade the compound identity and purity.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Peptide Calculator Modal -->
<div id="modal-peptide-calculator" class="fixed inset-0 z-[1000] hidden items-center justify-center p-4 bg-background/80 backdrop-blur-sm animate-fade-in">
    <div class="bg-card w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-[32px] border border-border shadow-2xl">
        <div class="sticky top-0 bg-card p-6 border-b border-border flex items-center justify-between">
            <h2 class="text-2xl font-display font-bold text-foreground">Peptide Calculator</h2>
            <button onclick="closeResourceModal('peptide-calculator')" class="p-2 hover:bg-secondary rounded-full transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="p-8">
            <form id="peptide-calc-form" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Peptide Strength (mg)</label>
                        <input type="number" id="calc-mg" value="5" class="w-full bg-secondary border border-border rounded-xl p-4 text-foreground focus:outline-none focus:ring-2 focus:ring-primary" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">BAC Water Volume (mL)</label>
                        <input type="number" id="calc-water" value="3" class="w-full bg-secondary border border-border rounded-xl p-4 text-foreground focus:outline-none focus:ring-2 focus:ring-primary" />
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Desired Dose (mcg)</label>
                        <input type="number" id="calc-dose" value="250" class="w-full bg-secondary border border-border rounded-xl p-4 text-foreground focus:outline-none focus:ring-2 focus:ring-primary" />
                    </div>
                </div>

                <div class="bg-primary p-8 rounded-[24px] text-white space-y-6 mt-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div>
                            <span class="text-[10px] uppercase tracking-[0.2em] font-bold opacity-70">Concentration</span>
                            <div id="calc-res-concentration" class="text-2xl font-display font-bold">1.67 mg/mL</div>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase tracking-[0.2em] font-bold opacity-70">Draw Syringe To</span>
                            <div id="calc-res-units" class="text-2xl font-display font-bold">15 Units</div>
                            <div id="calc-res-ml" class="text-sm opacity-70">0.150 mL</div>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-white/20 text-[10px] opacity-70 italic">
                        * Calculations assume a standard U-100 (1mL) insulin syringe.
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- BAC Water Guide Modal -->
<div id="modal-bac-water-guide" class="fixed inset-0 z-[1000] hidden items-center justify-center p-4 bg-background/80 backdrop-blur-sm animate-fade-in">
    <div class="bg-card w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-[32px] border border-border shadow-2xl">
        <div class="sticky top-0 bg-card p-6 border-b border-border flex items-center justify-between">
            <h2 class="text-2xl font-display font-bold text-foreground">Bacteriostatic Water Guide</h2>
            <button onclick="closeResourceModal('bac-water-guide')" class="p-2 hover:bg-secondary rounded-full transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="p-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 bg-secondary/50 rounded-2xl border border-border">
                    <h3 class="font-bold text-primary mb-2">Single-Dose Use</h3>
                    <p class="text-sm text-muted-foreground">Use 1 mL or less. Ideal for GLP-1 peptides to maintain high concentration.</p>
                </div>
                <div class="p-6 bg-secondary/50 rounded-2xl border border-border">
                    <h3 class="font-bold text-primary mb-2">Multi-Dose Use</h3>
                    <p class="text-sm text-muted-foreground">Use 2–3 mL. Makes measuring small doses (like BPC-157) easier and more precise.</p>
                </div>
            </div>
            <div class="space-y-4">
                <h4 class="font-display font-bold text-foreground">Why Bacteriostatic Water?</h4>
                <p class="text-sm text-muted-foreground leading-relaxed">
                    Unlike sterile water, BAC water contains 0.9% benzyl alcohol, which prevents bacterial growth for up to 30 days after opening. This is essential for multi-dose vials to ensure research integrity and subject safety.
                </p>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
