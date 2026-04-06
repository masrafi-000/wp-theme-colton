<?php
/**
 * The front page template file
 *
 * @package Colton_Research
 */

get_header();
?>

<style>
    /* --- Global Hero Styles --- */
    .hero-section { 
        position: relative; 
        height: calc(100vh - 97px); /* Precise height minus header + border */
        display: flex; 
        align-items: center; 
        overflow: hidden; /* Added back to prevent horizontal scroll from image transform */
        background: radial-gradient(circle at 0% 0%, #0ea5e9 0%, #0b1120 55%, #020617 100%); 
        color: #ffffff; 
        width: 100%; 
        max-width: 100%; /* Changed from 100vw to 100% to avoid scrollbar width issues */
        margin: 0;
        padding: 0;
    }
    
    /* Admin Bar Height Offsets */
    .admin-bar .hero-section { height: calc(100vh - 97px - 32px); }
    @media (max-width: 782px) {
        .admin-bar .hero-section { height: calc(100dvh - 65px - 46px); }
    }

    /* Ensure no horizontal overflow globally */
    html, body { overflow-x: hidden; width: 100%; position: relative; margin: 0; padding: 0; }
    body.home { overflow-x: hidden; }

    .hero-overlay { position: absolute; inset: 0; background: radial-gradient(circle at 30% 50%, rgba(15,23,42,0.3) 0%, rgba(15,23,42,0.8) 50%, rgba(15,23,42,1) 100%); z-index: 1; }
    .hero-img { position: absolute; top: 0; right: 0; width: 45%; height: 100%; object-fit: contain; z-index: 0; opacity: 1; transform: translateX(5%); filter: drop-shadow(0 0 100px rgba(2, 102, 158, 0.3)); pointer-events: none; }
    .hero-container { position: relative; z-index: 10; width: 100%; max-width: 1400px; margin: 0 auto; padding: 0 6%; display: flex; align-items: center; min-height: 0; }
    .hero-content { text-align: left; color: #ffffff; max-width: 700px; z-index: 11; flex-shrink: 1; }
    .hero-subtitle { color: #38bdf8; font-size: clamp(14px, 1.2vw, 16px); font-weight: 800; text-transform: uppercase; letter-spacing: 6px; margin-bottom: clamp(12px, 2vw, 24px); display: flex; items-center gap-3; }
    .hero-title { font-size: clamp(32px, 5vw, 84px); font-weight: 800; line-height: 0.95; margin-bottom: clamp(16px, 3vw, 32px); color: #ffffff; text-shadow: 0 4px 24px rgba(0,0,0,0.5); letter-spacing: -0.04em; }
    .hero-title span { color: #38bdf8; position: relative; display: inline-block; margin-top: 10px; }
    .hero-desc { font-size: clamp(14px, 1.5vw, 22px); color: #e0f2fe; line-height: 1.6; margin-bottom: clamp(24px, 4vw, 48px); max-width: 600px; font-weight: 400; text-shadow: 0 2px 8px rgba(0,0,0,0.4); opacity: 0.9; }
    .hero-btns { display: flex; gap: 24px; justify-content: flex-start; }
    .hero-btn { padding: clamp(12px, 1.5vw, 22px) clamp(32px, 4vw, 56px); border-radius: 12px; font-weight: 800; text-transform: uppercase; text-decoration: none; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); display: inline-block; font-size: clamp(12px, 1.2vw, 16px); letter-spacing: 2px; }
    .hero-btn:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 30px 60px rgba(2, 102, 158, 0.4); }
    .hero-btn-primary { background: #02669e; color: #ffffff; border: none; box-shadow: 0 10px 20px rgba(0,0,0,0.2); display: inline-flex; align-items: center; gap: 15px; padding: clamp(12px, 1.5vw, 18px) clamp(32px, 3vw, 45px); border-radius: 50px; }
    .hero-btn-primary .btn-arrow { background: #ffffff; color: #02669e; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: transform 0.3s ease; }
    .hero-btn-primary:hover .btn-arrow { transform: rotate(45deg); }
    .hero-btn-secondary { background: transparent; border: 2px solid rgba(255, 255, 255, 0.6); color: #ffffff; backdrop-filter: blur(8px); }
    .hero-btn-secondary:hover { border-color: #38bdf8; color: #ffffff; background: rgba(2, 102, 158, 0.2); }

    /* Review Slider Styles */
    .hero-review-slider { position: absolute; top: 30%; left: 60%; z-index: 20; max-width: 480px; color: #ffffff; text-align: center; transform: translate(-50%, -50%); }
    .review-dots { display: flex; gap: 10px; margin-bottom: 20px; background: rgba(255,255,255,0.1); width: fit-content; padding: 8px 16px; border-radius: 20px; backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.1); margin-left: auto; margin-right: auto; }
    .review-dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(255,255,255,0.3); cursor: pointer; transition: all 0.3s ease; }
    .review-dot.active { background: #ffffff; transform: scale(1.3); }
    .review-stars { display: flex; gap: 6px; color: #facc15; margin-bottom: 16px; justify-content: center; }
    .review-content-wrapper { position: relative; height: 140px; overflow: hidden; }
    .review-item { position: absolute; top: 0; left: 0; width: 100%; opacity: 0; visibility: hidden; transition: all 0.5s ease; transform: translateY(15px); }
    .review-item.active { opacity: 1; visibility: visible; transform: translateY(0); }
    .review-text { font-size: clamp(14px, 1.5vw, 20px); line-height: 1.6; color: rgba(255,255,255,1); font-weight: 500; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; text-shadow: 0 2px 10px rgba(0,0,0,0.3); }

    /* --- Additional Section Styles --- */
    .btn-yellow { background: #02669e; color: #ffffff; border-radius: 50px; padding: 12px 32px; font-weight: 700; display: inline-flex; align-items: center; gap: 12px; transition: all 0.3s ease; text-transform: uppercase; font-size: 14px; }
    .btn-yellow:hover { background: #014d7a; transform: translateY(-2px); }
    .btn-yellow .btn-arrow { background: #ffffff; color: #02669e; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; }
    
    .section-title { font-size: clamp(28px, 4vw, 48px); font-weight: 800; line-height: 1.1; color: #0f172a; margin-bottom: 24px; }
    .section-subtitle { font-size: 14px; font-weight: 700; color: #02669e; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 16px; display: block; }
    
    .coa-card { background: #ffffff; border-radius: 24px; border: 1px solid #f1f5f9; padding: clamp(20px, 3vw, 32px); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    .coa-header { background: #02669e; padding: 16px 24px; border-radius: 12px; margin-bottom: 24px; font-weight: 700; color: #ffffff; opacity: 0.9; }
    .coa-info { font-size: 14px; color: #64748b; line-height: 2; }
    .coa-info strong { color: #0f172a; }

    .signature-card { border-radius: 24px; overflow: hidden; position: relative; aspect-ratio: 16/9; display: flex; flex-direction: column; justify-content: flex-end; padding: 32px; color: #ffffff; }
    .signature-card img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; transition: transform 0.5s ease; }
    .signature-card:hover img { transform: scale(1.05); }
    .signature-content { position: relative; z-index: 1; }
    .signature-card::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 60%); z-index: 0; }

    .blog-card { background: #ffffff; border-radius: 24px; overflow: hidden; }
    .blog-img { aspect-ratio: 4/3; background: #02669e; display: flex; align-items: center; justify-content: center; padding: 40px; }
    .blog-img img { width: 100%; height: auto; object-fit: contain; }
    .blog-content { padding: 24px 0; }
    .blog-date { font-size: 14px; color: #64748b; margin-bottom: 8px; display: block; }
    .blog-title { font-size: 18px; font-weight: 700; color: #0f172a; line-height: 1.4; margin-bottom: 12px; }
    .blog-desc { font-size: 14px; color: #64748b; line-clamp: 2; -webkit-line-clamp: 2; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; }

    .bg-radial-gradient { background: radial-gradient(circle at center, rgba(2, 102, 158, 0.15) 0%, transparent 70%); }

    /* Trust Features Section Styles */
    .trust-features-section { padding: 40px 0; background: #ffffff; border-bottom: 1px solid #f1f5f9; margin-top: 0; }
    .trust-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; max-width: 1400px; margin: 0 auto; padding: 0 6%; }
    .trust-item { display: flex; align-items: center; gap: 15px; }
    .trust-icon-box { background: #eff6ff; padding: 12px; border-radius: 12px; color: #02669e; display: flex; align-items: center; justify-content: center; }
    .trust-content h4 { font-size: 15px; font-weight: 700; color: #0f172a; margin: 0; }
    .trust-content p { font-size: 12px; color: #64748b; margin: 2px 0 0; }

    /* --- Tablet & Mobile Refinements --- */
    @media (max-width: 1024px) {
        .hero-section { height: calc(100dvh - 65px); }
        .hero-img { width: 100%; height: 35%; top: 0; opacity: 0.3; transform: translateX(0); object-fit: contain; }
        .hero-overlay { background: radial-gradient(circle at 50% 50%, rgba(15,23,42,0.7) 0%, rgba(15,23,42,1) 100%); }
        .hero-container { padding: 0 20px; display: flex; flex-direction: column; justify-content: center; height: 100%; min-height: 0; }
        .hero-content { text-align: center; margin: 0 auto; max-width: 100%; }
        .hero-subtitle { justify-content: center; }
        .hero-btns { justify-content: center; margin-top: 20px; }
        .hero-review-slider { position: relative; top: auto; left: auto; transform: none; margin: 30px auto 0; max-width: 100%; }
        .review-content-wrapper { height: 120px; }
    }

    @media (max-width: 640px) {
        .hero-section { height: calc(100dvh - 65px); }
        .hero-title { font-size: 28px; margin-bottom: 8px; }
        .hero-desc { font-size: 13px; margin-bottom: 16px; line-height: 1.4; }
        .hero-btns { flex-direction: column; gap: 10px; align-items: center; }
        .hero-btn { width: 100%; max-width: 240px; text-align: center; padding: 12px 24px; }
        .hero-review-slider { margin-top: 15px; }
        .review-content-wrapper { height: 90px; }
        .review-text { -webkit-line-clamp: 3; font-size: 12px; }
        .review-stars { margin-bottom: 8px; }
        .review-dots { margin-bottom: 12px; }
    }
</style>

<!-- Hero -->
<section class="hero-section">
    <!-- Age Verification Modal -->
    <div id="age-verification-modal" class="fixed inset-0 z-[1100] hidden items-center justify-center p-4 bg-background/95 backdrop-blur-lg animate-fade-in">
        <div class="relative bg-white w-full max-w-lg rounded-[40px] p-12 text-center shadow-2xl border border-border overflow-hidden">
            <div class="relative space-y-10">
                <div class="flex justify-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/main logo  - Edited.png" alt="Logo" class="h-16 w-auto">
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
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/main logo  - Edited.png" alt="Logo" class="h-16 w-auto">
                </div>

                <div class="space-y-4">
                    <h2 class="text-4xl font-display font-extrabold leading-tight uppercase tracking-tight">
                        Get 5% Off Your<br />First Order!
                    </h2>
                    <p class="text-white/80 text-lg">
                        Join the Colton Research community to receive <span class="text-white font-bold">5% off</span> your first order.
                    </p>
                </div>

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

    <img src="<?php echo get_template_directory_uri(); ?>/assets/BPC-157.png" alt="BPC-157 research peptide vial" class="hero-img" />
    <div class="hero-overlay"></div>
    <div class="hero-container">
        <div class="hero-review-slider animate-fade-in">
            <div class="review-dots">
                <div class="review-dot active" data-index="0"></div>
                <div class="review-dot" data-index="1"></div>
                <div class="review-dot" data-index="2"></div>
            </div>
            <div class="review-stars">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
            </div>
            <div class="review-content-wrapper">
                <div class="review-item active">
                    <p class="review-text">"I absolutely love this company. Real legitimate products, easy to access calculator guides, and fast shipping..."</p>
                </div>
                <div class="review-item">
                    <p class="review-text">"The purity levels are unmatched. Every batch I've tested has exceeded my expectations for research consistency."</p>
                </div>
                <div class="review-item">
                    <p class="review-text">"Excellent customer support and detailed CoA documentation. Makes my laboratory workflow much smoother."</p>
                </div>
            </div>
        </div>

        <div class="hero-content animate-slide-up">
            <p class="hero-subtitle"><?php echo esc_html( get_theme_mod( 'hero_subtitle', 'Premium Quality' ) ); ?></p>
            <?php 
            $hero_title = get_theme_mod( 'hero_title', 'Research Peptides' );
            $title_parts = explode( ' ', $hero_title );
            $last_word = array_pop( $title_parts );
            $main_title = implode( ' ', $title_parts );
            ?>
            <h1 class="hero-title">
                <?php echo esc_html( $main_title ); ?><br />
                <span><?php echo esc_html( $last_word ); ?></span>
            </h1>
            <p class="hero-desc">
                Research-only peptides with ≥99% purity, HPLC tested and batch-verified so your data is clean, repeatable, and publication-ready.
            </p>
            <div class="hero-btns">
                <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="hero-btn hero-btn-primary">
                    Shop Now
                    <span class="btn-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Trust Features Section -->
<section class="trust-features-section reveal-on-scroll">
    <div class="trust-grid">
        <div class="trust-item group p-4 rounded-2xl transition-all duration-300 hover:bg-secondary/30 hover:shadow-xl hover:shadow-primary/5 hover:-translate-y-1 cursor-default">
            <div class="trust-icon-box transition-transform duration-300 group-hover:scale-110 group-hover:bg-primary group-hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
            </div>
            <div class="trust-content">
                <h4 class="transition-colors duration-300 group-hover:text-primary">Free Delivery</h4>
                <p>Orders over $200</p>
            </div>
        </div>
        <div class="trust-item group p-4 rounded-2xl transition-all duration-300 hover:bg-secondary/30 hover:shadow-xl hover:shadow-primary/5 hover:-translate-y-1 cursor-default">
            <div class="trust-icon-box transition-transform duration-300 group-hover:scale-110 group-hover:bg-primary group-hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
            </div>
            <div class="trust-content">
                <h4 class="transition-colors duration-300 group-hover:text-primary">≥99% Purity</h4>
                <p>HPLC verified</p>
            </div>
        </div>
        <div class="trust-item group p-4 rounded-2xl transition-all duration-300 hover:bg-secondary/30 hover:shadow-xl hover:shadow-primary/5 hover:-translate-y-1 cursor-default">
            <div class="trust-icon-box transition-transform duration-300 group-hover:scale-110 group-hover:bg-primary group-hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            </div>
            <div class="trust-content">
                <h4 class="transition-colors duration-300 group-hover:text-primary">Secure Payment</h4>
                <p>256-bit SSL encryption</p>
            </div>
        </div>
        <div class="trust-item group p-4 rounded-2xl transition-all duration-300 hover:bg-secondary/30 hover:shadow-xl hover:shadow-primary/5 hover:-translate-y-1 cursor-default">
            <div class="trust-icon-box transition-transform duration-300 group-hover:scale-110 group-hover:bg-primary group-hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </div>
            <div class="trust-content">
                <h4 class="transition-colors duration-300 group-hover:text-primary">Expert Support</h4>
                <p>Research consultation</p>
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
                    <span class="section-subtitle">Premium Quality</span>
                    <h2 class="section-title">Next-Generation Research Peptides</h2>
                    <p class="text-lg text-muted-foreground leading-relaxed max-w-lg">
                        Experience a breakthrough in research with our advanced peptide formulations. Crafted for scientists who demand the extraordinary.
                    </p>
                </div>
                <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn-yellow">
                    Shop Now
                    <span class="btn-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                    </span>
                </a>
            </div>
            <div class="relative">
                <div class="rounded-[40px] overflow-hidden">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/BPC-157.png" alt="Research Peptides" class="w-full h-auto max-w-md mx-auto drop-shadow-2xl" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Research Categories -->
<section class="container mx-auto py-20 px-4 reveal-on-scroll">
    <div class="text-center mb-12">
        <p class="text-[#02669e] text-xs tracking-[0.3em] uppercase font-semibold mb-2">Browse By Purpose</p>
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
                echo '<a href="' . esc_url( get_term_link( $category ) ) . '" class="group p-6 rounded-lg bg-white border border-border hover:border-[#02669e]/40 transition-all duration-300 text-center">';
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#02669e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 mx-auto mb-3 group-hover:scale-110 transition-transform"><path d="M4.5 3h15"/><path d="M6 3v16a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V3"/><path d="M6 14h12"/></svg>';
                echo '<h3 class="font-display font-semibold text-sm text-foreground group-hover:text-[#02669e] transition-colors">' . esc_html( $category->name ) . '</h3>';
                echo '</a>';
            }
        } else {
            // Fallback static categories
            $fallback_cats = array(
                array("name" => "Muscle Growth", "slug" => "muscle-growth"),
                array("name" => "Fat Loss", "slug" => "fat-loss"),
                array("name" => "Recovery", "slug" => "recovery"),
                array("name" => "Anti-Aging Research", "slug" => "anti-aging"),
                array("name" => "Cognitive Research", "slug" => "cognitive")
            );
            foreach ($fallback_cats as $cat) {
                echo '<a href="' . esc_url( home_url( '/shop?category=' . $cat['slug'] ) ) . '" class="group p-6 rounded-lg bg-white border border-border hover:border-[#02669e]/40 transition-all duration-300 text-center">';
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#02669e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 mx-auto mb-3 group-hover:scale-110 transition-transform"><path d="M4.5 3h15"/><path d="M6 3v16a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V3"/><path d="M6 14h12"/></svg>';
                echo '<h3 class="font-display font-semibold text-sm text-foreground group-hover:text-[#02669e] transition-colors">' . $cat['name'] . '</h3>';
                echo '</a>';
            }
        }
        ?>
    </div>
</section>

<!-- Featured Products -->
<section class="bg-[#f8fafc] border-y border-border reveal-on-scroll">
    <div class="container mx-auto py-20 px-4">
        <div class="flex items-end justify-between mb-12">
            <div class="text-left">
                <p class="text-[#02669e] text-xs tracking-[0.3em] uppercase font-semibold mb-2">Top Sellers</p>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-foreground">Featured Products</h2>
            </div>
            <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="hidden md:flex items-center gap-1 text-sm text-[#02669e] hover:underline font-medium transition-colors">
                View All <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="m9 18 6-6-6-6"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
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
            } else {
                echo '<p class="text-muted-foreground col-span-full text-center">Install WooCommerce to see products here.</p>';
            }
            ?>
        </div>
    </div>
</section>

<!-- Transparency Section -->
<section class="py-24 bg-[#fafafa]">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16 items-center">
            <div class="text-left">
                <span class="section-subtitle">Certificates of Analysis</span>
                <h2 class="section-title">Transparency You Can Trust</h2>
                <p class="text-muted-foreground leading-relaxed mt-6">
                    All products are supported by third-party laboratory testing and documented Certificates of Analysis. These reports confirm compound identity and purity, giving you direct access to the same data we use for internal quality verification.
                </p>
            </div>
            <div class="text-center lg:text-right">
                <div class="inline-block p-1 rounded-2xl bg-gradient-to-br from-primary/20 to-transparent">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/BPC-157.png" alt="Peptide Vial with COA" class="rounded-xl shadow-xl max-w-md w-full mx-auto" />
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-4 mb-12" id="coa-tabs">
            <button class="coa-tab-btn active px-8 py-3 rounded-full bg-primary text-white font-bold text-sm uppercase transition-all duration-300" data-product="semaglutide">Semaglutide</button>
            <button class="coa-tab-btn px-8 py-3 rounded-full border border-primary text-primary font-bold text-sm uppercase transition-all duration-300 hover:bg-primary/5" data-product="bpc157">BPC-157</button>
            <button class="coa-tab-btn px-8 py-3 rounded-full border border-primary text-primary font-bold text-sm uppercase transition-all duration-300 hover:bg-primary/5" data-product="ipamorelin">Ipamorelin</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16" id="coa-grid">
            <?php 
            $batches = array(
                array("name" => "Semaglutide 5mg", "batch" => "11102025SM", "purity" => "99.174%", "date" => "22 JAN 2026"),
                array("name" => "Semaglutide 10mg", "batch" => "1052026SM", "purity" => "99.524%", "date" => "16 FEB 2026"),
                array("name" => "Semaglutide 15mg", "batch" => "11092025SM", "purity" => "99.791%", "date" => "22 JAN 2026")
            );
            foreach ($batches as $b) :
            ?>
            <div class="coa-card text-left animate-fade-in">
                <div class="coa-header"><?php echo $b['name']; ?></div>
                <div class="coa-info space-y-2">
                    <p><strong>Batch:</strong> <?php echo $b['batch']; ?></p>
                    <p><strong>Purity:</strong> <?php echo $b['purity']; ?></p>
                    <p><strong>Date:</strong> <?php echo $b['date']; ?></p>
                    <p><strong>Lab:</strong> Janoshik Laboratories</p>
                    <p><strong>Key:</strong> <?php echo substr(md5($b['name']), 0, 12); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center">
            <a href="#" class="btn-yellow">
                View Full Test Reports
                <span class="btn-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                </span>
            </a>
        </div>
    </div>
</section>

<!-- Simple Powerful Effective Section -->
<section class="bg-[#020617] text-white overflow-hidden">
    <div class="grid grid-cols-1 lg:grid-cols-2 items-center">
        <div class="relative h-[600px] lg:h-[800px] flex items-center justify-center bg-radial-gradient">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/BPC-157.png" alt="Research Peptides" class="w-full h-auto max-w-lg drop-shadow-[0_0_50px_rgba(2,102,158,0.5)]" />
        </div>
        <div class="p-12 lg:p-24 space-y-12 text-left">
            <h2 class="text-6xl lg:text-8xl font-extrabold leading-tight">Simple.<br />Powerful.<br />Effective.</h2>
            <p class="text-xl text-white/60">Discover an intuitive way to elevate your research.</p>
            <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn-yellow">
                Explore
                <span class="btn-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                </span>
            </a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-24 bg-white border-t border-border reveal-on-scroll">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-16 space-y-4">
            <span class="section-subtitle">Support</span>
            <h2 class="section-title">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-4">
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
                <div class="border border-border rounded-xl overflow-hidden faq-item transition-all duration-300 hover:border-primary/30">
                    <button class="w-full flex items-center justify-between p-6 text-left hover:bg-secondary/30 transition-all duration-300 faq-toggle">
                        <span class="font-display font-semibold text-foreground text-base pr-4"><?php echo $faq['q']; ?></span>
                        <div class="h-8 w-8 rounded-full bg-secondary flex items-center justify-center shrink-0 transition-all duration-300 faq-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary transition-transform faq-icon"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </button>
                    <div class="px-6 pb-6 hidden faq-content animate-fade-in">
                        <p class="text-muted-foreground leading-relaxed"><?php echo $faq['a']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Peptide Resources Section -->
<section class="py-24 bg-[#f8fafc] border-t border-border reveal-on-scroll">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 space-y-4">
            <p class="text-primary text-xs tracking-[0.3em] uppercase font-semibold mb-2">Blog</p>
            <h2 class="text-4xl md:text-5xl font-display font-bold text-foreground">Peptide Resources</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Resource 1: 7 Steps -->
            <article class="group bg-white rounded-[32px] overflow-hidden border border-border transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2 cursor-pointer" onclick="openResourceModal('reconstitution-guide')">
                <div class="aspect-[4/3] bg-primary/5 flex items-center justify-center p-12 transition-colors duration-500 group-hover:bg-primary/10">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/BPC-157.png" alt="Reconstitution Guide" class="w-full h-full object-contain drop-shadow-2xl transition-transform duration-700 group-hover:scale-110" />
                </div>
                <div class="p-8 space-y-4">
                    <h3 class="text-xl font-display font-bold text-foreground group-hover:text-primary transition-colors">7 Steps to Reconstitute Peptides</h3>
                    <span class="text-xs font-medium text-muted-foreground uppercase tracking-widest block">January 13, 2026</span>
                    <p class="text-sm text-muted-foreground leading-relaxed line-clamp-3">
                        A guide on peptides, their benefits, and step-by-step directions for reconstituting lyophilized (freeze-dried) peptides and instructions...
                    </p>
                </div>
            </article>

            <!-- Resource 2: Calculator -->
            <article class="group bg-white rounded-[32px] overflow-hidden border border-border transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2 cursor-pointer" onclick="openResourceModal('peptide-calculator')">
                <div class="aspect-[4/3] bg-primary/5 flex items-center justify-center p-12 transition-colors duration-500 group-hover:bg-primary/10">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/BPC-157.png" alt="Peptide Calculator" class="w-full h-full object-contain drop-shadow-2xl transition-transform duration-700 group-hover:scale-110" />
                </div>
                <div class="p-8 space-y-4">
                    <h3 class="text-xl font-display font-bold text-foreground group-hover:text-primary transition-colors">Peptide Calculator</h3>
                    <span class="text-xs font-medium text-muted-foreground uppercase tracking-widest block">January 15, 2026</span>
                    <p class="text-sm text-muted-foreground leading-relaxed line-clamp-3">
                        Use our Peptide Reconstitution Calculator below. Simply select your parameters to accurately calculate dosages...
                    </p>
                </div>
            </article>

            <!-- Resource 3: BAC Water -->
            <article class="group bg-white rounded-[32px] overflow-hidden border border-border transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2 cursor-pointer" onclick="openResourceModal('bac-water-guide')">
                <div class="aspect-[4/3] bg-primary/5 flex items-center justify-center p-12 transition-colors duration-500 group-hover:bg-primary/10">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/BPC-157.png" alt="BAC Water Guide" class="w-full h-full object-contain drop-shadow-2xl transition-transform duration-700 group-hover:scale-110" />
                </div>
                <div class="p-8 space-y-4">
                    <h3 class="text-xl font-display font-bold text-foreground group-hover:text-primary transition-colors">How Much Bacteriostatic Water to Add to Peptides?</h3>
                    <span class="text-xs font-medium text-muted-foreground uppercase tracking-widest block">January 2, 2026</span>
                    <p class="text-sm text-muted-foreground leading-relaxed line-clamp-3">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('newsletter-form');
    const feedback = document.getElementById('newsletter-feedback');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        feedback.textContent = 'Processing...';
        feedback.className = 'text-sm mt-4 h-5 text-muted-foreground';

        const formData = new FormData(form);
        formData.append('action', 'colton_newsletter_signup');

        fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                feedback.textContent = data.data;
                feedback.className = 'text-sm mt-4 h-5 text-green-500';
                form.reset();
            } else {
                feedback.textContent = data.data;
                feedback.className = 'text-sm mt-4 h-5 text-red-500';
            }
        })
        .catch(error => {
            feedback.textContent = 'An unexpected error occurred.';
            feedback.className = 'text-sm mt-4 h-5 text-red-500';
        });
    });

    // Hero Review Slider Logic
    const reviewItems = document.querySelectorAll('.review-item');
    const reviewDots = document.querySelectorAll('.review-dot');
    let currentReview = 0;

    function showReview(index) {
        reviewItems.forEach(item => item.classList.remove('active'));
        reviewDots.forEach(dot => dot.classList.remove('active'));
        
        reviewItems[index].classList.add('active');
        reviewDots[index].classList.add('active');
        currentReview = index;
    }

    function nextReview() {
        let next = (currentReview + 1) % reviewItems.length;
        showReview(next);
    }

    reviewDots.forEach(dot => {
        dot.addEventListener('click', () => {
            const index = parseInt(dot.dataset.index);
            showReview(index);
        });
    });

    setInterval(nextReview, 5000);

    // FAQ Accordion Logic
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const toggle = item.querySelector('.faq-toggle');
        const content = item.querySelector('.faq-content');
        const icon = item.querySelector('.faq-icon');
        const iconWrapper = item.querySelector('.faq-icon-wrapper');
        
        toggle.addEventListener('click', () => {
            const isOpen = !content.classList.contains('hidden');
            
            // Close all other items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.querySelector('.faq-content').classList.add('hidden');
                    otherItem.querySelector('.faq-icon').classList.remove('rotate-180');
                    otherItem.querySelector('.faq-icon-wrapper').classList.remove('bg-primary');
                    otherItem.querySelector('.faq-icon').classList.remove('text-white');
                    otherItem.querySelector('.faq-icon').classList.add('text-primary');
                }
            });
            
            if (!isOpen) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
                iconWrapper.classList.add('bg-primary');
                icon.classList.remove('text-primary');
                icon.classList.add('text-white');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
                iconWrapper.classList.remove('bg-primary');
                icon.classList.remove('text-white');
                icon.classList.add('text-primary');
            }
        });
    });

    // COA Tabs Logic
    const coaData = {
        semaglutide: [
            { name: "Semaglutide 5mg", batch: "11102025SM", purity: "99.174%", date: "22 JAN 2026", key: "07392999be2a" },
            { name: "Semaglutide 10mg", batch: "1052026SM", purity: "99.524%", date: "16 FEB 2026", key: "f0974fac305f" },
            { name: "Semaglutide 15mg", batch: "11092025SM", purity: "99.791%", date: "22 JAN 2026", key: "9e71f2a8a152" }
        ],
        bpc157: [
            { name: "BPC-157 5mg", batch: "20250115BPC", purity: "99.821%", date: "15 JAN 2026", key: "7c2f8a1d5e4b" },
            { name: "BPC-157 10mg", batch: "20250210BPC", purity: "99.914%", date: "10 FEB 2026", key: "4d9e1c3b7a5f" },
            { name: "BPC-157 5mg (Arg)", batch: "20250301BPC", purity: "99.752%", date: "01 MAR 2026", key: "1a5c3e7b9d2f" }
        ],
        ipamorelin: [
            { name: "Ipamorelin 2mg", batch: "20250120IPA", purity: "98.941%", date: "20 JAN 2026", key: "9b3d7f1e5a4c" },
            { name: "Ipamorelin 5mg", batch: "20250225IPA", purity: "99.112%", date: "25 FEB 2026", key: "3f5a7d1c9e2b" },
            { name: "Ipamorelin 10mg", batch: "20250315IPA", purity: "99.428%", date: "15 MAR 2026", key: "7e1c3b5a9d4f" }
        ]
    };

    const coaTabBtns = document.querySelectorAll('.coa-tab-btn');
    const coaGrid = document.getElementById('coa-grid');

    coaTabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const product = btn.dataset.product;
            
            // Update active state
            coaTabBtns.forEach(b => {
                b.classList.remove('bg-primary', 'text-white', 'active');
                b.classList.add('border', 'border-primary', 'text-primary');
            });
            btn.classList.add('bg-primary', 'text-white', 'active');
            btn.classList.remove('border', 'border-primary', 'text-primary');

            // Render new cards
            if (coaData[product]) {
                coaGrid.innerHTML = coaData[product].map(batch => `
                    <div class="coa-card text-left animate-fade-in">
                        <div class="coa-header">${batch.name}</div>
                        <div class="coa-info space-y-2">
                            <p><strong>Batch:</strong> ${batch.batch}</p>
                            <p><strong>Purity:</strong> ${batch.purity}</p>
                            <p><strong>Date:</strong> ${batch.date}</p>
                            <p><strong>Lab:</strong> Janoshik Laboratories</p>
                            <p><strong>Key:</strong> ${batch.key}</p>
                        </div>
                    </div>
                `).join('');
            }
        });
    });

    // Resource Modals Logic
    const modals = {
        'reconstitution-guide': document.getElementById('modal-reconstitution-guide'),
        'peptide-calculator': document.getElementById('modal-peptide-calculator'),
        'bac-water-guide': document.getElementById('modal-bac-water-guide')
    };

    window.openResourceModal = function(id) {
        if (modals[id]) {
            modals[id].classList.remove('hidden');
            modals[id].classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }
    };

    window.closeResourceModal = function(id) {
        if (modals[id]) {
            modals[id].classList.add('hidden');
            modals[id].classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }
    };

    // Close on overlay click
    Object.values(modals).forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                const id = modal.id.replace('modal-', '');
                closeResourceModal(id);
            }
        });
    });

    // Peptide Calculator Logic
    const calcForm = document.getElementById('peptide-calc-form');
    if (calcForm) {
        const inputs = calcForm.querySelectorAll('input');
        const results = {
            concentration: document.getElementById('calc-res-concentration'),
            units: document.getElementById('calc-res-units'),
            ml: document.getElementById('calc-res-ml')
        };

        const calculate = () => {
            const mg = parseFloat(document.getElementById('calc-mg').value) || 0;
            const ml = parseFloat(document.getElementById('calc-water').value) || 1;
            const mcgDose = parseFloat(document.getElementById('calc-dose').value) || 0;

            const concentrationMgMl = mg / ml;
            const concentrationMcgMl = concentrationMgMl * 1000;
            
            let drawMl = 0;
            if (concentrationMcgMl > 0) {
                drawMl = mcgDose / concentrationMcgMl;
            }
            
            const units = drawMl * 100; // Assuming U-100 syringe

            results.concentration.textContent = concentrationMgMl.toFixed(2) + ' mg/mL';
            results.ml.textContent = drawMl.toFixed(3) + ' mL';
            results.units.textContent = Math.round(units) + ' Units';
        };

        inputs.forEach(input => input.addEventListener('input', calculate));
        calculate();
    }

    // Age Verification Logic
    const ageModal = document.getElementById('age-verification-modal');
    const discountPopup = document.getElementById('first-visit-popup');
    const closeDiscountBtn = document.getElementById('close-popup');
    const discountForm = document.getElementById('popup-newsletter-form');

    // Flow Logic
    const showDiscountPopup = () => {
        if (discountPopup) {
            discountPopup.classList.remove('hidden');
            discountPopup.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }
    };

    const closeDiscountPopup = () => {
        discountPopup.classList.add('hidden');
        discountPopup.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    };

    window.verifyAge = function(isOver21) {
        if (isOver21) {
            localStorage.setItem('colton_age_verified', 'true');
            if (ageModal) {
                ageModal.classList.add('hidden');
                ageModal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }
            // Show discount popup after verification
            setTimeout(showDiscountPopup, 500);
        } else {
            window.location.href = "https://www.google.com";
        }
    };

    if (!localStorage.getItem('colton_age_verified')) {
        // Show age modal first after 1.5 seconds
        setTimeout(() => {
            if (ageModal) {
                ageModal.classList.remove('hidden');
                ageModal.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            }
        }, 1500);
    } else {
        // Age verified, show discount popup on every reload
        setTimeout(showDiscountPopup, 3000);
    }

    if (closeDiscountBtn) closeDiscountBtn.addEventListener('click', closeDiscountPopup);
    
    if (discountPopup) {
        discountPopup.addEventListener('click', (e) => {
            if (e.target === discountPopup) closeDiscountPopup();
        });
    }

    if (discountForm) {
        discountForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const submitBtn = discountForm.querySelector('button');
            submitBtn.textContent = 'THANK YOU!';
            submitBtn.classList.replace('bg-white', 'bg-green-500');
            submitBtn.classList.replace('text-primary', 'text-white');
            setTimeout(closeDiscountPopup, 1500);
        });
    }
});
</script>

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
