jQuery(document).ready(function($) {
    var mediaUploader;
    $('#csc_upload_logo_button').click(function(e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media({
            title: 'Chọn Logo Trang Web',
            button: { text: 'Chọn Logo' },
            multiple: false,
            library: { type: 'image' }
        });
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#csc_site_logo_id').val(attachment.id);
            $('#csc_logo_preview').html('<img src="' + attachment.url + '" style="max-width: 300px;" />');
        });
        mediaUploader.open();
    });

    // Xóa logo
    $('#csc_remove_logo_button').click(function(e) {
        e.preventDefault();
        $('#csc_site_logo_id').val('');
        $('#csc_logo_preview').html('<p>Chưa có logo nào được thiết lập.</p>');
    });
});