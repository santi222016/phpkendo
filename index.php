<!doCTYpe html>
<html>
<head>
	<link href="css/kendo.metro.min.css" rel="stylesheet">
	<link href="css/kendo.common.min.css" rel="stylesheet">

	<script src="js/jquery.min.js"></script>
	<script src="js/kendo.all.min.js"></script>
</head>
<body>
	<div id="grid"></div>
	<script type="text/x-kendo-template" id="template">
    	<div class="subgrid"></div>
    </script>
	<script>
		$(function() {
			$("#grid").kendoGrid({
				dataSource: {
					transport: {
						read: "data/employeespg.php",
						contentType: "application/json; charset=utf-8",
					},
					schema: {
						data: "data"
					}
				},
				columns: [{ field: "firstname" }, { field: "lastname" }],
				detailTemplate: kendo.template($("#template").html()),
                detailInit: detailInit
			});

			function detailInit(e) {
				// get a reference to the current row being initialized
				var detailRow = e.detailRow;

				// create a subgrid for the current detail row, getting territory data for this employee
				detailRow.find(".subgrid").kendoGrid({
					dataSource: {
						transport: {
							read: "data/territoriespg.php"
						},
						schema: {
							data: "data"
						},
						serverFiltering: true,
						filter: { field: "employeeid", operator: "eq", value: e.data.employeeid }
					},
					columns: [{ title: "Territories", field: "territorydescription" }],
				});
			}
		});
	</script>
</body>
</html>

