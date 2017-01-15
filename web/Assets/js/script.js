$(document).ready(function(){
    
    orderBy();
    addToCart();
});

function orderBy()
{
    var $select = $('#order-by');
    
    $select.change(function(){
        $selectedOption = $select.find('option:selected');
        $orderBy = $selectedOption.val();
        $direction = $selectedOption.data('direction');
        
        $.post(Routing.generate('order_by',
            {
                'by' : $orderBy,
                'direction' : $direction
            }),
            function(html){
                console.log($(html).find('.products'));
                $('.products').replaceWith($(html).find('.products'));
            }
        );
    });
}

function addToCart()
{
    var $submit = $('.add-to-cart');
    
    $submit.click(function(){
        $item = $(this).closest('.item');
        var $quantity = $item.find('.quantity').val();
        var $productId = $item.data('product-id');
        
        $.post(Routing.generate('add_to_cart',
        {
            'id' : $productId,
            'quantity' : $quantity
        }),
            function(html){
                $('.alerts').replaceWith($(html).find('.alerts'));
                $(this).find('button').removeClass('btn-success');
                $(this).find('button').addClass('btn-info');
            }
        );
    });
    
}