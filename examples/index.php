
<?php
//include the fileuploader plugin
include("../uploader.php");


if($_POST){
$uploader = new Uploader("myIMG","file-contents/",true);//the third argument saves whether to retain the file name or create a unique name for each file uploaded 
$uploader->filter_file();//this function accepts three "array" arguments(maximum upload size,Allowed file extensions and Allowed file types(MIME)),  if left empty, would accepts only images, note: this method must be declared else an error will be thrown 
$uploader->upload(true);//this accepts boolean argument, saves whether to overwrite an existing file, return true on successful upload and false vise-versa 
print_r($uploader->get_errors()); //this return an array containing all errors encountered during upload, returns true if there was an error, returns false if no error was encountered 
print_r($uploader->get_uploaded_files());//this returns the array list of all successfully uploaded files, return false if no file was uploaded
}

?>

<br>
<br>
<form action="#" method="POST" enctype="multipart/form-data">
<input type="file" name="myIMG[]" multiple>
<br>
<br>
<input type="submit" name="submit" value="Submit and Debugg">
</form>
