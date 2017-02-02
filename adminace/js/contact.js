    // getting all contacts entries

    $(window).load(function(){             
        $.ajax({
            url: "views/allcontactajax.php",
            type: "POST",
            data: 'data',
            beforeSend: function(){
                $('.cssload-whirlpool').show();
                $('.alldiv').fadeTo(0,0.1);
             },
            success: function(data) {
             $('.contactdata').html(data);
             $('.cssload-whirlpool').delay(2000).fadeOut();
             $('.alldiv').delay(2000).fadeTo(0, 1);
            }
        });
    });
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
            contentType: false,
            beforeSend: function(){
                 $('.cssload-whirlpool4').show();
                 $('.contactform').fadeTo(0,0.1);
                 $('.cssload-whirlpool2').show();
                 $('.album-box').fadeTo(0,0.1);
             },
        }).done(function(response){ //
            $("#result").html(response);
            $.ajax({
                url: "views/allcontactajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                 $('.contactdata').html(data);
                 $('.cssload-whirlpool4').delay(2000).fadeOut();
                 $('.contactform').delay(2000).fadeTo(0, 1);
                 $('.cssload-whirlpool2').delay(2000).fadeOut();
                 $('.album-box').delay(2000).fadeTo(0, 1);
                }
            });
            $.ajax({
                url: "views/editcontactajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                 $('.contactform').html(data);
                }
            });
        
        });
    });
    // form submition for adding contact
    
    $('#edit-contact').click(function(){
        $.ajax({
                url: "views/editcontactajax.php",
                type: "POST",
                data: {edit:edit},
                beforeSend: function(){
                     $('.cssload-whirlpool4').show();
                     $('.contactform').fadeTo(0,0.1);
                 },
                success: function(data) {
                 $('.contactform').html(data);
                 $('.cssload-whirlpool4').delay(2000).fadeOut();
                 $('.contactform').delay(2000).fadeTo(0, 1);
                }
            });
    });