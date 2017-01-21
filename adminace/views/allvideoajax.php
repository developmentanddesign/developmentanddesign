<?php header('Access-Control-Allow-Origin: *'); require_once('../config/config.php'); ?>
<table id="example4" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
      <th>Sr.</th>
      <th>Title</th>
      <th class="text-center">Thumbnail</th>
      <th>URL</th>
      <th>Created</th>
      <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
      <?php 
        //insert query//
        $r="select * from videos order by 1 desc";
        $sr=1;
        $result=mysqli_query($conn,$r) or die (mysql_error());
        while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
            $id=$row['id'];
        	$title=$row['title'];
        	$URL=$row['url'];
        	$created=$row['created'];
        	$lastupdate=$row['lastupdate'];
        ?>
        <tr>
          <td><?php echo $sr;?></td>
          <td><?php if($_GET['edit'] )
                {   if($_GET['edit']!="" && $_GET['edit']==$id) { ?>
                        <div Class='form-group col-sm-12 col-md-12 col-xs-12 title-height'>
                <input type='hidden' name='id' id='id' value='<?php echo $id;?>' class='form-control'  required>
                <input type="hidden" name="date" value="" id="localdate">
    						<input type='text' name='title' id='title1' value='<?php echo $title;?>' class='form-control'  required>
    					</div> 
        	      <?php } else {?>
                  <?php echo strlen($title) > 50 ? ucwords(substr($title,0,50))."..." : ucwords($title);?>
          <?php } }else { echo strlen($title) > 50 ? ucwords(substr($title,0,50))."..." : ucwords($title); } ?>
          </td>
          <td class="text-center"><img src="<?php getYoutubeImage($URL)?>" height="50px" width="50px" /></td>
          <td> <?php echo strlen($URL) > 50 ? substr($URL,0,50)."..." : $URL; ?> </td>
          <td>
              <span class="pull-left">
                  <?php echo $created;?>
              </span>
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
      		        data-href="addvideo.php" 
      		        title="<?php if($_GET['edit']=="" || $_GET['edit']!=$id)
      		        { echo "Edit";} 
      		        else{ echo "Update";}?>"
      		        <?php if($_GET['edit']==$id){?>
      		        onclick="updateVideo()"
      		        <?php } ?>
      		        class="btn btn-success 
      		        <?php if($_GET['edit']=="" || $_GET['edit']!=$id)
      		        {} else{ echo "update-btn"; }?>"
      		        <?php if($_GET['edit']=="" || $_GET['edit']!=$id)
      		        { ?> onclick="edit(id,'views/allvideoajax.php','.videodata')" <?php }?>>
      		        <?php if($_GET['edit']=="" 
      		                || !isset($_GET['edit']) 
      		                || $_GET['edit']!=$id )
      		                { echo '<i class="fa fa-pencil-square-o"></i>'; }
      		              elseif($_GET['edit']!="" && $_GET['edit']==$id)
      		                { echo '<i class="fa fa-check"></i>'; }?>
      		</button>
      		<button
      		<?php if($_GET['edit']!="" && $_GET['edit']==$id)
      		        { ?> id="cancle" title="Cancle" name="cancle" onclick="cancle('views/allvideoajax.php','.videodata')" class="btn btn-warning cancle"><i class="fa fa-times"></i>
      		       <?php }else { echo 'title="Delete" id='.$id.' class="btn btn-danger delete" data-href="addvideo.php?del=" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o"></i>';
      		        }
      		        ?> 
      		</button>
    			</td>
        </tr>
      <?php $sr++;}?>

    </tbody>
</table>
<?php
      function getYoutubeImage($e){
      //GET THE URL
      $url = $e;

      $queryString = parse_url($url, PHP_URL_QUERY);

      parse_str($queryString, $params);

      $v = $params['v'];  
      //DISPLAY THE IMAGE
      if(strlen($v)>0){
          echo "http://img.youtube.com/vi/$v/0.jpg";
      }
  }
?>
<script src="js/allvideoajax.js"></script>