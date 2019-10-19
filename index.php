<?php 
$base = __DIR__;
$id_lookup = $_POST['id'];
require_once $base . "/public/config.php";
$adb = new AssetDB();

/* if (!isset($_COOKIE['id']))
 {   
     setcookie("id", "true", time()+00001, "/");  
   
     
$sess = session_start();
if(isset($sess))
{
$sess = 7000;
    for($i=1;$i<100;$i++)
    {
       $sess++;
    }
      header("Location:public/index.php?action=new_asset_edit_form&asset_id=$sess&category_id=99");
      
}*/



$db = new mysqli("localhost");
$q = "SELECT category_id FROM assets WHERE asset_id = $id_lookup";

$category_id = $db->query($q);

echo $category_id;

?>
<html>
<head>
<body>

    <div class="col-sm-10 col-md-0 col-md-offset-2 main">


<div class="id_lookup" style="padding:4%;">
<div class="sub-titles-new_asset">Asset Lookup</div>
 <table class="table table-striped table-fluid">
 <div class="form-group">    
<p><br><br><h4>Option 1: Enter New or Existing Asset ID:</h4></p>
<form class="form-horizontal" action="public/tags.php" name="manual" id="manual" method="get">
<input type="text" id="man_id" name="id">
 <input type="submit" value="Submit" class="btn btn-primary" id="go_lookup"/></td>
</form></div>
 <div class=""><p class="row"><h4>Option 2: Scan QR Code image (below) with mobile device:</h4><img src="http://api.qrserver.com/v1/create-qr-code/?color=000000&amp;bgcolor=FFFFFF&amp;data=http%3A%2F%2Fwebpagepros.com%2Ftags%2Fpublic%2Findex.php%3Faction%3Dtags%26asset_id%3D10119&amp;qzone=1&amp;margin=0&amp;size=200x200&amp;ecc=L" alt="qr code" /></p></div>
</div>
</body>
</head>
</html>


