<?php get_header(); ?>

<main class="container my-5">
    <?php if(have_posts(  )){
        while(have_posts(  )){
            the_post(  ); ?>
        <?php the_content( ); ?>
     <?php   }
    }
    ?>
    <!-- Para filtrar resultados de búsquedas: -->
     <!-- <div class="lugares">
        <h2 class="text-center">MÁS INFORMACIÓN</h2>
        <div class="row">
            <div class="col-12">
                <select class="form-select" name="lugar" id="lugar">
                    <option value="">Todos los lugares</option>
                    <?php $terms = get_terms('lugar', array('hide_empty' => true)); ?>
                    <?php foreach ($terms as $term) {
                        echo '<option value="'.$term->slug.'">'.$term->name.'</option>';
                    } ?>
                </select>
            </div>
        </div> -->
        <!-- <div class="row my-5" id="resultado-lugares">
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
    </div> -->
</main>

<?php get_footer(); ?>