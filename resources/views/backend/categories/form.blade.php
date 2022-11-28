@extends('layouts.admin')
@section('title')
    الاقسام الرئيسية
@endsection

@section('content')
    <div class="content-detached">
        <div class="content-body">
            <div class="card">


                <div class="card-body">


                    @if (isset($row))
                        <form action="{{ route('admin.categories.update', $row->id) }}" method="post" class="submit-form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                        @else
                            <form action="{{ route('admin.categories.store') }}" method="post" class="submit-form"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                    @endif
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                        <input type="text" class="form-control" name="name" value="{{ $row->name ?? old('name') }}"
                            id="name">
                            <div id="input-name" style="color: red"></div>
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
