<?php get_header(); ?>

<main class="container my-3">
    <?php if(have_posts(  )){
        while(have_posts(  )){
            the_post(  ); ?>
        <?php the_content( ); ?>
     <?php   }
    }
    ?>
</main>

<?php get_footer(); ?>