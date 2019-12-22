<?php while ( have_posts() ) : the_post(); ?>

	<article id="article-<?php the_ID(); ?>" <?php post_class( 'article' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

		<div class="grid">

			<header class="article-header">

				<?php if ( has_category() ) : ?>
					<div class="article-categories">
						<?php _e( 'Eat Happy Blog <span>/</span>' ); ?>
						<?php the_category(); ?>
					</div>
				<?php endif; ?>

				<h1 class="article-title" itemprop="name headline"><?php the_title(); ?></h1>

			</header>

			<div class="article-content" itemprop="articleBody">

				<div class="content">
					<?php the_content(); ?>
				</div>

			</div>

			<footer class="article-footer">
				<p class="meta article-meta">
					<time class="date" datetime="<?php echo the_time( 'Y-m-d' ); ?>" itemprop="datePublished"><?php the_time( 'j. F Y' ); ?></time><span class="sep">, </span><?php _e( 'by', THEMEDOMAIN ); ?> <span itemprop="author" itemscope itemtype="http://schema.org/Person" class="author"><span itemprop="name" class="fn"><?php the_author_posts_link(); ?></span></span>
				</p>
			</footer>

		</div>

	</article>

<?php endwhile; ?>
