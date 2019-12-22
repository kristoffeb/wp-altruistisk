<?php
use Mitfoerstejob\Content\Main;
?>

<li class="item <?php echo ( isset( $item['class'] ) ? $item['class'] : '' ); ?>">

	<?php if ( ! empty( $item['cta'] ) ) : ?>
		<a href="<?php echo $item['cta']; ?>">
	<?php endif; ?>

			<?php if ( ! empty( $item['thumbnail'] ) ) : ?>
				<div class="thumbnail">
					<img
						src="<?php echo $item['thumbnail']; ?>"
						alt="<?php echo ( ! empty( $item['title'] ) ? $item['title'] : '' ); ?>"
					/>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $item['title'] ) ) : ?>
				<div class="title">
					<?php echo $item['title']; ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $item['subheadline'] ) ) : ?>
				<div class="subheadline">
					<?php echo $item['subheadline']; ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $item['text'] ) ) : ?>
				<div class="text">
					<?php echo $item['text']; ?>
				</div>
			<?php endif; ?>


	<?php if ( ! empty( $item['cta'] ) ) : ?>
		</a>
	<?php endif; ?>
</li>
