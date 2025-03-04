<?php

/**
 * Template Name: Tours
 */
get_header();

$categorias = ['Escuna', 'Casa', 'Jeep'];

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
$min_value = isset($_GET['min_value']) ? intval($_GET['min_value']) : '';
$max_value = isset($_GET['max_value']) ? intval($_GET['max_value']) : '';
$min_capacity = isset($_GET['min_capacity']) ? intval($_GET['min_capacity']) : '';
$max_capacity = isset($_GET['max_capacity']) ? intval($_GET['max_capacity']) : '';
$tiposSelecionados = isset($_GET['type']) ? (array) $_GET['type'] : $categorias;

$meta_query = array('relation' => 'AND');

if ($min_value || $max_value) {
    $value_query = array('key' => 'value', 'type' => 'NUMERIC');
    if ($min_value) $value_query['value'][] = $min_value;
    if ($max_value) $value_query['value'][] = $max_value;
    if ($min_value && $max_value) $value_query['compare'] = 'BETWEEN';
    elseif ($min_value) $value_query['compare'] = '>=';
    elseif ($max_value) $value_query['compare'] = '<=';
    $meta_query[] = $value_query;
}

if ($min_capacity || $max_capacity) {
    $capacity_query = array('key' => 'capacity', 'type' => 'NUMERIC');
    if ($min_capacity) $capacity_query['value'][] = $min_capacity;
    if ($max_capacity) $capacity_query['value'][] = $max_capacity;
    if ($min_capacity && $max_capacity) $capacity_query['compare'] = 'BETWEEN';
    elseif ($min_capacity) $capacity_query['compare'] = '>=';
    elseif ($max_capacity) $capacity_query['compare'] = '<=';
    $meta_query[] = $capacity_query;
}


if (!empty($tiposSelecionados)) {
    $meta_query[] = array(
        'key'     => 'type_service',
        'value'   => $tiposSelecionados,
        'compare' => 'IN',
    );
}

$argsTours = array(
    'post_type'      => 'servicos',
    'paged'          => $paged,
    'posts_per_page' => 2,
    'orderby'        => 'date',
    'order'          => 'DESC',
    's'              => $search,
    'meta_query'     => $meta_query,
);

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

<section id="filter-trip" class="flex flex-col md:flex-row gap-4 p-6">
    <div id="filter-section" class="w-full md:w-1/4 p-4 bg-gray-100 rounded-lg">
        <span class="black font-title-small">Filtro: </span>
        <form method="GET" action="">
            <input name="search" value="<?= esc_attr($search); ?>" placeholder="Buscar por nome ou descrição" type="text" class="w-full p-2 mb-4 border rounded">
            <hr class="border mb-4">
            <label class="black font-title-small">Valor:</label>
            <div class="flex flex-col md:flex-row gap-6">
                <input name="min_value" min='0' type="number" value="<?= esc_attr($min_value); ?>" placeholder="Mínima" class="w-full p-2 mb-2 border rounded">
                <input name="max_value" type="number" value="<?= esc_attr($max_value); ?>" placeholder="Máxima" class="w-full p-2 mb-2 border rounded">
            </div>
            <hr class="border mb-4">
            <label class="black font-title-small">Capacidade:</label>
            <div class="flex flex-col md:flex-row gap-6">
                <input name="min_capacity" min='0' type="number" value="<?= esc_attr($min_capacity); ?>" placeholder="Mínima" class="w-full p-2 mb-2 border rounded">
                <input name="max_capacity" type="number" value="<?= esc_attr($max_capacity); ?>" placeholder="Máxima" class="w-full p-2 mb-2 border rounded">
            </div>
            <hr class="border mb-4">
            <label class="black font-title-small">Categoria</label>
            <?php foreach ($categorias as $categoria) : ?>
                <div class="flex items-center mb-2">
                    <input name="type[]" type="checkbox" class="filter-checkbox" value="<?= esc_attr($categoria); ?>" id="filter-<?= strtolower($categoria); ?>"
                        <?= in_array($categoria, $tiposSelecionados) ? 'checked' : ''; ?>>
                    <label for="filter-<?= strtolower($categoria); ?>" class="ml-2"><?= $categoria; ?></label>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="bg-green text-white font-bold px-4 py-2 rounded">Filtrar</button>
            <a href="<?= get_permalink(); ?>" class="ml-4 text-red-500">Limpar</a>
        </form>
    </div>
    <?php if ($toursQuery->have_posts()) : ?>
        <div class="w-full md:w-3/4 p-4">
            <?php foreach ($toursList as $tour) : ?>
                <div class="mb-4 relative flex flex-col md:flex-row w-full p-4 bg-white rounded-lg shadow-md" data-category="<?= get_field('type_service', $tour->ID); ?>">
                    <div class="md:w-1/3 w-full">
                        <img
                            src="<?= get_first_image($tour->ID, 'URL_DA_IMAGEM_PADRAO'); ?>"
                            alt="<?= $tour->post_title; ?>"
                            class="w-full h-full object-cover rounded-lg" />
                    </div>
                    <div class="md:w-2/3 w-full flex flex-col justify-between p-4">
                        <div>
                            <div class="white text-xl font-semibold mb-4 badge-big-bg">R$ <?= get_field('value', $tour->ID); ?></div>
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
                <?php wordpress_pagination($toursQuery); ?>
            </div>
        </div>
    <?php endif; ?>

</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector("form");

        form.addEventListener("submit", function(event) {
            let minValue = parseInt(document.querySelector("input[name='min_value']").value) || 0;
            let maxValue = parseInt(document.querySelector("input[name='max_value']").value) || 0;
            let minCapacity = parseInt(document.querySelector("input[name='min_capacity']").value) || 0;
            let maxCapacity = parseInt(document.querySelector("input[name='max_capacity']").value) || 0;

            if (minValue < 0 || maxValue < 0 || minCapacity < 0 || maxCapacity < 0) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Os valores não podem ser negativos.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
                event.preventDefault();
                return;
            }

            if (minValue > maxValue && maxValue !== 0) {
                Swal.fire({
                    title: 'Error!',
                    text: 'O valor mínimo não pode ser maior que o valor máximo.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
                event.preventDefault();
                return;
            }

            if (minCapacity > maxCapacity && maxCapacity !== 0) {
                Swal.fire({
                    title: 'Error!',
                    text: 'A capacidade mínima não pode ser maior que a capacidade máxima.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
                event.preventDefault();
                return;
            }
        });
    });
</script>
<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>