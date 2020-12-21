<?php


namespace App\Support\Model;

/**
 * Class ModelUtils
 * @package App\Support\Model
 */
class ModelUtils
{
    /**
     * Получает название модели из namespace прим. 'App\Models\User' -> 'User'
     * @param $model
     * @return string|null
     */
    public static function getEntityNameFromModel($model)
    {
        if (!$model) {
            return null;
        }
        return last(explode("\\", get_class($model)));
    }

    /**
     * Получает значение attribute из relation модели
     * @param mixed $model
     * @param string $relation
     * @param string $field
     * @return string
     */
    public static function getCustomFieldValue($model, $relation, $field)
    {
        return $model->$relation->$field ?? null;
    }

    /**
     * Получает все значения поля $field из relation модели
     * @param $model
     * @param $relation
     * @param $field
     * @return array
     */
    public static function getRelationFieldValues($model, string $relation, string $field): array
    {
        return $model->$relation()->get()->pluck($field)->toArray();
    }
}
