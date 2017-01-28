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
          <td>
             <a href="addimages.php#<?php echo $id;?>" title="albumimages"><?php echo strlen($title) > 50 ? ucwords(substr($title,0,50))."..." : ucwords($title);?></a>
          </td>
          <td>
              <img src="../images/albumcover/<?php echo $image_name;?>" alt="<?php echo $image_name;?>" height="50px" width="50px" />
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
      		<button id="<?php echo $id; ?>" data-href="addalbum.php" title="Edit" class="btn btn-success edit-btn">
      		    <i class="fa fa-pencil-square-o"></i>
      		</button>
      		<button title="Delete" id='<?php echo $id; ?>' class="btn btn-danger delete" data-href="addalbum.php?del=" data-toggle="modal" data-target="#myModal">
      		  <i class="fa fa-trash-o"></i>
      		</button>
      		
      		</td>
        </tr>
    <?php $sr++;}?>

    </tbody>
</table>
<script src="js/allalbumajax.js"></script>