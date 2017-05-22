<?php
// CSS Declaration
header("Content-type: text/css", true);

// Include Minify class
require_once '../../../../class/IntegratedMinify.php';

$css = minifyCSS([
    'bootstrap_custom.css',
]);

echo $css;