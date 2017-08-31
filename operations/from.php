<?php

require_once 'index.php';

function getOption()
{

    if (php_sapi_name() === "cli") {
        $availableOptions = file(BASE_DIR . "/options.txt", FILE_IGNORE_NEW_LINES);
        $option = getopt("", $availableOptions);
        return $option;
    } else{
        return $_POST;
    }


}

function extractHeader(&$table)
{
    return array_shift($table);
}

function validate($fileName)
{
    if(!file_exists("/var/www/mysql/database/$fileName")){
        echo "nu exista fisierul respectiv ";
    }
}

function readFromFile($fileName)
{
    $filePath = sprintf('%s/database/%s.csv', BASE_DIR, $fileName);
    $handle = fopen($filePath, "r");
    $lines = [];
    while(($line = fgetcsv($handle)) != FALSE) {
        $lines[] = $line;
    }

    fclose($handle);

    return $lines;
}

function formatTableToDb($table, $header)
{
    $idIndex = takeId($header);
    $db = [];
    foreach ($table as $row)
    {
        foreach ($row as $cellKey => $cellValue) {
            if($cellKey != $idIndex) {
                if(!isset($db["id: ".$row[$idIndex]][$header[$cellKey]]))
                {
                    $db["id: " . $row[$idIndex]][$header[$cellKey]] = $cellValue;
                }
                else if(is_array($db["id: " . $row[$idIndex]][$header[$cellKey]]))
                {
                    array_push($db["id: " . $row[$idIndex]][$header[$cellKey]],$cellValue);
                }
                else
                {
                    $temp=array();
                    array_push($temp,$db["id: " . $row[$idIndex]][$header[$cellKey]]);
                    array_push($temp,$cellValue);
                    $db["id: " . $row[$idIndex]][$header[$cellKey]]=$temp;
                }
            }
        }
    }

    return $db;
}

function takeId(array $header)
{
    return array_search('user_id', $header);
}







