<?php
use Heartland\Content\Main;
?>

<section class="latest-posts">

	<div class="content">

		<?php foreach ( $posts as $index => $post ) : ?>

			<article class="post">

				<?php if ( ! empty( $post['image'] ) ) : ?>
                    <a href="<?php echo $post['permalink']; ?>">
						<img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" class="featured-image" />
					</a>
                <?php endif; ?>

                <div class="title">
                    <h3>
						<a href="<?php echo $post['permalink']; ?>">
							<?php echo $post['title']; ?>
						</a>
					</h3>
                </div>

                <div class="excerpt">
                    <?php echo wpautop( $post['excerpt'] ); ?>
                </div>

				<div class="meta">
					<?php echo $post['category']; ?>

					<div class="date">
						<?php echo $post['date']; ?>
					</div>
				</div>

        	</article>

		<?php endforeach; ?>

    </div>

</section>
