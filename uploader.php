<?php
error_reporting(E_ALL);
/**************
* @Author Sulaiman Adewale
* this is a test branch
* @Copyright I don't know


* @Var(string) $name saves the HTML name attribute


* @Var(string) $folder saves the folder of which to save uploaded files

* @var(boolean) $retain_name saves whether to retain the name of the uploaded file, or encode a unique name for every file uploaded   

*/

class Uploader{

private $name,$folder,$retain_name,$allowed_exts,$allowed_types,$max_size;
var $fileUploadErrors = array();
var $files = array();
public function __construct($name,$folder,$retain_name = false)
{
$this->name = $name;
$this->folder = $folder;
$this->retain_name = $retain_name;
}
public function filter_file($max_size = (5 * 1024 * 1024),$allowed_exts = false,$allowed_types = false){//default maximum upload size is set to 5mb

$this->allowed_exts = $allowed_exts ? $allowed_exts : array('jpeg','png','gif','jpg','ico');//if no allowed extension was set, allow only image

$this->allowed_types = $allowed_types ? $allowed_types : array('image/png','image/jpeg','image/jpg','image/ico','image/gif','image/x-png');//if No allowed file types was set, accept only image file types
$this->max_size = $max_size;
}
public function upload($overwrite = false)
{
	if(!isset($this->max_size) || !isset($this->allowed_types) || !isset($this->allowed_exts)){
		$this->fileUploadErrors[] = "Error initializing \"filter_file()\" method.";
		return false;
	}
$num_of_files = count($_FILES["$this->name"]["name"]);//get number of uploaded files 
//check if no file is being uploaded 
if($num_of_files < 1){
	$this->fileUploadErrors[] = "No File was sent";
	return false;
}
for($x = 0; $x < $num_of_files; $x++){//loop through the uploaded files
//GET NECCESSARY INFORMATION FOR VALIDATION
$file_type = $_FILES["$this->name"]['type'][$x];//get the file type
$file_name = $_FILES["$this->name"]['name'][$x];//get the file name
$explode = explode('.',$file_name);
$file_ext = end($explode);//get the extension

$save_name = $this->retain_name ? urlencode($file_name) : substr(md5($file_name.time()),0,10).".".$file_ext;//Checks if to retain name or create a new unique name
//START VALIDATION
if(!file_exists($this->folder)){//Check if folder is existing
$this->fileUploadErrors[] = "File Saving Folder Does Not Exists";
}
if(file_exists($this->folder.$save_name) && !$overwrite){ //check if file already existing
	$this->fileUploadErrors[] = "File already exists; Associated File: ".$file_name; 
}
if(!in_array($file_ext,$this->allowed_exts)) {
  $this->fileUploadErrors[]="Invalid File Extension; Associated File: ".$file_name; 
  }
if(!in_array($file_type,$this->allowed_types)) { 
  $this->fileUploadErrors[]="Invalid File Type; Associated File: ".$file_name; 
  }
if($_FILES["$this->name"]["size"][$x] > $this->max_size){
    $this->fileUploadErrors[] ="File size has exceeded the limit; Associated File: ".$file_name;
  }
if(empty($this->fileUploadErrors)){
    move_uploaded_file($_FILES["$this->name"]['tmp_name'][$x],$this->folder.$save_name);
    $this->files[] = $save_name;
	}
}
if(!empty($this->fileUploadErrors)){
return false;
}else{
return true;
}

}
function get_uploaded_files(){
	if(empty($this->fileUploadErrors)){
		return $this->files;
	}else{
		return false;
	}
}
function get_errors(){
	if(empty($this->fileUploadErrors)){
		return false;
	}else{
		return $this->fileUploadErrors;
	}
}


}

?>
