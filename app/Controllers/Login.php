<?php
namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('users/login', ['title'=> 'Login']);
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();
        if ($user && password_verify($password, $user['password'])) {
            // Successful login
            session()->set('isLoggedIn', true);
            session()->set('user', $user);

            return redirect()->to('/');
        } else {
            // Invalid credentials
            //
            return redirect()->to('/user/login')->with('error', 'Invalid email or password');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}