<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Firebase\Auth\Token\Exception\InvalidToken;
use Illuminate\Http\JsonResponse;
use Kreait\Firebase;
class LoginAction extends Controller
{
    private $firebase;
    public function __construct(Firebase $firebase)
    {
        $this->firebase = $firebase;
    }    
    public function login(Request $request):JsonResponse{
        $id_token = $request->input('idToken');
        try {
            $verifiedIdToken = $this->firebase->getAuth()->verifyIdToken($id_token);
        } catch (InvalidToken $e) {
            return response()->json([
                'error' => 'error!!',
            ]);
        }
        $uid = $verifiedIdToken->getClaim('sub');
        $firebase_user = $this->firebase->getAuth()->getUser($uid);
        $user = \App\User::firstOrCreate(
            ['uid' => $uid],
            ['na' => $firebase_user->displayName],
            ['avatar' => $firebase_user->photoUrl]
        );
        $token = $user->createToken('example_token')->accessToken;
        return response()->json(
        ['user'=>
          ['id' => $uid, 'na' => $firebase_user->displayName,'avatar' => $firebase_user->photoUrl,],
        'token' => $token,
        ]);
    }
}
