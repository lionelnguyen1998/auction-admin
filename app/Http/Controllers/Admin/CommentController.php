<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($commentId)
    {
        Comment::where('comment_id', $commentId)->delete();
        return redirect()->back()->with('message','削除しました！');
    }

    public function create(Request $request)
    {
        Comment::create([
            'user_id' => $request->user_id,
            'auction_id' => $request->auction_id,
            'content' => $request->content
        ]);

        return redirect()->back();
    }
}
