<script>
    function ajaxPost(url, method = 'POST', data, callback) {
        // update password

            $.ajax({
                url: url,
                method: method,
                data: data,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    prosesLoading();
                    console.log('loading');

                    $('.invalid-feedback').remove();
                    $('input, select, textarea').removeClass('.is-invalid');
                },
                success: function(data) {
                    Swal.fire(
                        'Berhasil',
                        data.message,
                        'success'
                    ).then(function () {
                        location.reload()
                    });

                    if (typeof callback === 'function') {
                        callback();
                    }
                },
                error: function(data) {
                    if (data.status == 422) {
                        var errors = data.responseJSON.errors;
                        for (var prop in errors) {
                            $(`[name='${prop}']`).addClass('is-invalid').after(`
                                        <div class="invalid-feedback">
                                            ${errors[prop]}
                                        </div>
                                        `);
                            $(".invalid-feedback").show();
                            console.log(prop);

                            $('html, body').animate({
                                scrollTop: $(".is-invalid").first().offset().top -
                                    500
                            }, 500);
                        }
                    }
                },
                complete: function() {
                    $.unblockUI()
                }
            })
    }
</script>
