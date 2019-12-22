<?php
use Mitfoerstejob\Content\Main;
?>

<section class="items <?php echo $classes; ?>">

	<div class="grid">

		<div class="content">
			<?php if ( $data['title'] ) : ?>
				<div class="headline">
		            <h2><?php echo $data['title']; ?></h2>
		        </div>
			<?php endif; ?>

			<?php if ( $data['subheadline'] ) : ?>
				<div class="subheadline">
		            <?php echo $data['subheadline']; ?>
		        </div>
			<?php endif; ?>

			<ul class="items-list">

				<?php foreach ( $items as $index => $item ) : ?>

					<?php Main::get_template_part( 'Partials/Global/Item_Loop.php', [ 'item' => $item ] ); ?>

				<?php endforeach; ?>

			</div>

			<?php if ( $data['pagination'] ) : ?>
				<div class="pagination">
					<?php echo sprintf( 'Pages: %s', $data['pagination'] ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $data['button_cta'] ) : ?>
	            <div class="cta">
					<a href="<?php echo get_permalink( $data['button_cta'] ); ?>"><?php echo $data['button_label']; ?></a>
	            </div>
	        <?php endif; ?>
	    </div>

	</div>

</section>
