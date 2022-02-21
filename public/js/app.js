$(document).ready(function () {

    $('.reduce').on('click', function () {
        const id = $(this).data('id')
        // console.log(id);
        $.ajax({
            url: 'http://localhost/pos/public/pos/decrement',
            data: { id: id },
            method: "post",
            // dataType: 'json',
            success: function (data) {
                $('.qty').val(data);
                location.reload();
            }
        })
    });

});