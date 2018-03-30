<?php
//require $base . '/../vendor/autoload.php';
$base = __DIR__;
require_once $base . '/../config.php';
$category_id = $_GET['category_id'];
$cdb = new CategoryDB();
$categories = $cdb->get_categories();
//$ass_id = $_POST['asset_id'];

//$ass_id =  $_POST['asset_id'];
//$adb = new AssetDB();
//$asset =
$category_name = $cdb->get_category($category_id);

//$attribute_cnt = category_lookup($category_id);

$index = 'asset_list';
$twig_folder = $base . '/../../templates';
$twig_loader = new Twig_Loader_Filesystem($twig_folder);
$twig = new Twig_Environment($twig_loader, array('debug' => true));
$twig->addExtension(new Twig_Extension_Debug());
$template = $twig->loadTemplate($index . ".twig");
 echo $template->render(
  array(
                  'assets'  => $assets,
               //  'ass_id' => $ass_id,
                 'category_id' => $category_id,
                 'category_name' => $category_name,
                 'categories' => $categories,
      //     'vals' => array('names' => $attribute_names, 'values' => $attribute_values),
              'delete_url' => "index.php?action=delete_asset_list&asset_id=",

)
);

//echo "<pre>";
//print_r($categories);

//echo "<br>===============================================</br>";
//print_r($asset_id);
//echo "</pre>";

?>
