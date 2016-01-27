<?php 

class Resty {

    /**
     * Upload the file to the images directory
     */
    function post_upload_file() 
    {
        if ($_FILES) {
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
$r->call();
?>
