<?php require_once('../config/config.php');?>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
      <th>Sr.</th>
      <th>Title</th>
      <th>Cover</th>
      <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
   <?php 
        //insert query//
        $r="select * from albums order by 1 desc";
        $sr=1;
        $result=mysqli_query($conn,$r) or die (mysql_error());
        while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
            $id=$row['id'];
        	$title=$row['title'];
        	$image_name=$row['cover'];
        ?>
        <?php if($_GET['edit']!="" && $_GET['edit']==$id){?>
        <form id="update_form" action="../ajax/albumajax.php" method="post" enctype="multipart/formdata">
        <?php } ?>
        <tr>
          <td><?php echo $sr;?></td>
          <td> <?php if($_GET['edit'] )
                {   if($_GET['edit']!="" && $_GET['edit']==$id) { ?>
                        <div Class='form-group col-sm-12 col-md-12 col-xs-12 title-height'>
    						<input type='text' name='title' id='title' value='<?php echo $title;?>' class='form-control'  required>
    					</div> 
        	      <?php } else {?>
                  <?php echo ucwords($title);?>
          <?php } }else{ echo ucwords($title); } ?>
          </td>
          <td>
          <?php if($_GET['edit'])
                {  if($_GET['edit']!="" && $_GET['edit']==$id) { ?>
                    <div class="input-group image-preview-new col-sm-12">
						<input type="text" class="form-control image-preview-filename-new" disabled="disabled">
						<input type="hidden" name="form" value="updatealbum">
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="hidden" name="img" value="<?php echo $image_name;?>">
						<span class="input-group-btn">
							<!-- image-preview-clear button -->
							<button type="button" class="btn btn-default image-preview-clear-new" style="display:none;">
								<span class="glyphicon glyphicon-remove"></span> Clear
							</button>
							<!-- image-preview-input -->
							<div class="btn btn-default image-preview-input-new">
								<span class="glyphicon glyphicon-folder-open"></span>
								<span class="image-preview-input-title-new">Browse</span>
								<input type="file" accept="image/png, image/jpeg, image/gif" name="cover"/> <!-- rename it -->
							</div>
						</span>
					</div>
        	      <?php  }else {?>
                  <img src="../images/albumcover/<?php echo $image_name;?>" height="50px" width="50px" />
          <?php }}else{?>
              <img src="../images/albumcover/<?php echo $image_name;?>" height="50px" width="50px" />
          <?php } ?>
          </td>
          <td class="text-center">
      		<button 
      		<?php if($_GET['edit']!="" && $_GET['edit']==$id)
      		        { 
      		            echo 'type="submit" name="update"';
      		        }?> 
      		        id="<?php echo $id; ?>" 
      		        data-href="addalbum.php" 
      		        title="<?php if($_GET['edit']=="" || $_GET['edit']!=$id)
      		        { echo "Edit";} 
      		        else{ echo "Update"; }?>"
      		        class="btn btn-success 
      		        <?php if($_GET['edit']=="" || $_GET['edit']!=$id)
      		        { echo "edit-btn";} else{ echo "update-btn"; }?>">
      		        <?php if($_GET['edit']=="" 
      		                || !isset($_GET['edit']) 
      		                || $_GET['edit']!=$id )
      		                { echo '<i class="fa fa-pencil-square-o"></i>'; }
      		              elseif($_GET['edit']!="" && $_GET['edit']==$id)
      		                { echo '<i class="fa fa-check"></i>'; }?>
      		  </button>
      		<button title="Delete" id="<?php echo $id; ?>" class="btn btn-danger delete" data-href="addalbum.php?del=" data-toggle="modal" data-target="#myModal"><i class="fa fa-times"></i></button>
      		</td>
        </tr>
        <?php if($_GET['edit']!="" && $_GET['edit']==$id){?></form><?php } ?>
    <?php $sr++;}?>

    </tbody>
</table>
<script>

// initialize datatable on adalbums page
   $('#example').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    
    //delete album function
    $('.delete').click(function(){
    var id= $(this).attr('id');
    var href= $(this).attr('data-href');
    $('.del-confirm').attr('href',href+id);
    });
    
    // edit album function in same field 
    $('.edit-btn').click(function(){
        var id= $(this).attr('id');
        $.ajax({
            url: "views/allalbumsajax.php",
            type: "GET",
            data: {edit : id},
            success: function(data) {
             $('.albumdata').html(data);
            }
        });
    });
    
    //your jQuery ajax code
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
        
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview-new',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    
    // Set the popover default content
    $('.image-preview-new').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    
    // Clear event
    $('.image-preview-clear-new').click(function(){
        $('.image-preview-new').attr("data-content","").popover('hide');
        $('.image-preview-filename-new').val("");
        $('.image-preview-clear-new').hide();
        $('.image-preview-input-new input:file').val("");
        $(".image-preview-input-title-new").text("Browse"); 
    }); 
    
    // Create the preview image
    $(".image-preview-input-new input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        
    // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title-new").text("Change");
            $(".image-preview-clear-new").show();
            $(".image-preview-filename-new").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview-new").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  


</script>