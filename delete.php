<?php require('db.php');
if(isset($_GET['id']) && $_GET['id']!=''){
    $id=$_GET['id'];
	$exist = 'delete from items where id='.$id;
    // echo $exist;die;
     $_SESSION['flash_message'] = array('message'=>"Item deleted successfully!",'status'=>'success');

    $result = mysqli_query($con, $exist);
    header("location: index.php");
}
?>