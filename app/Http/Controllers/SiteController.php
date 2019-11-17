<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use App\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function postDetail($catSlug, $slug, $postid) {
        $post = Post::where('slug', $slug)->first();
        $post->load('category');
        $post->views += 1;
        $post->update();
        $title = $post->title;
        $relatedPosts = Post::where('category_id', $post->category_id)->orderByRaw('RAND()')->limit(2)->get();
        return view('post_detail', compact('post', 'title', 'relatedPosts'));
    }

    public function category($catSlug) {
        $cat = Category::where('slug', $catSlug)->first();
        $title = $cat->name;
        $posts = Post::where('category_id', $cat->id)->paginate(6);
        return view('category', compact('posts', 'title', 'cat'));
    }

    public function author($username) {
        $user = User::where('username', $username)->first();
        $title = "Bài viết của " .$user->fullname;
        $posts = Post::where('user_id', $user->id)->paginate(10);
        return view('author', compact('posts', 'user', 'title'));
    }

    public function search(Request $request) {
        if(isset($request->q)) {
            $query = $request->q;
            $title = 'Kết quả tìm kiếm: '.$query;
            $posts = Post::where('title', 'LIKE', "%$query%")->paginate(10);
            return view('search', compact('posts','title', 'query'));
        }
        return redirect('/');
    }
}
