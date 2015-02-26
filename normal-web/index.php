<?php
/*
 * Created on 2012-5-21
 * coolaj.cn
 */

// var_dump($id);

    function cocode() {

         foreach($_GET as $k=>$v){
            $id = $k;
            break;
         }
         if($_GET['u']){
            $id=$_GET['u'];
         }
        if(is_numeric($id)){
            return $id;
        }elseif ($id && preg_match('/^U/', $id)) {  
            $id = base64_decode(substr($id,1).'=')>>2;
            return $id;
        }
    }

    $id = cocode();

    if(file_exists('bbshenqi'.$id.".apk") || empty($id)){
        if(empty($id)){
            header('Location: http://www.kinglion.com/bbshenqi.apk');
            exit;
        }
        header('Location: http://down.kinglion.com/bbshenqi'.$id.'.apk');
    }else{
        $cc =file_get_contents("http://make.coolaj.cn/makeapk.php?apkname=".$id.'&r=简单加密');
        if($cc == 'ok'){
            if(file_exists('bbshenqi'.$id.".apk")){
                echo '<meta http-equiv="content-type" content="text/html; charset=gbk" />';
                echo '<a href="http://down.coolaj.cn/bbshenqi'.$id.'.apk">生成失败，点击重试</a>';
                exit;
            }
            header('Location: http://down.coolaj.cn/bbshenqi'.$id.'.apk');
        }
     }

?>