<?php
$script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$parts = explode('/', trim($script, '/'));
$folder = $parts[0] ?? '';
define('BASE_URL','https://stylenest.site.je/');
define('SITE_NAME', 'StyleNest');
?>
<?php


if(!function_exists('e')){

    function e($value){

        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');

    }

}

?>