<?php

namespace App;

use shapeException\ShapeException;

class Designer implements DesignerInterface
{
    private $shapeFactory;

    public function __construct(ShapeFactory $shapeFactory)
    {
        $this->shapeFactory = $shapeFactory;
    }

    public function createDraft(): PictureDraft
    {
        self::printHelp();
        $pictureDraft = new PictureDraft();

        for (;;)
        {
            $clientInput = readline();

            if ($clientInput == "exit")
            {
                break;
            }

            try
            {
                $shape = $this->shapeFactory->createShape($clientInput);
                $pictureDraft->addShapeInBox($shape);
            }
            catch (ShapeException $exception)
            {
                echo $exception->getMessage() . PHP_EOL;
                break;
            }
        }

        return $pictureDraft;

    }

    private function printHelp()
    {
        echo "--Help--" . PHP_EOL;
        echo "--Enter to exit-- exit" . PHP_EOL;
        echo "Permission colors: green, red, blue, yellow, pink, black" . PHP_EOL;
        echo "To specify the desired shape, enter:" . PHP_EOL;
        echo "rectangle /color name/ /leftTop X/ /leftTop Y/ /rightBottom X/ /rightBottom Y/" . PHP_EOL;
        echo "triangle /color name/ /vertex1 X/ /vertex1 Y/ /vertex2 X/ /vertex2 Y/ /vertex3 X/ /vertex3 Y/" . PHP_EOL;
        echo "ellipse /color name/ /center X/ /center Y/ /horizontal radius/ /vertical radius/" . PHP_EOL;
        echo "polygon /color name/ /vertex count/ /center X/ /center Y/ /radius/" . PHP_EOL;
    }
}