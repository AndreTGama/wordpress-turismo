<?php

/**
 * Template Name: Search
 */
get_header();

$query = get_search_query();
$argsTours = array(
    'post_type'      => 'servicos',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'meta_query'     => array(
        'relation' => 'OR',
        array(
            'key'     => 'name', // Nome do campo ACF 'name'
            'value'   => $query, // Valor da pesquisa
            'compare' => 'LIKE', // Busca parcial
        ),
        array(
            'key'     => 'description', // Nome do campo ACF 'description'
            'value'   => $query, // Valor da pesquisa
            'compare' => 'LIKE', // Busca parcial
        ),
    ),
);

$tours = get_posts($argsTours);
$toursArray = [];

foreach ($tours as $tour) {
    $images = get_field('pictures', $tour->ID);
    $gallery = [];
    if (!empty($images) && is_array($images)) {
        foreach ($images as $image) {
            $gallery[] = $image['url'] ?? '';
        }
    }

    $trip = [
        "id" => $tour->ID,
        "name" => get_field('name', $tour->ID) ?? $tour->post_title,
        "description" => get_field('description', $tour->ID) ?? '',
        "images" => $gallery,
        "img" => $gallery[0] ?? '',
        "link" => home_url('/servicos/' . $tour->post_name),
    ];

    array_push($toursArray, $trip);
}
?>

<main id="primary" class="site-main">
    <section id="header-trips" class="flex flex-col md:flex-row gap-8 p-6 relative">
        <div class="overlay"></div>
        <div class="flex-1 flex flex-col justify-center relative">
            <span class="font-title-big underline uppercase">Consulta</span>
        </div>
    </section>
    <div class="search-results">
        <?php if (!empty($toursArray)) : ?>
            <ul class="search-list">
                <?php foreach ($toursArray as $tour) : ?>
                    <li class="mb-4">
                        <a href="<?php echo esc_url($tour['link']); ?>" class="block p-4 border rounded-lg transition-all hover:bg-gray-100 hover:shadow-lg">
                            <!-- Nome em azul, maior e com underline no hover -->
                            <h3 class="text-blue-600 text-lg font-semibold mb-2 hover:underline"><?= $tour['name']; ?></h3>

                            <!-- Descrição com limite de 250 caracteres, em cinza e menor -->
                            <p class="text-gray-500 text-sm">
                                <?= substr($tour['description'], 0, 250); ?><?php if (strlen($tour['description']) > 250) echo '...'; ?>
                            </p>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Nenhum resultado encontrado para sua busca. Tente outro termo.</p>
        <?php endif; ?>
    </div>

</main>

<?php get_footer(); ?>