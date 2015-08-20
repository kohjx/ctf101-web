<?php
$pwhash="ffd313452dab00927cb61065a392f30ae454e70f";

if (@$_GET['log']) {
	include($_GET['log'].".log");
}
include((@$_GET['page']?$_GET['page'].".php":"main.php"));


?>
