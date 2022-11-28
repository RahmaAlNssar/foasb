<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\DataTables\MessageDataTable;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index(MessageDataTable $dataTable)
    {
        try{

            return $dataTable->render('backend.includes.table');

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
