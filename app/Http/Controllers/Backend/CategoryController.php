<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\CategoryDataTable;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\CategoryService;
use App\Http\Controllers\BackendController;

class CategoryController extends BackendController
{

public function __construct(CategoryDataTable $dataTable,Category $category){
    parent::__construct($dataTable,$category);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request,CategoryService $service)
    {
        try{
        $cat = $service->handle($request->all());
        if (is_string($cat)) return $this->throwException($cat);
        return response()->json(['title'=>'نجاح','message'=>'تم الحفظ بنجاح','status'=>'success']);
    }catch(\Exception $e){
        return response()->json($e->getMessage(), 500);
    }
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
    public function update(CategoryRequest $request, $id,CategoryService $service)
    {
        $cat = $service->handle($request->all(), $id);
        if (is_string($cat)) return $this->throwException($cat);
        return response()->json(['title'=>'نجاح','message'=>'تم التحديث بنجاح ','status'=>'success']);
    }




}
