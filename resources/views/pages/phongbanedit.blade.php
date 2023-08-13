@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Phòng ban'])
    <div class="container-fluid py-4">
        <div class="row">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Chỉnh Sửa Phòng Ban</h6>
                    </div>
                    <div class="card-body">
                         <form action="{{ route('chinh-sua-phong-ban',['id'=>$data->ma_phong_ban]) }}" method="POST">{{--{{ route('phong-ban.store') }} --}}
                            @csrf
                            {{-- @dd($data)  --}}
                            <div class="mb-3">
                                <label for="ten_phong_ban" class="form-label">Tên vị trí</label>
                                
                                <input type="text" class="form-control" id="ten_phong_ban" name="ten_phong_ban" value="{{$data->ten_phong_ban}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
        </div>
        

        @include('layouts.footers.auth.footer')
    </div>
@endsection
