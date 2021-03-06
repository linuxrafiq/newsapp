var WebApp = WebApp || {};
WebApp.ContentController = WebApp.ContentController || {};

WebApp.ContentController.onClickContentSubmitButton = function () {
    console.log("content submit");
    var appCat = document.getElementById("app-cat");
    var valueAppCat = appCat.options[appCat.selectedIndex].value;
    var category = document.getElementById("category");
    var valueCat = category.options[category.selectedIndex].value;
    var subcategory = document.getElementById("subcategory");
    var valueSubCat = subcategory.options[subcategory.selectedIndex].value;
    var type = document.getElementById("type");
    var valueType = type.options[type.selectedIndex].value;
    var contentIsReady = false;
    var content = null;
    var title = "";
    if(document.getElementById("editor")!==null){
        content = document.getElementById("editor").value;
    }
    if(document.getElementById("title")!==null){
        title = document.getElementById("title").value;
    }
    var messageView = $('.messages');
    var messageHtml = "";
    if (valueAppCat == null || valueAppCat == "") {
        messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", "Select an app");
    }
    if (valueCat == null || valueCat == "") {
        messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", "Select a category");
    }
    if (valueSubCat == null || valueSubCat == "") {
        messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", "Select a subcategory");
    }
    if (valueType == null || valueType == "") {
        messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", "Select a type");
    }
    // if (content == null) {
    //     messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", "Select a type");
    // }
    if (content != null && content == "") {
        messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger", "Content should not empty");
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
        url: url_content_store,
        method: "POST",
        contentType: false,
        processData: false,
        data: formData,
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    console.log(percentComplete);
                    $('#status').html('Upload a file (compulsory):<b> Uploading -> ' + (Math.round(percentComplete * 100)) + '% </b>');
                }
            }, false);
            return xhr;
        },
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

WebApp.ContentController.onTypeChangeListner = function(){
    $('.dynamic-view').change(function () {
        if ($(this).val() != '') {
            var select = $(this).attr("id");
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('meta[name="csrf-token"]').attr('content');
            console.log("slect"+select);
            console.log("value"+value);
            //$('#view-area').load('/contents/views/htmlview.blade.php');
            $.ajax({
                url: url_content_type,
                method: "POST",
                data: { type: value, _token: _token },
                dataType: 'json',
                success: function (result) {
                    console.log(result);
        
                    $('#view-area').html(result);
                },
                error: function (jqXHR, exception) {
                    // messageHtml += WebApp.CategoryController.getAlertMessage("alert-danger",
                    //     WebApp.CategoryController.getjqXHRmessage(jqXHR, exception));
        
                     //   $('#view-area').html(messageHtml);
                }
        
            })
            
        }

    });
}
$(document).ready(function () {
    WebApp.ContentController.onTypeChangeListner();
});