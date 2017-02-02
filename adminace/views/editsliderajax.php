<?php
require_once('../config/config.php');
if(isset($_POST['edit'])){ 
    $id=$_POST['edit'];
    $p="select * from slider where id=$id";
    $run=mysqli_query($conn,$p);
    while($row=mysqli_fetch_array($run)){
        $image_name=$row['image_name'];
        $image_alt=$row['image_alt'];
        $s_date=$row['s_date'];
        $e_date=$row['e_date'];
        $image_title=$row['image_title'];
        $range=$row['range'];
        $btn_text=$row['btn_text'];
        $timer=$row['timer'];
        $image_caption=$row['image_caption'];
        $status=$row['status'];
        $destination_url=$row['destination_url'];
    }
?>
        <div>
          <div class="box-header with-border">
            <button class="btn btn-warning pull-right" onclick="cancle('views/editsliderajax.php','.slidersform')">Cancle</button>
          </div>
          <form id="update" action="ajax/sliderajax.php" method="POST" enctype="multipart/form-data">
            <div class="box-body custom-body">
           <div class="col-sm-6">
  		      <div Class="form-group">
                <label for="desc">Slide Image *</label>
                <div class="input-group image-preview">
                  <input id="coverinput" type="text" class="form-control image-preview-filename" disabled="disabled" title="Please Browse an Image" value="<?php echo $image_name;?>"> <!-- don't give a name === doesn't send on POST/GET -->
                  <span class="input-group-btn">
                      <!-- image-preview-clear button -->
                      <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                          <span class="glyphicon glyphicon-remove"></span> Clear
                      </button>
                      <!-- image-preview-input -->
                      <div class="btn btn-default field image-preview-input">
                          <span class="glyphicon glyphicon-folder-open"></span>
                          <span class="image-preview-input-title">Browse</span>
                          <input id="image_name" type="file" accept="image/*" name="image_name"/> <!-- rename it -->
			              <input type="hidden" name="form" value="update" class="form-control">
                      </div>
                  </span>
                </div>
              </div>
				<div Class="form-group">
					<label for="image_alt">Image ALT *</label>
					<input type="text" name="image_alt" id="image_alt" value="<?php echo $image_alt;?>" class="form-control" required>
				</div>
				<div Class="form-group">
					<label for="image_title">Image Title *</label>
					<input type="text" name="image_title" id="image_title" value="<?php echo $image_title;?>" class="form-control" required>
				</div>
				<div Class="form-group">
					<label for="image_cap">Caption</label>
					<input type="text" name="image_caption" id="image_cap" value="<?php echo $image_caption;?>" class="form-control">
					<i><small>Optional</small></i>
				</div>
         </div>
		     <div class="col-sm-6">
				<div Class="form-group">
					<label for="btn_text">Button Text</label>
					<input type="text" name="btn_text" id="btn_text" value="<?php echo $btn_text;?>" placeholder="Optional" class="form-control">
				</div>
				<div Class="form-group">
				  <label>Date range:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" value="<?php echo $range;?>" name="range" id="range">
                  </div>
				</div>
				<div Class="form-group col-md-6 no-padding">
					<label for="status" class="col-xs-12 no-padding">Status: *</label>
					<div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-sm active statusbtn1 <?php echo ($status==1)? 'btn-success' :'btn-default';?>">
                          <input type="radio" name="status" id="status" value="1" autocomplete="off" <?php echo ($status==1)? 'checked' :'';?>> Active
                        </label>
                        <label class="btn btn-sm statusbtn2 <?php echo ($status==0)? 'btn-danger' :'btn-default';?>">
                          <input type="radio" name="status" id="status" value="0" autocomplete="off" <?php echo ($status==0)? 'checked' :'';?>> Inactive
                        </label>
                     </div>
				</div>
				<div Class="form-group col-md-6 no-padding">
					<label for="status" class="col-xs-12 no-padding">Timer: *</label>
					<div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-sm timerbtn1 <?php echo ($timer==1)? 'btn-success' :'btn-default';?>">
                          <input type="radio" name="timer" id="status" value="1" autocomplete="off" <?php echo ($timer==1)? 'checked' :'';?>> Active
                        </label>
                        <label class="btn btn-sm timerbtn2 <?php echo ($timer==0)? 'btn-danger' :'btn-default';?>">
                          <input type="radio" name="timer" id="status" value="0" autocomplete="off" <?php echo ($timer==0)? 'checked' :'';?>> Inactive
                        </label>
                    </div>
				</div>
				<div Class="form-group">
					<label for="destination_url">Destination URL</label>
					<input type="text" name="destination_url" id="destination_url" placeholder="Optional" value="<?php echo $destination_url;?>" class="form-control">
				</div>
            </div>
            </div>
            <div class="box-footer">
              <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </div>
                  <!-- /.box-footer -->
          </form>
        </div>
<script>
$('#range').daterangepicker(
        {
           ranges: {
            'Today': [moment(), moment()],
            'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
            'Next 7 Days': [moment(), moment().add(6, 'days')],
            'Next 30 Days': [moment(), moment().add(29, 'days')],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#range span').html(end.format('MMMM D, YYYY') + ' - ' + start.format('MMMM D, YYYY'));
        }
    );
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
                 }
            }).done(function(response){ //
                $("#result").html(response);
                $('.cssload-whirlpool').delay(2000).fadeOut();
                $('.album-box').delay(2000).fadeTo(0, 1);
                $('#collapseOne').removeClass('in');
                $('#collapseOne').attr('aria-expanded','false');
                $('#collapseThree').addClass('in');
                $('#collapseThree').attr('aria-expanded','true');
                $("[aria-controls=collapseOne]").addClass('collapsed');
                $("[aria-controls=collapseOne]").attr('aria-expanded','false');
                $("[aria-controls=collapseThree]").attr('aria-expanded','true');
                $('#collapseThree').attr('style','');
                $("[aria-controls=collapseThree]").removeClass('collapsed');
                $.ajax({
                    url: "views/allslidesajax.php",
                    type: "POST",
                    data: 'data',
                    success: function(data) {
                     $('.sliderdata').html(data);
                     $('.cssload-whirlpool').delay(2000).fadeOut();
                     $('.album-box').delay(2000).fadeTo(0, 1);
                    $('.sliderdata').delay(2000).fadeTo(0, 1);
                    }
                });
                $.ajax({
                    url: "views/editsliderajax.php",
                    type: "POST",
                    data: 'data',
                    success: function(data) {
                     $('.sliderform').html(data);
                    }
                });
            
            });
        });
    // form submition for adding about details
        
// slide status   
$('.statusbtn1').click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-success');
    $('.statusbtn2').removeClass('btn-danger');
    $('.statusbtn2').addClass('btn-default');
});
$('.statusbtn2').click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-danger');
    $('.statusbtn1').removeClass('btn-success');
    $('.statusbtn1').addClass('btn-default');
});
// slide status

// slide timer
$('.timerbtn1').click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-success');
    $('.timerbtn2').removeClass('btn-danger');
    $('.timerbtn2').addClass('btn-default');
});
$('.timerbtn2').click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-danger');
    $('.timerbtn1').removeClass('btn-success');
    $('.timerbtn1').addClass('btn-default');
});
// slide timer

function editslider(id,href){
    $('#collapseThree').removeClass('in');
    $('#collapseThree').attr('aria-expanded','false');
    $('#collapseOne').addClass('in');
    $('#collapseOne').attr('aria-expanded','true');
    $("[aria-controls=collapseThree]").addClass('collapsed');
    $("[aria-controls=collapseThree]").attr('aria-expanded','false');
    $("[aria-controls=collapseOne]").attr('aria-expanded','true');
    $('#collapseOne').attr('style','');
    $("[aria-controls=collapseOne]").removeClass('collapsed');
        $.ajax({
                url: href,
                type: "POST",
                data: {edit:id},
                beforeSend: function(){
                     $('.cssload-whirlpool1').show();
                     $('.slidersform').fadeTo(0,0.1);
                 },
                success: function(data) {
                 $('.slidersform').html(data);
                 $('.cssload-whirlpool1').delay(2000).fadeOut();
                 $('.slidersform').delay(2000).fadeTo(0, 1);
                 $("[aria-controls=collapseOne]").html('<div class="panel-heading" role="tab" id="headingOne"><h4 class="panel-title">Update Slide</h4></div>');
                 // html Editor
                }
            });
    }
    
    //cancle update on click
    function cancle(href,resultfield){
        //get all albums 
         $('.cssload-whirlpool').show();
         $('.album-box').fadeTo(0,0.1);
         $('.cssload-whirlpool1').show();
         $('.slidersform').fadeTo(0,0.1);
        $.ajax({
                url: href,
                type: "POST",
                data: 'data',
                success: function(data) {
                $("#result").html('');
                 $(resultfield).html(data);
                 $('.cssload-whirlpool1').delay(2000).fadeOut();
                 $('.slidersform').delay(2000).fadeTo(0, 1);
                 $('.cssload-whirlpool').delay(2000).fadeOut();
                 $('.album-box').delay(2000).fadeTo(0, 1);
                 $("[aria-controls=collapseOne]").html('<div class="panel-heading" role="tab" id="headingOne"><h4 class="panel-title">Add Slide</h4></div>');
                }
            });
    }
    
    //cancle update on click
    
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
        <div>
          <form id="sliderform" action="ajax/sliderajax.php" method="POST" enctype="multipart/form-data">
            <div class="box-body custom-body">
           <div class="col-sm-6">
  			<div Class="form-group">
                <label for="desc">Slide Image *</label>
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
                          <input id="image_name" type="file" accept="image/*" name="image_name" required/> <!-- rename it -->
						              <input type="hidden" name="form" value="add" class="form-control">
                      </div>
                  </span>
                </div>
            </div>
			<div Class="form-group">
				<label for="image_alt">Image ALT *</label>
				<input type="text" name="image_alt" id="image_alt" value="" class="form-control" required>
			</div>
			<div Class="form-group">
				<label for="image_title">Image Title *</label>
				<input type="text" name="image_title" id="image_title" value="" class="form-control" required>
			</div>
			<div Class="form-group">
				<label for="image_cap">Caption</label>
				<input type="text" name="image_caption" id="image_cap" value="" class="form-control">
				<i><small>Optional</small></i>
			</div>
         </div>
	     <div class="col-sm-6">
			<div Class="form-group">
				<label for="btn_text">Button Text</label>
				<input type="text" name="btn_text" id="btn_text" value="" placeholder="Optional" class="form-control">
			</div>
			<div Class="form-group">
			  <label>Date range:</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" name="range" id="range">
              </div>
			</div>
			<div Class="form-group col-md-6 no-padding">
				<label for="status" class="col-xs-12 no-padding">Status: *</label>
				<div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-sm btn-success active statusbtn1">
                      <input type="radio" name="status" id="status" value="1" autocomplete="off" checked> Active
                    </label>
                    <label class="btn btn-sm statusbtn2 btn-default">
                      <input type="radio" name="status" id="status" value="0" autocomplete="off"> Inactive
                    </label>
                </div>
			</div>
			<div Class="form-group col-md-6 no-padding">
				<label for="status" class="col-xs-12 no-padding">Timer: *</label>
				<div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-sm btn-success active timerbtn1">
                      <input type="radio" name="timer" id="status" value="1" autocomplete="off" checked> Active
                    </label>
                    <label class="btn btn-sm timerbtn2 btn-default">
                      <input type="radio" name="timer" id="status" value="0" autocomplete="off"> Inactive
                    </label>
                </div>
			</div>
			<div Class="form-group">
				<label for="destination_url">Destination URL</label>
				<input type="text" name="destination_url" id="destination_url" placeholder="Optional" value="" class="form-control">
			</div>
          </div>
            </div>
            <div class="box-footer">
              <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </div>
                  <!-- /.box-footer -->
          </form>
        </div>
<script>
$('#range').daterangepicker(
        {
           ranges: {
            'Today': [moment(), moment()],
            'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
            'Next 7 Days': [moment(), moment().add(6, 'days')],
            'Next 30 Days': [moment(), moment().add(29, 'days')],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#range span').html(end.format('MMMM D, YYYY') + ' - ' + start.format('MMMM D, YYYY'));
        }
    );
    
// form submition for adding about details
$("#sliderform").submit(function(event){
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
    }).done(function(response){ 
        $("#result").html(response);
        $.ajax({
            url: "views/allslidesajax.php",
            type: "POST",
            data: 'data',
            success: function(data) {
            $('.sliderdata').html(data);
            $('.cssload-whirlpool').delay(2000).fadeOut();
            $('.album-box').delay(2000).fadeTo(0, 1);
            $('#collapseOne').removeClass('in');
            $('#collapseOne').attr('aria-expanded','false');
            $('#collapseThree').addClass('in');
            $('#collapseThree').attr('aria-expanded','true');
            $("[aria-controls=collapseOne]").addClass('collapsed');
            $("[aria-controls=collapseOne]").attr('aria-expanded','false');
            $("[aria-controls=collapseThree]").attr('aria-expanded','true');
            $('#collapseThree').attr('style','');
            $("[aria-controls=collapseThree]").removeClass('collapsed');
            $.ajax({
                url: 'views/editsliderajax.php',
                type: "POST",
                data: 'data',
                success: function(data) {
                 $('.slidersform').html(data);
                 }
            });
            }
        });
    
    });
});
// form submition for adding about details

    
// slide status   
$('.statusbtn1').click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-success');
    $('.statusbtn2').removeClass('btn-danger');
    $('.statusbtn2').addClass('btn-default');
});
$('.statusbtn2').click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-danger');
    $('.statusbtn1').removeClass('btn-success');
    $('.statusbtn1').addClass('btn-default');
});
// slide status

// slide timer
$('.timerbtn1').click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-success');
    $('.timerbtn2').removeClass('btn-danger');
    $('.timerbtn2').addClass('btn-default');
});
$('.timerbtn2').click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-danger');
    $('.timerbtn1').removeClass('btn-success');
    $('.timerbtn1').addClass('btn-default');
});
// slide timer

function editslider(id,href){
        $('#collapseThree').removeClass('in');
        $('#collapseThree').attr('aria-expanded','false');
        $('#collapseOne').addClass('in');
        $('#collapseOne').attr('aria-expanded','true');
        $("[aria-controls=collapseThree]").addClass('collapsed');
        $("[aria-controls=collapseThree]").attr('aria-expanded','false');
        $("[aria-controls=collapseOne]").attr('aria-expanded','true');
        $('#collapseOne').attr('style','');
        $("[aria-controls=collapseOne]").removeClass('collapsed');
        $.ajax({
                url: href,
                type: "POST",
                data: {edit:id},
                beforeSend: function(){
                     $('.cssload-whirlpool1').show();
                     $('.slidersform').fadeTo(0,0.1);
                 },
                success: function(data) {
                 $('.slidersform').html(data);
                 $('.cssload-whirlpool1').delay(2000).fadeOut();
                 $('.slidersform').delay(2000).fadeTo(0, 1);
                 $("[aria-controls=collapseOne]").html('<div class="panel-heading" role="tab" id="headingOne"><h4 class="panel-title">update Slide</h4></div>');
                 // html Editor
                }
            });
    }
    
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