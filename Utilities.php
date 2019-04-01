<?php declare(strict_types=1);
require_once 'Database.php';
abstract class Utilities
{
static public function encrypt(string $str):string {
    $passHash=hash("sha512",$str);
    return $passHash;
}
static public function log_out(){
    //Close the database connection
    Database::close_connection();
// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

// Finally, destroy the session.
    if (isset($_SESSION)){
    session_destroy();
    }
}

static public function html_escape($str):string {
    return htmlspecialchars($str);
}

}

