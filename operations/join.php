<?php

require_once 'from.php';

function joinx(array $fromTable, array $joinTable, array $fromHeader, array $joinHeader)
{

    $fromDB = formatTableToDb($fromTable,$fromHeader);
    $joinDB = formatTableToDb($joinTable,$joinHeader);
    //print_r($fromDB);
    //print_r($joinDB);
    foreach($joinDB as $rowKey => $row){
        if($rowKey[0] == 'i' && $rowKey[1]=='d') {
            if(isset($joinDB[$rowKey]) && !isset($fromDB[$rowKey])) {
                unset($joinDB[$rowKey]);
            }
        }
    }


    return array_merge_recursive(
        $fromDB,
        $joinDB
    );

}