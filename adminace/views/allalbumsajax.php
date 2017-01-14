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
        <form action="#" method="post" enctype="multipart/formdata">
        <tr>
          <td><?php echo $sr;?></td>
          <td> <?php if($_GET['edit'] )
                {   if($_GET['edit']!="" && $_GET['edit']==$id) { ?>
                        <div Class='form-group col-sm-4 col-md-5 col-xs-12 title-height'>
    						<input type='text' name='title' id='title' value='' class='form-control'  required>
    					</div> 
        	      <?php } else {?>
                  <?php echo ucwords($title);?>
          <?php } }else{ echo ucwords($title); } ?>
          </td>
          <td>
          <?php if($_GET['edit'])
                {  if($_GET['edit']!="" && $_GET['edit']==$id) { ?>
                    <div class="input-group image-preview">
                        <input id="coverinput" type="text" class="form-control image-preview-filename" disabled="disabled" title="Please Browse an Image"> <!-- don't give a name === doesn't send on POST/GET -->
                        <span class="input-group-btn">
                            <!-- image-preview-clear button -->
                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                <span class="glyphicon glyphicon-remove"></span> Clear
                            </button>
                            <!-- image-preview-input -->
                            <div class="btn btn-default image-preview-input">
                                <span class="glyphicon glyphicon-folder-open"></span>
                                <span class="image-preview-input-title">Browse</span>
                                <input id="coverimg" type="file" accept="image/png, image/jpeg, image/gif" name="cover" required/> <!-- rename it -->
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
      		<button id="<?php echo $id; ?>" data-href="addalbum.php" title="Edit" class="btn btn-success edit-btn"><i class="fa fa-pencil-square-o"></i></button>
      		<button title="Delete" id="<?php echo $id; ?>" class="btn btn-danger delete" data-href="addalbum.php?del=" data-toggle="modal" data-target="#myModal"><i class="fa fa-times"></i></button>
      		</td>
        </tr>
        </form>
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
        RefreshPageUrl('Add Album', 'addalbum.php?edit='+id);
        $(this).html('Update');
        $.ajax({
            url: "views/allalbumsajax.php",
            type: "GET",
            data: {edit : id},
            success: function(data) {
             $('.albumdata').html(data);
            }
        });
    });
    
    // passing edit id in url without page refresh
    function RefreshPageUrl(title, url) {
        if (history.pushState) {
        history.pushState(null, title, url);
        } else {
        alert("Your Browser will not Support HTML5");
        }
    }
</script>
</script>