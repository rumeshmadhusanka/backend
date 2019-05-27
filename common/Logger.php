<?php


class Logger
{
    static $file = "../logfile.txt";

    public function log($msg)
    {
        $dateTime = date("d/m/Y H:i:s",time());
        error_log($msg.",".$dateTime."\n", 3, Logger::$file);
    }
}

$l = new Logger();
$l->log("This is a log");
