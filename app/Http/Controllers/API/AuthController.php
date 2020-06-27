<?php

namespace App\Http\Controllers\API;
use App\Http\Requests\ChangeApiPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Notifications\ForgotPassword;
use App\User;
use \Laravel\Passport\Http\Controllers\AccessTokenController as ATC;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Response;
use Illuminate\Http\JsonResponse;

class AuthController extends ATC
{
    public function login(ServerRequestInterface $request) {

        try {
            //get username (default is :email)
            $username = $request->getParsedBody()['username'];

            //get user
            //change to 'email' if you want
            $user = User::where('email', '=', $username)->first();



            //generate token
            $tokenResponse = parent::issueToken($request);

            //convert response to json string
            $content = $tokenResponse->getContent();

            //convert json to array
            $data = json_decode($content, true);


            if(isset($data["error"]))
                throw new OAuthServerException('Los datos estan incorrectos', 6, 'invalid_credentials', 401);


                $user = collect($user)->only('email', 'name', 'last_name');

                $user->put('access_token', $data['access_token']);

                return Response::json($user);

            //add access token to user

        }
        catch (ModelNotFoundException $e) { // email notfound
            //return error message
            return response(["message" => "Usuario no encontrado"], 422);
        }
        catch (OAuthServerException $e) { //password not correct..token not granted
            //return error message
            return response(["message" => "Los datos estan incorrectos', 6, 'invalid_credentials"], 422);
        }
        catch (HttpResponseException $e) {
            return response()->json(['errors' => ['user_type' => ['El usuario no es un técnico']]],422);
        }
        catch (Exception $e) {
            return response(["message" => "Error interno de servicio"], 401);
        }
    }
    public function forgotPassword(ForgotPasswordRequest $request) {



        $user = User::where('email',$request->email)->first();
        if($user != null)
        {

            $user->notify(new ForgotPassword());
        }
        return "Se ha enviado un correo a la dirección";
    }

    public function changePassword(ChangeApiPasswordRequest $request) {


        if ($request->new_password_confirmation === $request->new_password) {
            $user = User::where('email', $request->email)->first();
            if($user != null)
            {
                $user->password = bcrypt($request->new_password);
                $user->save();
                return "La contraseña se ha cambiado satisfactoriamente";
            } else {
                return "No se encontro el usuario";
            }
        } else {
            return "Las contraseñas no coinciden";
        }



    }
}
