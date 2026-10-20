<?php
namespace App\Controllers;
use App\Models\User;

class UserController {
    public function index() {
        $users = User::all();
        require __DIR__ . '/../../views/user/index.php';
    }
    public function create() {
        require __DIR__ . '/../../views/user/create.php';
    }
    public function store() {
        User::create($_POST['nom'], $_POST['email']);
        header('Location: /');
        exit;
    }
    public function delete($id) {
        User::delete($id);
        header('Location: /');
        exit;
    }
}