<?php
    if(isset($_FILES['userfile'])){
        $img = $_FILES['userfile'];
        $q = $_POST['q']; 
        $angle = $_POST['angle'];
       
        
        //print_r($img);
/*       if($img['type'] = '/Applications/XAMPP/xamppfiles/temp/name.jpg') {
            exit("К загрузке принимаются только jpeg");
        }*/
        
        if($img['size'] > 3000000){
            exit("Размер изображения не должен превышать 3 Мб");
        }

        move_uploaded_file($img["tmp_name"],        "/Applications/XAMPP/xamppfiles/htdocs/picture/img/{$img['name']}");
        
        $size = getimagesize("/Applications/XAMPP/xamppfiles/htdocs/picture/img/img.jpeg");
        $w = $q*$size[0];
        $h = $q*$size[1];

        $img1 = imagecreatefromjpeg("img/{$img['name']}");
        $img2 = imagecreatetruecolor($w,$h);
        imagecopyresized($img2,$img1,0,0,0,0,$w,$h,$size[0],$size[1]);
        
        $white = imagecolorallocate($img2, 255, 250, 250);
        $rotate = imagerotate($img2,$angle,$white);
        
        imagejpeg($rotate, './img/$img2.jpg');
        header("Content-type: image/jpeg");
        imagejpeg($rotate); 
    }
?>