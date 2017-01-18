<?php require_once('../config/config.php');?>
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
        $r="select * from videos";
        $sr=1;
        $result=mysqli_query($conn,$r) or die (mysql_error());
        while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
            $id=$row['id'];
        	$title=$row['title'];
        	$URL=$row['url'];
        	$created=$row['created'];
        ?>
        <tr>
          <td><?php echo $sr;?></td>
          <td><?php echo strlen($title) > 50 ? ucwords(substr($title,0,50))."..." : ucwords($title);?></td>
          <td class="text-center"><img src="<?php getYoutubeImage($URL)?>" height="50px" width="50px" /></td>
          <td><?php echo $URL;?></td>
          <td><span class="pull-left"><?php $dateObject = new DateTime($created);
                    echo $dateObject->format("d-m-y  H:i A");?></span></td>
          <td class="text-center">  <a href="editvideo.php?id=<?php echo $id; ?>">
    						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    						<button title="Edit" class="btn btn-success edit-btn"><i class="fa fa-pencil-square-o"></i></button>
    						</a>
    						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
    						<button title="Delete" id="<?php echo $id; ?>" class="btn btn-danger delete" data-href="addvideo.php?del=" data-toggle="modal" data-target="#myModal"><i class="fa fa-times"></i></button>
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