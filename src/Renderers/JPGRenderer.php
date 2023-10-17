<?php

namespace Opmvpc\Formes\Renderers;


class JPGRenderer extends SVGRenderer implements Renderer
{
    public function save(string $path): void
    {
        $image = $this->getImage();
        $rasterImage = $image->toRasterImage($this->canvas->getWidth(), $this->canvas->getHeight());
        imagejpeg($rasterImage, $path);
    }
}
