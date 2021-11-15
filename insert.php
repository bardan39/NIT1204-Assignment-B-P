<?php require('db.php');
if(isset($_POST['item']) && $_POST['item']!=''){
	$item_name=$_POST['item'];
	$exist = 'select * from items where item_name="'.$item_name.'"';
    $result = mysqli_query($con, $exist);
    $row=mysqli_fetch_array($result);
    if(!empty($row['id'])){
        // $new_relation_id=$row['id'];
        // already exist
        $_SESSION['flash_message'] = array('message'=>"Item Already exist!",'status'=>'error');
        header("location: index.php");
    }
    else{
		$insert_sql="INSERT INTO items (item_name) VALUES ('$item_name')";
		$result = mysqli_query($con, $insert_sql);
        if (mysqli_affected_rows($con)){
        	$_SESSION['flash_message'] = array('message'=>"Item created successfully!",'status'=>'success');
        	header("location: index.php");
        }
    }
}
?>