@extends('layouts.admin')

@section('content')
    <section class="content">

        <div class="container-fluid">
            <br>
            <div class="row col-lg-2  container">

                {{-- <a href="{{ route('backend.'.getModel().'.index') }}" class="btn btn-outline-info">
                    رجوع
                </a> --}}

            </div>
            <br>
            <div class="content-detached">
                <div class="content-body">
                    <div class="card">
                        <div class="card-body">
                            @if (isset($row))
                                <form action="" class="submit" method="post"
                                   enctype="multipart/form-data">
                                    @method('put')
                                @else
                                    <form action="" method="post" class="submit"
                                        enctype="multipart/form-data">
                                        <div class="body" id="content">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                            <button type="submit" class="btn btn-primary submit">حفظ</button>
                                        </div>
                            @endif
                            @csrf
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>


</section>
@endsection

