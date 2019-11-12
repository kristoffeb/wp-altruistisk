<section class="section <?php echo $classes; ?>">

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
					<a href="<?php echo $data['button_cta']; ?>" download><?php echo $data['button_label']; ?></a>
	            </div>
	        <?php endif; ?>
	    </div>

	</div>

</section>
