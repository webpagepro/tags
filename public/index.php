
<?php

$base = __DIR__;
include $base . '/config.php';
$index = 'tags';

$twig_folder = '../templates';

if (isset($_POST['action']))
{
    $action = $_POST['action'];
}

else if (isset($_GET['action']))
{
    $action = $_GET['action'];
}

else{
    $action = 'list_assets';
}

if ($action == 'list_assets')
{
   // Get the current category_id
   $category_id = $_GET['category_id'];

    if (!isset($category_id) || $category_id == "")
    {
        $category_id = 1;
        header("Location: .?action=list_assets&category_id=$category_id");
    }

    $db = new AssetDB();
    $assets = $db->get_assets($category_id);

      include 'view/sidebar.php';
      include 'view/asset_list.php';
      include 'view/footer.php';

  //$asset_id = $_GET['asset_id'];
  // $notes = $db->get_asset_notes($asset_id);
  // print_r($notes);
}


/************** CATEGORIES ****************/
  else if ($action == 'list_categories')
  {
      $db = new CategoryDB();
      $categories = $db->get_categories();
      include 'view/sidebar.php';
      include 'view/category_list.php';
      include 'view/footer.php';
  }

   //EDIT CATEGORY FROM
   else if ($action == 'category_edit_form')
   {
       $category_id = $_POST['category_id'];
       $db = new CategoryDB();
       $category = $db->get_category($category_id);

       include 'view/sidebar.php';
       include 'view/category_edit.php';
   }

   else if($action == 'category_edit')
   {
        $cid = $_POST['cid'];
        $cname = $_POST['cname'];

        if (empty($cid))
        {
            $error = "Invalid category name";
            include 'model/errors/error.php';
        }

        else
        {
           edit_category($cid, $cname);
           header("Location: .?action=list_categories&category_id=$cid");
        }
    }

    //ADD CATEGORY
    else if($action == 'add_category')
    {
        $category_name = $_POST['category_name'];
        $category_id = $_REQUEST['category_id'];

        //VALIDATE CATEGORY FIELD
        if(empty($category_name))
        {
            $error = "Invalid category name";
            include('model/errors/error.php');
        }

        //EXECUTE ADD CATEGORY FUNCTION IN MODEL: CATEGORY_DB
        else
        {
          $cdb = new CategoryDB();
          $category =  $cdb->add_category($category_name);
          // header("Location: .?action=list_categories&category_id=$category_id");
          header("Location: .?action=list_categories");
        }
    }

    else if ($action == 'delete_category')
    {
        $category_id = $_GET['category_id'];
        $cdb = new CategoryDB();

        $cdb->delete_category($category_id);
        header('Location: .?action=list_categories');
    }

/*************** ASSETS ******************/

else if ($action == 'delete_asset_list')
{
   $asset_id = $_GET['asset_id'];
   $category_id = $_GET['category_id'];
   echo "delete asset: " .  $asset_id;
     if(empty($asset_id))
     {
         $error = "Invalid asset_id - delete_asset_list";
         include('model/errors/error.php');
         echo "delete_asset_list";
     }

  // Delete asset and notes
  else{
     // Delete asset
        delete_asset($asset_id);
    // Delete the notes
        delete_notes($asset_id);
   }
  // Display the asset List page for the current category
      header("Location: .?action=tags&asset_id=$id&category_id=$category_id");
}

//=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
  else if ($action == 'delete_asset')
  {
     echo "delete_asset";
     $asset_id = $_REQUEST['asset_id'];
     $category_id = $_REQUEST['category_id'];

       if(empty($asset_id))
       {
           $error = "Invalid asset_id - update asset";
           include('model/errors/error.php');
       }

    // Delete asset
    else{
          delete_asset($asset_id);

     // Delete attribute
            delete_attributes($asset_id);

       // Delete the notes
             delete_notes($asset_id);
     }
    // Display the asset List page for the current category
        header("Location: .?action=list_assets&category_id=$category_id");

         print_r($lookup);
   }

//**************** UPDATER  *****************/

else if($action == 'updater')
{
   $code = $_POST['code'];
   $category_id =  $_POST['cate_id'];
   $cdb = new CategoryDB();
   $lookup = $cdb->category_lookup($category_id);
   $cntr = count($lookup);
   $adb = new AssetDB();

   for($i=0;$i<$cntr;$i++)
   {
      $attr_values[] =  $_POST['attribute_values'][$i];
      $attr_ids[] = $lookup[$i]['attribute_id'];
      $notes = $_POST['attribute_note'];

      $adb->updater($attr_values[$i], $code, $attr_ids[$i]);
    }

   if(!isset($code)) {
      $error = "Invalid asset data. Check all fields and try again. -  UPDATER ";
      include('model/errors/error.php');
      $status_message = "failed";
   }

  else{ /* for($i=0;$i<$cntr;$i++)  {$adb->updater($attr_values[$i], $code, $attr_ids[$i]); }*/
          $notes = $_POST['attribute_note'];
          $adb->update_attribute_notes($notes, $code);
      }

    //header("location:tags.php?id=$code&category_id=$cate_id");
     header("location:?action=tags&asset_id=$code&category_id=$cate_id");
     //echo $status_message;

}

  else if($action == 'asset_edit_form')
  {
      //  $categories = get_categories();
       $aid =  $_POST['ass_id'];
       $cid = $_POST['category_id'];


       $ass_id =  $_GET['aid'];
       $adb = new AssetDB();
       $asset = $adb->get_asset($ass_id                                                                                             );

       $cdb = new CategoryDB();
       $category = $cdb->get_category($categ_id);
       $category_name = $category['category_name'];

     //include ('view/asset_edit.php');
     header("Location: ?action=tags&asset_id=$ass_id&category_id=$cate_id"); 
}

   //EXECUTES EDIT ASSET
   else if($action == "asset_edit")
   {
      $aid = $_GET['asset_id'];
      $cid = $_GET['cid'];
     // $asset_id = $_POST['ass_id'];

         // Validate the inputs
        if (empty($aid))
        {
            $error = "Invalid asset data. Check all fields and try again.";
            include('model/errors/error.php');
        }

        else
        {
            $adb = new AssetDB();
            $adb->update_asset($aid, $cid);
            header("Location: index.php?id=$aid&category_id=$cid");

        }

}

/******************  TAGS ********************/

else if ($action === "tags")
{
       include 'view/sidebar.php';
         $tag = $_GET['asset_id'];
         $cdb = new CategoryDB();
    //$cdb = new CategoryDB();
    //$tag = $cdb->get_category_id_by_asset($tag);

     //$category_id = $_GET['category_id'];

      $adb = new AssetDB();
    //$asset_id = $_GET['asset_id'];
      $attributes = $adb->category_attributes($tag);
      $cnt = count($attributes);

      echo $cnt . " attributes (action = tags)";

    //$category_id = $cdb->get_category_id_from_asset_id($tag);
    //$category_id = $_GET['$category_id'];
          $attribute_values = array();
          $attribute_names = array();
          $attribute_ids = array();
          $attribute_note = "";

  for($i=0;$i<$cnt;$i++)
  {
   //$asset_ids[] = $attributes[$i]['id'];
          $attribute_values[] = $attributes[$i]['attribute_value'];
          $attribute_names[] = $attributes[$i]['attribute_name'];
          $attribute_ids[] = $attributes[$i]['attribute_id'];
          $attribute_note = $attributes[$i]['notes'];
          $category_id = $attributes[$i]['category_id'];
  }


          $server = "/var/www/http/sites/tags/templates";
          $index = 'tags';
          $twig_folder =  $base .  "/../../templates";
          $twig_loader = new Twig_Loader_Filesystem($twig_folder);
          $twig = new Twig_Environment($twig_loader);
          $template = $twig->loadTemplate($index . ".twig");
          echo $template->render(
     array(
          'code' => $tag,
          'cnt' => $cnt - 1,
          'cate_id' => $category_id,
          'attribute_ids' => $attribute_ids,
          'attribute_names' => $attribute_names,
          'attribute_values' => $attribute_values,
          'attribute_note' => $attribute_note,
          'attributes' =>$attributes,
          'delete_url' => "index.php?action=delete_asset&asset_id=$tag",
          'navbar' => "navbar.php",
         )
       );
 }

/*************** EDIT ASSETS ***************/
//Display Form
  else if($action === 'new_asset_edit_form')
  {
        $adb = new AssetDB();
        $faid = $_GET['asset_id'];
        $fcid = $_GET['category_id'];
        $asset = $adb->get_asset($faid);

        $cdb = new CategoryDB();

        $category = $cdb->get_category($fcid);
        $categories = $cdb->get_categories();
        $category_name = $category['category_name'];

        include 'view/new_asset_attributes.php';
        include 'view/sidebar.php';
}


      else if($action = 'update_new_asset')
         {
           $aid = $_POST['ass_id'];
          $cid =  $_POST['cid'];
           $adb = new AssetDB();
           $adb->update_asset($cid, $aid);

           echo "ass_id: " . $aid;
           echo "<br>";
           echo "cid: " . $cid;
           echo "<br>";

           $cdb  = new CategoryDB();
           $attributes = $cdb->category_lookup($cid);

           $cnt = count($attributes);

              if (empty($aid))
              {
                  $error = "Invalid asset data. Checck all fields and try again. - index/new_asset_attributes";
                  include('model/errors/error.php');
              }

             else{
                      for($i=0;$i<$cnt;$i++)
                      {
                        $attr_ids[] = $attributes[$i]['attribute_id'];
                        $adb->create_ata_no_record_found($aid, $attr_ids[$i], $attribute_values = "----------");
                      }
                }

                 header("Location: ?action=tags&asset_id=$aid&category_id=$cid");
}

/**************** ADD ASSET *****************/
    else if ($action == 'show_add_form')
    {
        $cdb = new CategoryDB();
        $adb = new AssetDB();
        $categories = $cdb->get_categories();
        $assets = $adb->get_assets($asset_id);
       // include('view/asset_add.php');
       include ('new_asset_attributes.php');
    }

    else if ($action == 'add_asset')
    {
        $code = $_POST['code'];
        $category_id = $_POST['category_id'];
        echo "code: " . $code;


    // Validate the inputs
        if (empty($code))
        {
            $error = "Invalid asset data. Check all fields and try again.";
            include 'model/errors/error.php';
        }

        else
        {
            $adb->asset_add($code, $category_id);

        // Display the asset List page for the current category
      //  header("Location: index.php?asset_id=$code&category_id=$category_id");
        }
 }

  
