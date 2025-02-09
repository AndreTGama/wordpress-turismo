<?php

/**
 * Template Name: Services
 */
get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$argsTours = array(
    'post_type'      => 'servicos',
    'posts_per_page' => 1,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'paged'          => $paged,
);

// Query de serviços
$toursQuery = new WP_Query($argsTours);
$toursArray = [];

if ($toursQuery->have_posts()) :
    while ($toursQuery->have_posts()) : $toursQuery->the_post();
        $images = get_field('pictures');
        $gallery = [];

        if (!empty($images) && is_array($images)) {
            foreach ($images as $image) {
                $gallery[] = $image['url'] ?? '';
            }
        }

        $trip = [
            "id" => get_the_ID(),
            "name" => get_field('name') ?? get_the_title(),
            "description" => get_field('description_service') ?? '',
            "type" => get_field('type_service') ?? '',
            "images" => $gallery,
            "img" => $gallery[0] ?? '',
            "link" => home_url('/servicos/' . get_post_field('post_name', get_the_ID())),
        ];
        array_push($toursArray, $trip);
    endwhile;
    wp_reset_postdata();
else :
    echo 'Nenhum serviço encontrado.';
endif;
?>
<section id="header-trips" class="flex flex-col md:flex-row gap-8 p-6 relative">
    <div class="overlay"></div>
    <div class="flex-1 flex flex-col justify-center relative">
        <span class="font-title-small small-text font-shadow white">Veja</span>
        <span class="font-title-big underline uppercase">Nossas ofertas</span>
    </div>
</section>

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
        <?php
        foreach ($toursArray as $tour) :
        ?>
            <div class="mb-4 relative flex flex-col md:flex-row w-full p-4 bg-white rounded-lg shadow-md" data-category="<?= esc_attr($tour['type']); ?>">
                <div class="md:w-1/3 w-full">
                    <img src="<?= esc_url($tour['img']); ?>" alt="<?= esc_attr($tour['name']); ?>" class="w-full h-full object-cover rounded-lg" />
                </div>
                <div class="md:w-2/3 w-full flex flex-col justify-between p-4">
                    <div>
                        <div class="badge badge-bg font-badge mb-2"><?= esc_html($tour['type']); ?></div>
                        <h5 class="font-bold text-lg mb-2"><?= esc_html($tour['name']); ?></h5>
                        <p class="description-trips text-gray-700 mb-4"><?= esc_html($tour['description']); ?></p>
                    </div>
                    <a href="<?= esc_url($tour['link']); ?>" class="text-blue-500 font-bold hover:underline">Ver Mais</a>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Paginação -->
        <div id="pagination" class="text-center mt-6">
            <?php
            $big = 999999999;
            $pagination_links = paginate_links([
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'current' => max(1, get_query_var('paged')),
                'total' => $toursQuery->max_num_pages,
                'prev_text' => 'Anterior',
                'next_text' => 'Próximo',
                'type' => 'array',
            ]);

            if ($pagination_links) :
                echo '<div class="pagination flex justify-center gap-2">';
                foreach ($pagination_links as $link) :
                    echo '<button class="pagination-btn bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">' . $link . '</button>';
                endforeach;
                echo '</div>';
            endif;
            ?>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const searchInput = document.getElementById("search-input");
        const clearFiltersBtn = document.getElementById("clear-filters");
        const checkboxes = document.querySelectorAll(".filter-checkbox");
        const cards = document.querySelectorAll("[data-category]");

        searchInput.addEventListener("input", () => {
            filterCards();
        });

        clearFiltersBtn.addEventListener("click", () => {
            searchInput.value = "";
            checkboxes.forEach((checkbox) => {
                checkbox.checked = false;
            });
            filterCards();
        });

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", () => {
                filterCards();
            });
        });

        function filterCards() {
            const searchText = searchInput.value.toLowerCase();
            const selectedCategories = Array.from(checkboxes)
                .filter((checkbox) => checkbox.checked)
                .map((checkbox) => checkbox.value);

            cards.forEach((card) => {
                const title = card.querySelector("h5")?.textContent.toLowerCase() || "";
                const category = card.getAttribute("data-category").toLowerCase();

                const matchesSearch = title.includes(searchText);
                const matchesCategory = selectedCategories.length === 0 || selectedCategories.includes(category);

                if (matchesSearch && matchesCategory) {
                    card.classList.remove("hidden");
                } else {
                    card.classList.add("hidden");
                }
            });
        }
    });
</script>

<?php get_footer(); ?>