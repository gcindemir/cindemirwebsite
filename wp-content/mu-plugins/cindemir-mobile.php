<?php
/**
 * Plugin Name: Cindemir Mobile Experience
 * Description: Ensures cindemir.av.tr renders as a proper mobile site (viewport, navigation, layout).
 * Version: 1.0.0
 * Author: Cindemir Hukuk Bürosu
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output the viewport meta tag early. The live theme stack was missing it entirely,
 * which makes phones render a zoomed-out desktop layout (~980px).
 */
function cindemir_mobile_viewport_meta(): void {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">' . "\n";
}
add_action( 'wp_head', 'cindemir_mobile_viewport_meta', 0 );

/**
 * Mobile-only CSS overrides. Desktop custom CSS (horizontal nav bar) is preserved
 * at min-width: 768px; phones get hamburger navigation and fluid layout.
 */
function cindemir_mobile_styles(): void {
	$css = <<<'CSS'
@media (max-width: 767px) {
	/* --- Navigation: use theme mobile menu, not forced desktop bar --- */
	header.menu-wrapper .main-menu.hidden-xs {
		display: none !important;
	}

	header.menu-wrapper .res-menu.hidden-sm.hidden-md.hidden-lg {
		display: block !important;
		float: none !important;
		clear: both !important;
		width: 100% !important;
	}

	header.menu-wrapper .navbar-header {
		display: block !important;
		text-align: right !important;
		padding: 0 12px 4px !important;
	}

	header.menu-wrapper .navbar-header .navbar-toggle {
		display: inline-block !important;
		position: static !important;
		margin: 0 !important;
		padding: 8px 10px !important;
		border: 1px solid rgba(255, 255, 255, 0.45) !important;
		border-radius: 4px !important;
	}

	header.menu-wrapper .res-menu .navbar-collapse {
		display: none;
	}

	header.menu-wrapper .res-menu .navbar-collapse.in,
	header.menu-wrapper .res-menu .navbar-collapse.collapsing {
		display: block !important;
	}

	header.menu-wrapper .res-menu .nav {
		display: block !important;
		flex-wrap: nowrap !important;
		justify-content: flex-start !important;
		padding: 0 !important;
		margin: 0 !important;
	}

	header.menu-wrapper .res-menu .nav > li {
		display: block !important;
		float: none !important;
		width: 100% !important;
		margin: 0 !important;
		border-bottom: 1px solid rgba(0, 0, 0, 0.06);
	}

	header.menu-wrapper .res-menu .nav > li > a {
		display: block !important;
		color: #555 !important;
		padding: 12px 16px !important;
		white-space: normal !important;
		line-height: 1.4 !important;
	}

	header.menu-wrapper .nav-bar-wrapper::before {
		font-size: clamp(14px, 4.2vw, 18px) !important;
		padding: 8px 12px 4px !important;
	}

	header.menu-wrapper {
		position: relative !important;
	}

	header.menu-wrapper.fixed {
		display: block !important;
		position: sticky !important;
		top: 0 !important;
		z-index: 1001 !important;
		background: #2e5f5f !important;
	}

	/* --- Layout: prevent horizontal scroll and shrink desktop padding --- */
	html,
	body {
		max-width: 100% !important;
		overflow-x: hidden !important;
		-webkit-text-size-adjust: 100% !important;
	}

	.container {
		width: 100% !important;
		max-width: 100% !important;
		padding-left: 16px !important;
		padding-right: 16px !important;
	}

	img,
	video,
	iframe,
	.elementor-widget-image img {
		max-width: 100% !important;
		height: auto !important;
	}

	table {
		display: block !important;
		width: 100% !important;
		overflow-x: auto !important;
		-webkit-overflow-scrolling: touch;
	}

	/* Homepage hero: desktop bottom padding is far too tall on phones */
	.elementor-771 .elementor-element.elementor-element-8873fd6 {
		padding-bottom: 120px !important;
	}

	.elementor-771 .elementor-element.elementor-element-a709fa8 {
		margin-top: -80px !important;
	}

	.elementor-771 .elementor-element.elementor-element-72bd0f3 > .elementor-element-populated {
		padding: 32px 20px !important;
	}

	.elementor-771 .elementor-element.elementor-element-ff612a9 .elementor-heading-title {
		font-size: 26px !important;
		line-height: 1.25 !important;
	}

	.elementor-771 .elementor-element.elementor-element-2aba689 {
		margin-top: 48px !important;
		margin-bottom: 40px !important;
	}

	.elementor-771 .elementor-element.elementor-element-15b0c39 {
		flex-direction: column !important;
	}

	.elementor-771 .elementor-element.elementor-element-053bf25,
	.elementor-771 .elementor-element.elementor-element-71fea0c {
		width: 100% !important;
		margin-right: 0 !important;
		margin-bottom: 24px !important;
	}

	.elementor-771 .elementor-element.elementor-element-8c08724 > .elementor-element-populated,
	.elementor-771 .elementor-element.elementor-element-657bb74 > .elementor-element-populated {
		padding: 24px 16px !important;
	}

	.elementor-widget-text-editor p,
	.elementor-widget-text-editor li,
	.entry-content p,
	.entry-content li {
		font-size: 16px !important;
		line-height: 1.65 !important;
	}

	#footer .footer-widgets-wrapper > .col-md-4 {
		text-align: center !important;
	}
}
CSS;

	wp_register_style( 'cindemir-mobile', false, array(), '1.0.0' );
	wp_enqueue_style( 'cindemir-mobile' );
	wp_add_inline_style( 'cindemir-mobile', $css );
}
add_action( 'wp_enqueue_scripts', 'cindemir_mobile_styles', 999 );

/**
 * Tiny fallback for Bootstrap collapse if the bundled script loads late (e.g. WP Rocket defer).
 */
function cindemir_mobile_menu_script(): void {
	$js = <<<'JS'
(function () {
	function bindToggle() {
		var toggle = document.querySelector('header.menu-wrapper .navbar-toggle');
		var collapse = document.querySelector('header.menu-wrapper .res-menu .navbar-collapse');
		if (!toggle || !collapse || toggle.dataset.cindemirBound === '1') {
			return;
		}
		toggle.dataset.cindemirBound = '1';
		toggle.addEventListener('click', function (event) {
			if (window.innerWidth > 767) {
				return;
			}
			event.preventDefault();
			collapse.classList.toggle('in');
			var expanded = collapse.classList.contains('in');
			toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
		});
	}
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', bindToggle);
	} else {
		bindToggle();
	}
})();
JS;

	wp_register_script( 'cindemir-mobile-menu', '', array(), '1.0.0', true );
	wp_enqueue_script( 'cindemir-mobile-menu' );
	wp_add_inline_script( 'cindemir-mobile-menu', $js );
}
add_action( 'wp_enqueue_scripts', 'cindemir_mobile_menu_script', 999 );
