<?php
use Altruistisk\Content\Main;
?>

<section class="artists">

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

        	</article>

		<?php endforeach; ?>

    </div>

</section>
