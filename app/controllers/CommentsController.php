<?php

class CommentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        return json_encode(Comments::all());

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 *
	 * Not sure why'd you want to authenticate by only the secret_key in a real app
	 * in the event that two users have the same password.'
	
	 * I just call the users table, loop through until a match, manually authenticate
	 * the user and then insert a comment with their id as the author id.
	 *
	*/
	public function store(){  

        if (!Input::has('secret_key', 'comment')){
            die('no secret key or comment');
        }

        $users = User::all();

        foreach($users as $user){

            if (Hash::check(Input::get('secret_key'), $user->secret_key)){
                $validUser = User::find($user->id);
                Auth::login($validUser);
            }
        }
        if (empty(Auth::user()->id))
            die('user not found');
            
        $comment = new Comments;
        $comment->author_id = Auth::user()->id;
        $comment->comment = Input::get('comment');
        $comment->save();

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Comments::find($id);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	    if (!Input::has('secret_key', 'comment')){
            die('no secret key or comment');
        }

        $users = User::all();

        foreach($users as $user){

            if (Hash::check(Input::get('secret_key'), $user->secret_key)){
                $validUser = User::find($user->id);
                Auth::login($validUser);
            }
                
        }
        
        if (empty(Auth::user()->id))
            die('user not found');
            
        $comment = Comments::find($id);

        if(Auth::user()->id != $comment->author_id)
            die('wrong user');
            
        $comment->comment = Input::get('comment');
        $comment->save();
	}

	/**
	 * Delete the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function destroy($id)
	{
 
       Comments::destroy($id);
 
	}

}
