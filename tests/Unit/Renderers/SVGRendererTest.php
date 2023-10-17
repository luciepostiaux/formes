<?php

use Opmvpc\Formes\Canvas;
use Opmvpc\Formes\Cercle;
use Opmvpc\Formes\Ligne;
use Opmvpc\Formes\Point;
use Opmvpc\Formes\Polygone;
use Opmvpc\Formes\Rectangle;
use Opmvpc\Formes\Renderers\SVGRenderer;

it('can render a canvas', function () {
    $canvas = new Canvas(500, 500);
    $renderer = new SVGRenderer($canvas);

    $this->assertEquals('<?xml version="1.0" encoding="utf-8"?><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="500" height="500" style="fill: #FFFFFF"><rect x="0" y="0" width="500" height="500" /></svg>', $renderer->render());
});

it('can render a canvas with a line', function () {
    $canvas = new Canvas(500, 500);
    $canvas->add(new Ligne(new Point(1, 1), new Point(1, 500)));
    $renderer = new SVGRenderer($canvas);

    $this->assertEquals('<?xml version="1.0" encoding="utf-8"?><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="500" height="500" style="fill: #FFFFFF"><rect x="0" y="0" width="500" height="500" /><line x1="1" y1="1" x2="1" y2="500" style="fill: #000000" /></svg>', $renderer->render());
});

it('can render a canvas with a line and a rectangle', function () {
    $canvas = new Canvas(500, 500);
    $canvas->add(new Ligne(new Point(1, 1), new Point(1, 500)));
    $canvas->add(new Rectangle(new Point(50, 50), 250, 400));
    $renderer = new SVGRenderer($canvas);

    $this->assertEquals('<?xml version="1.0" encoding="utf-8"?><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="500" height="500" style="fill: #FFFFFF"><rect x="0" y="0" width="500" height="500" /><line x1="1" y1="1" x2="1" y2="500" style="fill: #000000" /><rect x="50" y="50" width="250" height="400" style="fill: #000000" /></svg>', $renderer->render());
});

it('can render a canvas with a line, a rectangle and a circle', function () {
    $canvas = new Canvas(500, 500);
    $canvas->add(new Ligne(new Point(1, 1), new Point(1, 500), '#0000FF'));
    $canvas->add(new Rectangle(new Point(50, 50), 250, 400, '#FF0000'));
    $canvas->add(new Cercle(new Point(250, 250), 150, '#00FF00'));

    $renderer = new SVGRenderer($canvas);

    $this->assertEquals('<?xml version="1.0" encoding="utf-8"?><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="500" height="500" style="fill: #FFFFFF"><rect x="0" y="0" width="500" height="500" /><line x1="1" y1="1" x2="1" y2="500" style="fill: #0000FF" /><rect x="50" y="50" width="250" height="400" style="fill: #FF0000" /><circle cx="250" cy="250" r="150" style="fill: #00FF00" /></svg>', $renderer->render());
});

it('can render a red triangle', function () {
    $canvas = new Canvas(500, 500);
    $canvas->add(new Polygone([
        new Point(1, 1),
        new Point(1, 500),
        new Point(500, 500),
    ], '#FF0000'));
    $renderer = new SVGRenderer($canvas);

    $this->assertEquals('<?xml version="1.0" encoding="utf-8"?><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="500" height="500" style="fill: #FFFFFF"><rect x="0" y="0" width="500" height="500" /><polygon points="1,1 1,500 500,500" style="fill: #FF0000" /></svg>', $renderer->render());
});

it('can render a yellow star', function () {
    $canvas = new Canvas(500, 500);
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
    $renderer = new SVGRenderer($canvas);

    $this->assertEquals('<?xml version="1.0" encoding="utf-8"?><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="500" height="500" style="fill: #FFFFFF"><rect x="0" y="0" width="500" height="500" /><polygon points="250,0 300,200 500,200 350,300 400,500 250,350 100,500 150,300 0,200 200,200" style="fill: #FFFF00" /></svg>', $renderer->render());
});

it('can save svg in file', function () {
    $canvas = new Canvas(500, 500, '#00FFFF');
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
    $renderer = new SVGRenderer($canvas);

    $renderer->save(__DIR__ . '/img/test.svg');
    $this->assertFileExists(__DIR__ . '/img/test.svg');
});
