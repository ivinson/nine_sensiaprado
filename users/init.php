<?php 
require_once 'classes/class.autoloader.php';
session_start();

$abs_us_root = $_SERVER['DOCUMENT_ROOT'];

$self_path = explode("/", $_SERVER['PHP_SELF']);
$self_path_length = count($self_path);
$file_found = FALSE;

for ($i = 1; $i < $self_path_length; $i++) {
	array_splice($self_path, $self_path_length - $i, $i);
	$us_url_root = implode("/", $self_path) . "/";

	if (file_exists($abs_us_root . $us_url_root . 'z_us_root.php')) {
		$file_found = TRUE;
		break;
	} else {
		$file_found = FALSE;
	}
}

require_once $abs_us_root . $us_url_root . 'users/helpers/helpers.php';

// Set config
$GLOBALS['config'] = array(
	'mysql'      => array(
		'host'         => '108.179.193.178; port=3306',
		// 'host'         => 'localhost; port=3306',
		'username'     => 'even3314_ram',
		'password'     => 'VXqfkzW$_+Ygi8Wv@]',
		'db'           => 'even3314_ram',
		// 'host'         => 'localhost; port=3306',
		// 'username'     => 'root',
		// 'password'     => '',
		// 'db'           => 'votorantim',
	),
	'remember'        => array(
		'cookie_name'   => 'nNktJ3v30N1duj20wHu',
		'cookie_expiry' => 604800  //One week, feel free to make it longer
	),
	'session' => array(
		'session_name' => 'LKvUV2MCpMQgfpZ0WbmS',
		'token_name' => 'token',
	)
);

//If you changed your UserSpice or UserCake database prefix
//put it here.
$db_table_prefix = "uc_";  //Old database prefix

//adding more ids to this array allows people to access everything, whether offline or not. Use caution.
$master_account = [1];

$currentPage = currentPage();

//Check to see if user has a remember me cookie
if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->query("SELECT * FROM users_session WHERE hash = ? AND uagent = ?", array($hash, Session::uagent_no_version()));

	if ($hashCheck->count()) {
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}
}

//Check to see that user is logged in on a temporary password
$user = new User();

//Check to see that user is verified
if ($user->isLoggedIn()) {
	if ($user->data()->email_verified == 0 && $currentPage != 'verify.php' && $currentPage != 'logout.php' && $currentPage != 'verify_thankyou.php') {
		Redirect::to($us_url_root . 'users/verify.php');
	}
}

require_once $abs_us_root . $us_url_root . "users/includes/loader.php";
$timezone_string = 'America/Sao_Paulo';
date_default_timezone_set($timezone_string);
