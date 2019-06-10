<?php

use App\classes\common\Point;
use App\Triangle;
use App\classes\common\RectD;
use App\Rectangle;

$triangle = new Triangle(new Point(20, 20), new Point(40, 40), new Point(60, 70));

$wall = new Rectangle(new Point(0, 120), 300, 300)