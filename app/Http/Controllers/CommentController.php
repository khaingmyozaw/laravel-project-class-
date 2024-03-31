<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function delete($id)
    {
        $comment = Comment::find($id);

        if( Gate::allows('delete-comment', $comment) )
        {
            $comment->delete();
            return back();
        }
        
        return back()->with('info', 'Unauthorize');
    }

    public function create()
    {

        $validator = validator(request()->all(),[
            'article_id' => 'required',
            'content' => 'required',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $comment = new Comment;
        $comment->article_id = request()->article_id;
        $comment->content = request()->content;
        $comment->user_id = auth()->id();
        $comment->save(); // put comments to database

        return back();
    }
}
