/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'fontawesome\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-eye-open' : '&#xf06e;',
			'icon-eye-close' : '&#xf070;',
			'icon-pencil' : '&#xf040;',
			'icon-plus' : '&#xf067;',
			'icon-minus' : '&#xf068;',
			'icon-exclamation-sign' : '&#xf06a;',
			'icon-magic' : '&#xf0d0;',
			'icon-mobile' : '&#xf10b;',
			'icon-tablet' : '&#xf10a;',
			'icon-laptop' : '&#xf109;',
			'icon-desktop' : '&#xf108;',
			'icon-double-angle-up' : '&#xf102;',
			'icon-double-angle-down' : '&#xf103;',
			'icon-angle-left' : '&#xf104;',
			'icon-angle-right' : '&#xf105;',
			'icon-angle-up' : '&#xf106;',
			'icon-angle-down' : '&#xf107;',
			'icon-lightbulb' : '&#xf0eb;',
			'icon-cloud-upload' : '&#xf0ee;',
			'icon-cloud-download' : '&#xf0ed;',
			'icon-wrench' : '&#xf0ad;',
			'icon-trash' : '&#xf014;',
			'icon-home' : '&#xf015;',
			'icon-cog' : '&#xf013;',
			'icon-camera' : '&#xf030;',
			'icon-ok' : '&#xf00c;',
			'icon-remove' : '&#xf00d;',
			'icon-zoom-in' : '&#xf00e;',
			'icon-zoom-out' : '&#xf010;',
			'icon-camera-retro' : '&#xf083;',
			'icon-key' : '&#xf084;',
			'icon-upload-alt' : '&#xf093;',
			'icon-money' : '&#xf0d6;',
			'icon-envelope-alt' : '&#xf0e0;',
			'icon-reorder' : '&#xf0c9;',
			'icon-certificate' : '&#xf0a3;',
			'icon-warning-sign' : '&#xf071;',
			'icon-user' : '&#xf007;',
			'icon-file' : '&#xf016;',
			'icon-straight-lights' : '&#xe000;',
			'icon-resize-full' : '&#xf065;',
			'icon-curve-lights' : '&#xe001;',
			'icon-details' : '&#xe003;',
			'icon-bow' : '&#xe004;',
			'icon-wreath' : '&#xe002;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};