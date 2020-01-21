<?php
/**
 * The main template file. Acts as a fallback if more specific templates don't exist.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 * @package WordPress
 *
 */

namespace Heartland;
?>

<?php echo get_header(); ?>

<body <?php body_class(); echo apply_filters( THEMEDOMAIN . '-body_attributes', '', 10 ); ?>>

    <?php do_action( THEMEDOMAIN . '-main-navigation' ); ?>

    <section
        class="<?php echo apply_filters( THEMEDOMAIN . '-page_class', 'main-content', 10 ); ?>"
        <?php echo apply_filters( THEMEDOMAIN . '-page_attributes', '', 10 ); ?>
    >

        <?php do_action( THEMEDOMAIN . '-before_main_content' ); ?>

        <main class="main" role="main">

            <?php the_content(); ?>

            <?php do_action( THEMEDOMAIN . '-main_content' ); ?>

        </main>

        <?php do_action( THEMEDOMAIN . '-after_main_content' ); ?>

	    <?php do_action( THEMEDOMAIN . '-footer' ); ?>

    </section>

    <?php get_template_part( 'templates/admin/adminbar' ); ?>

    <?php echo get_footer(); ?>

</body>

</html>
