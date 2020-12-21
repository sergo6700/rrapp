<?php


namespace App\Support\Backpack;

use App\Models\Media\Media;
use App\Models\Post\Article;
use App\Models\Post\NewsItem;
use App\Models\Tag\Tag;
use App\Models\Email\Email;
use Backpack\CRUD\CrudPanel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Services\Admin\TagService;

/**
 * Class CustomForm
 * @package App\Support\Backpack
 */
class CustomForm
{
    /**
     * Обновляет модель с кастомной колонкой (из backpack CRUD Controller)
     *
     * @param CrudPanel $crud pass $this->crud from your Backpack CrudController
     * @param $fileModelClass mixed model class ex. File::class MUST HAVE 'path' string attribute
     * @param string $formKey ex. file значение будет взято из реквеста прим. $request->file
     * @param string $dbKey ex. file_id значение из реквеста будет записано в таблицу прим $model->file_id
     * @return mixed created / updated model
     */
    public static function updateWithCustomFileColumn(CrudPanel $crud, $fileModelClass, string $formKey, string $dbKey)
    {
        $request = request();
        $columnValue = $request->$formKey ? $fileModelClass::createFromElfinder($request->$formKey)->id : null;

        $dataToUpdate = $request->except(['save_action', '_token', '_method', 'current_tab', 'http_referrer']);
        $dataToUpdate[$dbKey] = $columnValue;

        return self::unsetFormKeyUpdateAndGet($formKey, $crud->model, $dataToUpdate);
    }


    /**
     * Создать/обновить Slider модель
     *
     * @param CrudPanel $crud
     * @param string    $fileModelClass
     * @param array     $keysFromFormToDb
     * @return mixed
     */
    public static function updateForSlider(CrudPanel $crud, string $fileModelClass, array $keysFromFormToDb)
    {
        $request = request();
        $dataToUpdate = $request->except(['save_action', '_token', '_method', 'current_tab', 'http_referrer']);

        foreach ($keysFromFormToDb as $formKey => $dbKey) {
            $columnValue = $request->$formKey ? $fileModelClass::createFromElfinder($request->$formKey)->id : null;
            $dataToUpdate[$dbKey] = $columnValue;
        }

        return self::save($crud->model, $dataToUpdate, $request);
    }



    /**
     * Обновляет модель с кастомной колонкой browse_many (из backpack CRUD Controller)
     *
     * @param CrudPanel $crud pass $this->crud from your Backpack CrudController
     * @param $fileModelClass mixed model class ex. File::class MUST HAVE 'path' string attribute
     * @param string $formKey ex. file значение будет взято из реквеста прим. $request->file
     * @param string $morphName a ex. название morph связи прим. 'files' => $model->files()
     * @return mixed created / updated model
     */
    public static function updateWithCustomBrowseMultiple(
        CrudPanel $crud, $fileModelClass, string $formKey, string $morphName
    )
    {
        $filePaths = request()->$formKey;
        $attachedFileIds = $fileModelClass::createManyFromElfinder($filePaths ?: [])->pluck('id');

        $item = self::unsetFormKeyUpdateAndGet($formKey, $crud->model);

        $item->$morphName()->sync($attachedFileIds);

        return $item;
    }

    /**
     * Убирает ключи из request, создает \ обновляет затем возвращает модель
     *
     * @param string $formKey
     * @param $modelClass
     * @param array|null $forceDataToUpdate
     * @param Request $request
     * @return mixed
     */
    private static function unsetFormKeyUpdateAndGet(
        string $formKey, $modelClass, array $forceDataToUpdate = null, &$request = null
    )
    {
        $request = $request ?: request();
        $dataToUpdate = $forceDataToUpdate ?: $request->except([
            'save_action',
            '_token',
            '_method',
            'current_tab',
            'http_referrer'
        ]);
        unset($dataToUpdate[$formKey]);

        return self::save($modelClass, $dataToUpdate, $request);
    }


    /**
     * Создает \ обновляет затем возвращает модель
     *
     * @param Model      $modelClass
     * @param array|null $data
     * @param            $request
     * @return mixed
     */
    private static function save(Model $modelClass, array $data = null, $request)
    {
        $item = $modelClass::find($request->id);

        if ($item) {
            $item->update($data);
            return $item->refresh();
        }
        return $modelClass->create($data);
    }


    /**
     * Обновляет или добавляет адресную запись и привязывает ее к событию
     *
     * @param CrudPanel $crud pass $this->crud from your Backpack CrudController
     * @param $fileModelClass mixed model class ex. File::class MUST HAVE 'path' string attribute
     * @param string $formKey ex. file значение будет взято из реквеста прим. $request->file
     * @param string $dbKey ex. file_id значение из реквеста будет записано в таблицу прим $model->file_id
     * @param int $itemId
     * @return mixed created / updated model
     */
    public static function updateWithCustomAddressColumn(CrudPanel $crud, $fileModelClass, string $formKey, string $dbKey, int $itemId)
    {
        $request = request();

        $address = json_decode($request[$formKey], true);
        $address_id = null;
        if ($address) {
            if (!empty($request['address_id'])) {
                $fileModelClass::find($request['address_id'])->update($address);
                $address_id = $request['address_id'];
            } else {
                $address = $fileModelClass::create($address);
                $address_id = $address->id;
            }
        }

        unset($request[$formKey]);
        if (empty($itemId)) {
            $itemId = $request->id;
        }
        $item = $crud->model::find($itemId);
        $dataToUpdate = $request->except(['save_action', '_token', '_method', 'current_tab', 'http_referrer', 'slug']);
        $dataToUpdate[$dbKey] = $address_id;
        if ($item) {
            return $item->update($dataToUpdate);
        }
        return $crud->model->create($dataToUpdate);
    }

    /**
     * Обновляет модель service с кастомными полями (из backpack CRUD Controller)
     *
     * @param CrudPanel $crud pass $this->crud from your Backpack CrudController
     * @return mixed created / updated model
     */
    public static function updateServiceWithCustomFields(CrudPanel $crud)
    {
        $request = request();
        $item = $crud->model::find($request->id);
        $dataToUpdate = $request->except(['save_action', '_token', '_method', 'current_tab', 'http_referrer']);

        if ($item) {
            if ($request->tags) {

                $all_tags = Tag::all();
                $exist_tags = [];
                foreach ($all_tags as $tag) {
                    $exist_tags[$tag->name] = $tag->id;
                }
                $sync_tags = [];
                foreach ($request->tags as $tag) {
                    if (isset($exist_tags[$tag])) {
                        $sync_tags[$tag] = $exist_tags[$tag];
                    } else {
                        $new_tag = $item->tags()->create(['name' => $tag]);
                        $sync_tags[$tag] = $new_tag->id;
                    }
                }
                $item->tags()->sync(array_values($sync_tags));

                (new TagService())->removeOldTags();
            }

            if ($request->emails) {
                $all_emails = Email::all();
                $exist_emails = [];
                foreach ($all_emails as $email) {
                    $exist_emails[$email->email] = $email->id;
                }
                $sync_emails = [];
                foreach ($request->emails as $email) {
                    if (isset($exist_emails[$email])) {
                        $sync_emails[$email] = $exist_emails[$email];
                    } else {
                        $new_email = $item->emails()->create(['email' => $email]);
                        $sync_emails[$email] = $new_email->id;
                    }
                }
                $item->emails()->sync(array_values($sync_emails));
            }

            return $item->update($dataToUpdate);
        }

        $item = $crud->model->create($dataToUpdate);
        if (!empty($request->tags)) {
            foreach ($request->tags as $tag) {
                $tag = Tag::firstOrCreate(['name' => $tag]);
            	$item->tags()->save($tag);
            }
        }

        if (!empty($request->emails)) {
            foreach ($request->emails as $email) {
				$email = Email::firstOrCreate(['email' => $email]);
				$item->emails()->save($email);
            }
        }

        return $item;
    }

    /**
     * Обновить поле 'fixed' во всех указанных моделях
     *
     * @param CrudPanel $crud
     * @param Article|NewsItem|Media|null $instance
     * @return void
     */
    public static function updateFixedFieldForAllModels(CrudPanel $crud, $instance = null) :void
    {
        $request = request();
        if (!$instance) {
            $instance = $crud->model::find($request->id);
        }

        if ($instance) {
            if ($isFixed = (bool)$request->fixed) {
                $instance::where('id', '!=', $instance->id)
                    ->update(['fixed' => !$isFixed]);
            }
        }
    }
}
