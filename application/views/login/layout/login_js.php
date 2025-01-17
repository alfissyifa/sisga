<script type="text/javascript">
	
	var baseURL= "<?= base_url();?>";

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

	function togglePassword() {
	    const passwordField = document.getElementById('password');
	    const toggleIcon = document.getElementById('toggleIcon');
	    if (passwordField.type === 'password') {
	      passwordField.type = 'text';
	      toggleIcon.classList.remove('fa-eye');
	      toggleIcon.classList.add('fa-eye-slash');
	    } else {
	      passwordField.type = 'password';
	      toggleIcon.classList.remove('fa-eye-slash');
	      toggleIcon.classList.add('fa-eye');
	    }
	  }
	
</script>