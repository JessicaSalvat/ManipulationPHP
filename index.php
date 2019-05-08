<?php include('inc/head.php'); ?>

<?php

if(isset($_POST["content"])){
    $file = "files/roswell".$_POST["file"];
    $file= fopen($file, "w");
    fwrite($file,($_POST["content"]));
    fclose($file);
}
?>

    <div class="content">
        <h1 style="font-size: 30px; text-align: center;">Choose the page you wish to edit</h1>
        <?php
        $dir= opendir("files/roswell");
        while($file = readdir($dir)){
            if(!in_array($file,array(".",".."))) {
                echo '<div style="text-align: center;"><a href="?f='.$file.'">';
                echo $file;
                echo '</a></div>';
            }
            if (isset($_POST['delete'])) {
                unlink("files/roswell/" . $_GET['f']);
                header('location: index.php');
            }
        }

        if(isset($_GET["f"])){
            echo "<h1 style='font-size: 25px;'>{$_GET["f"]}</h1>";
            $file = "files/roswell/".$_GET["f"];
            $content = file_get_contents($file);


            ?>

            <form method="POST" action="index.php">

 <textarea name="contenu" style="width:100%;height:200px">
 <?php echo $content; ?>
 </textarea>
                <input type="hidden" name="file" value="<?= $_GET["f"] ?> ">
                <input type="submit" value="Envoyer"/>
                <input type="submit" class="btn-danger btn-md" name="delete" value="Delete">


            </form>

            <?php
        }
        ?>

    </div>

<?php include('inc/foot.php'); ?>