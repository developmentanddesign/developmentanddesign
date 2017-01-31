<?php
require_once('../config/config.php');
if(isset($_POST['edit'])){
    $id=$_POST['edit'];
    $p="select * from articles where id=$id";
    $run=mysqli_query($conn,$p);
    while($row=mysqli_fetch_array($run)){
        $title=$row['title'];
        $content=$row['content'];
        $mtitle=$row['mtitle'];
        $mdesc=$row['mdesc'];
    }
?>
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Articles</h3>
                <button class="btn btn-warning pull-right" onclick="cancle('views/editarticleajax.php','.articlesform')">Cancle</button>
                <div id="result"><?php global $msg; echo $msg;?></div>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form id="update" action="ajax/articlesajax.php" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                      
                    <div class="col-sm-12">
      					<div Class="form-group field">
      						<label for="title">Title</label>
      						<input type="text" name="title" id="title" class="form-control" value="<?php echo $title;?>" title="Article Title">
      						<input type="hidden" name="form" value="update" class="form-control" required>
    						<input type="hidden" name="date" value="" id="localdate">
      					</div>
      					<div Class="form-group field">
      						<label>Article Content</label>
  			                <textarea name="content" class="t" rows="10" cols="80" title="Article Content"><?php echo $content;?></textarea>
      					</div>
      					<div Class="form-group field">
      						<label for="mtitle">Meta Title</label>
      						<input type="text" name="mtitle" id="mtitle" class="form-control" value="<?php echo $mtitle;?>" title="Meta Title" required>
      					</div>
      					<div Class="form-group field">
      						<label for="mdesc">Meta Description</label>
      						<textarea name="mdesc" rows="5" cols="25" class="form-control noresize" cols="20" rows="5" title="Meta Description" required><?php echo $mdesc;?></textarea>
      					</div>
      				</div>
          			
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary" id="submit">
              </div>
                  <!-- /.box-footer -->
            </form>
          </div>
<script>
    // form submition for adding about details
        $("#update").submit(function(event){
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
                     $('.cssload-whirlpool1').show();
                     $('.articlesform').fadeTo(0,0.1);
                 }
            }).done(function(response){ //
                $("#result").html(response);
                $('#mtitle').val('');
                $('#title').val('');
                $('#mdesc').val('');
                $.ajax({
                    url: "views/allarticlesajax.php",
                    type: "POST",
                    data: 'data',
                    success: function(data) {
                     $('.articlesdata').html(data);
                     $('.cssload-whirlpool').delay(2000).fadeOut();
                     $('.album-box').delay(2000).fadeTo(0, 1);
                    $('.cssload-whirlpool1').delay(2000).fadeOut();
                    $('.articlesform').delay(2000).fadeTo(0, 1);
                    }
                });
                $.ajax({
                    url: "views/editarticleajax.php",
                    type: "POST",
                    data: 'data',
                    success: function(data) {
                     $('.articlesform').html(data);
                    }
                });
            
            });
        });
    // form submition for adding about details
    
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
</script>
<?php }else{ ?>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Articles</h3>
            <div id="result"><?php global $msg; echo $msg;?></div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form id="articles_form" action="ajax/articlesajax.php" method="POST" enctype="multipart/form-data">
            <div class="box-body">
                  
              <div class="col-sm-12">
  				<div Class="form-group field">
  					<label for="title">Title</label>
  					<input type="text" name="title" id="title" class="form-control" title="Article Title">
  					<input type="hidden" name="form" value="add" class="form-control" required>
					<input type="hidden" name="date" value="" id="localdate">
  				</div>
  				<div Class="form-group field">
  					<label>Article Content</label>
  		      <textarea name="content" class="t" rows="10" cols="80" title="Article Content"></textarea>
  				</div>
  				<div Class="form-group field">
  					<label for="mtitle">Meta Title</label>
  					<input type="text" name="mtitle" id="mtitle" class="form-control" title="Meta Title" required>
  				</div>
  				<div Class="form-group field">
  					<label for="mdesc">Meta Description</label>
  					<textarea name="mdesc" rows="5" cols="25" class="form-control noresize" cols="20" rows="5" title="Meta Description" required></textarea>
  				</div>
  			</div>
      			
          </div>
      <!-- /.box-body -->
          <div class="box-footer">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary" id="submit">
          </div>
          <!-- /.box-footer -->
          </form>
      </div>
<script>
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
    
</script>
<?php }?>