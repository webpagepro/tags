

<?php
$base = __DIR__;
require_once  'config.php';
$attributes = array();
//$asset_id = htmlspecialchars($_GET['asset_id']);
//echo "<pre>asset_id: " . $asset_id . "   tags.php</pre>";

//$db = mysqli_connect('localhost', 'root', 'root', 'inventory');
$q = "SELECT asset_id FROM assets WHERE asset_id = $asset_id";
/*                                                                                                        
$result = $db->query($q);
if($result->num_rows == 0)
{

    $adb = new AssetDB();
    $adb->create_asset_id($asset_id, $category_id = 99);
    $adb->notes_no_record_found($asset_id, $note_id = 1, $default = "----------");

    //header("location:index.php?action=new_asset_edit_form&asset_id=$asset_id&category_id=$category_id");
    exit;
}

else
{
  */
  // if($result->num_rows >= 1)
  //  {
      //  header("Location:index.php?action=tags&asset_id=$asset_id&test=tags");
   //   header("Location:../index.php?action=tags&asset_id=$asset_id&test=tags");



      for($i=0;$i<$cnt;$i++)
      {
        //$asset_ids[] = $attributes[$i]['id'];
           $attribute_values[] = $attributes[$i]['attribute_value'];
            $attribute_names[] = $attributes[$i]['attribute_name'];
            $attribute_ids[] = $attributes[$i]['attribute_id'];
            $attribute_note = $attributes[$i]['notes'];
            $category_id = $attributes[$i]['category_id'];
      }
    //}



    $server = "/var/www/http/sites/tags/templates";
    $index = 'tags';
    $twig_folder = "../templates";
    $twig_loader = new Twig_Loader_Filesystem($twig_folder);
    $twig = new Twig_Environment($twig_loader);
    $template = $twig->loadTemplate($index . ".twig");
               echo $template->render(
               array(
                      'code' => $asset_id,
                     'cnt' => $cnt - 1,
                       'cate_id' => $category_id,
                        'attribute_ids' => $attribute_ids,
                        'attribute_names' => $attribute_names,
                       'attribute_values' => $attribute_values,
                       'attribute_note' => $attribute_note,
                      'attributes' =>$attributes,
                      'delete_url' => "index.php?action=delete_asset&asset_id=$id&category_id=$category_id",
                      'navbar' => "navbar.php",
            )
        );

  //  }
 // }
?>
