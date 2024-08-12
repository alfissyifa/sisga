
<script type="text/javascript">


  /*-- Jquery Change Assess  --*/
  $('.custom-file-input').on('change', function(){
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);

  });

  var baseUrl = "<?= base_url();?>";

  /*-- Toastr  --*/
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  <?php if ($this->session->flashdata('success')) {?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
  <?php } else if ($this->session->flashdata('error')) {?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
  <?php } else if ($this->session->flashdata('warning')) {?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
  <?php } else if ($this->session->flashdata('info')) {?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
  <?php }?>


     //Date range picker
     $('#reservation').daterangepicker({
      singleDatePicker : true,
      showDropdowns : true,
      timePicker : true,
      timePicker24Hour: true,
      timePickerSeconds: true,
      // startDate: "2020-01-01 12:00:00",
      startDate : moment().startOf('hour:minute:second'),
      locale: {
        format: 'YYYY-MM-DD HH:mm:ss'
      }
    });

     $('#akhir').daterangepicker({
      singleDatePicker : true,
      showDropdowns : true,
      timePicker : true,
      timePicker24Hour: true,
      timePickerSeconds: true,
      startDate : moment().startOf('hour:minute:second'),
      locale: {
        format: 'YYYY-MM-DD HH:mm:ss'
      }
    });



     $(document).ready(function() {


      // /*-- Active Link  --*/
      // var url = window.location;
      // const allLinks = document.querySelectorAll('.nav-item a');
      // const currentLink = [...allLinks].filter(e => {
      //   return e.href == url;
      // });

      // currentLink[0].classList.add("active");
      // currentLink[0].closest(".nav-treeview").style.display = "block ";
      // currentLink[0].closest(".has-treeview").classList.add("menu-open");
      // $('.menu-open').find('a').each(function() {
      //   if (!$(this).parents().hasClass('active')) {
      //     $(this).parents().addClass("active");
      //     $(this).addClass("active");
      //   }
      // });

      /*-- Ajax Responsive Table Whitout ServerSide For Mobile  --*/
      var terakhir = $('#terakhir').DataTable( {
        rowReorder: {
          selector: 'td:nth-child(2)'
        },
        responsive: true,
        paging: false,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: false,
        autoWidth: false,
      });

      var terbanyak = $('#terbanyak').DataTable( {
        rowReorder: {
          selector: 'td:nth-child(2)'
        },
        responsive: true,
        paging: false,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: false,
        autoWidth: false,
      });

      /*-- Ajax Responsive Table Whitout ServerSide For Mobile  --*/
      /*-- pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said --*/
      var oTable = $('#myTable').DataTable({

        sDom: 'lrtip',
        paging : true,
        responsive: true,
        autoWidth: false,
        autoWidth: false,
        info: false,
        ordering: true,
        lengthChange: false

      });   
      $('#seachKategoriGedung').keyup(function(){
        oTable.search($(this).val()).draw() ;
      });

      /*-- Ajax Select Nama Kelas  --*/
      $('#kelas').change(function(){
        var kelas = $('#kelas').val();
        if(kelas != ''){
          $.ajax({
            url:baseUrl+'ajax/fetch_subNamakelas',
            method:"POST",
            data:{kelas:kelas},
            success:function(data){
              $('#namaKelas').html(data);

              if(kelas == 'I'){
                $('#namaSiswa').html('<option value="" selected="selected">Pilih Kategori Kelas Terlebih Dahulu</option>');
              }else{
                $('#namaSiswa').html('<option value="" selected="selected">Pilih Nama Kelas Terlebih Dahulu</option>');
              }
            }
          })
        }
      });

      /*-- Ajax Select Nama Siswa  --*/
      $('#namaKelas').change(function(){
        var namaKelas = $('#namaKelas').val();
        if(namaKelas != ''){
          $.ajax({
            url:baseUrl+'ajax/fetch_subNamaSiswa',
            method:"POST",
            data:{namaKelas:namaKelas},
            success:function(data){
              $('#namaSiswa').html(data);
            }
          })
        }
      });



      /*-- Ajax Select Nama Kelas  --*/
      $('#addkelas').change(function(){
        var kelas = $('#addkelas').val();
        if(kelas != ''){
          $.ajax({
            url:baseUrl+'ajax/fetch_subNamakelas',
            method:"POST",
            data:{kelas:kelas},
            success:function(data){
              $('#addnamaKelas').html(data)

            }
          })
        }
      });



      /*-- Ajax Select Tipe Pencarian Laporan  --*/
      $('#tipePencarian').change(function(){
        var pencarian = $('#tipePencarian').val();
        if(pencarian == 'siswa'){

          $("#pencarianKelas").css("display", "none");
          $("#pencarianSiswa").css("display", "block");

        }else if(pencarian == 'kelas'){

          $("#pencarianSiswa").css("display", "none")
          $("#pencarianKelas").css("display", "block");

        }else if(pencarian == ''){

          $("#pencarianKelas").css("display", "none");
          $("#pencarianSiswa").css("display", "none");

        }
      });

    });



$(document).ready(function() {

  /*-- Ajax Select Level  --*/
  $('#addPenggunaLevel').change(function(){
    var penggunaLevel = $('#addPenggunaLevel').val();
    if(penggunaLevel == 'Admin'){

      $("#addPenggunaAdmin").css("display", "block");
      $("#addPenggunaGuru").css("display", "none");
      $("#addPenggunaWali").css("display", "none");
      $("#addPenggunaSiswa").css("display", "none");

    }else if(penggunaLevel == 'Guru'){

      $("#addPenggunaAdmin").css("display", "none");
      $("#addPenggunaGuru").css("display", "block");
      $("#addPenggunaWali").css("display", "none");
      $("#addPenggunaSiswa").css("display", "none");

    }else if(penggunaLevel == 'Wali'){

      $("#addPenggunaAdmin").css("display", "none");
      $("#addPenggunaGuru").css("display", "none");
      $("#addPenggunaWali").css("display", "block");
      $("#addPenggunaSiswa").css("display", "none");

    }else if(penggunaLevel == 'Siswa'){

      $("#addPenggunaAdmin").css("display", "none");
      $("#addPenggunaGuru").css("display", "none");
      $("#addPenggunaWali").css("display", "none");
      $("#addPenggunaSiswa").css("display", "block");

    }
  });


  /*-- Ajax Select Nama Kelas  --*/
  $('#addNIKGuru').change(function(){
    var idGuru = $('#addNIKGuru').val();
    if(idGuru != ''){
      $.ajax({
        url:baseUrl+'ajax/fetch_nikGuru',
        method:"POST",
        dataType:'json',
        data:{idGuru:idGuru},
        success:function(data){
          $('#addPenggunaFullnameGuru').val(data.nama);
          $('#addPenggunaUsernameGuru').val(data.nik);
        }
      })
    }
  });


  /*-- Ajax Select Nama Kelas  --*/
  $('#addNISNWali').change(function(){
    var nisnWali = $('#addNISNWali').val();
    if(nisnWali != ''){
      $.ajax({
        url:baseUrl+'ajax/fetch_nisnWali',
        method:"POST",
        dataType:'json',
        data:{nisnWali:nisnWali},
        success:function(data){
          $('#addPenggunaFullnameWali').val(data.nama);
          $('#addPenggunaUsernameWali').val(data.nisn);
        }
      })
    }
  });

  /*-- Ajax Select Nama Kelas  --*/
  $('#addNISNSiswa').change(function(){
    var nisnSiswa = $('#addNISNSiswa').val();
    if(nisnSiswa != ''){
      $.ajax({
        url:baseUrl+'ajax/fetch_nisnSiswa',
        method:"POST",
        dataType:'json',
        data:{nisnSiswa:nisnSiswa},
        success:function(data){
          $('#addPenggunaFullnameSiswa').val(data.nama);
          $('#addPenggunaUsernameSiswa').val(data.nisn);
        }
      })
    }
  });


});


$(function () {

  'use strict'

  /*-- Make the dashboard widgets sortable Using jquery UI --*/
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  });

  $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');

  /*-- Select 2 --*/
  $('.select2').select2();

  /*-- Timeout Alert Error form_validation 5sec --*/
  var timeout = 5000; 
  $('.alert').delay(timeout).fadeOut(500);

  /*-- Plugin for edit data mahasiswa --*/
  $('[data-mask]').inputmask();

  /*-- DatePicker Plugin to avoid Confict Wit JQuery --*/
  var datepicker = $.fn.datepicker.noConflict();
  $.fn.bootstrapDP = datepicker;    
  $('#tglLhr .input-group.date').datepicker({


  });

});

function deleteDataSimpananpokok(id){
  swal({
    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false

  },

  function(){
    $.ajax({
      url : "<?= base_url('admin/dataListsimpananpokokDelete')?>",
      method:"post",
      data:{id:id},
      dataType: 'json',
      success:function(data){
        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        
      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        
      }
    });
  });
};

function deleteDataSimpananwajib(id){
  swal({
    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false

  },

  function(){
    $.ajax({
      url : "<?= base_url('admin/dataListsimpananwajibDelete')?>",
      method:"post",
      data:{id:id},
      dataType: 'json',
      success:function(data){
        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        
      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        
      }
    });
  });
};

function deleteDataPinjaman(id){
  swal({
    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false

  },

  function(){
    $.ajax({
      url : "<?= base_url('admin/dataListpinjamanDelete')?>",
      method:"post",
      data:{id:id},
      dataType: 'json',
      success:function(data){
        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        
      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        
      }
    });
  });
};

function deleteDataAngsuran(id){
  swal({
    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false

  },

  function(){
    $.ajax({
      url : "<?= base_url('admin/dataListangsuranDelete')?>",
      method:"post",
      data:{id:id},
      dataType: 'json',
      success:function(data){
        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        
      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        
      }
    });
  });
};

function deleteDataSimpanansukarela(id){
  swal({
    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false

  },

  function(){
    $.ajax({
      url : "<?= base_url('admin/dataListsimpanansukarelaDelete')?>",
      method:"post",
      data:{id:id},
      dataType: 'json',
      success:function(data){
        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        
      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        
      }
    });
  });
};


function deleteDataAnggota(id){

  swal({

    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false

  },

  function(){

    $.ajax({

      url : "<?= base_url('admin/dataListAnggotaDelete')?>",
      method:"post",
      data:{id:id},
      dataType: 'json',
      success:function(data){

        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        

      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        

      }

    });
  });
};

function deleteDataFasilitas(id){

  swal({

    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false

  },

  function(){

    $.ajax({

      url : "<?= base_url('admin/dataListFasilitasDelete')?>",
      method:"post",
      data:{id:id},
      dataType: 'json',
      success:function(data){

        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        

      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        

      }

    });
  });
};



function deleteDataGuru(id){

  swal({

    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false

  },

  function(){

    $.ajax({

      url : "<?= base_url('admin/dataMasterGuruDelete')?>",
      method:"post",
      data:{id:id},
      dataType: 'json',
      success:function(data){

        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        

      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        

      }

    });
  });
};

function deleteDataKelas(id){

  swal({

    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false

  },

  function(){

    $.ajax({

      url : "<?= base_url('admin/dataMasterKelasDelete')?>",
      method:"post",
      data:{id:id},
      dataType: 'json',
      success:function(data){

        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        

      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        

      }

    });
  });
};


function deleteDataSiswa(id){

  swal({

    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false

  },

  function(){

    $.ajax({

      url : "<?= base_url('admin/dataMasterSiswaDelete')?>",
      method:"post",
      data:{id:id},
      dataType: 'json',
      success:function(data){

        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        

      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        

      }

    });
  });
};

function deleteDataPengguna(id){

  swal({

    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false

  },

  function(){

    $.ajax({

      url : "<?= base_url('admin/pengaturanPenggunaDelete')?>",
      method:"post",
      data:{id:id},
      dataType: 'json',
      success:function(data){

        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        

      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: false,
          timer: 1500
        });
        setInterval('location.reload()', 2000);        

      }

    });
  });
};

/*-- DataTable Kategori --*/

$(document).on('click', '.btn_tambah_kategori', function() {
    $('#kategoriModal').modal('show');
    $('[name="labelform"]').text('TAMBAH DATA KATEGORI');
    $('#kategoriModal').on('shown.bs.modal', function() {
        $('[name="kategori"]').focus();
    });
    $('[name="id_kategori"]').val("");
    $('[name="kategori"]').val("");
});


$('#kategoriForm').on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: '<?= base_url('admin/saveKategori');?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response); // Log the response for debugging
            swal({
              icon: 'success',
              title: 'Success',
              text: 'Proses simpan data kategori sukses.',
              showConfirmButton: true,
              timer: 2500
            });
            $('.progress').hide();
            $('.card-uploadkategori').hide();
            tampil_kategori();
            $('#kategoriModal').modal('hide');
        },
        error: function(response) {
            console.log(response); // Log the response for debugging
            $('#kategoriModal').modal('hide');
            swal({
              title: "Error!",
              text: 'Proses simpan data kategori gagal.',
              type: "error",
              showConfirmButton: true,
              timer: 2500
            });
        }
    });
});

$(document).on('click','.kategori_edit',function(){
    var id_kategori=$(this).attr('rel');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/get_kategori')?>",
        dataType : "JSON",
        data : {id_kategori:id_kategori},
        success: function(data){
              $.each(data,function(id_kategori, kategori){
              $('[name="id_kategori"]').val(data.id_kategori);    
              $('[name="kategori"]').val(data.kategori);
              $('#kategoriModal').modal('show');
              $('[name="labelform"]').text('EDIT DATA KATEGORI');
              $('#kategoriModal').on('shown.bs.modal', function(){
                $('[name="kategori"]').focus();
              });
        });}
    });
    return false;
});

function deletekategori(id_kategori){
  swal({
    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false
  },

  function(){
    $.ajax({
      url : "<?= base_url('admin/kategori_delete')?>",
      method:"post",
      data:{id_kategori:id_kategori},
      dataType: 'json',
      success:function(data){
        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: true,
          timer: 2500
        });
        tampil_kategori();
      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: true,
          timer: 2500
        });
        tampil_kategori();        
      }

    });
  });
};


$(document).ready(function () {
    $('#uploadkategori-form').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.progress').show();
                        $('.progress-bar').width(percentComplete + '%');
                        $('.progress-bar').html(percentComplete + '%');
                        if (percentComplete === 100) {
                            $('.progress-bar').html('Complete');
                        }
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?php echo base_url('excel/import_kategori'); ?>',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                var result = JSON.parse(response);
                if (result.success) {
                    swal({
                      icon: 'success',
                      title: 'Success',
                      text: result.success,
                      
                      showConfirmButton: false,
                      timer: 2500
                    });
                    $('.progress').hide();
                    $('.card-uploadkategori').hide();
                    tampil_kategori();
                } else {
                  swal({
                      title: "Error!",
                      text: result.error,
                      type: "error",
                      showConfirmButton: false,
                      timer: 2500
                    });
                  $('.progress').hide();
                }
            },
            error: function (xhr, status, error) {
                toastr.error('File upload failed. Status: ' + status + ', Error: ' + error);
            }
        });
    });
});

tampil_kategori();
function tampil_kategori() {      
    if ($.fn.dataTable.isDataTable('#kategoriData')) {
        $('#kategoriData').DataTable().destroy();
    }

    kategoriData = $('#kategoriData').DataTable({
        "sDom": 'lrtip',
        "lengthChange": false,
        "processing": true, 
        "serverSide": true, 
        "order": [],
        "ajax": {
            "url": baseUrl + 'ajax/kategoriData/',
            "type": "POST"
        },
        "responsive": true,
        "paging": true,
        "language": {
            "paginate": {
                "previous": "<i class='fas fa-arrow-left'>",
                "next": "<i class='fas fa-arrow-right'></i>"
            },
            "emptyTable": "",
            "info": "", 
            "infoEmpty": "", 
            "infoFiltered": "", 
            "lengthMenu": "", 
            "zeroRecords": "", 
        },
        "columns": [
            {"className": "f1-column"},
            {"className": "f2-column"},
            {"className": "f3-column"},
        ],
  
        "drawCallback": function(settings) {
         var api = this.api();
          var pageInfo = api.page.info();
          var recordsTotal = settings.fnRecordsTotal(); // Jumlah total entri

          var $pagination = $(api.table().container()).find('div.dataTables_paginate');
          if (pageInfo.pages > 1) { // Jika jumlah halaman lebih dari satu
              $pagination.show();
          } else {
              $pagination.hide();
          } 
        },
    });
}

$(document).on('click', '.searchButtonkategori', function() {
    if ($.fn.dataTable.isDataTable('#kategoriData')) {
        kategoriData.search($('#searchkategori').val()).draw();
    } else {
        tampil_kategori(function() {
              kategoriData.search($('#searchkategori').val()).draw();
        });
    }
});

$(document).on('keyup', '#searchkategori', function() {
    var searchValue = $(this).val().trim(); 
    if ($.fn.dataTable.isDataTable('#kategoriData')) {
        if (searchValue == '') {
          kategoriData.search(searchValue).draw();
        } 
    } else {
        tampil_kategori(function() {
            kategoriData.search($('#searchkategori').val()).draw();
        });
    }
});


$(document).on('keypress', '#searchkategori', function(event) {
  if (event.which === 13) {
      var searchValue = $(this).val().trim(); 
      if ($.fn.dataTable.isDataTable('#kategoriData')) {
          kategoriData.search(searchValue).draw();
      } else {
          tampil_kategori(function() {
              kategoriData.search($('#searchkategori').val()).draw();
          });
      }
  }
});

tampil_carikategori();
function tampil_carikategori() {      
    if ($.fn.dataTable.isDataTable('#carikategoriData')) {
        $('#carikategoriData').DataTable().destroy();
    }

    carikategoriData = $('#carikategoriData').DataTable({
        "sDom": 'lrtip',
        "lengthChange": false,
        "processing": true, 
        "serverSide": true, 
        "order": [],
        "ajax": {
            "url": baseUrl + 'ajax/carikategoriData/',
            "type": "POST"
        },
        "responsive": true,
        "paging": true,
        "language": {
            "paginate": {
                "previous": "<i class='fas fa-arrow-left'>",
                "next": "<i class='fas fa-arrow-right'></i>"
            },
            "emptyTable": "",
            "info": "", 
            "infoEmpty": "", 
            "infoFiltered": "", 
            "lengthMenu": "", 
            "zeroRecords": "", 
        },
        "columns": [
            {"className": "k1-column"},
            {"className": "k2-column"},
        ],
  
        "drawCallback": function(settings) {
         var api = this.api();
          var pageInfo = api.page.info();
          var recordsTotal = settings.fnRecordsTotal(); // Jumlah total entri

          var $pagination = $(api.table().container()).find('div.dataTables_paginate');
          if (pageInfo.pages > 1) { // Jika jumlah halaman lebih dari satu
              $pagination.show();
          } else {
              $pagination.hide();
          } 
        },
    });
}

$(document).on('click', '.searchButtoncarikategori', function() {
    if ($.fn.dataTable.isDataTable('#carikategoriData')) {
        carikategoriData.search($('#searchcarikategori').val()).draw();
    } else {
        tampil_carikategori(function() {
              carikategoriData.search($('#searchcarikategori').val()).draw();
        });
    }
});

$(document).on('keyup', '#searchcarikategori', function() {
    var searchValue = $(this).val().trim(); 
    if ($.fn.dataTable.isDataTable('#carikategoriData')) {
        if (searchValue == '') {
          carikategoriData.search(searchValue).draw();
        } 
    } else {
        tampil_carikategori(function() {
            carikategoriData.search($('#searchcarikategori').val()).draw();
        });
    }
});


$(document).on('keypress', '#searchcarikategori', function(event) {
  if (event.which === 13) {
      var searchValue = $(this).val().trim(); 
      if ($.fn.dataTable.isDataTable('#carikategoriData')) {
          carikategoriData.search(searchValue).draw();
      } else {
          tampil_carikategori(function() {
              carikategoriData.search($('#searchcarikategori').val()).draw();
          });
      }
  }
});

/*-- DataTable barang --*/
$(document).on('click', '.btn_tambah_barang', function() {
    $('#barangModal').modal('show');
    $('[name="labelform"]').text('TAMBAH DATA BARANG');
    $('#barangModal').on('shown.bs.modal', function() {
        $('[name="kode_brg"]').focus();
    });
    $('[name="kode_brg_a"]').val("");
    $('[name="kode_brg"]').val("");
    $('[name="nama_brg"]').val("");
});


$('#barangForm').on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: '<?= base_url('admin/savebarang');?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json', // Tambahkan ini untuk memastikan respon diperlakukan sebagai JSON
        success: function(response) {
            if (response.status === 'success') {
                swal({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    showConfirmButton: true,
                    timer: 2500
                });
                $('.progress').hide();
                $('.card-uploadbarang').hide();
                tampil_barang();
                $('#barangModal').modal('hide');
            } else {
                // Tampilkan pesan error
                swal({
                    icon: 'error', // Ganti type menjadi icon dan pastikan nilainya 'error'
                    title: 'Error!',
                    text: response.message,
                    showConfirmButton: true,
                    timer: 2500
                });
            }
        },
        error: function(response) {
            console.log(response); // Log the response for debugging
            $('#barangModal').modal('hide');
            swal({
                icon: 'error', // Ganti type menjadi icon dan pastikan nilainya 'error'
                title: 'Error!',
                text: 'Proses simpan data barang gagal.',
                showConfirmButton: true,
                timer: 2500
            });
        }
    });
});


$(document).on('click','.barang_edit',function(){
    var kode_brg=$(this).attr('rel');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/get_barang')?>",
        dataType : "JSON",
        data : {kode_brg:kode_brg},
        success: function(data){
              $.each(data,function(kode_brg, nama_brg){
              $('[name="kode_brg_a"]').val(data.kode_brg);    
              $('[name="kode_brg"]').val(data.kode_brg);    
              $('[name="nama_brg"]').val(data.nama_brg);
              $('#barangModal').modal('show');
              $('[name="labelform"]').text('EDIT DATA BARANG');
              $('#barangModal').on('shown.bs.modal', function(){
                $('[name="kode_brg"]').focus();
              });
        });}
    });
    return false;
});

$(document).ready(function() {
  var textarea = document.getElementById('nama_brg');

  if (textarea) {  // Pastikan elemen ada
      textarea.addEventListener("keydown", function(event) {
          if (event.key === "Enter") {
              // Mencegah aksi default (pindah baris)
              event.preventDefault();
          }
      });
  }
});


function deletebarang(kode_brg){
  swal({
    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false
  },

  function(){
    $.ajax({
      url : "<?= base_url('admin/barang_delete')?>",
      method:"post",
      data:{kode_brg:kode_brg},
      dataType: 'json',
      success:function(data){
        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: true,
          timer: 2500
        });
        tampil_barang();
      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: true,
          timer: 2500
        });
        tampil_barang();        
      }

    });
  });
};


$(document).ready(function () {
    $('#uploadbarang-form').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.progress').show();
                        $('.progress-bar').width(percentComplete + '%');
                        $('.progress-bar').html(percentComplete + '%');
                        if (percentComplete === 100) {
                            $('.progress-bar').html('Complete');
                        }
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?php echo base_url('excel/import_barang'); ?>',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                var result = JSON.parse(response);
                if (result.success) {
                    swal({
                      icon: 'success',
                      title: 'Success',
                      text: result.success,
                      
                      showConfirmButton: false,
                      timer: 2500
                    });
                    $('.progress').hide();
                    $('.card-uploadbarang').hide();
                    tampil_barang();
                } else {
                  swal({
                      title: "Error!",
                      text: result.error,
                      type: "error",
                      showConfirmButton: false,
                      timer: 2500
                    });
                  $('.progress').hide();
                }
            },
            error: function(response) {
            swal({
                icon: 'error', // Ganti type menjadi icon dan pastikan nilainya 'error'
                title: 'Error!',
                text: 'Gagal Import.',
                showConfirmButton: true,
                timer: 2500
            });
        }
        });
    });
});

tampil_barang();
function tampil_barang() {      
    if ($.fn.dataTable.isDataTable('#barangData')) {
        $('#barangData').DataTable().destroy();
    }

    barangData = $('#barangData').DataTable({
        "sDom": 'lrtip',
        "lengthChange": false,
        "processing": true, 
        "serverSide": true, 
        "order": [],
        "ajax": {
            "url": baseUrl + 'ajax/barangData/',
            "type": "POST"
        },
        "responsive": true,
        "paging": true,
        "language": {
            "paginate": {
                "previous": "<i class='fas fa-arrow-left'>",
                "next": "<i class='fas fa-arrow-right'></i>"
            },
            "emptyTable": "",
            "info": "", 
            "infoEmpty": "", 
            "infoFiltered": "", 
            "lengthMenu": "", 
            "zeroRecords": "", 
        },
        "columns": [
            {"className": "f1-column"},
            {"className": "f2-column"},
            {"className": "f3-column"},
            {"className": "f4-column"},
        ],
  
        "drawCallback": function(settings) {
         var api = this.api();
          var pageInfo = api.page.info();
          var recordsTotal = settings.fnRecordsTotal(); // Jumlah total entri

          var $pagination = $(api.table().container()).find('div.dataTables_paginate');
          if (pageInfo.pages > 1) { // Jika jumlah halaman lebih dari satu
              $pagination.show();
          } else {
              $pagination.hide();
          } 
        },
    });
}

$(document).on('click', '.searchButtonbarang', function() {
    if ($.fn.dataTable.isDataTable('#barangData')) {
        barangData.search($('#searchbarang').val()).draw();
    } else {
        tampil_barang(function() {
              barangData.search($('#searchbarang').val()).draw();
        });
    }
});

$(document).on('keyup', '#searchbarang', function() {
    var searchValue = $(this).val().trim(); 
    if ($.fn.dataTable.isDataTable('#barangData')) {
        if (searchValue == '') {
          barangData.search(searchValue).draw();
        } 
    } else {
        tampil_barang(function() {
            barangData.search($('#searchbarang').val()).draw();
        });
    }
});


$(document).on('keypress', '#searchbarang', function(event) {
  if (event.which === 13) {
      var searchValue = $(this).val().trim(); 
      if ($.fn.dataTable.isDataTable('#barangData')) {
          barangData.search(searchValue).draw();
      } else {
          tampil_barang(function() {
              barangData.search($('#searchbarang').val()).draw();
          });
      }
  }
});

/*-- DataTable kelompokbarang --*/
tampil_kelompokbarang();
function tampil_kelompokbarang() {      
    if ($.fn.dataTable.isDataTable('#kelompokbarangData')) {
        $('#kelompokbarangData').DataTable().destroy();
    }

    kelompokbarangData = $('#kelompokbarangData').DataTable({
        "sDom": 'lrtip',
        "lengthChange": false,
        "processing": true, 
        "serverSide": true, 
        "order": [],
        "ajax": {
            "url": baseUrl + 'ajax/kelompokbarangData/',
            "type": "POST"
        },
        "responsive": true,
        "paging": true,
        "language": {
            "paginate": {
                "previous": "<i class='fas fa-arrow-left'>",
                "next": "<i class='fas fa-arrow-right'></i>"
            },
            "emptyTable": "",
            "info": "", 
            "infoEmpty": "", 
            "infoFiltered": "", 
            "lengthMenu": "", 
            "zeroRecords": "", 
        },
        "columns": [
            {"className": "f1-column"},
            {"className": "f2-column"},
            {"className": "f3-column"},
            {"className": "f4-column"},
            {"className": "f5-column"},
            {"className": "f6-column"},
        ],
  
        "drawCallback": function(settings) {
         var api = this.api();
          var pageInfo = api.page.info();
          var recordsTotal = settings.fnRecordsTotal(); // Jumlah total entri

          var $pagination = $(api.table().container()).find('div.dataTables_paginate');
          if (pageInfo.pages > 1) { // Jika jumlah halaman lebih dari satu
              $pagination.show();
          } else {
              $pagination.hide();
          } 
        },
    });
}

$(document).on('click', '.searchButtonkelompokbarang', function() {
    if ($.fn.dataTable.isDataTable('#kelompokbarangData')) {
        kelompokbarangData.search($('#searchkelompokbarang').val()).draw();
    } else {
        tampil_kelompokbarang(function() {
              kelompokbarangData.search($('#searchkelompokbarang').val()).draw();
        });
    }
});

$(document).on('keyup', '#searchkelompokbarang', function() {
    var searchValue = $(this).val().trim(); 
    if ($.fn.dataTable.isDataTable('#kelompokbarangData')) {
        if (searchValue == '') {
          kelompokbarangData.search(searchValue).draw();
        } 
    } else {
        tampil_kelompokbarang(function() {
            kelompokbarangData.search($('#searchkelompokbarang').val()).draw();
        });
    }
});


$(document).on('keypress', '#searchkelompokbarang', function(event) {
  if (event.which === 13) {
      var searchValue = $(this).val().trim(); 
      if ($.fn.dataTable.isDataTable('#kelompokbarangData')) {
          kelompokbarangData.search(searchValue).draw();
      } else {
          tampil_kelompokbarang(function() {
              kelompokbarangData.search($('#searchkelompokbarang').val()).draw();
          });
      }
  }
});


$(document).on('click', '.rekening_edit', function() {
  var no = $(this).data('number');
  var kode_brg=$(this).attr('rel');
  tampil_carirekening();
  $('#carirekeningModal').modal('show');
  $('[name="baris"]').val(no);
  $('[name="kode_brg"]').val(kode_brg);

});

$(document).on('click', '.kategori_edit', function() {
  var no = $(this).data('number');
  var kode_brg=$(this).attr('rel');
  tampil_carikategori();
  $('#carikategoriModal').modal('show');
  $('[name="baris"]').val(no);
  $('[name="kode_brg"]').val(kode_brg);

});

/*-- DataTable rekening --*/
$(document).on('click', '.btn_tambah_rekening', function() {
    $('#rekeningModal').modal('show');
    $('[name="labelform"]').text('TAMBAH DATA REKENING');
    $('#rekeningModal').on('shown.bs.modal', function() {
        $('[name="kode_rek"]').focus();
    });
    $('[name="kode_rek_a"]').val("");
    $('[name="kode_rek"]').val("");
    $('[name="nama_rek"]').val("");
});


$('#rekeningForm').on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: '<?= base_url('admin/saverekening');?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json', // Tambahkan ini untuk memastikan respon diperlakukan sebagai JSON
        success: function(response) {
            if (response.status === 'success') {
                swal({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    showConfirmButton: true,
                    timer: 2500
                });
                $('.progress').hide();
                $('.card-uploadrekening').hide();
                tampil_rekening();
                $('#rekeningModal').modal('hide');
            } else {
                // Tampilkan pesan error
                swal({
                    icon: 'error', // Ganti type menjadi icon dan pastikan nilainya 'error'
                    title: 'Error!',
                    text: response.message,
                    showConfirmButton: true,
                    timer: 2500
                });
            }
        },
        error: function(response) {
            console.log(response); // Log the response for debugging
            $('#rekeningModal').modal('hide');
            swal({
                icon: 'error', // Ganti type menjadi icon dan pastikan nilainya 'error'
                title: 'Error!',
                text: 'Proses simpan data rekening gagal.',
                showConfirmButton: true,
                timer: 2500
            });
        }
    });
});


$(document).on('click','.rekening_edit',function(){
    var kode_rek=$(this).attr('rel');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/get_rekening')?>",
        dataType : "JSON",
        data : {kode_rek:kode_rek},
        success: function(data){
              $.each(data,function(kode_rek, nama_rek){
              $('[name="kode_rek_a"]').val(data.kode_rek);    
              $('[name="kode_rek"]').val(data.kode_rek);    
              $('[name="nama_rek"]').val(data.nama_rek);
              $('#rekeningModal').modal('show');
              $('[name="labelform"]').text('EDIT DATA REKENING');
              $('#rekeningModal').on('shown.bs.modal', function(){
                $('[name="kode_rek"]').focus();
              });
        });}
    });
    return false;
});

$(document).ready(function() {
  var textarea = document.getElementById('nama_rek');

  if (textarea) {  // Pastikan elemen ada
      textarea.addEventListener("keydown", function(event) {
          if (event.key === "Enter") {
              // Mencegah aksi default (pindah baris)
              event.preventDefault();
          }
      });
  }
});


function deleterekening(kode_rek){
  swal({
    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false
  },

  function(){
    $.ajax({
      url : "<?= base_url('admin/rekening_delete')?>",
      method:"post",
      data:{kode_rek:kode_rek},
      dataType: 'json',
      success:function(data){
        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: true,
          timer: 2500
        });
        tampil_rekening();
      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: true,
          timer: 2500
        });
        tampil_rekening();        
      }

    });
  });
};


function deletecarirekening(kode_brg,baris){
  swal({
    title: "Apakah Anda Yakin Ingin Menghapus Rekening ini?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false
  },

  function(){
    $.ajax({
      url : "<?= base_url('admin/saveupdaterekeningc')?>",
      method:"post",
      data:{kode_brg:kode_brg},
      dataType: 'json',
      success:function(data){
          var table = $('#kelompokbarangData').DataTable();
          if ($.fn.dataTable.isDataTable('#kelompokbarangData')) {
              var barisa = parseInt(baris, 10) - 1; // Konversi baris menjadi integer dan kurangi 1
              var kolomIndex = 3; // Pastikan ini adalah indeks kolom yang benar

              // Periksa apakah DataTable diinisialisasi
              if ($.fn.dataTable.isDataTable('#kelompokbarangData')) {
                  var table = $('#kelompokbarangData').DataTable();

                  // Ubah data dalam sel
                  table.cell(barisa, kolomIndex).data('').draw(false); // Gantilah nama_rek dengan data yang ingin Anda masukkan

                  console.log('Data Setelah Pembaruan:', table.cell(barisa, kolomIndex).data());
              } else {
                  console.error('DataTable belum diinisialisasi!');
              }
              swal({
                icon: 'success',
                title: 'Success',
                text: 'Rekening Berhasil Di Hapus.',
                showConfirmButton: true,
                timer: 2500
              });
          } else {
              console.error('DataTable belum diinisialisasi!');
          }
      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: true,
          timer: 2500
        });
              
      }

    });
  });
};


function deletecarikategori(kode_brg,baris){
  swal({
    title: "Apakah Anda Yakin Ingin Menghapus kategori ini?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false
  },

  function(){
    $.ajax({
      url : "<?= base_url('admin/saveupdatekategoric')?>",
      method:"post",
      data:{kode_brg:kode_brg},
      dataType: 'json',
      success:function(data){
          var table = $('#kelompokbarangData').DataTable();
          if ($.fn.dataTable.isDataTable('#kelompokbarangData')) {
              var barisa = parseInt(baris, 10) - 1; // Konversi baris menjadi integer dan kurangi 1
              var kolomIndex = 4; // Pastikan ini adalah indeks kolom yang benar

              // Periksa apakah DataTable diinisialisasi
              if ($.fn.dataTable.isDataTable('#kelompokbarangData')) {
                  var table = $('#kelompokbarangData').DataTable();

                  // Ubah data dalam sel
                  table.cell(barisa, kolomIndex).data('').draw(false); // Gantilah nama_rek dengan data yang ingin Anda masukkan

                  console.log('Data Setelah Pembaruan:', table.cell(barisa, kolomIndex).data());
              } else {
                  console.error('DataTable belum diinisialisasi!');
              }
              swal({
                icon: 'success',
                title: 'Success',
                text: 'kategori Berhasil Di Hapus.',
                showConfirmButton: true,
                timer: 2500
              });
          } else {
              console.error('DataTable belum diinisialisasi!');
          }
      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: true,
          timer: 2500
        });
              
      }

    });
  });
};


$(document).ready(function () {
    $('#uploadrekening-form').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.progress').show();
                        $('.progress-bar').width(percentComplete + '%');
                        $('.progress-bar').html(percentComplete + '%');
                        if (percentComplete === 100) {
                            $('.progress-bar').html('Complete');
                        }
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?php echo base_url('excel/import_rekening'); ?>',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                var result = JSON.parse(response);
                if (result.success) {
                    swal({
                      icon: 'success',
                      title: 'Success',
                      text: result.success,
                      
                      showConfirmButton: false,
                      timer: 2500
                    });
                    $('.progress').hide();
                    $('.card-uploadrekening').hide();
                    tampil_rekening();
                } else {
                  swal({
                      title: "Error!",
                      text: result.error,
                      type: "error",
                      showConfirmButton: false,
                      timer: 2500
                    });
                  $('.progress').hide();
                }
            },
            error: function(response) {
            swal({
                icon: 'error', // Ganti type menjadi icon dan pastikan nilainya 'error'
                title: 'Error!',
                text: 'Gagal Import.',
                showConfirmButton: true,
                timer: 2500
            });
        }
        });
    });
});

tampil_rekening();
function tampil_rekening() {      
    if ($.fn.dataTable.isDataTable('#rekeningData')) {
        $('#rekeningData').DataTable().destroy();
    }

    rekeningData = $('#rekeningData').DataTable({
        "sDom": 'lrtip',
        "lengthChange": false,
        "processing": true, 
        "serverSide": true, 
        "order": [],
        "ajax": {
            "url": baseUrl + 'ajax/rekeningData/',
            "type": "POST"
        },
        "responsive": true,
        "paging": true,
        "language": {
            "paginate": {
                "previous": "<i class='fas fa-arrow-left'>",
                "next": "<i class='fas fa-arrow-right'></i>"
            },
            "emptyTable": "",
            "info": "", 
            "infoEmpty": "", 
            "infoFiltered": "", 
            "lengthMenu": "", 
            "zeroRecords": "", 
        },
        "columns": [
            {"className": "f1-column"},
            {"className": "f2-column"},
            {"className": "f3-column"},
            {"className": "f4-column"},
        ],
  
        "drawCallback": function(settings) {
         var api = this.api();
          var pageInfo = api.page.info();
          var recordsTotal = settings.fnRecordsTotal(); // Jumlah total entri

          var $pagination = $(api.table().container()).find('div.dataTables_paginate');
          if (pageInfo.pages > 1) { // Jika jumlah halaman lebih dari satu
              $pagination.show();
          } else {
              $pagination.hide();
          } 
        },
    });
}

$(document).on('click', '.searchButtonrekening', function() {
    if ($.fn.dataTable.isDataTable('#rekeningData')) {
        rekeningData.search($('#searchrekening').val()).draw();
    } else {
        tampil_rekening(function() {
              rekeningData.search($('#searchrekening').val()).draw();
        });
    }
});

$(document).on('keyup', '#searchrekening', function() {
    var searchValue = $(this).val().trim(); 
    if ($.fn.dataTable.isDataTable('#rekeningData')) {
        if (searchValue == '') {
          rekeningData.search(searchValue).draw();
        } 
    } else {
        tampil_rekening(function() {
            rekeningData.search($('#searchrekening').val()).draw();
        });
    }
});


$(document).on('keypress', '#searchrekening', function(event) {
  if (event.which === 13) {
      var searchValue = $(this).val().trim(); 
      if ($.fn.dataTable.isDataTable('#rekeningData')) {
          rekeningData.search(searchValue).draw();
      } else {
          tampil_rekening(function() {
              rekeningData.search($('#searchrekening').val()).draw();
          });
      }
  }
});

$(document).on('click', '.pilih_rek', function() {
    var baris = parseInt($('#baris').val(), 10) - 1;
    var kode_brg = $('#kode_brg').val();
    var kode_rek=$(this).attr('rel');
    var nama_rek=$(this).attr('relb');
    console.log('Baris:', baris, 'Nama Rek:', nama_rek);
    var table = $('#kelompokbarangData').DataTable();

    // Gabungkan nilai-nilai menjadi objek
    var formData = {
        baris: baris,
        kode_brg: kode_brg,
        kode_rek: kode_rek,
    };

    // Kirimkan objek ini ke server menggunakan AJAX
    $.ajax({
        url: '<?= base_url('admin/saveupdatebarang');?>',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
              // Pastikan DataTable sudah diinisialisasi
              if ($.fn.dataTable.isDataTable('#kelompokbarangData')) {
                  var kolomIndex = 3; // Sesuaikan dengan indeks kolom yang ada

                  // Verifikasi jika indeks kolom valid
                  if (kolomIndex < table.columns().count()) {
                      if (!isNaN(baris) && baris >= 0 && baris < table.rows().count()) {
                          table.cell(baris, kolomIndex).data(nama_rek).draw(false);
                          console.log('Data Setelah Pembaruan:', table.cell(baris, kolomIndex).data());
                      } else {
                          console.error('Indeks baris tidak valid:', baris);
                      }
                  } else {
                      console.error('Indeks kolom tidak valid:', kolomIndex);
                  }
                  $('#carirekeningModal').modal('hide');
                  swal({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    showConfirmButton: true,
                    timer: 2500
                  });
              } else {
                  console.error('DataTable belum diinisialisasi!');
              }
            } else {
                $('#carirekeningModal').modal('hide');
                swal({
                  title: "Error!",
                  text: 'Gagal Memilih Rekening.',
                  type: "error",
                  showConfirmButton: true,
                  timer: 2500
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Terjadi kesalahan:', error);
        }
    });
});


$(document).on('click', '.pilih_kategori', function() {
    var baris = parseInt($('#baris').val(), 10) - 1;
    var kode_brg = $('#kode_brg').val();
    var id_kategori=$(this).attr('rel');
    var kategori=$(this).attr('relb');
    
    var table = $('#kelompokbarangData').DataTable();

    // Gabungkan nilai-nilai menjadi objek
    var formData = {
        baris: baris,
        kode_brg: kode_brg,
        id_kategori: id_kategori,
    };

    // Kirimkan objek ini ke server menggunakan AJAX
    $.ajax({
        url: '<?= base_url('admin/saveupdatebarangb');?>',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
              
              // Pastikan DataTable sudah diinisialisasi
              if ($.fn.dataTable.isDataTable('#kelompokbarangData')) {
                  var kolomIndex = 4; // Sesuaikan dengan indeks kolom yang ada

                  // Verifikasi jika indeks kolom valid
                  if (kolomIndex < table.columns().count()) {
                      if (!isNaN(baris) && baris >= 0 && baris < table.rows().count()) {
                          table.cell(baris, kolomIndex).data(kategori).draw(false);
                          console.log('Data Setelah Pembaruan:', table.cell(baris, kolomIndex).data());
                      } else {
                          console.error('Indeks baris tidak valid:', baris);
                      }
                  } else {
                      console.error('Indeks kolom tidak valid:', kolomIndex);
                  }
              } else {
                  console.error('DataTable belum diinisialisasi!');
              }
              $('#carikategoriModal').modal('hide');
              swal({
                icon: 'success',
                title: 'Success',
                text: response.message,
                showConfirmButton: true,
                timer: 2500
              });
            } else {
                $('#carikategoriModal').modal('hide');
                swal({
                  title: "Error!",
                  text: 'Gagal Memilih Kategori.',
                  type: "error",
                  showConfirmButton: true,
                  timer: 2500
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Terjadi kesalahan:', error);
        }
    });
});

tampil_carirekening();
function tampil_carirekening() {      
    if ($.fn.dataTable.isDataTable('#carirekeningData')) {
        $('#carirekeningData').DataTable().destroy();
    }

    carirekeningData = $('#carirekeningData').DataTable({
        "sDom": 'lrtip',
        "lengthChange": false,
        "processing": true, 
        "serverSide": true, 
        "order": [],
        "ajax": {
            "url": baseUrl + 'ajax/carirekeningData/',
            "type": "POST"
        },
        "responsive": true,
        "paging": true,
        "language": {
            "paginate": {
                "previous": "<i class='fas fa-arrow-left'>",
                "next": "<i class='fas fa-arrow-right'></i>"
            },
            "emptyTable": "",
            "info": "", 
            "infoEmpty": "", 
            "infoFiltered": "", 
            "lengthMenu": "", 
            "zeroRecords": "", 
        },
        "columns": [
            {"className": "r1-column"},
            {"className": "r2-column"},
            {"className": "r3-column"},
        ],
  
        "drawCallback": function(settings) {
         var api = this.api();
          var pageInfo = api.page.info();
          var recordsTotal = settings.fnRecordsTotal(); // Jumlah total entri

          var $pagination = $(api.table().container()).find('div.dataTables_paginate');
          if (pageInfo.pages > 1) { // Jika jumlah halaman lebih dari satu
              $pagination.show();
          } else {
              $pagination.hide();
          } 
        },
    });
}

$(document).on('click', '.searchButtoncarirekening', function() {
    if ($.fn.dataTable.isDataTable('#carirekeningData')) {
        carirekeningData.search($('#searchcarirekening').val()).draw();
    } else {
        tampil_carirekening(function() {
              carirekeningData.search($('#searchcarirekening').val()).draw();
        });
    }
});

$(document).on('keyup', '#searchcarirekening', function() {
    var searchValue = $(this).val().trim(); 
    if ($.fn.dataTable.isDataTable('#carirekeningData')) {
        if (searchValue == '') {
          carirekeningData.search(searchValue).draw();
        } 
    } else {
        tampil_carirekening(function() {
            carirekeningData.search($('#searchcarirekening').val()).draw();
        });
    }
});


$(document).on('keypress', '#searchcarirekening', function(event) {
  if (event.which === 13) {
      var searchValue = $(this).val().trim(); 
      if ($.fn.dataTable.isDataTable('#carirekeningData')) {
          carirekeningData.search(searchValue).draw();
      } else {
          tampil_carirekening(function() {
              carirekeningData.search($('#searchcarirekening').val()).draw();
          });
      }
  }
});


/*-- DataTable satuan --*/

$(document).on('click', '.btn_tambah_satuan', function() {
    $('#satuanModal').modal('show');
    $('[name="labelform"]').text('TAMBAH DATA SATUAN');
    $('#satuanModal').on('shown.bs.modal', function() {
        $('[name="satuan"]').focus();
    });
    $('[name="id_satuan"]').val("");
    $('[name="satuan"]').val("");
});


$('#satuanForm').on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: '<?= base_url('admin/savesatuan');?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response); // Log the response for debugging
            swal({
              icon: 'success',
              title: 'Success',
              text: 'Proses simpan data satuan sukses.',
              showConfirmButton: true,
              timer: 2500
            });
            $('.progress').hide();
            $('.card-uploadsatuan').hide();
            tampil_satuan();
            $('#satuanModal').modal('hide');
        },
        error: function(response) {
            console.log(response); // Log the response for debugging
            $('#satuanModal').modal('hide');
            swal({
              title: "Error!",
              text: 'Proses simpan data satuan gagal.',
              type: "error",
              showConfirmButton: true,
              timer: 2500
            });
        }
    });
});

$(document).on('click','.satuan_edit',function(){
    var id_satuan=$(this).attr('rel');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/get_satuan')?>",
        dataType : "JSON",
        data : {id_satuan:id_satuan},
        success: function(data){
              $.each(data,function(id_satuan, satuan){
              $('[name="id_satuan"]').val(data.id_satuan);    
              $('[name="satuan"]').val(data.satuan);
              $('#satuanModal').modal('show');
              $('[name="labelform"]').text('EDIT DATA SATUAN');
              $('#satuanModal').on('shown.bs.modal', function(){
                $('[name="satuan"]').focus();
              });
        });}
    });
    return false;
});

function deletesatuan(id_satuan){
  swal({
    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false
  },

  function(){
    $.ajax({
      url : "<?= base_url('admin/satuan_delete')?>",
      method:"post",
      data:{id_satuan:id_satuan},
      dataType: 'json',
      success:function(data){
        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: true,
          timer: 2500
        });
        tampil_satuan();
      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: true,
          timer: 2500
        });
        tampil_satuan();        
      }

    });
  });
};


$(document).ready(function () {
    $('#uploadsatuan-form').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.progress').show();
                        $('.progress-bar').width(percentComplete + '%');
                        $('.progress-bar').html(percentComplete + '%');
                        if (percentComplete === 100) {
                            $('.progress-bar').html('Complete');
                        }
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?php echo base_url('excel/import_satuan'); ?>',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                var result = JSON.parse(response);
                if (result.success) {
                    swal({
                      icon: 'success',
                      title: 'Success',
                      text: result.success,
                      
                      showConfirmButton: false,
                      timer: 2500
                    });
                    $('.progress').hide();
                    $('.card-uploadsatuan').hide();
                    tampil_satuan();
                } else {
                  swal({
                      title: "Error!",
                      text: result.error,
                      type: "error",
                      showConfirmButton: false,
                      timer: 2500
                    });
                  $('.progress').hide();
                }
            },
            error: function (xhr, status, error) {
                toastr.error('File upload failed. Status: ' + status + ', Error: ' + error);
            }
        });
    });
});

tampil_satuan();
function tampil_satuan() {      
    if ($.fn.dataTable.isDataTable('#satuanData')) {
        $('#satuanData').DataTable().destroy();
    }

    satuanData = $('#satuanData').DataTable({
        "sDom": 'lrtip',
        "lengthChange": false,
        "processing": true, 
        "serverSide": true, 
        "order": [],
        "ajax": {
            "url": baseUrl + 'ajax/satuanData/',
            "type": "POST"
        },
        "responsive": true,
        "paging": true,
        "language": {
            "paginate": {
                "previous": "<i class='fas fa-arrow-left'>",
                "next": "<i class='fas fa-arrow-right'></i>"
            },
            "emptyTable": "",
            "info": "", 
            "infoEmpty": "", 
            "infoFiltered": "", 
            "lengthMenu": "", 
            "zeroRecords": "", 
        },
        "columns": [
            {"className": "f1-column"},
            {"className": "f2-column"},
            {"className": "f3-column"},
        ],
  
        "drawCallback": function(settings) {
         var api = this.api();
          var pageInfo = api.page.info();
          var recordsTotal = settings.fnRecordsTotal(); // Jumlah total entri

          var $pagination = $(api.table().container()).find('div.dataTables_paginate');
          if (pageInfo.pages > 1) { // Jika jumlah halaman lebih dari satu
              $pagination.show();
          } else {
              $pagination.hide();
          } 
        },
    });
}

$(document).on('click', '.searchButtonsatuan', function() {
    if ($.fn.dataTable.isDataTable('#satuanData')) {
        satuanData.search($('#searchsatuan').val()).draw();
    } else {
        tampil_satuan(function() {
              satuanData.search($('#searchsatuan').val()).draw();
        });
    }
});

$(document).on('keyup', '#searchsatuan', function() {
    var searchValue = $(this).val().trim(); 
    if ($.fn.dataTable.isDataTable('#satuanData')) {
        if (searchValue == '') {
          satuanData.search(searchValue).draw();
        } 
    } else {
        tampil_satuan(function() {
            satuanData.search($('#searchsatuan').val()).draw();
        });
    }
});


$(document).on('keypress', '#searchsatuan', function(event) {
  if (event.which === 13) {
      var searchValue = $(this).val().trim(); 
      if ($.fn.dataTable.isDataTable('#satuanData')) {
          satuanData.search(searchValue).draw();
      } else {
          tampil_satuan(function() {
              satuanData.search($('#searchsatuan').val()).draw();
          });
      }
  }
});

/*-- DataTable user --*/

$(document).on('click', '.btn_tambah_user', function() {
    $('#userModal').modal('show');
    $('[name="labelform"]').text('TAMBAH DATA USER');
    $('#userModal').on('shown.bs.modal', function() {
        $('[name="full_name"]').focus();
    });
    $('[name="id"]').val("");
    $('[name="full_name"]').val("");
    $('[name="email"]').val("");
    $('[name="username"]').val("");
    $('[name="password"]').val("User123");
    $('[name="password"]').prop('readonly', true);
    $('[name="instansi"]').val("");
});


$('#userForm').on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: '<?= base_url('admin/saveuser');?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json', // Tambahkan ini untuk memastikan respon diperlakukan sebagai JSON
        success: function(response) {
            if (response.status === 'success') {
                swal({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    showConfirmButton: true,
                    timer: 2500
                });
                $('.progress').hide();
                $('.card-uploaduser').hide();
                tampil_user();
                $('#userModal').modal('hide');
            } else {
                // Tampilkan pesan error
                swal({
                    icon: 'error', // Ganti type menjadi icon dan pastikan nilainya 'error'
                    title: 'Error!',
                    text: response.message,
                    showConfirmButton: true,
                    timer: 2500
                });
            }
        },
        error: function(response) {
            console.log(response); // Log the response for debugging
            $('#userModal').modal('hide');
            swal({
                icon: 'error', // Ganti type menjadi icon dan pastikan nilainya 'error'
                title: 'Error!',
                text: 'Proses simpan data user gagal.',
                showConfirmButton: true,
                timer: 2500
            });
        }
    });
});

$(document).on('click','.user_edit',function(){
    var id=$(this).attr('rel');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/get_user')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){
              $.each(data,function(id, full_name, email, username, password, level, status, instansi){
              $('[name="id"]').val(data.id);
              $('[name="full_name"]').val(data.full_name);
              $('[name="email"]').val(data.email);
              $('[name="username_a"]').val(data.username);
              $('[name="username"]').val(data.username);
              $('[name="password"]').val("");
              $('[name="password"]').prop('readonly', false);
              $('[name="instansi"]').val(data.instansi);
              $('#userModal').modal('show');
              $('[name="labelform"]').text('EDIT DATA USER');
              $('#userModal').on('shown.bs.modal', function(){
                $('[name="full_name"]').focus();
              });
        });}
    });
    return false;
});

function deleteuser(id){
  swal({
    title: "Apakah Anda Yakin Ingin Menghapus?",
    text: "Anda tidak akan dapat memulihkan data ini!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false
  },

  function(){
    $.ajax({
      url : "<?= base_url('admin/user_delete')?>",
      method:"post",
      data:{id:id},
      dataType: 'json',
      success:function(data){
        swal({
          title: "Deleted!",
          text: "Data Berhasil Di Hapus.",
          type: "success",
          showConfirmButton: true,
          timer: 2500
        });
        tampil_user();
      },

      error:function(data){
        swal({
          title: "Canceled!",
          text: "Data Tidak Dapat Di Hapus.",
          type: "error",
          showConfirmButton: true,
          timer: 2500
        });
        tampil_user();        
      }

    });
  });
};

tampil_user();
function tampil_user() {      
    if ($.fn.dataTable.isDataTable('#userData')) {
        $('#userData').DataTable().destroy();
    }

    userData = $('#userData').DataTable({
        "sDom": 'lrtip',
        "lengthChange": false,
        "processing": true, 
        "serverSide": true, 
        "order": [],
        "ajax": {
            "url": baseUrl + 'ajax/userData/',
            "type": "POST"
        },
        "responsive": true,
        "paging": true,
        "language": {
            "paginate": {
                "previous": "<i class='fas fa-arrow-left'>",
                "next": "<i class='fas fa-arrow-right'></i>"
            },
            "emptyTable": "",
            "info": "", 
            "infoEmpty": "", 
            "infoFiltered": "", 
            "lengthMenu": "", 
            "zeroRecords": "", 
        },
        "columns": [
            {"className": "f1-column"},
            {"className": "f2-column"},
            {"className": "f3-column"},
            {"className": "f4-column"},
            {"className": "f5-column"},
        ],
  
        "drawCallback": function(settings) {
         var api = this.api();
          var pageInfo = api.page.info();
          var recordsTotal = settings.fnRecordsTotal(); // Jumlah total entri

          var $pagination = $(api.table().container()).find('div.dataTables_paginate');
          if (pageInfo.pages > 1) { // Jika jumlah halaman lebih dari satu
              $pagination.show();
          } else {
              $pagination.hide();
          } 
        },
    });
}

$(document).on('click', '.searchButtonuser', function() {
    if ($.fn.dataTable.isDataTable('#userData')) {
        userData.search($('#searchuser').val()).draw();
    } else {
        tampil_user(function() {
              userData.search($('#searchuser').val()).draw();
        });
    }
});

$(document).on('keyup', '#searchuser', function() {
    var searchValue = $(this).val().trim(); 
    if ($.fn.dataTable.isDataTable('#userData')) {
        if (searchValue == '') {
          userData.search(searchValue).draw();
        } 
    } else {
        tampil_user(function() {
            userData.search($('#searchuser').val()).draw();
        });
    }
});


$(document).on('keypress', '#searchuser', function(event) {
  if (event.which === 13) {
      var searchValue = $(this).val().trim(); 
      if ($.fn.dataTable.isDataTable('#userData')) {
          userData.search(searchValue).draw();
      } else {
          tampil_user(function() {
              userData.search($('#searchuser').val()).draw();
          });
      }
  }
});

/*-- DataTable To Load Data Pelanggaran --*/
var pelanggaranData = $('#pelanggaranData').DataTable({

  "sDom": 'lrtip',
  "lengthChange": false,
  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseUrl+'ajax/pelanggaranData',
    "type": "POST"

  },

  "columnDefs": [{ 

    "targets": [ 0 ], 
    "orderable": false, 

  }],

  "responsive": true

});
$('#seachListPelanggaran').keyup(function(){
  pelanggaranData.search($(this).val()).draw() ;
})



/*-- DataTable To Load Data simpananpokok --*/
var simpananpokokData = $('#simpananpokokData').DataTable({
  "sDom": 'lrtip',
  "lengthChange": false,
  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseUrl+'ajax/simpananpokokData',
    "type": "POST"

  },
  "columnDefs": [{ 
    "targets": [ 0 ], 
    "orderable": false, 

  },{
    "targets": 4,
    "className": "text-right"
  }],
  "responsive": true,
    "columns": [
    {"width": "5%"}, 
    {"width": "50%"}, 
    {"width": "20%"}, 
    {"width": "20%"}, 
    {"width": "5%"}, 
  ]
});
$('#seachListSimpananpokok').keyup(function(){
  simpananpokokData.search($(this).val()).draw() ;
})


/*-- DataTable To Load Data simpanan wajib --*/
var simpananwajibData = $('#simpananwajibData').DataTable({
  "sDom": 'lrtip',
  "lengthChange": false,
  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseUrl+'ajax/simpananwajibData',
    "type": "POST"

  },
  "columnDefs": [{ 
    "targets": [ 0 ], 
    "orderable": false, 

  },{
    "targets": 4,
    "className": "text-right"
  }],
  "responsive": true,
    "columns": [
    {"width": "5%"}, 
    {"width": "50%"}, 
    {"width": "20%"}, 
    {"width": "20%"}, 
    {"width": "5%"}, 
  ]
});
$('#seachListSimpananwajib').keyup(function(){
  simpananwajibData.search($(this).val()).draw() ;
})


/*-- DataTable To Load Data pinjaman --*/
var pinjamanData = $('#pinjamanData').DataTable({
  "sDom": 'lrtip',
  "lengthChange": false,
  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseUrl+'ajax/pinjamanData',
    "type": "POST"

  },
  "columnDefs": [{ 
    "targets": [ 0 ], 
    "orderable": false, 

  },{
    "targets": 4,
    "className": "text-right"
  }],
  "responsive": true,
    "columns": [
    {"width": "5%"}, 
    {"width": "40%"}, 
    {"width": "20%"}, 
    {"width": "20%"}, 
    {"width": "5%"}, 
    {"width": "5%"}, 
    {"width": "5%"}, 
  ]
});
$('#seachListPinjaman').keyup(function(){
  pinjamanData.search($(this).val()).draw() ;
})

/*-- DataTable To Load Data Angsuran --*/
var angsuranData = $('#angsuranData').DataTable({
  "sDom": 'lrtip',
  "lengthChange": false,
  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseUrl+'ajax/angsuranData',
    "type": "POST"

  },
  "columnDefs": [{ 
    "targets": [ 0 ], 
    "orderable": false, 

  },{
    "targets": 4,
    "className": "text-right"
  }],
  "responsive": true,
  "columns": [
    {"width": "5%"}, 
    {"width": "30%"}, 
    {"width": "20%"}, 
    {"width": "10%"},  
    {"width": "10%"},  
    {"width": "20%"},  
    {"width": "5%"}, 
  ]
});
$('#seachListAngsuran').keyup(function(){
  angsuranData.search($(this).val()).draw() ;
})

/*-- DataTable To Load Data simpanan sukarela --*/
var simpanansukarelaData = $('#simpanansukarelaData').DataTable({
  "sDom": 'lrtip',
  "lengthChange": false,
  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseUrl+'ajax/simpanansukarelaData',
    "type": "POST"

  },
  "columnDefs": [{ 
    "targets": [ 0 ], 
    "orderable": false, 

  },{
    "targets": 4,
    "className": "text-right"
  }],
  "responsive": true,
    "columns": [
    {"width": "5%"}, 
    {"width": "50%"}, 
    {"width": "20%"}, 
    {"width": "20%"}, 
    {"width": "5%"}, 
  ]
});
$('#seachListSimpanansukarela').keyup(function(){
  simpanansukarelaData.search($(this).val()).draw() ;
})

/*-- DataTable To Load Data Anggota --*/
var anggotaData = $('#anggotaData').DataTable({

  "sDom": 'lrtip',
  "lengthChange": false,
  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseUrl+'ajax/anggotaData',
    "type": "POST"

  },
    "columnDefs": [{ 
    "targets": [ 0 ], 
    "orderable": false, 
  }],
  "responsive": true,
  "columns": [
    {},
    {},
    {},
    {},
    {},
    {"width": "5%"},] 
});
$('#seachListAnggota').keyup(function(){
  anggotaData.search($(this).val()).draw() ;
})

var fasilitasData = $('#fasilitasData').DataTable({

  "sDom": 'lrtip',
  "lengthChange": false,
  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseUrl+'ajax/fasilitasData',
    "type": "POST"

  },

  "columnDefs": [{ 

    "targets": [ 0 ], 
    "orderable": false, 

  },{
    "targets": 3,
    "className": "text-right"
  }],

  "responsive": true

});
$('#seachListfasilitas').keyup(function(){
  fasilitasData.search($(this).val()).draw() ;
})

/*-- DataTable To Load Data Pelanggaran --*/
var siswaData = $('#siswaData').DataTable({

  "sDom": 'lrtip',
  "lengthChange": false,
  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseUrl+'ajax/siswaData',
    "type": "POST"

  },

  "columnDefs": [{ 

    "targets": [ 0 ], 
    "orderable": false, 

  }],

  "responsive": true

});
$('#seachSiswa').keyup(function(){
  siswaData.search($(this).val()).draw() ;
})


/*-- DataTable To Load Data Pelanggaran --*/
var penggunaData = $('#penggunaData').DataTable({

  "sDom": 'lrtip',
  "lengthChange": false,
  "processing": true, 
  "serverSide": true, 
  "order": [],
  "ajax": {
    "url": baseUrl+'ajax/penggunaData',
    "type": "POST"

  },

  "columnDefs": [{ 

    "targets": [ 0 ], 
    "orderable": false, 

  }],

  "responsive": true

});
$('#seachPengguna').keyup(function(){
  penggunaData.search($(this).val()).draw() ;
})


    $(document).on('change', '.cari_ak', function () {
        var val = $('#id_pinjaman').val(); // Menggunakan jQuery untuk mendapatkan nilai select
        var ak = $('#id_pinjaman option:selected').attr('ak'); // Menggunakan jQuery untuk 
        var ja = $('#id_pinjaman option:selected').attr('ja'); // Menggunakan jQuery untuk 


        // Set nilai pada elemen dengan id "angsuran_ke"
        if (ak==''){
          $('#angsuran_ke').val('1');
        } else {
          $('#angsuran_ke').val(ak);
        }
        $('#jumlah_angsuran').val(ja);
    });

    function hit() {
      var jumlahPinjaman = parseFloat(document.getElementById('jumlah_pinjaman').value) || 0;
      var tenor = parseInt(document.getElementById('tenor').value) || 0;

      if (jumlahPinjaman === 0 || isNaN(jumlahPinjaman) || tenor === 0 || isNaN(tenor)) {
          document.getElementById('jumlah_angsuran').value = 0;
          return; // Keluar dari fungsi jika kondisi tidak terpenuhi
      }

      var bunga = parseFloat(document.getElementById('bunga').value) || 0;
      var totalBunga = (tenor * bunga * jumlahPinjaman) / 100;
      var totalPinjamanBunga = jumlahPinjaman + totalBunga;
      var angsuran_perbulan = totalPinjamanBunga / tenor;
      document.getElementById('jumlah_angsuran').value = angsuran_perbulan.toFixed(0);
  }




</script>