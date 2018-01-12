// Main Javascipt Source
// Example class and DOMContentLoaded listener

class App {
	
	constructor() {
		console.log('Hello');
	}
	
};

document.addEventListener("DOMContentLoaded", function(event) { 

	// create new App object
	let $bs = new App();
	window.$bs = $bs;
	
});