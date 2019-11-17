@extends('admin/index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-10">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title fleft">
                    @if($edit)
                        Cập nhật thông tin người dùng
                    @else
                        Thêm mới người dùng
                    @endif
                </h4>
            </div>

            <div class="card-body">
            <form method="POST" action="{{ $edit ? route('users.update', ['id' => $user->id]) :route('users.store') }}">
                @csrf
                @if($edit)
                    {{ method_field('PUT') }}
                @endif
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Username</label>
                        <input type="text" class="form-control" name="username" value="{{$user->username}}">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Email</label>
                        <input type="email" class="form-control" name="email" value="{{$user->email}}">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Mật khẩu</label>
                        <input type="password" name="newPassword" class="form-control" value="{{$user->newPassword}}">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Nhập lại mật khẩu</label>
                        <input type="password" name="retypeNewPassword" class="form-control" value="{{$user->email}}">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Họ và tên</label>
                        <input type="text" class="form-control" name="fullname" value="{{$user->fullname}}">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control"  name="role" style="height: 36px">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}" {{$role->id == $user->role_id? 'selected': ''}}>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if($errors->any())
                            <h3 style="color: red;">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </h3>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">
                    @if($edit)
                        Cập nhật
                    @else
                        Thêm mới
                    @endif
                </button>
                <div class="clearfix"></div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

