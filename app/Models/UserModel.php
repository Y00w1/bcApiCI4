<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['name', 'email', 'password'];

    /**
     * The function "get_users" retrieves all users if no ID is provided, or retrieves a specific user
     * by ID.
     * 
     * @param id The parameter "id" is an optional parameter that can be passed to the function. If an
     * "id" value is provided, the function will return the user with that specific id. If no "id"
     * value is provided, the function will return all users.
     * 
     * @return If the  parameter is null, the function will return all users by calling the
     * findAll() method. If the  parameter is not null, the function will return the first user that
     * matches the given id by calling the where() method with the condition ['id' => ] and then
     * calling the first() method.
     */
    public function get_users($id = null)
    {
        if ($id === null){
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}