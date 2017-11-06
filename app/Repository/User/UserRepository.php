<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/12/2017
 * Time: 9:50 AM
 */

namespace App\Repository\User;


use App\Repository\EloquentRepository;
use App\User;

class UserRepository extends EloquentRepository
{
    protected $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->user;
    }

    /**
     * Check user exist
     *
     * @param $email
     * @param $password
     * @return mixed
     */
    public function checkUser($email, $password)
    {
        return $this->user->where(['email' => $email, 'password' => md5($password)])->first();
    }

    /**
     * Check Login Token
     *
     * @param $login_token
     * @return mixed
     */
    public function checkLoginToken($login_token)
    {
        return $this->user->where(['login_token' => $login_token])->first();
    }

    /**
     * Generate random string
     *
     * @param $len
     * @return string
     */
    public function randStrGen($len)
    {
        $result = "";
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $charArray = str_split($chars);
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .= "" . $charArray[$randItem];
        }
        return $result;
    }

}