<?php

namespace App\Controllers;

use App\Controllers\Api;
use App\Models\ShoeModel;
use Config\Database;
use PhpParser\Node\Expr\Cast\Double;

class Shoe extends BaseController
{
    const URL = 'https://shoes-collections.p.rapidapi.com/shoes';
    const HEADERS = [
		'X-RapidAPI-Host' => 'shoes-collections.p.rapidapi.com',
		'X-RapidAPI-Key' => '4f88a2703bmsh38f282b1b466c85p12baa6jsn95cad728b244',
        ];
    private $model;

    public function __construct()
    {
        $this->model = model(ShoeModel::class);
    }

    //saves a new shoe
    public function add()
    {
        helper('form');
        $data = [
            'title' => 'add shoe',
            'user' => session()->get('isLoggedIn') ? session()->get('user') : null,
        ];
        if (! $this->request->is('post')) {
            return (view('shoes/add', $data));
        }
        $image = $this->request->getFile('image');
        $post = $this->request->getPost(['name', 'price', 'description', 'quantity', 'rating_rate', 'rating_count']);
        if (! $this->validateData($post, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'required | is_image[image]',
            'description'  => 'required',
            'quantity' => 'required',
            'rating_rate' => 'required',
            'rating_count' => 'required'
        ])) {
            // The validation fails, so returns the form.
            return (view('shoes/add', $data));
        }
        if ($image->isValid() && !$image->hasMoved()) {
            // Define the directory where you want to save the uploaded file
            $directory = WRITEPATH . 'uploads/';

            // Generate a unique name for the file
            $newName = $image->getRandomName();

            // Move the file to the specified directory with the new name
            $image->move($directory, $newName);
            $this->model->save([
                'name' => $post['name'], 
                'price' => $post['price'], 
                'image' => $directory . $newName,
                'description' => $post['description'], 
                'quantity' => $post['quantity'], 
                'rating_rate' => $post['rating_rate'], 
                'rating_count' => $post['rating_count']
            ]);
        }else{
            return (view('shoes/add', $data));
        }
        $data['success'] = true;
        //success alert
        return view('main', $data);
    }

    public function index(): string
    {
        $this->store();
        $data = [
            'shoes' => $this->model->getShoes(),
            'title' => 'Shoes',
            'user' => session()->get('isLoggedIn') ? session()->get('user') : null,
        ];
        return view('main', $data);
    }
    public function get_shoe($id)
    {
        $shoe =$this->model->getShoes($id);
        $data = [
            'title' => $shoe['name'],
            'user' => session()->get('isLoggedIn') ? session()->get('user') : null,
            'shoe' => $shoe,
        ];
        return view('shoes/shoe', $data);
    }
    public function store()
    {
        if (! $this->model->getShoes() ){
            $apiCaller = new Api();
            $result = $apiCaller->callApi(self::URL, self::HEADERS);
            foreach($result as $shoeData){
                $shoe = [
                    'name' => $shoeData['name'],
                    'price' => (float) $shoeData['price'],
                    'image' => $shoeData['image'],
                    'description' => $shoeData['description'],
                    'quantity' => (int) $shoeData['quantity'],
                    'rating_rate' => (float) $shoeData['rating']['rate'],
                    'rating_count' => (int) $shoeData['rating']['count'],
                ];
                $this->model->save($shoe);
            }
        }
    }
}
