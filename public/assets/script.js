$(document).ready(function () {
	$('body').on('change', '#imageautoselect', function () {
		$("#photo").val("");
		$("#photo").prop("disabled", $(this).prop("checked"));
	});

	$('body').on('change', '#urlautoselect', function () {
		$("#webpage").val("");
		$("#bitly").val("");
		$("#webpage").prop("disabled", $(this).prop("checked"));
		$("#bitly").prop("disabled", $(this).prop("checked"));
	});
});
