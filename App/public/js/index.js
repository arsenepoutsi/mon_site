/*
 * Index page scripts 
 */

/* 
 * Preload onmouseover images
 */
function preload_image(_image) {
	var image = new Image;
	image.src = _image;
}

/* 
 * Change county image onmouseover on index page 
 */
function change_image(region) {
	var ShowItem = document.getElementById("area_image");
	var LinkItem = document.getElementById("county_" + region);
	ShowItem.style.backgroundImage = 'url(/public/img/map_' + region + '.gif)';
	LinkItem.style.textDecoration = "underline";
	return true;
}

/* 
 * Change back county image onmouseout on index page
 */ 
function hide_image(region) {
	var ShowItem = document.getElementById("area_image");
	var LinkItem = document.getElementById("county_" + region);
	ShowItem.style.backgroundImage = 'url(/public/img/none.gif)';
	LinkItem.style.textDecoration = "none";
	return true;
}

var newWin;
function popUp(page, name, details)
{
	newWin=window.open(page, name, details);
	newWin.focus();    
	return false;  
}    

