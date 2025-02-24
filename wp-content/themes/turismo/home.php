<?php

/**
 * Template Name: Home
 */
get_header();

$argsTours = array(
    'post_type'      => 'servicos',
    'posts_per_page' => 4,
    'orderby'        => 'date',
    'order'          => 'DESC',
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
        "link" => home_url('/passeios/' . $tour->post_name),
    ];

    array_push($toursArray, $trip);
}

?>
<section id="header" class="flex flex-col md:flex-row gap-8 p-6 position-relative ">
    <div class="overlay"></div>
    <div class="shape position-bottom rotate">
        <svg class="shape-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 27.8" preserveAspectRatio="none">
            <path class="shape-fill-white" d="M283.5,9.7c0,0-7.3,4.3-14,4.6c-6.8,0.3-12.6,0-20.9-1.5c-11.3-2-33.1-10.1-44.7-5.7	s-12.1,4.6-18,7.4c-6.6,3.2-20,9.6-36.6,9.3C131.6,23.5,99.5,7.2,86.3,8c-1.4,0.1-6.6,0.8-10.5,2c-3.8,1.2-9.4,3.8-17,4.7	c-3.2,0.4-8.3,1.1-14.2,0.9c-1.5-0.1-6.3-0.4-12-1.6c-5.7-1.2-11-3.1-15.8-3.7C6.5,9.2,0,10.8,0,10.8V0h283.5V9.7z M260.8,11.3	c-0.7-1-2-0.4-4.3-0.4c-2.3,0-6.1-1.2-5.8-1.1c0.3,0.1,3.1,1.5,6,1.9C259.7,12.2,261.4,12.3,260.8,11.3z M242.4,8.6	c0,0-2.4-0.2-5.6-0.9c-3.2-0.8-10.3-2.8-15.1-3.5c-8.2-1.1-15.8,0-15.1,0.1c0.8,0.1,9.6-0.6,17.6,1.1c3.3,0.7,9.3,2.2,12.4,2.7	C239.9,8.7,242.4,8.6,242.4,8.6z M185.2,8.5c1.7-0.7-13.3,4.7-18.5,6.1c-2.1,0.6-6.2,1.6-10,2c-3.9,0.4-8.9,0.4-8.8,0.5	c0,0.2,5.8,0.8,11.2,0c5.4-0.8,5.2-1.1,7.6-1.6C170.5,14.7,183.5,9.2,185.2,8.5z M199.1,6.9c0.2,0-0.8-0.4-4.8,1.1	c-4,1.5-6.7,3.5-6.9,3.7c-0.2,0.1,3.5-1.8,6.6-3C197,7.5,199,6.9,199.1,6.9z M283,6c-0.1,0.1-1.9,1.1-4.8,2.5s-6.9,2.8-6.7,2.7	c0.2,0,3.5-0.6,7.4-2.5C282.8,6.8,283.1,5.9,283,6z M31.3,11.6c0.1-0.2-1.9-0.2-4.5-1.2s-5.4-1.6-7.8-2C15,7.6,7.3,8.5,7.7,8.6	C8,8.7,15.9,8.3,20.2,9.3c2.2,0.5,2.4,0.5,5.7,1.6S31.2,11.9,31.3,11.6z M73,9.2c0.4-0.1,3.5-1.6,8.4-2.6c4.9-1.1,8.9-0.5,8.9-0.8	c0-0.3-1-0.9-6.2-0.3S72.6,9.3,73,9.2z M71.6,6.7C71.8,6.8,75,5.4,77.3,5c2.3-0.3,1.9-0.5,1.9-0.6c0-0.1-1.1-0.2-2.7,0.2	C74.8,5.1,71.4,6.6,71.6,6.7z M93.6,4.4c0.1,0.2,3.5,0.8,5.6,1.8c2.1,1,1.8,0.6,1.9,0.5c0.1-0.1-0.8-0.8-2.4-1.3	C97.1,4.8,93.5,4.2,93.6,4.4z M65.4,11.1c-0.1,0.3,0.3,0.5,1.9-0.2s2.6-1.3,2.2-1.2s-0.9,0.4-2.5,0.8C65.3,10.9,65.5,10.8,65.4,11.1	z M34.5,12.4c-0.2,0,2.1,0.8,3.3,0.9c1.2,0.1,2,0.1,2-0.2c0-0.3-0.1-0.5-1.6-0.4C36.6,12.8,34.7,12.4,34.5,12.4z M152.2,21.1	c-0.1,0.1-2.4-0.3-7.5-0.3c-5,0-13.6-2.4-17.2-3.5c-3.6-1.1,10,3.9,16.5,4.1C150.5,21.6,152.3,21,152.2,21.1z"></path>
            <path class="shape-fill-white" d="M269.6,18c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C267.7,18.8,269.7,18,269.6,18z"></path>
            <path class="shape-fill-white" d="M227.4,9.8c-0.2-0.1-4.5-1-9.5-1.2c-5-0.2-12.7,0.6-12.3,0.5c0.3-0.1,5.9-1.8,13.3-1.2	S227.6,9.9,227.4,9.8z"></path>
            <path class="shape-fill-white" d="M204.5,13.4c-0.1-0.1,2-1,3.2-1.1c1.2-0.1,2,0,2,0.3c0,0.3-0.1,0.5-1.6,0.4	C206.4,12.9,204.6,13.5,204.5,13.4z"></path>
            <path class="shape-fill-white" d="M201,10.6c0-0.1-4.4,1.2-6.3,2.2c-1.9,0.9-6.2,3.1-6.1,3.1c0.1,0.1,4.2-1.6,6.3-2.6	S201,10.7,201,10.6z"></path>
            <path class="shape-fill-white" d="M154.5,26.7c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C152.6,27.5,154.6,26.8,154.5,26.7z"></path>
            <path class="shape-fill-white" d="M41.9,19.3c0,0,1.2-0.3,2.9-0.1c1.7,0.2,5.8,0.9,8.2,0.7c4.2-0.4,7.4-2.7,7-2.6	c-0.4,0-4.3,2.2-8.6,1.9c-1.8-0.1-5.1-0.5-6.7-0.4S41.9,19.3,41.9,19.3z"></path>
            <path class="shape-fill-white" d="M75.5,12.6c0.2,0.1,2-0.8,4.3-1.1c2.3-0.2,2.1-0.3,2.1-0.5c0-0.1-1.8-0.4-3.4,0	C76.9,11.5,75.3,12.5,75.5,12.6z"></path>
            <path class="shape-fill-white" d="M15.6,13.2c0-0.1,4.3,0,6.7,0.5c2.4,0.5,5,1.9,5,2c0,0.1-2.7-0.8-5.1-1.4	C19.9,13.7,15.7,13.3,15.6,13.2z"></path>
        </svg>
    </div>
    <div class="flex-1 flex flex-col items-center justify-center text-center relative">
        <p class="mt-4 font-header-title uppercase">
            Descubra novos destinos e explore paisagens inesquecíveis
        </p>
        <p class="mt-4 font-header-description">
            Encontre aventuras e momentos únicos que ficarão na memória.
            Prepare-se para vivenciar experiências que transformarão seu modo de ver o mundo.
        </p>
        <form class="flex items-center max-w-sm mx-auto mt-4" id="search-form">
            <label for="simple-search" class="sr-only">Procurar</label>
            <div class="relative w-full">
                <input
                    type="text"
                    id="simple-search"
                    class="bg-white-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#029344] focus:border-[#029344] block w-full ps-10 p-2.5"
                    placeholder="Procuro casa na praia..."
                    required />
            </div>
            <button
                type="button"
                id="search-button"
                class="p-2.5 ms-2 text-sm font-medium text-white rounded-lg border border-[#029344] focus:ring-4 focus:outline-none focus:ring-green-300 bg-green cursor-pointer transition duration-200 ease-in-out">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </form>
    </div>
</section>
<section id="offers">
    <div class="flex-1 flex flex-col items-center justify-center text-center">
        <h1 class="font-offers-title">Serviços Recentes</h1>
        <h2 class="font-offers-description">Descubra os nossos pacotes de viagens mais recentes</h2>
    </div>
    <div class="mt-6 text-center">
        <div class="flex flex-wrap items-center justify-center text-center">
            <?php foreach ($toursArray as $tour): ?>
                <div class="max-w-64 bg-white mx-2 mb-4 rounded-lg hover:shadow">
                    <a href="<?php echo esc_url($tour['link']); ?>">
                        <img
                            src="<?php echo esc_url($tour['img']); ?>"
                            alt="<?php echo esc_attr($tour['name']); ?>"
                            class="w-full h-40 rounded-t-lg shadow-md" />
                    </a>
                    <div class="p-5">
                        <a href="<?php echo esc_url($tour['link']); ?>">
                            <h5 class="mb-2 font-bold tracking-tight text-dark-900">
                                <?php echo esc_html($tour['name']); ?>
                            </h5>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a
            href="/passeios"
            class="mt-4 bg-green text-white font-bold py-2 px-4 rounded hover:bg-green-700 transition duration-300">
            Ver todos
        </a>
    </div>
</section>
<section id="count-section" class="position-relative">
    <div class="position background-overlay"></div>
    <div class="shape position-top" data-negative="false">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
            <path class="shape-fill" opacity="0.33" d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z"></path>
            <path class="shape-fill" opacity="0.66" d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z"></path>
            <path class="shape-fill" d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z"></path>
        </svg>
    </div>
    <div id="count" class="position-relative text-center">
        <h2 class="font-header-title">
            Descubra o que fazer em nossa região
        </h2>
        <div class="mt-6 count-cards">
            <div class="double-card-count">
                <div class="card-count">
                    <div class="value" id="island-value">65</div>
                    <span class="font-counts-description uppercase">Ilhas</span>
                </div>
                <div class="card-count">
                    <span class="value">
                        <span>+ </span>
                        <span id="beachs-value">60</span>
                    </span>
                    <span class="font-counts-description uppercase">Praias</span>
                </div>
            </div>
            <div class="double-card-count">
                <div class="card-count">
                    <span class="value">
                        <span>+ </span>
                        <span id="waterfall-value">19</span>
                    </span>
                    <span class="font-counts-description uppercase">Cachoeiras</span>
                </div>
                <div class="card-count">
                    <span class="value">
                        <span>+ </span>
                        <span id="alembic-value">100</span>
                    </span>
                    <span class="font-counts-description uppercase">Alambiques</span>
                </div>
            </div>
        </div>
    </div>
    <div class="shape position-bottom rotate" data-negative="false">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
            <path class="shape-fill" opacity="0.33" d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z"></path>
            <path class="shape-fill" opacity="0.66" d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z"></path>
            <path class="shape-fill" d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z"></path>
        </svg>
    </div>
</section>
<section id="about-us" class="p-6">
    <h2 class="font-about-us-title text-center">
        Sobre Nós
    </h2>
    <div class="p-0 md:px-5 flex flex-col md:flex-row md:justify-center md:items-center gap-6">
        <!-- Coluna da imagem -->
        <div class="flex justify-center md:justify-end w-full md:w-1/2">
            <img
                src="<?php echo get_template_directory_uri(); ?>/assets/images/beach-with-mask.png"
                alt="Praia"
                class="w-3/5 md:w-4/5" />
        </div>

        <!-- Coluna do texto -->
        <div class="text-center md:text-left md:w-1/2">
            <h3 class="font-about-us-description">
                Venha explorar a cidade de Paraty conosco
            </h3>
            <h4 class="mt-4">
                Explore a deslumbrante cidade de Paraty, RJ, com Paraty Rentals & Cruises. Oferecemos casas de temporada à beira-mar e no centro histórico para uma estadia perfeita. Para aventuras inesquecíveis, embarque em nossas escunas e descubra as ilhas paradisíacas de Paraty.
            </h4>
            <h4 class="mt-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus fugit sunt, tempore unde libero debitis ut fugiat earum reiciendis iusto esse. Quod corporis aspernatur laboriosam error iure provident eaque odit. </h4>
        </div>
    </div>
</section>
<section id="contact" class="p-6">
    <h2 class="text-center text-3xl font-bold mb-6 uppercase">Fale Conosco</h2>
    <div class="flex flex-col md:flex-row items-center md:items-start">
        <!-- Formulário à esquerda -->
        <div class="contact-form w-full md:w-1/2 md:pr-4">
            <?php echo do_shortcode('[wpforms id="84" title="false"]'); ?>
        </div>
        <!-- Imagem à direita -->
        <div class="w-full md:w-1/2 mt-6 md:mt-0 md:pl-4 flex justify-center">
            <img
                src="<?php echo get_template_directory_uri(); ?>/assets/images/rounded-image.png"
                alt="Contato" class="w-1/2">
        </div>
    </div>
</section>
<script>
    const searchButton = document.getElementById('search-button');
    const searchInput = document.getElementById('simple-search');

    searchButton.addEventListener('click', function() {
        const query = searchInput.value.trim();
        if (query) {
            window.location.href = `<?php echo home_url('/consulta'); ?>?s=${encodeURIComponent(query)}`;
        } else {
            alert('Por favor, insira um termo de pesquisa.');
        }
    });
</script>
<?php
get_footer();
?>