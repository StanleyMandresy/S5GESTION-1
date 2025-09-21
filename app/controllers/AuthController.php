<?php
namespace app\controllers;
session_start();
use Flight;
use app\models\User;

class AuthController {


    public function __construct() {

    }

    public function loginPage() {
        Flight::render('login', []);
    }

    public function registerPage() {
        Flight::render('register', []);
    }

    public function login() {
      $userModel = new User(Flight::db());
        $data = Flight::request()->data->getData();
        $user = $userModel->authenticate($data['email'], $data['password']);

        if ($user) {
            $_SESSION['user'] = $user;
            Flight::redirect('/dashboard/' . $user['role']);
        } else {
            Flight::render('login', ['error' => 'Email ou mot de passe incorrect']);
        }
    }

    public function register() {
         $userModel = new User(Flight::db());
        $data = Flight::request()->data->getData();

        if ($userModel->emailExists($data['email'])) {
            Flight::render('register', ['error' => 'Email déjà utilisé']);
            return;
        }

        $id = $userModel->create($data);
        $_SESSION['user'] = $userModel->getById($id);
        Flight::redirect('/dashboard/' . $_SESSION['user']['role']);
    }

    public function logout() {
        session_destroy();
        Flight::redirect('/login');
    }
}
