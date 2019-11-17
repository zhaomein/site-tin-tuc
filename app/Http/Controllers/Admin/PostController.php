<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Post;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\MessageBag;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(10);
        $posts->load('category', 'user');
        $currPage = 'posts';
        $title = 'Bài viết';
        return view('admin.post', compact('posts','currPage','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        $currPage = 'posts';
        $post = new Post();
        $edit = false;
        $title = 'Thêm bài viết';
        return view('admin.post_add_edit', compact('users','edit', 'post', 'categories','currPage','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //dd($request);
        $rule = [
            'title' => 'required|max:191',
            'thumb' => 'required|image',
            'content' => 'required|max:65535'
        ];

        $messenger = [
            'title.required' => 'Tiêu đề không được để trống.',
            'title.max' => 'Tiêu đề không quá 191 ký tự.',
            'thumb.required' => 'không được để trống phần ảnh',
            'thumb.image' => 'file ảnh phải có định dạng jpeg, png, bmp, gif hoặc svg',
            'content.required' => 'Nội dung không được để trống.',
            'content.max' => 'nội dung không quá 65535 ký tự',
        ];

        $validator = Validator::make($request->all(),$rule,$messenger);

        if (!$validator->fails()) {
            $file = $request->thumb;
            $file->move(public_path().'/uploads/', $file->getClientOriginalName());

            $newPost = new Post(); // khoi tao post moi.
            $newPost->title = $request->title;
            $newPost->thumb = $file->getClientOriginalName();

            if(empty($request->slug))
                $newPost->slug = str_slug($request->title, '-');
            else
                $newPost->slug = $request->slug;

                
            if(empty($request->desc))
                $newPost->desc = str_limit(strip_tags($request->content), 150);
            else
                $newPost->desc = strip_tags($request->desc);

            $newPost->views = 0;
            $newPost->content = $request->content;
            $newPost->category_id = $request->category;
            $newPost->user_id = Auth::user()->id;

            $newPost->save(); //luu thong tin

            return redirect(route('posts.index'));
        } else {
            return redirect(route('posts.create'))
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->role_id > 2 )
            die();
            
        $post = Post::find($id);
        $post->delete();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if(Auth::user()->role_id >2 && Auth::user()->id != $post->user_id)
            return redirect(route('posts.index'));

        $categories = Category::all();
        $currPage = 'posts';
        $edit = true;
        $title = 'Chỉnh sửa bài viết';
        return view('admin.post_add_edit', compact('id','post','categories', 'edit', 'currPage','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $newPost = Post::findOrFail($id);

        if(Auth::user()->role_id >2 && Auth::user()->id != $newPost->user_id)
            return redirect(route('posts.index'));
            
        $rule = [
            'title' => 'required|max:191',
            'thumb' => 'image',
            'content' => 'required|max:65535'
        ];

        $messenger = [
            'title.required' => 'Tiêu đề không được để trống.',
            'title.max' => 'Tiêu đề không quá 191 ký tự.',
            'thumb.image' => 'file ảnh phải có định dạng jpeg, png, bmp, gif hoặc svg',
            'content.required' => 'Nội dung không được để trống.',
            'content.max' => 'nội dung không quá 65535 ký tự',
        ];

        $validator = Validator::make($request->all(),$rule,$messenger);

        if (!$validator->fails()) {
            // dd($request->thumb);
            if($request->thumb) {
                $file = $request->thumb;
                $file->move(public_path().'/uploads/', $file->getClientOriginalName());
                $newPost->thumb = $file->getClientOriginalName();
            }

            $newPost->title = $request->title;
            if(empty($request->desc))
                $newPost->desc = str_limit(strip_tags($request->content), 150);
            else
                $newPost->desc = strip_tags($request->desc);

            if(empty($request->slug))
                $newPost->slug = str_slug($request->title, '-');
            else
                $newPost->slug = $request->slug;

            $newPost->content = $request->content;
            $newPost->category_id = $request->category;
            //$newPost->user_id = Auth::user()->id;
            $newPost->update(); //luu thong tin

            return redirect("/admin/posts/$id/edit");
        } else {
            return redirect("/admin/posts/$id/edit")
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect(route('posts.index'));
    }
}
