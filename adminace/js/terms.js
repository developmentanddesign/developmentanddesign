
    //get all About Details 
    $.ajax({
            url: "views/alltermsajax.php",
            type: "POST",
            data: 'data',
            success: function(data) {
            $("#result").html('');
             $('.termsdata').html(data);
            }
    });
    
    // form submition for adding about details
    $("#terms_form").submit(function(event){
        event.preventDefault(); //prevent default action 
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var post_url = $(this).attr("action"); //get form action url
        var request_method = $(this).attr("method"); //get form GET/POST method
        var formData = new FormData($(this)[0]); //Encode form elements for submission
        $.ajax({
            url : post_url,
            type: request_method,
            data : formData,
            processData: false,
            contentType: false
        }).done(function(response){ //
            $("#result").html(response);
            $('#mtitle').val('');
            $('#editor2').val('');
            $('#mdesc').val('');
            $.ajax({
                url: "views/alltermsajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                 $('.termsdata').html(data);
                }
            });
        
        });
    });
    // form submition for adding about details
    
    $('#edit-terms').click(function(){
        $.ajax({
                url: "views/edittermsajax.php",
                type: "POST",
                data: {edit:edit},
                success: function(data) {
                 $('.termsform').html(data);
                 // html Editor
                 CKEDITOR.replace('editor1');
                 
                }
            });
    });