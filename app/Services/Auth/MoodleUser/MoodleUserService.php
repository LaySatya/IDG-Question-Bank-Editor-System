<?php

namespace App\Services\Auth\MoodleUser;

use Illuminate\Support\Facades\Http;
use App\Services\MoodleBaseService;
class MoodleUserService extends MoodleBaseService
{
    // protected string $moodleUrl;
    // protected string $serviceName;

    // public function __construct()
    // {
    //     $this->moodleUrl = config('services.moodle.url');
    //     $this->serviceName = config('services.moodle.service_name');
    // }

    /**
     * Get a Moodle user token by username and password.
     */
    public function loginUser(string $username, string $password)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_login_user_by_role',
            'usernameoremail' => $username,
            'password' => $password,
        ]);
        return $this->sendRequest($params);
    }

    // Get user by role
    public function getUserByRole(string $rolename)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_users_by_role',
            'rolename' => $rolename,
        ]);
        return $this->sendRequest($params);
    }
}
