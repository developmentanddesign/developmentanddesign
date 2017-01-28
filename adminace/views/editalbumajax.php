<?php
require_once('../config/config.php');
if(isset($_POST['edit'])){ 
    $id=$_POST['edit'];
    $p="select * from albums where id=$id";
    $run=mysqli_query($conn,$p);
    while($row=mysqli_fetch_array($run)){
        $title=$row['title'];
        $img=$row['image'];
        $mtitle=$row['mtitle'];
        $mdesc=$row['mdesc'];?>
        <div class="cssload-whirlpool1"></div>
           <div class="box box-info addform">
              <div class="box-header with-border">
                <h3 class="box-title">Update Album</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form id="update" action="ajax/albumajax.php" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                  <div id="result"><?php global $msg; echo $msg;?></div>
                  <div class="col-sm-6 no-padding">
  					<div Class="form-group col-sm-12">
  						<label for="title">Album Title</label>
  						<input type="hidden" name="id" value="<?php echo $id; ?>">
  						<input type="hidden" name="form" value="updatealbum">
  						<input type="hidden" name="date" value="" id="localdate">
  						<input type="hidden" name="imgold" value="<?php echo $img;?>" id="imgold">
  						<div class="field">
  						  <input type="text" name="title" id="title" value="<?php echo $title;?>" class="form-control" required>
  						</div>
  					</div>
  					<div Class="form-group col-sm-12">
  						<label for="desc">Album Cover</label>
  						<div class="input-group image-preview" data-content="<img src='../images/albumcover/<?php echo $img;?>'>">
                          <input id="coverinput" type="text" class="form-control image-preview-filename" disabled="disabled" title="Please Browse an Image"> <!-- don't give a name === doesn't send on POST/GET -->
                          <span class="input-group-btn">
                              <!-- image-preview-clear button -->
                              <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                  <span class="glyphicon glyphicon-remove"></span> Clear
                              </button>
                              <!-- image-preview-input -->
                              <div class="btn btn-default field image-preview-input">
                                  <span class="glyphicon glyphicon-folder-open"></span>
                                  <span class="image-preview-input-title">Browse</span>
                                  <input id="coverimg" type="file" accept="image/png, image/jpeg, image/gif" name="cover"/> <!-- rename it -->
                              </div>
                          </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 no-padding">
                    <div Class="form-group col-sm-12">
      					<label for="mtitle">Meta Title</label>
      					<div class="field">
      					  <input type="text" name="mtitle" id="mtitle" value="<?php echo $mtitle;?>" class="form-control" required>
      					</div>
    				</div>
				    <div Class="form-group col-sm-12">
  					  <label for="mdesc">Meta Description</label>
  					  <div class="field">
  					    <textarea name="mdesc" id="mdesc" value="<?php echo $mdesc;?>" class="form-control" required><?php echo $mdesc;?></textarea>
  					  </div>
				    </div>
				   </div>
				</div>
                  <div class="box-footer">
                    <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary">
                  </div>
                <!-- /.box-body -->
              </form>
          </div>
   
  <?php   }
?>       
<script>
    // form submition for adding about details
        $("#update").submit(function(event){
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
                     $('.cssload-whirlpool').show();
                     $('.album-box').fadeTo(0,0.1);
                     $('.cssload-whirlpool1').show();
                     $('.form-box').fadeTo(0,0.1);
                 }
            }).done(function(response){ //
                $("#result").html(response);
                $.ajax({
                    url: "views/allalbumsajax.php",
                    type: "POST",
                    data: 'data',
                    success: function(data) {
                     $('.albumdata').html(data);
                     $('.cssload-whirlpool').delay(2000).fadeOut();
                     $('.album-box').delay(2000).fadeTo(0, 1);
                    $('.cssload-whirlpool1').delay(2000).fadeOut();
                    $('.form-box').delay(2000).fadeTo(0, 1);
                    }
                });
                $.ajax({
                    url: "views/editalbumajax.php",
                    type: "POST",
                    data: 'data',
                    success: function(data) {
                     $('.form-box').html(data);
                    }
                });
            
            });
        });
    // form submition for adding about details
    
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
    
    
    //Image preview in table row field while album update
</script>
<?php }else{ ?>

        <div class="cssload-whirlpool1"></div>
            <div class="box box-info addform">
              <div class="box-header with-border">
                <h3 class="box-title">Add Albums</h3>
                <button class="btn btn-warning pull-right" id="add-album">Add Album</button>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form id="albums_form" action="ajax/albumajax.php" method="POST" enctype="multipart/form-data">
                <div class="box-body custom-form">
                  <div id="result"><?php global $msg; echo $msg;?></div>
                  <div class="col-sm-6 no-padding">
          					<div Class="form-group col-sm-12">
          						<label for="title">Album Title</label>
          						<input type="hidden" name="form" value="addalbum">
          						<input type="hidden" name="date" value="" id="localdate">
          						<div class="field">
          						  <input type="text" name="title" id="title" value="" class="form-control" required>
          						</div>
          					</div>
          					<div Class="form-group col-sm-12">
          						<label for="desc">Album Cover</label>
          						<div class="input-group image-preview">
                          <input id="coverinput" type="text" class="form-control image-preview-filename" disabled="disabled" title="Please Browse an Image"> <!-- don't give a name === doesn't send on POST/GET -->
                          <span class="input-group-btn">
                              <!-- image-preview-clear button -->
                              <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                  <span class="glyphicon glyphicon-remove"></span> Clear
                              </button>
                              <!-- image-preview-input -->
                              <div class="btn btn-default field image-preview-input">
                                  <span class="glyphicon glyphicon-folder-open"></span>
                                  <span class="image-preview-input-title">Browse</span>
                                  <input id="coverimg" type="file" accept="image/png, image/jpeg, image/gif" name="cover" required/> <!-- rename it -->
                              </div>
                          </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 no-padding">
                    <div Class="form-group col-sm-12">
          						<label for="mtitle">Meta Title</label>
          						<div class="field">
          						  <input type="text" name="mtitle" id="mtitle" class="form-control" required>
          						</div>
        					  </div>
        					  <div Class="form-group col-sm-12">
          						<label for="mdesc">Meta Description</label>
          						<div class="field">
          						  <textarea name="mdesc" id="mdesc" class="form-control" required></textarea>
          						</div>
        					  </div>
        					</div>
        					</div>
                  <div class="box-footer custom-form">
                    <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary">
                  </div>
                <!-- /.box-body -->
              </form>
            </div>
<script>
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
            contentType: false,
            beforeSend: function(){
                 $('.cssload-whirlpool').show();
                 $('.album-box').fadeTo(0,0.1);
             }
        }).done(function(response){ //
            $("#result").html(response);
            $('#title').val('');
            $('#coverimg').val('');
            $('#mtitle').val('');
            $('#mdesc').val('');
            $('#mdesc').val('');
            $('#coverinput').val('');
            $('.file').val('');
            $('.image-preview').popover('hide');
            $('.image-preview').attr('data-content','');
            $('.image-preview-clear').hide();
            $.ajax({
                url: "views/allalbumsajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                 $('.albumdata').html(data);
                 $('.cssload-whirlpool').delay(2000).fadeOut();
                 $('.album-box').delay(2000).fadeTo(0, 1);
                 $(".image-preview-input-title").text("Browse");
                 disablesubmit();
                }
            });
        
        });
    });
    // form submition for adding albums & images
    
    $('.edit-btn').click(function(){
        var id= $(this).attr('id');
        $.ajax({
                url: "views/editalbumajax.php",
                type: "POST",
                data: {edit:id},
                beforeSend: function(){
                     $('.cssload-whirlpool1').show();
                     $('.form-box').fadeTo(0,0.1);
                 },
                success: function(data) {
                 $('.form-box').html(data);
                 $('.cssload-whirlpool1').delay(2000).fadeOut();
                 $('.form-box').delay(2000).fadeTo(0, 1);
                 
                }
            });
    });
    $("#add-album").click(function(){
         var link = $(this);
         if ($('.custom-form').is(':visible')) {
             link.text('Add Album');                
        } else {
             link.text('close');                
        }        
          $(".custom-form").slideToggle();
     });
     
      //Image Preview Code starts
    $(document).on('click', '#close-preview-new', function(){ 
        $('.image-preview-new').popover('hide');
        // Hover befor close the preview
        $('.image-preview').hover(
            function () {
               $('.image-preview-new').popover('show');
            }, 
             function () {
               $('.image-preview-new').popover('hide');
            }
        );    
    });
        
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
    
    
    //Image preview in table row field while album update
</script>
<?php }?>