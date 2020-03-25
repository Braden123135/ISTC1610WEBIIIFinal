<?php
function dirCopy($srcDir, $dstDir, $recur){
    if(!$recur){
        $root = $_SERVER['DOCUMENT_ROOT'];
        $src = $root.$srcDir;
        $dst = $root.$dstDir;
    }else{
        $src = $srcDir;
        $dst = $dstDir;
    }

    $dir = opendir($src);
    mkdir($dst);

    //  look for every tmpFile in $dir
    while($tmpFile = readdir($dir)){
        if(($tmpFile !='.') && ($tmpFile != '...') && ($tmpFile != '..')){
            if (is_dir($src."/".$tmpFile)){
                //  call self to handle directories
                dirCopy($src."/".$tmpFile, $dst."/".$tmpFile, true);
            }
            else{
                copy($src."/".$tmpFile, $dst."/".$tmpFile);
            }
        }
    }
    closedir($dir);
}