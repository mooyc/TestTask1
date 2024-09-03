<?

function json($array, $code=200) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    http_response_code($code);
    echo json_encode($array, JSON_UNESCAPED_UNICODE);
    die();
}

function upload_file($file) {
	$mime = mime_content_type($_FILES['file']['tmp_name']);
	switch ($mime) {
	    case 'text/plain':
	        $ext = ".txt";
	        $dir = $_SERVER['DOCUMENT_ROOT'] . "/files/";
	        $filename = md5(rand(100000,999999)).$ext;
	        break;
	    default:
	        json(['status' => FALSE, 'message' => 'Допустимые форматы: .txt']);
	}

	if ($file['size'] > 1024*1024*5) { 
        json(['status' => FALSE, 'message' => 'Размер файла не должен превышать 5МБ']);
    }

	if (!is_dir($dir)) {
	    mkdir($dir, 0777, true);
		if ( is_file( $dir . $filename ) && is_readable( $dir . $filename )) {
		    unlink( $dir . $filename );
		}
	}

	move_uploaded_file($file['tmp_name'], $dir . $filename); 

	$opened_file = file($dir.$filename);
	$data = array();
	foreach ($opened_file as $key => $value) {
		$count = preg_match_all('/\d/', $value, $matches);
		$data[$key]['text'] = $value;
		$data[$key]['count'] = $count;
	}

	json(['status' => TRUE, 'data' => $data]);
} 

if (!isset($_FILES['file'])) { 
	json(['status' => FALSE, 'message' => 'Файл не был загружен!']); 
}

$file = $_FILES['file'];

upload_file($file);