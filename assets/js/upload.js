jQuery(document).ready(function($){
    $('.upload-file').click(function(e) {
        e.preventDefault();
        var button = $(this);
        var inputField = $(this).next('.file-url');
        
        var file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select or Upload a File',
            button: {
                text: 'Use this file'
            },
            library: {
                type: ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
            },
            multiple: false
        });

        file_frame.on('select', function() {
            var attachment = file_frame.state().get('selection').first().toJSON();
            var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

            if (allowedTypes.indexOf(attachment.mime) !== -1) {
                inputField.val(attachment.url);
            } else {
                alert('Please select a PDF, DOCX, or DOC file.');
            }
        });

        file_frame.open();
    });
});



