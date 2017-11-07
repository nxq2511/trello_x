<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use App\Repository\Board\BoardRepository;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    protected $boardRepository;

    /**
     * BoardController constructor.
     * @param BoardRepository $boardRepository
     */
    public function __construct(BoardRepository $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apiFormat = array();

        $apiFormat['status'] = Constants::RESPONSE_STATUS_OK;
        $apiFormat['message'] = Constants::RESPONSE_MESSAGE_SUCCESS;
        $apiFormat['data'] = $this->boardRepository->getAll();

        return response()->json($apiFormat);
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
        $arrInput = json_decode($request->getContent());
        $apiFormat = array();

        $arrInsert = array(
            'name' => $arrInput->name,
            'owner' => $_SESSION['user']->id,
            'status' => '1'
        );

        $board = $this->boardRepository->create($arrInsert);
        if ($board) {
            $apiFormat['status'] = Constants::RESPONSE_STATUS_OK;
            $apiFormat['message'] = Constants::RESPONSE_MESSAGE_SUCCESS;
            $apiFormat['data'] = $board;
        } else {
            $apiFormat['status'] = Constants::RESPONSE_STATUS_ERROR;
            $apiFormat['message'] = Constants::RESPONSE_MESSAGE_ERROR;
        }

        return response()->json($apiFormat);
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
}
