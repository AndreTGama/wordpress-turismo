<?php 
function tema_adicionar_imagem_destacada() {
    add_theme_support( 'post-thumbnails' ); // Habilita imagens destacadas
}
add_action( 'after_setup_theme', 'tema_adicionar_imagem_destacada' );
