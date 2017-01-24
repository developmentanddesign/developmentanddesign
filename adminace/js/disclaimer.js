
    //get all About Details 
    $.ajax({
            url: "views/alldisclaimerajax.php",
            type: "POST",
            data: 'data',
            success: function(data) {
            $("#result").html('');
             $('.disclaimerdata').html(data);
            }
    });
    
    // form submition for adding about details
    $("#disclaimer_form").submit(function(event){
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
                url: "views/alldisclaimerajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                 $('.disclaimerdata').html(data);
                }
            });
        
        });
    });
    // form submition for adding about details
    
    $('#edit-disclaimer').click(function(){
        $.ajax({
                url: "views/editdisclaimerajax.php",
                type: "POST",
                data: {edit:edit},
                success: function(data) {
                 $('.disclaimerform').html(data);
                 // html Editor
                 CKEDITOR.replace('editor1');
                 
                }
            });
    });