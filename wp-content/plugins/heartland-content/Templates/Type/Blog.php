<div class="inner-grid">

	<div class="title">
		<h2><?php echo $title; ?>
	</div>

	<div class="list-categories">
		<ul>
			<?php foreach ( $categories as $term ) : ?>
				<li>
					<a href="<?php echo $term['permalink']; ?>"><?php echo $term['name']; ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<?php echo $grid; ?>
</div>
