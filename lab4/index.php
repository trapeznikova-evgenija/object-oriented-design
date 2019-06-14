<?php
    require_once 'vendor/autoload.php';
    use App\{Designer, ShapeFactory, Canvas, Painter, Client};

    $canvas = new Canvas();
    $painter = new Painter();
    $factory = new ShapeFactory();
    $designer = new Designer($factory);
    $client = new Client($canvas);

    $client->getPictureDraft($designer);
    $client->drawPictureOnCanvas($painter);

    $canvas->getSvgFile();


    