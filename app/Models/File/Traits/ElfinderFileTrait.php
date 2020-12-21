<?php
namespace App\Models\File\Traits;

use Illuminate\Contracts\Routing\UrlGenerator;

trait ElfinderFileTrait
{
    /**
     * Get file `mimetype`
     *
     * @return mixed
     */
    public function getMimeType()
    {
        return mime_content_type($this->getAbsolutePath());
    }

    /**
     * Get url
     *
     * @return UrlGenerator|string
     */
    public function getUrl()
    {
        return url($this->path);
    }

    /**
     * Get absolute path
     *
     * @return string
     */
    public function getAbsolutePath()
    {
        return public_path($this->path);
    }

    /**
     * Get file size (bytes)
     *
     * @return false|int
     */
    public function getSize()
    {
        return filesize($this->getAbsolutePath());
    }

    /**
     * Get filename
     *
     * @return mixed
     */
    public function getFilename()
    {
        return pathinfo($this->getAbsolutePath(), PATHINFO_BASENAME);
    }

    /**
     * Создание модели на основе данных пришедших из компонента Elfinder (backpack)
     *
     * @param $path
     * @return ElfinderFileTrait
     */
    public static function createFromElfinder($path)
    {
        $model = static::where('path', $path)->first() ?? new static();

        $model->path            = $path;
        $model->url             = $model->getUrl();
        $model->mimetype        = $model->getMimeType();
        $model->filename        = $model->getFilename();
        $model->original_name   = $model->getFilename();
        $model->size            = $model->getSize();
        $model->save();

        return $model;
    }

    /**
     * Создание нескольких моделей на основе данных пришедших из компонента Elfinder (backpack)
     *
     * @param array $paths массив с путями к загруженным файлам
     * @return \Illuminate\Support\Collection
     */
    public static function createManyFromElfinder(array $paths) {
        $models = collect();
        foreach ($paths as $path) {
            $models->push(self::createFromElfinder($path));
        }
        return $models;
    }
}
