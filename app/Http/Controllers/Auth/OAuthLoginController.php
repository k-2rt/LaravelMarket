<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Storage;

class OAuthLoginController extends Controller
{
    public function socialLogin($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $getInfo = Socialite::driver($provider)->user();

            $user = $this->createUser($getInfo,$provider);

            auth()->login($user);

            return redirect()->to('/home');
        }catch(Exception $e){
            return redirect("/login");
        }
    }

    function createUser($getInfo,$provider)
    {
        $user = User::where('provider_id', $getInfo->id)->first();

        if (!$user) {
            $img = file_get_contents($getInfo->getAvatar());
            $file_name = '';
            if ($img !== false) {
                $file_name = $getInfo->id . '_' . uniqid() . '.jpg';
                Storage::disk('s3')->put('public/profile_images/' . $file_name, $img, 'public');
            }

            $user = User::create([
                'name'     => $getInfo->getName(),
                'kana'     => $getInfo->getNickname(),
                'email'    => $getInfo->getEmail(),
                'avatar'    => $file_name,
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
        }

        return $user;
    }
}
