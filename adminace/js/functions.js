    $(function () {
        
        //delete confirm popup
        $('.delete').click(function(){
        var id= $(this).attr('id');
        var href= $(this).attr('data-href');
        $('.del-confirm').attr('href',href+id);
        });
        //delete confirm popup
        
        //disable Add Images button
        if($('#filter').val()>0){
                $("#add-imgs").prop('disabled', false);
            }else{
                 $("#add-imgs").prop('disabled', true);
            }
        
         $("#filter").bind('change', function(){
            if($('#filter').val()>0){
                $("#add-imgs").prop('disabled', false);
            }else{
                 $("#add-imgs").prop('disabled', true);
            }
        }); 
        //disable Add Images button
        
        equalheight(".title-height",".btn-height");
        
        //get all albums 
        $.ajax({
                url: "views/allalbumsajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                $("#result").html('');
                 $('.albumdata').html(data);
                }
            });
        //get all albums
        
        //get all albums 
        $.ajax({
                url: "views/allvideoajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                $("#result").html('');
                 $('.videodata').html(data);
                }
            });
        //get all albums
        
        var full_url = document.URL; // Get current url
        var url_array = full_url.split('#') // Split the string into an array with / as separator
        var last_segment = url_array[url_array.length-1];  // Get the last part of the array (-1)
        if( last_segment>0){
            $('.select2').val(last_segment).change();
        }
        filter('#filter');
        
    });

    //disable submit function until input is empty
    $(window).load(function(){
        disablesubmit();
    });
    
    // edit video function in same field 
    function edit(id,href){
        var id1= id;
        var href1=href;
        $.ajax({
            url: href1,
            type: "GET",
            data: {edit : id1},
            success: function(data) {
             $('.videodata').html(data);
             disablesubmit();
            }
        });
    }
    
    function cancle(href){
        var href1=href;
        //get all albums 
        $.ajax({
                url: href,
                type: "POST",
                data: 'data',
                success: function(data) {
                $("#result").html('');
                 $('.videodata').html(data);
                }
            });
        //get all albums
    }
    
    
    function  disablesubmit(){
    $('.field input').each(function() {
                if ($(this).val() == '') {
                    empty = true;
                }
            });
    
            if (empty) {
                    $('#submit').attr('disabled', true);
                } else {
                    $('#submit').attr('disabled', false);
                }
    }
    
    $('.field input').on('keyup keydown blur change',function() {

        var empty = false;
        $('.field input').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });

        if (empty) {
            $('#submit').attr('disabled', true);
        } else {
            $('#submit').attr('disabled', false);
        }
    });
     //disable submit function until input is empty
    
    // form submition for adding albums & images
    $("#albums_form").submit(function(event){
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
            $('#title').val('');
            $('#coverimg').val('');
            $('#coverinput').val('');
            $('.file-preview-thumbnails').html('');
            $('.file-drop-zone').append('<div class="file-drop-zone-title">Drag &amp; drop files here …</div>');
            $('.kv-fileinput-caption').html('');
            $('.file').val('');
            $('.image-preview').popover('hide');
            $('.image-preview-clear').hide();
            $.ajax({
                url: "views/allalbumsajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                 $('.albumdata').html(data);
                $(".image-preview-input-title").text("Browse");
                 disablesubmit();
                }
            });
            $.ajax({
                url: "views/imagesajax.php",
                type: "POST",
                data: {select:"all"},
                success: function(data) {
                 $('.imagesdata').html(data);
                }
            });
        
        });
    });
    // form submition for adding albums & images
    
    //getting local datetime
    setInterval(localdate(), 1000);
    function localdate(){
        var date = new Date,
            day = date.getDate(),
            month = ("0" + (date.getMonth() + 1)).slice(-2),
            year = date.getFullYear(),
            hour = date.getHours(),
            minute = date.getMinutes(),
            seconds = date.getSeconds(),
            ampm = hour > 12 ? "PM" : "AM";
    
        hour = hour % 12;
        hour = hour ? hour : 12; // zero = 12
        
        minute = minute > 9 ? minute : "0" + minute;
        seconds = seconds > 9 ? seconds : "0" + seconds;
        hour = hour > 9 ? hour : "0" + hour;
        
        
        date = day + "-" + month + "-" + year + " " + hour + ":" + minute + ":" + seconds + " " + ampm;
        $('#localdate').val(date);
        }
    
    
    // form submition for adding Videos
    $("#video_form").submit(function(event){
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
            $('#title').val('');
            $('#url').val('');
            $.ajax({
                url: "views/allvideoajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                 $('.videodata').html(data);
                }
            });
        
        });
    });
    // form submition for adding Videos

    // place submit button and form at equal level in addalbum.php
    $(window).resize(function(){
        equalheight(".title-height",".btn-height");
    });
    function equalheight(a,b) {
        var h=$(a).height();
        if (screen.width >768) {
            styles = {
              'height' : h,
              'line-height': h+20+'px'
            };
            $(b).css(styles);
        }
    }
    // place submit button and form at equal level in addalbum.php
    
    //Image preview in table row field while album update
    $(document).on('click', '#close-preview', function(){ 
        $('.image-preview').popover('hide');
        // Hover befor close the preview
        $('.image-preview').hover(
            function () {
               $('.image-preview').popover('show');
            }, 
             function () {
               $('.image-preview').popover('hide');
            }
        );    
    });
    
    $(function() {
        // Create the close button
        var closebtn = $('<button/>', {
            type:"button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;',
        });
        closebtn.attr("class","close pull-right");
        // Set the popover default content
        $('.image-preview').popover({
            trigger:'manual',
            html:true,
            title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
            content: "There's no image",
            placement:'bottom'
        });
        // Clear event
        $('.image-preview-clear').click(function(){
            $('.image-preview').attr("data-content","").popover('hide');
            $('.image-preview-filename').val("");
            $('.image-preview-clear').hide();
            $('.image-preview-input input:file').val("");
            $(".image-preview-input-title").text("Browse"); 
        }); 
        // Create the preview image
        $(".image-preview-input input:file").change(function (){     
            var img = $('<img/>', {
                id: 'dynamic',
                width:250,
                height:200
            });      
            var file = this.files[0];
            var reader = new FileReader();
            // Set preview image into the popover data-content
            reader.onload = function (e) {
                $(".image-preview-input-title").text("Change");
                $(".image-preview-clear").show();
                $(".image-preview-filename").val(file.name);            
                img.attr('src', e.target.result);
                $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
            }        
            reader.readAsDataURL(file);
        });  
    });
    
    
    //Image preview in table row field while album update
    $('#filter').bind("change",function(){
        filter('#filter');
    });
    function filter(a){
        if($(a).val()>0){
            var id=$(a).val();
            $.ajax({
                url: "views/imagesajax.php",
                type: "POST",
                data: {id:id,select:"one"},
                success: function(data) {
                $("#result").html('');
                 $('.imagesdata').html(data);
                }
            });
        }else{
            $.ajax({
                url: "views/imagesajax.php",
                type: "POST",
                data: {select:"all"},
                success: function(data) {
                $("#result").html('');
                 $('.imagesdata').html(data);
                }
            });
        }
    }
    
     $("#add-imgs").click(function(){
         var link = $(this);
         if ($('.custom-dropbox').is(':visible')) {
             link.text('Add Images');                
        } else {
             link.text('close');                
        }        
          $(".custom-dropbox").slideToggle();
          $(".custom-submit").slideToggle();
     });
     
    //dragdrop image upload
    $("#input-fa").fileinput({
        browseOnZoneClick: true,
        allowedFileExtensions : ['jpg', 'png','gif','jpeg'],
        theme: "fa"
    });
    
    //select2 initilizing
    $(".select2").select2();
    
    

