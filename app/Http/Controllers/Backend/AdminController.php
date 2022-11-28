<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\DataTables\AdminDataTable;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdminRequest;
use App\Http\Services\AdminService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BackendController;

class AdminController extends BackendController
{
    public function __construct(AdminDataTable $dataTable,Admin $model)
    {
        parent::__construct($dataTable, $model);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request,AdminService $AdminService)
    {
        $admin = $AdminService->handle($request->all());
        if (is_string($admin)) return $this->throwException($admin);
        return response()->json(['title'=>'نجاح','message'=>'تم الحفظ بنجاح','status'=>'success']);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id,AdminService $AdminService)
    {
        $admin = $AdminService->handle($request->all(), $id);
        if (is_string($admin)) return $this->throwException($admin);
        return response()->json(['title'=>'نجاح','message'=>'تم التحديث بنجاح ','status'=>'success']);
    }






}
