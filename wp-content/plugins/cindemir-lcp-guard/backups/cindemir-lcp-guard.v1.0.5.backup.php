<?php
/**
 * Plugin Name: Cindemir LCP Guard
 * Description: Performance and mobile layout fixes for cindemir.av.tr.
 * Version: 1.0.5
 * Author: Cindemir Hukuk Bürosu
 */

defined( 'ABSPATH' ) || exit;

function cindemir_mobile_viewport_meta(): void {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">' . "\n";
}
add_action( 'wp_head', 'cindemir_mobile_viewport_meta', 0 );

function cindemir_mobile_head_assets(): void {
	echo "<!-- cindemir-mobile v1.0.5 -->\n";

	$css = <<<'CSS'
@media (max-width: 767px) {
	html, body { overflow-x: hidden; max-width: 100%; }
	body header.menu-wrapper,
	body header.menu-wrapper.fixed {
		position: relative !important;
		top: auto !important;
		left: auto !important;
		right: auto !important;
		width: 100% !important;
		height: auto !important;
		min-height: 0 !important;
		z-index: 1001 !important;
	}
	body header.menu-wrapper .nav-bar-wrapper { position: relative; min-height: 52px; }
	body header.menu-wrapper .nav-bar-wrapper .container {
		position: relative;
		padding-right: 58px;
		padding-left: 12px;
	}
	body header.menu-wrapper .main-menu.hidden-xs,
	body header.menu-wrapper .main-menu.hidden-xs .nav,
	body header.menu-wrapper .main-menu.hidden-xs .nav > li {
		display: none !important;
		visibility: hidden !important;
		height: 0 !important;
		max-height: 0 !important;
		overflow: hidden !important;
		margin: 0 !important;
		padding: 0 !important;
		opacity: 0 !important;
		pointer-events: none !important;
	}
	body header.menu-wrapper .res-menu.hidden-sm.hidden-md.hidden-lg {
		display: block !important;
		width: 100%;
		clear: both;
		position: static !important;
	}
	header.menu-wrapper .navbar-header {
		position: absolute !important;
		top: 8px !important;
		right: 10px !important;
		width: auto !important;
		float: none !important;
		padding: 0 !important;
		text-align: right !important;
		z-index: 1003;
	}
	header.menu-wrapper .navbar-toggle {
		display: inline-flex !important;
		align-items: center;
		justify-content: center;
		position: static !important;
		margin: 0 !important;
		padding: 10px 12px !important;
		min-width: 44px;
		min-height: 44px;
		border: 1px solid rgba(255, 255, 255, 0.45) !important;
		border-radius: 8px;
		color: #fff !important;
		background: rgba(0, 0, 0, 0.15);
	}
	header.menu-wrapper.fixed .navbar-toggle {
		color: #2e5f5f !important;
		border-color: rgba(46, 95, 95, 0.35) !important;
		background: #fff;
	}
	header.menu-wrapper .res-menu .navbar-collapse {
		display: none !important;
		max-height: calc(100vh - 120px);
		overflow-y: auto;
		-webkit-overflow-scrolling: touch;
		background: #fff;
		box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
		border-radius: 0 0 10px 10px;
		margin: 0 0 8px;
	}
	body header.menu-wrapper .res-menu .navbar-collapse.in,
	body header.menu-wrapper .res-menu .navbar-collapse.show,
	body header.menu-wrapper .res-menu .navbar-collapse.cindemir-open {
		display: block !important;
		position: absolute !important;
		top: 100% !important;
		left: 0 !important;
		right: 0 !important;
		z-index: 1002 !important;
		margin: 0 !important;
		height: auto !important;
		transition: none !important;
	}
	body header.menu-wrapper .res-menu .navbar-collapse.collapsing {
		display: none !important;
		height: auto !important;
		transition: none !important;
	}
	header.menu-wrapper .res-menu .nav {
		display: flex !important;
		flex-direction: column !important;
		flex-wrap: nowrap !important;
		justify-content: flex-start !important;
		align-items: stretch !important;
		float: none !important;
		margin: 0 !important;
		padding: 8px 0 !important;
		list-style: none !important;
	}
	header.menu-wrapper .res-menu .nav > li {
		display: block !important;
		float: none !important;
		width: 100%;
		border-bottom: 1px solid rgba(0, 0, 0, 0.06);
	}
	header.menu-wrapper .res-menu .nav > li > a {
		display: block !important;
		padding: 14px 18px !important;
		font-size: 16px !important;
		line-height: 1.4 !important;
		color: #2e5f5f !important;
		white-space: normal !important;
	}
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
	.container {
		width: 100% !important;
		max-width: 100% !important;
		padding-left: 16px !important;
		padding-right: 16px !important;
	}
	img, video, iframe, .elementor-widget-image img {
		max-width: 100% !important;
		height: auto !important;
	}
}
@media (min-width: 768px) {
	header.menu-wrapper .res-menu .navbar-collapse.cindemir-open {
		display: none !important;
	}
}
CSS;

	$js = <<<'JS'
(function(){'use strict';function init(){if(window.matchMedia('(min-width:768px)').matches)return;var h=document.querySelector('header.menu-wrapper');if(!h)return;var t=h.querySelector('.navbar-toggle'),c=h.querySelector('.res-menu .navbar-collapse');if(!t||!c)return;if(t.getAttribute('data-cindemir-bound')==='1')return;t.setAttribute('data-cindemir-bound','1');t.removeAttribute('data-toggle');t.removeAttribute('data-target');if(window.jQuery&&window.jQuery.fn&&window.jQuery.fn.collapse){window.jQuery(c).off('.bs.collapse.data-api');window.jQuery(t).off('click.bs.collapse.data-api');}function open(){return c.classList.contains('cindemir-open');}function set(o){c.classList.remove('collapsing');c.classList.toggle('in',o);c.classList.toggle('show',o);c.classList.toggle('cindemir-open',o);t.setAttribute('aria-expanded',o?'true':'false');}t.setAttribute('aria-controls','cindemir-mobile-nav');c.id='cindemir-mobile-nav';set(false);t.addEventListener('click',function(e){e.preventDefault();e.stopPropagation();e.stopImmediatePropagation();set(!open());},true);c.querySelectorAll('a').forEach(function(l){l.addEventListener('click',function(){if(!l.classList.contains('dropdown-toggle'))set(false);});});document.addEventListener('click',function(e){if(!h.contains(e.target))set(false);});window.addEventListener('resize',function(){if(window.matchMedia('(min-width:768px)').matches)set(false);});var hero=document.querySelector('.elementor-element-8873fd6');if(hero){hero.style.setProperty('padding-bottom','120px','important');}}if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init);else init();})();
JS;

	echo '<style id="cindemir-mobile-fix-css-v105">' . $css . '</style>' . "\n";
	echo '<script id="cindemir-mobile-fix-js-v105" data-no-optimize="1">' . $js . '</script>' . "\n";
}
add_action( 'wp_head', 'cindemir_mobile_head_assets', 1 );
