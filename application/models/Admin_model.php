<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getCountKategori(){
		$query = "SELECT COUNT(id_kategori) as ik FROM tb_kategori";
		return $this->db->query($query)->row()->ik;
	}

	public function getCountBarang(){
		$query = "SELECT COUNT(kode_brg) as kode_brg FROM tb_barang";
		return $this->db->query($query)->row()->kode_brg;
	}

	public function getCountRekening(){
		$query = "SELECT COUNT(kode_rek) as kode_rek FROM tb_rekening";
		return $this->db->query($query)->row()->kode_rek;
	}

	public function getCountSatuan(){
		$query = "SELECT COUNT(id_satuan) as ids FROM tb_satuan";
		return $this->db->query($query)->row()->ids;
	}

	public function getCountUser(){
		$query = "SELECT COUNT(id) as id FROM tb_users where level='User'";
		return $this->db->query($query)->row()->id;
	}

	public function getCountSimpananpokok(){
		$query = "SELECT COUNT(id) as id_simpanan_pokok FROM tb_simpananpokok";
		return $this->db->query($query)->row()->id_simpanan_pokok;
	}

	public function getCountSimpananwajib(){
		$query = "SELECT COUNT(id) as id_simpanan_wajib FROM tb_simpananwajib";
		return $this->db->query($query)->row()->id_simpanan_wajib;
	}

	public function getCountSimpanansukarela(){
		$query = "SELECT COUNT(id) as id_simpanan_sukarela FROM tb_simpanansukarela";
		return $this->db->query($query)->row()->id_simpanan_sukarela;
	}

	public function getSimpananpokok(){
		$query = "SELECT * FROM q_simpananpokok";
		return $this->db->query($query)->result();
	}

	public function getSimpananwajib(){
		$query = "SELECT * FROM q_simpananwajib";
		return $this->db->query($query)->result();
	}

	public function getPinjaman(){
		$query = "SELECT * FROM q_pinjaman";
		return $this->db->query($query)->result();
	}

	public function getSimpanansukarela(){
		$query = "SELECT * FROM q_simpanansukarela";
		return $this->db->query($query)->result();
	}

	public function getAnggota(){
		$query = "SELECT * FROM tb_anggota";
		return $this->db->query($query)->result();
	}

	public function getPinjamanAnggota(){
		$query = "SELECT a.id,date_format(a.tanggal,'%d/%m/%Y') AS tanggal,a.jumlah_pinjaman, b.nama_karyawan, a.jumlah_angsuran, c.angsuran_ke FROM tb_pinjaman a LEFT JOIN tb_anggota b ON b.id=a.id_anggota LEFT JOIN (SELECT id_pinjaman, (COUNT(id_pinjaman)+1) angsuran_ke FROM tb_angsuran GROUP BY id_pinjaman) c ON c.id_pinjaman=a.id";
		return $this->db->query($query)->result();
	}

	public function getOneSimpananpokok($id){
		$this->db->select('*');
		$this->db->from('q_simpananpokok');
		$this->db->where('q_simpananpokok.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getOneSimpananwajib($id){
		$this->db->select('*');
		$this->db->from('q_simpananwajib');
		$this->db->where('q_simpananwajib.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getOnePinjaman($id){
		$this->db->select('*');
		$this->db->from('q_pinjaman');
		$this->db->where('q_pinjaman.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getOneSimpanansukarela($id){
		$this->db->select('*');
		$this->db->from('q_simpanansukarela');
		$this->db->where('q_simpanansukarela.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getOneAnggota($id){
		$this->db->select('*');
		$this->db->from('tb_anggota');
		$this->db->where('tb_anggota.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getUsers(){
		$query = "SELECT * FROM tb_users";
		return $this->db->query($query)->result();
	}


	public function getOneUsers($id){
		$query = "SELECT * FROM tb_users WHERE id = '$id' ";
		return $this->db->query($query)->row();
	}

	public function getOneWebsite($id){
		$query = "SELECT * FROM tb_website WHERE id = '$id' ";
		return $this->db->query($query)->row();
	}

}