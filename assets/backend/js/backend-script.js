jQuery(document).ready(function($) {
    // Uploading files
    var file_frame;    
    $('#upload-image-button').on('click', function(event) {
        event.preventDefault();
        
        // If the media frame already exists, reopen it.
        if (file_frame) {
            file_frame.open();
            return;
        }        
        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select an Image',
            button: {
                text: 'Use this image',
            },
            multiple: false // Set to true to allow multiple files to be selected
        });        
        // When an image is selected, run a callback.
        file_frame.on('select', function() {
            var attachment = file_frame.state().get('selection').first().toJSON();
            
            // Set the hidden field with the image ID
            $('#banner_images').val(attachment.id);
            
            // Display the image
            $('#image-preview').html('<img src="' + attachment.url + '" style="max-width: 150px; height: auto;" />');
            
            // Show the remove button
            $('#remove-image-button').show();
        });
        
        // Finally, open the modal
        file_frame.open();
    });    
    // Remove image
    $('#remove-image-button').on('click', function(event) {
        event.preventDefault();
        
        // Clear the hidden field
        $('#banner_images').val('');
        
        // Remove the image preview
        $('#image-preview').html('');
        
        // Hide the remove button
        $(this).hide();
    });
});