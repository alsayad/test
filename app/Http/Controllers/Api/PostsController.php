<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\PostResource;
use Validator;

class PostsController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $posts = PostResource::collection(Post::paginate(2));
        return $this->apiResponse($posts);
    }

    public function show($id){
        $post = Post::find($id);
        if($post)
            return $this->apiResponse(new PostResource($post));
        else
            return $this->apiResponse(null,'not found',404);

    }

    public function store(Request $request){

        $validate = Validator::make($request->all(),[
                'title' => 'required|min:3|max:255',
                'body' => 'required'
        ]);

        if($validate->fails()){
            return $this->apiResponse(null,$validate->errors(),422);
        }

        $post = Post::create($request->all());

         if($post)
            return $this->apiResponse($post);
            
    }
}
