<?php

namespace Opmvpc\Formes;

class Rectangle extends Forme
{

    private Point $point;
    private float $width;
    private float $height;

    public function __construct(Point $point, float $width, float $height, string $couleur = "#000000")
    {
        parent::__construct($couleur);

        $this->width = $width;
        $this->height = $height;
        $this->point = $point;
    }
    public function getPoint(): Point
    {
        return $this->point;
    }

    public function getWidth(): float
    {
        return $this->width;
    }
    public function getHeight(): float
    {
        return $this->height;
    }
}
