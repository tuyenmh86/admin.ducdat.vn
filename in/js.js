$( document ).ready(function() {
    $(".sp span").click(function(){
        $(this).parent(".sp").remove();
    })
    $("div").on( "click", ".del", function(){
        $(this).parent("div").parent(".item").remove();
    })
    $("body").on( "click", ".clone", function(){
        $(this).parents(".item").clone().insertAfter($(this).parents(".item"));
    })

   
});