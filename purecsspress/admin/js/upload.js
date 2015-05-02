/**
 * WPshed Theme Options - WP Media Upload
 */
jQuery(document).ready(function($){
    'use strict';

    // Upload image
    var _custom_media = true,
    _orig_send_attachment = wp.media.editor.send.attachment;
     
    $( '.wto-upload-button' ).click( function(e) {
        var send_attachment_bkp = wp.media.editor.send.attachment,
            button              = $( this ),
            id                  = button.attr( 'id' ).replace( '-button', '' );
        
        _custom_media = true;

        wp.media.editor.send.attachment = function( props, attachment ) {
        
        if ( _custom_media ) {
            $( "#" + id ).val( attachment.url );
        } else {
            return _orig_send_attachment.apply( this, [props, attachment] );
        };

    }

    wp.media.editor.open( button );
        return false;
    });
     
    $( '.add_media' ).on( 'click', function(){
        _custom_media = false;
    });

    // Remove image
    $( '.wto-remove-button' ).on( 'click', function(){

        var button  = $( this ),
            id      = button.attr( 'id' ).replace( '-remove', '' );

        $( '#' + id ).val( '' );
        $( '#' + id + '-preview' ).fadeOut( '' );
        button.remove();

    });

}); 