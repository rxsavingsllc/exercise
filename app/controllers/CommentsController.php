<?php

class CommentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Comment::all());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $credentials = array('password' => Input::get('secret_key'));

        if(!Auth::attempt($credentials))
        {
            return Response::json(array('status'=>'failed','message'=>'User Authentication Failed.'));
        }

        //Validate the data
        $validator = Validator::make(Input::all(), Comment::$rules);

        if($validator->fails())
        {
            return Response::json(array('status'=>'failed', 'message'=> $validator->messages()));
        }
        //Create our comment
        $comment = Comment::create(array('comment'=>Input::get('comment'), 'author_id'=>Auth::user()->id));

        //return our json
        return Response::json(array('status'=>'success', 'message'=>'Comment successfully created by '. $comment->author->fullName, 'comment'=> $comment));

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
        return Response::json(Comment::find($id));
	}


	/**
	 * Update the specified resource in storage.
	 *
     * TODO: Permissions question. Should others be allowed to edit someone else's comment?
     *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $credentials = array('password' => Input::get('secret_key'));

        if(!Auth::attempt($credentials))
        {
            return Response::json(array('status'=>'failed','message'=>'User Authentication Failed.'));
        }

        //Get our Comment
        $comment = Comment::findOrFail($id);

        //return Response::json(array('current'=>Auth::user(), 'author'=>$comment->author));

        if(!Auth::user()->isAuthor($comment))
        {
            return Response::json(array('status'=>'failed', 'message'=>'You are not the original author of this comment.'));
        }

        $comment->comment = Input::get('comment');
        $comment->save();

		return Response::json(array('status'=>'success', 'message'=>'Comment successfully updated.', 'comment'=> $comment));
	}

    /**
     * Delete a comment. Requires the deleting party to be the original author.
     *
     * @param $id
     * @return Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return Response::json(array('status'=>'success', 'message'=>'Comment successfully deleted.'));
    }


}
