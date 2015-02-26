<?php
set_time_limit(0);
function zip($dir,$filename,$missfile=array(),$addfromString=array()){
	if(!file_exists($dir) || !is_dir($dir)){
		die(' can not exists dir '.$dir);
	}
	if(strtolower(end(explode('.',$filename))) != 'zip'){
		die('only Support zip files');
	}
	$dir = str_replace('\\','/',$dir);
	$filename = str_replace('\\','/',$filename);
	if(file_exists($filename)){
		die('the zip file '.$filename.' has exists !');
	}
	$files = array();
	getfiles($dir,$files);
	if(empty($files)){
		die(' the dir is empty');
	}

	$zip = new ZipArchive;
	$res = $zip->open($filename, ZipArchive::CREATE);
	if ($res === TRUE) {
		foreach($files as $v){
			if(!in_array(str_replace($dir.'/','',$v),$missfile)){
				$zip->addFile($v,str_replace($dir.'/','',$v));
				//$zip->addFile($v,str_replace($dir.'/','./',$v));
			}
		}
		if(!empty($addfromString)){
			foreach($addfromString as $v){
				$zip->addFromString($v[0],$v[1]);
			}
		}
		$zip->close();
		//echo 'unsigin apk ok!<br>';
	} else {
		echo 'failed';
	}
}

function getfiles($dir,&$files=array()){
	if(!file_exists($dir) || !is_dir($dir)){return;}
	if(substr($dir,-1)=='/'){
		$dir = substr($dir,0,strlen($dir)-1);
	}
	$_files = scandir($dir);
	foreach($_files as $v){
		if($v != '.' && $v!='..'){
			if(is_dir($dir.'/'.$v)){
				getfiles($dir.'/'.$v,$files);
			}else{
				$files[] = $dir.'/'.$v;
			}
		}
	}
	return $files;
}

function file_content_replace($filename, $search, $replace){
    $string = file_get_contents($filename);
    $new_string = str_replace($search, $replace, $string);
    if($string !=$new_string) file_put_contents($filename, $new_string);
}

function goapk ($file){
	exec("del bbshenqi.zip");
	exec("del bbshenqi.apk");
	exec("del gosign.bat");
	exec("del D:\android\apk\bbshenqi\assets\unionid.txt");
	exec("copy /Y demo.bat gosign.bat");
	file_content_replace("gosign.bat","00000.apk",$file.'.apk');
	exec('echo '.$file.'>D:\android\apk\bbshenqi\assets\unionid.txt');
	zip("bbshenqi", "bbshenqi.zip");
	exec("copy /Y bbshenqi.zip bbshenqi.apk");
	exec("gosign.bat");
}
if($_GET['apkname']){
	$name = $_GET['apkname'];	
	$r= $_GET['r'];	
	if($r=='yourpass'){
		goapk($name);
		echo 'ok';
	}

}
exit;

?>