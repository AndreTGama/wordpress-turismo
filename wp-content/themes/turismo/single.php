<?php
get_header();

$argsTours = [
    'post_type'      => 'servicos',
    'name'           => 'escuna-de-luxo', // Slug específico
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
                <?php foreach (array_slice($trip['images'], 1, 4) as $imageUrl) : ?>
                    <img src="<?= esc_url($imageUrl) ?>" alt="Miniatura" class="w-1/4 h-[10vh] object-cover cursor-pointer rounded-md" onclick="changeMainImage(this)">
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
            <hr class="mt-4 mb-4" />
            <div class="gap-4">
                <span class="text-gray-700">Compartilhe:</span>
                <div class="flex gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(home_url()) ?>" target="_blank">
                        <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M12 2.04c-5.52 0-10 4.48-10 10 0 4.99 3.66 9.13 8.44 9.88v-6.99h-2.54v-2.89h2.54v-2.2c0-2.5 1.5-3.88 3.78-3.88 1.1 0 2.24.18 2.24.18v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.79l-.45 2.89h-2.34v6.99c4.78-.75 8.44-4.89 8.44-9.88 0-5.52-4.48-10-10-10z" />
                        </svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?= urlencode(home_url()) ?>&text=Confira%20esta%20página%20incrível!" target="_blank">
                        <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M22.46 6c-.77.35-1.5.58-2.26.69.81-.49 1.44-1.27 1.74-2.2-.77.46-1.62.8-2.52.98a4.48 4.48 0 0 0-7.65 4.08c-3.73-.19-7.03-1.97-9.24-4.68-.39.67-.61 1.45-.61 2.29 0 1.58.8 2.98 2.02 3.8a4.48 4.48 0 0 1-2.03-.56v.06c0 2.21 1.58 4.05 3.68 4.47-.39.11-.8.17-1.23.17-.3 0-.6-.03-.88-.09.61 1.89 2.37 3.26 4.45 3.3a9 9 0 0 1-5.56 1.92c-.36 0-.72-.02-1.08-.07a12.71 12.71 0 0 0 6.88 2.02c8.26 0 12.77-6.85 12.77-12.77 0-.2 0-.39-.02-.58a9.1 9.1 0 0 0 2.24-2.31z" />
                        </svg>
                    </a>
                    <a href="https://wa.me/?text=Confira%20esta%20página%20incrível!%20<?= urlencode(home_url()) ?>" target="_blank">
                        <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M20.52 3.48a11.95 11.95 0 0 0-16.91 0 11.93 11.93 0 0 0 0 16.91c4.17 4.17 10.94 4.17 15.11 0a11.95 11.95 0 0 0 1.8-12.81l-.24-.42a11.93 11.93 0 0 0-.76-.76zm-1.91 10.95l-.76.76c-.33.33-.76.6-1.2.8-1.2.48-2.52.24-4.09-.77l-2.16-1.5c-.6-.42-1.17-.98-1.71-1.71l-1.5-2.16c-.42-.6-.6-1.26-.6-1.86 0-.43.17-.87.49-1.2l.76-.76c.32-.33.84-.54 1.2-.6.45-.06.9.03 1.29.28l1.26.84c.48.33.84.87 1.11 1.38.27.51.42 1.02.6 1.53l.24.45c.06.1.1.2.16.27.05.07.14.11.24.17.1.05.2.11.3.11.11 0 .22-.02.32-.06.38-.15.77-.45 1.11-.78l.84-1.26c.25-.39.34-.84.27-1.29-.06-.36-.27-.88-.6-1.2l-.76-.76z" />
                        </svg>
                    </a>
                </div>
            </div>
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