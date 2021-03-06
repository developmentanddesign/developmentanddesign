
    //get all About Details 
    $.ajax({
            url: "views/alldisclaimerajax.php",
            type: "POST",
            data: 'data',
            beforeSend: function(){
                 $('.cssload-whirlpool').show();
                 $('.album-box').fadeTo(0,0.1);
             },
            success: function(data) {
            $("#result").html('');
             $('.disclaimerdata').html(data);
             $('.cssload-whirlpool').delay(2000).fadeOut();
             $('.album-box').delay(2000).fadeTo(0, 1);
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
            contentType: false,
            beforeSend: function(){
                 $('.cssload-whirlpool').show();
                 $('.album-box').fadeTo(0,0.1);
             }
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
                 $('.cssload-whirlpool').delay(2000).fadeOut();
                 $('.album-box').delay(2000).fadeTo(0, 1);
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
                beforeSend: function(){
                     $('.cssload-whirlpool1').show();
                     $('.disclaimerform').fadeTo(0,0.1);
                 },
                success: function(data) {
                 $('.disclaimerform').html(data);
                 $('.cssload-whirlpool1').delay(2000).fadeOut();
                 $('.disclaimerform').delay(2000).fadeTo(0, 1);
                 // html Editor
                 CKEDITOR.replace('editor1');
                 
                }
            });
    });