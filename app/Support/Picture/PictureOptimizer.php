<?php

namespace App\Support\Picture;

use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * Class PictureOptimizer
 * @package App\Support\Picture
 */
class PictureOptimizer
{
    /**
     * Run a scan directory to search for images and optimize images
     *
     * @param string $directory
     * @return array
     */
    public static function run(string $directory) :array
    {
        $result = [];

        $cdir = array_diff(scandir($directory), array('..', '.'));
        foreach ($cdir as $key => $value)
        {
            if (is_dir($directory . DIRECTORY_SEPARATOR . $value)) {
                $result[$value] = self::run($directory . DIRECTORY_SEPARATOR . $value);
            } else {

                $result[] = $value;

                $pathToFile = $directory . DIRECTORY_SEPARATOR . $value;
                if (strpos(mime_content_type($pathToFile), 'image/') !== false) {
                    self::optimize($pathToFile);
                }
            }
        }

        return $result;
    }


    /**
     * Optimize picture
     *
     * @param string $path
     * @return void
     */
    public static function optimize(string $path) :void
    {
        try {
            $content = file_get_contents($path);
            if ($content === false) {
                return;
            }

            $temp = tmpfile();
            $pathToTempFile = stream_get_meta_data($temp)['uri'];

            fwrite($temp, $content);
            fseek($temp, filesize($pathToTempFile));

            ImageOptimizer::optimize($pathToTempFile);

            file_put_contents($path, file_get_contents($pathToTempFile));

            fclose($temp);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}