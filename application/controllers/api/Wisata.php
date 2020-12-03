<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Wisata extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index_get()
    {
        $wisata = $this->db->query('SELECT * FROM tb_wisata')->result_array();

        if ($wisata) {
            $this->response([
                'status' => true,
                'data' => $wisata,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'messages' => "Data Tidak Di Temukan",
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post()
    {
        $id_wisata = $this->post('id_wisata');

        $pinjam = $this->db->get_where('tb_wisata', ['id_wisata', $id_wisata]);

        if (!$pinjam) {
            $this->response([
                'status' => false,
                'messages' => "Data Tidak Di Temukan",
            ], REST_Controller::HTTP_NOT_FOUND);
        } else {
            $this->response([
                'status' => true,
                'data' => $pinjam,
            ], REST_Controller::HTTP_OK);
        }
    }
}
