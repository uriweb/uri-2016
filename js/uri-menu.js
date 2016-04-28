/**
 * File uri-menu.js.
 *
 * Handles toggling the main URI menu
 */
 
document.addEventListener("DOMContentLoaded", function() {
	initNav();
}, false);

function initNav() {
	var tab = document.getElementById("nav-toggle");
	var nav = document.getElementById("nav");
	tab.addEventListener("click", toggleNavClass, false);
	nav.className = "closed";
	// @todo: make this elegant
	document.getElementById("nav-close").addEventListener("click", function(){
		nav.className = "closed";
	}, false);
}

function toggleNavClass() {
	var nav = document.getElementById("nav");
	if(nav.className.includes("closed")) {
		nav.className = nav.className.replace(/closed/i, "open");
	} else {
		nav.className = nav.className.replace(/open/, "closed");
	}
}