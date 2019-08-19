<?php

namespace Src;

use Intervention\Image\ImageManager;

class ImagesLoad
{
    public function secureLoadingImage($imageNew, $imageName)
    {
        if (file_exists("../public/images/$imageName")){
            $imageName = "new" . $imageName;
        }

        $manager = new ImageManager();
        $image = $manager->make($imageNew)
            ->resize(400, null, function ($pic) {
                $pic->aspectRatio();
            })
            ->save("../public/images/$imageName");

        return $imageName;
    }

}
