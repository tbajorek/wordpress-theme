<?php

/**
 * Get average color of image
 *
 * @param string|null $imagePath
 * @return array
 */
function get_average_color(?string $imagePath)
{
    $defaults = [19, 113, 255, 0.4];
    if ($imagePath === null) {
        return $defaults;
    }
    try {
        [,,$type] = getimagesize($imagePath);
        switch ($type) {
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($imagePath);
                break;
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($imagePath);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($imagePath);
                break;
            case IMAGETYPE_BMP:
                $image = imagecreatefrombmp($imagePath);
                break;
            default:
                throw new RuntimeException('Unsupported image format');
        }
        $scaled = imagescale($image, 1, 1, IMG_BICUBIC);
        $index = imagecolorat($scaled, 0, 0);
        $rgb = imagecolorsforindex($scaled, $index);
        $red = round(round(($rgb['red'] / 0x33)) * 0x33);
        $green = round(round(($rgb['green'] / 0x33)) * 0x33);
        $blue = round(round(($rgb['blue'] / 0x33)) * 0x33);
        return [$red, $green, $blue, 0.2];
    } catch (Throwable $e) {
        return $defaults;
    }
}

/**
 * Get thumbnail path to file on server
 *
 * @return string|null
 */
function get_the_thumbnail_path(): ?string
{
    if (!is_single() || !has_post_thumbnail()) {
        return null;
    }
    $image = get_the_post_thumbnail_url();
    $imagepath= str_replace(get_site_url(), $_SERVER['DOCUMENT_ROOT'], $image);

    if ($imagepath) {
        return $imagepath;
    }
    return null;
}