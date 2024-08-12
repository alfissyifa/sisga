<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*--  Server Side Data kategori --------*/
	var $tablekategori= 'tb_kategori';
	var $column_orderkategori = array(null, 'kategori');
	var $column_searchkategori = array('kategori');
	var $orderkategori = array('kategori' => 'asc');


	private function _get_kategori_query(){
		$this->db->from($this->tablekategori);
		$i = 0;
		if(isset($_POST['search']) && $_POST['search']['value']) {
		    foreach ($this->column_searchkategori as $item) {
		        if($i === 0) {
		            $this->db->group_start();
		            $this->db->like($item, $_POST['search']['value']);
		        } else {
		            $this->db->or_like($item, $_POST['search']['value']);
		        }
		        if(count($this->column_searchkategori) - 1 == $i) {
		            $this->db->group_end();
		        }
		        $i++;
		    }
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_orderkategori[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->orderkategori)){

			$orderkategori = $this->orderkategori;
			$this->db->order_by(key($orderkategori), $orderkategori[key($orderkategori)]);
		}
	}

	function get_kategori(){
		$this->_get_kategori_query();
	    if(isset($_POST['length']) && $_POST['length'] != -1) {
	        $this->db->limit($_POST['length'], $_POST['start']);
	    }
	    $query = $this->db->get();
	    return $query->result();
	}

	function get_kategori_by_id($id_kategori){
		$hsl=$this->db->query("SELECT * FROM tb_kategori WHERE id_kategori='$id_kategori'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'id_kategori' => $data->id_kategori,
					'kategori' => $data->kategori,
					);
			}
		}
		return $hasil;
	}

	function count_filtered_kategori(){
		$this->_get_kategori_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all_kategori(){
		$this->db->from($this->tablekategori);
		return $this->db->count_all_results();
	}

	/*--  Server Side Data Barang --------*/
	var $tablebarang= 'tb_barang';
	var $column_orderbarang = array(null, 'kode_brg', 'nama_brg');
	var $column_searchbarang = array('kode_brg', 'nama_brg');
	var $orderbarang = array('kode_brg' => 'asc');


	private function _get_barang_query(){
		$this->db->from($this->tablebarang);
		$i = 0;
		if(isset($_POST['search']) && $_POST['search']['value']) {
		    foreach ($this->column_searchbarang as $item) {
		        if($i === 0) {
		            $this->db->group_start();
		            $this->db->like($item, $_POST['search']['value']);
		        } else {
		            $this->db->or_like($item, $_POST['search']['value']);
		        }
		        if(count($this->column_searchbarang) - 1 == $i) {
		            $this->db->group_end();
		        }
		        $i++;
		    }
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_orderbarang[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->orderbarang)){

			$orderbarang = $this->orderbarang;
			$this->db->order_by(key($orderbarang), $orderbarang[key($orderbarang)]);
		}
	}

	function get_barang(){
		$this->_get_barang_query();
	    if(isset($_POST['length']) && $_POST['length'] != -1) {
	        $this->db->limit($_POST['length'], $_POST['start']);
	    }
	    $query = $this->db->get();
	    return $query->result();
	}

	function get_barang_by_id($kode_brg){
		$hsl=$this->db->query("SELECT * FROM tb_barang WHERE kode_brg='$kode_brg'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'kode_brg' => $data->kode_brg,
					'nama_brg' => $data->nama_brg,
					);
			}
		}
		return $hasil;
	}

	function count_filtered_barang(){
		$this->_get_barang_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all_barang(){
		$this->db->from($this->tablebarang);
		return $this->db->count_all_results();
	}

	/*--  Server Side Data kelompokbarang --------*/
	var $tablekelompokbarang= '(SELECT a.*, b.kategori, c.nama_rek FROM tb_barang a LEFT JOIN tb_kategori b ON b.id_kategori=a.id_kategori LEFT JOIN tb_rekening c ON c.kode_rek=a.kode_rek ) tb_kelompokbarang';
	var $column_orderkelompokbarang = array(null, 'kode_brg', 'nama_brg','nama_rek','kategori');
	var $column_searchkelompokbarang = array('kode_brg', 'nama_brg','nama_rek','kategori');
	var $orderkelompokbarang = array('kode_brg' => 'asc');


	private function _get_kelompokbarang_query(){
		$this->db->from($this->tablekelompokbarang);
		$i = 0;
		if(isset($_POST['search']) && $_POST['search']['value']) {
		    foreach ($this->column_searchkelompokbarang as $item) {
		        if($i === 0) {
		            $this->db->group_start();
		            $this->db->like($item, $_POST['search']['value']);
		        } else {
		            $this->db->or_like($item, $_POST['search']['value']);
		        }
		        if(count($this->column_searchkelompokbarang) - 1 == $i) {
		            $this->db->group_end();
		        }
		        $i++;
		    }
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_orderkelompokbarang[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->orderkelompokbarang)){

			$orderkelompokbarang = $this->orderkelompokbarang;
			$this->db->order_by(key($orderkelompokbarang), $orderkelompokbarang[key($orderkelompokbarang)]);
		}
	}

	function get_kelompokbarang(){
		$this->_get_kelompokbarang_query();
	    if(isset($_POST['length']) && $_POST['length'] != -1) {
	        $this->db->limit($_POST['length'], $_POST['start']);
	    }
	    $query = $this->db->get();
	    return $query->result();
	}

	function get_kelompokbarang_by_id($kode_brg){
		$hsl=$this->db->query("SELECT * FROM tb_kelompokbarang WHERE kode_brg='$kode_brg'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'kode_brg' => $data->kode_brg,
					'nama_brg' => $data->nama_brg,
					);
			}
		}
		return $hasil;
	}

	function count_filtered_kelompokbarang(){
		$this->_get_kelompokbarang_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all_kelompokbarang(){
		$this->db->from($this->tablekelompokbarang);
		return $this->db->count_all_results();
	}

	/*--  Server Side Data rekening --------*/
	var $tablerekening= 'tb_rekening';
	var $column_orderrekening = array(null, 'kode_rek', 'nama_rek');
	var $column_searchrekening = array('kode_rek', 'nama_rek');
	var $orderrekening = array('kode_rek' => 'asc');


	private function _get_rekening_query(){
		$this->db->from($this->tablerekening);
		$i = 0;
		if(isset($_POST['search']) && $_POST['search']['value']) {
		    foreach ($this->column_searchrekening as $item) {
		        if($i === 0) {
		            $this->db->group_start();
		            $this->db->like($item, $_POST['search']['value']);
		        } else {
		            $this->db->or_like($item, $_POST['search']['value']);
		        }
		        if(count($this->column_searchrekening) - 1 == $i) {
		            $this->db->group_end();
		        }
		        $i++;
		    }
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_orderrekening[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->orderrekening)){

			$orderrekening = $this->orderrekening;
			$this->db->order_by(key($orderrekening), $orderrekening[key($orderrekening)]);
		}
	}

	function get_rekening(){
		$this->_get_rekening_query();
	    if(isset($_POST['length']) && $_POST['length'] != -1) {
	        $this->db->limit($_POST['length'], $_POST['start']);
	    }
	    $query = $this->db->get();
	    return $query->result();
	}

	function get_rekening_by_id($kode_rek){
		$hsl=$this->db->query("SELECT * FROM tb_rekening WHERE kode_rek='$kode_rek'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'kode_rek' => $data->kode_rek,
					'nama_rek' => $data->nama_rek,
					);
			}
		}
		return $hasil;
	}

	function count_filtered_rekening(){
		$this->_get_rekening_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all_rekening(){
		$this->db->from($this->tablerekening);
		return $this->db->count_all_results();
	}


	/*--  Server Side Data carirekening --------*/
	var $tablecarirekening= '(SELECT a.kode_rek, a.nama_rek FROM tb_rekening a WHERE NOT EXISTS (SELECT 1 FROM tb_barang b WHERE b.kode_rek = a.kode_rek)) tb_carirekening';
	var $column_ordercarirekening = array(null, 'kode_rek', 'nama_rek');
	var $column_searchcarirekening = array('kode_rek', 'nama_rek');
	var $ordercarirekening = array('kode_rek' => 'asc');


	private function _get_carirekening_query(){
		$this->db->from($this->tablecarirekening);
		$i = 0;
		if(isset($_POST['search']) && $_POST['search']['value']) {
		    foreach ($this->column_searchcarirekening as $item) {
		        if($i === 0) {
		            $this->db->group_start();
		            $this->db->like($item, $_POST['search']['value']);
		        } else {
		            $this->db->or_like($item, $_POST['search']['value']);
		        }
		        if(count($this->column_searchcarirekening) - 1 == $i) {
		            $this->db->group_end();
		        }
		        $i++;
		    }
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_ordercarirekening[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->ordercarirekening)){

			$ordercarirekening = $this->ordercarirekening;
			$this->db->order_by(key($ordercarirekening), $ordercarirekening[key($ordercarirekening)]);
		}
	}

	function get_carirekening(){
		$this->_get_carirekening_query();
	    if(isset($_POST['length']) && $_POST['length'] != -1) {
	        $this->db->limit($_POST['length'], $_POST['start']);
	    }
	    $query = $this->db->get();
	    return $query->result();
	}

	function get_carirekening_by_id($kode_rek){
		$hsl=$this->db->query("SELECT * FROM tb_carirekening WHERE kode_rek='$kode_rek'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'kode_rek' => $data->kode_rek,
					'nama_rek' => $data->nama_rek,
					);
			}
		}
		return $hasil;
	}

	function count_filtered_carirekening(){
		$this->_get_carirekening_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all_carirekening(){
		$this->db->from($this->tablecarirekening);
		return $this->db->count_all_results();
	}

	/*--  Server Side Data satuan --------*/
	var $tablesatuan= 'tb_satuan';
	var $column_ordersatuan = array(null, 'satuan');
	var $column_searchsatuan = array('satuan');
	var $ordersatuan = array('satuan' => 'asc');


	private function _get_satuan_query(){
		$this->db->from($this->tablesatuan);
		$i = 0;
		if(isset($_POST['search']) && $_POST['search']['value']) {
		    foreach ($this->column_searchsatuan as $item) {
		        if($i === 0) {
		            $this->db->group_start();
		            $this->db->like($item, $_POST['search']['value']);
		        } else {
		            $this->db->or_like($item, $_POST['search']['value']);
		        }
		        if(count($this->column_searchsatuan) - 1 == $i) {
		            $this->db->group_end();
		        }
		        $i++;
		    }
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_ordersatuan[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->ordersatuan)){

			$ordersatuan = $this->ordersatuan;
			$this->db->order_by(key($ordersatuan), $ordersatuan[key($ordersatuan)]);
		}
	}

	function get_satuan(){
		$this->_get_satuan_query();
	    if(isset($_POST['length']) && $_POST['length'] != -1) {
	        $this->db->limit($_POST['length'], $_POST['start']);
	    }
	    $query = $this->db->get();
	    return $query->result();
	}

	function get_satuan_by_id($id_satuan){
		$hsl=$this->db->query("SELECT * FROM tb_satuan WHERE id_satuan='$id_satuan'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'id_satuan' => $data->id_satuan,
					'satuan' => $data->satuan,
					);
			}
		}
		return $hasil;
	}

	function count_filtered_satuan(){
		$this->_get_satuan_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all_satuan(){
		$this->db->from($this->tablesatuan);
		return $this->db->count_all_results();
	}

	/*--  Server Side Data user --------*/
	var $tableuser= '(SELECT * FROM tb_users WHERE level="User") tb_users';
	var $column_orderuser = array(null, 'username','full_name','instansi');
	var $column_searchuser = array('username','full_name','instansi');
	var $orderuser = array('username' => 'asc');


	private function _get_user_query(){
		$this->db->from($this->tableuser);
		$i = 0;
		if(isset($_POST['search']) && $_POST['search']['value']) {
		    foreach ($this->column_searchuser as $item) {
		        if($i === 0) {
		            $this->db->group_start();
		            $this->db->like($item, $_POST['search']['value']);
		        } else {
		            $this->db->or_like($item, $_POST['search']['value']);
		        }
		        if(count($this->column_searchuser) - 1 == $i) {
		            $this->db->group_end();
		        }
		        $i++;
		    }
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_orderuser[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->orderuser)){

			$orderuser = $this->orderuser;
			$this->db->order_by(key($orderuser), $orderuser[key($orderuser)]);
		}
	}

	function get_user(){
		$this->_get_user_query();
	    if(isset($_POST['length']) && $_POST['length'] != -1) {
	        $this->db->limit($_POST['length'], $_POST['start']);
	    }
	    $query = $this->db->get();
	    return $query->result();
	}

	function get_user_by_id($id){
		$hsl=$this->db->query("SELECT * FROM tb_users WHERE id='$id'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'id' => $data->id,
					'full_name' => $data->full_name,
					'email' => $data->email,
					'username' => $data->username,
					'password' => $data->password,
					'level' => $data->level,
					'status' => $data->status,
					'instansi' => $data->instansi,
					);
			}
		}
		return $hasil;
	}

	function count_filtered_user(){
		$this->_get_user_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all_user(){
		$this->db->from($this->tableuser);
		return $this->db->count_all_results();
	}
	/*-----------------------------------*/
	/*--  Server Side Data Simpanan Pokok --------*/
	/*-----------------------------------*/
	/*-- nama tabel dari database  --*/
	var $tableSimpananpokok = 'q_simpananpokok';
	/*-- field yang ada di table user yang akan ditampilkan --*/
	var $column_orderSimpananpokok = array(null, 'nama_karyawan','tanggal','jumlah');
	/*-- field yang diizin untuk pencarian --*/
	var $column_searchSimpananpokok = array('nama_karyawan','tanggal');
	/*-- Default Order --*/
	var $orderSimpananpokok = array('id' => 'desc');

	private function _get_simpananpokok_query(){

		$this->db->from($this->tableSimpananpokok);

		$i = 0;
		/*-- looping awal  --*/
		foreach ($this->column_searchSimpananpokok as $item){

			/*-- jika datatable mengirimkan pencarian dengan metode POST   --*/
			if($_POST['search']['value']) {

				/*-- looping awal  --*/
				if($i===0){

					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);

				}else{

					$this->db->or_like($item, $_POST['search']['value']);

				}

				if(count($this->column_searchSimpananpokok) - 1 == $i) 
					$this->db->group_end(); 
			}

			$i++;
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_orderSimpananpokok[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->orderSimpananpokok)){

			$orderSimpananpokok = $this->orderSimpananpokok;
			$this->db->order_by(key($orderSimpananpokok), $orderSimpananpokok[key($orderSimpananpokok)]);

		}
	}

	function get_simpananpokok(){
		$this->_get_simpananpokok_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}


	function count_filtered_simpananpokok(){
		$this->_get_simpananpokok_query();
		$query = $this->db->get();
		return $query->num_rows();

	}

	function count_all_simpananpokok(){
		$this->db->from($this->tableSimpananpokok);
		return $this->db->count_all_results();
	}


	/*-----------------------------------*/
	/*--  Server Side Data Simpanan Wajib --------*/
	/*-----------------------------------*/
	/*-- nama tabel dari database  --*/
	var $tableSimpananwajib = 'q_simpananwajib';
	/*-- field yang ada di table user yang akan ditampilkan --*/
	var $column_orderSimpananwajib = array(null, 'nama_karyawan','tanggal','jumlah');
	/*-- field yang diizin untuk pencarian --*/
	var $column_searchSimpananwajib = array('nama_karyawan','tanggal');
	/*-- Default Order --*/
	var $orderSimpananwajib = array('id' => 'desc');

	private function _get_simpananwajib_query(){

		$this->db->from($this->tableSimpananwajib);

		$i = 0;
		/*-- looping awal  --*/
		foreach ($this->column_searchSimpananwajib as $item){

			/*-- jika datatable mengirimkan pencarian dengan metode POST   --*/
			if($_POST['search']['value']) {

				/*-- looping awal  --*/
				if($i===0){

					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);

				}else{

					$this->db->or_like($item, $_POST['search']['value']);

				}

				if(count($this->column_searchSimpananwajib) - 1 == $i) 
					$this->db->group_end(); 
			}

			$i++;
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_orderSimpananwajib[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->orderSimpananwajib)){

			$orderSimpananwajib = $this->orderSimpananwajib;
			$this->db->order_by(key($orderSimpananwajib), $orderSimpananwajib[key($orderSimpananwajib)]);
		}
	}

	function get_simpananwajib(){
		$this->_get_simpananwajib_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}


	function count_filtered_simpananwajib(){
		$this->_get_simpananwajib_query();
		$query = $this->db->get();
		return $query->num_rows();

	}

	function count_all_simpananwajib(){
		$this->db->from($this->tableSimpananwajib);
		return $this->db->count_all_results();
	}


	/*-----------------------------------*/
	/*--  Server Side Data Pinjaman --------*/
	/*-----------------------------------*/
	/*-- nama tabel dari database  --*/
	var $tablePinjaman = 'q_pinjaman';
	/*-- field yang ada di table user yang akan ditampilkan --*/
	var $column_orderPinjaman = array(null, 'nama_karyawan','tanggal','jumlah_pinjaman');
	/*-- field yang diizin untuk pencarian --*/
	var $column_searchPinjaman = array('nama_karyawan','tanggal');
	/*-- Default Order --*/
	var $orderPinjaman = array('id' => 'desc');

	private function _get_pinjaman_query(){

		$this->db->from($this->tablePinjaman);

		$i = 0;
		/*-- looping awal  --*/
		foreach ($this->column_searchPinjaman as $item){

			/*-- jika datatable mengirimkan pencarian dengan metode POST   --*/
			if($_POST['search']['value']) {

				/*-- looping awal  --*/
				if($i===0){

					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);

				}else{

					$this->db->or_like($item, $_POST['search']['value']);

				}

				if(count($this->column_searchPinjaman) - 1 == $i) 
					$this->db->group_end(); 
			}

			$i++;
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_orderPinjaman[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->orderPinjaman)){

			$orderPinjaman = $this->orderPinjaman;
			$this->db->order_by(key($orderPinjaman), $orderPinjaman[key($orderPinjaman)]);
		}
	}

	function get_pinjaman(){
		$this->_get_pinjaman_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}


	function count_filtered_pinjaman(){
		$this->_get_pinjaman_query();
		$query = $this->db->get();
		return $query->num_rows();

	}

	function count_all_pinjaman(){
		$this->db->from($this->tablePinjaman);
		return $this->db->count_all_results();
	}


	/*-----------------------------------*/
	/*--  Server Side Data Angsuran --------*/
	/*-----------------------------------*/
	/*-- nama tabel dari database  --*/
	var $tableAngsuran = 'q_angsuran';
	/*-- field yang ada di table user yang akan ditampilkan --*/
	var $column_orderAngsuran = array(null, 'nama_karyawan','tanggal','angsuran_ke','jumlah_angsuran','tanggal_pinjaman','jumlah_pinjaman');
	/*-- field yang diizin untuk pencarian --*/
	var $column_searchAngsuran = array('nama_karyawan','tanggal');
	/*-- Default Order --*/
	var $orderAngsuran = array('id' => 'desc');

	private function _get_angsuran_query(){

		$this->db->from($this->tableAngsuran);

		$i = 0;
		/*-- looping awal  --*/
		foreach ($this->column_searchAngsuran as $item){

			/*-- jika datatable mengirimkan pencarian dengan metode POST   --*/
			if($_POST['search']['value']) {

				/*-- looping awal  --*/
				if($i===0){

					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);

				}else{

					$this->db->or_like($item, $_POST['search']['value']);

				}

				if(count($this->column_searchAngsuran) - 1 == $i) 
					$this->db->group_end(); 
			}

			$i++;
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_orderAngsuran[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->orderAngsuran)){

			$orderAngsuran = $this->orderAngsuran;
			$this->db->order_by(key($orderAngsuran), $orderAngsuran[key($orderAngsuran)]);
		}
	}

	function get_angsuran(){
		$this->_get_angsuran_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}


	function count_filtered_angsuran(){
		$this->_get_angsuran_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all_angsuran(){
		$this->db->from($this->tableAngsuran);
		return $this->db->count_all_results();
	}

		/*-----------------------------------*/
	/*--  Server Side Data Simpanan Sukarela --------*/
	/*-----------------------------------*/
	/*-- nama tabel dari database  --*/
	var $tableSimpanansukarela = 'q_simpanansukarela';
	/*-- field yang ada di table user yang akan ditampilkan --*/
	var $column_orderSimpanansukarela = array(null, 'nama_karyawan','tanggal','jumlah');
	/*-- field yang diizin untuk pencarian --*/
	var $column_searchSimpanansukarela = array('nama_karyawan','tanggal');
	/*-- Default Order --*/
	var $orderSimpanansukarela = array('id' => 'desc');

	private function _get_simpanansukarela_query(){

		$this->db->from($this->tableSimpanansukarela);

		$i = 0;
		/*-- looping awal  --*/
		foreach ($this->column_searchSimpanansukarela as $item){

			/*-- jika datatable mengirimkan pencarian dengan metode POST   --*/
			if($_POST['search']['value']) {

				/*-- looping awal  --*/
				if($i===0){

					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);

				}else{

					$this->db->or_like($item, $_POST['search']['value']);

				}

				if(count($this->column_searchSimpanansukarela) - 1 == $i) 
					$this->db->group_end(); 
			}

			$i++;
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_orderSimpanansukarela[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->orderSimpanansukarela)){

			$orderSimpanansukarela = $this->orderSimpanansukarela;
			$this->db->order_by(key($orderSimpanansukarela), $orderSimpanansukarela[key($orderSimpanansukarela)]);
		}
	}

	function get_simpanansukarela(){
		$this->_get_simpanansukarela_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}


	function count_filtered_simpanansukarela(){
		$this->_get_simpanansukarela_query();
		$query = $this->db->get();
		return $query->num_rows();

	}

	function count_all_simpanansukarela(){
		$this->db->from($this->tableSimpanansukarela);
		return $this->db->count_all_results();
	}


	/*-----------------------------------*/
	/*--  Server Side Data Anggota --------*/
	/*-----------------------------------*/

	/*-- nama tabel dari database  --*/
	var $tableAnggota = 'tb_anggota';
	/*-- field yang ada di table user yang akan ditampilkan --*/
	var $column_orderAnggota = array(null, 'nama_karyawan','nik_karyawan','divisi','echelon');
	/*-- field yang diizin untuk pencarian --*/
	var $column_searchAnggota = array('nama_karyawan','nik_karyawan','divisi','echelon');
	/*-- Default Order --*/
	var $orderAnggota = array('id' => 'desc');


	private function _get_Anggota_query(){

		$this->db->from($this->tableAnggota);

		$i = 0;
		/*-- looping awal  --*/
		foreach ($this->column_searchAnggota as $item){

			/*-- jika datatable mengirimkan pencarian dengan metode POST   --*/
			if($_POST['search']['value']) {

				/*-- looping awal  --*/
				if($i===0){

					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);

				}else{

					$this->db->or_like($item, $_POST['search']['value']);

				}

				if(count($this->column_searchAnggota) - 1 == $i) 
					$this->db->group_end(); 
			}

			$i++;
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_orderAnggota[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->orderAnggota)){

			$orderAnggota = $this->orderAnggota;
			$this->db->order_by(key($orderAnggota), $orderAnggota[key($orderAnggota)]);

		}
	}

	function get_Anggota(){
		
		$this->_get_Anggota_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();

	}


	function count_filtered_Anggota(){

		$this->_get_Anggota_query();
		$query = $this->db->get();
		return $query->num_rows();

	}


	function count_all_Anggota(){
		$this->db->from($this->tableAnggota);
		return $this->db->count_all_results();

	}

}