<?php


namespace App\Support\Files;

/**
 * Class FileHandlerForRenamingCyrillicNames
 *
 * @package App\Support\Files
 */
class FileHandlerForRenamingCyrillicNames
{
    /**
     * Extra character
     *
     * @var string EXTRA_CHARACTER
     */
    const EXTRA_CHARACTER = "`";

    /**
     * Pattern for cyrillic name
     *
     * @var string CYRILLIC_LETTER_PATTERN
     */
    const CYRILLIC_LETTER_PATTERN = '/^[А-Яа-яЁё]/u';

    /**
     * Pattern for cyrillic name (DataBase)
     *
     * @var string CYRILLIC_LETTER_PATTERN_FOR_DB
     */
    const CYRILLIC_LETTER_PATTERN_FOR_DB = '^[А-Яа-яЁё]';

    /**
     * Run a directory scan to find files with names starting with Cyrillic
     *
     * @param string $directory
     * @return array
     */
    public function run(string $directory) :array
    {
        $result = [];

        $cdir = array_diff(scandir($directory), array('..', '.'));
        foreach ($cdir as $key => $value)
        {
            if (is_dir($directory . DIRECTORY_SEPARATOR . $value)) {
                $result[$value] = $this->run($directory . DIRECTORY_SEPARATOR . $value);
            } else {

                $result[] = $value;

                if ($hasFirstLetterCyrillic = preg_match(self::CYRILLIC_LETTER_PATTERN, $value)) {
                    $pathToFile = $directory . DIRECTORY_SEPARATOR . $value;
                    $this->rename($value, $pathToFile);
                }
            }
        }

        return $result;
    }

    /**
     * Rename the file if the file name begins with Cyrillic letters
     *
     * @param $name
     * @param $src
     * @return string
     */
    public function rename($name, $originSrc)
    {
        $ext = pathinfo($name, PATHINFO_EXTENSION);

        $pattern = '(\.' . $ext .')$';
        $nameWithoutExtension = mb_ereg_replace($pattern, '', $name);

        if ($nameWithoutExtension) {
            $newName = self::EXTRA_CHARACTER . $nameWithoutExtension . self::EXTRA_CHARACTER . '.' . $ext;
            $newSsrc = str_replace($name, $newName, $originSrc);

            rename($originSrc, $newSsrc);
        }
    }
}