<?php 
//Template Name: Página Institucional
get_header();
$fields = get_fields(); ?>

<main class='container my-5' > 
    <h1 class="my-3"><?php echo $fields['titulo']; ?></h1>
     <?php if (have_posts()) {
        while(have_posts(  )){
            the_post(); ?>
            <div class="row my-5" id="institucional">
                <div class="col-4">  <img src="<?php echo $fields['imagen']?>"  alt="sobre-mi" />
                </div>
                <div class="col-8">
                    <p><?php echo $fields['descripcion']?></p>
                </div>
            </div>
            <hr>
            <div class="row">
                    <h3 class="my-5">PROYECTOS PERSONALES</h3>
                   <?php the_content(); ?>
            </div>
            <hr>
            <div class="formulario">
                <div>
                <p>Si quieres contactar conmigo para cualquier duda, aportación o tienes algo que ofrecerme... puedes hacerlo a través de este formulario.</p>    
                </div>
                <div>
                <?php echo do_shortcode('[contact-form-7 id="269" title="Formulario de contacto 1"]'); ?>
                </div>
            </div>
           
        <?php }
    }?>
</main>

<?php get_footer(); ?>