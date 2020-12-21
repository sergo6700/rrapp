<?php


namespace App\Support\Backpack;

use elFinderPlugin;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

/**
 * Class elFinderPluginOptimize
 * @package App\Support\Backpack
 */
class elFinderPluginOptimize extends elFinderPlugin
{
    /**
     * elFinderPluginOptimize constructor.
     * @param string $extraCharacter
     */
    public function __construct()
    {
        //
    }

    /**
     * Rename the file if the file name begins with Cyrillic letters
     *
     * @param $thash
     * @param $name
     * @param $src
     * @param $elfinder
     * @param $volume
     * @return bool
     */
    public function optimize(&$thash, &$name, $src, $elfinder, $volume)
    {
        ImageOptimizer::optimize($src);

        return true;

    }
}
