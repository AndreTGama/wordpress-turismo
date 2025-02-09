<?php
/**
 * Template Name: Services
 */
get_header();

$argsTours = array(
    'post_type'      => 'servicos',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
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
            "value" => get_field('value') ?? '',
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
        <div id="trip-cards"></div>

        <!-- Paginação -->
        <div id="pagination" class="text-center mt-6"></div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toursArray = <?= json_encode($toursArray); ?>;
        const itemsPerPage = 10;
        let currentPage = 1;

        const tripContainer = document.getElementById("trip-cards");
        const paginationContainer = document.getElementById("pagination");

        const renderTrips = (page) => {
            tripContainer.innerHTML = "";

            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const currentTrips = toursArray.slice(start, end);

            currentTrips.forEach(tour => {
                const tripCard = `
                    <div class="mb-4 relative flex flex-col md:flex-row w-full p-4 bg-white rounded-lg shadow-md" data-category="${tour.type}">
                        <div class="md:w-1/3 w-full">
                            <img src="${tour.img}" alt="${tour.name}" class="w-full h-full object-cover rounded-lg" />
                        </div>
                        <div class="md:w-2/3 w-full flex flex-col justify-between p-4">
                            <div>
                                <div class="badge badge-bg font-badge mb-2">${tour.type}</div>
                                <h5 class="font-bold text-lg mb-2">${tour.name}</h5>
                                <p class="description-trips text-gray-700 mb-4">${tour.description}</p>
                            </div>
                            <a href="${tour.link}" class="text-blue-500 font-bold hover:underline">Ver Mais</a>
                        </div>
                    </div>
                `;
                tripContainer.insertAdjacentHTML("beforeend", tripCard);
            });

            renderPagination();
        };

        const renderPagination = () => {
            paginationContainer.innerHTML = "";

            const totalPages = Math.ceil(toursArray.length / itemsPerPage);

            if (totalPages > 1) {
                const createPageButton = (page, label) => {
                    const button = document.createElement("button");
                    button.textContent = label || page;
                    button.className = `pagination-btn bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 ${page === currentPage ? "bg-blue-700" : ""}`;
                    button.style.margin = "0 5px";
                    button.addEventListener("click", () => {
                        currentPage = page;
                        renderTrips(currentPage);
                    });
                    paginationContainer.appendChild(button);
                };

                createPageButton(1, "Primeira");
                if (currentPage > 2) {
                    paginationContainer.insertAdjacentHTML("beforeend", "<span>...</span>");
                }

                for (let i = Math.max(1, currentPage - 1); i <= Math.min(totalPages, currentPage + 1); i++) {
                    createPageButton(i);
                }

                if (currentPage < totalPages - 1) {
                    paginationContainer.insertAdjacentHTML("beforeend", "<span>...</span>");
                }
                createPageButton(totalPages, "Última");
            }
        };

        renderTrips(currentPage);
    });
</script>

<?php get_footer(); ?>