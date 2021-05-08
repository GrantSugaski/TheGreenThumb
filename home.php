<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="styles/common.css">
	</head>
	<body onload="fillSearchTable()">
		<?php include("navbar.php"); ?>

		<div class="home-container">
			<div id="customerMap"></div>

			<input type="text" id="customerSearchBar" onkeyup="filter()" placeholder="Search for produce ..." />

			<table id="customerSearchTable">
				<tr class="header-row">
					<th style="width: 20%;">Farmer</th>
					<th style="width: 40%;">Address</th>
					<th style="width: 35%;">Produce</th>
					<th style="width: 5%;">Options</th>
				</tr>
			</table>
		</div>

		<script>
			var customerMap;
			function initMap() {
				customerMap = new google.maps.Map(document.getElementById("customerMap"), {
					zoom: 7,
					center: { lat: 35.394034, lng: -78.898621 }
        		});
			}

			function fillSearchTable() {
				var ajax = new XMLHttpRequest();				//Ajax request to controller
				ajax.open("GET", "controller/homeController.php?request=GetLocations");
				ajax.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						var locations = JSON.parse(this.responseText);

						var table = document.getElementById("customerSearchTable");

						for (var i = 0; i < locations.length; i++) {
							console.log(locations[i]);

							var rowCount = table.rows.length;
							var row = table.insertRow(rowCount);

							var name = locations[i]["FirstName"] + " " + locations[i]["LastName"];
							var cell1 = row.insertCell(0);
							cell1.innerHTML = name;

							var address = locations[i]["Address"];
							var cell2 = row.insertCell(1);
							cell2.innerHTML = address;

							var products = locations[i]["Products"];
							var cell3 = row.insertCell(2);
							cell3.innerHTML = products;

							var cell4 = row.insertCell(3);
							cell4.innerHTML = "<button type='submit' onclick='displayAddress(\"" + address + "\")'>Display</button>";
						}
					}
				}
				ajax.send();
			}

			function displayAddress(address) {
				console.log(address);

				const geocoder = new google.maps.Geocoder();
				geocoder.geocode({ address: address }, (results, status) => {
					if (status === "OK") {
						customerMap.setCenter(results[0].geometry.location);
						new google.maps.Marker({
							map: customerMap,
							position: results[0].geometry.location,
						});
					} else {
						alert(
						"Geocode was not successful for the following reason: " + status
						);
					}
				});
			}

			function filter() {
				// Declare variables
				var input, filter, table, tr, td, i, txtValue;
				input = document.getElementById("customerSearchBar");
				filter = input.value.toUpperCase();
				table = document.getElementById("customerSearchTable");
				tr = table.getElementsByTagName("tr");

				// Loop through all table rows, and hide those who don't match the search query
				for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[2];
					if (td) {
						txtValue = td.textContent || td.innerText;
						if (txtValue.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						} else {
							tr[i].style.display = "none";
						}
					}
				}
			}
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgTxPAlALLkrywOYeHZLOovHSRLCq3a2M&callback=initMap&libraries=&v=weekly" async></script>
	</body>
</html>