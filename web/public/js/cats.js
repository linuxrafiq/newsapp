var WebApp = WebApp || {};
WebApp.CategoryController = WebApp.CategoryController || {};

WebApp.CategoryController.onClickAppSubmitButton = function (){   
    var title = document.getElementById("title_id").value;
    var messageView = $('.messages');
    var messageHtml = "";
    if (title == null || title == "") {
        messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", "Title should not empty");
        $(messageView).html(messageHtml);
        return;
    }

    var form = $("#form_id")[0];
    var formData = new FormData(form);
    formData.append('parent','0');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_app_post,
        method: "POST",
        contentType: false,
        processData: false,
        data: formData,
        success: function (result) {
            var data_array = $.parseJSON(result);
            if (data_array.status == "200") {
                messageHtml += WebApp.CategoryController.getAlertMessage("alert-success", data_array.message);
            } else {
                messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", data_array.message);
            }

            $(messageView).html(messageHtml);
        },
        error: function (jqXHR, exception) {
            messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger",
                WebApp.CategoryController.getjqXHRmessage(jqXHR, exception));

            $(messageView).html(messageHtml);
        }

    })
}
WebApp.CategoryController.onClickCategorySubmitButton = function (){
    //var select = $app.attr("id");
    var parent = document.getElementById("parent_id");
    var parent_id = parent.options[parent.selectedIndex].value;
    var title = document.getElementById("title_id").value;
    var messageView = $('.messages');
    var messageHtml = "";
    if (parent_id == null || parent_id == "") {
        messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", "Select an app");
    }
    if (title == null || title == "") {
        messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", "Title should not empty");
    }

    if (messageHtml != "") {
        $(messageView).html(messageHtml);
        return;
    }
    var form = $("#form_id")[0];
    var formData = new FormData(form);

    $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_cat_post,
        method: "POST",
        contentType: false,
        processData: false,
        data: formData,
        success: function (result) {
            var data_array = $.parseJSON(result);
            if (data_array.status == "200") {
                messageHtml += WebApp.CategoryController.getAlertMessage("alert-success", data_array.message);
            } else {
                messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", data_array.message);
            }

            $(messageView).html(messageHtml);
        },
        error: function (jqXHR, exception) {
            messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger",
                WebApp.CategoryController.getjqXHRmessage(jqXHR, exception));

            $(messageView).html(messageHtml);
        }

    })
}
WebApp.CategoryController.onClickSubcategorySubmitButton = function () {

    var appCat = document.getElementById("app-cat");
    var valueAppCat = appCat.options[appCat.selectedIndex].value;
    var parent = document.getElementById("parent");
    var valueCat = parent.options[parent.selectedIndex].value;
    var title = document.getElementById("title_id").value;
    var messageView = $('.messages');
    var messageHtml = "";
    if (valueAppCat == null || valueAppCat == "") {
        messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", "Select an app");
    }
    if (valueCat == null || valueCat == "") {
        messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", "Select a category");
    }
    if (title == null || title == "") {
        messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", "Title should not empty");
    }

    if (messageHtml != "") {
        $(messageView).html(messageHtml);
        return;
    }

    var form = $("#form_id")[0];
    var formData = new FormData(form);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url_sub_cat_post,
        method: "POST",
        contentType: false,
        processData: false,
        data: formData,
         success: function (result) {
            console.log(result);

            var data_array = $.parseJSON(result);
            console.log(data_array);
            if (data_array.status == "200") {
                messageHtml += WebApp.CategoryController.getAlertMessage("alert-success", data_array.message);
            } else {
                messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", data_array.message);
            }

            $(messageView).html(messageHtml);
        },
        error: function (jqXHR, exception) {
            messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger",
                WebApp.CategoryController.getjqXHRmessage(jqXHR, exception));

            $(messageView).html(messageHtml);
        }

    })

}
WebApp.CategoryController.onSpinnerChangeListner = function () {
    
    $('.dynamic-app-cats').change(function () {
        if ($(this).val() != '') {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('meta[name="csrf-token"]').attr('content');
            var messageView = $('.messages');
            var messageHtml = "";
            $.ajax({
                url: url_cats_fetch,
                method: "POST",
                data: { select: select, value: value, _token: _token, dependent: dependent },
                success: function (result) {
                    //debugger;
                    //"<td><a href='{{route('cats.edit', "+data_array[i].id+")}}' class='btn btn-default'>Edit</a></td>"+
                    var output ="";
                    
                    var data_array = $.parseJSON(result);
                    if(data_array.length>0){
                        output+="<tr>"+
                        "<th>Title</th>"+
                        "<th></th>"+
                        "<th></th>"
                    "</tr>";
                        for(var i=0; i < data_array.length; i++){
                            let url_edit = url_cat_edit;
                            let url_destroy = url_cat_destory;
                            url_edit = url_edit.replace(':id', data_array[i].id);
                            url_destroy = url_destroy.replace(':id', data_array[i].id);
                            var contentsButton="";
                            if (dependent=="subcategories"){
                                let url_cat_con = url_cat_contents
                                url_cat_con = url_cat_con.replace(':id', data_array[i].id);
                                contentsButton="<td><a href="+url_cat_con+" class='btn btn-primary'>Contents</a></td>";
                            }
                            output+="<tr>"+
                            "<td><img width='50' height='50' src='/storage/cover_images/"+data_array[i].cover_image+"'></td>"+
                            "<td>"+data_array[i].title+"</td>"+
                            contentsButton+
                            "<td><a href="+url_edit+" class='btn btn-primary'>Edit</a></td>"+
                            "<td>"+
                                "<form method='POST' action='"+url_destroy+"'  class='pull-right' accept-charset='UTF-8'>"+
                                "<input type='hidden' name='_method' value='DELETE'>"+
                                "<input type='hidden' name='_token' value="+_token+" >"+
                                "<input type='submit' class='btn btn-danger' value='Delete'/>"+
                                "</form>"+
                            "</td>"+
                        "</tr>";
                        console.log("success in ajax:" + output);

                        }
                    }else{
                        output="Nothings found"
                    }
                    
                    $('#' + dependent).html(output);
                },
                error: function (jqXHR, exception) {
                    messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger",
                        WebApp.CategoryController.getjqXHRmessage(jqXHR, exception));

                    $(messageView).html(messageHtml);
                }

            })
        }

    });

    $('.dynamic').change(function () {
        if ($(this).val() != '') {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('meta[name="csrf-token"]').attr('content');
            var messageView = $('.messages');
            var messageHtml = "";
            $.ajax({
                url: url_cats_fetch,
                method: "POST",
                data: { select: select, value: value, _token: _token, dependent: dependent },
                success: function (result) {
                    //debugger;
                    console.log("success in ajax:" + dependent);
                    // $('#' + dependent).html(result);
                    var output = '<option value="">Select '+dependent[0].toUpperCase()+dependent.slice(1)+'</option>';
                    var data_array = $.parseJSON(result);
                    for(var i=0; i < data_array.length; i++){
                        console.log("success in ajax:" + dependent);

                        output+='<option value="'+data_array[i].id+'">'+data_array[i].title+'</option>';
                    }
                    $('#' + dependent).html(output);
                },
                error: function (jqXHR, exception) {
                    messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger",
                        WebApp.CategoryController.getjqXHRmessage(jqXHR, exception));

                    $(messageView).html(messageHtml);
                }

            })
        }

    });

    $('#category').change(function () {

    });
}
WebApp.CategoryController.getjqXHRmessage = function (jqXHR, exception) {
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

    return msg;
}
WebApp.CategoryController.getAlertMessage = function (type, message) {
    if (type == 'alert-success') {
        return '<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong> ' + message +
            '</div><br>';
    } else {
        return '<div class="alert alert-danger">' +
            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong> ' + message +
            '</div><br>';
    }
}
$(document).ready(function () {
    WebApp.CategoryController.onSpinnerChangeListner();
});