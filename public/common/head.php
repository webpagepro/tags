
<?php


 
 $base = __DIR__;
// require_once  $base . '/model/mysqli/category_db.php';
$index  = 'head';
$twig_folder = $base . "/../../templates/";
$twig_loader = new Twig_Loader_Filesystem($twig_folder);
$twig = new Twig_Environment($twig_loader);
$template = $twig->loadTemplate($index . ".twig");
//echo "<pre>";

$url = 'http://tags.lstsupport.com/templates';


echo $template->render(
array(
       //'code' => $ass_id,
       'custom' => 'templates/css/custom.css',
        'boostrap' => 'templates/css/bootstrap.css',
         'dashboard' => 'templates/css/dashboard.css',
         'style' => 'templates/css/style.css',
         'bootstrap_min_js' => 'templates/js/bootstrap.min.js',
        //  'delete_url' => "index.php?action=delete_asset&asset_id=$category_id",
)
);

?>
