@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Chỉnh Sửa Vị Trí</h6>
                    </div>
                    <div class="card-body">
                         <form action="{{ route('chinh-sua-vi-tri',['id'=>$data->ma_vi_tri]) }}" method="POST">{{--{{ route('vi-tri.store') }} --}}
                            @csrf
                            {{-- @dd($data)  --}}
                            <div class="mb-3">
                                <label for="ten_vi_tri" class="form-label">Tên vị trí</label>
                                
                                <input type="text" class="form-control" id="ten_vi_tri" name="ten_vi_tri" value="{{$data->ten_vi_tri}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
        </div>
        

        @include('layouts.footers.auth.footer')
    </div>
@endsection
