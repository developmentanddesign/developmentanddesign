$.ajax({
        url: "views/allarticlesajax.php",
        type: "POST",
        data: 'data',
        success: function(data) {
         $('.articlesdata').html(data);
        $('.cssload-whirlpool').delay(2000).fadeOut();
        $('.album-box').delay(2000).fadeTo(0, 1);
        }
    });
            
// tinymce plugin
tinymce.init({
        selector: ".t",
        theme: 'modern',
        mode : "textareas",
		plugins: [
					"advlist save emoticons autolink lists link image charmap print preview anchor",
					"searchreplace visualblocks code fullscreen tabfocus wordcount spellchecker colorpicker",
					"insertdatetime media table contextmenu textpattern paste imagetools colorpicker directionality hr textcolor toc legacyoutput"
				],
		toolbar: "leaui_formula, | styleselect, fontselect, fontsizeselect, | undo, redo, | alignleft, aligncenter, alignright, alignjustify, | bullist, numlist, indent, outdent, | print, preview, media, fullpage, | forecolor, backcolor, emoticons, bold, italic, underline, strikethrough, link, | image", file_browser_callback: RoxyFileBrowser,
        force_br_newlines : true,
        force_p_newlines : false,
        forced_root_block : '',
    
});
        function RoxyFileBrowser(field_name, url, type, win) {
          var roxyFileman = 'plugins/tinymce/plugins/RoxyFileman/fileman/index.html';
          if (roxyFileman.indexOf("?") < 0) {     
            roxyFileman += "?type=" + type;   
          }
          else {
            roxyFileman += "&type=" + type;
          }
          roxyFileman += '&input=' + field_name + '&value=' + win.document.getElementById(field_name).value;
          if(tinyMCE.activeEditor.settings.language){
            roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
          }
          tinyMCE.activeEditor.windowManager.open({
             file: roxyFileman,
             title: 'Fileman Manager',
             width: 850, 
             height: 650,
             resizable: "yes",
             plugins: "media",
             inline: "yes",
             close_previous: "no"  
          }, {     window: win,     input: field_name    });
          return false; 
}
// tinymce plugin

  setInterval(localdate(), 1000);

// form submition for adding about details
    $("#articles_form").submit(function(event){
        event.preventDefault(); //prevent default action  
        tinyMCE.triggerSave();
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
            $('#mdesc').val('');
            $('#title').val('');
            $('#mtitle').val('');
            $('.t').val('');
            $.ajax({
                url: "views/allarticlesajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                 $('.articlesdata').html(data);
                $('.cssload-whirlpool').delay(2000).fadeOut();
                $('.album-box').delay(2000).fadeTo(0, 1);
                }
            });
        
        });
    });
    // form submition for adding about details
    function editarticle(id,href){
        $.ajax({
                url: href,
                type: "POST",
                data: {edit:id},
                beforeSend: function(){
                     $('.cssload-whirlpool1').show();
                     $('.articlesform').fadeTo(0,0.1);
                 },
                success: function(data) {
                 $('.articlesform').html(data);
                 $('.cssload-whirlpool1').delay(2000).fadeOut();
                 $('.articlesform').delay(2000).fadeTo(0, 1);
                 // html Editor
                }
            });
    }