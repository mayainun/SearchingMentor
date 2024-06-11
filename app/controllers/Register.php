<?php

class Register extends Controller {
    public function index() {
        session_start();
        if (isset($_SESSION['id_user'])) {
            // Arahkan ke halaman utama atau halaman lain sesuai kebutuhan dengan query string
            header('Location: ?controller=home'); 
            exit();
        }
        $data['judul'] = 'register';
        $this->view('templates/header', $data);
        $this->view('auth/register');
        $this->view('templates/footer');
    }

    public function regUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $email = htmlspecialchars($_POST['email']);
            $nomor = htmlspecialchars($_POST['nomor']);

            $usernameExists = $this->model('User_model')->checkUsernameExists($username);

            if ($usernameExists) {
                echo '<script>alert("Username telah digunakan, silahkan gunakan username lain untuk mendaftar");</script>';
                echo '<script>window.location.href="?controller=Register";</script>'; // Gunakan query string untuk halaman register
            } else {
                $result = $this->model('User_model')->registerUser($username, $password, $email, $nomor);

                if ($result) {
                    header('Location: ?controller=login'); // Gunakan query string untuk halaman login
                    exit();
                } else {
                    echo '<script>alert("Masukkan data registrasi dengan benar");</script>';
                }
            }
        }
    }
}
