$(document).ready(function () {

    // Search Product
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

    // Reduce Cart Quantity
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

    // Delete Cart
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

    // Add Tax
    // $('.addtax').on('click', function (e) {
    //     e.preventDefault();

    //     let subTotal = $("#subTotal").text();
    //     let tax = 0.05 * subTotal;
    //     let total = parseInt(tax) + parseInt(subTotal);
    //     $("#tax").text(tax);
    //     $("#totalAll").text(rupiah(total));

    // });

    // Remove Tax
    // $('.removetax').on('click', function (e) {
    //     e.preventDefault()
    //     $('#tax').text('Rp. 0');
    //     let subTotal = $("#subTotal").text();
    //     let tax = 0.05 * subTotal;
    //     let total = parseInt(tax) + parseInt(subTotal);
    //     $("#totalAll").text(rupiah(subTotal));
    // });

    // User Payment
    $('#payment').on('input', function () {
        const payment = $('#payment').val();
        const total = $('#total').val();
        const receipt = payment - total;
        // const btnSave = $('#btnSave');

        $('#paymentText').html(`Rp. ${rupiah(payment)}, 00`)
        $('#receipt').html(`Rp. ${rupiah(receipt)}, 00`);

        if (payment == null || payment == "") {
            $('#paymentText').html(`Rp. 0`);
            $('#receipt').html(`Rp. 0`);
        }

        if (receipt < 0) {
            $('#btnSave').attr('disabled', 'disabled')
        } else {
            $('#btnSave').removeAttr('disabled')
        }
    })

    // Rupiah 
    function rupiah(number) {
        const numberString = number.toString()
        const split = numberString.split(',')
        const receipt = split[0].length % 3
        let rupiah = split[0].substr(0, receipt)
        const ribuan = split[0].substr(receipt).match(/\d{1,3}/gi)
        if (ribuan) {
            const separator = receipt ? '.' : ''
            rupiah += separator + ribuan.join('.')
        }
        return split[1] != undefined ? rupiah + ',' + split[1] : rupiah
    }

    // Get data form payment
    // $('#btnSave').on('click', function (e) {
    //     e.preventDefault();

    // })

    // Form Edit Data
    $(".edit_data").on('click', function () {
        $("#modalTitle").html('Edit Data');
    });

    // $(".delete_data").on('click', function () {
    //     const id = $(this).data('id')
    //     $.ajax({
    //         url: 'http://localhost/pos/public/product/delete',
    //         data: { id: id },
    //         method: "post",
    //         // dataType: 'json',
    //         success: function (data) {
    //             // location.reload();
    //         }
    //     })
    // })

    $(".trans_details").on('click', function () {
        const id = $(this).data('id');
        // console.log(id);
        $.ajax({
            url: 'http://localhost/pos/public/transactions/getItem',
            data: { id: id },
            method: "post",
            // dataType: 'json',
            success: function (data) {
                const items = JSON.parse(data);
                $("#list_transaction").empty();
                for (const item in items) {
                    console.log(items[item])
                    $("#list_transaction").append(`
                    <tr>
                    <td>`+ items[item].name + `</td>
                    <td>`+ items[item].description + `</td>
                    <td>`+ items[item].price + `</td>
                    <td>`+ items[item].quantity + `</td>
                    <td>`+ items[item].price * items[item].quantity + `</td>
                    </tr>
                    `)
                }
            }

        })
    })

});

