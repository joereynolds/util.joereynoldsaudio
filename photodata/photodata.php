<?php 

class Resty {

    function __construct(){
        $this->create_image_directory();
        $this->call();
    }

    function create_image_directory()
    {
        $directory = 'images';
        if (!file_exists($directory)) {
            mkdir($directory);
        }
    }
    /**
     * Upload the file to the images directory
     */
    function post_upload_file() 
    {
        $max_filesize = 2000000;
        if ($_FILES) {
            if ($_FILES['file']['size'] > $max_filesize) {
                return;
            }
            $filename = $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], "images/$filename");
        }
    }

    /**
     * wrapper for request types
     */
    function call() 
    {
        if ($_POST['method'] === 'delete') {
            $this->delete_file($_POST['name']);
            header('Location: index.php');
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->post_upload_file();
            header('Location: index.php');
        } 
    }

    function delete_file($fileName) 
    {
        unlink("images/$fileName");
    }
}

$r = new Resty();
?>
