<?php


namespace App\Services\Web;

use App\Models\Acl\User;
use Illuminate\Support\Facades\Log;

/**
 * Class RegistrationOfUsersFromSocialNetworksService
 * @package App\Services\Web
 */
class RegistrationOfUsersFromSocialNetworksService
{
    /**
     * Проверить существует ли пользовать из соц.сетей в нашей БД
     *
     * @param array $uid_social_network
     * @return bool
     */
    /**
     * @param array $uid_social_network
     * @return mixed
     */
    public function existsUser(array $uid_social_network): ?User
    {
        return User::where($uid_social_network)->first();
    }

    /**
     * Регистрируем нового пользователя из соц.сетей
     *
     * @param array $userOfSocialNetwork
     * @return User
     */
    public function register(array $userOfSocialNetwork) :User
    {
        $credentials = [
            'name' => $userOfSocialNetwork['first_name'] . ' ' . $userOfSocialNetwork['last_name'],
            'social_network' => $userOfSocialNetwork['network'],
            'uid_social_network' => $userOfSocialNetwork['network'] . $userOfSocialNetwork['uid']
        ];

        return User::create($credentials);
    }
}