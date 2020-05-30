$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $('.action-category-deletion').click(function () {
        if (confirm('Are you sure')) {
            const self = $(this);
            $.ajax({
                url: self.data('url'),
                type: 'DELETE',
                success: function (res) {
                    if (res.success) {
                        $('#tr' + self.data('id')).html('');
                    } else {
                        const msg = res.message + "\n Do you want to refresh the page?";
                        if (confirm(msg)) {
                            window.location.reload();
                        }
                    }
                }
            });
        }
    });
});