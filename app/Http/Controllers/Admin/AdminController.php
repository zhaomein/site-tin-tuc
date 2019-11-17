<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use DB;

class AdminController extends Controller
{
    //
    public function __construct () {
        $this->middleware('auth');
    }
    public function getAdmin (){
        $currPage = 'dashboard';
        $title = 'Bảng tin';
        $countByUser =  DB::select("SELECT user_id, COUNT(user_id) as postcount FROM `posts` GROUP BY `user_id` ORDER BY postcount desc limit 5");

        $usersRank = [];
        foreach($countByUser as $c) {
            $crrUser = User::find($c->user_id);
            $crrUser->postCount = $c->postcount;
            $usersRank[] = $crrUser;
        }
        $posts = Post::orderBy('views', 'DESC')->limit(5)->get();


        $info = [
            'allPosts' => DB::table('posts')->count(),
            'allUsers' => DB::table('users')->count(),
            'allCats' => DB::table('categories')->count()
        ];

        return view('admin/admin', compact('usersRank','posts', 'currPage', 'title', 'info'));
    }

    public function postAdmin () {

    }
}
