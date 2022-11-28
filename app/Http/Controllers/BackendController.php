<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Services\DataTable;

class BackendController extends Controller
{
    public function __construct(public DataTable $dataTable, public Model $model)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return $this->dataTable->render('backend.includes.table');

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{

            return view('backend.'.$this->model->getTable().'.form',$this->append());

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }



      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{

           $row = $this->model::query()->where('id',$id)->first();

            return view('backend.'.$this->model->getTable().'.form',compact('row'),$this->append());

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

       /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $row = $this->model::where('id',$id)->first();
            if(isset($row->images)){
                foreach($row->images as $img){

                    $img->delete();
                 }
            }

           $row->delete();
           return response()->json(['title'=>'نجاح','message'=>'تم الحذف بنجاح','status'=>'success']);
          }catch(\Exception $e){
              return response()->json($e->getMessage(), 500);
          }
    }

    public function updateStatus($id,$column){
        try{

            $row = $this->model::where('id',$id)->first();
            $row->update([$column => !$row->$column]);
            return response()->json(['title'=>'نجاح','message'=>'تم تحديث الحاله بنجاح','status'=>'success']);
          }catch(\Exception $e){
              return response()->json($e->getMessage(), 500);
          }
    }

    public function MultiDelete(Request $request){

        try{
           $rows = $this->model::whereIn('id',(array)$request['id'])->delete();
        //    DB::beginTransaction();
        //    foreach ($rows as $row)
        //        $row->delete();
        //    DB::commit();
           return response()->json(['title'=>'نجاح','message'=>'تم الحذف بنجاح','status'=>'success']);

            }catch(\Exception $e){
              return response()->json($e->getMessage(), 500);
          }

    }

    public function append(){
        return [

        ];
    }
}
