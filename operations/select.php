<?php
require_once '/var/www/mysql/output/Table.php';
if (php_sapi_name() === "cli") {
    function select($db, $columns)
    {
        $tbl = new Console_Table();
        $tbl->setHeaders(
            $columns);


        //print_r($db);
        foreach ($db as $row) {
            //print_r($row);
            $temp = array();
            foreach ($columns as $col) {
                if (array_key_exists($col, $row)) {

                    if (is_array($row[$col])) {

                        array_push($temp, implode(',', $row[$col]));
                    } else {
                        array_push($temp, $row[$col]);
                    }


                }

            }

            $tbl->addRow($temp);


            echo PHP_EOL;
        }
        echo $tbl->getTable();
    }
} else {
    function select($db, $columns)
    {
        //print_r($db);
        foreach ($db as $row) {
            //print_r($row);
            $temp = array();
            foreach ($columns as $col) {
                if (array_key_exists($col, $row)) {

                    if (is_array($row[$col])) {

                        array_push($temp, implode(',', $row[$col]));
                    } else {
                        array_push($temp, $row[$col]);
                    }


                }

            }

            echo $temp[0];

            echo PHP_EOL;
        }


    }
}