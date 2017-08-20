

function getCorrespondingWidth() {

	var windowWidth = window.innerWidth;
	var factor = 1;

	if(windowWidth < 871) {
		factor = 1/1.3;
	}
	else if(windowWidth < 1400) {
		factor = 1/2;
	}
	else {
		factor = 1/2.4;
	}

	return window.innerWidth * factor;
}

function getCorrespondingHeight(){
	var windowHeight = window.innerHeight;
	var factor = 1;

	if(windowHeight < 680) {
		factor = 0;
	}
	else {
		factor = 1/10;
	}

	return window.innerWidth * factor;
}