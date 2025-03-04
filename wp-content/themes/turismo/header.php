<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Encontre as melhores casas para alugar e passeios de escuna em Paraty. Explore as belezas naturais desta cidade histórica no litoral do Rio de Janeiro.">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Magnific -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/magnific-popup.css">
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.magnific-popup.js"></script>
	<!-- Fotorama -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
	<!-- TailWind -->
	<script src="https://cdn.tailwindcss.com"></script>
	<!-- Carrousel -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
	<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
	<!-- Sweet Alert -->
	<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js "></script>
	<link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css " rel="stylesheet">
	<!-- Styles -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/main.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/navbar.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/button.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/home.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/font.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/trips.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/colors.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/info.css">

</head>

<body>
	<nav class="absolute w-full bg-opacity-10 backdrop-blur-lg shadow-lg p-2 z-50">
		<div class="container mx-auto flex items-center justify-between">
			<div class="flex items-center space-x-8">
				<a href="<?php echo get_bloginfo('url'); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/paraty-fun.jpg" alt="logo da empresa" class="rounded-full w-14 md:w-14" />
				</a>
			</div>
			<div class="hidden md:flex space-x-4">
				<?php
				$menu_items = wp_get_nav_menu_items('primary-header');

				if ($menu_items) {
					foreach ($menu_items as $item) {
						echo sprintf(
							'<a href="%s" class="text-lg font-navbar text-white uppercase hover:text-[#029344] underline-effect">%s</a>',
							esc_url($item->url),
							esc_html($item->title)
						);
					}
				}
				?>
			</div>
			<button
				id="menu-btn"
				class="md:hidden text-2xl focus:outline-none text-white hover:text-[#029344]">
				&#9776;
			</button>
		</div>
		<div id="menu" class="hidden md:hidden flex flex-col space-y-2 mt-4 px-8">
			<?php
			$menu_items = wp_get_nav_menu_items('primary-header');

			if ($menu_items) {
				foreach ($menu_items as $item) {
					echo sprintf(
						'<a href="%s" class="text-lg font-navbar text-white uppercase hover:text-[#029344] underline-effect">%s</a>',
						esc_url($item->url),
						esc_html($item->title)
					);
				}
			}
			?>
		</div>
	</nav>