<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(UserRequest $reqest)
    {
        $data = $reqest->except('image');
        $data['type'] = 'user';
        $data['password'] = bcrypt($reqest->password);
        unset($data['password_confirmation']);
        $user = User::create($data);
        if ($reqest->image != null) {
            $path = store_file($reqest->image, 'users');
            $user->image()->create(['path' => $path]);
        }
        Auth::login($user);
        $data = [
            'user' => new UserResource($user),
            'token' =>  $user->createToken('MyApp')->plainTextToken
        ];
        return $this->returnData($data, 'تم انشاء الحساب بنجاح');
    }

    public function login(LoginRequest $reqest)
    {
        $data = $reqest->only('email', 'password');
        if (Auth::attempt($data)) {
            $user = auth()->user();

            if (!$user->status->value) {
                return $this->returnError('لايمكنك تسجيل الدخول برجاء التواصل مع اداره الموقع');
            }
            $data = [
                'user' => new UserResource($user),
                'token' =>  $user->createToken('MyApp')->plainTextToken
            ];
            return $this->returnData($data, 'تم تسجيل الدخول  بنجاح');
        }
        return $this->returnError('البيانات غير صحيحه');
    }

    public function profile()
    {
        $user = auth()->user();
        return $this->returnData(new UserResource($user));
    }

    public function update_profile(UpdateProfileRequest $reqest)
    {
        $data = $reqest->except('image');
        $user = auth()->user();
        if ($reqest->password) {
            $data['password'] =  bcrypt($reqest->password);
            unset($data['password_confirmation']);
        } else {
            $data['password'] =  $user->password;
        }

        if ($reqest->image) {
            if ($user->image) {
                $path = store_file($reqest->image, 'users');
                delete_file($user->image->path);
                $user->image()->update(['path' => $path]);
            } else {
                $path = store_file($reqest->image, 'users');
                $user->image()->create(['path' => $path]);
            }
        }
        $user->update($data);
        return $this->returnData(new UserResource($user), 'تم حفظ البيانات بنجاح');
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->returnSuccessMessage('تم تسجيل الخروج بنجاح');
    }
}