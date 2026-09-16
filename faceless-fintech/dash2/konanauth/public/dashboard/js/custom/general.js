'use strict';

function showSpinner(A) {
	var o = document.createElement("div");
	if ("undefined" === A) {
		const A = document.createElement("style");
		(A.textContent =
			".page-loading{position:fixed;top:0;right:0;bottom:0;left:0;width:100%;height:100%;-webkit-transition:all .4s .2s ease-in-out;transition:all .4s .2s ease-in-out;background-color:rgba(0, 0, 0, 0.5);-webkit-backdrop-filter: blur(10px);backdrop-filter: blur(10px);visibility:hidden;z-index:9999}.dark-mode .page-loading{background-color:#0b0f19}.page-loading.active{opacity:1;visibility:visible}.page-loading-inner{position:absolute;top:50%;left:0;width:100%;text-align:center;-webkit-transform:translateY(-50%);transform:translateY(-50%);-webkit-transition:opacity .2s ease-in-out;transition:opacity .2s ease-in-out;opacity:0}.page-loading.active>.page-loading-inner{opacity:1}.page-loading-inner>span{display:block;font-size:1rem;font-weight:400;color:#9397ad}.dark-mode .page-loading-inner>span{color:#fff;opacity:.6}.page-spinner{display:inline-block;width:2.75rem;height:2.75rem;margin-bottom:.75rem;vertical-align:text-bottom;border:.15em solid #fff;border-right-color:transparent;border-radius:50%;-webkit-animation:spinner .75s linear infinite;animation:spinner .75s linear infinite}.dark-mode .page-spinner{border-color:rgba(255,255,255,.4);border-right-color:transparent}@-webkit-keyframes spinner{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes spinner{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}"),
			document.head.appendChild(A),
			document.documentElement.appendChild(Object.assign(o, { innerHTML: '<div class="page-loading active text-white"><div class="page-loading-inner"><div class="page-spinner"></div></div></div>' }));
	} else {
		const A = document.createElement("style");
		(A.textContent = "html,body{margin: 0;overflow-y: visible}"), document.head.appendChild(A), document.querySelector('.page-loading').remove();
	}
}

function hideSpinner() {
	const A = document.getElementById("my-spinner");
	console.log(A), A.parentNode && A.parentNode.removeChild(A);
}

var clipboard = new ClipboardJS('.castro-copy');

clipboard.on('success', function (e) {
	navigator.clipboard.writeText(e.text);
	$(e.trigger)
	toastr.options.positionClass = 'toast-bottom-right';
	toastr.options.closeButton = true;
	toastr.success('Copied ' + e.text)

	e.clearSelection()
});

clipboard.on('error', function (e) {
	console.error('Action:', e.action);
	console.error('Trigger:', e.trigger);
});


function AvoidSpace(event) {
	var k = event ? event.which : window.event.keyCode;
	if (k == 32) return false;
}

function removeSpaces(string) {
	string = string.split(' ').join('');

	string = string.toLowerCase();

	string = string.replace(/[^a-z0-9]/g, '');

	return string;
}

function removeSpacesPin(string) {
	string = string.split(' ').join('');

	string = string.replace(/[^0-9]/g, '');

	return string;
}

$(window).bind("pageshow", function (event) {
	if (sessionStorage.getItem("preloader") !== null) {
		if ($('.page-loading').length != '') {
			document.querySelector('.page-loading').remove();
			$('button').attr('disabled', false);
		}
	}
});

$('a').on("click", function () {
	var attr = $(this).attr('href');
	if (typeof attr !== 'undefined' && attr !== false) {
		if (attr.trim() != '#' && attr.trim() != '' && attr.trim() != 'javascript:void;' && attr.includes("#") == false && ($(this).attr('target') === 'undefined' && $(this).attr('target') === false)) {
			sessionStorage.setItem("preloader", "active");
			showSpinner("undefined")
		}
	}
})

function convertToFloat(numString) {
	numString = parseFloat(numString.replace(/,/g, ''));
	return numString;
}

function formatNumber(num) {
	var amount = num.replace(/[^\d.]/g, "");
	var parts = amount.split(".");
	var integerPart = parts[0];
	var decimalPart = parts[1];
	integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	var formattedAmount = decimalPart !== undefined ? integerPart + "." + decimalPart : integerPart;
	return formattedAmount
}

function calculateFee(num, type, fiat = 0, percent = 0) {
	if (type == 'both') {
		var result = (parseFloat(num) * parseFloat(percent) / 100) + parseFloat(fiat);
	} else if (type == 'fiat') {
		var result = parseFloat(fiat);
	} else if (type == 'percent') {
		var result = (parseFloat(num) * parseFloat(percent) / 100);
	} else if (type == 'min' && num <= fiat) {
		var result = (parseFloat(num) * parseFloat(percent) / 100);
	} else if (type == 'max' && num > fiat) {
		var result = (parseFloat(num) * parseFloat(percent) / 100);
	} else {
		var result = '0.00';
	}
	return result.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,");
}

$('button').on("click", function () {
	var attr = $(this).attr('type');
	if (typeof attr !== 'undefined' && attr !== false) {
		if (attr.trim() == 'submit' && $('#payment-form').length) {
			$(this).attr('disabled', true)
			sessionStorage.setItem("preloader", "active");
			showSpinner("undefined")
			$('form').submit()
		}
	}
})