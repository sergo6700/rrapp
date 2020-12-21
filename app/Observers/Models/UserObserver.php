<?php

namespace App\Observers\Models;

use App\Models\Acl\User;
use App\Models\Acl\UserSource;
use App\Support\Enum\User\UserSourceType;

/**
 * Class UserObserver
 *
 * @package App\Observers\Models
 */
class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param User $user Model
     *
     * @return void
     */
    public function created(User $user)
    {
        if (\Schema::hasTable((new UserSource())->getTable())) {
            $data = [
                'user_id' => $user->getKey(),
                'source' => UserSourceType::SITE,
            ];

            if ($user->wasCreatedFromIframe()) {
                $data['source'] = UserSourceType::IFRAME;
            }

            $user->userSource()->create($data);
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param User $user Model
     *
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param User $user Model
     *
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param User $user Model
     *
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param User $user Model
     *
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
