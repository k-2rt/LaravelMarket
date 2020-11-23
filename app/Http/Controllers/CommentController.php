<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Store comment
     *
     * @param Request $request
     * @param String $product_id
     * @return void
     */
    public function commentProduct(Request $request, $product_id)
    {
        if (Auth::check()) {
            $this->comment->create([
                'comment_text' => $request->input('comment_text'),
                'user_id' => Auth::id(),
                'product_id' => $product_id,
            ]);

            $notification = array(
                'message' => 'コメントをしました',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'ログインをして下さい',
                'alert-type' => 'warning'
            );
        }

        return redirect()->back()->with($notification);
    }

    /**
     * Delete comment
     *
     * @param String $id
     * @return void
     */
    public function deleteComment($id)
    {
        $this->comment->find($id)->delete();

        $notification = array(
            'message' => '削除しました',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }
}
