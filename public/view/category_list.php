<?php

 $base = __DIR__;
// require_once  $base . '/model/mysqli/category_db.php';
  require_once  $base . '/../config.php';

$index  = 'category_list';
$twig_folder = $base . "/../../templates/";
$twig_loader = new Twig_Loader_Filesystem($twig_folder);
$twig = new Twig_Environment($twig_loader);
$template = $twig->loadTemplate($index . ".twig");
//echo "<pre>";

$categories = $db->get_categories();
//print_r($categories);

echo "</pre>";
//$cnt = count($categories);

$category = array();


echo $template->render(
array(

    //   'attributes' => $attributes,
        'categories' => $categories,

  //     'cate_id' => $category_id,
  //     'attribute_names' => $attribute_names,
  //     'attribute_values' => $attribute_values,]
        //  'delete_url' => "index.php?action=delete_asset&asset_id=$category_id",
)
);
?>
