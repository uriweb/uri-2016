/**
 * File uri-search.js.
 *
 * Adds an option to search globally
 */

window.addEventListener("load", function() {
	initGlobalSearch();
}, false);

function initGlobalSearch() {
	var f = document.querySelector('#uri-header .search-form');
	f.dataset.originalAction = f.action;
	f.dataset.googleAction = wordpress_environment.base_url + '/uri-search';
	f.dataset.cx = '016863979916529535900:17qai8akniu';
	
	var cx =  document.createElement('input');
	cx.type='hidden';
	cx.name='cx';
	cx.className='cx-field';
	cx.value='';
	f.appendChild(cx);
	
	addRadioButtons(f);
}

function addRadioButtons(f) {
	
	var soc = document.createElement('div');
	soc.id = 'search-options-container';
	
	var ls = document.createElement('input');
	ls.type='radio';
	ls.name='search-option';
	ls.value='uritoday';
	ls.id='local-search';
	ls.addEventListener('click', switchToLocalSearch, false);
	var lsl = document.createElement('label');
	lsl.className='search-options';
	lsl.appendChild(ls);
	lsl.appendChild(document.createTextNode('URI Today'));
	
	soc.appendChild(lsl);
	
	var gs = document.createElement('input');
	gs.type='radio';
	gs.name='search-option';
	gs.value='google';
	gs.id='global-search';
	var gsl = document.createElement('label');
	gsl.className='search-options';
	gsl.appendChild(gs);
	gsl.appendChild(document.createTextNode('All of URI'));
	
	gs.addEventListener('click', switchToGoogleSearch, false);

	
	soc.appendChild(gsl);
	
	f.appendChild(soc);
	
	if(window.location.href.search(/s=/) != -1) {
		ls.click();
	} else {
		gs.click();
	}
	
}

function switchToLocalSearch(e) {
	var f = document.querySelector('#uri-header .search-form');
	f.action = f.dataset.originalAction;
	var field = document.querySelector('#uri-header .search-field');
	field.name = 's';
}

function switchToGoogleSearch(e) {
	var f = document.querySelector('#uri-header .search-form');
	f.action = f.dataset.googleAction;

	var ls = document.createElement('input');
	ls.type='radio';
	ls.name='search-option';
	ls.value='uritoday';
	ls.id='local-search';
	
	var field = document.querySelector('#uri-header .search-field');
	field.name = 'q';

	var cx = document.querySelector('#uri-header .cx-field');
	cx.value = f.dataset.cx;
	
	
}