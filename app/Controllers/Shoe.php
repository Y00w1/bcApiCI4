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

    
    /**
     * The function adds a shoe to the database and returns a view with a success message if the form
     * data is processed successfully.
     * 
     * @return a view. If the request is not a POST request, it returns the 'shoes/add' view with the
     * data. If the request is a POST request and the form data is successfully processed, it adds a
     * 'success' key to the data and returns the 'main' view with the updated data.
     */
    public function add()
    {
        helper('form');
        $data = [
            'title' => 'add shoe',
            'user' => session()->get('isLoggedIn') ? session()->get('user') : null,
        ];

        if (! $this->request->is('post')) {
            return view('shoes/add', $data);
        }

        if ($this->processFormData()) {
            $data['success'] = true;
        }

        return view('main', $data);
    }

/**
 * The function `processFormData()` processes form data by validating and saving the data, including an
 * uploaded image, to a model.
 * 
 * @return a boolean value. It returns true if the data processing was successful, and false if either
 * the data validation or image upload failed.
 */
private function processFormData()
    {
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
            return false; // Validation failed
        }

        $imagePath = $this->uploadImage($image);
        if (!$imagePath) {
            return false; // Image upload failed
        }

        $this->model->save([
            'name' => $post['name'], 
            'price' => $post['price'], 
            'image' => $imagePath,
            'description' => $post['description'], 
            'quantity' => $post['quantity'], 
            'rating_rate' => $post['rating_rate'], 
            'rating_count' => $post['rating_count']
        ]);

        return true; // Data processing was successful
    }

/**
 * The function `uploadImage` takes an image file, checks if it is valid and has not been moved, and
 * then moves it to a specified directory with a random name, returning the file path if successful.
 * 
 * @param image The parameter `` is expected to be an instance of the
 * `CodeIgniter\HTTP\Files\UploadedFile` class. This class represents an uploaded file and provides
 * methods to interact with it, such as checking if it is valid, moving it to a new location, and
 * generating a random
 * 
 * @return the path of the uploaded image if the image is valid and has not been moved. If the image
 * upload fails, it returns null.
 */
private function uploadImage($image)
    {
        if ($image->isValid() && ! $image->hasMoved()) {
            $directory = WRITEPATH . 'uploads/';
            $newName = $image->getRandomName();
            $image->move($directory, $newName);
            return $directory . $newName;
        }

        return null; // Image upload failed
    }

    /**
     * The index function retrieves shoe data and user information to be displayed on the main view,
     * while the get_shoe function retrieves specific shoe data to be displayed on the shoe view.
     * 
     * @return string The index() function returns a string, and the get_shoe() function returns a
     * view.
     */
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

    /**
     * The function retrieves a shoe from the model, prepares data for the view, and returns the shoe
     * view with the data.
     * 
     * @param string $id The "id" parameter is the unique identifier of the shoe that you want to retrieve. It
     * is used to fetch the shoe details from the model.
     * 
     * @return a view called 'shoes/shoe' with the data array.
     */
    public function get_shoe(string $id)
    {
        $shoe =$this->model->getShoes($id);
        $data = [
            'title' => $shoe['name'],
            'user' => session()->get('isLoggedIn') ? session()->get('user') : null,
            'shoe' => $shoe,
        ];
        return view('shoes/shoe', $data);
    }

    /**
     * The store function retrieves shoe data from an API and saves it to the model if the shoes are
     * not already stored.
     */
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
