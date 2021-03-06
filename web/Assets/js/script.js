orderBy();
addToCart();
updateBadge();
blockQuantityEnter();

function orderBy()
{
    var $select = $('#order-by');
    
    $(document).on('change', '#order-by', function(){
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
    $(document).on('click', '.add-to-cart button', function(){
        $item = $(this).closest('.item');
        var $quantity = $item.find('.quantity').val();
        var $productId = $item.data('product-id');
        var $update = $item.data('update');
        
        $.post(Routing.generate('add_to_cart',
        {
            'id' : $productId,
            'quantity' : $quantity,
            'update' : $update
        }),
            function(html){
                $('.alerts').replaceWith($(html).find('.alerts'));
                if($('#cart') !== null){
                    $('#cart').empty().append($(html).find('#cart').children());
                }
                updateBadge();
            }
        );
    });
    
}

function updateBadge()
{
    $(document).ready(function(){
        $.post(Routing.generate('get_cart_count'), function(count){
            count = JSON.parse(count);
            $('.badge').text(count);
        });
    });
}

function blockQuantityEnter()
{
    $('.quantity').keydown(function(e) {
        e.preventDefault();
        return false;
     });
}
