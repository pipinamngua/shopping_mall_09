$(document).ready(function() {
    function getCart () {
        $.ajax({
            url: '/get-cart',
            type: 'GET',
            success: function (response) {
                $('.home_count_cart').html(response.countCart);
                $('.item_total_price').html('$' + response.total);
            }
        });
    };
    
    $('.change-qty').change(function(e) {
        e.preventDefault();
        var qualytiProduct = $(this);
        var qtyUpdate = $(this).val();
        var rowID = $(this).attr('idCart');
        $.ajax({
            url: '/update-cart',
            type: 'GET',
            data: {qtyUpdate: qtyUpdate, rowID: rowID},
            success: function (res) {
                $.each( res, function( key, value ) {
                    let totalPrice = value.price * value.qty;
                    qualytiProduct.parents('.myTable').find('.item_price').html('$' + totalPrice);
                });
                getCart();
                toastr.success('Product Successfully!');
            }
        });
    });

    $('.delete-product').click(function(e) {
        e.preventDefault();
        var idCart = $(this).attr('idCart');
        var deleteProduct = $(this);
        $.ajax({
            url: '/del-cart',
            type: 'GET',
            data: {idCart: idCart},
            success: function (res) {
                console.log(res)
                if (res == 1) {
                    deleteProduct.parents('.myTable').remove();
                    getCart();
                    toastr.warning('Product was removed!');
                }
            }
        });
    });

    getCart();
});
