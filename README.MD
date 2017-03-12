#PHP UPLOADER

*php_uploader* is a light weight, customizable, fast and secure PHP framework with two layer file validation, it was intended to ease the task of file upload to the server using PHP.

*php_uploader* supports multiple file upload

*php_uploader* is straight forward and easy to use 

##HOW TO USE

To use php_uploader framework, you first include the framework at the top of your script

Example:
```
include("php_uploader/uploader.php");
```

###Then initialize the upload class

```
$upload = new Uploader("myIMG","file-contents/",true);
``

The first argument in the *Uploader* class takes the name of the HTML "*name*" attribute of your HTML form, the second argument takes the folder of which the uploaded file will be saved in while the third argument saves whether to retain the file name or create a unique name for each file uploaded.

###After initialization, then declare the file filtration 

To filter the file from users you will need to include the *filter_file()* method.

###EXAMPLE
```
$max_size = (5 * 1024 * 1024);//5MB in bytes
$accepted_exts = array('jpeg','png','gif','jpg','ico');//array of accepted extensions
$accepted_types = array('image/png','image/jpeg','image/jpg','image/ico','image/gif','image/x-png');//array of accepted file types(MIME)

$upload->filter_file($max_size,$accepted_exts,$accepted_types);
```
The *filter_file()* Accepts three arguments, first saves the maximum file size(in bytes), the second saves the saves extensions(in array) while the third saves the valid file type/MIME (in array)

*NOTE: if no filtration is done, you must declare the filter_file() method, but leave empty, if left empty the uploader will accept only image file only*

###After filtration, then the file needs to be validated and sent to the server

To begin file upload, you need to declare the *upload()* method

###EXAMPLE
```
$upload->upload(true);
```
*upload()* method has one boolean argument which saves whether to overwrite an existing file. returns true on successful upload and false vise-versa

##OTHER AVAILABLE METHODS

*get_errors()* -- returns arrays all errors that occurred during execution and validation, returns false if no error was found



###EXAMPLE
```
foreach($upload->get_errors() as $error){
	echo $error."<br>";
}
```

*get_uploaded_files()* -- returns the array of all files uploaded files, returns false if no file was uploaded

###EXAMPLE
```
foreach($upload->get_uploaded_files() as $error){
	echo $error."<br>";
}
```
