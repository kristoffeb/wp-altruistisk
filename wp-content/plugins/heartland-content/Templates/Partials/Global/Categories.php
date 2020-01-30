<?php
use Heartland\Content\Main;
?>

<section class="list-categories">

	<div class="content">

		<ul class="categories">
			<?php foreach ( $categories as $term ) : ?>
				<li class="term">
					<a href="<?php echo get_site_url() . '/' . $term['slug']; ?>"><?php echo $term['name']; ?></a>
				</li>
			<?php endforeach; ?>
		</ul>

	</div>

</section>
