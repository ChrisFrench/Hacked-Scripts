var Messages = {
    
    _typeNotice:'<div id="message" class="updated fade below-h2 ui-state-highlight">'+
                    '<p><span class="ui-icon ui-icon-info alignleft"/><span class="ui-icon ui-icon-close message-close"/></p>'+
                '</div>',
			    
    _typeWarning:'<div id="message" class="updated fade below-h2 ui-state-highlight">'+
                    '<p><span class="ui-icon ui-icon-alert alignleft"/><span class="ui-icon ui-icon-close message-close"/></p>'+
                '</div>',
			    
    _typeError:'<div id="message" class="error fade below-h2 ui-state-error">'+
                    '<p><span class="ui-icon ui-icon-alert alignleft"/><span class="ui-icon ui-icon-close message-close"/></p>'+
                '</div>',
			    
    addMessage:function(type, text, callback) {

        var el = jQuery(Messages['_type'+type]);
            el.find('p').append(text);
            el.css({display:'none'});
            el.find('.ui-icon-close').click(function(){
                jQuery(this).parent().parent().fadeOut();
            }).hover(function(){
                jQuery(this).addClass('ui-icon-closethick');
            },function(){
                jQuery(this).removeClass('ui-icon-closethick');
            });
            el.insertAfter('.wrap h2:first');
            el.fadeIn(2000, callback);
    },
    addError:function(message, callback) {
        Messages.addMessage('Error', message, callback);
    },
    addErrors:function(messages, callback) {
        jQuery.each(messages, function(message) {
            Messages.addError(message, callback);
        });
    },
    addNotice:function(message, callback) {
        Messages.addMessage('Notice', message, callback);
    },
    addNotices:function(messages, callback) {
        jQuery.each(messages, function(message) {
            Messages.addError(message, callback);
        });
    },
    addWarning:function(message, callback) {
        Messages.addMessage('Warning', message, callback);
    },
    addWarnings:function(messages, callback) {
        jQuery.each(messages, function(message) {
            Messages.addError(message, callback);
        });
    }
}