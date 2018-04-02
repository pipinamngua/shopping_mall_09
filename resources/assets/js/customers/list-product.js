$(document).ready(function() {
    $('.add-cart').click(function(e) {
        e.preventDefault();
        var itemPrice = $(this).parents().find('.item-price').text();
        var imagePath = $(this).parents().find('.url-images').attr('url');
        var idProduct = $(this).attr('id-product');
        itemPrice= Number(itemPrice);
        $.ajax({
            url: '/add-cart',
            type: 'GET',
            data: {
                itemPrice: itemPrice,
                idProduct: idProduct,
                imagePath: imagePath
            },
            success: function (response) {
                $('.home_count_cart').html(response.countCart);
                toastr.success('Product Successfully!');
            }
        });
    });

    $.ajax({
        url: '/get-cart',
        type: 'GET',
        success: function (response) {
            $('.home_count_cart').html(response.countCart);
        }
    });
});
