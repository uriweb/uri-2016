/**
 * File uri-social.js.
 *
 * Handles rollovers for social icons on the front page
 */
 
window.addEventListener("load", function() {
	initSVGHovers();
}, false);

function initSVGHovers() {
	var els = document.querySelectorAll(".social-logo");
	for(var i=0; i<els.length; i++) {
		var svg = els[i].contentDocument;
		svg.addEventListener("mouseover", function() {
			this.getElementById("icon").setAttribute("fill", "#032553");
		})
		svg.addEventListener("mouseout", function() {
			this.getElementById("icon").setAttribute("fill", "#4990E2");
		})
	}
}
