<?php
    require_once 'vendor/autoload.php';

    echo "Should we use new API (y)?";
    $clientInput = readline();

    if ($clientInput && $clientInput == "y" || $clientInput == "Y")
    {
        app\paintPictureOnModernGraphicsRenderer();
    }
    else
    {
        app\paintPictureOnCanvas();
    }
