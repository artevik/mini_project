<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\PostComment;
use App\Rules\Captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $validator = Validator::make($request->all(), [
            'name' 		=> 'required|max:120',
            'email' 	=> 'required|email|max:191',
            'comment' 	=> 'required|min:5|max:2000',
            /*'g-recaptcha-response' => ['required', new Captcha]*/
        ]);

        if(!Auth::check()){
            $notification = array(
                'message'    => 'Чтобы оставить сообщение зарегистрируйтесь',
                'title'      => 'Внимание',
                'alert-type' => 'info',
            );

            return redirect()->route('showPost', $post_id)->with($notification);
        }

        if($validator->fails()){
            $notification = array(
                'message'    => 'Не удалось добавить сообщение',
                'title'      => 'Ошибка',
                'alert-type' => 'warning',
            );

            return redirect()->route('showPost', $post_id)->with($notification);
        }

        $post = Post::findOrFail($post_id);

        $comment = new Comment();
        $comment->name 		    = $request['name'];
        $comment->email 	    = $request['email'];
        $comment->comment 	    = $request['comment'];
        $comment->approved 	    = 1;
        $comment->published_at 	= date("Y-m-d H:i:s");

        $comment->save();

        if(isset($request->parent_id)) {
            $post_comment = new PostComment();
            $post_comment->id_post = $post_id;
            $post_comment->id_comment = $comment->id;

            if($request->parent_id === $comment->id) {
                $post_comment->id_parent_comment = 0;
            } else {
                $post_comment->id_parent_comment = $request->parent_id;
            }

            $post_comment->timestamps = date("Y-m-d H:i:s");

            $post_comment->save();
        } else {
            $post->comments()->attach($comment->id, ['id_parent_comment' => $request->parent_id]);
        }

        $notification = array(
            'message'    => 'Новое сообщение добавлено',
            'title'      => 'Удачно',
            'alert-type' => 'success',
        );

        return redirect()->route('showPost', [$post->id])->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comments)
    {
        //
    }

    public function replyStore(Request $request) {

        return back();
    }
}
