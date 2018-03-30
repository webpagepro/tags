
<?php

 $base = __DIR__;
require_once  $base . '/../config.php';
//$db = new CategoryDB();
//$categories = $db->get_categories();

$ass_id = $_GET['asset_id'];
$cate_id = $_GET['category_id'];

echo "ass_id:  " .  $ass_id . "<br>";
echo "cate_id:  " .  $cate_id . "<br>";

$index  = 'new_asset_attributes';
$twig_folder = $base . "/../../templates/";
$twig_loader = new Twig_Loader_Filesystem($twig_folder);
$twig = new Twig_Environment($twig_loader);
$template = $twig->loadTemplate($index . ".twig");

$cnt = count($categories);

echo $template->render(
array(
        'ass_id' => $ass_id,
        'cnt' => $cnt - 1,
        'categories' => $categories,
        'cate_id' => $cate_id,
        'delete_url' => "index.php?action=delete_asset&asset_id=$ass_id&category_id=$cate_id",
)
);


?>
