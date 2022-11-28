@extends('layouts.admin')
@section('title')
     الأخبار
@endsection

@section('content')
    <div class="content-detached">
        <div class="content-body">
            <div class="card">


                <div class="card-body">


                    @if(isset($row))
                    <form action="{{route('admin.posts.update',$row->id)}}" method="post" class="submit-form">
                        @csrf
                    @method('put')
                    @else
                    <form action="{{route('admin.posts.store')}}" method="post" class="submit-form" enctype="multipart/form-data">
                        @csrf
                        @endif
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="recipient-title" class="col-form-label"> العنوان:</label>
                            <input type="text" class="form-control" name="title" value="{{$row->title ?? old('title')}}" id="recipient-title">
                            <span class="error red" id="name-error" style="color:red;"></span>
                           <div id="input-title" style="color: red"></div>


                            {{-- <span class="error red" id="title-error" style="color:red;"></span> --}}
                        </div>
                        <div class="form-group col-md-6">
                            <label for="subcat_id" class="col-form-label">القسم الفرعي</label>
                            <select name="subcat_id" class="form-control"  id="subcat_id">
                                <option value=""></option>
                                @foreach ($rows as $subcat)
                                <option value="{{ $subcat->id }}" @if(isset($row) && $row->subcat_id == $subcat->id) selected @endif >{{ $subcat->name }}</option>
                                @endforeach

                            </select>
                            <div id="input-subcat_id" style="color: red"></div>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="recipient-body" class="col-form-label"> نص البوست :</label>
                            <textarea name="body" id="summernote" class="textarea-2" cols="30" rows="10">{{ $row->body ?? old('body') }}</textarea>
                            <div id="input-body" style="color: red"></div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>رفع صورة :</label>
                                {{-- <div id="file-preview">
                                    <input type="file" name="image[]" class="form-control input-image" accept="image/*" onchange="previewFile(this)" multiple>
                                    <div>
                                        <img src="{{ $image ?? 'https://www.lifewire.com/thmb/2KYEaloqH6P4xz3c9Ot2GlPLuds=/1920x1080/smart/filters:no_upscale()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg' }}"
                                            class="img-border img-thumbnail" id="show-file">
                                    </div>
                                </div> --}}

                                    <input type="file" name="image[]" class="form-control input-image" accept="image/*" onchange="changImage(this)" multiple>
                                    <div id="input-image" style="color: red"></div>
                               @if(isset($row))



                                    <div class="row row-image">
                                    @foreach ($row->images as $img)
                                    <div class="column">
                                    <img src="{{ asset('storage/uploads/posts/'.$img->image)}}"
                                    class="img-border img-thumbnail"  id="show-file-{{ $img->id }}">
                                </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="row row-image">

                                </div>
                                @endif


                            </div>
                        </div>

                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary submit">حفظ</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>
@endsection
