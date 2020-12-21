<?php


namespace App\Support\Email;


use App\Models\Application\Application;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailFactory
 *
 * @package App\Support\Email
 */
class EmailFactory
{
    /**
     * Create needle EmailData object
     * @param Model $model
     * @return EmailData
     */
    public static function create(Model $model) : EmailData
    {
        if ($model->type_id === Application::SERVICE_TYPE) {
            return new ApplicationServiceEmailData($model);
        }

        if ($model->type_id === Application::FEEDBACK_TYPE) {
            return new ApplicationFeedbackEmailData($model);
        }
        throw new \InvalidArgumentException('Unknown model class');
    }
}