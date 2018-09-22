<?php
require_once 'business.php';

function remember(&$model)
{
	$db = get_db();
	$numberOfPhotos = $db->products->count();
	if(isset($_POST["submit"]) || isset($_POST["pokaz"]))
	{
		$photos = $db->photos->find();
		foreach ($photos as $photo)
		{
			$id = $photo['_id'];
			if (isset($_POST["$id"]))
			{
				$_SESSION["$id"] = 1;
			}
			else
			{
				unset($_SESSION["$id"]);
			}
		}
	}
	if (isset($_POST["pokaz"]))
	{
		$photos = $db->photos->find();
		$model = [
			'wybrane' => 1,
			'photos' => $photos,
			'numberOfPhotos' => $numberOfPhotos
			];
		return 'main_view';
	}
	if (isset($_POST["usun"]))
	{
		$photos = $db->photos->find();
		foreach ($photos as $photo)
		{
			$id = $photo['_id'];
			if (isset($_POST["$id"]))
			{
				unset($_SESSION["$id"]);
			}
		}
		$photos = $db->photos->find();
		$model = [
			'wybrane' => 1,
			'photos' => $photos,
			'numberOfPhotos' => $numberOfPhotos
			];
		return 'main_view';
	}
	return 'redirect:main';
}

function register(&$model)
{
	$db = get_db();
	$photos = $db->photos->find();
	$numberOfPhotos = $db->products->count();
	$registered = 0;
	if(isset($_POST["submit"]) && !empty($_POST["mail"]) && !empty($_POST["login"]) && !empty($_POST["pass"]) && !empty($_POST["repPass"]))
	{
		$login = $_POST["login"];
		$mail = $_POST["mail"];
		$pass = $_POST["pass"];
		$repPass = $_POST["repPass"];
		if ($pass === $repPass && filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
			$hash = password_hash($pass, PASSWORD_DEFAULT);
			$user = [
				'mail' => $mail,
				'login' => $login,
				'password' => $hash
			];
			$db->users->insertOne($user);
			$registered = 1;
			$model = [
				'registered' => $registered,
				'photos' => $photos,
				'numberOfPhotos' => $numberOfPhotos
				];
			return 'main_view';
		}
	}
	$model = [
		'registered' => $registered,
		'photos' => $photos,
		'numberOfPhotos' => $numberOfPhotos
		];
	return 'main_view';
}

function main(&$model)
{
	$tooBig = 0;
	$badType = 0;
	$fileOK = 0;

	if(isset($_POST["submit"]) && !empty($_POST["watermark"]) && !empty($_FILES["zdjecie"]) && !empty($_POST["tytul"]) && !empty($_POST["autor"]))
	{
		$watermarkString = $_POST["watermark"];
		$target_dir = "static/images/";
		$file = $_FILES["zdjecie"];
		$target_file = $target_dir . basename($file["name"]);
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$file_tmp_name = $file['tmp_name'];
		$mime_type = finfo_file($finfo, $file_tmp_name);
		if ($file["size"] > 1048576) 
		{
			$tooBig = 1;
		}
		if($mime_type != "image/jpeg" && $mime_type != "image/png") 
		{
			$badType = 1;
		}
		if ($tooBig == 0 && $badType == 0) 
		{
			if (move_uploaded_file($file["tmp_name"], $target_file)) 
			{
				$fileOK = 1;
				addString($mime_type, $target_file, $watermarkString);
				changeSize($mime_type, $target_file);
				if (isset($_POST["type"]) && $_POST["type"] == "private")
				{
				add_new($target_file, $_POST["tytul"], $_POST["autor"], $_SESSION['user_id']);
				}
				else
				{
				add_new($target_file, $_POST["tytul"], $_POST["autor"], null);
				}
			} 
		}
	}
	if (!empty($_SESSION['user_id']))
	{
		$db = get_db();
		$id = $_SESSION['user_id'];
		$_SESSION['user'] = $db->users->findOne(['_id' => $id]);
	}
	$db = get_db();
	$photos = $db->photos->find();
	$numberOfPhotos = $db->products->count();

	$model = [
		'tooBig' => "$tooBig", 
		'badType' => "$badType", 
		'fileOK' => "$fileOK",
		'photos' => $photos,
		'numberOfPhotos' => $numberOfPhotos
		];

	return 'main_view';
}

function logout(&$model)
{
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 42000,
	$params["path"], $params["domain"],
	$params["secure"], $params["httponly"]
	);
	return 'redirect:main';
}

function login(&$model)
{
	$db = get_db();
	$photos = $db->photos->find();
	$numberOfPhotos = $db->products->count();
	$wrong = 0;
	if(isset($_POST["submit"]) && !empty($_POST["login"]) && !empty($_POST["pass"]))
	{
		$login = $_POST["login"];
		$pass = $_POST["pass"];
		$user = $db->users->findOne(['login' => $login]);
		if($user !== null && password_verify($pass, $user['password']))
		{
			session_regenerate_id();
			$_SESSION['user_id'] = $user['_id'];
			$_SESSION['login'] = $user['login'];
			return 'redirect:main';
		}
		else
		{
			$wrong = 1;
		}
	}
	$model = [
		'wrong' => $wrong,
		'photos' => $photos,
		'numberOfPhotos' => $numberOfPhotos
		];
	return 'main_view';
}

function search(&$model)
{
	$db = get_db();
	$photos = $db->photos->find();
	if (isset($_GET['q']))
	{
		$q = $_GET['q'];
	}
	else 
	{
		$model = [
			'search' => 1
		];
		return 'main_view';
	}
	$matched[] = "";
	if ($q !== "") 
	{
		$q = strtolower($q);
		$len=strlen($q);
		foreach($photos as $photo) 
		{
			$name = $photo['name'];
			if (stristr($q, substr($name, 0, $len))) 
			{
				$matched["$name"] = "$name";
			}
		}
	}
	$photos = $db->photos->find();
	$model = [
		'search' => 1,
		'matched' => $matched,
		'photos' => $photos
	];
	return 'result_view';
}