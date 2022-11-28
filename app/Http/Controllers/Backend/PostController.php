<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Models\Image;
use App\Models\Subcat;
use App\Traits\upload;
use App\Traits\uploadImage;
use Illuminate\Http\Request;
use App\DataTables\PostDataTable;
use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BackendController;

class PostController extends BackendController
{
    use uploadImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(PostDataTable $dataTable,Post $post)
    {
       parent::__construct($dataTable,$post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function append(){

        return [
            'rows'=>Subcat::select('name','id')->get(),

        ];
     }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostService $service,PostRequest $request)
    {

try {
            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->body;
            $post->subcat_id = $request->subcat_id;
            $post->save();

               foreach($request->file('image') as $image)
               {
                $fileData = $this->uploads($image,'uploads/posts/');

                   $image = $fileData['fileName'];
                   $post->images()->create(['image'=>$image]);

               }



            return response()->json(['title'=>'نجاح','message'=>'تم الحفظ بنجاح','status'=>'success']);
        } catch (\Exception $e) {
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
    public function update(PostRequest $request, $id)
    {

        try {

            $post = Post::findOrFail($id);
            if($file = $request->file('image')) {

                foreach($request->file('image') as $image)
               {

               $fileData = $this->uploads($image,'uploads/posts/');

                 // $new_image = $fileData['fileName'];
                 // $this->removeFile($image,'uploads/posts/');
                  foreach($post->images as $img){
                      $img->delete();
                  }
                  $post->images()->create(['image'=>$fileData['fileName']]);
               }

        }
           $post->update($request->all());

           return response()->json(['title'=>'نجاح','message'=>'تم التحديث بنجاح ','status'=>'success']);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }



    public function Gallery($id){
        $images = Image::where('post_id',$id)->get();

        return response()->json($images);
    }
}
