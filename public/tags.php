

<?php
//$base = __DIR__;

require_once  'config.php';
// Grabs scanned
$id = htmlspecialchars($_GET['id']);
$db = new mysqli("localhost", "phxcrimi_assets", "P@ssw0rd", "phxcrimi_inventory");
$q = "SELECT asset_id FROM assets WHERE asset_id = $id";
////$result = get_qr_code($id);
$result = $db->query($q);
  print_r($result);

//switch($result->num_rows)
//{
//  case  0:


if($result->num_rows === 0)
{
    $adb = new AssetDB();
    $adb->create_asset_id($id, $category_id = 99, $default = "----------");
    $adb->notes_no_record_found($id, $note_id = 1, $default = "----------");

     header("location:index.php?action=new_asset_edit_form&asset_id=$id&category_id=$category_id");


}
//case 1:

//$category_id = $db->

else// ($result->num_rows >= 1)
{
  header("location:index.php?action=tags&asset_id=$id");//&category_id=$category_id
}
///  echo "<pre>results: ";
  //    print_r($result);

   //include 'view/tags.php';
    //  echo "</pre>";
?>
