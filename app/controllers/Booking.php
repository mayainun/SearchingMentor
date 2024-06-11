<?php 

class Booking extends Controller{
    public function index(){
        session_start();
        $data['judul'] = 'booking';
        $data['session'] = $_SESSION['id_user'];
        $id_mentor = $_POST['id_mentor'];
        $data['detail'] = $this->model('User_model')->getDetailMentor($id_mentor);
        $this->view('templates/header',$data);
        $this->view('mentoring/booking',$data);
        $this->view('templates/footer');
    }
    public function bookingMentor()
    {
        session_start();
        if(isset($_SESSION['id_user']))
        {   
            $id_user = $_SESSION['id_user'];
            $id_mentor = $_POST['id_mentor'];
            $request_topik = htmlspecialchars($_POST['request_topik']);
            $booking = $this->model('User_model')->tambahBookingMentor($request_topik,$id_user,$id_mentor);
            $id_booking = $this->model('User_model')->getIdBookingBaru();
            // $this->model('Admin_model')->hapusDataMentor($id_mentor);
            $jadwalBaru = $this->model('User_model')->tambahJadwal($id_booking);
            if($jadwalBaru){
                header('location:?controller=Jadwal');
            }
        }else{
            header('location:?controller=Login');
        }
    }
}