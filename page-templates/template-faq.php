<?php
/**
 * Template Name: FAQ Page
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
			<p class="text-primary text-xs tracking-[0.3em] uppercase font-semibold mb-2">Support</p>
			<h1 class="text-3xl md:text-5xl font-display font-bold text-foreground"><?php the_title(); ?></h1>
		</div>
	</div>

	<div class="container mx-auto py-16 px-4 max-w-3xl reveal-on-scroll">
		<div class="space-y-3">
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
					"a" => "Every batch undergoes HPLC (High-Performance Liquid Chromatography) analysis, mass spectrometry verification, and endotoxin testing. We provide third-party validated Certificates of Analysis with every order."
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
				<div class="border border-border rounded-lg overflow-hidden faq-item">
					<button class="w-full flex items-center justify-between p-5 text-left hover:bg-secondary/30 transition-all duration-300 faq-toggle btn-hover-effect">
						<span class="font-display font-semibold text-foreground text-sm pr-4"><?php echo $faq['q']; ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-muted-foreground shrink-0 transition-transform faq-icon"><path d="m6 9 6 6 6-6"/></svg>
					</button>
					<div class="px-5 pb-5 hidden faq-content">
						<p class="text-sm text-muted-foreground leading-relaxed"><?php echo $faq['a']; ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            const toggle = item.querySelector('.faq-toggle');
            const content = item.querySelector('.faq-content');
            const icon = item.querySelector('.faq-icon');
            
            toggle.addEventListener('click', () => {
                const isOpen = !content.classList.contains('hidden');
                
                // Close all other items
                document.querySelectorAll('.faq-content').forEach(c => c.classList.add('hidden'));
                document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove('rotate-180'));
                
                if (!isOpen) {
                    content.classList.remove('hidden');
                    icon.classList.add('rotate-180');
                }
            });
        });
    });
</script>

<?php
get_footer();
