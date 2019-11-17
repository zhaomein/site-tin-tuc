<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use Carbon\Carbon;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        Carbon::setLocale('vi');
        
        $lastestPosts = $this->getLastestPosts();
        $postInCats = $this->getPostInCats();
        $randomPosts = Post::orderByRaw("RAND()")->limit(3)->get();
        $randomPosts->load('category', 'user');

        return view('index', compact('postInCats', 'randomPosts'));
    }

    public function getLastestPosts() {
        $lastestPosts = Post::limit(3)->orderBy("created_at", 'DESC')->get();
        $lastestPosts->load('category', 'user');
        return $lastestPosts;
    }

    public function getPostInCats() {
        $allCats = Category::all();
        $returnArr = [];
        $index = 0; 
        foreach($allCats as $cat) {
            $returnArr[] = [
                'type' => $index++ % 2 == 0? 'type-1': 'type-2',
                'catname' => $cat->name,
                'posts' => Post::where('category_id', $cat->id)->limit(5)->get()
            ];
        }

        return $returnArr;
    }
}
