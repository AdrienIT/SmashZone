<?php
include_once '../config.php';
session_start();
if (!isset($_SESSION["user_id"])) {
    header('location: index.php');
}
$id = (int) $_SESSION["user_id"];

$query = $db->prepare("SELECT * FROM users WHERE user_id = :id ");
$query->bindParam(":id", $id);
$query->execute();
$user = $query->fetch();

$pseudo = $user["pseudo"];

?>

<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $imageinfo = getimagesize($_FILES['file']['tmp_name']);

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('png');

    $path = "./" . $pseudo . "/";

    if (in_array($fileActualExt, $allowed)) {
    }
    if ($fileError === 0) {
        if ($fileSize < 500000) {
            $fileNameNew = $pseudo . "." . $fileActualExt;
            $fileDestination = $path . $fileNameNew;
            if (!is_dir($path)) {
                mkdir($path, 0700);
                move_uploaded_file($fileTmpName, $fileDestination);
                echo "<pre>File uploaded with success !</pre>";
            } else {
                move_uploaded_file($fileTmpName, $fileDestination);
                echo "<pre>File uploaded with success !</pre>";
            }
        } else {
            die('Fichier trop volumineux');
        }
    } else {
        die("Erreur pendant l'upload");
    }
} else {
    die('Fichier avec une mauvaise extension');
}

?>

<a href="home.php">retour</a>