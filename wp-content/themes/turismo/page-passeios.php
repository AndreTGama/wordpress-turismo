<?php
/**
 * Template Name: Services
 */
get_header();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$argsTours = array(
    'post_type'      => 'servicos',
    'paged'          => $paged,
    'posts_per_page' => 1,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

// Query de serviços
$toursQuery = new WP_Query($argsTours);
$toursList = $toursQuery->posts;
?>

<style>
    /* Estilização da paginação */
    .pagination {
        text-align: center;
        margin-top: 20px;
    }

    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 10px 15px;
        margin: 5px;
        background: #0073aa;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }

    .pagination a:hover {
        background: #005f87;
    }

    .pagination .current {
        background: #005f87;
        font-weight: bold;
    }
</style>

<section id="header-trips" class="flex flex-col md:flex-row gap-8 p-6 relative">
    <div class="overlay"></div>
    <div class="flex-1 flex flex-col justify-center relative">
        <span class="font-title-small small-text font-shadow white">Veja</span>
        <span class="font-title-big underline uppercase">Nossas ofertas</span>
    </div>
</section>


<?php if ($toursQuery->have_posts()) : ?>

    <section id="filter-trip" class="flex flex-col md:flex-row gap-4 p-6">
        <div id="filter-section" class="w-full md:w-1/4 p-4 bg-gray-100 rounded-lg">
            <span class="black font-title-small">Filtros</span>
            <div id="filter-content">
                <input id="search-input" placeholder="Buscar nos resultados" type="text" class="w-full p-2 mb-4 border rounded">
                <button id="clear-filters" class="bg-green text-white font-bold px-4 rounded mb-4">
                    Limpar Filtros
                </button>
                <hr class="border mb-4">
                <span class="font-bold">Categoria</span>
                <div class="flex items-center mb-2">
                    <input type="checkbox" class="filter-checkbox" value="Escuna" id="filter-escuna">
                    <label for="filter-escuna" class="ml-2">Escuna</label>
                </div>
                <div class="flex items-center mb-2">
                    <input type="checkbox" class="filter-checkbox" value="Passeio" id="filter-passeio">
                    <label for="filter-passeio" class="ml-2">Passeio</label>
                </div>
            </div>
        </div>

        <div class="w-full md:w-3/4 p-4">
            <?php foreach ($toursList as $tour) : ?>
                <div class="mb-4 relative flex flex-col md:flex-row w-full p-4 bg-white rounded-lg shadow-md" data-category="<?= get_field('type_service', $tour->ID); ?>">
                    <div class="md:w-1/3 w-full">
                        <img src="<?= get_the_post_thumbnail_url($tour->ID); ?>" alt="<?= $tour->post_title; ?>" class="w-full h-full object-cover rounded-lg" />
                    </div>
                    <div class="md:w-2/3 w-full flex flex-col justify-between p-4">
                        <div>
                            <div class="badge badge-bg font-badge mb-2"><?= get_field('type_service', $tour->ID); ?></div>
                            <h5 class="font-bold text-lg mb-2"><?= $tour->post_title; ?></h5>
                            <p class="description-trips text-gray-700 mb-4"><?= get_field('description_service', $tour->ID); ?></p>
                            <a href="<?= get_site_url()  . '/' . $tour->post_type . '/' . $tour->post_name; ?>" class="text-blue-500 font-bold hover:underline">Ver Mais</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Paginação -->
            <div class="pagination">
                <?php
                echo paginate_links(array(
                    'format'  => 'page/%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total'   => $toursQuery->max_num_pages,
                    'prev_text' => '← Anterior',
                    'next_text' => 'Próximo →',
                    'offset' => '-1',
                ));
                ?>
            </div>
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php get_footer(); ?>