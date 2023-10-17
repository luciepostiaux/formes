<?php

use Opmvpc\Formes\Canvas;
use Opmvpc\Formes\Point;
use Opmvpc\Formes\Polygone;
use Opmvpc\Formes\Renderers\JPGRenderer;

it('can save a star', function () {
    $canvas = new Canvas(500, 500, '#00FF00');
    $canvas->add(new Polygone([
        new Point(250, 0),
        new Point(300, 200),
        new Point(500, 200),
        new Point(350, 300),
        new Point(400, 500),
        new Point(250, 350),
        new Point(100, 500),
        new Point(150, 300),
        new Point(0, 200),
        new Point(200, 200),
    ], '#FFFF00'));
    $renderer = new JPGRenderer($canvas);

    $renderer->save(__DIR__ . '/img/test.jpg');
    $this->assertFileExists(__DIR__ . '/img/test.jpg');
});
