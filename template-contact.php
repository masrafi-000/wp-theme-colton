<?php
/**
 * Template Name: Contact Page
 *
 * @package Colton_Research
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! isset( $slug ) ) {
    get_header();
}
?>

<div class="min-h-screen">
	<div class="border-b border-border bg-card">
		<div class="container mx-auto py-12 px-4">
			<p class="text-primary text-xs tracking-[0.3em] uppercase font-semibold mb-2">Get in Touch</p>
			<h1 class="text-3xl md:text-5xl font-display font-bold text-foreground"><?php the_title(); ?></h1>
		</div>
	</div>

	<div class="container mx-auto py-16 px-4 reveal-on-scroll">
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
			<!-- Form -->
			<div class="space-y-6 text-left">
				<h2 class="text-xl font-display font-bold text-foreground">Send us a Message</h2>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php if ( ! get_the_content() ) : ?>
							<!-- Fallback static form if no content provided -->
							<form class="space-y-4" id="contact-form">
								<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
									<input type="text" name="name" placeholder="Name" class="px-4 py-3 rounded-lg bg-card border border-border text-foreground placeholder:text-muted-foreground text-sm focus:outline-none focus:ring-2 focus:ring-primary w-full" required />
									<input type="email" name="email" placeholder="Email" class="px-4 py-3 rounded-lg bg-card border border-border text-foreground placeholder:text-muted-foreground text-sm focus:outline-none focus:ring-2 focus:ring-primary w-full" required />
								</div>
								<input type="text" name="subject" placeholder="Subject" class="w-full px-4 py-3 rounded-lg bg-card border border-border text-foreground placeholder:text-muted-foreground text-sm focus:outline-none focus:ring-2 focus:ring-primary" />
								<textarea name="message" placeholder="Your message..." rows="6" class="w-full px-4 py-3 rounded-lg bg-card border border-border text-foreground placeholder:text-muted-foreground text-sm focus:outline-none focus:ring-2 focus:ring-primary resize-none" required></textarea>
								<button type="submit" class="bg-primary text-primary-foreground hover:bg-gold-light px-8 py-3 rounded-md font-semibold transition-colors btn-hover-effect">Send Message</button>
                                <?php wp_nonce_field( 'colton_contact_nonce', 'contact_nonce' ); ?>
							</form>
                            <div id="contact-feedback" class="text-sm mt-4 h-5"></div>
						<?php endif; ?>
					</div>
				<?php endwhile; endif; ?>
			</div>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('contact-form');
                const feedback = document.getElementById('contact-feedback');

                if (form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        feedback.textContent = 'Sending message...';
                        feedback.className = 'text-sm mt-4 h-5 text-muted-foreground';

                        const formData = new FormData(form);
                        formData.append('action', 'colton_contact_submission');

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
                }
            });
            </script>

			<!-- Contact Info -->
			<div class="space-y-8 text-left">
				<h2 class="text-xl font-display font-bold text-foreground">Contact Information</h2>
				<div class="flex gap-4">
					<div class="h-10 w-10 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-primary"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
					</div>
					<div>
						<p class="text-sm font-semibold text-foreground">Email</p>
						<p class="text-sm text-muted-foreground">support@peptideresearchlab.com</p>
					</div>
				</div>
				<div class="flex gap-4">
					<div class="h-10 w-10 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-primary"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
					</div>
					<div>
						<p class="text-sm font-semibold text-foreground">Phone</p>
						<p class="text-sm text-muted-foreground">+1 (555) 123-4567</p>
					</div>
				</div>
				<div class="flex gap-4">
					<div class="h-10 w-10 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-primary"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
					</div>
					<div>
						<p class="text-sm font-semibold text-foreground">Address</p>
						<p class="text-sm text-muted-foreground whitespace-pre-line">123 Research Blvd, Suite 400
Science Park, CA 92101</p>
					</div>
				</div>

				<div class="bg-gradient-card border border-border rounded-lg p-6 mt-8 btn-hover-effect">
					<h3 class="font-display font-semibold text-foreground mb-2">Business Hours</h3>
					<p class="text-sm text-muted-foreground">Monday – Friday: 9:00 AM – 5:00 PM PST</p>
					<p class="text-sm text-muted-foreground">Saturday – Sunday: Closed</p>
					<p class="text-xs text-muted-foreground mt-3">Response time: Within 24 business hours</p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
