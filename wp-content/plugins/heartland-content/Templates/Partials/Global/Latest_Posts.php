<?php
use Heartland\Content\Main;
?>

<section class="latest-posts">

	<div class="content">

		<ul class="items-list">

			<?php foreach ( $posts as $index => $post ) : ?>

				<article class="item">

					<?php if ( ! empty( $post['image'] ) ) : ?>
                        <a href="<?php echo $post['permalink']; ?>">
							<img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" />
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

						<?php echo $post['date']; ?>
					</div>

            </article>

			<?php endforeach; ?>

		</ul>

    </div>

</section>
