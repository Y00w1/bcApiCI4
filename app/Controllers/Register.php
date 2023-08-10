<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class Register extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = ['title'=> 'Register'];
        echo view('users/register', $data);
    }

    /**
     * The above function is a PHP code snippet that handles the registration process for a user,
     * including form validation, saving user data to the database, and setting session variables.
     * 
     * @return a view called 'main' with the title 'Shoes' and the user data.
     */
    public function store()
    {
        helper(['form']);

        if (! $this->request->is('post')){
            return view('users/register');
        }
        $post = $this->request->getPost(['name', 'email', 'password', 'confirmPassword']);
        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required',
            'repeat_password' => 'matches[password]',
        ];
        if(! $this->validate($rules)){
            return view('user/register');
        }
        $userModel = model(UserModel::class);
        $data = [
            'name' => $post['name'],
            'email' => $post['email'],
            'password' => password_hash($post['password'] ,PASSWORD_DEFAULT)
        ];
        $userModel->save($data);
        $user = $userModel->where('email', $data['email'])->first();
        session()->set('isLoggedIn', true);
        session()->set('user', $user);
        return view('main', ['title' => 'Shoes', 'user' => $user]);
    }
}