@extends('layouts.admin')
@section('title')
    المدراء
@endsection

@section('content')

    <div class="content-detached">
        <div class="content-body">
            <div class="card card-primary">
                <div class="card-header" style="padding-top: 30px;">

                </div>

                <div class="card-body">


                    @if (isset($row))
                        <form action="{{ route('admin.admins.update', $row->id) }}" method="post" class="submit-form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                        @else
                            <form action="{{ route('admin.admins.store') }}" method="post" class="submit-form"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                    @endif
                    <div class="form-group">
                        <label for="recipient-username" class="col-form-label">الحساب:</label>
                        <input type="text" class="form-control" name="username" value="{{ $row->username ?? old('username') }}"
                            id="name">
                            <div id="input-username" style="color: red"></div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-email" class="col-form-label">البريد الالكتروني:</label>
                        <input type="email" class="form-control" name="email" value="{{ $row->email ?? old('email') }}"
                            id="email">
                            <div id="input-email" style="color: red"></div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-password" class="col-form-label">كلمة المرور:</label>
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                            id="password">
                            <div id="input-password" style="color: red"></div>
                    </div>

                    <div class="form-group" hidden>
                        <label for="password_confirmation" class="col-form-label">تأكيد كلمة المرور:</label>
                        {!! Form::password('confirm-password', ['class' => 'form-control']) !!}

                        <span class="error text-danger d-none"></span>
                    </div>
                    {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="recipient-role" class="col-form-label">المنصب:</label>

                            @if (isset($row))
                                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
                            @else
                                {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
                            @endif
                        </div>
                        <span class="error text-danger d-none"></span>
                    </div> --}}


                    <div class="modal-footer">

                        <button type="submit" class="btn btn-outline-primary submit">حفظ</button>
                    </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
