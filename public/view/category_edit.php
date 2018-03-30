
<?php

 $base = __DIR__;
// require_once  $base . '/model/mysqli/category_db.php';
  require_once  $base . '/../config.php';

$index  = 'category_edit';
$twig_folder = $base . "/../../templates/";
$twig_loader = new Twig_Loader_Filesystem($twig_folder);
$twig = new Twig_Environment($twig_loader);
$template = $twig->loadTemplate($index . ".twig");
//echo "<pre>";
$cdb = new CategoryDB();
$categories = $cdb->get_category();
$category_id =
//echo "</pre>";
//print_r($categories);
//echo "<pre>";
$cnt = count($categories);

//  $category_id = $category['category_id'];
//  $category_name = $category['category_name'];

echo $template->render(
array(
       //'code' => $ass_id,
       'cnt' => $cnt,
    //   'attributes' => $attributes,
      //  'categories' => $categories,
        'category_name' => $category_name,
       'category_id' => $category_id,

  //     'attribute_values' => $attribute_values,
        //  'delete_url' => "index.php?action=delete_asset&asset_id=$category_id",
)
);


?>
