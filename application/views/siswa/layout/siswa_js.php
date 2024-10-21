<script type="text/javascript">

	/*-- Jquery Change Assess  --*/
	$('.custom-file-input').on('change', function(){
		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(fileName);

	});

	$(document).ready(function() {


		// var url = window.location;
		// const allLinks = document.querySelectorAll('.nav-item a');
		// const currentLink = [...allLinks].filter(e => {
		// 	return e.href == url;
		// });

		// currentLink[0].classList.add("active");
		// currentLink[0].closest(".nav-treeview").style.display = "block ";
		// currentLink[0].closest(".has-treeview").classList.add("menu-open");
		// $('.menu-open').find('a').each(function() {
		// 	if (!$(this).parents().hasClass('active')) {
		// 		$(this).parents().addClass("active");
		// 		$(this).addClass("active");
		// 	}
		// });
		
	});

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
</script>