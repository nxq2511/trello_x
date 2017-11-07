<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use App\Repository\Column\ColumnRepository;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    protected $columnRepository;

    /**
     * ColumnController constructor.
     * @param ColumnRepository $columnRepository
     */
    public function __construct(ColumnRepository $columnRepository)
    {
        $this->columnRepository = $columnRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrInput = json_decode($request->getContent());
        $apiFormat = array();

        $orderMax = $this->columnRepository->getMaxColumn();

        if(empty($orderMax)){
            $order = 1;
        } else {
            $order = $orderMax->order + 1;
        }
        $arrInsert = array(
            'board_id' => $arrInput->board_id,
            'name' => $arrInput->name,
            'order' => $order,
            'status' => '1'
        );
        if($this->columnRepository->create($arrInsert)){
            $apiFormat['status'] = Constants::RESPONSE_STATUS_OK;
            $apiFormat['message'] = Constants::RESPONSE_MESSAGE_SUCCESS;
        } else {
            $apiFormat['status'] = Constants::RESPONSE_STATUS_ERROR;
            $apiFormat['message'] = Constants::RESPONSE_MESSAGE_ERROR;
        }

        return response()->json($apiFormat);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getColumnFromBoard(Request $request)
    {
        $arrInput = json_decode($request->getContent());
        $apiFormat = array();

        $apiFormat['status'] = Constants::RESPONSE_STATUS_OK;
        $apiFormat['message'] = Constants::RESPONSE_MESSAGE_SUCCESS;
        $apiFormat['data'] = $this->columnRepository->getColumnFromBoard($arrInput->board_id);

        return response()->json($apiFormat);
    }
}
