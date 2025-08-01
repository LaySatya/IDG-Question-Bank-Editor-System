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
    public function getUserByRole(string $rolename , ?int $page, ?int $perPage)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_users_by_role',
            'rolename' => $rolename,
            'page' => $page,
            'perpage' => $perPage
        ]);
        return $this->sendRequest($params);
    }

    // Get user by fields
    public function getUserByUsername(string $username)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'core_user_get_users_by_field',
            'field' => 'username',
            'values[0]'=> $username,
        ]);
        return $this->sendRequest($params);
    }

    // Get all users from moodle - Optional (deparment param, page=1)
    public function getAllUsers(?string $department, ?int $page){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_all_users',
            'department' => $department,
            'page'=> $page,
        ]);
        return $this->sendRequest($params);
    }

    // Get all roles from Moodle
    public function getAllRoles(){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_all_roles',
        ]);
        return $this->sendRequest($params);
    }
}
