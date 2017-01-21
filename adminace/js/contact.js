    
    
    //select2 initilizing
    $(".select3").select2();
   
     //select2 initilizing
    $(".select4").select2();
    
     //select2 initilizing
    $(".select5").select2();
  
    // form submition for adding contact
    $("#contact_form").submit(function(event){
        event.preventDefault(); //prevent default action
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
            $.ajax({
                url: "views/allcontactajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                 $('.contactdata').html(data);
                }
            });
        
        });
    });
    // form submition for adding contact