<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;

class SocialiteAuthenticationController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /***************************SOCIALITE*****************************/
    /**
     *Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect()->route('home');
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        // Check if the user is having any Socialite Login details
        $authUser = User::where('provider_id', $user->id)->first();

        if (empty($authUser) || is_null($authUser)) {
            $checker = [
                'email'    => $user->getEmail(),
                'username' => $user->getNickname(),
                'provider' => $provider,
            ];
            $authUser = $this->createOrUpdate($user, $checker);

            $regular_level = AuthorizationLevel::where('type', 'regular')->where('flag', 'default')->first();
            $dependency = array(
                'subject_type' => 'user',
                'subject_id'   => $authUser->id,
                'owner_id'     => $authUser->id,
                'user_id'      => $authUser->id,
                'level_id'     => $regular_level->id,
                'type'         => 'regular',
                'is_default'   => 1,
                'is_login'     => 1,
                'joining_at'   => now()
            );
            AuthorizationDependency::create($dependency);
            event(new Registered($authUser));
            if (userHasPrivilege(['user.email_verification'])) {
                $authUser->sendEmailVerificationNotification();
            }

            /* Logging of activity of sign-up*/
            activity()->performedOn($authUser)
                ->withProperties(['name'=>($authUser->username)? $authUser->username:$authUser->email,'by'=>$authUser->fullname])
                ->causedBy($authUser)
                ->log('Account accessed with '.$provider);
            /* Logging of activity of sign-up*/
        }

        return $authUser;
    }

    private function getFullname($checker = null)
    {
        if ($checker['provider']=='twitter') {
            return $fullname = User::whereUsername($checker['username'])->first()?->fullname;
        }

        return $fullname = User::whereEmail($checker['email'])->first()?->fullname;
    }

    private function getAvatar($checker = null)
    {
        if ($checker['provider']=='twitter') {
            return User::whereUsername($checker['username'])->first()?->profile_picture;
        }
        return $profile_picture = User::whereEmail($checker['email'])->first()?->profile_picture;
    }

    private function getEmail($checker = null)
    {
        if ($checker['provider']=='twitter') {
            return User::whereUsername($checker['username'])->first()?->email;
        }
        return User::whereEmail($checker['email'])->first()?->email;
    }

    private function getUsername($checker = null)
    {
        if ($checker['provider']=='twitter') {
            return User::whereUsername($checker['username'])->first()?->username;
        }
        return User::whereEmail($checker['email'])->first()?->username;
    }

    private function fetchProviderAvatar($user, $provider)
    {
        if ($provider == 'facebook') {
            return  $user->avatar_original;
        }

        if ($provider == 'google') {
            return $user->getAvatar();
        }

        if ($provider == 'twitter') {
            if (isset($user->user['profile_image_url_https'])) {
                return str_replace('_normal', '', $user->user['profile_image_url_https']);
            }

            return str_replace('_normal', '', $user->getAvatar());
        }

        return null;
    }


    private function createOrUpdate($data, $checker)
    {
        $fullname = is_null($this->getFullname($checker))? $data->getName(): $this->getFullname($checker);
        $profile_picture = is_null($this->getAvatar($checker)) ? $this->fetchProviderAvatar($data, $checker['provider']) : $this->getAvatar($checker);
        $email = is_null($this->getEmail($checker))? $data->getEmail() : $this->getEmail($checker);
        $username = is_null($this->getUsername($checker))? $data->getNickname() : $this->getUsername($checker);
        $user = User::where('username', '=', $username)->get();

        if ($checker['provider']=='twitter') {
            return User::updateOrCreate(['username'=> $username], [
                'fullname'          => $fullname,
                'username'          => $username,
                'email'             => $email,
                'provider'          => $checker['provider'],
                'provider_id'       => $data->id,
                'profile_picture'   => $profile_picture,
                'status'            => 'active',
                'email_verified_at' => now(),
            ]);
        }

        return User::updateOrCreate(['email'=> $email], [
            'fullname'          => $fullname,
            'username'          => $username,
            'email'             => $email,
            'provider'          => $checker['provider'],
            'provider_id'       => $data->id,
            'profile_picture'   => $profile_picture,
            'status'            => 'active',
            'email_verified_at' => now(),
        ]);
    }
    /***************************SOCIALITE*****************************/
}
