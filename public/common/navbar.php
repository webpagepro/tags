


<?php

 $base = __DIR__;
// require_once  $base . '/model/mysqli/category_db.php';
  require_once  $base . '/../config.php';
$index  = 'navbar';
$twig_folder = $base . "/../../templates/";
$twig_loader = new Twig_Loader_Filesystem($twig_folder);
$twig = new Twig_Environment($twig_loader);
$template = $twig->loadTemplate($index . ".twig");
//echo "<pre>";
$categories = get_categories();
//echo "</pre>";
//print_r($categories);
$cnt = count($categories);

for($i=0;$i<$cnt;$i++)
{
  $category_name = $categories[$i]['category_name'];
}

  $category_id = $_GET['category_id'];
   if (!isset($category_id))
   {
       $category_id = 1;
    }


echo $template->render(
array(
       //'code' => $ass_id,
       'cnt' => $cnt,
        'categories' => $categories,
        'category_name' => $category_name,
       'nav_cat_id' => $category_id,
            //  'delete_url' => "index.php?action=delete_asset&asset_id=$category_id",
)
);



  /*
<nav class="navbar navbar-inverse navbar-fixed-top">
 <div class="container-fluid">
   <div class="navbar-header">
     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
       <span class="sr-only"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
     <a class="navbar-brand" href="index.php">Assets Manager</a>
   </div>
       <div id="navbar" class="navbar-collapse collapse">
     <ul class="nav navbar-nav navbar-left">
      <li><a href=".?action=list_categories">Manage Categories</a></li>
        <li><a href=".?action=list_assets&category_id=1"> View Assets</a></li>
     </ul>


   </div>
 </div>
</nav> */

?>
