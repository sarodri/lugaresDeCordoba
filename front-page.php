<?php get_header(); ?>

<main class="container">
    <?php if(have_posts(  )){
        while(have_posts(  )){
            the_post(  ); ?>
        <h1 class="my-4"><?php the_title(  ); ?></h1>
        <?php the_content( ); ?>
     <?php   }
    }
    ?>
</main>

<?php get_footer(); ?>