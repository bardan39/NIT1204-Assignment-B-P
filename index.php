<?php require('db.php');?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.title{
			/*color:#f28100;*/
			color:darkgreen;
		}
		.container{
			/*background: aliceblue;*/
			padding: 10px;
		}
		.site_title{
			color: darkgreen;
		}
		label{
			text-align: right;
			line-height: 1.8;
		}
	</style>
	<title>Shopping List</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container"><br><br>
		
		<h2 class="site_title">Shopping List Manager</h2>
		<hr>
		<?php if (isset($_SESSION['flash_message']['status']) && $_SESSION['flash_message']['status']=='success'): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><strong>Success</strong></h4>
                <p><?php echo $_SESSION['flash_message']['message']; ?></p>
            </div>
            <?php unset($_SESSION['flash_message']);?>
        <?php endif; ?>
        <?php if (isset($_SESSION['flash_message']['status']) && $_SESSION['flash_message']['status']=='error'): ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><strong>Info</strong></h4>
               <p><?php echo $_SESSION['flash_message']['message']; ?></p>
            </div>
            <?php unset($_SESSION['flash_message']);?>
        <?php endif; ?>
		<h3 class="title">Items</h3>
		<div class="item list">
			<?php 
			$records_arr=array();
			$sql="select * from items";
			if(isset($_GET['sort']) && $_GET['sort']=="item_asc"){
				$sql="select * from items order by item_name asc";
			}
			$result = mysqli_query($con, $sql);
	    	if(mysqli_num_rows($result)>0){
	    		echo "<ol>";
	            while($row = mysqli_fetch_assoc($result)) {
	                echo '<li>'.$row['item_name'].'</li>';
	                $records_arr[]=$row;
	            }
	            echo "</ol>";
	    		mysqli_close($con);
	    	}else{
				echo "There are no items in the list";
			}        
			?>
		</div>

		<div class="item_add" >
			<h3 class="title">Add Item: </h3>
			<form action="<?php echo $base_url;?>insert.php" method="post">
				<label class="col-md-1">Item: </label>
				<div class="col-md-4">
					<input type="text" name="item" value="" required class="form-control"><br>
					<input type="submit" name="create_item" value="Add Item" class="btn btn-primary">
				</div>
			</form>
		</div>
		<?php 
		if(!empty($records_arr)):?>
			<div class="item_selection_div col-md-4 row" style="clear:both;">
				<h3 class="title">Select Item: </h3>
				<select name="item_selection" class="form-control item_selection">
					<?php
					// echo "<pre>";print_r($records_arr);
					if(!empty($records_arr)){
						foreach ($records_arr as $key => $data) {
							// echo "<pre>";print_r($data);
							echo '<option value="'.$data['id'].'">'.$data['item_name'].'</option>';
						}
					}
					?>
				</select>			
				<br>
				<button class="modify_item btn btn-primary">Modify Item</button>
				<button class="delete_item btn btn-danger">Delete Item</button>
			</div>		
			<div class="item_modification_div col-md-12 row" style="clear:both;display: none;">
				<h3 class="title">Item to Modify: </h3>
				<form action="<?php echo $base_url;?>update.php" method="post">
					<label class="col-md-1">Item: </label>
					<div class="col-md-4">
						<input type="text" name="item" value="" class="item_name form-control" required>
						<input type="hidden" name="id" value="" class="item_id"><br>
						<input type="submit" name="update_item" value="Save Changes" class="btn btn-primary">
						<button type="button" class="cancel_changes btn btn-danger">Cancel Changes</button>
					</div>
				</form>
			</div>
			<div class="delete_form_div" style="display: none;clear: both;">
				<form action="<?php echo $base_url;?>delete.php" method="get" id="delete_form">
					<input type="hidden" name="id" value="" class="item_id_for_del">
				</form>
			</div>
			<div style="clear:both;">
				<?php if(!empty($records_arr) && count($records_arr)>1){
					?><br>
					<a href="<?php echo $base_url;?>?sort=item_asc" class="btn btn-default">Sort Item</a>
					<?php 
				}?>
			</div>
		<?php endif;?>
	</div>
	<script type="text/javascript">
		$('body').on('click','.modify_item',function(){
			var selected_item_id=$('.item_selection').val();
			var selected_item_name=$('.item_selection option:selected').html();
			$('.item_modification_div').find('.item_name').val(selected_item_name);
			$('.item_modification_div').find('.item_id').val(selected_item_id);
			$('.item_modification_div').show();
			$('.item_selection_div').hide();
		});
		$('body').on('click','.cancel_changes',function(){
			$('.item_modification_div').find('.item_name').val('');
			$('.item_modification_div').find('.item_id').val('');
			$('.item_modification_div').hide();
			$('.item_selection_div').show();
		});
		$('body').on('click','.delete_item',function(){
			if(confirm('Are you sure you want to delete selected item?')){
				var selected_item_id=$('.item_selection').val();
				$('.item_id_for_del').val(selected_item_id);
				$('#delete_form').submit();
			}
		});
	</script>
</body>
</html>
