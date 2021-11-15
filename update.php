<?php require('db.php');
if(isset($_POST['item']) && $_POST['item']!='' && isset($_POST['id']) && $_POST['id']!=''){
	$item_name=$_POST['item'];
    $id=$_POST['id'];
	$exist = 'select * from items where item_name="'.$item_name.'" and id <>'.$id;
    $result = mysqli_query($con, $exist);
    $row=mysqli_fetch_array($result);
    if(!empty($row['id'])){
        $_SESSION['flash_message'] = array('message'=>"Item Already exist!",'status'=>'error');
        header("location: index.php");        
    }
    else{
		$update_sql='UPDATE items set item_name="'.$item_name.'" where id='.$id;
		$result = mysqli_query($con, $update_sql);
        $_SESSION['flash_message'] = array('message'=>"Item updated successfully!",'status'=>'success');
        header("location: index.php");
    }
}
?>