<?php
$base = __DIR__;
require_once $base . '/../config.php';

$dat = new date();
$dater = $dat->date();
$date_format = $dater;

$copyrighted = 'LST &#169;2016' . $dater;



$index = 'footer';
$twig_folder = $base . '/../../templates';
$twig_loader = new Twig_Loader_Filesystem($twig_folder);
$twig = new Twig_Environment($twig_loader, array('debug' => true));
$twig->addExtension(new Twig_Extension_Debug());
$template = $twig->loadTemplate($index . ".twig");
 echo $template->render(
  array(


                  'copyrighted'  => $copyrighted,
                //  'ass_id' => $ass_id,
              //   'category_id' => $category_id,
              //   'category_name' => $category_name,
            //     'categories' => $categories,
      //     'vals' => array('names' => $attribute_names, 'values' => $attribute_values),
              //'delete_url' => "index.php?action=delete_asset_list&asset_id=",

)
);

//echo "<pre>";
//print_r($categories);

//echo "<br>===============================================</br>";
//print_r($asset_id);
//echo "</pre>";

?>
