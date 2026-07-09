<?php
/**
 * Plugin Name: Cindemir LCP Guard
 * Description: Performance and mobile layout fixes for cindemir.av.tr.
 * Version: 1.0.8
 * Author: Cindemir Hukuk Bürosu
 */

defined( 'ABSPATH' ) || exit;

function cindemir_lang_flag_map(): array {
	return array(
		'tr' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAARVBMVEX+AAD3AADwAAD+fHz9cHH7ZGT9WVn6UFDpAAD9oKD5Q0P5OTn2MzP1Kir7ubr65ub1Gxv69PTzDw/kAAD319ffAAD4iooXHQ3FAAAAYklEQVR4AT3HhW0EQRQD0Oc/KG3/dQYEYTg2O+4IQbTHydWt0fw2Sfz8Fuw51+U3On7a6/pc/as1UZLDyuq13lWOwpdPn3+v7XJiDD3DR1N87Qr5WXX9zyQ9opEIOwkmDgr/ZXASmpFRqe0AAAAASUVORK5CYII=',
		'en' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAmVBMVEViZsViZMJiYrf9gnL8eWrlYkjgYkjZYkj8/PujwPybvPz4+PetraBEgfo+fvo3efkydfkqcvj8Y2T8UlL8Q0P8MzP9k4Hz8/Lu7u4DdPj9/VrKysI9fPoDc/EAZ7z7IiLHYkjp6ekCcOTk5OIASbfY/v21takAJrT5Dg6sYkjc3Nn94t2RkYD+y8KeYkjs/v7l5fz0dF22YkjWvcOLAAAAgElEQVR4AR2KNULFQBgGZ5J13KGGKvc/Cw1uPe62eb9+Jr1EUBFHSgxxjP2Eca6AfUSfVlUfBvm1Ui1bqafctqMndNkXpb01h5TLx4b6TIXgwOCHfjv+/Pz+5vPRw7txGWT2h6yO0/GaYltIp5PT1dEpLNPL/SdWjYjAAZtvRPgHJX4Xio+DSrkAAAAASUVORK5CYII=',
		'ru' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAdVBMVEX19f/u7vjm5/H+/v75+fng4Ove3ulFRfyysv6cnP6QkPmIiPh/f/YAAOYAAP1ycv5QUP06OvkxMfcoKPcgIPYUFPS0AADdaYzTRG/RPGnOM2LKLFzIIVPCEUZ7AAD0AQH7YGH3ODj0JyfzERDgAAD4TU3pAABIfLuPAAAAT0lEQVR4AQXBAQqDMAAAsZytyHzA/v9LYRS7JIAQMkBb0ATsgLoKInnHvIrHrdRaBzxupTDxuFUifUsp4R3zU4iwzmOyT1ibBtP2u3C+wB+SHBB5JNY7DAAAAABJRU5ErkJggg==',
		'zh' => 'data:image/svg+xml,' . rawurlencode( '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 20"><rect fill="#de2910" width="30" height="20"/><polygon fill="#ffde00" points="5,3 5.9,5.8 8.8,5.8 6.4,7.5 7.3,10.4 5,8.6 2.7,10.4 3.6,7.5 1.2,5.8 4.1,5.8"/></svg>' ),
	);
}

function cindemir_mobile_viewport_meta(): void {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">' . "\n";
}
add_action( 'wp_head', 'cindemir_mobile_viewport_meta', 0 );

function cindemir_mobile_head_assets(): void {
	echo "<!-- cindemir-mobile v1.0.8 -->\n";

	$css = <<<'CSS'
.lang-item img,
.pll-parent-menu-item img,
.cindemir-lang-btn img {
	display: inline-block !important;
	visibility: visible !important;
	opacity: 1 !important;
	width: 22px !important;
	height: 15px !important;
	max-width: 22px !important;
	max-height: 15px !important;
	min-width: 22px !important;
	min-height: 15px !important;
	flex-shrink: 0 !important;
	border-radius: 1px !important;
	object-fit: cover !important;
	vertical-align: middle !important;
	box-shadow: none !important;
}
.lang-item a,
.pll-parent-menu-item > a {
	display: inline-flex !important;
	align-items: center !important;
	gap: 6px !important;
}
.pll-parent-menu-item .dropdown-menu a {
	display: flex !important;
	align-items: center !important;
	gap: 8px !important;
	padding: 10px 16px !important;
}
@media (max-width: 767px) {
	html, body { overflow-x: hidden; max-width: 100%; }
	body header.menu-wrapper,
	body header.menu-wrapper.fixed {
		position: sticky !important;
		top: 0 !important;
		left: auto !important;
		right: auto !important;
		width: 100% !important;
		height: auto !important;
		min-height: 0 !important;
		z-index: 1001 !important;
		background: rgba(46, 95, 95, 0.97) !important;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
	}
	body.admin-bar header.menu-wrapper,
	body.admin-bar header.menu-wrapper.fixed {
		top: 46px !important;
	}
	body header.menu-wrapper .nav-bar-wrapper { position: relative; min-height: 52px; }
	body header.menu-wrapper .nav-bar-wrapper .container {
		position: relative;
		padding-right: 112px;
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
		position: relative !important;
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
		display: inline-flex !important;
		align-items: center !important;
		gap: 6px !important;
	}
	.cindemir-lang-btn {
		display: inline-flex !important;
		align-items: center !important;
		justify-content: center !important;
		gap: 4px !important;
		margin: 0 !important;
		padding: 10px 10px !important;
		min-width: 44px !important;
		min-height: 44px !important;
		border: 1px solid rgba(255, 255, 255, 0.45) !important;
		border-radius: 8px !important;
		background: rgba(0, 0, 0, 0.15) !important;
		color: #fff !important;
		cursor: pointer !important;
		line-height: 1 !important;
	}
	header.menu-wrapper.fixed .cindemir-lang-btn {
		border-color: rgba(46, 95, 95, 0.35) !important;
		background: #fff !important;
	}
	.cindemir-lang-caret {
		width: 0;
		height: 0;
		border-left: 4px solid transparent;
		border-right: 4px solid transparent;
		border-top: 5px solid #fff;
	}
	header.menu-wrapper.fixed .cindemir-lang-caret {
		border-top-color: #2e5f5f;
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
		max-height: calc(100vh - 72px) !important;
		transition: none !important;
	}
	body.admin-bar header.menu-wrapper .res-menu .navbar-collapse.in,
	body.admin-bar header.menu-wrapper .res-menu .navbar-collapse.show,
	body.admin-bar header.menu-wrapper .res-menu .navbar-collapse.cindemir-open {
		max-height: calc(100vh - 118px) !important;
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
	header.menu-wrapper .res-menu .nav > .pll-parent-menu-item {
		display: none !important;
	}
	.pll-parent-menu-item.cindemir-lang-open > .dropdown-menu {
		display: block !important;
		position: fixed !important;
		top: 62px !important;
		right: 10px !important;
		left: auto !important;
		min-width: 190px !important;
		z-index: 1011 !important;
		background: #fff !important;
		box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
		border-radius: 8px !important;
		padding: 6px 0 !important;
		margin: 0 !important;
	}
	body.admin-bar .pll-parent-menu-item.cindemir-lang-open > .dropdown-menu {
		top: 108px !important;
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
	.lang-item img, .pll-parent-menu-item img, .cindemir-lang-btn img {
		max-width: 22px !important;
		height: 15px !important;
	}
}
@media (min-width: 768px) {
	header.menu-wrapper .res-menu .navbar-collapse.cindemir-open {
		display: none !important;
	}
}
CSS;

	echo '<style id="cindemir-mobile-fix-css-v108">' . $css . '</style>' . "\n";
}
add_action( 'wp_head', 'cindemir_mobile_head_assets', 999 );

function cindemir_mobile_footer_scripts(): void {
	$flags_json = wp_json_encode( cindemir_lang_flag_map() );
	$js         = <<<JS
(function(){'use strict';
var FLAGS={$flags_json};
function langCode(li){if(!li)return null;if(li.classList.contains('pll-parent-menu-item')){var l=(document.documentElement.lang||'tr').toLowerCase();return l.split('-')[0];}var m=li.className.match(/lang-item-([a-z]{2})/);return m?m[1]:null;}
function broken(img){if(!img||!img.src)return true;return img.src.indexOf('svg+xml')>=0&&img.src.indexOf('viewBox')>=0&&img.src.length<120;}
function fixImg(img,code){if(!img)return;var src=FLAGS[code]||'';if(!src){var ns=img.parentElement&&img.parentElement.querySelector('noscript img');if(ns&&ns.getAttribute('src'))src=ns.getAttribute('src');}if(!src||!broken(img))return;img.src=src;img.removeAttribute('data-lazy-src');img.setAttribute('loading','eager');img.setAttribute('data-no-lazy','1');}
function initFlags(){document.querySelectorAll('.pll-parent-menu-item,.lang-item').forEach(function(li){fixImg(li.querySelector('a img'),langCode(li));});}
function closeLang(){document.querySelectorAll('.pll-parent-menu-item.cindemir-lang-open').forEach(function(li){li.classList.remove('cindemir-lang-open','open');});var b=document.getElementById('cindemir-lang-btn');if(b)b.setAttribute('aria-expanded','false');}
function initMobileLang(){if(!window.matchMedia('(max-width:767px)').matches)return;var pll=document.querySelector('.res-menu .pll-parent-menu-item')||document.querySelector('.pll-parent-menu-item');if(!pll||document.getElementById('cindemir-lang-btn'))return;var menu=pll.querySelector('.dropdown-menu');var header=document.querySelector('header.menu-wrapper .navbar-header');if(!menu||!header)return;var code=langCode(pll);var btn=document.createElement('button');btn.id='cindemir-lang-btn';btn.type='button';btn.className='cindemir-lang-btn';btn.setAttribute('aria-label','Dil seçimi');btn.setAttribute('aria-expanded','false');var img=document.createElement('img');img.alt='';img.width=22;img.height=15;fixImg(img,code);btn.appendChild(img);var caret=document.createElement('span');caret.className='cindemir-lang-caret';btn.appendChild(caret);header.insertBefore(btn,header.firstChild);btn.addEventListener('click',function(e){e.preventDefault();e.stopPropagation();e.stopImmediatePropagation();var open=pll.classList.contains('cindemir-lang-open');closeLang();if(!open){pll.classList.add('cindemir-lang-open','open');btn.setAttribute('aria-expanded','true');}},true);menu.querySelectorAll('a').forEach(function(a){a.addEventListener('click',closeLang);});}
function initMobileNav(){if(window.matchMedia('(min-width:768px)').matches)return;var h=document.querySelector('header.menu-wrapper');if(!h)return;var t=h.querySelector('.navbar-toggle'),c=h.querySelector('.res-menu .navbar-collapse');if(!t||!c)return;if(t.getAttribute('data-cindemir-bound')==='1')return;t.setAttribute('data-cindemir-bound','1');t.removeAttribute('data-toggle');t.removeAttribute('data-target');if(window.jQuery&&window.jQuery.fn&&window.jQuery.fn.collapse){window.jQuery(c).off('.bs.collapse.data-api');window.jQuery(t).off('click.bs.collapse.data-api');}function open(){return c.classList.contains('cindemir-open');}function set(o){c.classList.remove('collapsing');c.classList.toggle('in',o);c.classList.toggle('show',o);c.classList.toggle('cindemir-open',o);t.setAttribute('aria-expanded',o?'true':'false');if(o)closeLang();}t.setAttribute('aria-controls','cindemir-mobile-nav');c.id='cindemir-mobile-nav';set(false);t.addEventListener('click',function(e){e.preventDefault();e.stopPropagation();e.stopImmediatePropagation();set(!open());},true);c.querySelectorAll('a').forEach(function(l){l.addEventListener('click',function(){if(!l.classList.contains('dropdown-toggle'))set(false);});});document.addEventListener('click',function(e){var lb=document.getElementById('cindemir-lang-btn');if(!h.contains(e.target)&&!(lb&&lb.contains(e.target)))set(false);if(!e.target.closest('.pll-parent-menu-item')&&!(lb&&lb.contains(e.target)))closeLang();});window.addEventListener('resize',function(){if(window.matchMedia('(min-width:768px)').matches){set(false);closeLang();}});var hero=document.querySelector('.elementor-element-8873fd6');if(hero){hero.style.setProperty('padding-bottom','120px','important');}}
function init(){initFlags();initMobileLang();initMobileNav();}
if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init);else init();
})();
JS;

	echo '<script type="text/javascript" id="cindemir-mobile-fix-js-v108" data-no-optimize="1" data-cfasync="false" data-no-defer="1" data-no-minify="1">' . $js . '</script>' . "\n";
}
add_action( 'wp_footer', 'cindemir_mobile_footer_scripts', 999 );

function cindemir_rocket_exclude_js( array $excluded ): array {
	$excluded[] = 'cindemir-mobile-fix-js-v108';
	$excluded[] = 'FLAGS';
	$excluded[] = 'cindemir-lang-btn';
	return $excluded;
}
add_filter( 'rocket_exclude_js', 'cindemir_rocket_exclude_js' );
add_filter( 'rocket_delay_js_exclusions', 'cindemir_rocket_exclude_js' );
add_filter( 'rocket_excluded_inline_js_content', 'cindemir_rocket_exclude_js' );
