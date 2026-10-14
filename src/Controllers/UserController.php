<?php
namespace App\Controllers;
use App\Models\User;
class UserController {
    public function index() {
        $users = User::all();
        require __DIR__ . '/../../views/user/index.php';
    }

 
}