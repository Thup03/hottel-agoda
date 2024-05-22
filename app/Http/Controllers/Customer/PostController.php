<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Tag;
use App\Post;
use App\PostTags;
use App\SupportTreatment;
use App\Utility;
use Session;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // posts list
    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(8);;
        return view('posts_list', compact('posts'));
    }

    // post topic
    public function postTopic($slug)
    {
        $category = DB::table('categories')
        ->select('name')
        ->where('slug', $slug)
        ->first();
        
        if($category){
            $title = $category->name;
            $posts =  DB::table('posts')
            ->select('posts.*','categories.name')
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->where('categories.slug', $slug)
            ->paginate(8);
            return view('posts_list', compact('posts', 'title'));
        }
        return view('404');
    }

    // post detail
    public function postDetail($slug)
    {
        $post_key = 'post' . $slug;
		$current_time = time(); 
		if (Session::has($post_key)) {
			if($current_time - Session::get($post_key) > 1800){
				Post::where('slug',$slug)->firstOrFail()->increment('view_count');
				Session::put(
					[
						$post_key => $current_time,
					]);
			}
		}
		else{
			Post::where('slug',$slug)->firstOrFail()->increment('view_count');
			Session::put(
				[
					$post_key =>$current_time,
				]);
		}
        $post = Post::where('slug',$slug)->firstOrFail();
        $post_tags = PostTags::select('tags.name', 'tags.slug')
        ->join('tags', 'tags.id', '=', 'post_tags.tag_id')
        ->where('post_tags.post_id', $post->id)
        ->get();
        if(isset($post)){
            return view('post_detail', ['post' => $post, 'post_tags' => $post_tags]);
        }
    }

    // posts - tag
    public function postTag($slug){
        $tag = Tag::where('slug', $slug)->first();
        if($tag){
            $post_tags = $tag->post_tags()->get()->unique('post_id');
            if(count($post_tags) > 0){
                $posts = Post::where(function($query) use($post_tags)
                {
                    foreach($post_tags as $value){
                        $query->orWhere('id', $value->post_id);
                    }
                })->orderBy('created_at', 'desc')->paginate(8);
                return view('posts_list', ['posts' => $posts, 'title' => $tag->name]);
            }
            $posts = null;
            return view('posts_list', ['posts' => $posts, 'title' => $tag->name]);
        }
        return view('404');
	}

    // product detail
    public function productDetail($slug)
    {
        $support_treatment = '';
        $utility = '';
        $product_key = 'product' . $slug;

		$current_time = time(); 
		if (Session::has($product_key)) {
			if($current_time - Session::get($product_key) > 1800){
                Product::where('slug',$slug)->firstOrFail()->increment('view_count');
				Session::put(
					[
						$product_key => $current_time,
					]);
			}
		}
		else{
            Product::where('slug',$slug)->firstOrFail()->increment('view_count');
			Session::put(
				[
					$product_key =>$current_time,
				]);
        }
        $product = DB::table('products')
        ->select('products.*','manufacturers.name as manufacturer_name', 
        'units.name as unit_name')
        ->join('manufacturers', 'manufacturers.id', '=', 'products.manufacturer_id')
        ->join('units', 'units.id', '=', 'products.unit')
        ->where('products.slug', $slug)
        ->where('products.status', 1)
        ->first();
        if(isset($product)){
            $related_products = Product::where('manufacturer_id', $product->manufacturer_id)
            ->where('id', '!=', $product->id)->where('status', 1)
            ->take(12)->get();

            if($product->type==0){
                $suggest_products = Product::where('pathology_id', $product->pathology_id)
                ->where('id', '!=', $product->id)->where('status', 1)->get();
            }
            elseif($product->type==1){
                $support_treatment = SupportTreatment::select('name')->where('id', $product->support_treatment_id)->first();
                $support_treatment = $support_treatment->name;
                $suggest_products = Product::where('support_treatment_id', $product->support_treatment_id)
                ->where('id', '!=', $product->id)->where('status', 1)->get();
            }
            elseif($product->type==2){
                $utility = Utility::select('name')->where('id', $product->utility_id)->first();
                $utility = $utility->name;
                $suggest_products = Product::where('utility_id', $product->utility_id)
                ->where('id', '!=', $product->id)->where('status', 1)->get();
            }
            elseif($product->type==3){
                $utility = Utility::select('name')->where('id', $product->utility_id)->first();
                $utility = $utility->name;
                $suggest_products = Product::where('utility_id', $product->utility_id)
                ->where('id', '!=', $product->id)->where('status', 1)->get();
            }

            return view('product_detail', compact('product', 'related_products', 'suggest_products', 'support_treatment', 'utility'));
        }
    }

    // email subcribe
    public function subscribe(Request $request){
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|email',
        // ],

        // [
        //     'email.required' => 'Bạn cần nhập email',
        //     'email.email' => 'Email không đúng định dạng',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['is' => 'failed', 'error'=>$validator->errors()->all()]);
        // }
        // $data['email'] = $request->email;
        // $check_email = Newsletter::where('email', $data['email'])->first();
        // if($check_email){
        //     return response()->json(['is' => 'unsuccess', 'uncomplete'=>'Email đã đăng kí nhận tin']);
        // }
        // $flag = Newsletter::create($data);
        // if($flag){
        //     return response()->json(['is' => 'success', 'complete'=>'Đăng kí nhận tin thành công']);
        // }
        // return response()->json(['is' => 'unsuccess', 'uncomplete'=>'Hệ thống gặp sự cố từ chối nhận thêm email']);
    }
}


