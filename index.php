<?php

require('Parsedown.php');

$doc = file_get_contents("README.markdown");

$result = Parsedown::instance()->parse($doc);
echo $result;

?>