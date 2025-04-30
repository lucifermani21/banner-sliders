jQuery(document).ready(function($) {
    // Add new field group
    $('#add-new-field-group').click(function() {
        var $lastGroup = $('.repeatable-field-group').last();
        var newIndex = $lastGroup.data('index') + 1;
        var $newGroup = $lastGroup.clone();
        
        // Update the new group
        $newGroup.attr('data-index', newIndex);
        $newGroup.find('h3').text('Item ' + (newIndex + 1));
        $newGroup.find('input, textarea').val('');
        $newGroup.find('.image-preview').html('');
        $newGroup.find('.image-id').val('');
        
        // Update name attributes
        $newGroup.find('[name]').each(function() {
            var name = $(this).attr('name');
            name = name.replace(/\[\d+\]/, '[' + newIndex + ']');
            $(this).attr('name', name);
        });
        
        $newGroup.insertAfter($lastGroup);
    });
    
    // Remove field group
    $(document).on('click', '.remove-field-group', function() {
        if ($('.repeatable-field-group').length > 1) {
            $(this).closest('.repeatable-field-group').remove();
            // Reindex remaining groups
            $('.repeatable-field-group').each(function(index) {
                $(this).attr('data-index', index);
                $(this).find('h3').text('Item ' + (index + 1));
                $(this).find('[name]').each(function() {
                    var name = $(this).attr('name');
                    name = name.replace(/\[\d+\]/, '[' + index + ']');
                    $(this).attr('name', name);
                });
            });
        } else {
            alert('You need at least one item.');
        }
    });
    
    // Image upload
    $(document).on('click', '.upload-image-button', function() {
        var file_frame;  
        var $button = $(this);
        var $imageId = $button.siblings('.image-id');
        var $imagePreview = $button.siblings('.image-preview');
        
        if (file_frame) {
            file_frame.open();
            return;
        } 

        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select an Image',
            button: {
                text: 'Use this image',
            },
            multiple: false // Set to true to allow multiple files to be selected
        }); 
        
        file_frame.on('select', function() {
            var attachment = file_frame.state().get('selection').first().toJSON();
            $imageId.val(attachment.id);
            $imagePreview.html('<img src="' + attachment.url + '" style="max-width:150px; height: auto;">');
        });
        
        file_frame.open();
    });
    
    // Remove image
    $(document).on('click', '.remove-image-button', function() {
        $(this).siblings('.image-id').val('');
        $(this).siblings('.image-preview').html('');
    });
});