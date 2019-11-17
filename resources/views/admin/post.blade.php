@extends('admin/index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row"> 
        <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary">
                <div class="fleft">
                    <h4 class="card-title">Danh sách các bài viết</h4>
                </div>
                <ul class="nav nav-tabs fright" data-tabs="tabs">
                    <li class="nav-item ">
                        <a class="nav-link active" href="{{route('posts.create')}}">
                        <i class="material-icons">add</i> Thêm mới
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
                            <th width="20%">Tiêu đề</th>
                            <th>Ảnh</th>
                            <th>slug</th>
                            <th>Miêu tả</th>
                            <th>Loại tin</th>
                            <th>Tác giả</th>
                            <th>Ngày viết</th>
                            <th>Ngày cập nhập</th>
                        </thead>
                        <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td><img width="90px" src="{{ url('/uploads/'.$post->thumb) }}" /></td>
                                <td width= "20%">{{ $post->slug }}</td>
                                <td>{{ $post->desc }} </td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->user->fullname }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                                <td class="td-actions text-right">
                                    @if($loginUser->id == $post->user_id || $loginUser->role_id <=2 )
                                        <a href="{{ route('posts.edit',['id'=> $post->id ]) }}" class="btn btn-primary btn-link btn-sm "  style=" margin:30px 0px" data-original-title="Edit Task" aria-describedby="tooltip535830">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button type="submit" rel="tooltip" data-url="{{ route('posts.destroy',['id'=> $post->id ]) }}" class="btn btn-danger btn-link btn-sm delete">
                                            <i class="material-icons">close</i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="navigationn">
                    {{$posts->links()}}
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
 
