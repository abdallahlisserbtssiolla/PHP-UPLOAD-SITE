<?php
function redirect($url) {
    header("Location: $url");
    exit();
}

if(isset($_FILES['fichier']) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = './'; 
    $uploadFile = $uploadDir . basename($_FILES['fichier']['name']);
    $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    if($fileType === 'pdf') {
        if(move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadFile)) {
            redirect('succes.php');
        } else {
            redirect('erreur.php');
        }
    } else {
        redirect('erreur.php');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Télécharger un fichier PDF</title>
</head>
<body>
    <h2>Upload de fichier PDF</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="fichier" accept=".pdf" required>
        <input type="submit" value="Télécharger">
    </form>
</body>
</html>
