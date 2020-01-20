<section class="hero <?php echo ( $is_hero ? '' : 'inline' ); ?> <?php echo $classes; ?>">

    <?php if ( $hero['image'] ) : ?>
        <div class="image" style="background-image: url(<?php echo $hero['image']; ?>);"></div>
    <?php endif; ?>

    <?php do_action( THEMEDOMAIN . '-before_hero_content' ); ?>

    <div class="content">
		<div class="subheadline">
            <a href="<?php echo get_permalink( $hero['button_cta'] ); ?>">
                <?php echo $hero['subheadline']; ?>
            </a>
        </div>

        <div class="headline">
            <?php if ( $is_hero ) : ?>
                <h1>
            <?php else : ?>
                <h2>
            <?php endif; ?>

                <?php if ( $hero['button_cta'] ) : ?>
                    <a href="<?php echo get_permalink( $hero['button_cta'] ); ?>">
                <?php endif ;?>

                    <?php echo $hero['title']; ?>

                <?php if ( $hero['button_cta'] ) : ?>
                    </a>
                <?php endif ;?>

            <?php if ( $is_hero ) : ?>
                </h1>
            <?php else : ?>
                </h2>
            <?php endif; ?>
        </div>

        <?php if ( $hero['text'] ) : ?>
            <div class="text">
                <?php echo $hero['text']; ?>
            </div>
        <?php endif; ?>

        <?php if ( $hero['button_cta'] ) : ?>
            <div class="cta">
                <a href="<?php echo get_permalink( $hero['button_cta'] ); ?>">
                    <?php echo $hero['button_label']; ?>
                </a>
            </div>
        <?php endif; ?>

    </div>

    <?php do_action( THEMEDOMAIN . '-after_hero_content' ); ?>

</section>
