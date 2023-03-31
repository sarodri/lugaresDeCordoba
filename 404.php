<?php get_header()?>

<main class="container d-flex justify-content-center"> 
    <div class="error-404  align-items-center ">
        <img src="<?php echo get_template_directory_uri()?>/assets/img/fondo.jpg" alt="fondo">
            <h1 id="error404">¡Vaya! Parece que esta página no existe</h1>
            <p id="error404">Puedes volver a la página principal dándole a <a href="<?php echo home_url(); ?>">éste enlace</a> :)</p>
        
        
    </div>
</main> 

<?php get_footer()?>