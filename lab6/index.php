<?php
    require_once 'vendor/autoload.php';

    echo "Should we use new API (y)?";
    $clientInput = readline();

    use function app\paintPictureOnCanvas;
    use function app\paintPictureOnModernGraphicsRenderer;

    if ($clientInput && $clientInput == "y" || $clientInput == "Y")
    {
        paintPictureOnModernGraphicsRenderer();
    }
    else
    {
        paintPictureOnCanvas();
    }
