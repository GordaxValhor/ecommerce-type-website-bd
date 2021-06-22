<?php
    //sudo apt-get install php-imagick;
    //print_r(get_loaded_extensions());
    function resizeImage($imagePath, $width, $height, $filterType, $blur, $bestFit, $cropZoom) {
        //The blur factor where > 1 is blurry, < 1 is sharp.
        $imagick = new \Imagick(realpath($imagePath));
    
        $imagick->resizeImage($width, $height, $filterType, $blur, $bestFit);
    
        $cropWidth = $imagick->getImageWidth();
        $cropHeight = $imagick->getImageHeight();
    
        if ($cropZoom) {
            $newWidth = $cropWidth / 2;
            $newHeight = $cropHeight / 2;
    
            $imagick->cropimage(
                $newWidth,
                $newHeight,
                ($cropWidth - $newWidth) / 2,
                ($cropHeight - $newHeight) / 2
            );
    
            $imagick->scaleimage(
                $imagick->getImageWidth() * 4,
                $imagick->getImageHeight() * 4
            );
        }
    
    
        header("Content-Type: image/jpg");
        echo $imagick->getImageBlob();
    }
    //resizeImage(320,240,Imagick::FILTER_LANCZOS,1);
    $thumb = new Imagick('./31_1.jpeg');
    //$thumb->resizeImage(320,240,Imagick::FILTER_LANCZOS,1);
    $thumb->scaleImage(920, 900, true);
    echo '<img src="data:image/jpg;base64,'.base64_encode($thumb->getImageBlob()).'" alt="" />';
    echo '<img src="data:image/jpg;base64,'.base64_encode($thumbnail).'" alt="" />';
    if(file_put_contents ("test_1.jpg", $thumb))
    {
        echo "yes";
    }
    else {
        echo "no";
    }
    //echo $thumbnail;

?>