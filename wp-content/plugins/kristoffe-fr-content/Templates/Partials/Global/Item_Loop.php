<?php
use Kristoffe\Content\Main;
?>

<li class="item <?php echo ( isset( $item['class'] ) ? $item['class'] : '' ); ?> <?php echo ( empty( $item['title'] ) ? 'empty' : '' ); ?>">

	<?php if ( ! empty( $item['cta'] ) ) : ?>
		<a href="<?php echo $item['cta']; ?>">
	<?php endif; ?>

			<?php if ( ! empty( $item['background_image'] ) ) : ?>
				<div class="image" style="background-image: url(<?php echo $item['background_image']; ?>)"></div>
			<?php endif; ?>

			<?php if ( ! empty( $item['image_id'] ) ) : ?>
				<div class="image">
					<img
						src="<?php echo wp_get_attachment_image_src( $item['image_id'], 'kristoffe-item' )[0]; ?>"
						alt="<?php echo ( ! empty( $item['title'] ) ? $item['title'] : '' ); ?>"
					/>
				</div>
			<?php elseif ( ! empty( $item['image'] ) ) : ?>
				<div class="image">
					<img
						src="<?php echo $item['image']; ?>"
						alt="<?php echo ( ! empty( $item['title'] ) ? $item['title'] : '' ); ?>"
					/>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $item['subheadline'] ) ) : ?>
				<div class="subheadline">
					<?php echo $item['subheadline']; ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $item['title'] ) ) : ?>
				<div class="title">
					<?php echo $item['title']; ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $item['text'] ) ) : ?>
				<div class="text">
					<?php echo $item['text']; ?>
				</div>
			<?php endif; ?>

			<?php if ( is_shop() ) : ?>
				<?php if ( $item['in_stock'] ) : ?>
					<div class="price">
						<?php echo $item['price']; ?>
					</div>

					<div class="button">
						<a rel="no-follow" href="<?php echo $item['cta'] . '/?add-to-cart=' . $item['button']; ?>" data-quantity="1" data-product_id="<?php echo $item['button']; ?>" data-product_sku class="button product_type_simple add_to_cart_button ajax_add_to_cart">
							<?php _e( 'Add to cart', Main::TEXT_DOMAIN ); ?>
						</a>
					</div>
				<?php else : ?>
					<div class="price">
						<span><?php _e( 'Coming soon', Main::TEXT_DOMAIN ); ?></span>
					</div>

					<div class="button">
						<a href="<?php echo $item['cta']; ?>" class="button">
							<?php _e( 'Read more', Main::TEXT_DOMAIN ); ?>
						</a>
					</div>
				<?php endif; ?>
			<?php endif; ?>

	<?php if ( ! empty( $item['cta'] ) ) : ?>
		</a>
	<?php endif; ?>
</li>
