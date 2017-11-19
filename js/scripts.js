// Main Javascipt Source
// Example class and DOMContentLoaded listener

class App {
	
	constructor(opts = {}) {
		
		// initalize offcanvas
		//UIkit.offcanvas('#offcanvas').toggle();
	}
	
};

document.addEventListener("DOMContentLoaded", function(event) { 

	// create new App object
	let $bs = new App();
	window.$bs = $bs;
	
});