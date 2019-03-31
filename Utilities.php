<?php declare(strict_types=1);

abstract class Utilities
{
static public function encrypt(string $str):string {
    $passHash=hash("sha512",$str);
    return $passHash;
}

}
