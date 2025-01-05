$(document).ready(function() {
    $('#add-to-cart').click(function() {
        var productId = $(this).data('product-id'); // احصل على الـ ID للمنتج
        $.ajax({
            url: '/cart/add/' + productId, // مسار إضافة المنتج
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // إضافة التوكن
            },
            success: function(response) {
                // تحديث العدد في أيقونة السلة بعد إضافة المنتج
                $('#cart-count').text(response.cartCount); // تحديث العدد
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    });
});
