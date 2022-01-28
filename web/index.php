<!DOCTYPE html>
<html>

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<meta charset="ISO-8859-1">
	<title>Bill Generator</title>
	<link rel="stylesheet" href="main.css">

	<script>		
		$(document).ready(function () {
			$("#view").click(function () {

				var T = 0;

				$.ajax({
					type: 'POST',
					url: "Products.json",
					dataType: 'json',

					success: function (data) {
						for (var i = 0; i < data.length; i++) {
							var row = $('<tr><td>' + data[i].SNO + '</td><td>' + data[i].Name +
								'</td><td>' + data[i].Quant + '</td><td>' + data[i].Price + '</td></tr>');
							$('#prodsT').append(row);
							T = T + ( data[i].Quant * data[i].Price);							
						}
						$("#total").text(T);

					},
					error: function (jqXHR, textStatus, errorThrown) {
						alert('Error: ' + textStatus + ' - ' + errorThrown);
					}

				});
			});
		});
	</script>

	<script>		
		$(document).ready(function () {
			$("#clear").click(function () {

				$.ajax({
					type: 'POST',
					url: "Clear.php"					
				});

				$("#total").text("");
				$("#prodsT").text("");
			});
		});
	</script>
	

	<script>		
		$(document).ready(function () {
			$('#AddS').click(function () {

				var sno = $('#sno').val();
				var name = $('#name').val();
				var quant = $('#quant').val();
				var price = $('#price').val();

				if (sno == "") {
					alert('Please Fill Category S.No !!!');
					return false;
				}
				if (name == "") {
					alert('Please Fill Category Name !!!');
					return false;
				}
				if (quant == "") {
					alert('Please Fill Category Quantity !!!');
					return false;
				}
				if (price == "") {
					alert('Please Fill Category Price !!!');
					return false;
				}
	
				$.ajax({
					type: 'POST',
					url: "Biller.php",
					data: {
						SNO: $("#sno").val(),
						Name: $("#name").val(),
						Quant: $("#quant").val(),
						Price: $("#price").val()
					}					
				});
			});
		});  
	</script>


	

</head>

<body>
	<div class="header">
		<br>
		<h1>Billing System</h1>
	</div>

	<div style="text-align: center">
		<h2>Bill</h2>

				

		<div id="addP" style="align-items: center">
			<h2>Add Products</h2>
			<div align="center">
				<form name="addProduct" method="post">
					<table>
						<tr>
							<td>S.No</td>
							<td><input type="number" id="sno"></td>
						</tr>
						<tr>
							<td>Name</td>
							<td><input type="text" id="name"></td>
						</tr>
						<tr>
							<td>Quantity</td>
							<td><input type="number" id="quant"></td>
						</tr>
						<tr>
							<td>Price</td>
							<td><input type="number" id="price"></td>
						</tr>
					</table>
					<br>
					<input type="submit" value="Add" id="AddS">
				</form>
			</div>

		</div>
		<br><br>

		

		<h2>Bill</h2>
		<br>
		<button id="view">View Bill</button>		
		<br><br>
		<table id="prodsT" style="width: 100%;">
			<tr>
				<th>S.No</th>
				<th>Name</th>
				<th>Quantity</th>
				<th>Price</th>
			</tr> 
		</table>
		<br><br>
		<div class="desp" style="text-align: center">
			Total Amount: <p id='total'></p> Rs.
		</div>


		<button id="clear">Clear</button>

	</div>
	<br>
	
</body>

</html>