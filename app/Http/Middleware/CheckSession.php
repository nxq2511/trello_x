<?php

namespace App\Http\Middleware;

use App\Common\Constants;
use App\Repository\User\UserRepository;
use Closure;

class CheckSession
{
    protected $userRepository;

    /**
     * CheckSession constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        session_start();

        $apiFormat = array();
        $login_token = $request->header('login_token');
        echo $login_token;
        if (!isset($_SESSION['user'])) {
            $user = $this->userRepository->checkLoginToken($login_token);
            if (!empty($user)) {
                $_SESSION['user'] = $user;
                return $next($request);
            } else {
                $apiFormat['status'] = Constants::RESPONSE_STATUS_ERROR;
                $apiFormat['message'] = Constants::RESPONSE_SESSION_ERROR;
                return response()->json($apiFormat);
            }
        } else {
            return $next($request);
        }
    }
}
