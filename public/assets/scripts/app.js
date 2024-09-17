/******/ (() => { // webpackBootstrap
// Select2

$(document).ready(function () {
	$('.select2').select2({
			tags: true,
			createTag: function (params) {
					return {
							id: params.term,
							text: params.term,
							newOption: true
					}
			},
			templateResult: function (data) {
					var $result = $("<span></span>");
					$result.text(data.text);

					if (data.newOption) {
							$result.append(" <em>(novo)</em>");
					}

					return $result;
			}
	});
});

// Menus

let subMenu = document.querySelector('.main-menu__submenu');
let viewportWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

if ( subMenu ) {
	let subMenuList = document.querySelectorAll('.main-menu__item--submenu');
	let subMenuUL = document.querySelectorAll('.main-menu__list>.main-menu__item>.main-menu__submenu');

	for (i = 0; i < subMenuList.length; ++i) {
			
		// Expand button
		let subMenuSpan = document.createElement('span');
		let subMenuSpanText = document.createTextNode('Expandir');
		subMenuSpan.className = 'main-menu__item__expand';
		subMenuSpan.appendChild(subMenuSpanText);
		subMenuList[i].insertBefore(subMenuSpan, subMenuUL[i]);

		function subMenuMobile() {
			this.parentNode.classList.toggle('main-menu__item--submenu-active');
		}
		subMenuSpan.addEventListener('click', subMenuMobile);

	};
}
/******/ })()
;