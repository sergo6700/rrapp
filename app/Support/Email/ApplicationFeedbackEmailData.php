<?php


namespace App\Support\Email;

use App\Models\Application\Application;
use App\Models\Email\EmailTemplate;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApplicationFeedbackEmailData
 *
 * @package App\Support\Email
 */
class ApplicationFeedbackEmailData extends AbstractEmailData
{
    /**
     * Subject of the email
     *
     * @var string $subject
     */
    protected $subject = 'Новая заявка Из Формы Обратной Связи';

    /**
     * Application model
     *
     * @var Application $application
     */
    private $application;

    /**
     * ApplicationFeedbackEmailData constructor.
     * @param Model $model
     */
    public function __construct(Model $application)
    {
        $this->application = $application;
    }

    /**
     * Get emails of application feedback
     * @return array|void
     */
    public function getEmails():array
    {
        return [config('mail.from.address')];
    }

    /**
     * Get subject application feedback
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
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
                'value' => $this->application->id
            ],
            [
                'label' => 'Дата отправки',
                'value' => $this->application->created_at
            ],
            [
                'label' => 'ФИО',
                'value' => $this->application->getApplicationUserFullName()
            ],
            [
                'label' => 'E-mail',
                'value' => $this->application->getApplicationUserEmail()
            ],
            [
                'label' => 'Телефон',
                'value' => $this->application->getApplicationUserPhone()
            ],
            [
                'label' => 'ИНН',
                'value' => $this->application->getApplicationUserTin()
            ],
            [
                'label' => 'Наименование компании',
                'value' => $this->application->getApplicationUserCompanyName()
            ],
            [
                'label' => 'Юридический адрес',
                'value' => $this->application->getApplicationUserLegalAddress()
            ],
            [
                'label' => 'КПП',
                'value' => $this->application->getApplicationUserKpp()
            ],
            [
                'label' => 'ОГРН',
                'value' => $this->application->getApplicationUserOgrn()
            ],
            [
                'label' => 'Страница отправки',
                'value' => $this->generateURL($this->application)
            ],
            [
                'label' => 'Вид деятельности',
                'value' => $this->application->kind_of_activity ?? ''
            ],
            [
                'label' => 'Текст обращения',
                'value' => $this->application->content
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