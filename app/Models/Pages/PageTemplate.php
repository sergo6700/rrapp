<?php

namespace App\Models\Pages;

use App\Exceptions\Pages\InvalidCssClassNameException;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $name
 * @property string $template
 * @property string $styles
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Page[] $pages
 */
class PageTemplate extends Model
{
    use SoftDeletes, CrudTrait;

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'template', 'class_name', 'styles',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class, 'template_id');
    }

    /**
     * Get template name
     *
     * @return mixed
     */
    public function getTemplateName()
    {
        return str_replace('_', ' ', $this->template);
    }

    /**
     * Возвращаем название шаблона без файлового extension
     *
     * @return mixed
     */
    public function getViewTemplateName()
    {
        return str_replace('.blade.php', '', $this->template);
    }

    /**
     * Получить очищенное наименование класса без первоначальной точки
     *
     * @return string
     */
    public function getRawClassName()
    {
        return ltrim($this->class_name, '. ');
    }

    /**
     * Set `class_name` attribute
     *
     * @param $value
     * @throws InvalidCssClassNameException
     */
    public function setClassNameAttribute($value)
    {
        $value = trim($value);
        if (! $this->validateClassName($value)) {
            throw new InvalidCssClassNameException(sprintf('CSS class name `%s` is invalid.', $value));
        }

        // save attribute
        $this->attributes['class_name'] = $value;
    }

    /**
     * Проверить поле class_name
     *
     * @param $value
     * @return false|int
     */
    public static function validateClassName($value)
    {
        return preg_match('/^[#,.]{0,1}[A-Za-z\-\_][0-9A-Za-z\-_:]*$/', $value);
    }

    /**
     * Get all defined templates.
     */
    protected static function getTemplates($id = null)
    {
        $pattern = config('backpack.pagemanager.templates_path_pattern');
        $templates = [];

        foreach(glob($pattern) as $templatePath) {
            $templates[] = pathinfo($templatePath, PATHINFO_BASENAME);
        }

        return (null === $id) ? $templates : $templates[$id];
    }
}
