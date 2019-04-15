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

function getValue($user_id, $field_id){	
	global $conn;
	$sql = "SELECT * FROM users WHERE id=$user_id";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($result)) {
        $fields = json_decode($row['fields']);
        $arr = [];

        foreach ($fields as $field) {
            if ($field->id == $field_id) {
				return $field->value;
			}
		}
		
		return null;
	}
}

$sql = "SELECT id, name, title, type, required FROM fields WHERE model = 'users' ORDER BY sort_order ASC";
$result = mysqli_query($conn, $sql);

$str = '';

if ($requestUri == 'add_user'){
	$template = file_get_contents(__DIR__. "/templates/input_field.html");
	while ($data = mysqli_fetch_assoc($result)) { 
		$data['required'] = $data['required'] ? 'required' : '';    
		$str .= interpolate($data, $template);
	}
} else {
	$user_id = $_GET['id'];
	
	$template = file_get_contents(__DIR__. "/templates/input_update_user.html");
	$fields = [];

	while ($row = mysqli_fetch_assoc($result)) {
		$fields[] = [
			'id' => $row['id'],
			'title' => $row['title'],
			'type' => $row['type'],
			'name' => $row['name'],
			'required' => $row['required'] ? 'required' : '',
			'value' => getValue($user_id, $row['id'])
		];
	}

	foreach ($fields as $data) {   
		$str .= interpolate($data, $template);
	}
	
}
echo $str;