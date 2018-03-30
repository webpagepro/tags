<?php
 $base = __DIR__;
// require_once  $base . '/model/mysqli/category_db.php';
require_once  $base . '/../config.php';

$index  = 'sidebar';
$twig_folder = $base . "/../../templates";
$twig_loader = new Twig_Loader_Filesystem($twig_folder);
$twig = new Twig_Environment($twig_loader);
$template = $twig->loadTemplate($index . ".twig");

$cdb = new CategoryDB();
$categories =  $cdb->get_categories();
$cnt = count($categories);
//$category_name = get_category_name($category_id);

echo $template->render(
array(
  // 'code' => $asset_id,
       'cnt' => $cnt,
      // 'category_name' => $category_name,
        'categories' => $categories,
        'href' => 'index.php?action=list_assets&category_id=',
          'delete_url' => 'index.php?action=delete_asset&asset_id=$ass_id'
)
);


?>
