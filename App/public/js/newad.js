/* Browser detection */
function compare_version(ver1, ver2) {
	if (typeof(ver1) == 'string')
		ver1 = ver1.split('.');
	else if (typeof(ver1) == 'number')
		ver1 = [ver1];

	if (typeof(ver2) == 'string')
		ver2 = ver2.split('.');
	else if (typeof(ver2) == 'number')
		ver2 = [ver2];

	var i = 0;
	while (1) {
		if (!ver1[i]) {
			if (!ver2[i])
				return 0;
			else
				return 1;
		} else if (!ver2[i])
			return -1;

		if (parseInt(ver1[i]) > parseInt(ver2[i]))
			return -1;
		else if (parseInt(ver1[i]) < parseInt(ver2[i]))
			return 1;

		i++;
	}
}

var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		var version = dataString.substring(index+this.versionSearchString.length+1);

		if (version.indexOf(' ') > 0) {
			version = version.substring(0, version.indexOf(' '));
		}

		return version;
	},
	isValid: function (browsers) {
		var i = 0;
		var valid = false;

		for (i = 0; i < browsers.length; i++) {
			if (browsers[i].agent == this.browser) {
				if (compare_version(browsers[i].version, this.version) >= 0) {
					valid = true;
					break;
				}
			}

		}

		return valid;
	},
	dataBrowser: [
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};
BrowserDetect.init();

//If javascript enabled don't do php check
function setJavascriptON() {
	document.getElementById("check_type_diff").value = 0;
}

function getCheckedTypeId() {
	for (i = 0; i < document.formular.type.length; i++) {
		if (document.formular.type[i].checked == true) {
			return "r"+document.formular.type[i].value.toUpperCase(); 
		}
	}

	return "rS";
}

function getCheckedTypeVal() {
	for (i = 0; i < document.formular.type.length; i++) {
		if (document.formular.type[i].checked == true) {
			return document.formular.type[i].value; 
		}
	}

	return "s";
}

function showWarning(_category, _warning, _warn_id) {
	var warn_element = document.getElementById(_warn_id);
	var warn_text = categoryHasWarning(_category, _warning);

	if (!warn_element) {
		return false;
	}

	if (!warn_text) {
		warn_element.innerHTML = "";
		showField(_warn_id, "none");
	} else {
		warn_element.innerHTML = warn_text;
		showField(_warn_id, "block");	
	}

}

function showOriginal(_category) {
	var Msg = document.getElementById("orig_msg");
	var warning = categoryHasWarning(_category, "org_warning");
	var checkedType = getCheckedTypeId();

	if (checkedType != "rS" || !warning) {
		Msg.innerHTML = "";
		showField("orig_msg", "none");
	} else {
		showField("orig_msg", "none");
		Msg.innerHTML = warning;
		// Adding it to msg innerhtml so that the compare works. 
		// In innerHTML the &auml; gets converted to its real value so both sides needs to be compared
		if (document.getElementById("err_msg_body").innerHTML != Msg.innerHTML) {
			showField("orig_msg", "block");
		} else {
			Msg.innerHTML = "";
		}
	}
}

function displayStores(_show) {
	var hasStores = document.getElementById('store') != null;
	if (hasStores) {
		if (_show == "block") {
			showField("lstore", "block");
			showField("istore", "block");
			} else {
			showField("lstore", "none");
			showField("istore", "none");
		}
	}
}

function toggleChildrenInputs(action,disable_div) {
	var children = disable_div.childNodes;
	if (children) {
		for (var i in children) {
			if (children[i] && children[i].nodeType == 1) {
				var tag = children[i].tagName.toUpperCase();
				if ((tag == 'DIV') || (tag == 'SPAN')) {
					toggleChildrenInputs(action,children[i]);
				} else if ((tag == 'INPUT')||(tag == 'BUTTON')||(tag == 'OPTION')||(tag == 'SELECT')||(tag == 'TEXTAREA')) {
					if (action == 'disable')
						children[i].disabled='disabled';
					else
						children[i].disabled='';
				}
			}
		}
	}
}

function showType(_typeId, _nameId) {
	var Name = document.getElementById(_nameId);
	var companyAd = document.getElementById(_typeId);

	Name.innerHTML = '';
	var inner_html = '';
	if (_typeId == "company_ad_id") {
		inner_html = "Nom de l'entreprise:";
		Name.innerHTML = inner_html;
		displayStores("block");

		showField("dsiren", "block");
		showField("lsiren", "block");

		/*var infopage = document.getElementById("infopage_display");
		if (infopage.getAttribute("is_admin") != "1")
			showField("infopage_display", "block");*/
	} else {
		inner_html = "Votre nom:";
		Name.innerHTML = inner_html;
		displayStores("none");
		showField("dsiren", "none");
		showField("lsiren", "none");

		/*var infopage = document.getElementById("infopage_display");
		if (infopage.getAttribute("is_admin") != "1")
			showField("infopage_display", "none");*/
	}
	showExtras();
}

function toggleCompteproFields () {
	var compteproSettings = get_settings('store_settings',key_lookup);
	var compteproWarning = document.getElementById('comptepro_warning');
	if (compteproSettings && compteproWarning) {
		var compteproSettings_array = compteproSettings.split(',');
		if (settingValueInArray('enabled',compteproSettings_array) == 1) {
			toggleChildrenInputs('disable',document.getElementById('comptepro_disable_fields'));		
			compteproWarning.style.display = 'block';
			document.getElementById('comptepro_disable_fields').className = "grey_text";
			return;
		}
	}
	toggleChildrenInputs('enable',document.getElementById('comptepro_disable_fields'));		
	document.getElementById('comptepro_disable_fields').className = "";
	compteproWarning.style.display = 'none';
}

function showPrice(_type, _price, _label) {
	var features = get_settings('features', key_lookup);
	var Price = document.getElementById(_label);
	if (!has_feature("no_price", features)) {
		if (has_feature("monthly_rate", features)) {
			Price.innerHTML = "Loyer mensuel:";
		} else if (has_feature("weekly_rate", features)) {
			Price.innerHTML = "Prix / Semaine:";
		} else {
			Price.innerHTML = "Prix:";
		}
		showField(_price, "block");
		showField(_label, "block");
	} else {
		showField(_price, "none");
		showField(_label, "none");
	}
}

var reset_type = false;

function typeChanged(_type, _price, _label, _catId, _typeId) {

	var Category = document.getElementById(_catId);
	var checkedType = getCheckedTypeId();

	showPrice(_type, _price, _label);
	showTips(Category.value);

	showExtras();

	// show or hide original message, showOriginal depends on checked type
	showOriginal(Category.value);
	showMessages(Category.value, checkedType.substr(1).toLowerCase());
	reset_type = false;
}

function apartmentTypeChanged(_catId) {
	showCategory(_catId);		
}

function getCategoryTips(_cat) {
        var private_ad = document.getElementById("private_ad_id").checked;
        var tips = false;

        if (_cat <= 0) return tips;
	
        if (!private_ad && categoryList[_cat].tips['company'].length) {
                tips = categoryList[_cat].tips['company'];
        } else if (private_ad && categoryList[_cat].tips['private'].length) {
                tips = categoryList[_cat].tips['private'];
        } else if (categoryList[_cat].tips.all.length) {
                tips = categoryList[_cat].tips.all;
        }

        return tips;
}

function showTips(_category) {
       var Msg = document.getElementById("category_tips");
        var tips = getCategoryTips(_category);

        if (!tips) {
                Msg.innerHTML = "";
                showField("category_tips", "none");
        } else {
                showField("category_tips", "block");
                Msg.innerHTML = tips;
        }
}

function showExtras() {
	var Category = document.getElementById("category").value;
	var checkedType = getCheckedTypeVal();
	var features = get_settings('features', key_lookup);

	showTips(Category);
	displayFeatures(Category, checkedType, features);
}	

function showCategory(_catId, _showId, _typeId, _textId, cat_extra_images) {
	var Category = document.getElementById(_catId);
	
	var Type = document.getElementById(_typeId);
	var adType = document.getElementById("dtype");

	var checkedType = getCheckedTypeId();
	var features = get_settings('features', key_lookup);
	var typeName;

	// type & features depend on checked type from former category
	if (has_feature("zipcode_hint", features)) {
		showField("zipcode_hint", "none");
	} else {
		showField("zipcode_hint", "inline");
	}

	if (has_feature("mcertified_extra", features)) {
		showField("mcertified_extra", "inline");
	} else {
		showField("mcertified_extra", "none");
	}

	/* Hide price if noprice feature is set */
	if(has_feature("noprice", features)) {
		showField("price_box", "none");
	} else {
		showField("price_box", "inline");
	}

	if (adType && categoryList[Category.value] && categoryList[Category.value]['level'] % 2) {	
		adType.innerHTML = '';

		var inner_html = ''; /*Due to bug in Internet explorer 5.2 for OS X */

		var types = get_settings("types", key_lookup);
		var typeArray;
		if (types) {
			typeArray = types.split(",");
		} else {
			typeArray = categoryList[Category.value]['type'].split(",");
		}

		for (var i in typeArray) {
			var t = typeArray[i];
			if (t != 'o')
			  {
			    typeName = typeList[t]
			      /* Check if category has type with different name */
			      if (category_params[Category.value] && category_params[Category.value][t] && category_params[Category.value][t]['labels'] && category_params[Category.value][t]['labels']['newad']) {
				    typeName = category_params[Category.value][t]['labels']['newad'];
				  }

				inner_html += '<input name="type" value="'+t+'" '+(t=="s"?'checked="checked"':'')+' id="r'+t.toUpperCase()+'" type="radio" onClick="typeChanged(\''+t+'\', \'dprice\', \'lprice\', \'category\', \'company_ad_id\');apartmentTypeChanged(\'category\');"> <label for="r'+t.toUpperCase()+'">'+typeName+'</label><br />';
			  }
		}

		adType.innerHTML = inner_html;

		if (!has_feature("no_ad_type", features)) {
			if (document.getElementById(checkedType)) { 
				setChecked(checkedType, true);
				showPrice(document.getElementById(checkedType).value, 'dprice', 'lprice');
			} else if (document.formular.type[0]) {
				setChecked("r"+document.formular.type[0].value.toUpperCase(), true);
				showPrice(document.formular.type[0].value, 'dprice', 'lprice');
				reset_type = true;
			}
		}
	}

	var price_label = document.getElementById('label_price');
	if(price_label) {
		if(Category.value == 2 || Category.value == 3) {
			price_label.innerHTML = "";
		} else {
			price_label.innerHTML = "(optionnel)";
		}
	}

	// type has been updated
	features = get_settings('features', key_lookup);

	if (has_feature("only_private", features)) {
		setChecked("private_ad_id", true);
		setChecked("company_ad_id", false);
		showField("dcompany_ad", "none");
		showField("company_ad_id", "none");
		showField("lcompany_ad", "none");
		showField("dprivate_ad", "inline");
		showField("private_ad_id", "inline");
		showField("lprivate_ad", "inline");
		showType("private_ad", "lname");
	} else if (has_feature("only_company", features)) {
		setChecked("company_ad_id", true);
		setChecked("private_ad_id", false);
		showField("dcompany_ad", "inline");
		showField("dprivate_ad", "none");
		showField("private_ad_id", "none");
		showField("lprivate_ad", "none");
		showField("company_ad_id", "inline");
		showField("lcompany_ad", "inline");
		showType("company_ad_id", "lname");
	} else {
		showField("dcompany_ad", "inline");
		showField("dprivate_ad", "inline");
		showField("company_ad_id", "inline");
		showField("lcompany_ad", "inline");
		showField("private_ad_id", "inline");
		showField("lprivate_ad", "inline");
	}	

	if (has_feature("no_ad_type", features)) {
		showField("field_ad_type", "none");
		showPrice("s", 'dprice', 'lprice');
		reset_type = true;
	} else {
		showField("field_ad_type", "block");
	}


	showWarning(Category.value, "region_warning", "info_region");
	showWarning(Category.value, "address_warning", "info_address");
	showWarning(Category.value, "zipcode_warning", "info_zipcode");

	/* Display other features */
	showExtras();
	showOriginal(Category.value);
	showExtraImagesNumbers(cat_extra_images);
	showMessages(Category.value, checkedType.substr(1).toLowerCase());
}

function showDepartment(_regionId) {
	var region = document.getElementById(_regionId);		

	document.formular.dpt_code.options.length = 1;

	if (typeof(region_departments[region.value]) == "undefined") {
		showField("ddpt_code", "none");	
		showField("ldpt_code", "none");	
		showField("err_dpt_code", "none");	
		if (document.getElementById('store') != null)
			document.getElementById("store").focus();
		else
			document.getElementById("name").focus();
		return;
	}

	var count = 1;
	for (var i in region_departments[region.value]) {
		document.formular.dpt_code.options[count] = new Option(region_departments[region.value][i], i);
		if (document.formular.dpt_code.value == region_departments[region.value][i])
			document.formular.dpt_code.options[count].selected = true;
		count++;
	}

	showField("ddpt_code", "block");
	showField("ldpt_code", "block");
	document.getElementById("dpt_code").focus();

}

/*
 * Show extra images price and nr of allowed images for chosen category
 */
function showExtraImagesNumbers(cat_extra_images) {
	var cat = form_key_lookup('category', '');

	var number = document.getElementById('extra_images_num');
	var extra_images = get_settings('extra_images', key_lookup);

	if (extra_images) {
		extra_images = split_setting(extra_images);
		// Check if category has special

		if(cat_extra_images != null) {
			if (number && typeof(number) != 'undefined')
				number.innerHTML = cat_extra_images;
			max_allowed_images = cat_extra_images;
		} else {
			if (number && typeof(number) != 'undefined')
				number.innerHTML = extra_images['max'];
			max_allowed_images = extra_images['max'];
		}

		// Show or hide
		if (uploaded_images < max_allowed_images) {
			showField("extra_images_form", "inline");
			showField("image_button", "inline");
			enable_field("image2");
			showField("image2", "inline");
		} else {
			showField("extra_images_form", "none");
			showField("image2", "none");
			disable_field("image2");
			showField("image_button", "none");
		}

		// Show field for text about extra images 
		showField("extra_images_text", "block");
	} else {
		// Hide field for text about extra images
		showField("extra_images_text", "none");
	}
}

/*
 * AJAX
 */
function ajax_request(dest, post, callback, params) {
	var xmlhttp = false;
	
	try {
		xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
	} catch (e) {
		// browser doesn't support ajax. handle however you want
	}
	xmlhttp.onreadystatechange = function () { ajax_callback(callback, params, xmlhttp); };
	
	xmlhttp.open((post ? "POST" : "GET"), dest, true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(post);
}

function ajax_callback(callback, params, xmlhttp) {
	if (xmlhttp.readyState == 4) {
		if (xmlhttp.status == 200 && xmlhttp.responseText.indexOf('<!DOCTYPE') < 0) {
			callback(eval("(" + xmlhttp.responseText + ")"), xmlhttp, params);
		} else {
			callback(false, xmlhttp, params);
		}
	}
}

/*
 * Validate email and check for store
 */
function checkEmail(store_id) {
	if (!document.getElementById('email')) {
		return;
	}

	var email = document.getElementById('email').value;

	if (document.forms[0].company_ad[0].id == "company_ad_id"  && !document.forms[0].company_ad[0].checked) {
			return;
		}

	if (document.forms[0].company_ad[1].id == "company_ad_id"  && !document.forms[0].company_ad[1].checked) {
			return;
		}

	if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email)) {
		return;
	}
/* Don't call this since we don't have stores yet
 	var url = "/ajax?a=getstores";
	var postdata = "email=" + escape(email);

	ajax_request(url, postdata, checkEmailCB, store_id ? store_id : null)
*/
}

function checkEmailCB(result, xmlhttp, arg) {
	var storediv = document.getElementById('store_holder');
	var store_list = '';

	for (var store_id in result) {
		if (arg != null && store_id == arg)
			store_list += "<option value='" + store_id + "' selected='selected'>" + result[store_id] + "</option>\n";
		else
			store_list += "<option value='" + store_id + "'>" + result[store_id] + "</option>\n";
	}
	
	if (storediv) {
		if (store_list) {
			storediv.innerHTML = "    <div class='labelform' id='lstore'>Välj butik:</div>" +
						"    <div class='adinput' id='istore'>" +
						"	<select name='store' id='store'>" + store_list + "</select>";
		} else
			storediv.innerHTML = "";
	}
}

function adStoreActionSelected_old(errors) {
	 document.getElementById("store_continue").disabled = false;

	 adActionSelected_old(errors);
}

function adActionSelected_old(errors) {
	if (document.getElementById('passwd_request') && document.getElementById('cmd_edit')) {
			if (document.getElementById('cmd_edit').checked) {
				document.getElementById('passwd_request').style.display = 'block';
			} else {
				document.getElementById('passwd_request').style.display = 'none';
			}
	}

	for (var action in actionsWarning) {
		var cmdElem = 'cmd_' + action;
		var cmdWarn = 'warning_' + action;
		var cmdErr = 'error_' + action;

		/* alert (cmdElem + " - " + cmdWarn + " - " + cmdErr); */

		if (document.getElementById(cmdElem)) {
			if (document.getElementById(cmdElem).checked == true) {
				if (actionsWarning[action] == false) {
					if (document.getElementById(cmdWarn)) {
						document.getElementById(cmdWarn).style.display = 'block';
					}
					if (document.getElementById(cmdErr)) {
						document.getElementById(cmdErr).style.display = 'none';
					}
				} else {
					if (document.getElementById(cmdWarn)) {
						document.getElementById(cmdWarn).style.display = 'none';
					}
					if (document.getElementById(cmdErr)) {
						document.getElementById(cmdErr).style.display = 'block';
					}

				}
			} else {
				if (document.getElementById(cmdWarn)) {
					document.getElementById(cmdWarn).style.display = 'none';
				}
				if (document.getElementById(cmdErr)) {
					document.getElementById(cmdErr).style.display = 'none';
				}
			}
		}
	} 
}

function adStoreActionSelected(action, sub_action, errors) {
	var sub_toplist = false; 
	var urgent = false;
	var gallery7 = false;
	var gallery30 = false;
	
	if (document.getElementById('cmd_sub_toplist'))
		sub_toplist = document.getElementById('cmd_sub_toplist').checked;
	if (document.getElementById('cmd_urgent'))
		urgent = document.getElementById('cmd_urgent').checked;
	if (document.getElementById('cmd_gallery7'))
		gallery7 = document.getElementById('cmd_gallery7').checked;
	if (document.getElementById('cmd_gallery30'))
		gallery30 = document.getElementById('cmd_gallery30').checked;
	if (document.getElementById('cmd_top_list'))
		top_list = document.getElementById('cmd_top_list').checked;

	if ((action == 'services' && sub_toplist == false && urgent == false && gallery7 == false && gallery30 == false) ||
	    (action == 'top_list' && top_list == false)) {
		document.getElementById("store_continue").disabled = true;
	} else {
		document.getElementById("store_continue").disabled = false;
	}

	if ((action == 'edit') || (action == 'delete')) {
		document.getElementById("store__continue").disabled = false;
		document.getElementById("store_continue").disabled = true;
	} else {
		document.getElementById("store__continue").disabled = true;
	}

	adActionSelected(action, sub_action, errors);
}

function adActionSelected(want_action, sub_action, errors) {
	if (document.getElementById('passwd_request') && document.getElementById('cmd_edit')) {
			if (want_action == "edit") {
				document.getElementById('passwd_request').style.display = 'block';
			} else {
				document.getElementById('passwd_request').style.display = 'none';
			}
	}
	
	if ((want_action != 'edit') && (want_action != 'delete')) {
		if (document.getElementById('cmd_edit')) {
			document.getElementById('cmd_edit').checked = false;
		}
		if (document.getElementById('cmd_delete')) {
			document.getElementById('cmd_delete').checked = false;
		}
	}

	if(document.getElementById('adaction_status')) {
		document.getElementById('adaction_status').style.display = 'none';
	}
	if(want_action == 'gallery_services') {
		var services = document.getElementById('cmd_gallery_services');
		var iex_workaround = false;

		if(services.checked == false) {
			services.checked = true;
			iex_workaround = true;
		}

		for (var action in actionsWarning) {
			var cmdElem = 'cmd_' + action;
			var cmdWarn = 'warning_' + action;
			var cmdErr = 'error_' + action;

			if (document.getElementById(cmdElem)) {
				if (iex_workaround && navigator.userLanguage && sub_action == action) {
					document.getElementById(cmdElem).checked = true;
				}

				if (document.getElementById(cmdElem).checked == true) {
					if (actionsWarning[action] == false) {
						if (document.getElementById(cmdWarn)) {
							document.getElementById(cmdWarn).style.display = 'block';
						}
						if (document.getElementById(cmdErr)) {
							document.getElementById(cmdErr).style.display = 'none';
						}
					} else {
						if (document.getElementById(cmdWarn)) {
							document.getElementById(cmdWarn).style.display = 'none';
						}
						if (document.getElementById(cmdErr)) {
							document.getElementById(cmdErr).style.display = 'block';
						}
					}
				} else {
					if (document.getElementById(cmdWarn)) {
						document.getElementById(cmdWarn).style.display = 'none';
					}
					if (document.getElementById(cmdErr)) {
						document.getElementById(cmdErr).style.display = 'none';
					}
				}
			}
		}
		
		var cmd_gallery7 = document.getElementById('cmd_gallery7');
		var cmd_gallery30 = document.getElementById('cmd_gallery30');
		
		if ((sub_action == 'gallery30') && 
		    (cmd_gallery7 != undefined) && 
		    (cmd_gallery30 == undefined)) {
			cmd_gallery7.checked = true;
		}
	} else if(want_action == "services") {
		var services = document.getElementById('cmd_services');
		var iex_workaround = false;

		if(services && services.checked == false) {
			services.checked = true;
			iex_workaround = true;
		}
		for (var action in actionsWarning) {
			var cmdElem = 'cmd_' + action;
			var cmdWarn = 'warning_' + action;
			var cmdErr = 'error_' + action;

			if (document.getElementById(cmdElem)) {
				if (iex_workaround && navigator.userLanguage && sub_action == action) {
					document.getElementById(cmdElem).checked = true;
				}
				if (document.getElementById(cmdElem).checked == true) {
					if(cmdElem != "cmd_top_list") {
						document.getElementById(cmdElem).checked = true;
					}
					if (actionsWarning[action] == false) {
						if (document.getElementById(cmdWarn)) {
							document.getElementById(cmdWarn).style.display = 'block';
						}
						if (document.getElementById(cmdErr)) {
							document.getElementById(cmdErr).style.display = 'none';
						}
					} else {
						if (document.getElementById(cmdWarn)) {
							document.getElementById(cmdWarn).style.display = 'none';
						}
						if (document.getElementById(cmdErr)) {
							document.getElementById(cmdErr).style.display = 'block';
						}
					}
				} else {
					if (document.getElementById(cmdWarn)) {
						document.getElementById(cmdWarn).style.display = 'none';
					}
					if (document.getElementById(cmdErr)) {
						document.getElementById(cmdErr).style.display = 'none';
					}
				}
			}
		}
	} else {
		var is_enabled = document.getElementById('cmd_top_list').checked;

		if(is_enabled) {
			document.getElementById('top_list_warn').style.display = "block";
		} else {
			document.getElementById('top_list_warn').style.display = "none";
		}

		if(document.getElementById('cmd_sub_toplist')) {
			document.getElementById('cmd_sub_toplist').disabled = is_enabled;
			document.getElementById('cmd_sub_toplist').checked = false;

			if(is_enabled) {
				document.getElementById('cmd_sub_toplist_label').className = "newad_title_disabled";
			} else {
				document.getElementById('cmd_sub_toplist_label').className = "newad_title";
			}
		}

		if(document.getElementById('cmd_urgent')) {
			document.getElementById('cmd_urgent').disabled = is_enabled;
			document.getElementById('cmd_urgent').checked = false;

			if(is_enabled) {
				document.getElementById('cmd_urgent_label').className = "newad_title_disabled";
			} else {
				document.getElementById('cmd_urgent_label').className = "newad_title";
			}
		}

		if(document.getElementById('cmd_gallery_services')) {
			document.getElementById('cmd_gallery_services').disabled = is_enabled;
			document.getElementById('cmd_gallery_services').checked = false;

			if(is_enabled) {
				document.getElementById('cmd_gallery_services_label').className = "newad_title_disabled";
			} else {
				document.getElementById('cmd_gallery_services_label').className = "newad_title";
			}

			if(document.getElementById('cmd_gallery7')) {
				document.getElementById('cmd_gallery7').disabled = is_enabled;
				document.getElementById('cmd_gallery7').checked = false;

				if(is_enabled) {
					document.getElementById('cmd_gallery7_label').className = "newad_title_disabled";
				} else {
					document.getElementById('cmd_gallery7_label').className = "";
				}
			}

			if(document.getElementById('cmd_gallery30')) {
				document.getElementById('cmd_gallery30').disabled = is_enabled;
				document.getElementById('cmd_gallery30').checked = false;

				if(is_enabled) {
					document.getElementById('cmd_gallery30_label').className = "newad_title_disabled";
					document.getElementById('cmd_gallery30_label_new').style.color = "#A1A1A1";
				} else {
					document.getElementById('cmd_gallery30_label').className = "";
					document.getElementById('cmd_gallery30_label_new').style.color = "red";
				}
			}
		}

		for (var action in actionsWarning) {
			var cmdWarn = 'warning_' + action;
			var cmdErr = 'error_' + action;
			if (document.getElementById(cmdWarn)) document.getElementById(cmdWarn).style.display = 'none';
			if (document.getElementById(cmdErr)) document.getElementById(cmdErr).style.display = 'none';
		}
	}
}

function actionSelected() {
	if (document.getElementById('passwd_request') && document.getElementById('cmd_edit')) {
			if (document.getElementById('cmd_edit').checked) {
				document.getElementById('passwd_request').style.display = 'block';
			} else {
				document.getElementById('passwd_request').style.display = 'none';
			}
	}

	if(document.getElementById('cmd_gallery') && document.getElementById('warning_gallery_noimage_bleu') && document.getElementById('warning_gallery_noimage')) {
		if((document.getElementById('cmd_gallery').checked == false)) {
			document.getElementById('warning_gallery_noimage').style.display = 'none';
			document.getElementById('warning_gallery_noimage_bleu').style.display = 'block';
		}
	}
}

function toggleAdminGalleryOptions() {
	var c = document.getElementById('cmd_gallery_services');
	if (c) {
		var checked = c.checked;
		var gallery7_div = document.getElementById('cmd_gallery7_div');
		var gallery7 = document.getElementById('cmd_gallery7');
		var gallery30 = document.getElementById('cmd_gallery30');
		if (checked) {
			if (gallery7_div.style.display == 'none') {
				gallery30.checked = true;
			} else {
				gallery7.checked = true;
			}
		} else {
			gallery30.checked = false;
			gallery7.checked = false;
		}
	}
} 

function toggleGalleryOptions() {
	var c = document.getElementById('cmd_gallery_services');

	if(c) {
		var checked = c.checked;
		var gallery7 = document.getElementById('cmd_gallery7');
		var gallery30 = document.getElementById('cmd_gallery30');

		if(!checked) {
			if(gallery7) {
				gallery7.checked = false;

				if(document.getElementById('warning_gallery7')) {
						document.getElementById('warning_gallery7').style.display = 'none';
				}

				if(document.getElementById('err_gallery7')) {
					document.getElementById('err_gallery7').style.display = 'none';
				}
			}

			if(gallery30) {
				gallery30.checked = false;

				if(document.getElementById('warning_gallery30')) {
					document.getElementById('warning_gallery30').style.display = 'none';
				}

				if(document.getElementById('err_gallery30')) {
					document.getElementById('err_gallery30').style.display = 'none';
				}

			}
		} else {
			if(gallery7) {
				gallery7.checked = true;
				
				if(document.getElementById('warning_gallery7')) {
						document.getElementById('warning_gallery7').style.display = 'block';
				}

				if(document.getElementById('err_gallery7')) {
					document.getElementById('err_gallery7').style.display = 'block';
				}
			}
		}
	}

	var sub_toplist = false;
	var urgent = false;
	var gallery7 = false;
	var gallery30 = false;

	if (document.getElementById('cmd_sub_toplist'))
		sub_toplist = document.getElementById('cmd_sub_toplist').checked;
	if (document.getElementById('cmd_urgent'))
		urgent = document.getElementById('cmd_urgent').checked;
	if (document.getElementById('cmd_gallery7'))
		gallery7 = document.getElementById('cmd_gallery7').checked;
	if (document.getElementById('cmd_gallery30'))
		gallery30 = document.getElementById('cmd_gallery30').checked;


	if (sub_toplist == false && urgent == false && gallery7 == false && gallery30 == false) {

		if(document.getElementById("store_continue")) {
			document.getElementById("store_continue").disabled = true;
		} else {
			document.getElementById("adaction_continue").disabled = true;
		}

	} else {
		if(document.getElementById("store_continue")) {
			document.getElementById("store_continue").disabled = false;
		} else {
			document.getElementById("adaction_continue").disabled = false;
		}
	}

	document.getElementById("store__continue").disabled = true;
	if (document.getElementById('cmd_edit'))
		document.getElementById('cmd_edit').checked = false;
	if (document.getElementById('cmd_delete'))
		document.getElementById('cmd_delete').checked = false;
}

/*
 * Progress bar
 */
function ProgressBar(_container) {
	this.progress = [];
	this.container = _container || 'progressbar_container';
	this.completed = false;

	/* Don't show estimate until progress reach (x) procent */
	this.ESTIMATE_MIN_PROGRESS = 10;
	/* Speed calculation include latest (x) procent */
	this.SPEED_CALC_LATEST = 30;

	/* Clear container */
	this.clear();

	/* Init the container */
	var container = document.getElementById(this.container);
	if (!container)
		return;

	/* Create progress table */
	var progress_bar = document.createElement('div');
	progress_bar.className = 'progress_bar';

	var progress_cell = document.createElement('div');
	progress_cell.className = 'progress_blue';
	progress_cell.style.width = '0px';

	var debug = document.createElement('div');
	debug.className = 'progress_debug';

	progress_bar.appendChild(progress_cell);
	container.appendChild(progress_bar);
	container.appendChild(debug);
	container.appendChild(document.createElement('br'));
}

ProgressBar.prototype.clear = function () {
	this.progress = [];

	var container = document.getElementById(this.container);
	if (!container) return;

	while (container.childNodes.length > 0)
		container.removeChild(container.childNodes[0]);
}

ProgressBar.prototype.update = function (progress, total) {
	if (this.completed) return;

	var id = this.progress.length;
	var time = new Date();
	this.progress[id] = {progress: progress, total: total, time: time.getTime()};
	this.completed = progress == total;
};

ProgressBar.prototype.current = function () {
	var id = this.progress.length;

	if (id == 0) return;

	return this.progress[id - 1];
};

ProgressBar.prototype.procent = function (_id) {
	var progress = this.progress[_id] || this.current();

	if (progress && progress.progress)
		return Math.round( progress.progress / progress.total * 100 );

	return 0;
};

ProgressBar.prototype.speed = function () {
	if (this.progress.length == 0) return;

	var start_at = this.progress.length - Math.floor(this.progress.length * this.SPEED_CALC_LATEST / 100) - 1;

	if (start_at < 0)
		start_at = 0;

	var first = this.progress[start_at];
	var current = this.current();

	var bytes = current.progress - first.progress;
	var time = (current.time - first.time) / 1000;

	return Math.round((bytes / 1000) / time);
};

ProgressBar.prototype.estimate = function () {
	if (this.procent() < this.ESTIMATE_MIN_PROGRESS) return ;

	var speed = this.speed();
	var progress = this.current();

	var remaining_bytes = progress.total - progress.progress;

	var remaining_seconds = Math.round(remaining_bytes / speed) / 1000;

	return Math.round(remaining_seconds);
};

ProgressBar.prototype.draw = function () {
	var container = document.getElementById(this.container);
	if (!container) return;
	container.style.display = 'block';

	var estimate = this.estimate();
	var speed = this.speed();
	var procent = this.procent();

	if (container.childNodes.length) {
		var progress_bar = container.getElementsByTagName('div')[0];
		var progress_cell = container.getElementsByTagName('div')[1];
		progress_cell.style.width = Math.round((progress_bar.offsetWidth - 2) * procent / 100)+'px';

		var debug = container.getElementsByTagName('div')[2];
		var minutes_left = Math.floor(estimate / 60);
		var seconds_left = estimate - minutes_left * 60;
		var time_left = '';

		if (minutes_left  + seconds_left > 0)
			time_left = 'Tid kvar: ';
		if (minutes_left > 0)
			time_left += minutes_left + " min ";
		if (seconds_left > 0)
			time_left += seconds_left + " s";

		debug.innerHTML = procent + "%&nbsp;&nbsp;&nbsp;" + time_left;
	}
};

ProgressBar.prototype.update_draw = function(progress, total) {
	if (this.completed) return;

	this.update(progress, total);
	this.draw();
};

/*
 * Change form state and query
 */
function form_action_state(state, query) {
	var form = document.getElementsByTagName('form')[0];
	form.action = form.action.replace(/verify/, state);
	if (query) {
		var queryArray = query.split("&");
		for (var i in queryArray) {
			var q = queryArray[i];
			var keyvalueArray = q.split("=");
 			var input = document.createElement('input');

			input.type = 'hidden';
			input.name = keyvalueArray[0];
			input.value = keyvalueArray[1];
			form.appendChild(input);
		}
	}
	form.setAttribute('target', window.name);
	form.submit();

	return false;
}

function click_extra_images(elem) {
	var form = document.getElementsByTagName('form')[0];
	var input = document.createElement('input');

	input.type = 'hidden';
	input.name = 'extra_images';
	input.value = '1';
	form.appendChild(input);

	showProgressBar(elem);
	form.submit();
}

function get_apartment_type() {
	var apartment_type = document.formular.apartment_type;
	for (i = 0; i < apartment_type.length; i++) {
		if (apartment_type[i].checked == true) {
			return apartment_type[i].value; 
		}
	}

	return "tenant_ownership";
}

function key_lookup(keyname) {
	if (keyname == 'type')
		return getCheckedTypeVal();
	else if (keyname == 'apartment_type')
		return get_apartment_type();
	else if (keyname == 'company_ad') {
		if (document.getElementsByName(keyname)[0].checked)
			return document.getElementsByName(keyname)[0].value;
		else
			return document.getElementsByName(keyname)[1].value;
	} else if (document.getElementById(keyname))
		return document.getElementById(keyname).value;
	else
		return null;
}

function has_feature(feature, features) {
	if (!features) {
		return (categoryHasFeature(document.getElementById("category").value, feature, getCheckedTypeVal()) ||
			categoryHasFeature(document.getElementById("category").value, feature));
	}

	if (features && features.indexOf(feature) >= 0)
		return true;

	return false;
}

function showMoreInfo(feature_to_toggle) {
	var element_to_toggle = document.getElementById(feature_to_toggle+"_info");
	var feature;

	if ((element_to_toggle.style.display == "none")||(element_to_toggle.style.display == ""))
		element_to_toggle.style.display="block";
	else if (element_to_toggle.style.display == "block")
		 element_to_toggle.style.display="none";

	for (feature in top_list_types) {
		if (feature != feature_to_toggle) {
			document.getElementById(feature+"_info").style.display = "none";
		}
	}
}

function store_key_lookup(keyname) {
	if (keyname == 'category')
		return document.getElementsByName(keyname)[0].value;
	else if (keyname == 'company_ad')
			return '1';
	else
		return null;
}


function toggleGalleryCheck() {
	var galleryCheckbox = document.getElementById("gallerycheck");
	var galleryRadio = document.getElementById("gallery");
	var gallery30Radio = document.getElementById("gallery30");

	if (galleryCheckbox != undefined) {
		if (galleryCheckbox.checked) {
			galleryRadio.checked = true;
		} else {
			galleryRadio.checked = false;
			gallery30Radio.checked = false;
		}
	}
}

function toggleGalleryRadio() {
	var galleryCheckbox = document.getElementById("gallerycheck");

	if (galleryCheckbox != undefined) {
		if (galleryCheckbox.checked == false) {
			galleryCheckbox.checked = true;
		}
	}
}

function update_amount_edit(edit_price, gallery_price, gallery30_price, sub_toplist_price, urgent_price)
{
	var field = document.getElementById("total_price");

	var gallery_selected;
	if(document.getElementById("gallery")) {
		gallery_selected = document.getElementById("gallery").checked;
	}
	var gallery30_selected;
	if(document.getElementById("gallery30")) {
		gallery30_selected = document.getElementById("gallery30").checked;
	}
	var urgent_selected = document.getElementById("urgent").checked;
	var sub_toplist_selected = document.getElementById("sub_toplist").checked;

	var amount = edit_price;

	if(gallery_selected) {
		amount += gallery_price;
	}

	if(gallery30_selected) {
		amount += gallery30_price;
	}

	if(urgent_selected) {
		amount += urgent_price;
	}

	if(sub_toplist_selected) {
		amount += sub_toplist_price;
	}

	if(amount == edit_price) {
		field.innerHTML = " " + edit_price + " &euro; TTC";
	} else {
		field.innerHTML = " " + edit_price + " &euro; TTC + " + (amount - edit_price) + " &euro; TTC = " + amount + " &euro; TTC";
	}
}

function update_amount_store(category, newad_price_with_tax, newad_price_no_tax, has_already_gallery, has_already_gallery30, has_already_sub_toplist, has_already_urgent, store_left_amount) {
	var gallery_selected;
	var gallery30_selected;

	if(document.getElementById("gallery")) {
		gallery_selected = document.getElementById("gallery").checked;
	}
	if(document.getElementById("gallery30")) {
		gallery30_selected = document.getElementById("gallery30").checked;
	}

	var urgent_selected = document.getElementById("urgent").checked;
	var sub_toplist_selected = document.getElementById("sub_toplist").checked;
	var with_tax = document.getElementById("with_tax_amount");
	var no_tax = document.getElementById("no_tax_amount");
	var credit_with_tax = document.getElementById("credit_left_amount");

	var amount = newad_price_with_tax;
	var amount_no_tax = newad_price_no_tax;

	var compteproSettings = get_settings('store_settings', store_key_lookup);
	var compteproSettings_array = compteproSettings.split(',');

	var settings = new Array();

	for (i = 0; i < compteproSettings_array.length; i++) {
		var a = compteproSettings_array[i].split(':');

		settings[a[0]] = a[1];
	}

	if(gallery_selected && !has_already_gallery) {
		if(settings['gallery_with_tax'] != undefined) {
			 amount += settings['gallery_with_tax'] - 0;
			 amount_no_tax  += Math.round(settings['gallery_with_tax'] / 1.196);
		}
	}

	if(gallery30_selected && !has_already_gallery30) {
		if(settings['gallery30_with_tax'] != undefined) {
			 amount += settings['gallery30_with_tax'] - 0;
			 amount_no_tax  += Math.round(settings['gallery30_with_tax'] / 1.196);
		}
	}

	if(urgent_selected && !has_already_urgent) {
		if(settings['urgent_with_tax'] != undefined) {
			amount += settings['urgent_with_tax'] - 0;
			amount_no_tax  += Math.round(settings['urgent_with_tax'] / 1.196);
		}
	}

	if(sub_toplist_selected && !has_already_sub_toplist) {
		if(settings['sub_toplist_with_tax'] != undefined) {
			amount += settings['sub_toplist_with_tax'] - 0;
			amount_no_tax  += Math.round(settings['sub_toplist_with_tax'] / 1.196);
		}
	}

 	var s_no_tax = new String((Math.round(amount_no_tax) / 100).toFixed(2));
	var s_with_tax = new String((amount / 100).toFixed(2));
	var store_credit_left_amount_with_tax = new String(((store_left_amount - amount) / 100).toFixed(2));

	if(amount == 0) {
		document.getElementById('pro_ad_amount').style.display = 'none';
	} else {
		document.getElementById('pro_ad_amount').style.display = 'block';
	}

	if(parseFloat(store_credit_left_amount_with_tax) <= 0 || amount == 0) {
		document.getElementById('lbc_submit').name = 'create';
		document.getElementById('lbc_submit').className = 'bt_validate';
		document.getElementById('credit_left_amount_container').style.display = 'none';
	} else {
		document.getElementById('lbc_submit').name = 'pay_by_credits';
		document.getElementById('lbc_submit').className = 'bt_pay_by_credits';
		document.getElementById('credit_left_amount_container').style.display = 'block';
	}

	s_no_tax = s_no_tax.replace(/\./, ',');
	s_with_tax = s_with_tax.replace(/\./, ',');
	store_credit_left_amount_with_tax = store_credit_left_amount_with_tax.replace(/\./, ',');

	/*
	if(store_credit_left_amount_with_tax.indexOf(',') == -1) {
		store_credit_left_amount_with_tax += ",00";
	}
	if(s_with_tax.indexOf(',') == -1) {
		s_with_tax += ",00";
	}
	if(s_no_tax.indexOf(',') == -1) {
		s_no_tax += ",00";
	}
	*/
	with_tax.innerHTML = s_with_tax + " ";
	no_tax.innerHTML = s_no_tax + " ";
	credit_with_tax.innerHTML = store_credit_left_amount_with_tax + " ";
}

function show_company_ad_warning (companyAd) {
	var elemWarn = document.getElementById("company_ad_category_warning");
	elemWarn.style.display = 'block';
}
