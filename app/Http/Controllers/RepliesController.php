<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function store(ReplyRequest $request,Reply $reply)
	{
        $this->validate($request,[
            'content' => 'required|max:140|min:2'
        ]);
        $reply->topic_id = $request->topic_id;
        $reply->user_id = Auth::id();
        $reply->content = $request->content;
        $reply->save();
		return redirect()->to($reply->topic->link())->with('success', '回复成功');
	}

	public function destroy(Reply $reply)
	{
		$this->authorize('destroy', $reply);
		$reply->delete();
		return redirect()->to($reply->topic->link())->with('success', '删除回复成功');
	}
}
