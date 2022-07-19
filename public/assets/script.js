$(document).ready(function () {

	$("button").click(function () {
		var jqxhr = $.post("/post/newcampaign", function () {
			alert("success");
		}).done(function () {
			alert("second success");
		}).fail(function () {
			alert("error");
		}).always(function () {
			alert("finished");
		});
	});
});
