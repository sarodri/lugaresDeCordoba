<?php get_header(); ?>

<main class='container'>
     <!-- Genera el loop -->
     <?php if (have_posts()) {
        /* <!-- evalua si hay contenido o no --> */
        while(have_posts(  )){
            the_post(); ?>
         
            <?php the_content(); ?>
        <?php }
    }?>
</main>

<?php get_footer(); ?>