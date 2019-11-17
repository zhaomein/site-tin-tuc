@extends('admin/index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title fleft">Đổi mật khẩu</h4>
                </div>

                <div class="card-body">
                <form method="POST" action="{{ route('editpassword.post')}}">
                    @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Mật khẩu hiện tại</label>
                                    <input type="password" name="current-password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Mật khẩu mới</label>
                                <input type="password" name="new-password" class="form-control">
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nhập lại mật khẩu</label>
                                <input type="password" name="retype-new-password" class="form-control">
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
                        <button type="submit" class="btn btn-primary pull-right" onclick="check()">Đổi mật khẩu</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
