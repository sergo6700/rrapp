<?php


namespace App\Support\Backpack;

use elFinderPlugin;
use elFinderVolumeDriver;
use elFinder;

/**
 * Class elFinderPluginRotate
 * @package App\Support\Backpack
 */
class elFinderPluginRotate extends elFinderPlugin
{
    /**
     * This is the multiplier that is needed when calculating the new angle value
     *
     * @var integer
     */
    const MULTIPLIER = -2;


    /**
     * Rotate image
     *
     * @param string $cmd
     * @param string $name
     * @param array $args
     * @param elFinder $elfinder
     * @param elFinderVolumeDriver $volume
     * @throws \Exception
     * @return array|false
     */
    public function rotate($cmd, $name, $args, $elfinder, $volume)
    {
        if (is_array($args) && key_exists('mode', $args) && $args['mode'] === 'rotate') {
            $args['degree'] = (int)$args['degree'] * self::MULTIPLIER;

            $target = $args['target'];
            $width = (int)$args['width'];
            $height = (int)$args['height'];
            $x = (int)$args['x'];
            $y = (int)$args['y'];
            $mode = $args['mode'];
            $bg = $args['bg'];
            $degree = (int)$args['degree'];
            $quality = (int)$args['quality'];

            return ($file = $volume->resize($target, $width, $height, $x, $y, $mode, $bg, $degree, $quality))
                ? true
                : array('error' => $elfinder->error($elfinder::ERROR_RESIZE, $volume->path($target), $volume->error()));
        }
    }
}