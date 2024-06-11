<?php

class Jadwal extends Controller {
    
    public function index() {
        session_start();
        
        // Periksa apakah pengguna sudah login
        if (!isset($_SESSION['id_user'])) {
            // Jika belum login, arahkan ke halaman login
            header('Location: ?controller=login'); 
            exit();
        }
        
        $data['session'] = $_SESSION['id_user'];

        // Jika sudah login, tampilkan halaman jadwal
        $data['judul'] = 'Jadwal';
        $data['jadwal'] = $this->model('User_model')->getJadwal();
        $id_user = $_SESSION['id_user'];
        $data['username'] = $this->model('User_model')->getUsernameById($id_user);
        
        $this->view('templates/header', $data);
        $this->view('jadwal/index', $data);
        $this->view('templates/footer');
    }

    public function hapusJadwal() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_jadwal = $_POST['id_jadwal'];
            try {
                $result = $this->model('User_model')->hapusJadwalById($id_jadwal);
            
                if ($result) {
                    header('Location: ?controller=Jadwal');
                    exit();
                } else {
                    echo '<script>alert("Jadwal gagal dihapus");</script>';
                    echo '<script>window.location.href="?controller=Jadwal";</script>';
                }
            } catch (Exception $e) {
                echo "Terjadi pengecualian: " . $e->getMessage();
            }
        }
    }
}
