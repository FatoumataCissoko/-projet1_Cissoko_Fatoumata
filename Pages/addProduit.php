<?php 
if (isset($_POST['ajouter'])){
    $nom=$_POST['nom'];
    $prix=$_POST['prix'];
    $description=$_POST['description'];
    $quantity=$_POST['quantity'];
    if(!empty($nom) && !empty($prix)&& !empty($quantity)&& !empty($description)){
        

       if (isset($_FILES["image"]) && $_FILES["image"]["error"]=== UPLOAD_ERR_OK){
            $image_name=$_FILES["image"]["name"];
            $image_tmp=$_FILES["image"]["tmp_name"];
            $image_destination = "../images/produits". basename($image_name);//chemin de destination de l'image
        
            //verifier que le fichier est une image
            $image_type= strtolower(pathinfo($image_destination,PATHINFO_EXTENSION));
            if (!in_array($image_type,array("jpg","jpeg","png","gif","webp"))) {
                echo "Seules les images jpg,jpeg,png et gif sont autorisees.";
                exit();
                
            }
            //deplacer l'image telecharger vers le dossier specifie
            if (move_uploaded_file($image_tmp,$image_destination)){
                saveProduit($nom,$prix,$quantity,$description,$image_destination);
            }
        } 
      }
    }