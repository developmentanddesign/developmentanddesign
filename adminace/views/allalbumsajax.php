<?php require_once('../config/config.php');?>
<table id="example2" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
      <th>Sr.</th>
      <th>Title</th>
      <th>Cover</th>
      <th>Created</th>
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
        	$created=$row['created'];
        	$lastupdate=$row['lastupdate'];
        ?>
        <tr>
          <td><?php echo $sr;?></td>
          <td> <?php if($_GET['edit'] )
                {   if($_GET['edit']!="" && $_GET['edit']==$id) { ?>
                        <div Class='form-group col-sm-12 col-md-12 col-xs-12 title-height'>
    						<input type='text' name='title' id='title1' value='<?php echo $title;?>' class='form-control'  required>
    					</div> 
        	      <?php } else {?>
                  <a href="addimages.php#<?php echo $id;?>" title="albumimages"><?php echo strlen($title) > 50 ? ucwords(substr($title,0,50))."..." : ucwords($title);?></a>
          <?php } }else { ?><a href="addimages.php#<?php echo $id;?>" title="albumimages"><?php echo strlen($title) > 50 ? ucwords(substr($title,0,50))."..." : ucwords($title); } ?></a>
          </td>
          <td>
          <?php if($_GET['edit'])
                {  if($_GET['edit']!="" && $_GET['edit']==$id) { ?>
                    <div class="input-group image-preview-new col-sm-12">
						<input type="text" class="form-control image-preview-filename-new" disabled="disabled">
						<input type="hidden" name="form" id="form1" value="updatealbum">
						<input type="hidden" name="id" id="id1" value="<?php echo $id;?>">
						<input type="hidden" name="date" id="localdate" value="">
						<input type="hidden" name="img" id="img1" value="<?php echo $image_name;?>">
						<span class="input-group-btn">
							<!-- image-preview-clear button -->
							<button type="button" class="btn btn-default image-preview-clear-new" style="display:none;">
								<span class="glyphicon glyphicon-remove"></span> Clear
							</button>
							<!-- image-preview-input -->
							<div class="btn btn-default image-preview-input-new">
								<span class="glyphicon glyphicon-folder-open"></span>
								<span class="image-preview-input-title-new">Browse</span>
								<input type="file" accept="image/png, image/jpeg, image/gif" name="cover" id="file1"/> <!-- rename it -->
							</div>
						</span>
					</div>
        	      <?php  }else {?>
                  <img src="../images/albumcover/<?php echo $image_name;?>" alt="<?php echo $image_name;?>" height="50px" width="50px" />
          <?php }}else{?>
              <img src="../images/albumcover/<?php echo $image_name;?>" alt="<?php echo $image_name;?>" height="50px" width="50px" />
          <?php } ?>
          </td>
          <td>
            
            <span class="pull-left"><?php echo $created;?></span>
            <?php if($lastupdate != ''){?>
              <span class="pull-right" href="#" class="pull-right" data-toggle="popover" title="Last Update" data-content="<?php echo $lastupdate;?>">
                  <i class="fa fa-pencil"></i>
              </span>
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
      		<button
      		<?php if($_GET['edit']!="" && $_GET['edit']==$id)
      		        { 
      		            echo 'id="cancle" title="Cancle" name="cancle" class="btn btn-warning cancle" data-href="addalbum.php"><i class="fa fa-times"></i>';
      		        }else { echo 'title="Delete" id='.$id.' class="btn btn-danger delete" data-href="addalbum.php?del=" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o"></i>';
      		        }
      		        ?> 
      		</button>
      		
      		</td>
        </tr>
    <?php $sr++;}?>

    </tbody>
</table>
<script src="js/allalbumajax.js"></script>