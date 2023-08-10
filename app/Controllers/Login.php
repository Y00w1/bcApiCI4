<?php
namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('users/login', ['title'=> 'Login']);
    }

    /**
     * The login function checks if the provided email and password match a user in the database, and
     * if so, sets the user as logged in and redirects to the homepage, otherwise it redirects back to
     * the login page with an error message.
     * 
     * @return redirect response. If the login is successful, it redirects the user to the homepage
     * ("/"). If the login fails, it redirects the user back to the login page ("/user/login") with an
     * error message.
     */
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

    /**
     * The above function logs out the user by destroying the session and redirecting them to the
     * homepage.
     * 
     * @return redirect response to the root URL ("/").
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}