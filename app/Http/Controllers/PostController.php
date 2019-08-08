<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\PostComment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('approved', 1)->paginate(15);

        return view('frontend.main', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required',
            'image'       => 'required|image',
            'description' => 'required',
        ]);

        if($validator->fails()){

            $notification = array(
                'message'    => 'Не удалось создать пост',
                'title'      => 'Ошибка',
                'alert-type' => 'warning',
            );

            return redirect()->to('/posts')->with($notification);
        }

        $image = $request->file('image');
        $new_name = mt_rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/images'), $new_name);

        $form_data = array(
            'title'             =>   $request->title,
            'description'       =>   $request->description,
            'image'             =>   $new_name,
            'slug'              =>   mt_rand(),
            'approved'          =>   1,
            'published_at'      =>   date("Y-m-d H:i:s"),
        );

        //check user for login and give id user
        if (Auth::check()){
            // add post to db table posts
            $post = Post::create($form_data);

            $userId = Auth::user()->getUserId();

            $post->user()->syncWithoutDetaching($userId);

            $notification = array(
                'message' => 'Новый пост создан',
                'title' => 'Удачно',
                'alert-type' => 'success',
            );
        }

        return redirect()->to('/posts')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $posts = Post::paginate();

        $user = User::where('id', $post->user)->get();

        if(isset($request->sortByDate)){
            return response()->json($request->sortByDate);
        }

        return view('frontend.page.show', [
            'post' => $post,
            'posts' => $posts,
            'users' => $user
        ]);
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
        //
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
