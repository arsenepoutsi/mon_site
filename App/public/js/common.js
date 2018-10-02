/*
 * GLOBAL VARS
 */
var last_clicked_at = 0;

/* ----------------------------------------------------------------------- */
// file: pagequery_api.js
// javascript query string parsing utils
// pass location.search to the constructor: var page = new PageQuery(location.search)
// get values like: var myValue = page.getValue("param1") etc.
// djohnson@ibsys.com {{djohnson}}
// you may use this file as you wish but please keep this header with it thanks
/* ----------------------------------------------------------------------- */	

function PageQuery(q) {
	if(q.length > 1) this.q = q.substring(1, q.length);
	else this.q = null;
	this.keyValuePairs = new Array();
	if(q) {
		for(var i=0; i < this.q.split("&").length; i++) {
			this.keyValuePairs[i] = this.q.split("&")[i];
		}
	}
	this.getKeyValuePairs = function() { return this.keyValuePairs; }
	this.getValue = function(s) {
		for(var j=0; j < this.keyValuePairs.length; j++) {
			if(this.keyValuePairs[j].split("=")[0] == s)
				return this.keyValuePairs[j].split("=")[1];
		}
		return -1;
	}
	this.getParameters = function() {
		var a = new Array(this.getLength());
		for(var j=0; j < this.keyValuePairs.length; j++) {
			a[j] = this.keyValuePairs[j].split("=")[0];
		}
		return a;
	}
	this.getLength = function() { return this.keyValuePairs.length; }	
}

function queryString(key) {
	var page = new PageQuery(window.location.search); 
	return unescape(page.getValue(key)); 
}

/* --------------------------------------------------------------------------- */

/*
 * Array handling
 */
function isInArray(needle, arrayHaystack) {
	for (var x in arrayHaystack) {
		
		if (arrayHaystack[x].split(":")[0] == needle)
			return true;
	}

	return false;
}

function settingValueInArray(needle, arrayHaystack) {
	for (var x in arrayHaystack) {
		var needle_array = arrayHaystack[x].split(":");
		if (needle_array[0] == needle)
			return needle_array[1];
	}

	return null;
}

/*
 * Cookie handling
 */
function setCookie(_name, _value) {
	if (_value != null && _value != "")
		document.cookie = _name + "=" + _value;
}	

function getCookie(_name) {
	var cookieStr = document.cookie;
	var arr = cookieStr.split(";");
	
	for (var i = 0; i < arr.length; i++) {
		var cookieArr = arr[i].split("=");
		var cookieName = cookieArr[0].replace(" ", "");
		if (cookieName == _name) {
			return unescape(cookieArr[1]);
		}	
	}	

	return null;
}	

/*
 * Check if the given category has non default types
 */
function categoryHasNonDefaultTypes(_cat) {
	var result = false;

	// If no types
	if ( !categoryList[_cat] || !categoryList[_cat]['type']) return false;

	// Type array
	var typeArray = categoryList[_cat]['type'].split(",");

	// For every feature in category
	for (var t in typeArray) {
		// For this type check if its not part of the defaults
		if (!isInArray(typeArray[t], defaultTypes))
			result = true;
	}

	// Has only default types
	return result;
}

/*
 * Check if the given category has the given feature
 */
function categoryHasFeature(_cat, _feature, _type) {
	// Get category
	if (!_type) {
		return categoryList[_cat] && categoryList[_cat]['features'] && categoryList[_cat]['features'].indexOf(_feature) >= 0;
	} else {
		var category_type = category_params[_cat] ? category_params[_cat][_type] : null;
		return (category_type && isInArray(_feature, category_type["include"]));
	}
}

/*!
 * Check if the given  category has a price list, and return it
 */
function categoryHasPriceList(_cat) {
	if (categoryHasFeature(_cat, "pricelist"))
		return categoryList[_cat]['features'].substr(categoryList[_cat]['features'].indexOf('pricelist:')+10, 1);

	return false;
}

/*!
 * Check if the given category has a warning message, and return it
 */
function categoryHasWarning(_cat, _warning_type) {
	if (!categoryList[_cat]) return false;

	var adtype_selected = "";

	if(queryString("st") != -1) {
		adtype_selected = queryString("st");
	} else if (queryString("ca") == -1) {
		adtype_selected = (window.location.href.indexOf("/offres/") != -1) ? "s" : (window.location.href.indexOf("/demandes/") != -1) ? "k" : "s";
	}
	else {
		adtype_selected = queryString("ca").substring(queryString("ca").length - 1);
	}	

	if (categoryHasFeature(_cat, _warning_type)) {
		var warning_code = parseInt(categoryList[_cat]['features'].substr(categoryList[_cat]['features'].indexOf(_warning_type+':')+_warning_type.length+1));
		return eval(_warning_type+"["+warning_code+"]");
	} else if (typeof(categoryList[_cat][_warning_type]) != "undefined"
			&& typeof(categoryList[_cat][_warning_type][adtype_selected]) != "undefined"
			&& categoryList[_cat][_warning_type][adtype_selected].length > 0) {
		return categoryList[_cat][_warning_type][adtype_selected];
	}
	
	return false;
}


/*!
 * Check if the given feature has been selected
 */
function setFeatureVal(_feat, _id) {
	var Item = typeof(_id) == "string" ? getElementById(_id) : _id; 

	var cookie_str = getCookie('features');
	var feat_elements = Item.length;
	if (cookie_str && cookie_str.indexOf(_feat) >= 0) {
		var feature = parseInt(cookie_str.substr(cookie_str.indexOf(_feat+':')+_feat.length+1));
		for (var i = 0; i < feat_elements; i++) {
			if (feature == Item.options[i].value)
				Item.options[i].selected = true;
		}	
	}
}


/*
 * Check if the given feature has been selected
 */
function setRadioVal() {
	var cookie_str = getCookie('features');
	if (cookie_str && cookie_str.indexOf("st") >= 0) {
		var feature = cookie_str.substr(cookie_str.indexOf('st:')+3);
	        for (var j = 0; j < document.f.st.length; j++) {
	                if (document.f.st[j].value == feature) {
	                        document.f.st[j].checked = true;
	                }
	        }
	}
}


/*
 * Gets the ad type from caller argument
 */
function getAdTypeFromCaller(){
	var type;

	if (queryString('ca') < 0) {
		type = (window.location.href.indexOf("/offres/") != -1) ? "s" : (window.location.href.indexOf("/demandes/") != -1) ? "k" : defaultTypes[0];
	} else {	
		var caller = queryString('ca');
		var split_ca = caller.split("_");
		type = split_ca[split_ca.length - 1]
	} 

	return type;
}

/*
 * Layer handling
 */
function showField() {
	var ShowItem = document.getElementById(showField.arguments[0]);
	if (ShowItem)
		ShowItem.style.display = showField.arguments[1];
	if (showField.arguments.length == 3) {
		ShowItem.innerHTML = showField.arguments[2];
	}	
		
}

function scrollToTop() {
	window.scrollTo(0, 0);
}

function scrollToBottom() {
	window.scrollTo(0, 4000);
}

function scrollToObject(offsetTrail) {
	var offsetLeft = 0;
	var offsetTop = 0;

	// Calculate the position
	while (offsetTrail) { 
		offsetLeft += offsetTrail.offsetLeft;
		offsetTop += offsetTrail.offsetTop;
		offsetTrail = offsetTrail.offsetParent;
	}               

	if (typeof(document.body.leftMargin) != "undefined") {
		offsetLeft += document.body.leftMargin;
		offsetTop += document.body.topMargin;
	}       

	// Scroll
	window.scrollTo(0, offsetTop);
}

var focused = false;
function scrollToError(elemId) {
	if (focused) return;
	var offsetTrail = document.getElementById(elemId);

	scrollToObject(offsetTrail);
	
	if (document.getElementById(elemId))
		document.getElementById(elemId).focus();
	focused = true;
} 


function setFocus(_field) {
	if (document.getElementById(_field))
		document.getElementById(_field).focus();
}

function setChecked(_Id, _check) {
	var Item = document.getElementById(_Id);
	  if (Item == null) {
		  //      alert("getElementById("+_Id+") returns null");
		  return;
	  }
	  // BE CAREFUL THAT NO OTHER ELEMENT HAS SAME "name" attribute value THAN THE "id" attribute value YOU'RE LOOKING FOR
	  // IE bug on getElementByID that looks also in "name" attributes
	  //  if (Item.id != _Id)
	  //    {
	  //      alert("getElementById("+_Id+") returns : "+Item.id);
	  //    }
	  if (_check==true) {
		  Item.checked = "checked";
		  //      alert (Item.id+" should become checked");
	  } else {
		  Item.checked = false;
		  //      alert (Item.id+" should become unchecked");
	  }
}

function setValue(_Id, _check) {
	var Item = typeof(_Id) == "string" ? document.getElementById(_Id) : _Id;
	if (Item == null) return;

	Item.value = _check;
}

/*
 * Popup
 */
//window.name = "shl";
var newWin;
function popUp(page, name, details) {
	newWin=window.open(page, name, details);
	newWin.focus();
	return false;
}

/*
 * Table row hiliting for IE
 */
function tableRowHilite() {
	if (document.getElementById("hl") == null) return;
	
	var table = document.getElementById("hl");
	var rows = table.getElementsByTagName('tr');
	
	for (var i = 0; i < rows.length; i++)	{
		rows[i].onmouseover = function() {
			this.className += 'hilite';
		}
		
		rows[i].onmouseout = function()	{
			this.className = this.className.replace('hilite', '');
		}
	}
}

/*
 * Disable and enable input fields in forms
 */
function enable_field(_name) {
	var Item = typeof(_name) == "string" ? document.getElementById(_name) : _name;

	if (Item == null) return;

	if (Item.disabled)
		Item.disabled = false;
}

function disable_field(_name) {
	var Item = typeof(_name) == "string" ? document.getElementById(_name) : _name;

	if (Item == null) return;

	if (!Item.disabled)
		Item.disabled = true;
}

function check_dc(_key) {
	var date = new Date;
	var time = date.getTime();

	if ((last_clicked_at + 2500) >= time) {
		document.getElementById(_key).value = 1;
	} else {
		document.getElementById(_key).value = 0;
	}	
	
	last_clicked_at = time;
}

/*
 * Text area limit
 */
function maxlength(e, obj, max) {
	if (!e) e = window.event; // IE

	if (e.which) {
		var keycode = e.which; // Mozilla
		var ie = false;
	} else {
		var keycode = e.keyCode; // IE
		var ie = true;
	}

	x = obj.value.length;

	if (x > max) {
		obj.value = obj.value.substr(0, max);
		x = max;
	}

	if (keycode == 0 && ie) { // PASTE ONLY FOR IE
		var select_range = document.selection.createRange();	
		var max_insert = max - x + select_range.text.length;
		var data = window.clipboardData.getData("Text").substr(0, max_insert);
		select_range.text = data;
	} else if (x == max && (keycode != 8 && keycode != 46)) {
		return false;
	}

	return true;
}

/*
 * Positioning of elements
 */
function findPosX(obj, end) {
	var curleft = 0;
	var width = obj.clientWidth;

	if (obj.offsetParent) {
		while (obj.offsetParent) {
			curleft += obj.offsetLeft;
			obj = obj.offsetParent;
		}
	} else if (obj.x)
		curleft += obj.x;

	return curleft + (end?width:0);
}

function findPosY(obj, end) {
	var curtop = 0;
	var height = obj.clientHeight;

	if (obj.offsetParent) {
		while (obj.offsetParent) {
			curtop += obj.offsetTop
				obj = obj.offsetParent;
		}
	} else if (obj.y)
		curtop += obj.y;

	return curtop + (end?height:0);
}




/*
 * Progress bar
 */
function progressBar(text) {
	document.write('<div id="loading" class="progressBar">'+text+'<span id="loading_dots"></span></div>');
}

function startProgressBar(pos) {
	var loading = document.getElementById('loading');
	var dots = "";

	pos %= 4;
	for (var i = 0; i < pos; i++)
		dots += ".";
	
	document.getElementById('loading_dots').innerHTML = dots;

	pos++;
	loading.timer = setTimeout('startProgressBar('+pos+')', 500);
}

/*
 * Position progress bar
 */
function showProgressBar(obj) {
	var loading = document.getElementById('loading');

	startProgressBar(1);

	loading.style.top = '' + (findPosY(obj, true)) + 'px';
	loading.style.left = '' + (findPosX(obj, true) + 20) + 'px';
	loading.style.display = "inline";
}

function hideProgressBar() {
	var loading = document.getElementById('loading');

	clearTimeout(loading.timer);
	loading.style.display = 'none';
}

function displayFeatures (_cat, _type, _features) {
	var category_type = category_params[_cat] ? category_params[_cat][_type] : null;
	var added = false;
	var feature_array;

	if (_features)
		feature_array = _features.split(',');
	else if (category_type && category_type["include"])
	        feature_array = category_type["include"];

	for (var feature in features) {
		if (feature_array && isInArray(feature,feature_array)) {
			var label = "l" + feature;	
			var labelid = document.getElementById(label);
			var inner_html = "";
	
			if (!labelid)
				continue;

			labelid.innerHTML = "";
			if (category_type && category_type["labels"] && category_type["labels"][feature]) {
				inner_html = category_type["labels"][feature] + ":";
			} else {
				inner_html = features[feature] + ":";
			
			}	
			labelid.innerHTML = inner_html;
			
			if(feature.indexOf('regdate') >= 0) {
				var idx = 0;
				var list = document.getElementById('regdate');
				var l = eval(regdateList);

				/* lookup for regdate index */
				for(var i =0; i < feature_array.length; ++i) {
					if(feature_array[i].indexOf('regdate') >= 0) {
						var regdate = feature_array[i].split(':');
						idx = regdate[1];
						break;
					}
				}

				var selected = document.getElementById("_regdate").value;

				// Reset the select options
				list.options.length = 1;
				for(var i = l[idx].length - 1, j = 1; i >= 0; --i, ++j) {
					var listval = l[idx][i];

					if(i == 0) {
						listval += " ou avant";
					}

					list.options[j] = new Option(listval, listval);
					if(selected != "") {
						if(l[idx][i].indexOf(selected) >= 0) {
							list.options[j].selected = true;
						} else {
							list.options[j].selected = false;
						}
					} else {
						list.options[j].selected = false;
					}
				}

				selected.value = "";
			}

			showField("d" + feature, "block");
			showField("l" + feature, "block");
			
			// TODO Fix this later in html
			if (feature == "gearbox" || feature == "cubic_capacity")  {
				showField("car_fix", "block");
				added = true;
			}
		} else {
			showField("d" + feature, "none");
			showField("l" + feature, "none");
			if (!added)
				showField("car_fix", "none");
		}	
	}
}

/*
 * Check if the given category/feature has a message, and return it
 */
function showMessages(_cat, _type) {
	try {
		var feature_arr = category_params[_cat][_type]['include'];

		for (var i = 0; i < feature_arr.length; i++) {
			if (typeof messages[_cat] != 'undefined' &&
			    typeof messages[_cat][feature_arr[i]] != 'undefined' &&
			    typeof messages[_cat][feature_arr[i]][_type] != 'undefined') {
				showField("m" + feature_arr[i], "inline", messages[_cat][feature_arr[i]][_type]);
				showField("d" + feature_arr[i], "inline");
				showField("l" + feature_arr[i], "inline");
				showPrice('none', 'dprice', 'lprice');
			} else if (typeof messages['default'][feature_arr[i]] != 'undefined' &&
				   typeof messages['default'][feature_arr[i]][_type] != 'undefined') {

				showField("m" + feature_arr[i], "inline", messages['default'][feature_arr[i]][_type]);
				showField("d" + feature_arr[i], "inline");
				showField("l" + feature_arr[i], "inline");
				showPrice('none', 'dprice', 'lprice');
			}
		}
	
	} catch (e) {
	}	
}

function select_all_weeks(_name, _form, _select) {
	for (var i = 1; i < 53; i++) {
		var week = eval("document." + _form + "." + _name + i);

		week.checked = _select;
	}	
}	

/*
 * Display images. Show border and display large image
 */

// If we don't try to do and image load, the resize wont be correct
// Directly after load we remove the image cause we need next_image to be false for the functions
function fix_next_image() {
	var next_image_load = new Image;
	var timestamp = new Date().getTime() + Math.random();
	next_image_load.src = "/img/none.gif?"+timestamp;
}

function waitForNextImage(next_image, ad_id) {
	var ad_id = ad_id ? ad_id : "";
	var image = document.getElementById("display_image" + ad_id).firstChild;

	if (next_image.width > 0) {
		image.width = next_image.width;
		image.height = next_image.height;
	} else {
		setTimeout(function () { waitForNextImage(next_image, ad_id); }, 100);
	}
}

function resizeImage(image, path, next_image, admin) {
	if (!next_image) {
		next_image = new Image;
		next_image.src = path;
	}

	if (next_image.width == 0) {
		next_image.onload = setTimeout(function () { resizeImage(image, path, next_image, admin); }, 0);
		return;
	}

	image.src = next_image.src;

	if (admin && next_image.width > 400) {
		var factor = (next_image.width - 400) / next_image.width;
		image.height = next_image.height * (1 - factor);
		image.width = 400;
	} else {
		image.width = next_image.width;
		image.height = next_image.height;
	}
}

function showLargeImage(strDisplayPath, ad_id, admin) {
	var ad_id = ad_id ? ad_id : "";
	var admin = admin ? admin : false;
	var image = document.getElementById("display_image" + ad_id).firstChild;

	if (admin) {
		resizeImage(image, strDisplayPath, null, admin);
	} else {
		if (navigator.userAgent.toLowerCase().indexOf('safari') > 0) {
			var next_image = new Image;
			next_image.src = strDisplayPath;

			image.src = next_image.src;
			waitForNextImage(next_image, ad_id);
		} else {
			image.src = strDisplayPath;
		}
	}
}

/* Video */
function flowplayer_conf(video_flv, add_splash, auto_buffer, image_path) {
	var conf = new Object();
	var image_path = image_path ? image_path : false;

	conf.showLoopButton = false;
	conf.showMenu = false;
	conf.autoPlay = false;
	conf.loop = false;
	conf.initialScale = 'scale';
	conf.showFullScreenButton = false;
	conf.fullScreenScriptURL = '';
	conf.bufferLength = 10;
	conf.videoFile = video_flv;

	
	if (auto_buffer) {
		conf.autoBuffering = true;
	} else if (add_splash && video_flv.indexOf('videos') > 0) {
		var video_splash = '';
		if (image_path == false) {
			video_splash = video_flv.replace(/.*videos/, add_splash).replace(/flv/, 'jpg');
		} else {
			var image_id = video_flv.substring(video_flv.lastIndexOf("/"));
			image_id = image_id.replace(/flv/, "jpg");
			video_splash = image_path + image_id.substring(0, 3) + image_id;
		}

		conf.autoBuffering = false;
		conf.splashImageFile = video_splash;
		conf.scaleSplash = true;
	} else if (add_splash && video_flv.indexOf('flush') > 0) {
		var video_splash = video_flv.replace(/flv/, 'splash');

		conf.splashImageFile = video_splash+'/.jpg';
		conf.scaleSplash = true;
	}


	return conf;
}

function flowplayer_conf_to_string(conf) {
        var conf_string = '{';
        for (var i in conf) {
                conf_string += i + ':' + (typeof(conf[i]) == 'string'?"'":'') + conf[i] + (typeof(conf[i]) == 'string'?"'":'');
                conf_string += ',';
        }
        conf_string = conf_string.substring(0, conf_string.length - 1);
        conf_string += '}';
        return conf_string;
}

function hide_video(ad_id) {
	ad_id = ad_id || '';

	var video = document.getElementById('flowplayerholder' + ad_id);
	var image = document.getElementById('display_image' + ad_id);

	if (video) {
		video.style.display = 'none';
		var container = video.parentNode;
		container.removeChild(video);
	}

	if (image)
		image.style.display = 'block';
}

function show_video(video_file, width, height, ad_id) {
	ad_id = ad_id || '';
	var image = document.getElementById('display_image' + ad_id);
	var container = image.parentNode;
	var video = document.getElementById('flowplayerholder' + ad_id);

	var conf = flowplayer_conf(video_file, false);
	conf.autoPlay = true;
	conf = flowplayer_conf_to_string(conf);

	if (ad_id && width > 400)  {
		height = Math.round(400 / width * height);
		width = 400;
	}

	if (!video) {
		video = document.createElement('div');

		video.className = 'ad_pict';

		video.id = 'flowplayerholder' + ad_id;
		container.appendChild(video);

		image.style.display = 'none';

		var fo = { 
			movie:"/swf/FlowPlayer.swf", 
			width:width, 
			height:height, 
			majorversion:"7", 
			build:"0", 
			allowscriptaccess: "always",
			flashvars:"config=" + conf
			};
	
		UFO.create(fo, "flowplayerholder" + ad_id);

	} else if (video.style.display == 'none')  {
		image.style.display = 'none';
		video.style.display = 'block';
	} else {
		var fo = document.getElementById("flowplayerholder" + ad_id + "_obj");
		var time = fo.getTime();
		var dur = fo.getDuration();
		if (time >= dur)
			fo.Seek(0);


		if(!fo.getIsPaused() && fo.getIsPlaying())  {
			fo.Pause();
		} else { 
			fo.DoPlay(); 
		}
	}	
}

function next_image () {
	if(!images[counter])
		counter = 0;

	/* If next item is an video, play video */
	if(video_exist == 1 && counter == 0) {
		var v_thumb = document.getElementById('thumb' + images.length);
		v_thumb.name = 'video';
		counter = 0;

		thumbnailBorder(v_thumb, images.length + 1);
		show_video(video_url, video_width, video_height); 

		return;
	}
		
	/* Preload next image */
	var thumb = document.getElementById('thumb' + counter);
	var image = new Image;
	image.src = image_url + images[counter];

	thumbnailBorder(thumb, images.length);
	showLargeImage(image_url + images[counter]);			

	set_alt_title('main_pict');

	counter++;
}

function set_alt_title(call_div) {
	var main_image = document.getElementById('main_image');
	var adder = 0;

	if(call_div == 'thumb') {
		adder = 1;	
	}	

	/* When next thumb is a video, display other alt/title */
	if(video_exist == 1 && counter == images.length - 1 + adder)
	{
		main_image.alt = 'Voir film';
		main_image.title = 'Voir film';
	} else {
		main_image.alt = 'Cliquez ici pour agrandir';
		main_image.title = 'Cliquez ici pour agrandir';
	}
}

var styles = [];
function thumbnailBorder(thumb, image_num, ad_id) {
	var ad_id = ad_id ? ad_id : "";

	if (thumb.name != 'video')
		hide_video(ad_id);

	for (i = 0; i < image_num; i++) {
		var thumb_obj = document.getElementById('thumb' + i + ad_id);
		if (!styles[i]) {
			styles[i] = thumb_obj.className;
			if (styles[i].indexOf('ad_border_solid_black') > 0) {
				styles[i] = styles[i].substring(0, styles[i].indexOf('ad_border_solid_black')) + 'ad_border_solid_grey';
			}
		}
		thumb_obj.className = styles[i];

		if (thumb.id == thumb_obj.id) {
			thumb_obj.className = "ad_thumb ad_border_solid_black";
			if (thumb.name != 'video') {
				document.getElementById('display_image' + ad_id).className = 'ad_pict' + ((styles[i].indexOf('ad_border_dotted') > 0)?' ad_border_dotted':'');
			}
		}
	}
}

/* Hide image and display image-add input */
function delete_image(element_show, element_hide, hidden) {
	var obj1 = document.getElementById(element_show); 
	var obj2 = document.getElementById(element_hide); 

	obj2.innerHTML = "<input type='hidden' name='" + hidden + "' value='1'>";

	showField(obj1.id, "block");
	showField(obj2.id, "none");

	return false;	
}

function getElementsByClassName(oElm, strTagName, strClassName) {
	var arrElements = (strTagName == "*" && oElm.all)? oElm.all : oElm.getElementsByTagName(strTagName);
	var arrReturnElements = new Array();
	strClassName = strClassName.replace(/\-/g, "\\-");
	var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
	var oElement;
	for(var i=0; i<arrElements.length; i++){
		oElement = arrElements[i];      
		if(oRegExp.test(oElement.className)){
			arrReturnElements[arrReturnElements.length] = oElement;
		}   
	}
	return (arrReturnElements)
}

function show_hidden_elements() {
	var elements = getElementsByClassName(document, "*", 'hide');
	for (var i = 0; i < elements.length; i++) {
		elements[i].className = elements[i].className.replace(/hide/, '');
	}
}

function show_tabbed_data() {
	document.getElementById("tabbed_data").style.display = "block";	
	document.getElementById("show_tabbed_text").style.display = "none";	
}

function hide_tabbed_data() {
	document.getElementById("tabbed_data").style.display = "none";	
	document.getElementById("show_tabbed_text").style.display = "block";	
}

function get_settings(setting_name, keylookup_func) {
	var res;

	for (var i in settings[setting_name]) {
		var setting = settings[setting_name][i];
		var val = null;

		if (settings[setting_name][i]['keys']) {
			for (var j in settings[setting_name][i]['keys']) {
				var key = settings[setting_name][i]['keys'][j];
				var key_val = keylookup_func(key);

				if (setting[key_val]) {
					setting = setting[key_val];
				} else {
					break;
				}	
			}	
			if (setting['value'])
				val = setting['value'];
		} else if (settings[setting_name][i]['default']) {
			val = settings[setting_name][i]['default'];
		}
		if (val) {
			if (res)
				res += ',' + val;
			else
				res = val;
			if (!settings[setting_name][i]['continue'])
				break;
		}
	}
	return res;
}

/* TODO support \ */
function split_setting(val) {
	if (!val)
		return {};

	var arr = val.split(',');
	var res = {};

	for (i = 0; i < arr.length; i++) {
		var kv = arr[i].split(':', 2);

		if (kv && kv.length > 1)
			res[kv[0]] = kv[1];
		else {
			res[arr[i]] = 1;
		}
	}

	return res;
}

function greyText() {
	document.getElementById("zipcoded").style.color = "black";
	document.getElementById("zipcoded").value = "";
}

function show_dpt_code(region, dpt_code_select, dpt_code_cont) {
	var dpt_code = document.getElementById(dpt_code_select);
	var dpt_code_row = null;

	if(dpt_code_cont) {
		if (dpt_code_cont.indexOf(':') == -1) {	
			dpt_code_row = document.getElementById(dpt_code_cont);
			var dpt_code_display = "";
		} else {
			var dpt_code_disp_arr = dpt_code_cont.split(':');
			dpt_code_row = document.getElementById(dpt_code_disp_arr[0]);
			var dpt_code_display = "inline";
		}
	}
	dpt_code.options.length = 1;

	if (typeof(region_departments[region]) == undefined) {
		if(dpt_code_cont)
			dpt_code_cont.style.display = "none";	
		return;
	}

	var count = 1;
	for (var i in region_departments[region]) {
		dpt_code.options[count] = new Option(region_departments[region][i], i);	
		if (dpt_code.value == region_departments[region][i]) dpt_code.options[i].selected = true;
		count++;
	}

	var div_label = document.getElementById(dpt_code_select + '_div_1');
	var div_select = document.getElementById(dpt_code_select + '_div_2');
	if(count > 1) { 
		div_label.style.display = "block";
		div_select.style.display = "block";
		if(dpt_code_row)
			dpt_code_row.style.display = dpt_code_display;	
		dpt_code.focus();
	} else {
		div_label.style.display = "none";
		div_select.style.display = "none";
	}
}

function pro_account_info_title_show()
{
	var obj = document.getElementById("pro_account_cursor");

	obj.style.left="37px";
	obj.style.top="60px";

	obj.style.visibility="visible";
	obj.innerHTML = "retour à la page d'accueil";
}

function pro_account_info_title_hide()
{
	var obj = document.getElementById("pro_account_cursor");

	obj.style.visibility="hidden";
}

/* adview save ads */

function deleteCookie(name, path, domain) {
	document.cookie = name + "=" + ( ( path ) ? ";path=" + path : "") +
		(( domain ) ? ";domain=" + domain : "" ) +
		";expires=Thu, 01-Jan-1970 00:00:01 GMT";
}

function set_watch_ads_creation_cookie(cname, listid, domain)
{
	var expdate = new Date();

	expdate.setTime(expdate.getTime() + (180 * 24 * 3600 * 1000));

	document.cookie = cname + "=" + listid + ";path=/" + ";expires=" + expdate.toGMTString();
}

function adview_watch_ads_display_msg(msg, linktag, link)
{
	var div = document.getElementById("ad_saved");
	var span = document.getElementById("ad_saved_msg");

	name = navigator.appName;

	if(name == 'Microsoft Internet Explorer') {
		div.style.setAttribute("cssText","color: black;display: block;border:1px solid black");
	} else {
		div.setAttribute("style","display: block;");
	}

	span.innerHTML= msg + ' ' + '<a href="' + link + '">' + linktag + '</a>';
}

function append_watch_ads_creation_cookie(c_start, cname, listid, domain)
{
	c_start = c_start + cname.length + 1; 
	c_end = document.cookie.indexOf(";", c_start);
	if (c_end == -1) 
		c_end = document.cookie.length;

	var value = document.cookie.substring(c_start, c_end);
	var ids = value.split(',');

	for (var i=0; i< ids.length; ++i) {
		if(ids[i].match(listid))
			return;
	}

	ids.push(listid);
	value = ids.join(",");

	deleteCookie(cname, '/', "");

	set_watch_ads_creation_cookie(cname, value, domain);
}

function adview_save_ad(listid, domain, myads_link, type)
{
	var cname = 'watch_ads';

	if(document.cookie.length > 0) {
		var c_start = document.cookie.indexOf(cname + "=");

		if (c_start == -1) {
			set_watch_ads_creation_cookie(cname, listid, domain);
		} else {
			append_watch_ads_creation_cookie(c_start, cname, listid, domain);
		}
	} else {
		set_watch_ads_creation_cookie(cname, listid, domain);
	}

	/* Check if cookie as really been written, so test if cookie is enabled */
	if(document.cookie.length > 0 && 
			document.cookie.indexOf(cname + "=") != -1) {
		adview_watch_ads_display_msg('Cette annonce est sauvegardée dans', '"Mes Annonces"', myads_link);
	} else {
		window.location = myads_link + "&aid=" + listid + "&cmd=" + type;
	}

	xt_click(this,'C','0','sauvegarder_v2','N');
}

function is_digit(aChar)
{
	var c = aChar.charCodeAt(0);

	if((c > 47) && (c < 58)) {
		return true;
	}

	return false;
}

function is_alpha(aChar)
{
	var c = aChar.charCodeAt(0);

	if(((c > 64) && (c <  91)) || ((c > 96) && (c < 123))) {
		return true;
	}

	return false;
}

function isalnum(c)
{
	return (is_digit(aChar) || is_alpha(aChar));
}

function alnumuscorify(words) {
	words = words.toLowerCase();

	words = words.replace(/[áàâä]/g, 'a');
	words = words.replace(/[éèêë]/g, 'e');
	words = words.replace(/[íìîï]/g, 'i');
	words = words.replace(/[óòôö]/g, 'o');
	words = words.replace(/[úùûü]/g, 'u');
	words = words.replace(/ÿ/g, 'y');
	words = words.replace(/ç/g, 'c');
	words = words.replace(/¤/g, 'e');
	words = words.replace(/²/g, '2');
	words = words.replace(/³/g, '3');
	words = words.replace(/[^a-zA-Z0-9]+/g, '_');

	return words;
}

function iso885915_escape(str) {
	var conv = new Array();

	conv["€"] = "%80"; conv[""] = "%81"; conv["‚"] = "%82"; conv["ƒ"] = "%83"; 
	conv["„"] = "%84"; conv["…"] = "%85"; conv["†"] = "%86"; conv["‡"] = "%87"; 
	conv["ˆ"] = "%88"; conv["‰"] = "%89"; conv["Š"] = "%8A"; conv["‹"] = "%8B"; 
	conv["Œ"] = "%8C"; conv[""] = "%8D"; conv["Ž"] = "%8E"; conv[""] = "%8F"; 
	conv[""] = "%90"; conv["‘"] = "%91"; conv["’"] = "%92"; conv["“"] = "%93"; 
	conv["”"] = "%94"; conv["•"] = "%95"; conv["–"] = "%96"; conv["—"] = "%97"; 
	conv["˜"] = "%98"; conv["™"] = "%99"; conv["š"] = "%9A"; conv["›"] = "%9B"; 
	conv["œ"] = "%9C"; conv[""] = "%9D"; conv["ž"] = "%9E"; conv["Ÿ"] = "%9F"; 
	conv[" "] = "%A0"; conv["¡"] = "%A1"; conv["¢"] = "%A2"; conv["£"] = "%A3"; 
	conv["¤"] = "%A4"; conv["¥"] = "%A5"; conv["¦"] = "%A6"; conv["§"] = "%A7"; 
	conv["¨"] = "%A8"; conv["©"] = "%A9"; conv["ª"] = "%AA"; conv["«"] = "%AB"; 
	conv["¬"] = "%AC"; conv["­"] = "%AD"; conv["®"] = "%AE"; conv["¯"] = "%AF"; 
	conv["°"] = "%B0"; conv["±"] = "%B1"; conv["²"] = "%B2"; conv["³"] = "%B3"; 
	conv["´"] = "%B4"; conv["µ"] = "%B5"; conv["¶"] = "%B6"; conv["·"] = "%B7"; 
	conv["¸"] = "%B8"; conv["¹"] = "%B9"; conv["º"] = "%BA"; conv["»"] = "%BB"; 
	conv["¼"] = "%BC"; conv["½"] = "%BD"; conv["¾"] = "%BE"; conv["¿"] = "%BF"; 
	conv["À"] = "%C0"; conv["Á"] = "%C1"; conv["Â"] = "%C2"; conv["Ã"] = "%C3"; 
	conv["Ä"] = "%C4"; conv["Å"] = "%C5"; conv["Æ"] = "%C6"; conv["Ç"] = "%C7"; 
	conv["È"] = "%C8"; conv["É"] = "%C9"; conv["Ê"] = "%CA"; conv["Ë"] = "%CB"; 
	conv["Ì"] = "%CC"; conv["Í"] = "%CD"; conv["Î"] = "%CE"; conv["Ï"] = "%CF"; 
	conv["Ð"] = "%D0"; conv["Ñ"] = "%D1"; conv["Ò"] = "%D2"; conv["Ó"] = "%D3"; 
	conv["Ô"] = "%D4"; conv["Õ"] = "%D5"; conv["Ö"] = "%D6"; conv["×"] = "%D7"; 
	conv["Ø"] = "%D8"; conv["Ù"] = "%D9"; conv["Ú"] = "%DA"; conv["Û"] = "%DB"; 
	conv["Ü"] = "%DC"; conv["Ý"] = "%DD"; conv["Þ"] = "%DE"; conv["ß"] = "%DF"; 
	conv["à"] = "%E0"; conv["á"] = "%E1"; conv["â"] = "%E2"; conv["ã"] = "%E3"; 
	conv["ä"] = "%E4"; conv["å"] = "%E5"; conv["æ"] = "%E6"; conv["ç"] = "%E7"; 
	conv["è"] = "%E8"; conv["é"] = "%E9"; conv["ê"] = "%EA"; conv["ë"] = "%EB"; 
	conv["ì"] = "%EC"; conv["í"] = "%ED"; conv["î"] = "%EE"; conv["ï"] = "%EF"; 
	conv["ð"] = "%F0"; conv["ñ"] = "%F1"; conv["ò"] = "%F2"; conv["ó"] = "%F3"; 
	conv["ô"] = "%F4"; conv["õ"] = "%F5"; conv["ö"] = "%F6"; conv["÷"] = "%F7"; 
	conv["ø"] = "%F8"; conv["ù"] = "%F9"; conv["ú"] = "%FA"; conv["û"] = "%FB"; 
	conv["ü"] = "%FC"; conv["ý"] = "%FD"; conv["þ"] = "%FE"; conv["ÿ"] = "%FF"; 

	conv["!"] = "%21"; conv["$"] = "%24"; conv["'"] = "%27"; conv["("] = "%28";
	conv[")"] = "%29"; conv["*"] = "%2A"; conv["+"] = "%2B"; conv[","] = "%2C";
	conv["="] = "%3D"; 
	
	var new_str = "";
	for(i = 0 ; i < str.length; ++i) {
		if((str.charCodeAt(i) > 127 && typeof(conv[str.charAt(i)]) != 'undefined') || typeof(conv[str.charAt(i)]) != 'undefined') {
			new_str += conv[str.charAt(i)];
		} else if(str.charCodeAt(i) < 256) {
			new_str += str.charAt(i);
		}
	}

	return new_str;
}

/* Boutique */
function boutique_characters(textarea, msg, n) {
	var t = document.getElementById(textarea);
	var left = 0;

	if (t.value.length > n) {
		t.value = t.value.substring(0, n - 1);
		left = 0;
	} else {
		left = n - t.value.length;
	}

	var m = document.getElementById(msg);
	m.innerHTML = left + " caract&egrave;res restants.";
}

