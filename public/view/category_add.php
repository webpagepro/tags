<?php

 $base = __DIR__;
// require_once  $base . '/model/mysqli/category_db.php';
  require_once  $base . '/../config.php';

$index  = 'category_add';
$twig_folder = $base . "/../../templates/";
$twig_loader = new Twig_Loader_Filesystem($twig_folder);
$twig = new Twig_Environment($twig_loader);
$template = $twig->loadTemplate($index . ".twig");
//echo "<pre>";
$category_id = $_POST['category_id'];
//echo "</pre>";
//print_r($categories);
$max_id = getMaxCategoryId();
echo "<pre><br>";
print_r ($max_id);
echo "</pre><br>";

echo $template->render(
array(
       //'code' => $ass_id,
       'category_id' => $category_id,
    //   'attributes' => $attributes,
        //'categories' => $categories,
    //    'category_name' => $category_name,
  //     'cate_id' => $category_id,
  //     'attribute_names' => $attribute_names,
  //     'attribute_values' => $attribute_values,
        //  'delete_url' => "index.php?action=delete_asset&asset_id=$category_id",
)
);

}

/*

*/

?>
