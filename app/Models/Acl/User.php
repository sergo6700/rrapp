<?php

namespace App\Models\Acl;

use App\Models\Application\EventRegistration;
use App\Models\Event\Event;
use App\Models\Notification\Notification;
use Backpack\CRUD\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\Base\app\Models\Traits\InheritsRelationsFromParentModel;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;

/**
 * Class User
 * @package App\Models\Acl
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $tin
 * @property string $company_name
 * @property string $password
 * @property integer $role_in_company_id
 * @property string $legal_address
 * @property string $kpp
 * @property string $ogrn
 * @property string $uid_social_network
 * @property string $email_verified_at
 * @property string $social_network
 *
 * @method static User find(int $int)
 * @method static User create(array $array)
 * @method static whereBetween(string $string, array $dates)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, CrudTrait, InheritsRelationsFromParentModel, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'tin',
        'custom_role',
        'company_name',
        'password',
        'role_in_company_id',
        'legal_address',
        'kpp',
        'ogrn',
        'email_verified_at',
        'uid_social_network',
        'social_network'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Id of Other role in handbook
     */
    public const OTHER_ROLE_ID = 3;

    /**
     * КПП (Код причины постановки на учёт) состоит из 9 цифр
     * @var int KPP_LENGTH
     */
    public const KPP_LENGTH = 9;

    /**
     * ОГРН (Основной государственный регистрационный номер) имеет максимально 15 цифр
     * @var int OGRN_MAX_LENGTH
     */
    public const OGRN_MAX_LENGTH = 15;

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * Get events registration relations
     * @return HasMany
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class, 'user_id');
    }

    /**
     * Get all notification types relations
     * @return HasMany
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    /**
     * Is role in company set as other
     *
     * @return bool
     */
    public function getRoleIsOtherAttribute(): bool
    {
        return $this->role_in_company_id === User::OTHER_ROLE_ID;
    }

    /**
     * User's events
     *
     * @return BelongsToMany
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_registrations')->whereNull('event_registrations.deleted_at');
    }

    /**
     * User's upcoming events
     *
     * @return Collection
     */
    public function getUpcomingEventsAttribute(): Collection
    {
        return $this->events()
            ->whereDate('date_from', '>=', Carbon::now()->startOfDay()->toDateTimeString())
            ->orWhere(function ($query) {
                $query->whereNull('date_to')
                    ->whereDate('date_to', '>=', Carbon::now()->startOfDay()->toDateTimeString());
            })->get();
    }

    /**
     * User's past events
     *
     * @return Collection
     */
    public function getPastEventsAttribute(): Collection
    {
        return $this->events()
            ->whereDate('date_from', '<', Carbon::now()->startOfDay()->toDateTimeString())
            ->orWhere(function ($query) {
                $query->whereNull('date_to')
                    ->whereDate('date_to', '<', Carbon::now()->startOfDay()->toDateTimeString());
            })->get();
    }

    /**
     * Return UserSource model
     *
     * @return HasOne
     */
    public function userSource() :HasOne
    {
        return $this->hasOne('App\Models\Acl\UserSource');
    }

    /**
     * Check if user was created from iframe
     *
     * @return bool
     */
    public function wasCreatedFromIframe() :bool
    {
        if (!($this->role_in_company_id || $this->social_network)) {
            return true;
        }

        return false;
    }

    /**
     * Confirm email manually
     */
    public function confirmEmailManually(): void
    {
        $this->update([
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
