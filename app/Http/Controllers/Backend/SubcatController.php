<?php

namespace App\Http\Controllers\Backend;

use App\Models\Subcat;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\SubcatDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubcatRequest;
use App\Http\Services\SubcatService;
use App\Http\Controllers\BackendController;

class SubcatController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(SubcatDataTable $dataTable,Subcat $subcat)
    {
       parent::__construct($dataTable,$subcat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function append(){
        return [
            'rows'=>Category::select('name','id')->get(),
        ];
     }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcatRequest $request,SubcatService $service)
    {
        $subcat = $service->handle($request->all());
        if (is_string($subcat)) return $this->throwException($subcat);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubcatRequest $request, $id,SubcatService $service)
    {
        $subcat = $service->handle($request->all(), $id);
        if (is_string($subcat)) return $this->throwException($subcat);
        return response()->json(['title'=>'نجاح','message'=>'تم التحديث بنجاح','status'=>'success']);
    }


}
