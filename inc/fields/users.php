<?php

require(__DIR__. "/../../database.php");

function interpolate($data, $template){
	
	foreach($data as $key => $value) {
		$find = "{{".$key."}}";
		$replace = $value;
		$template = str_replace($find, $replace, $template);
	}
	
	return $template;
}

$template = file_get_contents(__DIR__. "/templates/input_field.html");

$sql = "SELECT name, title, type FROM fields WHERE model = 'users' ORDER BY sort_order ASC";
$result = mysqli_query($conn, $sql);

$str = '';

while ($data = mysqli_fetch_assoc($result)) {     
    $str .= interpolate($data, $template);
}

echo $str;