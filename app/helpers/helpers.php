<?php
namespace App\Helpers;

class Helpers
{
    public static function getImage($image)
    {
        $exploded = explode(',', $image);
        $decoded = base64_decode($exploded[1]);
        if (str_contains($exploded[0], 'jpeg')) {
            $extension = 'jpg';
        } else {
            $extension = 'png';
        }
        $fileName = str_random().'.'.$extension;
        $path = public_path().'/images/'.$fileName;
        file_put_contents($path, $decoded);
        return $fileName;
    }
}
