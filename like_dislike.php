<?php
$con = mysqli_connect("localhost","root","","rupesh");
$sql = "select * from like_dislike";
$res = mysqli_query($con,$sql);
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <title>Like & Dislike</title>
    <style>
    	.row
    	{
    		border: 1px solid #000;
    	}
    </style>
  </head>
  <body>
   <div class="container">
   	<?php while($row = mysqli_fetch_assoc($res)){ ?>
   	<div class="row my-5">
   		<div class="col-md-8">
   			<h1><?php echo $row['post']; ?></h1>
   		</div>
   		<div class="col-md-2">
   			<a href="javascript:void(0)" class="btn btn-primary my-2">
   				<span class="fas fa-thumbs-up" onclick="like_update('<?php echo $row['id'] ?>')"> Like (<span id="like_loop_<?php echo $row['id'] ?>"><?php echo $row['like_count'] ?></span>)</span>
   			</a>
   		</div>
   		<div class="col-md-2">
   			<a href="javascript:void(0)" class="btn btn-primary my-2">
   				<span class="fas fa-thumbs-down" onclick="dislike_update('<?php echo $row['id'] ?>')"> Dislike (<span id="dislike_loop_<?php echo $row['id'] ?>"><?php echo $row['dislike_count'] ?></span>)</span>
   			</a>
   		</div>
   	</div>
   <?php } ?>
   </div>
   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  
   
  </body>
  <script>
   		function like_update(id)
   		{	
   			jQuery.ajax({
   				url:'update_count.php',
   				type:'post',
   				data:'type=like&id='+id,
   				success:function(result)
   				{
   					var cur_count = jQuery("#like_loop_"+id).html();
				   	cur_count++;
				   	jQuery("#like_loop_"+id).html(cur_count);
   				}
   			})

   		}

   		function dislike_update(id)
   		{
   			jQuery.ajax({
   				url:'update_count.php',
   				type:'post',
   				data:'type=dislike&id='+id,
   				success:function(result)
   				{
   					var cur_count = jQuery("#dislike_loop_"+id).html();
		   			cur_count++;
		   			jQuery("#dislike_loop_"+id).html(cur_count);
   				}
   			})
   		}
   </script>

</html>