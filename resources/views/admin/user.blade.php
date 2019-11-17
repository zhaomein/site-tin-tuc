@extends('admin/index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary">
                <div class="fleft">
                    <h4 class="card-title">Danh sách người dùng</h4>
                </div>
                <ul class="nav nav-tabs fright" data-tabs="tabs">
                    <li class="nav-item ">
                        <a class="nav-link active" href="{{ route('users.create') }}">
                            <i class="material-icons">person_add</i> Thêm mới
                            <div class="ripple-container"></div>
                        </a>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="">
                            <th>ID</th>
                            <th>Tên người dùng</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Quyền</th>
                            <th>Ngày tạo</th>
                            <th></th>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr id="row-{{$user->id}}">
                                <td>{{ $user->id }} </td>
                                <th>{{ $user->username }}</th>
                                <td>{{ $user->fullname }}</td>
                                <td>{{ $user->email }} </td>
                                <td>{{ $user->role->name }}</th>
                                <td>{{ $user->created_at }}</td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" title="" class="btn btn-primary btn-link btn-sm">
                                        <a class="nav-link active" href="{{ $loginUser->id==$user->id?'/admin/profile':route('users.edit', $user->id )}}">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    </button>
                                    @if($user->id != $loginUser->id)
                                        <button type="submit" rel="tooltip" data-url="{{route('users.destroy', $user->id)}}" class="btn btn-danger btn-link btn-sm delete">
                                            <i class="material-icons">close</i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('button.delete').click(function(e) {
            e.preventDefault();
            _this = this;
            if(confirm('Bạn có chắc chắn muốn xóa?')) {
                $.ajax({
                    url: $(this).attr('data-url'),
                    success: function(data) {
                        $(_this).parent().parent().remove();
                        console.log('complate!');
                    }
                })
            }
        });
    });
</script>

@endsection

