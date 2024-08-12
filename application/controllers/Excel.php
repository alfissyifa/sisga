<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Excel_model');
        $this->load->library('upload');
    }

    public function index() {
        $this->load->view('upload_excel');
    }

    public function import_kategori() {
        if (!isset($_FILES['file']) || $_FILES['file']['error'] != UPLOAD_ERR_OK) {
            echo json_encode(['error' => 'Tidak ada file yang diunggah atau terjadi kesalahan saat mengunggah']);
            return;
        }

        $file = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        // Validasi file ekstensi dan tipe MIME
        $allowedTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        $allowedExtensions = ['xls', 'xlsx'];

        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (!in_array($fileType, $allowedTypes) || !in_array($fileExtension, $allowedExtensions)) {
            echo json_encode(['error' => 'Jenis file tidak valid. Hanya file Excel yang diperbolehkan..']);
            return;
        }

        // Load PHPExcel library
        require_once APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php';

        try {
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $data = [];
            foreach ($sheetData as $key => $value) {
                if ($key == 1) continue; // Skip header row
                if ($value['A'] != '') {
                    $data[] = [
                        'kategori' => $value['A'],
                    ];    
                }
            }

            // Mengimpor data baru
            $this->Excel_model->insert_data_kategori($data);
            $this->session->set_flashdata('message', 'Data berhasil diimport');
            echo json_encode(['success' => 'Import data dari Excel success']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function import_barang() {
        if (!isset($_FILES['file']) || $_FILES['file']['error'] != UPLOAD_ERR_OK) {
            echo json_encode(['error' => 'Tidak ada file yang diunggah atau terjadi kesalahan saat mengunggah']);
            return;
        }

        $file = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        // Validasi file ekstensi dan tipe MIME
        $allowedTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        $allowedExtensions = ['xls', 'xlsx'];

        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (!in_array($fileType, $allowedTypes) || !in_array($fileExtension, $allowedExtensions)) {
            echo json_encode(['error' => 'Jenis file tidak valid. Hanya file Excel yang diperbolehkan..']);
            return;
        }

        // Load PHPExcel library
        require_once APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php';

        try {
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $data = [];
            foreach ($sheetData as $key => $value) {
                if ($key == 1) continue; // Skip header row
                if ($value['A'] != '') {
                    $data[] = [
                        'kode_brg' => $value['A'],
                        'nama_brg' => $value['B'],
                    ];    
                }
            }

            // Mengimpor data baru
            $this->Excel_model->insert_data_barang($data);
            $this->session->set_flashdata('message', 'Data berhasil diimport');
            echo json_encode(['success' => 'Import data dari Excel success']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }


    public function import_rekening() {
        if (!isset($_FILES['file']) || $_FILES['file']['error'] != UPLOAD_ERR_OK) {
            echo json_encode(['error' => 'Tidak ada file yang diunggah atau terjadi kesalahan saat mengunggah']);
            return;
        }

        $file = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        // Validasi file ekstensi dan tipe MIME
        $allowedTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        $allowedExtensions = ['xls', 'xlsx'];

        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (!in_array($fileType, $allowedTypes) || !in_array($fileExtension, $allowedExtensions)) {
            echo json_encode(['error' => 'Jenis file tidak valid. Hanya file Excel yang diperbolehkan..']);
            return;
        }

        // Load PHPExcel library
        require_once APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php';

        try {
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $data = [];
            foreach ($sheetData as $key => $value) {
                if ($key == 1) continue; // Skip header row
                if ($value['A'] != '') {
                    $data[] = [
                        'kode_rek' => $value['A'],
                        'nama_rek' => $value['B'],
                    ];    
                }
            }

            // Mengimpor data baru
            $this->Excel_model->insert_data_rekening($data);
            $this->session->set_flashdata('message', 'Data berhasil diimport');
            echo json_encode(['success' => 'Import data dari Excel success']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }


    public function import_satuan() {
        if (!isset($_FILES['file']) || $_FILES['file']['error'] != UPLOAD_ERR_OK) {
            echo json_encode(['error' => 'Tidak ada file yang diunggah atau terjadi kesalahan saat mengunggah']);
            return;
        }

        $file = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        // Validasi file ekstensi dan tipe MIME
        $allowedTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        $allowedExtensions = ['xls', 'xlsx'];

        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (!in_array($fileType, $allowedTypes) || !in_array($fileExtension, $allowedExtensions)) {
            echo json_encode(['error' => 'Jenis file tidak valid. Hanya file Excel yang diperbolehkan..']);
            return;
        }

        // Load PHPExcel library
        require_once APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php';

        try {
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $data = [];
            foreach ($sheetData as $key => $value) {
                if ($key == 1) continue; // Skip header row
                if ($value['A'] != '') {
                    $data[] = [
                        'satuan' => $value['A'],
                    ];    
                }
            }

            // Mengimpor data baru
            $this->Excel_model->insert_data_satuan($data);
            $this->session->set_flashdata('message', 'Data berhasil diimport');
            echo json_encode(['success' => 'Import data dari Excel success']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }


}

?>
