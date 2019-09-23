/*DataTable Init*/

"use strict"; 

$(document).ready(function() {
	"use strict";
	
	$('#datable_1').DataTable();
    $('#datable_2').DataTable({
		"language": {
			"lengthMenu": "نمایش _MENU_ ردیف در هر صفحه",
			"zeroRecords": "متاسفانه هیچ اطلاعاتی یافت نشد :(",
			"info": "نمایش صفحه _PAGE_ از _PAGES_ صفحه",
			"infoEmpty": "هیچ اطلاعاتی موجود نیست",
			"infoFiltered": "(فیلتر شده از _MAX_ داده)",
			"search": "جستجو : ",
			"paginate": {
				"first": "اولین",
				"last": "آخرین",
				"next": "بعدی",
				"previous": "قبلی"
			},
		} 
	});
} );