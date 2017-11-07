<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use App\Repository\Task\TaskRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskRepository;

    /**
     * TaskController constructor.
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
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

        $orderMax = $this->taskRepository->getMaxTask();
        if(empty($orderMax)){
            $order = 1;
        } else {
            $order = $orderMax->order + 1;
        }

        $arrInsert = array(
            'name' => $arrInput->name,
            'column_id' => $arrInput->column_id,
            'order' => $order,
            'status' => '1'
        );

        if($this->taskRepository->create($arrInsert)){
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
     * Get task from column
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTaskFromColumn(Request $request)
    {
        $arrInput = json_decode($request->getContent());
        $apiFormat = array();

        $apiFormat['status'] = Constants::RESPONSE_STATUS_OK;
        $apiFormat['message'] = Constants::RESPONSE_MESSAGE_SUCCESS;
        $apiFormat['data'] = $this->taskRepository->getTaskFromColumn($arrInput->column_id);

        return response()->json($apiFormat);
    }
}
