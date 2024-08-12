<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Ajax extends CI_Controller {

	public function __construct(){

		parent::__construct();


		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('ajax_model');
		$this->load->model('admin_model');
	}

	/*-- Server-side Data kategori --*/
	public function kategoriData(){
		$list = $this->ajax_model->get_kategori();
		$data = array();
		if (isset($_POST['start'])) {
		    $no = $_POST['start'];
		} else {
		    $no = 0; 
		}
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = '<div style="text-align: center;">' . $no;
			$row[] = $field->kategori;
			$row[] = '<div style="text-align: center;">' . '
					 <a class="btn btn-sm btn-warning kategori_edit" style="color:white;font-weight:bold" href="javascript:void(0)" rel="'.$field->id_kategori.'" title="Edit"><i class="fas fa-edit text-light"></i> Edit</a>
					 <a class="btn btn-sm btn-danger" style="color:white;font-weight:bold" onclick="deletekategori('.$field->id_kategori.')" title="Delete"><i class="fas fa-trash text-white"></i> Hapus</a>
					';	
			$data[] = $row;
		}
		$output = array(
			"draw" => isset($_POST['draw']) ? $_POST['draw'] : 0,
			"recordsTotal" => $this->ajax_model->count_all_kategori(),
			"recordsFiltered" => $this->ajax_model->count_filtered_kategori(),
			"data" => $data,
		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);
	}


	/*-- Server-side Data Cari kategori --*/
	public function carikategoriData(){
		$list = $this->ajax_model->get_kategori();
		$data = array();
		if (isset($_POST['start'])) {
		    $no = $_POST['start'];
		} else {
		    $no = 0; 
		}
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $field->kategori;
			$row[] = '<div style="text-align: center;">' . '
					 <a class="btn btn-sm btn-info pilih_kategori" style="color:white;font-weight:bold" href="javascript:void(0)" rel="'.$field->id_kategori.'" relb="'.$field->kategori.'" title="Pilih Kategori">Pilih Kategori</a>
					';	
			$data[] = $row;
		}
		$output = array(
			"draw" => isset($_POST['draw']) ? $_POST['draw'] : 0,
			"recordsTotal" => $this->ajax_model->count_all_kategori(),
			"recordsFiltered" => $this->ajax_model->count_filtered_kategori(),
			"data" => $data,
		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);
	}

	/*-- Server-side Data Barang --*/
	public function barangData(){
		$list = $this->ajax_model->get_barang();
		$data = array();
		if (isset($_POST['start'])) {
		    $no = $_POST['start'];
		} else {
		    $no = 0; 
		}
		foreach ($list as $field) {
			$no++;
			$kode_brg_escaped = htmlspecialchars($field->kode_brg, ENT_QUOTES);
			$row = array();
			$row[] = '<div style="text-align: center;">' . $no;
			$row[] = $field->kode_brg;
			$row[] = $field->nama_brg;
			$row[] = '<div style="text-align: center;">' . '
					 <a class="btn btn-sm btn-warning barang_edit" style="color:white;font-weight:bold" href="javascript:void(0)" rel="'.$field->kode_brg.'" title="Edit"><i class="fas fa-edit text-light"></i> Edit</a>
					 <a class="btn btn-sm btn-danger" style="color:white;font-weight:bold" onclick="deletebarang(\'' . $kode_brg_escaped . '\')" title="Delete"><i class="fas fa-trash text-white"></i> Hapus</a>
					';	
			$data[] = $row;
		}
		$output = array(
			"draw" => isset($_POST['draw']) ? $_POST['draw'] : 0,
			"recordsTotal" => $this->ajax_model->count_all_barang(),
			"recordsFiltered" => $this->ajax_model->count_filtered_barang(),
			"data" => $data,
		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);
	}

	/*-- Server-side Data kelompokbarang --*/
	public function kelompokbarangData(){
		$list = $this->ajax_model->get_kelompokbarang();
		$data = array();
		if (isset($_POST['start'])) {
		    $no = $_POST['start'];
		} else {
		    $no = 0; 
		}
		foreach ($list as $field) {
			$no++;
			$kode_brg_escaped = htmlspecialchars($field->kode_brg, ENT_QUOTES);
			$row = array();
			$row[] = '<div style="text-align: center;">' . $no;
			$row[] = $field->kode_brg;
			$row[] = $field->nama_brg;
			if ($field->nama_rek == '') {
			    $row[] = htmlspecialchars($field->nama_rek);
			} else {
				$row[] = htmlspecialchars($field->nama_rek) . '<br>' . 
				    '<a class="btn btn-sm btn-danger" style="color:white;font-weight:bold" onclick="deletecarirekening(\'' . $kode_brg_escaped . '\', ' . $no . ')" title="Hapus Rekening">X</a>';
			}

			if ($field->kategori == '') {
			    $row[] = '<div style="text-align: center;">' . htmlspecialchars($field->kategori);
			} else {
				$row[] = '<div style="text-align: center;">' . htmlspecialchars($field->kategori) . '<br>' . 
				    '<a class="btn btn-sm btn-danger" style="color:white;font-weight:bold" onclick="deletecarikategori(\'' . $kode_brg_escaped . '\', ' . $no . ')" title="Hapus Kategori">X</a>';
			}
			$row[] = '<div style="text-align: center;">' . '
					 <a class="btn btn-sm btn-info rekening_edit" data-number="' . $no . '"style="margin-top:2px;width:80px;color:white;font-weight:bold" href="javascript:void(0)" rel="'.$field->kode_brg.'" title="Rekening">Rekening</a>
					 <a class="btn btn-sm btn-success kategori_edit" data-number="' . $no . ' "style="margin-top:2px;width:80px;color:white;font-weight:bold" href="javascript:void(0)" rel="'.$field->kode_brg.'" title="Kategori">Kategori</a>
					';	
			$data[] = $row;
		}
		$output = array(
			"draw" => isset($_POST['draw']) ? $_POST['draw'] : 0,
			"recordsTotal" => $this->ajax_model->count_all_kelompokbarang(),
			"recordsFiltered" => $this->ajax_model->count_filtered_kelompokbarang(),
			"data" => $data,
		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);
	}

	/*-- Server-side Data rekening --*/
	public function rekeningData(){
		$list = $this->ajax_model->get_rekening();
		$data = array();
		if (isset($_POST['start'])) {
		    $no = $_POST['start'];
		} else {
		    $no = 0; 
		}
		foreach ($list as $field) {
			$no++;
			$kode_rek_escaped = htmlspecialchars($field->kode_rek, ENT_QUOTES);
			$row = array();
			$row[] = '<div style="text-align: center;">' . $no;
			$row[] = $field->kode_rek;
			$row[] = $field->nama_rek;
			$row[] = '<div style="text-align: center;">' . '
					 <a class="btn btn-sm btn-warning rekening_edit" style="color:white;font-weight:bold" href="javascript:void(0)" rel="'.$field->kode_rek.'" title="Edit"><i class="fas fa-edit text-light"></i> Edit</a>
					 <a class="btn btn-sm btn-danger" style="color:white;font-weight:bold" onclick="deleterekening(\'' . $kode_rek_escaped . '\')" title="Delete"><i class="fas fa-trash text-white"></i> Hapus</a>
					';	
			$data[] = $row;
		}
		$output = array(
			"draw" => isset($_POST['draw']) ? $_POST['draw'] : 0,
			"recordsTotal" => $this->ajax_model->count_all_rekening(),
			"recordsFiltered" => $this->ajax_model->count_filtered_rekening(),
			"data" => $data,
		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);
	}


	/*-- Server-side Data cari rekening --*/
	public function carirekeningData(){
		$list = $this->ajax_model->get_carirekening();
		$data = array();
		if (isset($_POST['start'])) {
		    $no = $_POST['start'];
		} else {
		    $no = 0; 
		}
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $field->kode_rek;
			$row[] = $field->nama_rek;
			$row[] = '<div style="text-align: center;">' . '
					 <a class="btn btn-sm btn-info pilih_rek" style="color:white;font-weight:bold" href="javascript:void(0)" rel="'.$field->kode_rek.'" relb="'.$field->nama_rek.'" title="Pilih Rekening">Pilih Rekening</a>
					';	
			$data[] = $row;
		}
		$output = array(
			"draw" => isset($_POST['draw']) ? $_POST['draw'] : 0,
			"recordsTotal" => $this->ajax_model->count_all_rekening(),
			"recordsFiltered" => $this->ajax_model->count_filtered_rekening(),
			"data" => $data,
		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);
	}

	/*-- Server-side Data satuan --*/
	public function satuanData(){
		$list = $this->ajax_model->get_satuan();
		$data = array();
		if (isset($_POST['start'])) {
		    $no = $_POST['start'];
		} else {
		    $no = 0; 
		}
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = '<div style="text-align: center;">' . $no;
			$row[] = $field->satuan;
			$row[] = '<div style="text-align: center;">' . '
					 <a class="btn btn-sm btn-warning satuan_edit" style="color:white;font-weight:bold" href="javascript:void(0)" rel="'.$field->id_satuan.'" title="Edit"><i class="fas fa-edit text-light"></i> Edit</a>
					 <a class="btn btn-sm btn-danger" style="color:white;font-weight:bold" onclick="deletesatuan('.$field->id_satuan.')" title="Delete"><i class="fas fa-trash text-white"></i> Hapus</a>
					';	
			$data[] = $row;
		}
		$output = array(
			"draw" => isset($_POST['draw']) ? $_POST['draw'] : 0,
			"recordsTotal" => $this->ajax_model->count_all_satuan(),
			"recordsFiltered" => $this->ajax_model->count_filtered_satuan(),
			"data" => $data,
		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);
	}

	/*-- Server-side Data user --*/
	public function userData(){
		$list = $this->ajax_model->get_user();
		$data = array();
		if (isset($_POST['start'])) {
		    $no = $_POST['start'];
		} else {
		    $no = 0; 
		}
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = '<div style="text-align: center;">' . $no;
			$row[] = $field->username;
			$row[] = $field->full_name;
			$row[] = $field->instansi;
			$row[] = '<div style="text-align: center;">' . '
					 <a class="btn btn-sm btn-warning user_edit" style="color:white;font-weight:bold" href="javascript:void(0)" rel="'.$field->id.'" title="Edit"><i class="fas fa-edit text-light"></i> Edit</a>
					 <a class="btn btn-sm btn-danger" style="color:white;font-weight:bold" onclick="deleteuser('.$field->id.')" title="Delete"><i class="fas fa-trash text-white"></i> Hapus</a>
					';	
			$data[] = $row;
		}
		$output = array(
			"draw" => isset($_POST['draw']) ? $_POST['draw'] : 0,
			"recordsTotal" => $this->ajax_model->count_all_user(),
			"recordsFiltered" => $this->ajax_model->count_filtered_user(),
			"data" => $data,
		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);
	}
}