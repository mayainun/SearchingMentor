<?php

class About extends Controller{
    public function index(){
        session_start();
        $data['judul'] = 'About';
        if (isset($_SESSION['id_user'])) {
            $data['session'] = $_SESSION['id_user'];
        }

        $this->view('templates/header', $data);
        $this->view('about/index');
        $this->view('templates/footer');
    }
}