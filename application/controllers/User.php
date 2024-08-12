<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class User extends CI_Controller {

	public function __construct(){

		parent::__construct();
		/*-- Check Session  --*/
		is_login();
		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('admin_model');
	}

	public function index(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		  
		$data['juser'] = $this->admin_model->getCountUser();
		$data['page'] = "Dashboard";
		$this->template->load('user/layout/user_template','user/user_dashboard',$data);

	}

	public function dashboardDetail($id){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['onePelanggaranAll'] = $this->admin_model->getOnePelanggaranByID($this->encrypt->decode($id));
		$data['oneSiswa'] = $this->admin_model->getOneSiswa($this->encrypt->decode($id));
		$data['pelanggaranTotal'] = $this->admin_model->getCountPelanggaran($this->encrypt->decode($id));
		$data['pelanggaran'] = $this->admin_model->getPelanggaranByID($this->encrypt->decode($id));
		$data['parent'] = "Dashboard";
		$data['page'] = "Detail Pelanggaran";
		$this->template->load('admin/layout/admin_template','admin/admin_dashboardDetail',$data);

	}

	/*-- Kategori --*/
	public function kategori(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['jkategori'] = $this->admin_model->getCountKategori();
		$data['parent'] = "Data Kategori";
		$data['page'] = "List Data Kategori";
		$this->template->load('admin/layout/admin_template','admin/kategori',$data);
	}

	function get_kategori(){
		$id_kategori=$this->input->get('id_kategori');
		$data=$this->ajax_model->get_kategori_by_id($id_kategori);
		echo json_encode($data);
	}

	public function kategori_delete(){
		if ($this->session->userdata('level')=='User') {
			$id_kategori = $this->input->post("id_kategori");
			$this->db->delete('tb_kategori',['id_kategori' => $id_kategori]);
			$sukses = "Deleted successfully.";
			echo json_encode($sukses);
		} else {
			redirect('User');
		}
	}

	public function saveKategori(){
		if ($this->session->userdata('level')=='User') {
			$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
				if ($this->input->post('id_kategori')=='') {
					$data = [
						'kategori' => $this->input->post('kategori'),
					];

					$this->db->insert('tb_kategori', $data);
				} else {
					$data = [
						'id_kategori' => $this->input->post('id_kategori'),
						'kategori' => $this->input->post('kategori'),
					];

					$this->db->where('id_kategori', $this->input->post('id_kategori'));
					$this->db->update('tb_kategori',$data);
				}
		} else {
			redirect('User');
		}
	}

	/*-- barang --*/
	public function kode_barang(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['jbarang'] = $this->admin_model->getCountbarang();
		$data['parent'] = "Data barang";
		$data['page'] = "List Data barang";
		$this->template->load('admin/layout/admin_template','admin/barang',$data);
	}

	function get_barang(){
		$kode_brg=$this->input->get('kode_brg');
		$data=$this->ajax_model->get_barang_by_id($kode_brg);
		echo json_encode($data);
	}

	public function barang_delete(){
		if ($this->session->userdata('level')=='User') {
			$kode_brg = $this->input->post("kode_brg");
			$this->db->delete('tb_barang',['kode_brg' => $kode_brg]);
			$sukses = "Deleted successfully.";
			echo json_encode($sukses);
		} else {
			redirect('User');
		}
	}

	public function savebarang(){
    // Pastikan user adalah admin
	    if ($this->session->userdata('level') == 'User') {
	        // Mendapatkan data user
	        $data['user'] = $this->db->get_where('tb_users', ['username' => $this->session->userdata('username')])->row();
	        
	        header('Content-Type: application/json');
	        
	        if ($this->input->post('kode_brg_a') == '') {
	            $kode_brg = $this->input->post('kode_brg');
	            $query = $this->db->query("SELECT * FROM tb_barang WHERE kode_brg = '$kode_brg'");
	            
	            if ($query->num_rows() > 0) {
	                // Kode barang sudah ada
	                $response = [
	                    'status' => 'error',
	                    'message' => 'Kode Kelompok Barang sudah ada.'
	                ];
	            } else {
	                // Tambahkan barang baru
	                $data = [
	                    'kode_brg' => $this->input->post('kode_brg'),
	                    'nama_brg' => $this->input->post('nama_brg'),
	                ];
	                $this->db->insert('tb_barang', $data);
	                $response = [
	                    'status' => 'success',
	                    'message' => 'Data berhasil ditambahkan.'
	                ];
	            }
	        } else {
	        	if ($this->input->post('kode_brg')==$this->input->post('kode_brg_a')){
	        		$data = [
	                    'kode_brg' => $this->input->post('kode_brg'),
	                    'nama_brg' => $this->input->post('nama_brg'),
	                ];
	                $this->db->where('kode_brg', $this->input->post('kode_brg'));
					$this->db->update('tb_barang',$data);
	                $response = [
	                    'status' => 'success',
	                    'message' => 'Data berhasil diupdate.'
	                ];
	        	} else {
	        		$kode_brg = $this->input->post('kode_brg');
		            $query = $this->db->query("SELECT * FROM tb_barang WHERE kode_brg = '$kode_brg'");
		            
		            if ($query->num_rows() > 0) {
		                // Kode barang sudah ada
		                $response = [
		                    'status' => 'error',
		                    'message' => 'Kode Kelompok Barang sudah ada.'
		                ];
		            } else {
		                // Tambahkan barang baru
		                $data = [
		                    'kode_brg' => $this->input->post('kode_brg'),
		                    'nama_brg' => $this->input->post('nama_brg'),
		                ];
		                $this->db->where('kode_brg', $this->input->post('kode_brg_a'));
						$this->db->update('tb_barang',$data);
		                $response = [
		                    'status' => 'success',
		                    'message' => 'Data berhasil diupdate.'
		                ];
		            }
	        	}
	        }
	        
	        // Mengembalikan respons JSON
	        echo json_encode($response);
	    } else {
	        // Redirect jika bukan admin
	        redirect('User');
	    }
	}


	/*-- rekening --*/
	public function rekening_belanja(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['jrekening'] = $this->admin_model->getCountrekening();
		$data['parent'] = "Data rekening";
		$data['page'] = "List Data rekening";
		$this->template->load('admin/layout/admin_template','admin/rekening',$data);
	}

	function get_rekening(){
		$kode_rek=$this->input->get('kode_rek');
		$data=$this->ajax_model->get_rekening_by_id($kode_rek);
		echo json_encode($data);
	}

	public function rekening_delete(){
		if ($this->session->userdata('level')=='User') {
			$kode_rek = $this->input->post("kode_rek");
			$this->db->delete('tb_rekening',['kode_rek' => $kode_rek]);
			$sukses = "Deleted successfully.";
			echo json_encode($sukses);
		} else {
			redirect('User');
		}
	}

	public function saverekening(){
    // Pastikan user adalah admin
	    if ($this->session->userdata('level') == 'User') {
	        // Mendapatkan data user
	        $data['user'] = $this->db->get_where('tb_users', ['username' => $this->session->userdata('username')])->row();
	        
	        header('Content-Type: application/json');
	        
	        if ($this->input->post('kode_rek_a') == '') {
	            $kode_rek = $this->input->post('kode_rek');
	            $query = $this->db->query("SELECT * FROM tb_rekening WHERE kode_rek = '$kode_rek'");
	            
	            if ($query->num_rows() > 0) {
	                // Kode rekening sudah ada
	                $response = [
	                    'status' => 'error',
	                    'message' => 'Kode Rekening sudah ada.'
	                ];
	            } else {
	                // Tambahkan rekening baru
	                $data = [
	                    'kode_rek' => $this->input->post('kode_rek'),
	                    'nama_rek' => $this->input->post('nama_rek'),
	                ];
	                $this->db->insert('tb_rekening', $data);
	                $response = [
	                    'status' => 'success',
	                    'message' => 'Data berhasil ditambahkan.'
	                ];
	            }
	        } else {
	        	if ($this->input->post('kode_rek')==$this->input->post('kode_rek_a')){
	        		$data = [
	                    'kode_rek' => $this->input->post('kode_rek'),
	                    'nama_rek' => $this->input->post('nama_rek'),
	                ];
	                $this->db->where('kode_rek', $this->input->post('kode_rek'));
					$this->db->update('tb_rekening',$data);
	                $response = [
	                    'status' => 'success',
	                    'message' => 'Data berhasil diupdate.'
	                ];
	        	} else {
	        		$kode_rek = $this->input->post('kode_rek');
		            $query = $this->db->query("SELECT * FROM tb_rekening WHERE kode_rek = '$kode_rek'");
		            
		            if ($query->num_rows() > 0) {
		                // Kode rekening sudah ada
		                $response = [
		                    'status' => 'error',
		                    'message' => 'Kode Rekening sudah ada.'
		                ];
		            } else {
		                // Tambahkan rekening baru
		                $data = [
		                    'kode_rek' => $this->input->post('kode_rek'),
		                    'nama_rek' => $this->input->post('nama_rek'),
		                ];
		                $this->db->where('kode_rek', $this->input->post('kode_rek_a'));
						$this->db->update('tb_rekening',$data);
		                $response = [
		                    'status' => 'success',
		                    'message' => 'Data berhasil diupdate.'
		                ];
		            }
	        	}
	        }
	        
	        // Mengembalikan respons JSON
	        echo json_encode($response);
	    } else {
	        // Redirect jika bukan admin
	        redirect('User');
	    }
	}

	/*-- satuan --*/
	public function satuan(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['jsatuan'] = $this->admin_model->getCountsatuan();
		$data['parent'] = "Data satuan";
		$data['page'] = "List Data satuan";
		$this->template->load('admin/layout/admin_template','admin/satuan',$data);
	}

	function get_satuan(){
		$id_satuan=$this->input->get('id_satuan');
		$data=$this->ajax_model->get_satuan_by_id($id_satuan);
		echo json_encode($data);
	}

	public function satuan_delete(){
		if ($this->session->userdata('level')=='User') {
			$id_satuan = $this->input->post("id_satuan");
			$this->db->delete('tb_satuan',['id_satuan' => $id_satuan]);
			$sukses = "Deleted successfully.";
			echo json_encode($sukses);
		} else {
			redirect('User');
		}
	}

	public function savesatuan(){
		if ($this->session->userdata('level')=='User') {
			$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
				if ($this->input->post('id_satuan')=='') {
					$data = [
						'satuan' => $this->input->post('satuan'),
					];

					$this->db->insert('tb_satuan', $data);
				} else {
					$data = [
						'id_satuan' => $this->input->post('id_satuan'),
						'satuan' => $this->input->post('satuan'),
					];

					$this->db->where('id_satuan', $this->input->post('id_satuan'));
					$this->db->update('tb_satuan',$data);
				}
		} else {
			redirect('User');
		}
	}

/*-- user --*/
	public function user(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['parent'] = "Data user";
		$data['page'] = "List Data user";
		$this->template->load('admin/layout/admin_template','admin/user',$data);
	}

	function get_user(){
		$id=$this->input->get('id');
		$data=$this->ajax_model->get_user_by_id($id);
		echo json_encode($data);
	}

	public function user_delete(){
		if ($this->session->userdata('level')=='User') {
			$id = $this->input->post("id");
			$this->db->delete('tb_users',['id' => $id]);
			$sukses = "Deleted successfully.";
			echo json_encode($sukses);
		} else {
			redirect('User');
		}
	}

	public function saveuser(){
    // Pastikan user adalah admin
	    if ($this->session->userdata('level') == 'User') {
	        // Mendapatkan data user
	        $data['user'] = $this->db->get_where('tb_users', ['username' => $this->session->userdata('username')])->row();
	        
	        header('Content-Type: application/json');
	        
	        if ($this->input->post('id') == '') {
	            $username = $this->input->post('username');
	            $query = $this->db->query("SELECT * FROM tb_users WHERE username = '$username'");
	            
	            if ($query->num_rows() > 0) {
	                $response = [
	                    'status' => 'error',
	                    'message' => 'Username sudah ada.'
	                ];
	            } else {
	                $data = [
	                    'full_name' => $this->input->post('full_name'),
	                    'email' => $this->input->post('email'),
	                    'username' => $this->input->post('username'),
	                    'password' => password_hash('User123', PASSWORD_DEFAULT),
	                    'level' => 'User',
	                    'status' => '1',
						'instansi' => $this->input->post('instansi'),
	                ];
	                $this->db->insert('tb_users', $data);
	                $response = [
	                    'status' => 'success',
	                    'message' => 'Data berhasil ditambahkan.'
	                ];
	            }
	        } else {
	        	if ($this->input->post('username')==$this->input->post('username_a')){
	        		if ($this->input->post('password')=='') {
	        			$data = [
		                    'full_name' => $this->input->post('full_name'),
		                    'email' => $this->input->post('email'),
		                    'username' => $this->input->post('username'),
		                    'level' => 'User',
		                    'status' => '1',
							'instansi' => $this->input->post('instansi'),
	                	];
	        		} else {
	        			$data = [
		                    'full_name' => $this->input->post('full_name'),
		                    'email' => $this->input->post('email'),
		                    'username' => $this->input->post('username'),
		                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
		                    'level' => 'User',
		                    'status' => '1',
							'instansi' => $this->input->post('instansi'),
	                	];
	        		}
	        		
	                $this->db->where('id', $this->input->post('id'));
					$this->db->update('tb_users',$data);
	                $response = [
	                    'status' => 'success',
	                    'message' => 'Data berhasil diupdate.'
	                ];
	        	} else {
	        		$username = $this->input->post('username');
	            	$query = $this->db->query("SELECT * FROM tb_users WHERE username = '$username'");
		            
		            if ($query->num_rows() > 0) {
		                $response = [
		                    'status' => 'error',
		                    'message' => 'Username sudah ada.'
		                ];
		            } else {
		                if ($this->input->post('password')=='') {
		                	$data = [
			                    'full_name' => $this->input->post('full_name'),
			                    'email' => $this->input->post('email'),
			                    'username' => $this->input->post('username'),
			                    'level' => 'User',
			                    'status' => '1',
								'instansi' => $this->input->post('instansi'),
			                ];
		                } else {
		                	$data = [
			                    'full_name' => $this->input->post('full_name'),
			                    'email' => $this->input->post('email'),
			                    'username' => $this->input->post('username'),
			                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			                    'level' => 'User',
			                    'status' => '1',
								'instansi' => $this->input->post('instansi'),
			                ];
		                }
		                $this->db->where('id', $this->input->post('id'));
						$this->db->update('tb_users',$data);
		                $response = [
		                    'status' => 'success',
		                    'message' => 'Data berhasil diupdate.'
		                ];
		            }
	        	}
	        }
	        
	        // Mengembalikan respons JSON
	        echo json_encode($response);
	    } else {
	        // Redirect jika bukan admin
	        redirect('User');
	    }
	}

	public function dataListSimpananpokok(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['parent'] = "Data Simpanan Pokok";
		$data['page'] = "List Simpanan Pokok";
		$this->template->load('admin/layout/admin_template','admin/modul_dataSimpananpokok/admin_listSimpananpokok',$data);
	}

	public function dataListSimpananwajib(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['parent'] = "Data Simpanan Wajib";
		$data['page'] = "List Simpanan Wajib";
		$this->template->load('admin/layout/admin_template','admin/modul_dataSimpananwajib/admin_listSimpananwajib',$data);

	}

	public function dataListPinjaman(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['parent'] = "Data Pinjaman";
		$data['page'] = "List Pinjaman";
		$this->template->load('admin/layout/admin_template','admin/modul_dataPinjaman/admin_listPinjaman',$data);

	}

	public function dataListAngsuran(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['parent'] = "Data Angsuran";
		$data['page'] = "List Angsuran";
		$this->template->load('admin/layout/admin_template','admin/modul_dataAngsuran/admin_listAngsuran',$data);

	}

	public function dataListSimpanansukarela(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['parent'] = "Data Simpanan Sukarela";
		$data['page'] = "List Simpanan Sukarela";
		$this->template->load('admin/layout/admin_template','admin/modul_dataSimpanansukarela/admin_listSimpanansukarela',$data);
	}

	

	public function dataListSimpananpokokAdd(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		
		$data['anggotaAll'] = $this->admin_model->getAnggota();

		$this->form_validation->set_rules('tanggal','Tanggal Simpanan Pokok','required');
		$this->form_validation->set_rules('id_anggota','Nama Karyawan','required');
		$this->form_validation->set_rules('jumlah','Jumlah Simpanan Pokok','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "List Simpanan Pokok";
			$data['page'] = "List Simpanan Pokok Add";
			$this->template->load('admin/layout/admin_template','admin/modul_dataSimpananpokok/admin_listSimpananpokokAdd',$data);
		}else{
			$data = [
				'tanggal' => $this->input->post('tanggal'),
				'id_anggota' => $this->input->post('id_anggota'),
				'jumlah' => $this->input->post('jumlah'),
			];
			$this->db->insert('tb_simpananpokok', $data);
			$this->toastr->success('Data Simpanan Pokok Telah Ditambahkan!');
			redirect('admin/dataListSimpananpokok');
		}
	}

	public function dataListSimpananwajibAdd(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['anggotaAll'] = $this->admin_model->getAnggota();

		$this->form_validation->set_rules('tanggal','Tanggal Simpanan Wajib','required');
		$this->form_validation->set_rules('id_anggota','Nama Karyawan','required');
		$this->form_validation->set_rules('jumlah','Jumlah Simpanan Wajib','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "List Simpanan Wajib";
			$data['page'] = "List Simpanan Wajib Add";
			$this->template->load('admin/layout/admin_template','admin/modul_dataSimpananwajib/admin_listSimpananwajibAdd',$data);
		}else{
			$data = [
				'tanggal' => $this->input->post('tanggal'),
				'id_anggota' => $this->input->post('id_anggota'),
				'jumlah' => $this->input->post('jumlah'),

			];
			$this->db->insert('tb_simpananwajib', $data);
			$this->toastr->success('Data Simpanan Wajib Telah Ditambahkan!');
			redirect('admin/dataListSimpananwajib');
		}
	}

	public function dataListPinjamanAdd(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['anggotaAll'] = $this->admin_model->getAnggota();

		$this->form_validation->set_rules('tanggal','Tanggal Pinjaman','required');
		$this->form_validation->set_rules('id_anggota','Nama Karyawan','required');
		$this->form_validation->set_rules('jumlah_pinjaman','Jumlah Pinjaman','required');
		$this->form_validation->set_rules('tenor','Tenor','required');
		$this->form_validation->set_rules('jumlah_angsuran','Jumlah Angsuran','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "List Pinjaman";
			$data['page'] = "List Pinjaman Add";
			$this->template->load('admin/layout/admin_template','admin/modul_dataPinjaman/admin_listPinjamanAdd',$data);
		}else{
			$data = [
				'tanggal' => $this->input->post('tanggal'),
				'id_anggota' => $this->input->post('id_anggota'),
				'jumlah_pinjaman' => $this->input->post('jumlah_pinjaman'),
				'tenor' => $this->input->post('tenor'),
				'bunga' => $this->input->post('bunga'),
				'jumlah_angsuran' => $this->input->post('jumlah_angsuran'),

			];
			$this->db->insert('tb_pinjaman', $data);
			$this->toastr->success('Data Transaksi Pinjaman Telah Ditambahkan!');
			redirect('admin/dataListPinjaman');
		}
	}

	public function dataListAngsuranAdd(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['anggotaAll'] = $this->admin_model->getPinjamanAnggota();

		$this->form_validation->set_rules('tanggal','Tanggal Pinjaman','required');
		$this->form_validation->set_rules('id_pinjaman','Pinjaman | Nama Anggota','required');
		$this->form_validation->set_rules('angsuran_ke','Angsuran Ke','required');
		$this->form_validation->set_rules('jumlah_angsuran','Jumlah Angsuran','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "List Angsuran";
			$data['page'] = "List Angsuran Add";
			$this->template->load('admin/layout/admin_template','admin/modul_dataAngsuran/admin_listAngsuranAdd',$data);
		}else{
			$data = [
				'tanggal' => $this->input->post('tanggal'),
				'id_pinjaman' => $this->input->post('id_pinjaman'),
				'angsuran_ke' => $this->input->post('angsuran_ke'),
				'jumlah_angsuran' => $this->input->post('jumlah_angsuran'),

			];
			$this->db->insert('tb_angsuran', $data);
			$this->toastr->success('Data Transaksi Angsuran Telah Ditambahkan!');
			redirect('admin/dataListAngsuran');
		}
	}

	public function dataListSimpanansukarelaAdd(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['anggotaAll'] = $this->admin_model->getAnggota();

		$this->form_validation->set_rules('tanggal','Tanggal Simpanan Sukarela','required');
		$this->form_validation->set_rules('id_anggota','Nama Karyawan','required');
		$this->form_validation->set_rules('jumlah','Jumlah Simpanan Sukarela','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "List Simpanan Sukarela";
			$data['page'] = "List Simpanan Sukarela Add";
			$this->template->load('admin/layout/admin_template','admin/modul_dataSimpanansukarela/admin_listSimpanansukarelaAdd',$data);
		}else{
			$data = [
				'tanggal' => $this->input->post('tanggal'),
				'id_anggota' => $this->input->post('id_anggota'),
				'jumlah' => $this->input->post('jumlah'),

			];
			$this->db->insert('tb_simpanansukarela', $data);
			$this->toastr->success('Data Simpanan Sukarela Telah Ditambahkan!');
			redirect('admin/dataListSimpanansukarela');
		}
	}

	public function dataListAnggotaAdd(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();


		$this->form_validation->set_rules('nama_karyawan','Nama Karyawan','required');
		$this->form_validation->set_rules('nik_karyawan','N I K','required');
		$this->form_validation->set_rules('divisi','Divisi','required');
		$this->form_validation->set_rules('echelon','Echelon','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "List Anggota";
			$data['page'] = "List Anggota Add";
			$this->template->load('admin/layout/admin_template','admin/modul_dataAnggota/admin_listAnggotaAdd',$data);

		}else{

			$data = [
				'nama_karyawan' => $this->input->post('nama_karyawan'),
				'nik_karyawan' => $this->input->post('nik_karyawan'),
				'divisi' => $this->input->post('divisi'),
				'echelon' => $this->input->post('echelon')
			];


			$this->db->insert('tb_anggota', $data);

			$this->toastr->success('Anggota  Telah Ditambahkan!');
			redirect('admin/dataListAnggota');
		}

	}

	
	public function dataListSimpananpokokEdit($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataListSimpananpokok');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/dataListSimpananpokok');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['datasimpananpokok'] = $this->admin_model->getOneSimpananpokok($this->encrypt->decode($id));
		$data['anggotaAll'] = $this->admin_model->getAnggota();

		$this->form_validation->set_rules('tanggal','Tanggal Simpanan Pokok','required');
		$this->form_validation->set_rules('id_anggota','Nama Karyawan','required');
		$this->form_validation->set_rules('jumlah','Jumlah Simpanan Pokok','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "List Simpanan Pokok";
			$data['page'] = "List Simpanan Pokok Edit";
			$this->template->load('admin/layout/admin_template','admin/modul_dataSimpananpokok/admin_listSimpananpokokEdit',$data);
		}else{
			$data = [
				'tanggal' => $this->input->post('tanggal'),
				'id_anggota' => $this->input->post('id_anggota'),
				'jumlah' => $this->input->post('jumlah'),
			];
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tb_simpananpokok',$data);
			$this->toastr->success('List Simpanan Pokok Telah Di Update!');
			redirect('admin/dataListSimpananpokok');
		}
	}

	public function dataListSimpananwajibEdit($id = null){
		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataListSimpananwajib');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/dataListSimpananwajib');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['datasimpananwajib'] = $this->admin_model->getOneSimpananwajib($this->encrypt->decode($id));
		$data['anggotaAll'] = $this->admin_model->getAnggota();

		$this->form_validation->set_rules('tanggal','Tanggal Simpanan Wajib','required');
		$this->form_validation->set_rules('id_anggota','Nama Karyawan','required');
		$this->form_validation->set_rules('jumlah','Jumlah Simpanan Wajib','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "List Simpanan Waji";
			$data['page'] = "List Simpanan Wajib Edit";
			$this->template->load('admin/layout/admin_template','admin/modul_dataSimpananwajib/admin_listSimpananwajibEdit',$data);
		}else{
			$data = [
				'tanggal' => $this->input->post('tanggal'),
				'id_anggota' => $this->input->post('id_anggota'),
				'jumlah' => $this->input->post('jumlah'),
			];
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tb_simpananwajib',$data);
			$this->toastr->success('List Simpanan Wajib Telah Di Update!');
			redirect('admin/dataListSimpananwajib');
		}
	}

	public function dataListPinjamanEdit($id = null){
		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataListPinjaman');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/dataListPinjaman');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['datapinjaman'] = $this->admin_model->getOnePinjaman($this->encrypt->decode($id));

		$id_pinjaman=$this->encrypt->decode($id);
		$query = "SELECT a.* FROM q_angsuran a WHERE a.id_pinjaman='$id_pinjaman'";
		$result = $this->db->query($query)->row();

		$status_angsuran = isset($result->id_pinjaman) ? floatval($result->id_pinjaman) : 0;

		if (empty($status_angsuran)) {
		    $data['status'] = '0';
		} else {
		    $data['status'] = '1';
		}


		$data['anggotaAll'] = $this->admin_model->getAnggota();

		$this->form_validation->set_rules('tanggal','Tanggal Pinjaman','required');
		$this->form_validation->set_rules('id_anggota','Nama Karyawan','required');
		$this->form_validation->set_rules('jumlah_pinjaman','Jumlah Pinjaman','required');
		$this->form_validation->set_rules('tenor','Tenor','required');
		$this->form_validation->set_rules('jumlah_angsuran','Jumlah Angsuran','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "List Transaksi Pinjaman";
			$data['page'] = "List Transaksi Pinjaman Edit";
			$this->template->load('admin/layout/admin_template','admin/modul_dataPinjaman/admin_listPinjamanEdit',$data);
		}else{
			$data = [
				'tanggal' => $this->input->post('tanggal'),
				'id_anggota' => $this->input->post('id_anggota'),
				'jumlah_pinjaman' => $this->input->post('jumlah_pinjaman'),
				'tenor' => $this->input->post('tenor'),
				'bunga' => $this->input->post('bunga'),
				'jumlah_angsuran' => $this->input->post('jumlah_angsuran'),
			];
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tb_pinjaman',$data);
			$this->toastr->success('List Transaksi Pinjaman Telah Di Update!');
			redirect('admin/dataListPinjaman');
		}
	}

	public function dataListSimpanansukarelaEdit($id = null){
		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataListSimpanansukarela');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/dataListSimpanansukarela');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['datasimpanansukarela'] = $this->admin_model->getOneSimpanansukarela($this->encrypt->decode($id));
		$data['anggotaAll'] = $this->admin_model->getAnggota();

		$this->form_validation->set_rules('tanggal','Tanggal Simpanan Sukarela','required');
		$this->form_validation->set_rules('id_anggota','Nama Karyawan','required');
		$this->form_validation->set_rules('jumlah','Jumlah Simpanan Sukarela','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "List Simpanan Waji";
			$data['page'] = "List Simpanan Sukarela Edit";
			$this->template->load('admin/layout/admin_template','admin/modul_dataSimpanansukarela/admin_listSimpanansukarelaEdit',$data);
		}else{
			$data = [
				'tanggal' => $this->input->post('tanggal'),
				'id_anggota' => $this->input->post('id_anggota'),
				'jumlah' => $this->input->post('jumlah'),
			];
			$this->db->update('tb_simpanansukarela',$data);
			$this->db->where('id', $this->input->post('id'));
			$this->toastr->success('List Simpanan Sukarela Telah Di Update!');
			redirect('admin/dataListSimpanansukarela');
		}
	}


	public function dataListAnggotaEdit($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataListAnggota');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/dataListAnggota');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['onepel'] = $this->admin_model->getOneAnggota($this->encrypt->decode($id));

		
		$this->form_validation->set_rules('nama_karyawan','Nama Karyawan','required');
		$this->form_validation->set_rules('nik_karyawan','NIK','required');
		$this->form_validation->set_rules('divisi','Divisi','required');
		$this->form_validation->set_rules('echelon','Divisi','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "List Anggota";
			$data['page'] = "List Anggota Edit";
			$this->template->load('admin/layout/admin_template','admin/modul_dataAnggota/admin_listAnggotaEdit',$data);

		}else{

			$data = [
				'nama_karyawan' => $this->input->post('nama_karyawan'),
				'nik_karyawan' => $this->input->post('nik_karyawan'),
				'divisi' => $this->input->post('divisi'),
				'echelon' => $this->input->post('echelon')

			];

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tb_anggota',$data);
			$this->toastr->success('List Anggota Telah Di Update!');
			redirect('admin/dataListAnggota');

		}
	}

	public function dataListSimpananpokokDelete(){
		$id = $this->input->post("id");
		$dataSimpananpokok = $this->db->get_where('tb_simpananpokok',['id' => $id])->row();
		$this->db->delete('tb_simpananpokok',['id' => $id]);
		$sukses = "Deleted successfully.";
		echo json_encode($sukses);
	}

	public function dataListSimpananwajibDelete(){
		$id = $this->input->post("id");
		$dataSimpananwajib = $this->db->get_where('tb_simpananwajib',['id' => $id])->row();
		$this->db->delete('tb_simpananwajib',['id' => $id]);
		$sukses = "Deleted successfully.";
		echo json_encode($sukses);
	}

	public function dataListPinjamanDelete(){
		$id = $this->input->post("id");
		$dataPinjaman = $this->db->get_where('tb_pinjaman',['id' => $id])->row();
		$this->db->delete('tb_pinjaman',['id' => $id]);
		$sukses = "Deleted successfully.";
		echo json_encode($sukses);
	}

	public function dataListAngsuranDelete(){
		$id = $this->input->post("id");
		$dataPinjaman = $this->db->get_where('tb_angsuran',['id' => $id])->row();
		$this->db->delete('tb_angsuran',['id' => $id]);
		$sukses = "Deleted successfully.";
		echo json_encode($sukses);
	}

	public function dataListSimpanansukarelaDelete(){
		$id = $this->input->post("id");
		$datasimpanansukarela = $this->db->get_where('tb_simpanansukarela',['id' => $id])->row();
		$this->db->delete('tb_simpanansukarela',['id' => $id]);
		$sukses = "Deleted successfully.";
		echo json_encode($sukses);
	}

	public function dataListAnggotaDelete(){

		$id = $this->input->post("id");

		$this->db->delete('tb_anggota',['id' => $id]);

		$sukses = "Deleted successfully.";
		echo json_encode($sukses);

	}


	public function laporanSimpananpokok(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('pencarian','Tipe Pencarian','required');
		// $this->form_validation->set_rules('search','Silahkan Mengisi Inputan di Atas','required');
		$this->form_validation->set_rules('awal','Awal Periode','required');
		$this->form_validation->set_rules('akhir','Akhir Periode','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Simpanan Pokok";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporansimpananpokok',$data);
		}else{
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Data Simpanan Pokok";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporansimpananpokok',$data);

		}
	}

	public function laporanSimpananwajib(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('pencarian','Tipe Pencarian','required');
		// $this->form_validation->set_rules('search','Silahkan Mengisi Inputan di Atas','required');
		$this->form_validation->set_rules('awal','Awal Periode','required');
		$this->form_validation->set_rules('akhir','Akhir Periode','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Simpanan Wajib";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporansimpananwajib',$data);
		}else{
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Data Simpanan Wajib";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporansimpananwajib',$data);

		}
	}

	public function laporanSimpanansukarela(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('pencarian','Tipe Pencarian','required');
		// $this->form_validation->set_rules('search','Silahkan Mengisi Inputan di Atas','required');
		$this->form_validation->set_rules('awal','Awal Periode','required');
		$this->form_validation->set_rules('akhir','Akhir Periode','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Simpanan Sukarela";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporansimpanansukarela',$data);
		}else{
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Data Simpanan Sukarela";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporansimpanansukarela',$data);
		}
	}

	public function laporanSimpanananggota(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('id_anggota','Nama Anggota','required');
		$data['anggotaAll'] = $this->admin_model->getAnggota();

		if($this->form_validation->run() == false){
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Simpanan Anggota";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporansimpanananggota',$data);
		}else{
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Data Simpanan Anggota";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporansimpanananggota',$data);
		}
	}

	public function laporanPinjamananggota(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('id_anggota','Nama Anggota','required');
		
		$data['anggotaAll'] = $this->admin_model->getPinjamanAnggota();

		if($this->form_validation->run() == false){
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Pinjaman Anggota";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporanpinjamananggota',$data);
		}else{
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Data Pinjaman Anggota";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporanpinjamananggota',$data);
		}
	}

	public function laporanPinjaman(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('pencarian','Tipe Pencarian','required');
		// $this->form_validation->set_rules('search','Silahkan Mengisi Inputan di Atas','required');
		$this->form_validation->set_rules('awal','Awal Periode','required');
		$this->form_validation->set_rules('akhir','Akhir Periode','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Pinjaman";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporanpinjaman',$data);
		}else{
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Data Pinjaman";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporanpinjaman',$data);
		}
	}

	public function laporanAngsuran(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('pencarian','Tipe Pencarian','required');
		// $this->form_validation->set_rules('search','Silahkan Mengisi Inputan di Atas','required');
		$this->form_validation->set_rules('awal','Awal Periode','required');
		$this->form_validation->set_rules('akhir','Akhir Periode','required');

		if($this->form_validation->run() == false){
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Angsuran";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporanangsuran',$data);
		}else{
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Data Angsuran";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporanangsuran',$data);
		}
	}

	public function cetak_faktur() {
    if (($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "User_Berkah") || ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "Operator_Berkah")) {

        $id_pesanan = $this->uri->segment(3);
        $no_pesanan = $this->uri->segment(4);
        $sid_j = $this->session->userdata('id_jalur');

        // Query untuk mendapatkan data pesanan
        $cek = $this->db->query("select f.id_pesanan,date_format(f.tanggal,'%d-%m-%Y') as tanggal,date_format(f.tgl_terima,'%d-%m-%Y') as tgl_terima, f.tanggaljam,f.id_konsumen,f.nama,f.alamat,f.no_telp,f.no_wa,f.no_pesanan,f.ppb,f.biaya_kirim,f.diskon,f.status,sum(e.total) as total, (sum(e.total)+f.biaya_kirim-f.diskon) as pembayaran from (select a.id_pesanan,a.jumlah as jum,b.*, (a.jumlah*b.harga) total from data_detail_pesanan a left join (select c.*,d.satuan from data_barang c left join data_satuan d on d.id=c.id_satuan) b on b.id=a.id_barang) e left join (select data_pesanan.*,data_konsumen.nama,data_konsumen.alamat,data_konsumen.no_telp,data_konsumen.no_wa from data_pesanan left join data_konsumen on data_konsumen.id=data_pesanan.id_konsumen) f on f.id_pesanan=e.id_pesanan where f.id_pesanan='$id_pesanan' group by f.id_pesanan");

        if ($cek->num_rows() > 0) {
            foreach ($cek->result() as $data) {
                // Variabel-variabel dari hasil query
                $d['no_pesanan'] = $data->no_pesanan;
                $no_pesanan = $data->no_pesanan;
                $d['tanggal'] = $data->tanggal;
                $d['tgl_terima'] = $data->tgl_terima;
                $d['nama'] = $data->nama;
                $d['alamat'] = $data->alamat;
                $d['no_telp'] = $data->no_telp;
                $d['no_wa'] = $data->no_wa;
                $d['ppb'] = $data->ppb;
                $d['biaya_kirim'] = $data->biaya_kirim;
                $d['diskon'] = $data->diskon;
                $d['total'] = $data->total;
                $d['pembayaran'] = $data->pembayaran;
                $d['status'] = $data->status;
            }
        }

        $now = date('Y-m-d');
        $d['tgl_sekarang'] = $now;

        // Query untuk mendapatkan detail pesanan
        $d['record'] = $this->db->query("select a.id_pesanan,c.no_pesanan,c.id_konsumen,a.jumlah as jum,b.*, (a.jumlah*b.harga) total from data_detail_pesanan a left join (select c.*,d.satuan from data_barang c left join data_satuan d on d.id=c.id_satuan) b on b.id=a.id_barang left join data_pesanan c on c.id_pesanan=a.id_pesanan where c.id_pesanan='$id_pesanan'");

        // Menghitung jumlah baris untuk setiap item dalam detail pesanan
        $total_lines = 0;
        foreach ($d['record']->result_array() as $row) {
            $nm_barang = $row['nm_barang'];
            $jumlah = $row['jumlah'];
            $satuan = $row['satuan'];

            $text = $nm_barang . ' [' . $jumlah . ' ' . $satuan . ']';

            // Menghitung jumlah karakter dalam teks
            $length = strlen($text);

            // Panjang maksimum karakter dalam satu baris yang diizinkan oleh wordwrap
            $max_line_length = 12;

            // Menghitung jumlah baris dengan membagi jumlah karakter dengan panjang maksimum karakter per baris
            $num_lines = (ceil($length / $max_line_length))*4.6;

            // Menambahkan jumlah baris ke total baris
            $total_lines += $num_lines;
        }

        // Menghitung tinggi total kolom berdasarkan jumlah baris
        $tinggi_kolom = $total_lines; // Menggunakan 20 sebagai tinggi per baris

        // Menghitung tinggi tambahan untuk header, footer, atau ruang kosong tambahan jika diperlukan
        $additional_height_mm = 30; // Contoh: tinggi untuk header dan footer

        // Hitung tinggi total kertas (konten + tambahan)
        $total_height_mm = 81 + $tinggi_kolom + $additional_height_mm;

        // Nama file PDF
        $no_pesanan = $no_pesanan . '.pdf';

        ob_start();
        $content = $this->load->view('cetak_faktur', $d);
        $content = ob_get_clean();
        require_once('./asset/html2pdf/html2pdf.class.php');
        try {

            $width_in_mm = 80;

            $html2pdf = new HTML2PDF('P', array($width_in_mm, $total_height_mm), 'en', true, 'UTF-8', array(2, 0, 0, 0));

            $html2pdf->setTestTdInOnePage(false);

            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->Output($no_pesanan);
            echo '<script>cetakFaktur();</script>';
        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    } else {
        header('location:' . base_url() . '');
    }
}
	public function laporansimpananpokokPdf(){

		$this->load->library('mypdf');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		
			$query = "SELECT a.* FROM q_simpananpokok a WHERE a.tgl BETWEEN '$awal' AND '$akhir'";
		
			$data['periodea'] = $awal;
			$data['periodeb'] = $akhir;
			$data['hasilOne'] = $this->db->query($query)->row();
			$data['hasilAll'] = $this->db->query($query)->result();
			
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Simpanan Pokok ";
			$this->load->view('admin/modul_laporan/admin_laporansimpananpokokPDF',$data);
	}

	public function laporansimpananwajibPdf(){

		$this->load->library('mypdf');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		
			$query = "SELECT a.* FROM q_simpananwajib a WHERE a.tgl BETWEEN '$awal' AND '$akhir'";
		
			$data['periodea'] = $awal;
			$data['periodeb'] = $akhir;
			$data['hasilOne'] = $this->db->query($query)->row();
			$data['hasilAll'] = $this->db->query($query)->result();
			
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Simpanan Wajib ";
			$this->load->view('admin/modul_laporan/admin_laporansimpananwajibPDF',$data);
	}

	public function laporansimpanansukarelaPdf(){

		$this->load->library('mypdf');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		
			$query = "SELECT a.* FROM q_simpanansukarela a WHERE a.tgl BETWEEN '$awal' AND '$akhir'";
		
			$data['periodea'] = $awal;
			$data['periodeb'] = $akhir;
			$data['hasilOne'] = $this->db->query($query)->row();
			$data['hasilAll'] = $this->db->query($query)->result();
			
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Simpanan Sukarela ";
			$this->load->view('admin/modul_laporan/admin_laporansimpanansukarelaPDF',$data);
	}

	public function laporansimpanananggotaPdf(){
		$id_anggota = $this->input->post('id_anggota');
		if ($id_anggota==''){ exit; }
		$this->load->library('mypdf');

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		
			$query = "SELECT a.* FROM q_simpanan a WHERE a.id_anggota='$id_anggota' ORDER BY tgl, urut ASC";

			$query1 = "SELECT sum(jumlah) as total FROM q_simpanan a WHERE a.id_anggota='$id_anggota' ORDER BY tgl, urut ASC";
			
			$result = $this->db->query($query)->row();
			$result1 = $this->db->query($query1)->row();
		    
		    $data['nama_anggota'] = isset($result->nama_karyawan) ? $result->nama_karyawan : '';
		    $data['total'] = isset($result1->total) ? $result1->total : '';
		    $data['hasilAll'] = $this->db->query($query)->result();
			
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Simpanan Anggota ";
			$this->load->view('admin/modul_laporan/admin_laporansimpanananggotaPDF',$data);
	}

	public function laporanpinjamananggotaPdf(){
		$id_pinjaman = $this->input->post('id_pinjaman');
		if ($id_pinjaman==''){ exit; }

		$this->load->library('mypdf');

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		
			$query = "SELECT a.* FROM q_angsuran a WHERE a.id_pinjaman='$id_pinjaman' ORDER BY tgl ASC";

			$query1 = "SELECT sum(jumlah) as total FROM q_simpanan a WHERE a.id_anggota='$id_pinjaman' ORDER BY tgl, urut ASC";

			$query2 = "SELECT a.* FROM q_pinjaman a WHERE a.id='$id_pinjaman'";
			$query3 = "SELECT sum(jumlah_angsuran_pokok) as jumlah_angsuran_pokok FROM q_angsuran a WHERE a.id_pinjaman='$id_pinjaman'";
			$query4 = "SELECT sum(jumlah_angsuran) as jumlah_angsuran FROM q_angsuran a WHERE a.id_pinjaman='$id_pinjaman'";
			
			$result = $this->db->query($query)->row();
			$result1 = $this->db->query($query1)->row();
			$result2 = $this->db->query($query2)->row();
			$result3 = $this->db->query($query3)->row();
			$result4 = $this->db->query($query4)->row();
		    
		    $jp = isset($result2->jumlah_pinjaman) ? floatval($result2->jumlah_pinjaman) : 0;
			$jap = isset($result3->jumlah_angsuran_pokok) ? floatval($result3->jumlah_angsuran_pokok) : 0;

			if ($jap != 0) {
			    $sisa_jp = $jp - $jap;
			} else {
			    // Handle jika terjadi pembagian oleh nol
			    $sisa_jp = 0;
			}

			$jpb = isset($result2->jumlah_pinjaman_bunga) ? floatval($result2->jumlah_pinjaman_bunga) : 0;
			$japb = isset($result4->jumlah_angsuran) ? floatval($result4->jumlah_angsuran) : 0;

			if ($japb != 0) {
			    $sisa_jpb = $jpb - $japb;
			} else {
			    // Handle jika terjadi pembagian oleh nol
			    $sisa_jpb = 0;
			}



		    $data['nama_anggota'] = isset($result2->nama_karyawan) ? $result2->nama_karyawan : '';
		    $data['nik'] = isset($result2->nik_karyawan) ? $result2->nik_karyawan : '';
		    $data['jumlah_pinjaman'] = isset($result2->jumlah_pinjaman) ? $result2->jumlah_pinjaman : '';
		    $data['sisa_pinjaman'] = $sisa_jp;
		    $data['sisa_pinjamanb'] = $sisa_jpb;

		    $data['tot_pinjaman'] = $jap;
		    $data['tot_pinjamanb'] = $japb;

		    $data['jumlah_pinjaman_bunga'] = isset($result2->jumlah_pinjaman_bunga) ? $result2->jumlah_pinjaman_bunga : '';
		    $data['tenor'] = isset($result2->tenor) ? $result2->tenor : '';

		    $data['total'] = isset($result1->total) ? $result1->total : '';
		    $data['hasilAll'] = $this->db->query($query)->result();
			
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Pinjaman Anggota ";
			$this->load->view('admin/modul_laporan/admin_laporanpinjamananggotaPDF',$data);
	}

	public function laporanpinjamanPdf(){

		$this->load->library('mypdf');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		
			$query = "SELECT a.* FROM q_pinjaman a WHERE a.tgl BETWEEN '$awal' AND '$akhir'";
		
			$data['periodea'] = $awal;
			$data['periodeb'] = $akhir;
			$data['hasilOne'] = $this->db->query($query)->row();
			$data['hasilAll'] = $this->db->query($query)->result();
			
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Pinjaman";
			$this->load->view('admin/modul_laporan/admin_laporanpinjamanPDF',$data);
	}

	public function laporanangsuranPdf(){

		$this->load->library('mypdf');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		
			$query = "SELECT a.* FROM q_angsuran a WHERE a.tgl BETWEEN '$awal' AND '$akhir'";
		
			$data['periodea'] = $awal;
			$data['periodeb'] = $akhir;
			$data['hasilOne'] = $this->db->query($query)->row();
			$data['hasilAll'] = $this->db->query($query)->result();
			
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Angsuran";
			$this->load->view('admin/modul_laporan/admin_laporanangsuranPDF',$data);
	}

	public function Profile(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['parent'] = "Profile";
		$data['page'] = "Profile";
		$this->template->load('admin/layout/admin_template','admin/admin_profile',$data);
	}

	public function editProfile(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		
		$this->form_validation->set_rules('fullname','Fullname','required');

		if($this->form_validation->run() == false){

			$data['parent'] = "Profile";
			$data['page'] = "Profile";
			$this->template->load('admin/layout/admin_template','admin/admin_profile',$data);

		}else{

			//check jika ada gmabar yang akan diupload, "f" itu nama inputnya
			// $upload_image = $_FILES['photo']['name'];
			$filename = $this->session->userdata('username');

			$config['allowed_types'] = 'png';
				$config['max_size']     = '5120'; // dalam hitungan kilobyte(kb), aslinya 1mb itu 1024kb
				$config['upload_path'] = './assets/sips/img/admin/';
				$config['overwrite'] = "TRUE";
				$config['file_name'] = $filename;

				$this->load->library('upload', $config);
				$this->upload->overwrite = true;
				if(! $this->upload->do_upload('photo')){

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('User/profile');

				}else{

					$data = [

						'full_name' => $this->input->post('fullname'),
						'email' => $this->input->post('email'),
					];

					$this->db->where('id', $this->input->post('z'));
					$this->db->update('tb_users',$data);
					$this->toastr->success('Profile Telah Di Update!');
					redirect('User/profile');
				}

			}
		}


		public function changePassword(){

			$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

			$this->form_validation->set_rules('bb', 'New Password','required|trim|min_length[4]|matches[cc]');
			$this->form_validation->set_rules('cc', 'Confirm New Password','required|trim|min_length[4]|matches[bb]');

			if($this->form_validation->run() == false){

				$data['parent'] = "Profile";
				$data['page'] = "Profile";
				$this->template->load('admin/layout/admin_template','admin/admin_profile',$data);

			}else{


				$new_password = $this->input->post('bb');


				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

				$this->db->set('password', $password_hash);
				$this->db->where('id', $this->input->post('dd'));
				$this->db->update('tb_users');

				$this->toastr->success('password Berahasil Di Ubah!');
				redirect('User/profile');
			}

		}




}



