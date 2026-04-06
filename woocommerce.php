<?php
/**
 * The WooCommerce template file
 *
 * @package Colton_Research
 */

get_header();
?>

<div class="container mx-auto py-12 px-4 min-h-[60vh]">
	<div class="entry-content w-full max-w-none">
		<?php woocommerce_content(); ?>
	</div>
</div>

<?php
get_footer();

