<?php

namespace App\Models\Application;

use App\Models\Acl\User;
use App\Models\Service\Service;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Application
 * @package App\Models\Application
 *
 * @property integer $id
 * @property integer user_id
 * @property integer service_id
 * @property boolean is_completed
 * @property string page_url
 * @property string page_title
 * @property string full_name
 * @property string email
 * @property string phone
 * @property string tin
 * @property string company_name
 * @property string kind_of_activity
 * @property string subject
 * @property string content
 * @property integer type_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 * @property Service $service
 */
class Application extends Model
{
    use CrudTrait;

    /**
     * @var string
     */
    protected $table = 'applications';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'service_id',
        'page_url',
        'page_title',
        'full_name',
        'phone',
        'tin',
        'company_name',
        'kind_of_activity',
        'subject',
        'type_id',
        'content',
        'is_completed',
    ];

    /**
     * Service type application id
     * @const SERVICE_TYPE
     */
    public const SERVICE_TYPE = 1;

    /**
     * feedback type application id
     * @const FEEDBACK_TYPE
     */
    public const FEEDBACK_TYPE = 2;

    /**
     * User of application relation
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Application of application relation
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Get application user full name
     * @return string
     */
    public function getApplicationUserFullName(): string
    {
        if ($this->user) {
            return $this->user->name ?? '';
        }

        if ($this->full_name) {
            return $this->full_name ?? '';
        }

        return '';
    }

    /**
     * Get application user email
     * @return string
     */
    public function getApplicationUserEmail(): string
    {
        if ($this->user) {
            return $this->user->email ?? '';
        }

        if ($this->email) {
            return $this->email ?? '';
        }

        return '';
    }

    /**
     * Get application user phone
     * @return string
     */
    public function getApplicationUserPhone(): string
    {
        if ($this->user) {
            return $this->user->phone ?? '';
        }

        if ($this->phone) {
            return $this->phone ?? '';
        }

        return '';
    }

    /**
     * Get application user tin
     * @return string
     */
    public function getApplicationUserTin(): string
    {
        if ($this->user) {
            return $this->user->tin ?? '';
        }

        if ($this->tin) {
            return $this->tin ?? '';
        }

        return '';
    }

    /**
     * Get application user company name
     * @return string
     */
    public function getApplicationUserCompanyName(): string
    {
        if ($this->user) {
            return $this->user->company_name ?? '';
        }

        if ($this->company_name) {
            return $this->company_name ?? '';
        }

        return '';
    }

    /**
     * Get application status
     * @return string
     */
    public function getApplicationStatus(): string
    {
        return $this->is_completed ? 'завершена': 'в работе';
    }

    /**
     * Get application user legal address
     * @return string
     */
    public function getApplicationUserLegalAddress(): string
    {
        if ($this->user) {
            return $this->user->legal_address ?? '';
        }

        return '';
    }

    /**
     * Get application user KPP
     * @return string
     */
    public function getApplicationUserKpp(): string
    {
        if ($this->user) {
            return $this->user->kpp ?? '';
        }

        return '';
    }

    /**
     * Get application user OGRN
     * @return string
     */
    public function getApplicationUserOgrn(): string
    {
        if ($this->user) {
            return $this->user->ogrn ?? '';
        }

        return '';
    }
}
