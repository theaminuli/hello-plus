<?php
/**
 * The main template file
 *
 * @package HelloPlus
 */

get_header(); ?>

<main id="main" class="site-main">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php if ( is_singular() ) : ?>
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php else : ?>
						<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					<?php endif; ?>
				</header>

				<div class="entry-content">
					<?php
					if ( is_singular() ) {
						the_content();
					} else {
						the_excerpt();
					}
					?>
				</div>
			</article>
		<?php endwhile; ?>
		
		<?php the_posts_navigation(); ?>
	<?php else : ?>
		<section class="no-results not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Nothing here', 'hello-plus' ); ?></h1>
			</header>

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'hello-plus' ); ?></p>
			</div>
		</section>
	<?php endif; ?>
</main>

<?php get_footer(); ?>