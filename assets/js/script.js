$(document).ready(()=>{
	console.log("Script Loaded!");
	$("#table-body").on('click', '.edit-btn', function () {
		let id = $(this).closest('tr').children('td.id').text();
		let name = $(this).closest('tr').children('td.name').text();
		let email = $(this).closest('tr').children('td.email').text();

		$('input[name="id"]').val(id);
		$('input[name="name"]').val(name);
		$('input[name="email"]').val(email);

		$('input[name="save"]').hide();
		$('input[name="update"]').show();

	});
});