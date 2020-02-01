var WebApp = WebApp ||{};
WebApp.DynamicSpinner = WebApp.DynamicSpinner || {};

$(document).ready(function(){
    $('.dynamic').change(function(){
        if($(this).val()!=''){
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token =  $('meta[name="csrf-token"]').attr('content');
            console.log(_token); 
           $.ajax({
                url:url_cats_fetch,
                method:"POST",
                data:{select:select, value:value, _token:_token, dependent:dependent},
                success:function(result)
                {
                    //debugger;
                    console.log("success in ajax"); 
                    $('#'+dependent).html(result);
                }
        
           })
        }

    });

    $('#category').change(function(){
        
    });
});