<?php
class Admin_controller extends CI_Controller
{
    public function index()
    {
        $data['pengguna'] = $this->db->query('SELECT * FROM tb_wisata')->result_array();
        // var_dump($data);
        // die;
        $this->load->view('admin/index', $data);
    }

    public function tambah()
    {
        $this->load->view('admin/tambah');
    }

    public function action_tambah()
    {
        $warna = $this->input->post('nama');
        $link = $this->input->post('link');
        $tambah = $this->db->query("INSERT INTO tb_wisata VALUES ('', '$warna', '$link')");
        if ($tambah) {
            redirect(base_url('index.php/Admin_controller'));
        } else {
            redirect(base_url('index.php/Admin_controller/tambah'));
        }
    }

    public function hapus()
    {
        $id = $_GET['id_warna'];
        $hapus = $this->db->query("DELETE FROM tb_warna WHERE id_warna = '$id'");
        if ($hapus) {
            redirect(base_url('index.php/Admin_controller'));
        } else {
            echo "Gagal Menghapus";
        }
    }
}
