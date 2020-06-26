<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return User
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->password = bcrypt('12345678');
        $user->save();

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrfail($id);

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
        $user = User::findOrfail($id);
        $user->fill($request->all());

        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->email = $user->email . "_" . $user->id;
        $user->save();
        $user->delete();

        return $user;
    }


    public function resetPassword($token)
    {
        $saveTokens = DB::table('password_resets')->where('deleted_at',null)->get();
        foreach($saveTokens as $saveToken)
        {
            if(Hash::check($token,$saveToken->token))
            {
                $confirm = $saveToken;
                break;
            }
        }
        if(isset($confirm))
        {
            $user = User::where('email',$confirm->email)->first();

            return view('emails.resetPassword',compact(
                'user'
            ));
        }
        return route('home');
    }


    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::findOrfail($request->id);

        $saveTokens = DB::table('password_resets')->where('email',$user->email)->update(['deleted_at'=>Carbon::now()]);

        $user->password=bcrypt($request->password);

        $user->save();

        return view('emails.passwordSuccesfuly');

    }
}
