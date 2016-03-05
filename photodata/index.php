<?php include_once('photodata.php');?>
<html>
<head>
    <title>Photo exif viewer</title>
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="script.js"></script>
    <script src="sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="sweetalert/dist/sweetalert.css">
</head>

<body>
    <h1>Photo Data Viewer</h1>

    <form action="photodata.php" method="POST" enctype="multipart/form-data">
        <input name="file" type="file"/>
        <input type="submit">
        <small>Accepted file formats : .jpg</small>
    </form>

    <div class="image-container">
        <!--Omit unix directories '.' and '..'-->
        <?php foreach(array_diff(scandir('images'), ['.', '..']) as $file):?>
            <?php $file = "images/$file";?>
            <section>
                <?php $data = (exif_read_data($file, 0, true));?>
                <h1><?php echo htmlspecialchars($data['FILE']['FileName']);?></h1>
                <a href="<?php echo $file?>">
                    <img src="<?php echo $file?>">
                </a>
                <h3>Data</h3>
                <div class="data">
                    <?php foreach ($data as $key => $section):?>
                        <?php foreach ($section as $name => $value):?>
                            <p>
                              <span class="key"><?php echo $name?></span>:
                              <span class="value"><?php echo $value;?></span>
                            </p>
                        <?php endforeach;?>
                    <?php endforeach;?>
                </div>
                <div href="#" class="delete-button">Delete</div>
            </section>
        <?php endforeach;?>
    </div>

</body>
</html>
