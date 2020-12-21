<?php


namespace App\Support\Backpack;

use App\Support\Files\FileHandlerForRenamingCyrillicNames;
use elFinderPlugin;

/**
 * Class elFinderPluginHandler
 * @package App\Support\Backpack
 */
class elFinderPluginHandler extends elFinderPlugin
{
    /**
     * elFinderPluginHandler constructor.
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
    public function rename(&$thash, &$name, $src, $elfinder, $volume)
    {
        $hasFirstLetterCyrillic = preg_match(FileHandlerForRenamingCyrillicNames::CYRILLIC_LETTER_PATTERN, $name);

        if ($hasFirstLetterCyrillic) {
            $ext = pathinfo($name, PATHINFO_EXTENSION);

            $pattern = '(\.' . $ext .')$';
            $nameWithoutExtension = mb_ereg_replace($pattern, '', $name);

            if ($nameWithoutExtension) {
                $name = FileHandlerForRenamingCyrillicNames::EXTRA_CHARACTER . $nameWithoutExtension
                    . FileHandlerForRenamingCyrillicNames::EXTRA_CHARACTER . '.' . $ext;
            }
        }

        return true;

    }
}