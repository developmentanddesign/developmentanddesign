
    //get all About Details 
    $.ajax({
            url: "views/allaboutajax.php",
            type: "POST",
            data: 'data',
            success: function(data) {
            $("#result").html('');
             $('.aboutdata').html(data);
            }
    });
    //get all about Deatils
    
    // form submition for adding about details
    $("#about_form").submit(function(event){
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
            $('#editor1').val('');
            $('#mdesc').val('');
            $.ajax({
                url: "views/allaboutajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                 $('.aboutdata').html(data);
                }
            });
        
        });
    });
    // form submition for adding about details
    
    $('#edit-about').click(function(){
        $.ajax({
                url: "views/editaboutajax.php",
                type: "POST",
                data: {edit:edit},
                success: function(data) {
                 $('.aboutform').html(data);
                 // html Editor
                 CKEDITOR.replace('editor1');
                 
                }
            });
    });