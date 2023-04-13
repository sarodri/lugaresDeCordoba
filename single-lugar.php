<?php get_header( ); ?>

<main class='container my-3'>
    <?php if(have_posts(  )){
        while(have_posts(  )){
            the_post(  );?>
            <h1 class='my-6'><?php the_title( ); ?></h1>
            <div class="row">
                <!-- <div class="col-md-6 col-12" id="lugares-page">
                <img src="<?php echo get_template_directory_uri()?>/assets/img/encanto.jpeg" alt="comer">
                </div>
                <div class="col-md-6 col-12"> -->
                    <?php the_content(); ?>
                <!-- </div> -->
            </div>
        <?php $args= array(
            'post_type'=> 'lugar',
            'post_per_page'=> 3,
            'order'=> 'ASC',
            'order_by'=> 'title'
        );
        $lugares = new WP_Query($args); ?>

        <?php if($lugares -> have_posts()) { ?>
            <div class="row my-5 justify-content-center ">
                <?php while($lugares-> have_posts()){ ?>
                    <?php $lugares->the_post(); ?>
                    <div class="col-4 my-3 align-items-center text-align-center lugares-relacionados">
                        <a href="<?php the_permalink(); ?>"> 
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </a>
                        <h6>
                            <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                        </h6>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <?php } ?>
   <?php } ?>

</main>

<?php get_footer( ); ?>