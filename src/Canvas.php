<?php

namespace Opmvpc\Formes;

class Canvas extends Forme
{
    private float $width;
    private float $height;
    private array $formes;

    public function __construct(float $width, float $height, string $couleur = "#FFFFFF")
    {
        parent::__construct($couleur);
        $this->width = $width;
        $this->height = $height;
        $this->formes = [];
    }
    public function getWidth(): float
    {
        return $this->width;
    }
    public function getHeight(): float
    {
        return $this->height;
    }
    public function getFormes(): array
    {
        return $this->formes;
    }
    public function add($forme): void
    {
        if (get_class($forme) !== Point::class) {
            $this->formes[] = $forme;
        } else {
            throw new \TypeError();
        }
    }
}
