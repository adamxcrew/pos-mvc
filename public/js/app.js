$(document).ready(function () {
    // reduce cart quantity
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

    // delete cart
    $('.delete').on('click', function () {
        const id = $(this).data('id');
        // console.log(id);
        $.ajax({
            url: 'http://localhost/pos/public/pos/delete',
            data: { id: id },
            method: "post",
            // dataType: 'json',
            success: function (data) {
                location.reload();
            }
        })
    });

});