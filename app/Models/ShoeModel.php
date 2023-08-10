<?php
namespace App\Models;
use CodeIgniter\Model;

class ShoeModel extends Model
{
    protected $table = 'shoes';
    protected $allowedFields = ['name', 'price', 'image', 'description', 'quantity', 'rating_rate',	'rating_count'];

    /**
     * The function `getShoes` retrieves all shoes if no ID is provided, or retrieves a specific shoe
     * by ID.
     * 
     * @param id The  parameter is an optional parameter that specifies the ID of the shoe you want
     * to retrieve. If no ID is provided, the function will return all the shoes. If an ID is provided,
     * the function will return the shoe with that specific ID.
     * 
     * @return If the  parameter is null, the function will return all the shoes (using the
     * findAll() method). If the  parameter is not null, the function will return the shoe with the
     * specified id (using the where() and first() methods).
     */
    public function getShoes($id = null)
    {
        if ($id === null){
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    /**
     * The function `get_shoes_by_rating_rate` retrieves shoes with a rating rate within a specified
     * range.
     * 
     * @param rating_rate_min The minimum rating rate value to filter the shoes by.
     * @param rating_rate_max The maximum rating rate for the shoes.
     * 
     * @return a collection of shoes that have a rating rate within the specified range.
     */
    public function get_shoes_by_rating_rate($rating_rate_min, $rating_rate_max)
    {
        return $this->whereBetween('rating_rate', [$rating_rate_min, $rating_rate_max])->findAll();
    }
}