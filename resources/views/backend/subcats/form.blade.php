@extends('layouts.admin')
@section('title')
    الاقسام الفرعية
@endsection

@section('content')
    <div class="content-detached">
        <div class="content-body">
            <div class="card">


                <div class="card-body">


                    @if (isset($row))
                        <form action="{{ route('admin.subcats.update', $row->id) }}" method="post" class="submit-form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                        @else
                            <form action="{{ route('admin.subcats.store') }}" method="post" class="submit-form"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                    @endif
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                            <input type="text" class="form-control" name="name" value="{{ $row->name ?? old('name') }}"
                                id="name">
                                <div id="input-name" style="color: red"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="recipient-cat_id" class="col-form-label"> القسم الرئيسي:</label>
                            <select name="cat_id" id="cat_id" class="form-control">
                                <option value="">أختر ...</option>
                                @foreach ($rows as $cat)
                                    <option value="{{ $cat->id }}" @if(isset($row)) {{ $cat->id == $row->cat_id ? 'selected':'' }} @endif>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <div id="input-cat_id" style="color: red"></div>
                        </div>
                    </div>


                    <div class="modal-footer">

                        <button type="submit" class="btn btn-outline-primary submit">حفظ</button>
                    </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
