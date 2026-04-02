<?php
$uploadDir = 'uploads/';
$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
$allowedTypes = ['jpg', 'jpeg', 'png'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileToUpload'])) {
    
    // Memeriksa apakah file benar-benar gambar
    $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
    
    if ($check !== false && in_array($imageFileType, $allowedTypes)) {
        
        $files = glob($uploadDir . "*");
        $highestNumber = 0;
        
        foreach ($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            if (is_numeric($filename) && $filename > $highestNumber) {
                $highestNumber = (int)$filename;
            }
        }
        
        $newFileName = ($highestNumber + 1) . "." . $imageFileType;
        $targetFile = $uploadDir . $newFileName;
        
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
            echo "File uploaded successfully as " . $newFileName;
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "File is not a valid image format/allowed.";
    }
}
?>