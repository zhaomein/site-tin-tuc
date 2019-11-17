@extends('admin/index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                <i class="fa fa-list-alt"></i>
                </div>
                <p class="card-category">Số bài viết</p>
                <h3 class="card-title">{{$info['allPosts']}}
                <small>bài</small>
                </h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                <i class="material-icons text-danger">add</i>
                <a href="/admin/posts/create">Viết bài</a>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                <i class="fa fa-folder"></i>
                </div>
                <p class="card-category">Số danh mục</p>
                <h3 class="card-title">{{$info['allCats']}}</h3>
            </div>
            <div class="card-footer">
            @if($loginUser->role_id <= 2)
                <div class="stats">
                    <i class="material-icons text-danger">add</i>
                    <a href="/admin/categories/create">Thêm mới</a>
                </div>
                @endif
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                <i class="material-icons">person</i>
                </div>
                <p class="card-category">Người dùng</p>
                <h3 class="card-title">{{$info['allUsers']}}</h3>
            </div>
            <div class="card-footer">
            @if($loginUser->role_id == 1)
                <div class="stats">
                <i class="material-icons">add</i>
                <a href="/admin/users/create">Thêm người dùng</a>
                </div>
            @endif
            </div>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
                <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <h4 class="nav-tabs-title">Bài viết được quan tâm</h4>
                    <ul class="nav nav-tabs fright" data-tabs="tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('posts.create')}}" >
                            <i class="material-icons">add</i> Thêm mới
                            <div class="ripple-container"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="clear"></div>
                </div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                <div class="tab-pane active" id="profile">
                    <table class="table">
                    <tbody>
                        <tr>
                        @foreach ($posts as $post)
                            <td><a href="/{{$post->category->slug}}/{{$post->slug}}_pid-{{$post->id}}.html">{{ $post->title }}</a>
                            <td class="td-actions text-right">
                                @if($loginUser->id == $post->user_id || $loginUser->role_id <=2 )
                                    <a href="{{ route('posts.edit',['id'=> $post->id ]) }}">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a href="#" data-url="{{ route('posts.destroy',['id'=> $post->id ]) }}" class="delete">
                                        <i class="material-icons">close</i>
                                    </a>
                                @endif
                            </td>
                            </tr>
                            <tr>
                        @endforeach

                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title">Danh sách quản trị viên có bài đăng nhiều nhất</h4>
                {{-- <p class="card-category">New employees on 15th September, 2016</p> --}}
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                <thead class="text-warning">
                    <th>ID</th>
                    <th>Tên</th>
                    {{-- <th>Salary</th> --}}
                    <th>Số bài viết</th>
                </thead>
                <tbody>
                @foreach ($usersRank as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{$user->postCount}}</td>
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
        $('.delete').click(function(e) {
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
