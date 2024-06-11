<?php 

class Home extends Controller {
    public function index()
    {
        session_start();
        $data['judul'] = 'Home';
        if (isset($_SESSION['id_user'])) {
            $data['session'] = $_SESSION['id_user'];

        }

        $this->view('templates/header', $data);
        $this->view('home/index',$data);
        $this->view('templates/footer');
    }
}