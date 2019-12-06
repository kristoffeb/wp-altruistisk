<section class="testimonial">

	<div class="grid">

		<div class="content">
			<?php if ( $data['image'] ) : ?>
				<div class="image" style="background-image: url(<?php echo $data['image']; ?>);"></div>
			<?php endif; ?>

			<?php if ( $data['quote_author'] ) : ?>
				<div class="author">
		            <?php echo wpautop( $data['quote_author'] ); ?>
		        </div>
			<?php endif; ?>

	        <?php if ( $data['quote'] ) : ?>
	            <blockquote class="quote">
	                <?php echo wpautop( $data['quote'] ); ?>
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
