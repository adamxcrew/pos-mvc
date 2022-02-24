$(document).ready(function () {

    // search product
    $('#search').on('keyup', function () {
        // console.log("ok");
        $.ajax({
            url: "http://localhost/pos/public/pos/search",
            method: "POST",
            data: {
                search: $(this).val()
            },
            success: function (data) {
                console.log(data);
                $('#content').html(data);
            }
        })
    });

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

    // user payment
    $('#payment').on('input', function () {
        const payment = ($('#payment').val());
        const total = ($('#total').val());

        const receipt = payment - total;
        $('#receipt').html(receipt);

        if (payment == null || payment == "") {
            $('#receipt').html(`Rp. 0`);
        }
    })
});

