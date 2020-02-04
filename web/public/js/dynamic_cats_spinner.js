var WebApp = WebApp ||{};
WebApp.Dynamic2LayerSpinner = WebApp.Dynamic2LayerSpinner || {};

WebApp.Dynamic2LayerSpinner.onClickSubmitButton = function(){
    console.log("submit button clicked");
    var app = document.getElementById("app");
    //var select = $app.attr("id");
            var appCat = document.getElementById("app-cat");
            var valueAppCat = appCat.options[appCat.selectedIndex].value;
            var category = document.getElementById("category");
            var valueCat = appCat.options[category.selectedIndex].value;
            var title = document.getElementById("name-sub").value;
            var messageView = $('.messages');
            var messageHtml="";
            if(valueAppCat==null || valueAppCat ==""){
                messageHtml += '<div class="alert alert-danger">'+
                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong> '+ "Select an app" +
                '</div><br>';
            }
            if(valueCat==null || valueCat ==""){
                messageHtml += '<div class="alert alert-danger">'+
                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong> '+ "Select a category" +
                '</div><br>';
            }
            if(title==null || title ==""){
                messageHtml += '<div class="alert alert-danger">'+
                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong> '+ "Title should not empty" +
                '</div><br>';
            }
               
            if (messageHtml != ""){
                $(messageView).html(messageHtml);
                return;
            }
            console.log("validation complete")

            
            var _token =  $('meta[name="csrf-token"]').attr('content');
            console.log(title); 
            console.log(valueCat); 
            console.log(valueAppCat);
            $.ajax({
                url:url_sub_cat_post,
                method:"POST",
                data:{title:title, appcat:valueAppCat, _token:_token, cat:valueCat},
                success:function(result)
                {
                    console.log(result);

                    var data_array = $.parseJSON(result);
                    console.log(data_array);
                    if (data_array.status == "200"){
                        messageHtml += '<div class="alert alert-success">'+
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                    '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong> '+ data_array.message +
                                    '</div><br>';
                    }else{
                        messageHtml += '<div class="alert alert-danger">'+
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                    '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong> '+ data_array.message +
                                    '</div><br>';
                    }

                    $(messageView).html(messageHtml);
                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    messageHtml += '<div class="alert alert-danger">'+
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                    '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong> '+ msg +
                    '</div><br>';
 
                    $(messageView).html(messageHtml);
                }
        
           }) 
            
}
WebApp.Dynamic2LayerSpinner.onSpinnerChangeListner = function(){
    $('.dynamic').change(function(){
        if($(this).val()!=''){
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token =  $('meta[name="csrf-token"]').attr('content');
            console.log(_token); 
            console.log(select); 
            console.log(value); 
            console.log(dependent); 
           $.ajax({
                url:url_cats_fetch,
                method:"POST",
                data:{select:select, value:value, _token:_token, dependent:dependent},
                success:function(result)
                {
                    //debugger;
                    console.log("success in ajax:"+dependent); 
                    $('#'+dependent).html(result);
                }
        
           })
        }

    });

    $('#category').change(function(){
        
    });
}
$(document).ready(function(){
    WebApp.Dynamic2LayerSpinner.onSpinnerChangeListner();
});