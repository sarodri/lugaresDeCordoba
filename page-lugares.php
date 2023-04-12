<?php get_header(); ?>

<main class='container my-3' id="lugares">
     <?php if (have_posts()) {
        while(have_posts(  )){
            the_post(); ?>
            <!-- <h1 class="my-7"><?php the_title(); ?></h1> -->
            <?php the_content(); ?>
        <?php }
    }?>

    <div class="lugares">
        <h2 class="text-center">LUGARES DE CÓRDOBA</h2>
        <div class="row">
        <?php 
        $args = array(
            'post_type' => 'lugar',
            'post_per_page' => -1,  
            'order' => 'ASC',
            'order_by' => 'title'  
        );

        $lugares = new WP_Query($args);
        
        if($lugares->have_posts()){
            while($lugares ->have_posts()){
                $lugares-> the_post();
            ?>

                <div class="col-4" id="page">
                    <figure>
                        <?php the_post_thumbnail('large'); ?>
                    </figure>
                    <h4 class="my-3 text-center">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                </div>

        <?php } 
        }
        ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>