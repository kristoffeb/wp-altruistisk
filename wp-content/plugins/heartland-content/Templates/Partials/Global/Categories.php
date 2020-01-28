<?php
use Heartland\Content\Main;
?>

<section class="list-categories">

	<div class="content">

		<ul>
			<?php foreach ( $categories as $term ) : ?>
				<li>
					<a href="<?php echo get_site_url() . '/' . $term['slug']; ?>"><?php echo $term['name']; ?></a>
				</li>
			<?php endforeach; ?>
		</ul>

	</div>

</section>
