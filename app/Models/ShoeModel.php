<?php
namespace App\Models;
use CodeIgniter\Model;

class ShoeModel extends Model
{
    protected $table = 'shoes';
    protected $allowedFields = ['name', 'price', 'image', 'description', 'quantity', 'rating_rate',	'rating_count'];

    public function getShoes($id = null)
    {
        if ($id === null){
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    public function get_shoes_by_rating_rate($rating_rate_min, $rating_rate_max)
    {
        return $this->whereBetween('rating_rate', [$rating_rate_min, $rating_rate_max])->findAll();
    }
}