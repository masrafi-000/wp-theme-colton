<?php
/**
 * Template Name: About Page
 *
 * @package Colton_Research
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_page( 'about' ) || ! isset( $slug ) ) {
    get_header();
}
?>

<div class="min-h-screen">
	<div class="border-b border-border bg-card">
		<div class="container mx-auto py-16 px-4">
			<p class="text-primary text-xs tracking-[0.3em] uppercase font-semibold mb-2">Our Mission</p>
			<h1 class="text-3xl md:text-5xl font-display font-bold text-foreground">About Us</h1>
			<p class="text-muted-foreground mt-4 max-w-2xl leading-relaxed">
				Halopeptideco.com is committed to supplying high-quality research peptides to laboratories, researchers, and scientific professionals worldwide.
			</p>
		</div>
	</div>

	<div class="container mx-auto py-16 px-4 space-y-20">
		<!-- About Us Content -->
		<section class="reveal-on-scroll">
			<div class="max-w-4xl mx-auto space-y-8 text-left">
				<div class="prose prose-invert max-w-none text-muted-foreground leading-relaxed space-y-6">
					<p>Our mission is to provide reliable research compounds that meet strict quality standards while maintaining exceptional service and transparency for our customers.</p>
					<p>We work with trusted manufacturing partners to ensure our peptides are synthesized, lyophilized, and tested using rigorous quality control protocols. Every batch undergoes verification processes designed to ensure purity, stability, and consistency, allowing researchers to conduct their work with confidence.</p>
					<p>At Halopeptideco.com, we understand the importance of dependable materials in scientific research. Our goal is to make high-quality research compounds accessible while delivering a customer experience built on trust, efficiency, and professionalism.</p>
				</div>
			</div>
		</section>

		<!-- Why Choose Us -->
		<section class="reveal-on-scroll bg-secondary/30 rounded-[40px] p-8 md:p-16">
			<h2 class="text-3xl md:text-4xl font-display font-bold text-foreground mb-12 text-center">
				Why <span class="text-primary">Choose Us</span>
			</h2>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
				<div class="bg-card border border-border p-8 rounded-3xl hover:border-primary/50 transition-all duration-300">
					<div class="h-12 w-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
					</div>
					<h3 class="text-xl font-display font-bold text-foreground mb-4">Premium Quality Standards</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">Our peptides are manufactured in controlled environments and undergo strict quality assurance procedures. Each product is produced with a focus on purity, stability, and reliability to support laboratory research needs.</p>
				</div>
				<div class="bg-card border border-border p-8 rounded-3xl hover:border-primary/50 transition-all duration-300">
					<div class="h-12 w-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
					</div>
					<h3 class="text-xl font-display font-bold text-foreground mb-4">Extensive Product Selection</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">We offer a growing catalog of research peptides designed to support a wide range of laboratory applications. Whether you are looking for individual compounds, peptide blends, or custom orders, our team is dedicated to helping meet your research requirements.</p>
				</div>
				<div class="bg-card border border-border p-8 rounded-3xl hover:border-primary/50 transition-all duration-300">
					<div class="h-12 w-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><circle cx="19" cy="11" r="3"></circle></svg>
					</div>
					<h3 class="text-xl font-display font-bold text-foreground mb-4">Reliable Customer Support</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">Our team is committed to providing responsive and knowledgeable customer service. We believe in building long-term relationships with researchers, laboratories, and institutions by providing reliable communication and support throughout the ordering process.</p>
				</div>
				<div class="bg-card border border-border p-8 rounded-3xl hover:border-primary/50 transition-all duration-300">
					<div class="h-12 w-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
					</div>
					<h3 class="text-xl font-display font-bold text-foreground mb-4">Fast and Secure Shipping</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">We understand that timely delivery is important for research workflows. Our streamlined order processing and shipping system ensures that orders are handled efficiently and delivered as quickly as possible.</p>
				</div>
			</div>
		</section>

		<!-- Our Commitment to Research -->
		<section class="reveal-on-scroll max-w-4xl mx-auto text-left space-y-6">
			<h2 class="text-2xl md:text-3xl font-display font-bold text-foreground">Our Commitment to <span class="text-primary">Research</span></h2>
			<div class="prose prose-invert max-w-none text-muted-foreground space-y-4">
				<p>At Halopeptideco.com, we are committed to supporting the advancement of scientific discovery by providing dependable research materials. We continually strive to improve our processes, expand our catalog, and maintain the highest standards of quality and service.</p>
				<p class="p-6 bg-primary/5 border-l-4 border-primary rounded-r-xl italic text-sm">
					All products offered by Halopeptideco.com are intended strictly for laboratory research purposes only and are not intended for human or animal consumption.
				</p>
			</div>
		</section>

		<!-- Contact Us -->
		<section class="reveal-on-scroll max-w-4xl mx-auto text-left space-y-6">
			<h2 class="text-2xl md:text-3xl font-display font-bold text-foreground">Contact Us</h2>
			<p class="text-muted-foreground leading-relaxed">
				If you have questions about our products, require assistance with an order, or would like to inquire about custom peptide requests, please visit our <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="text-primary hover:underline font-bold">Contact page</a> and our team will be happy to assist you.
			</p>
		</section>

		<!-- Terms and Conditions Section (Anchor) -->
		<section id="terms" class="reveal-on-scroll pt-20 border-t border-border">
			<h2 class="text-3xl md:text-4xl font-display font-bold text-foreground mb-12 text-center">
				Terms and <span class="text-primary">Conditions</span>
			</h2>
			<div class="max-w-4xl mx-auto bg-card border border-border p-8 md:p-12 rounded-[40px] shadow-2xl space-y-10 text-left">
				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">1. Introduction</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">Welcome to Halopeptideco.com (“Website,” “Company,” “we,” “our,” or “us”). By accessing or using this Website, you (“User,” “Customer,” or “you”) agree to comply with and be bound by the following Terms and Conditions (“Agreement”), as well as our Privacy Policy, which is incorporated herein by reference.</p>
					<p class="text-muted-foreground text-sm leading-relaxed">If you do not agree with any portion of these Terms and Conditions, you must discontinue use of the Website immediately.</p>
					<p class="text-muted-foreground text-sm leading-relaxed">By accessing or using this Website, you acknowledge that this Agreement constitutes a legally binding agreement between you and the Company. We reserve the right to modify or update these Terms at any time without prior notice. Continued use of the Website following any changes constitutes acceptance of the revised Terms.</p>
					<p class="text-muted-foreground text-sm leading-relaxed font-bold italic">By using this Website, you represent and warrant that you are at least twenty-one (21) years of age and possess the legal capacity to enter into this Agreement.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">2. Intellectual Property</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">All content on this Website, including but not limited to text, graphics, images, logos, product descriptions, videos, software, and design elements, is the property of the Company or its licensors and is protected by applicable intellectual property laws.</p>
					<p class="text-muted-foreground text-sm leading-relaxed">Users may not reproduce, distribute, modify, transmit, republish, display, or otherwise exploit any Website content without the prior written consent of the Company.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">3. Use of Website</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">Users agree to use this Website only for lawful purposes and in accordance with these Terms. Users agree not to:</p>
					<ul class="list-disc pl-5 text-muted-foreground text-sm space-y-2">
						<li>Violate any applicable laws or regulations</li>
						<li>Attempt to gain unauthorized access to the Website</li>
						<li>Use the Website for any fraudulent or harmful activity</li>
						<li>Copy, scrape, or exploit Website data for commercial use without authorization</li>
					</ul>
				</div>

				<div class="space-y-4 p-6 bg-red-500/5 border border-red-500/20 rounded-2xl">
					<h3 class="text-xl font-display font-bold text-red-500 uppercase tracking-tight">4. Research Use Only Disclaimer</h3>
					<p class="text-foreground text-sm font-bold">All products sold on this Website are intended strictly for laboratory research purposes only.</p>
					<p class="text-muted-foreground text-sm leading-relaxed">By purchasing from this Website, you acknowledge and agree that:</p>
					<ul class="list-disc pl-5 text-muted-foreground text-sm space-y-2">
						<li>Products are not intended for human consumption</li>
						<li>Products are not intended for animal use</li>
						<li>Products are not intended for therapeutic or diagnostic use</li>
						<li>Products are not intended to treat, cure, diagnose, or prevent any disease</li>
					</ul>
					<p class="text-muted-foreground text-sm leading-relaxed">Products sold on this Website are not dietary supplements, drugs, cosmetics, food additives, or medical devices.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">5. FDA Disclaimer</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">The products offered on this Website have not been evaluated or approved by the U.S. Food and Drug Administration (FDA). No statements made on this Website regarding products are intended to diagnose, treat, cure, or prevent any disease or medical condition.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">6. Qualified Purchasers</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">By purchasing from this Website, the customer represents and warrants that they are at least 21 years of age, qualified professionals, researchers, laboratories, or institutions, have the necessary training and expertise to safely handle research chemicals, and understand the potential hazards associated with research compounds.</p>
					<p class="text-muted-foreground text-sm leading-relaxed">The purchaser assumes full responsibility for ensuring compliance with all applicable local, state, federal, and international laws regarding the purchase, possession, and use of products.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">7. Product Handling and Use</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">By purchasing from this Website, the customer agrees that:</p>
					<ul class="list-disc pl-5 text-muted-foreground text-sm space-y-2">
						<li>Products will be used only for legitimate laboratory research purposes</li>
						<li>Products will not be used for human or animal consumption</li>
						<li>Products will not be used in clinical trials, drug manufacturing, or consumer products</li>
						<li>Products will be handled only by qualified professionals in controlled research environments</li>
					</ul>
					<p class="text-muted-foreground text-sm leading-relaxed">The purchaser assumes full responsibility for verifying safety information and regulatory compliance prior to use.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">8. Pricing and Product Availability</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">All prices listed on the Website are subject to change without notice. The Company reserves the right to modify product pricing, discontinue products, limit quantities, or refuse any order.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">9. Orders and Payment</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">By placing an order, you agree that all information provided during checkout is accurate and complete, payment will be processed prior to shipment, and the Company may cancel or refuse orders at its discretion.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">10. Shipping Disclaimer</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">The Company will make reasonable efforts to ship orders promptly; however, we are not responsible for delays caused by shipping carriers, customs processing, supply chain disruptions, or natural disasters. The Company is not responsible for lost, stolen, or delayed packages once they have been transferred to the shipping carrier.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">11. Return Policy</h3>
					<p class="text-muted-foreground text-sm leading-relaxed font-bold">Due to the sensitive nature of research chemicals, all sales are final. Returns, refunds, or exchanges will not be accepted unless required by applicable law.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">12. Limitation of Liability</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">To the fullest extent permitted by law, the Company shall not be liable for any direct, indirect, incidental, consequential, or special damages arising from use or misuse of any product, improper handling, reliance on information provided on the Website, or inability to access the Website.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">13. Indemnification</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">By using this Website or purchasing products, you agree to indemnify, defend, and hold harmless the Company and its owners, employees, officers, affiliates, and agents from any claims, liabilities, damages, losses, or expenses arising out of your use of the Website, your misuse of products, or your violation of these Terms.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">14. Website Availability</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">While we strive to keep the Website operational at all times, we do not guarantee uninterrupted access. The Company shall not be responsible for any damages resulting from temporary outages, maintenance, or technical issues.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">15. Governing Law</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">These Terms and Conditions shall be governed by and interpreted in accordance with the laws of the jurisdiction in which the Company operates, without regard to conflict of law principles.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">16. Severability</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">If any provision of these Terms is determined to be invalid or unenforceable by a court of competent jurisdiction, the remaining provisions shall remain in full force and effect.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">17. Entire Agreement</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">These Terms and Conditions, together with the Privacy Policy and any other legal notices posted on the Website, constitute the entire agreement between the User and the Company regarding use of the Website and purchase of products.</p>
				</div>

				<div class="space-y-4">
					<h3 class="text-xl font-display font-bold text-foreground uppercase tracking-tight">18. Acceptance of Terms</h3>
					<p class="text-muted-foreground text-sm leading-relaxed">By accessing this Website or purchasing products, you acknowledge that you have read, understood, and agreed to these Terms and Conditions.</p>
				</div>
			</div>
		</section>
	</div>
</div>
</div>

<?php
get_footer();
