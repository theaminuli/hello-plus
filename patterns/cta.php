<?php
/**
 * Title: Call to Action
 * Slug: hello-plus/cta
 * Categories: featured, call-to-action
 * Description: A full-width call-to-action section with heading, description, and button.
 *
 * @package HelloPlus
 * @since 1.4.0
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}},"backgroundColor":"primary","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-primary-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--30)">

	<!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}} -->
	<h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--30)"><?php echo esc_html_x( 'Ready to get started?', 'CTA heading', 'hello-plus' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}},"typography":{"fontSize":"var(--wp--preset--font-size--medium)"}}} -->
	<p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--40);font-size:var(--wp--preset--font-size--medium)"><?php echo esc_html_x( 'Build something beautiful with Hello Plus — the fast, flexible WordPress theme designed for everyone.', 'CTA description', 'hello-plus' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button {"backgroundColor":"contrast","textColor":"base"} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-base-color has-contrast-background-color has-text-color has-background wp-element-button" href="#"><?php echo esc_html_x( 'Get Started', 'CTA button label', 'hello-plus' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->

</div>
<!-- /wp:group -->
