<?php

namespace App\Http\Controllers;

use App\Column;
use App\Common\Constants;
use App\Repository\Column\ColumnRepository;
use App\Repository\Task\TaskRepository;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    protected $columnRepository;
    protected $taskRepository;

    /**
     * ColumnController constructor.
     * @param ColumnRepository $columnRepository
     * @param TaskRepository $taskRepository
     */
    public function __construct(ColumnRepository $columnRepository, TaskRepository $taskRepository)
    {
        $this->columnRepository = $columnRepository;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrInput = json_decode($request->getContent());
        $apiFormat = array();

        $orderMax = $this->columnRepository->getMaxColumn();

        if (empty($orderMax)) {
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

        $column = $this->columnRepository->create($arrInsert);
        if ($column) {
            $apiFormat['status'] = Constants::RESPONSE_STATUS_OK;
            $apiFormat['message'] = Constants::RESPONSE_MESSAGE_SUCCESS;
            $apiFormat['data'] = $column;
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

    /**
     * Get column from board
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getColumnFromBoard(Request $request)
    {
        $arrInput = json_decode($request->getContent());
        $apiFormat = array();

        $column = $this->columnRepository->getColumnFromBoard($arrInput->board_id);
        foreach ($column as $item) {
            $item->tasks = $this->taskRepository->getTaskFromColumn($item['id']);
        }
        $apiFormat['status'] = Constants::RESPONSE_STATUS_OK;
        $apiFormat['message'] = Constants::RESPONSE_MESSAGE_SUCCESS;
        $apiFormat['data'] = $column;

        return response()->json($apiFormat);
    }

    /**
     * Update column name
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateColumnName(Request $request)
    {
        $arrInput = json_decode($request->getContent());
        $apiFormat = array();

        $arrUpdate = array(
            'name' => $arrInput->name
        );

        if($this->columnRepository->update($arrInput->column_id, $arrUpdate)){
            $apiFormat['status'] = Constants::RESPONSE_STATUS_OK;
            $apiFormat['message'] = Constants::RESPONSE_MESSAGE_SUCCESS;
        } else {
            $apiFormat['status'] = Constants::RESPONSE_STATUS_ERROR;
            $apiFormat['message'] = Constants::RESPONSE_MESSAGE_ERROR;
        }

        return response()->json($apiFormat);
    }
}
