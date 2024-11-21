<?php

/**
 * Template Name: Trips
 */
get_header();
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
        <span class="black font-title-small">
            Filtros
        </span>
        <div id="filter-content">
            <input id="search-input" placeholder="Buscar nos resultados" type="text" class="w-full p-2 mb-4 border rounded">
            <button id="clear-filters" class="bg-green  text-white font-bold px-4 rounded mb-4">
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
        $categorias = ['Escuna', 'Passeio'];

        for ($i = 0; $i < 12; $i++):
            $categoriaAleatoria = $categorias[array_rand($categorias)];
        ?>
            <div class="mb-4 relative flex flex-col md:flex-row w-full p-4 bg-white rounded-lg shadow-md" data-category="<?php echo $categoriaAleatoria; ?>">
                <div class="md:w-1/3 w-full">
                    <img
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/paraty-sono.png"
                        alt="Uma descrição da imagem"
                        class="w-full h-full object-cover rounded-lg" />
                </div>
                <div class="md:w-2/3 w-full flex flex-col justify-between p-4">
                    <div>
                        <div class="badge badge-bg font-badge mb-2"><?php echo $categoriaAleatoria; ?></div>
                        <h5 class="font-bold text-lg mb-2">Noteworthy technology acquisitions 2021</h5>
                        <p class="description-trips text-gray-700 mb-4">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui veniam quam non recusandae adipisci commodi, animi tempore quis delectus id placeat reprehenderit ipsum beatae a voluptatem accusamus excepturi, aperiam expedita.
                        </p>
                    </div>
                    <a href="#" class="text-blue-500 font-bold hover:underline">Ver Mais</a>
                </div>
            </div>
        <?php endfor; ?>
        <!-- Paginação -->
        <div id="pagination" class="text-center mt-6">
            <button class="pagination-btn bg-blue-500 text-white font-bold py-2 px-4 rounded">Anterior</button>
            <button class="pagination-btn bg-blue-500 text-white font-bold py-2 px-4 rounded">Próximo</button>
        </div>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toggleFilterBtn = document.getElementBy;
        filter - content ");
        const searchInput = document.getElementById("search-input");
        const clearFiltersBtn = document.getElementById("clear-filters");
        const checkboxes = document.querySelectorAll(".filter-checkbox");
        const cards = document.querySelectorAll("[data-category]");

        toggleFilterBtn.addEventListener("click", () => {
            filterContent.classList.toggle("hidden");
        });

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", () => {
                filterCards();
            });
        });

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

        function filterCards() {
            const searchText = searchInput.value.toLowerCase();
            const selectedCategories = Array.from(checkboxes)
                .filter((checkbox) => checkbox.checked)
                .map((checkbox) => checkbox.value);

            cards.forEach((card) => {
                const title = card.querySelector("h5")?.textContent.toLowerCase() || "";
                const category = card.getAttribute("data-category").toLowerCase();

                const matchesSearch = title.includes(searchText) || category.includes(searchText);
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
<?php
get_footer();
?>