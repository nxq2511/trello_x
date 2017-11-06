<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use App\Repository\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static[]
     */
    public function index()
    {
        return $this->userRepository->getAll();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Login Function
     *
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        $arrInput = json_decode($request->getContent());
        $apiFormat = array();

        if (empty($arrInput)) {
            $apiFormat['status'] = Constants::RESPONSE_STATUS_ERROR;
            $apiFormat['message'] = Constants::RESPONSE_JSON_FORMAT;
            return response()->json($apiFormat);
        }

        $user = $this->userRepository->checkUser($arrInput->email, $arrInput->password);
        if (!empty($user)) {
            $apiFormat['status'] = Constants::RESPONSE_STATUS_OK;
            $apiFormat['message'] = Constants::RESPONSE_MESSAGE_SUCCESS;
            $apiFormat['data'] = $user;
            session_start();
            $_SESSION['user'] = $user;
        } else {
            $apiFormat['status'] = Constants::RESPONSE_STATUS_ERROR;
            $apiFormat['message'] = Constants::RESPONSE_MESSAGE_ERROR;
        }

        return response()->json($apiFormat);
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        session_start();

        $apiFormat = array();

        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        if (!isset($_SESSION['user'])) {
            $apiFormat['status'] = Constants::RESPONSE_STATUS_OK;
            $apiFormat['message'] = Constants::RESPONSE_MESSAGE_SUCCESS;
        } else {
            $apiFormat['status'] = Constants::RESPONSE_STATUS_ERROR;
            $apiFormat['message'] = Constants::RESPONSE_MESSAGE_ERROR;
        }

        return response()->json($apiFormat);
    }
}
