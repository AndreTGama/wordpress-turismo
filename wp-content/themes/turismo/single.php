<?php
get_header();

$slug = get_query_var('name');

$argsTours = [
    'post_type'      => 'servicos',
    'name'           => $slug,
    'posts_per_page' => 1,
];

// Query de serviços
$toursQuery = new WP_Query($argsTours);
$trip = [];

if ($toursQuery->have_posts()) {
    $toursQuery->the_post();

    $images = get_field('pictures') ?: [];
    $gallery = array_column($images, 'url');

    $trip = [
        "id" => get_the_ID(),
        "name" => get_field('name') ?: get_the_title(),
        "value" => get_field('value') ?: '',
        "description" => get_field('description_service') ?: '',
        "type" => get_field('type_service') ?: '',
        "images" => $gallery,
        "img" => $gallery[0] ?? '',
    ];
    wp_reset_postdata();
} else {
    echo 'Nenhum serviço encontrado.';
}
?>
<section id="header-trips" class="flex flex-col md:flex-row gap-8 p-6 relative">
    <div class="overlay"></div>
    <div class="flex-1 flex flex-col justify-center relative">
        <span class="font-title-small small-text font-shadow white">Veja</span>
        <span class="font-title-big underline uppercase">Nossas ofertas</span>
    </div>
</section>
<section id="body-info" class="p-4">
    <div class="flex flex-col md:flex-row gap-4">
        <div class="flex flex-col gap-2 md:w-1/2">
            <div class="relative">
                <img id="main-image" src="<?= esc_url($trip['img']) ?>" alt="Imagem principal" class="w-full h-[50vh] object-cover rounded-lg shadow-md">
            </div>
            <div class="flex gap-2">
                <?php foreach (array_slice($trip['images'], 0, 5) as $imageUrl) : ?>
                    <img src="<?= esc_url($imageUrl) ?>" alt="Miniatura" class="w-1/5 h-[10vh] object-cover cursor-pointer rounded-md" onclick="changeMainImage(this)">
                <?php endforeach; ?>
            </div>
        </div>
        <div class="md:w-1/2 pt-0 pr-10 pb-10 pl-10">
            <div class="flex flex-col md:flex-row gap-4 justify-between relative h-[62px]">
                <h4 class="text-2xl font-bold mb-4"><?= esc_html($trip['name']) ?></h4>
                <div class="white text-xl font-semibold mb-4 badge-big-bg">R$ <?= esc_html($trip['value']) ?></div>
            </div>
            <span class="line-decoration mb-4"></span>
            <p class="text-gray-600 mb-4"><?= esc_html($trip['description']) ?></p>
            <hr class="mt-4 mb-4" />
            <ul class="pl-5 mb-4 text-gray-600">
                <li><strong>Nome:</strong> <?= esc_html($trip['name']) ?></li>
                <li><strong>Valor:</strong> R$ <?= esc_html($trip['value']) ?></li>
                <li><strong>Tipo:</strong> <?= esc_html($trip['type']) ?></li>
            </ul>
        </div>
    </div>
</section>
<script>
    function changeMainImage(thumbnail) {
        const mainImage = document.getElementById('main-image');
        mainImage.src = thumbnail.src;
    }
</script>
<?php
get_footer();
?>