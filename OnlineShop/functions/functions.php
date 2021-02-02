<?php
function clear($string) {
	$string = strip_tags($string);
	$string = addslashes($string);
	$string = trim($string);

	return $string;
};

function priceValidate($str) {
	return number_format($str, 0, ',', ' ');
}
?>