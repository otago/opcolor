
jQuery('.cms .field.opcolor').entwine({
	loadPanel : function () {
		this.redrawTabs();
		this._super();
	},
	onmatch: function() {
		console.log('match!');
		if(this.is('.no-chosen')) {
			this._super();
			return;
		}

		// Explicitly disable default placeholder if no custom one is defined
		if(!this.data('placeholder')) this.data('placeholder', ' ');

		// We could've gotten stale classes and DOM elements from deferred cache.
		this.removeClass('has-chosen chosen-done');
		this.siblings('.chosen-container').remove();

		// Apply Chosen
		//applyChosen(this);
		this.redrawTabs();
		this._super();
	},
	onunmatch: function() {
		this._super();
	},
	hashCode: function(s){
		var hash = 0, i, mchar;
		if (s.length == 0) return hash;
		for (i = 0, l = s.length; i < l; i++) {
			mchar  = s.charCodeAt(i);
			hash  = ((hash<<5)-hash)+mchar;
			hash |= 0; // Convert to 32bit integer
		}
		return hash;
	},
	redrawTabs: function() {
		console.log('redrawTabs');
		// adding the DOM for the  dropdown
		var selectcontainer = jQuery(this).children('.middleColumn').children('select');
		var myid = selectcontainer.attr('id');
		var _this = this;
		
		var rebuilddropdown = function (mydropdown) {
			var options = new Array();
			mydropdown.find('option').each(function (){
				options.push(this);
			});
			// populate the dropdown field with the colors
			mydropdown.find(".chosen-results").each(function () {
				var resultsdiv = mydropdown.find('.chosen-results');
				var idcount = 0;
				jQuery.each(options, function (index, value) {
					var rgb = jQuery(value).attr('data-rgb');
					var hex = jQuery(value).attr('data-hex');
					var cmyk = jQuery(value).attr('data-cmyk');
					var myvalue = jQuery(value).attr('value');
					var title = jQuery(value).html();
					var spancolor = '<span data-value=\"'+myvalue+
						'\" data-title=\"'+title+
						'\" class=\"chosen-oppreview\" style=\"background-color:'+hex+'\"><span>'+
						title+'</span></span><br/>';
					var spantext = '<strong>CMYK</strong><br/><span class=\"textColors\">'+cmyk;
					spantext = spantext+'</span><br/><strong>RGB</strong><br/><span class=\"textColors\">'+rgb;
					spantext = spantext+'<br/>'+hex+'</span>';

					myid = myid + "_o_" + (idcount++);
					resultsdiv.append('<li class=\"chosen-opcolor active-result\" id="'+myid+'">'+
						spancolor+spantext+'</li>');
				});
			});
		}
		jQuery(_this).find('select').on('liszt:showing_dropdown', function () {
			_this.find('li').hide();
			_this.find('.chosen-search').remove();
			rebuilddropdown(_this);
		})
		
		if(jQuery('.opcolor').find('.chosen-container').size() == 0) {
			if(jQuery(this).find('.chosen-container').size() > 0) 
				return;

			var checkColor = jQuery(this).find('.currentTitle').html();

			if(checkColor == '') {
				defaultColor = 'Select OP Color or No Color';
			} else {
				defaultColor = checkColor;
			}
			
		}
		this.tabs();
	}
});