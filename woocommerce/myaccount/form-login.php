<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="max-w-xl mx-auto px-4 py-20" id="customer_login">
    
    <!-- Auth Toggle Buttons -->
    <div class="flex p-1 bg-secondary/50 rounded-2xl mb-12 max-w-sm mx-auto border border-border">
        <button id="show-login" class="flex-1 py-3 text-xs font-bold uppercase tracking-[0.2em] rounded-xl transition-all bg-white text-brand-blue shadow-sm">
            Login
        </button>
        <button id="show-register" class="flex-1 py-3 text-xs font-bold uppercase tracking-[0.2em] rounded-xl transition-all text-muted-foreground hover:text-foreground">
            Register
        </button>
    </div>

    <!-- Login Section -->
    <div id="login-container" class="space-y-10 bg-white border border-border rounded-2xl p-8 md:p-12 shadow-sm animate-fade-in">
        <div class="space-y-2 text-center">
            <h2 class="text-3xl font-display font-bold text-foreground"><?php esc_html_e( 'Welcome Back', 'woocommerce' ); ?></h2>
            <p class="text-sm text-muted-foreground">Access your research dashboard and orders.</p>
        </div>

        <form class="woocommerce-form woocommerce-form-login login space-y-6" method="post">
            <?php do_action( 'woocommerce_login_form_start' ); ?>

            <div class="space-y-2">
                <label for="username" class="text-[11px] font-bold uppercase tracking-widest text-muted-foreground"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>&nbsp;<span class="required text-brand-blue">*</span></label>
                <input type="text" class="w-full bg-secondary/30 border border-border rounded-xl py-4 px-6 focus:outline-none focus:border-brand-blue/50 focus:ring-4 focus:ring-brand-blue/5 transition-all" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
            </div>

            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <label for="password" class="text-[11px] font-bold uppercase tracking-widest text-muted-foreground"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required text-brand-blue">*</span></label>
                    <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="text-[11px] font-bold text-brand-blue hover:underline uppercase tracking-widest"><?php esc_html_e( 'Forgot?', 'woocommerce' ); ?></a>
                </div>
                <input class="w-full bg-secondary/30 border border-border rounded-xl py-4 px-6 focus:outline-none focus:border-brand-blue/50 focus:ring-4 focus:ring-brand-blue/5 transition-all" type="password" name="password" id="password" autocomplete="current-password" />
            </div>

            <?php do_action( 'woocommerce_login_form' ); ?>

            <div class="flex items-center justify-between py-2">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input class="w-5 h-5 rounded border-border text-brand-blue focus:ring-brand-blue transition-all" name="rememberme" type="checkbox" id="rememberme" value="forever" /> 
                    <span class="text-sm font-medium text-muted-foreground group-hover:text-foreground transition-colors"><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                </label>
            </div>

            <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
            
            <button type="submit" class="w-full bg-brand-blue hover:bg-brand-blue-dark text-white font-bold py-5 rounded-xl flex items-center justify-center gap-3 uppercase tracking-[0.2em] text-[13px] transition-all duration-300 shadow-lg shadow-brand-blue/20" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
                <?php esc_html_e( 'Log in', 'woocommerce' ); ?>
            </button>

            <?php do_action( 'woocommerce_login_form_end' ); ?>
        </form>
    </div>

    <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

        <!-- Register Section -->
        <div id="register-container" class="hidden space-y-10 bg-white border border-border rounded-2xl p-8 md:p-12 shadow-sm animate-fade-in">
            <div class="space-y-2 text-center">
                <h2 class="text-3xl font-display font-bold text-foreground"><?php esc_html_e( 'Create Account', 'woocommerce' ); ?></h2>
                <p class="text-sm text-muted-foreground">Join our community of research experts.</p>
            </div>

            <form method="post" class="woocommerce-form woocommerce-form-register register space-y-6" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
                <?php do_action( 'woocommerce_register_form_start' ); ?>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                    <div class="space-y-2">
                        <label for="reg_username" class="text-[11px] font-bold uppercase tracking-widest text-muted-foreground"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required text-brand-blue">*</span></label>
                        <input type="text" class="w-full bg-secondary/30 border border-border rounded-xl py-4 px-6 focus:outline-none focus:border-brand-blue/50 focus:ring-4 focus:ring-brand-blue/5 transition-all" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
                    </div>
                <?php endif; ?>

                <div class="space-y-2">
                    <label for="reg_email" class="text-[11px] font-bold uppercase tracking-widest text-muted-foreground"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required text-brand-blue">*</span></label>
                    <input type="email" class="w-full bg-secondary/30 border border-border rounded-xl py-4 px-6 focus:outline-none focus:border-brand-blue/50 focus:ring-4 focus:ring-brand-blue/5 transition-all" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" />
                </div>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                    <div class="space-y-2">
                        <label for="reg_password" class="text-[11px] font-bold uppercase tracking-widest text-muted-foreground"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required text-brand-blue">*</span></label>
                        <input type="password" class="w-full bg-secondary/30 border border-border rounded-xl py-4 px-6 focus:outline-none focus:border-brand-blue/50 focus:ring-4 focus:ring-brand-blue/5 transition-all" name="password" id="reg_password" autocomplete="new-password" />
                    </div>
                <?php endif; ?>

                <?php do_action( 'woocommerce_register_form' ); ?>

                <div class="py-2">
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        By registering, you agree to our <a href="#" class="text-brand-blue hover:underline font-bold">Terms</a> and <a href="#" class="text-brand-blue hover:underline font-bold">Privacy</a>. 
                        <span class="block mt-2 font-bold text-brand-blue">Email verification link will be sent.</span>
                    </p>
                </div>

                <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                
                <button type="submit" class="w-full bg-foreground hover:bg-foreground/90 text-white font-bold py-5 rounded-xl flex items-center justify-center gap-3 uppercase tracking-[0.2em] text-[13px] transition-all duration-300 shadow-lg" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                    <?php esc_html_e( 'Register', 'woocommerce' ); ?>
                </button>

                <?php do_action( 'woocommerce_register_form_end' ); ?>
            </form>
        </div>

    <?php endif; ?>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const showLogin = document.getElementById('show-login');
    const showRegister = document.getElementById('show-register');
    const loginContainer = document.getElementById('login-container');
    const registerContainer = document.getElementById('register-container');

    if (showLogin && showRegister) {
        showLogin.addEventListener('click', function() {
            loginContainer.classList.remove('hidden');
            registerContainer.classList.add('hidden');
            
            showLogin.classList.add('bg-white', 'text-brand-blue', 'shadow-sm');
            showLogin.classList.remove('text-muted-foreground');
            
            showRegister.classList.remove('bg-white', 'text-brand-blue', 'shadow-sm');
            showRegister.classList.add('text-muted-foreground');
        });

        showRegister.addEventListener('click', function() {
            loginContainer.classList.add('hidden');
            registerContainer.classList.remove('hidden');
            
            showRegister.classList.add('bg-white', 'text-brand-blue', 'shadow-sm');
            showRegister.classList.remove('text-muted-foreground');
            
            showLogin.classList.remove('bg-white', 'text-brand-blue', 'shadow-sm');
            showLogin.classList.add('text-muted-foreground');
        });
    }
    
    // Auto-show register if URL has hash or parameter (optional)
    if (window.location.hash === '#register' || window.location.search.includes('action=register')) {
        showRegister.click();
    }
});
</script>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
