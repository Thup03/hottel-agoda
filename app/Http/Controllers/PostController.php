<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\PostTags;
use Auth;
use Validator, File;
 

class PostController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Danh sách phòng';
        return view('post.posts_list', ['posts' => Post::all(), 'title' => $title]);
    }

    // ADMIN
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=> 'required|min:3|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
            'content' => 'required',
            'description' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],

        [
            'title.required'=>'Bạn chưa nhập tiêu đề.',
            'title.regex' => 'Tiêu đề không được chứa kí tự đặc biệt',
            'title.min'=>'Tiêu đề phải có ít nhất 3 kí tự.',
            'content.required' => 'Nội dung bài viết không được để trống',
            'description.required' => 'Phần mô tả không được để trống',
            'thumbnail.image' => 'Yêu cầu phải là ảnh có đuôi jpeg,png,jpg,gif',
            'thumbnail.mimes' => 'Yêu cầu phải là ảnh có đuôi jpeg,png,jpg,gif',
            'thumbnail.max' => 'Ảnh không vượt quá 2MB',
        ]);

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error'=>$validator->errors()->all()]);
        }else{
            $data = $request->all();
            unset($data['_token']);
            $data['slug'] = str_slug($data['title']);
            if ($files = $request->file('thumbnail')) {
                $destinationPath = 'images/'; // upload path
                $time = time();
                $fileName = $time."".date('YmdHis')."".$files->hashName();
                $files->move($destinationPath, $fileName);
                $data['thumbnail'] = $fileName;
            }

            if(Auth::guard('admin')->check()){
                $data['author'] = Auth::guard('admin')->user()->name;
            }

             // lay ra chuoi id cua tag, sau do tach ra cac gia tri cho vao mang tags_id
            $tags_id = explode(',', $data['tags']);

            unset($data['_token']);
            unset($data['tags']);

            $post = Post::create($data);

            if(isset($post)){
             $post_id = $post->id;

            if($tags_id[0] != null && count($tags_id) >= 1 ){
                $posts_tag['post_id'] = $post_id;
                for($i = 0; $i<sizeof($tags_id); $i++){
                    $posts_tag['tag_id'] = $tags_id[$i];
                    PostTags::create($posts_tag);
                }
            }
            return response()->json(['is' => 'success', 'complete'=>'Bài viết của bạn được thêm thành công']);
        }
        else{
            return response()->json(['is' => 'unsuccess', 'uncomplete'=>'Bài viết của bạn chưa được thêm']);
        }
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
        $post = Post::find($id);
        return $post;
    }


    public function showPost($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        return view('post.admin_post_detail', ['post' => $post, 'tags' => $tags]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = $request->all();
        $post = Post::find($data['id']);
        unset($data['_token']);
        unset($data['id']);
        $flag = $post->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->post_tags()->delete();
        Post::findOrFail($id)->delete();
    }

    // admin update post
    public function updatePost(Request $request){
        $validator = Validator::make($request->all(), 
            [
                'title'=> 'required|min:3||regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
                'description'=>'required|min:10',
                'content'=>'required',
            ],
            [
                'title.required'=>'Bạn chưa nhập tiêu đề.',
                'title.regex' => 'Tiêu đề không được chứa kí tự đặc biệt',
                'title.min'=>'Tiêu đề phải có ít nhất 3 kí tự.',
                'description.required'=> 'Bạn chưa nhập mô tả.',
                'description.min'=> 'Mô tả phải chứa ít nhất 10 kí tự',
                'content.required' => 'Bạn chưa nhập nội dung',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error'=>$validator->errors()->all()]);
        }else{
            $data = $request->all();
                        
            $post = Post::findOrFail($data['id']);

            $time = time();
            if ($files = $request->file('thumbnail')) {
                $destinationPath = 'images/'; // upload path
                $time = time();
                $fileName = $time."".date('YmdHis')."".$files->hashName();
                $files->move($destinationPath, $fileName);
                $data['thumbnail'] = $fileName;
            }
            else{
                $data['thumbnail'] = $post->thumbnail;
            }

            if(Auth::guard('admin')->check()){
                $data['author'] = Auth::guard('admin')->user()->name;
            }

             // lay ra chuoi id cua cates, sau do tach ra cac gia tri cho vao mang cates_id
            $tags_id = explode(',', $data['tags']);

            unset($data['_token']);
            unset($data['tags']);
            
            $post = $post->update($data);

            if(isset($post)){
                $post_id = $data['id'];

                if($tags_id[0] != null && count($tags_id) >= 1){
                    // delete tag
                    PostTags::where('post_id',$data['id'])->delete();
                    $posts_tag['post_id'] = $post_id;
                    for($i = 0; $i<sizeof($tags_id); $i++){
                        $posts_tag['tag_id'] = $tags_id[$i];
                        PostTags::create($posts_tag);
                    }
                }
                return response()->json(['is' => 'success', 'complete'=>'Bài viết được update thành công']);
            }
            else{
                return response()->json(['is' => 'unsuccess', 'uncomplete'=>'Bài viết chưa được update']);
            }
        }
    }
}
