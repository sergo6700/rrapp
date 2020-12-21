<?php


namespace App\Support\Email;

use App\Models\Application\Application;
use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApplicationServiceEmailData
 *
 * @package App\Support\Email
 */
class ApplicationServiceEmailData extends AbstractEmailData
{
    /**
     * Subject of the email
     *
     * @var string $subject
     */
    protected $subject = 'Новая заявка по услуге: ';

    /**
     * Application model
     *
     * @var Application $model
     */
    private $model;

    /**
     * Service model
     *
     * @var Service $service
     */
    private $service;

    /**
     * ApplicationServiceEmailData constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;

        $this->service = Service::query()->findOrFail($this->model->service_id);
    }

    /**
     * Get emails of application service
     * @return array|void
     */
    public function getEmails():array
    {
        $service = Service::query()->find($this->model->service_id);

        return $service->emails->pluck(['email'])->toArray();
    }

    /**
     * Get subject application service
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject . $this->service->title;
    }

    /**
     * Get content of email
     * @return string
     */
    public function getContent(): string
    {
        $content = [
            [
                'label' => 'ID',
                'value' => $this->model->id,
            ],
            [
                'label' => 'Дата отправки',
                'value' => $this->model->created_at,
            ],
            [
                'label' => 'Услуга',
                'value' => $this->service->title,
            ],
            [
                'label' => 'ФИО',
                'value' => $this->model->getApplicationUserFullName(),
            ],
            [
                'label' => 'E-mail',
                'value' => $this->model->getApplicationUserEmail(),
            ],
            [
                'label' => 'Телефон',
                'value' => $this->model->getApplicationUserPhone()
            ],
            [
                'label' => 'ИНН',
                'value' => $this->model->getApplicationUserTin()
            ],
            [
                'label' => 'Наименование компании',
                'value' => $this->model->getApplicationUserCompanyName()
            ],
            [
                'label' => 'Юридический адрес',
                'value' => $this->model->getApplicationUserLegalAddress()
            ],
            [
                'label' => 'КПП',
                'value' => $this->model->getApplicationUserKpp()
            ],
            [
                'label' => 'ОГРН',
                'value' => $this->model->getApplicationUserOgrn()
            ],
            [
                'label' => 'Страница отправки',
                'value' => $this->generateURL($this->model)
            ],
            [
                'label' => 'Текст сообщения',
                'value' => $this->model->content
            ]
        ];

        $htmlTable = build_table($content, false);
        $styles = '<style type="text/css">
                        table {
                            border-collapse: collapse;
                        }
                        th, td {
                          padding: 5px;
                          text-align: left;
                        }
                  </style>';

        return $htmlTable . $styles;
    }
}
