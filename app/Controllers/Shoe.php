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
            //ALERT! delete dd
            dd("not enough shoes");
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
