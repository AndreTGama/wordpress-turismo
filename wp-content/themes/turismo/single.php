<?php

/**
 * Template Name: Single
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div class="title">
		<h2>
			<?php the_title(); ?>
		</h2>
	</div>
	<?php the_content(); ?>
</div>

<?php get_footer(); ?>