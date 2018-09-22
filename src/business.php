<?php
require '../../vendor/autoload.php';

function get_db()
{
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b'
        ]);

    $db = $mongo->wai;
    return $db;
}

function add_new($file, $tytul, $autor, $u_id)
{
	$db = get_db();
	$photo = [
		'name' => $tytul,
		'author' => $autor,
		'path' => $file,
		'u_id' => $u_id
	];
	$db->photos->insertOne($photo);
}

function addString($mime_type, $file, $watermarkString)
{
	if ($mime_type == "image/jpeg")
	{
		$image = imagecreatefromjpeg("$file");
	}
	else
	{
		$image = imagecreatefrompng("$file");
	}
	$wat = imagecreatetruecolor(70, 50);
	imagestring($wat, 5, 0, 0, $watermarkString, 0xFFFFFF);
	$marge_right = 10;
	$marge_bottom = 10;
	$sx = imagesx($wat);
	$sy = imagesy($wat);
	imagecopy($image, $wat, imagesx($image) - $sx - $marge_right, imagesy($image) - $sy - $marge_bottom, 0, 0, imagesx($wat), imagesy($wat));
	imagepng($image, $file . '.water.png');
	imagedestroy($image);
}

function changeSize($mime_type, $file)
{
	if ($mime_type == "image/jpeg")
	{
		$image = imagecreatefromjpeg("$file");
	}
	else
	{
		$image = imagecreatefrompng("$file");
	}
	$image = imagescale($image,200,125);
	imagepng($image, $file . '.min.png');
	imagedestroy($image);
}
?>