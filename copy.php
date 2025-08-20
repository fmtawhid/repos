<?php
$fp = fopen('./change-list.txt', 'r');

while($file = rtrim(fgets($fp))){
    echo "read: ".$file . '<br />';
    if(file_exists($file)){
        echo "found: ".$file . '<br />';
        $update_file = 'update/'.$file;
        if (@mkdir($concurrentDirectory = dirname($update_file), 0777, true) || is_dir($concurrentDirectory)) {
            if(copy($file, $update_file)){
                echo "copied ".$file . '<br />';
            } else{
                echo "not copy: ".$file . '<br />';
            }
        } else{
            echo "mkdir error: ".$file . '<br />';
        }
    } else{
        echo "not found: ".$file . '<br />';
    }
}
fclose($fp);