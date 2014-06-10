jQuery(document).ready(function($) {

	// Vars

	var isiPad = navigator.userAgent.match(/iPad/i) != null;
	var showform = $.cookie('showform');

	// Functions

	jQuery.fn.searchTags = function () {
		var optionTexts = [];
		$('.selectedtag').each(function() { 
//			var str = $(this).text().replace(/\s+/g, '-').toLowerCase();

			var str = $(this).attr('class').replace(/\sselectedtag+/g, '');
			optionTexts.push(str);
		});	


		if ( $('#any').hasClass('selected') ) {
			var param = 'tag';
			var separator = ',';
		} else {
			var param = 'tdo_tag';
			var separator = '+';			
		}

		var tagstring = optionTexts.join(separator);
		window.location = '/photo/?' + param + '=' + tagstring;

	}

	jQuery.fn.initialLoad = function () {

		$('.grid').masonry({
			itemSelector : '.thumb',
			columnWidth : 253,
			gutterWidth : 20
		});

		$('.photo').append('<div class="shield" />');
		$('.shield').shieldPhoto();

		$('body').append('<div class="shade" />');
		$('.shade').hide();

		$('.taxonomies').insertAfter('.header');

		$('.taxonomies').prepend('<a class="close"><span>Close</span></a>');

		$('.taxonomies h3').html('Select one or more tags, then press <em>&ldquo;Search Tags&rdquo;</em>');
		
		$('.taglist').before('<div class="searchcontrols"><span>Find photos with </span><a id="any" class="tagtoggle selected">any</a><span class="slash"> / </span><a id="all" class="tagtoggle">all</a><span> of the selected criteria</span></div>');	

		$('.taxonomies').append('<div><a class="searchtags">Search Tags</a></div>');	

		
		$('.taxonomies').hide();

		$('.buybutton a').css('display','inline');
		$('.modal .close').css('display','block');

		$('.contactform').hide();

		var anchor = $.param.fragment();

		var postnumber = $('#postnumber').attr('value');
		// console.log('postnumber is: ' + postnumber);

		if ( typeof postnumber != 'undefined'  && showform == postnumber ) {
			$('.contactform').center();
			// console.log('centering');
		}



	}

	jQuery.fn.center = function () {

			var $t = ( ( $(window).height() - this.outerHeight() ) / 2);
			var $h = $('.header').outerHeight();

	       	if ( ( $(window).height() - $h ) >= this.outerHeight() ) {
				jQuery('.shade').fillWindow();

		    	this.css({
						"position":"fixed",
						"top" : ($t + "px")
						});

				if ( $(window).width() >= this.outerWidth() ) {
		    		this.css("left", (($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft() + "px");
				}

			} else {
				// Don't do
			}

			this.show();

	    	return this;

	}


	jQuery.fn.fillWindow = function () {
		this.css({
			"position" : "fixed",
			"top" : "0px",
			"height" : ( $(window).height() + "px" ),
			"width" : ( $(window).width() + "px" )
			});
		this.show();		
	}

	jQuery.fn.hideModals = function () {

		$('.contactform').hide();
		$('.taxonomies').hide();
		$('.shade').hide();
		$.cookie('showform', '');
		// console.log('cookie set to nothing ');
	}
	
	jQuery.fn.shieldPhoto = function () {

		var $thisImage = $(this).parent().find('img');
		var $w = $thisImage.css('width');
		var $h = $thisImage.css('height');
		var $m = -$thisImage.height();
		$(this).css({
			"width" : $w,
			"height" : $h, 
			"margin-top" : $m
		});

	}	
	

	// Go!

	$('.homegallery').cycle({
		fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});

	$('.content').initialLoad();

	$('.taglist a').bind('click', function(event) {
		event.preventDefault();

		if ( $(this).hasClass('selectedtag') ) {
			$(this).removeClass('selectedtag');
		} else {
			$(this).addClass('selectedtag');
		}

	});


	$('.buybutton a').bind('click', function(event) {
		event.preventDefault()
		$('.contactform').center();
		var postnumber = $('#postnumber').attr('value');
		$.cookie('showform', postnumber);
		// console.log('cookie set to: ' + postnumber);
	});

	$('.tagtoggle').bind('click', function(event) {
		event.preventDefault()

		$('.tagtoggle').removeClass('selected');
		$(this).addClass('selected');
	});

	$('.searchtags').bind('click', function(event) {
		event.preventDefault()
		$(document).searchTags();
	});


	$('.shade').click(function() {
		$(document).hideModals();
	});

	$('.close').click(function() {
		$(document).hideModals();
	});

	$('#menu-item-182 a').bind('click', function(event) {
		event.preventDefault()
		$('.taxonomies').center();
	});


	// Newsletter
	$('#emailform').focus(function() {
		$('#emailform .details').show();
	});

	$('#tlemail').focus(function() {
		$('#emailform .details').show();
	});

	$('#emailform').focusout(function() {
		$('#emailform .details').hide();
	});

});