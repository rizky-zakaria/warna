<?php

class Buku_model extends CI_Model
{

    public function getBuku($id_berita = null)
    {
        if ($id_berita === null) {
            return $this->db->get('tb_buku')->result_array();
        } else {
            return $this->db->get_where('tb_buku', ['id_buku' => $id_buku])->result_array();
        }
    }

    public function pinjamSemua()
    {
        $query = "SELECT tb_pinjam.id_pinjam, tb_buku.judul_buku, tb_pinjam.tanggal_pinjam, tb_pinjam.tanggal_kembali, tb_user.alamat,tb_user.nama FROM tb_buku INNER JOIN tb_pinjam INNER JOIN tb_user ON tb_buku.id_buku=tb_pinjam.id_buku AND tb_pinjam.id_user=tb_user.id_user";
        $pinjam = $this->db->query($query)->result_array();
        return $pinjam;
    }

    public function delBuku($id_pinjam)
    {
        $this->db->delete('tb_pinjam', ['id_pinjam' => $id_pinjam]);
        return $this->db->affected_rows();
    }

    public function cekPinjam($id_user)
    {
        $query = "SELECT tb_pinjam.id_pinjam, tb_buku.judul_buku, tb_pinjam.tanggal_pinjam, tb_pinjam.tanggal_kembali, tb_user.alamat,tb_user.nama FROM tb_buku INNER JOIN tb_pinjam INNER JOIN tb_user ON tb_buku.id_buku=tb_pinjam.id_buku AND tb_pinjam.id_user=tb_user.id_user WHERE tb_pinjam.id_user = $id_user";
        $pinjam = $this->db->query($query)->result_array();
        return $pinjam;
    }

    public function addPinjamBuku($id_buku, $id_user, $tanggal_pinjam)
    {
        $query = "INSERT INTO `tb_pinjam` (`id_pinjam`, `id_user`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`) VALUES (NULL, '$id_user', '$id_buku', '$tanggal_pinjam', 'Belum di kembalikan');";
        $result = $this->db->query($query);
        return $result;
    }

    public function addBuku($judul_buku, $pengarang, $penerbit, $tanggal_entry)
    {

        $gambar = "http://192.168.1.167/api.perpus.com/assets/img/buku.jpg";
        $query = "INSERT INTO `tb_buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`, `gambar`, `tanggal_entry`) VALUES (NULL, '$judul_buku', '$pengarang', '$penerbit', '$gambar', '$tanggal_entry')";
        $result = $this->db->query($query);
        return $result;
    }
    public function deleteBuku($id_buku)
    {
        $this->db->delete('tb_buku', ['id_buku' => $id_buku]);
        return $this->db->affected_rows();

    }

    public function cariBuku($id_buku)
    {
        return $this->db->get_where('tb_pinjam', ['id_buku' => $id_buku])->result_array();
    }

    public function updateBuku($id_buku, $judul_buku, $pengarang, $penerbit)
    {
        return $this->db->query("UPDATE `tb_buku` SET `judul_buku` = '$judul_buku', `pengarang` = '$pengarang', `penerbit` = '$penerbit' WHERE `tb_buku`.`id_buku` = '$id_buku'");
    }

    public function selesai($id_pinjam, $tanggal_kembali)
    {
        return $this->db->query("UPDATE `tb_pinjam` SET `tanggal_kembali` = '$tanggal_kembali' WHERE `tb_pinjam`.`id_pinjam` = '$id_pinjam'");
    }

}
