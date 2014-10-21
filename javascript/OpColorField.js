
jQuery('.cms .field.opcolor').entwine({
	loadPanel : function () {
		this.redrawTabs();
		this._super();
	},
	onmatch: function() {
		if(this.is('.no-chzn')) {
			this._super();
			return;
		}

		// Explicitly disable default placeholder if no custom one is defined
		if(!this.data('placeholder')) this.data('placeholder', ' ');

		// We could've gotten stale classes and DOM elements from deferred cache.
		this.removeClass('has-chzn chzn-done');
		this.siblings('.chzn-container').remove();

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
		// adding the DOM for the  dropdown
		var myid = jQuery(this).attr('id');
		var _this = this;
		
		if(jQuery('.opcolor').find('.chzn-container').size() == 0) {
			if(jQuery(this).find('.chzn-container').size() > 0) 
				return;

			try {
				var windowtitle = window._opcolor[myid + this.hashCode(window.location.href)];
				//defaultColor = windowtitle;
				jQuery(this).find('.currentTitle').html(windowtitle);
			} catch(err) { }
			
			var checkColor = jQuery(this).find('.currentTitle').html();

			if(checkColor == ''){
				defaultColor = 'Select OP Color or No Color';
			} else {
				defaultColor = checkColor;
			}

			var mstr = '<div id="'+myid+'_chzn" class="chzn-container chzn-container-single" style="width: 630px;">\
				<a class="chzn-single" href="javascript:void(0)" tabindex="0">\
					<span>'+defaultColor+'</span><div><b></b></div>\
				</a>\
				<div class="chzn-drop">\
					<div class="chzn-search">\
						<ul class="chzn-results"></ul>\
					</div>\
				</div>\
			</div>';

			// create dropdown events
			jQuery(this).find('.middleColumn').append(mstr);
			jQuery(this).find('.chzn-drop').hide();
			jQuery(this).find('select').each(function (){jQuery(this).hide();});
			jQuery(this).find('.chzn-single').on('click', function (e){
				if(jQuery(this).siblings('.chzn-drop').is(":visible")) {
					jQuery(this).siblings('.chzn-drop').hide();
					jQuery(this).siblings('.chzn-drop li').hide();
				} else {
					jQuery(this).siblings('.chzn-drop').show();
					jQuery(this).siblings('.chzn-drop li').show();
				}
				e.stopPropagation();
			});
			var options = new Array();
			jQuery("#"+myid+" option").each(function (){
				options.push(this);
			});
			// populate the dropdown field with the colors
			jQuery("#"+myid+"_chzn .chzn-results").each(function () {
				var resultsdiv = jQuery(this);
				jQuery.each(options, function (index, value) {
					var rgb = jQuery(value).attr('data-rgb');
					var hex = jQuery(value).attr('data-hex');
					var cmyk = jQuery(value).attr('data-cmyk');
					var myvalue = jQuery(value).attr('value');
					var title = jQuery(value).html();
					var spancolor = '<span data-value=\"'+myvalue+
						'\" data-title=\"'+title+
						'\" class=\"chzn-oppreview\" style=\"background-color:'+hex+'\"><span>'+
						title+'</span></span><br/>';
					var spantext = '<strong>CMYK</strong><br/><span class=\"textColors\">'+cmyk;
					spantext = spantext+'</span><br/><strong>RGB</strong><br/><span class=\"textColors\">'+rgb;
					spantext = spantext+'<br/>'+hex+'</span>';

					resultsdiv.append('<li class=\"chzn-opcolor active-result\">'+
						spancolor+spantext+'</li>');
				});

				// select item
				jQuery(this).find('li').on('click', function(e) {
					jQuery(this).find('.chzn-oppreview').each (function(){
						var title = jQuery(this).attr('data-title');
						var value = jQuery(this).attr('data-value');
						jQuery('#'+myid+' select').val(value).trigger('change');
						jQuery('#'+myid+' .chzn-single span').html(title);
						if(!window._opcolor) window._opcolor = {};
						window._opcolor[myid + _this.hashCode(window.location.href)] = title;
					});

					jQuery("#"+myid+" a.chzn-single").trigger('click');

					e.stopPropagation();
				});
				
				// deselect
				jQuery(document).on('click', function (){
					jQuery(_this).find('.chzn-drop').hide();
				});
			});
		}
		this.tabs();
	}
});