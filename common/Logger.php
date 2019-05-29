<?php


class Logger
{
    private static $file = "../logfile.txt";

    public function log($msg)
    {
        $dateTime = date("d/m/Y H:i:s",time());
        error_log($msg.",".$dateTime."\n", 3, Logger::$file);
    }
}

