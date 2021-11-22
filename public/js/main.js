$( document ).ready(function() {
	$('#file-download-btn').click(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/download',
            type: 'POST',
            data: {_token: CSRF_TOKEN},
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
            }
        });
    });
});