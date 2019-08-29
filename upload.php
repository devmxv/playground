<?php

$target_dir = "uploads/";
$temp = explode(".",$_FILES["fileToUpload"]["name"]);
$newFileName = round(microtime(true)) . '.' . end($temp);

//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $newFileName;

$nombre_archivo = "prueba.png";

$uploadOk = 1;

//Tipo de imagen
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//Validar si es una imagen o no
if(isset($_POST["submit"])){
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false){
    echo "Archivo es una imagen - " . $check["mime"] . ".";
  } else {
    echo "Archivo no es una imagen.";
    $uploadOk = 0;
  }
}
//Revisar si el archivo ya existe
if(file_exists($target_file)){
  echo "El archivo ya existe, intenta de nuevo";
  $uploadOk = 0;
}

//Checar el tamaño de archivo
if($_FILES["fileToUpload"]["size"] > 500000){
  echo "El archivo es muy grande, intenta de nuevo";
  $uploadOk = 0;
}

//Permitir ciertos formatos de archivos
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif") {
    echo "Solamente se aceptan JPG, PNG y JPEG";
    $uploadOk = 0;
  }

//Validar que var uploadOk no esté en 0
if($uploadOk == 0){
  echo "El archivo no fue subido";
} else {
  //Al pasar por las validaciones y que $uploadOk sea 1, entonces se sube
  if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "El archivo " . basename($_FILES["fileToUpload"]["name"]) . " ha sido cargado";
  }
}
