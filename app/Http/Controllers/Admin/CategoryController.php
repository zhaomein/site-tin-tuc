<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        $currPage = 'categories';
        $title = 'Danh mục tin';
        return view('admin.category', compact('categories','currPage','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currPage = 'categories';
        $title = 'Thêm mới danh mục tin';
        $edit = false;
        $category = new Category();
        return view('admin.category_add_edit', compact('currPage','category','title', 'edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5|max:50',
            'desc' =>'required|min:10',
            'slug' => 'required|min:5|unique:categories,slug,'.$request->slug
        ];
        $messages = [
            'slug.required' => 'Slug là trường bắt buộc',
            'slug.min' => 'Slug phải chứa ít nhất 5 kí tự',
            'slug.unique' => 'Slug đã tồn tại. Slug phải là duy nhất.',
            'desc.min' => 'Mô tả phải chứa ít nhất 10 kí tự',
            'desc.required' => 'Số điện thoại là trường bắt buộc',
            'phone.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và gồm 10 chữ số.',
            'name.required' => 'Tên là trường bắt buộc',
            'name.min' => 'Tên phải chứa ít nhất 5 kí tự',
            'name.max' => 'Tên chỉ chứa tối đa 50 kí tự'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // dd($request->all());
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $newCategory = new Category();
            $newCategory->name = $request->name;
            $newCategory->desc = $request->desc;
            $newCategory->slug = $request->slug;
            $newCategory->parent= 0;
    
            $newCategory->save(); //update thong tin.
            return redirect(route('categories.index'));
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
        $cat = Category::find($id);
        $cat->delete();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('id',$id)->first();
        $currPage = 'categories';
        $title = 'Chỉnh sửa danh mục tin';
        $edit = true;
        return view('admin.category_add_edit', compact('id','edit','category','currPage','title'));
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
        $newCategory = Category::find($id);

        $rules = [
            'name' => 'required|min:5|max:50',
            'desc' =>'required|min:10',
            'slug' => 'required|min:5|unique:categories,slug,'.$request->slug
        ];
        $messages = [
            'slug.required' => 'Slug là trường bắt buộc',
            'slug.min' => 'Slug phải chứa ít nhất 5 kí tự',
            'slug.unique' => 'Slug đã tồn tại. Slug phải là duy nhất.',
            'desc.min' => 'Mô tả phải chứa ít nhất 10 kí tự',
            'desc.required' => 'Số điện thoại là trường bắt buộc',
            'phone.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và gồm 10 chữ số.',
            'name.required' => 'Tên là trường bắt buộc',
            'name.min' => 'Tên phải chứa ít nhất 5 kí tự',
            'name.max' => 'Tên chỉ chứa tối đa 50 kí tự'
        ];

        if($newCategory->slug == $request->slug) 
            unset($rules['slug']);

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // dd($request->all());
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $newCategory->name = $request->name;
            $newCategory->desc = $request->desc;
            $newCategory->slug = $request->slug;
            $newCategory->parent= 0;
    
            $newCategory->update(); //update thong tin.
            return redirect(route('categories.index'));
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
        //
    }
}
