<?php

namespace Opmvpc\Formes\Renderers;

use Opmvpc\Formes\Canvas;
use Opmvpc\Formes\Rectangle;
use Opmvpc\Formes\Cercle;
use Opmvpc\Formes\Ligne;
use Opmvpc\Formes\Polygone;
use SVG\Nodes\Shapes\SVGCircle;
use SVG\Nodes\Shapes\SVGLine;
use SVG\Nodes\Shapes\SVGPolygon;
use SVG\Nodes\Shapes\SVGRect;
use SVG\SVG;

class SVGRenderer implements Renderer
{
    protected Canvas $canvas;

    public function __construct(Canvas $canvas)
    {
        $this->canvas = $canvas;
    }

    public function render(): string
    {
        $image = $this->getImage();
        return $image->toXMLString();
    }
    protected function getImage()
    {
        $image = new SVG($this->canvas->getWidth(), $this->canvas->getHeight());
        $doc = $image->getDocument();
        $square = new SVGRect(0, 0, $this->canvas->getWidth(), $this->canvas->getHeight());
        $doc->setStyle('fill', $this->canvas->getCouleur());
        $doc->addChild($square);

        foreach ($this->canvas->getFormes() as $forme) {
            if (get_class($forme) === Rectangle::class) {
                $rectangle = new SVGRect($forme->getPoint()->getX(), $forme->getPoint()->getY(), $forme->getWidth(), $forme->getHeight());
                $rectangle->setStyle('fill', $forme->getCouleur());
                $doc->addChild($rectangle);
            } elseif (get_class($forme) === Cercle::class) {
                $cercle = new SVGCircle($forme->getCentre()->getX(), $forme->getCentre()->getY(), $forme->getRayon());
                $cercle->setStyle('fill', $forme->getCouleur());
                $doc->addChild($cercle);
            } elseif (get_class($forme) === Ligne::class) {
                $ligne = new SVGLine($forme->getPoint1()->getX(), $forme->getPoint1()->getY(), $forme->getPoint2()->getX(), $forme->getPoint2()->getY());
                $ligne->setStyle('fill', $forme->getCouleur());
                $doc->addChild($ligne);
            } elseif (get_class($forme) === Polygone::class) {
                $pointsArray = $forme->getPoints();
                $pointsNouvelArray = [];
                foreach ($pointsArray as $point) {
                    $pointStringX = $point->getX();
                    $pointStringY = $point->getY();
                    $pointsNouvelArray[] = [$pointStringX, $pointStringY];
                }
                $polygone = new SVGPolygon($pointsNouvelArray);
                $polygone->setStyle('fill', $forme->getCouleur());
                $doc->addChild($polygone);
            }
        }
        return $image;
    }

    public function save(string $path): void
    {
        file_put_contents($path, $this->render());
    }
}
