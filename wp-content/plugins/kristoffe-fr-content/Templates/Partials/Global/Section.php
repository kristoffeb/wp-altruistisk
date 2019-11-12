<section class="section <?php echo $classes; ?>">

	<?php if ( $data['background_image'] !== '' ) : ?>
		<div class="background-image"
			<?php echo sprintf( 'style="background-image:url(%s);"', $data['background_image'] ); ?>
		></div>
	<?php endif; ?>

	<div class="grid">

		<div class="content">
			<?php if ( $data['subheadline'] !== '' ) : ?>
				<div class="subheadline">
		            <?php echo $data['subheadline']; ?>
		        </div>
			<?php endif; ?>

	        <div class="headline">
	            <h2><?php echo $data['title']; ?></h2>
	        </div>

	        <?php if ( $data['text'] !== '' ) : ?>
	            <div class="text">
	                <?php echo wpautop( $data['text'] ); ?>
	            </div>
	        <?php endif; ?>

	        <?php if ( $data['button_cta'] !== '' && $data['button_cta'] !== NULL ) : ?>
	            <div class="cta">
					<a href="<?php echo get_permalink( $data['button_cta'] ); ?>"><?php echo $data['button_label']; ?></a>
	            </div>
	        <?php endif; ?>

			<?php if ( $data['optin'] !== '' ) : ?>
	            <div class="inline_optin">
	                <?php echo $data['optin']; ?>
	            </div>
	        <?php endif; ?>
	    </div>

		<?php if ( $data['image'] !== '' && ! empty( $data['image'] ) ) : ?>
			<div class="image">
				<img src="<?php echo $data['image']; ?>" alt="<?php echo $data['title']; ?>" />
			</div>
		<?php endif; ?>

	</div>

</section>
