<?php
/**
 * Title: No Results Content
 * Slug: hello-plus/hidden-no-results-content
 * Inserter: no
 * Description: Displayed inside the query block when a search returns no results.
 *
 * @package HelloPlus
 * @since 1.4.0
 */

?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">

	<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}} -->
	<h2 class="wp-block-heading" style="margin-bottom:var(--wp--preset--spacing--30)"><?php echo esc_html_x( 'Nothing found', 'search results heading', 'hello-plus' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}}} -->
	<p style="margin-bottom:var(--wp--preset--spacing--40)"><?php echo esc_html_x( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'no search results message', 'hello-plus' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:search {"label":"<?php echo esc_attr_x( 'Search', 'label', 'hello-plus' ); ?>","showLabel":false,"placeholder":"<?php echo esc_attr_x( 'Search…', 'search input placeholder', 'hello-plus' ); ?>","buttonText":"<?php echo esc_attr_x( 'Search', 'search button label', 'hello-plus' ); ?>","buttonPosition":"button-inside","buttonUseIcon":true} /-->

</div>
<!-- /wp:group -->
