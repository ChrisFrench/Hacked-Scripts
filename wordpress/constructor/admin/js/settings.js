(function($){
   
$(document).ready(function(){
	// Select based on images
    $('.constructor .select a').click(function(){
        $(this).parent().find('a').removeClass('selected');
        $(this).addClass('selected');
        var id = $(this).parent().attr('id');
        $('#constructor-' + id).val($(this).attr('name'));
        return false;
    });

    // Checkbox for fieldsets
	$('.constructor fieldset > legend > input:checkbox').bind('check-fieldset', function(){
		var $this = $(this);
		if ($this.is(':checked')) {
			$this.parents('fieldset').find(':input').not(this).removeAttr('disabled');
            $this.parents('fieldset').removeClass('disabled');
		} else {
			$this.parents('fieldset').find(':input').not(this).attr('disabled','disabled');
            $this.parents('fieldset').addClass('disabled');
		}
	}).click(function(){
		$(this).trigger('check-fieldset');
	}).trigger('check-fieldset');
	
    // Admin Tabs
    $('#tabs').tabs({ fxFade: true, fxSpeed: 'fast' });
    
    // Clear input fields values
    $('.clear-link').click(function(){
       $(this).parent().find('input').val('');
       return false;
    });

    // Donate close button
    $('.donate .message-close').hover(function(){
        $(this).find('.ui-icon')
            //.removeClass('ui-icon-close')
            .addClass('ui-icon-closethick')
            ;
    },function(){
        $(this).find('.ui-icon')
            .removeClass('ui-icon-closethick')
            //.addClass('ui-icon-close')
            ;
    })
    .click(function(){
        // @todo: not sure to correct way
        $.post($(this).attr("href"), {
            action: "constructor_admin_donate"
          }
        );
        $(this).parent('#message').remove();
        return false;
    });
    
    // Save button
    $('#save-link').click(function(){
        // @todo hardcode object
        var data = {
            action: "constructor_admin_save",
            'theme':$('#save-theme-name').val(),
            'theme-uri':$('#save-theme-uri').val(),
            'description':$('#save-description').val(),
            'version':$('#save-version').val(),
            'author':$('#save-author').val(),
            'author-uri':$('#save-author-uri').val()
        };
        
        $.post($(this).attr("href"), data, function(response){
            if (response.status == 'ok') {                
                Messages.addNotice(response.message, null);
            } else {
                Messages.addWarning(response.message, null);
            }
        },"json");
        return false;
    });
    
    var dialogs = {};
    
    // Help dialog
    $('.help-button').click(function(){
        var id = $(this).attr('name');
        if (dialogs[id] == undefined) {
            dialogs[id] = $(this).parents('.ui-tabs-panel').find('.constructor-admin-help');
            dialogs[id].dialog({
                autoOpen: false,
                width:820/*,
        		modal: true*/
        	});
        }
        dialogs[id].dialog('open');
    	return false;
    });
    
    // Accordion
    $('.constructor-accordion').accordion({
		autoHeight: false,
		navigation: true
	});

});
})(jQuery);

/**
 * Get Id element by name
 * @param {String} name
 */
function name2id(name) {
    var name = name.replace(/\]\[/,'-');
        name = name.replace(/\[/,'-');
        name = name.replace(/\]/,'');
    return name;  
}

// Init Color Picker
function initColorPicker(el) {
    jQuery('#'+el).ColorPicker({
        color:jQuery('#constructor-'+el).val(),
        onChange: function (hsb, hex, rgb) {
            jQuery('#constructor-'+el).val('#' + hex);
            jQuery('#'+el+' div').css('backgroundColor', '#' + hex);
        }
    })
    .bind('keyup', function(){
        jQuery(this).ColorPickerSetColor(this.value);
    });
}