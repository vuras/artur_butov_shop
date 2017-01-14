$(document).ready(function(){
    
    orderBy();
    
});

function orderBy()
{
    var select = $('#orderBy');
    
    select.change(function(){
        $.post();
    });
}