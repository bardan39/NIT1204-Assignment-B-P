<?php
$items = array();
if('POST' === $_SERVER['REQUEST_METHOD']) {
if( ! empty($_POST['item'])) {
$items[] = $_POST['item'];
}
if(isset($_POST['items']) && is_array($_POST['items'])) {
foreach($_POST['items'] as $item) {
$items[] = $item;
}
}
}
?>
<html>
<head>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<title>Demo</title>
</head>
<body>
<h1>Shopping List Manager</h1>
<p>________________________________</p>
<h2 style="color:red">Items:</h2>
   <?php
   if(empty($items))
       echo "There is no item in list"
  
   ?>
<?php if($items): ?>
<ul>
<?php foreach($items as $item): ?>
               <li onclick=(function(){
                   if (($key = array_search($item, $items)) !== false) {
               unset($items[$key]);
                   }
               })>
               <?php echo $item; ?>
               </li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<h2 style="color:red">Add Item :</h2>
<form method="post">
Item : <input type="text" name="item" /><br><br>
<input type="submit" value="Add Item" />
<?php if($items): ?>
<?php foreach($items as $item): ?>
<input type="hidden" name="items[]" value="<?php echo $item; ?>" />
<?php endforeach; ?>
<?php endif; ?>
</form>
</body>
</html>

