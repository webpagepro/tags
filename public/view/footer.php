<?php
$base = __DIR__;
require_once $base . '/../config.php';

date_default_timezone_set("UTC");
//$date = new DateTime();
$startyear = 2016;
$date = new DateTime('2016-11-22');
$dater = $date->format("Y");
//$copyrighted = '&copy; $startyear' - $currentyear;
//'LST &#169;2016 - $dater;

if($startyear == $dater)
{
  $dater = $dater + 0;
}
else{
    $dater = $startyear . " to " . $dater;
}

$index = 'footer';
$twig_folder = $base . '/../../templates';
$twig_loader = new Twig_Loader_Filesystem($twig_folder);
$twig = new Twig_Environment($twig_loader, array('debug' => true));
$twig->addExtension(new Twig_Extension_Debug());
$template = $twig->loadTemplate($index . ".twig");
 echo $template->render(
  array(
                  'startyear' => $startyear,
                  'dater' => $dater,

)
);


?>
