<?php
use Altruistisk\Content\Main;
?>

<section class="list-categories">

	<div class="content">

		<ul class="categories">
			<?php foreach ( $categories as $term ) : ?>
				<li class="term <?php echo ( $term['slug'] === get_post_field( 'post_name' ) ? 'active' : '' ); ?>">
					<a href="<?php echo get_site_url() . '/' . $term['slug']; ?>"><?php echo $term['name']; ?></a>
				</li>
			<?php endforeach; ?>
		</ul>

	</div>

</section>
