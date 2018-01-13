function listTable(whichType) {
	var xhttp = new XMLHttpRequest;
	xhttp.onreadystatechange = function () {
		if (this.readyState === 4 && this.status === 200) {
			var jsonFile = JSON.parse(this.responseText);
			var txt = "<table>";
			for (var i = 0; i < jsonFile.length; i++) {
				txt += "<tr><td>" + jsonFile[i].name + "</td>";
				txt += "<td style='background-color:" + jsonFile[i].firstGcolor + "'>" + jsonFile[i].firstG + "</td>";
				txt += "<td style='background-color:" + jsonFile[i].secondGcolor + "'>" + jsonFile[i].secondG + "</td>";
				txt += "<td>" + jsonFile[i].reward + "</td></tr>";
			}

			txt += "</table>";
			document.getElementById("linkContent").innerHTML = txt;
		}
	};

	var fileName = whichType + ".json";
	xhttp.open("GET", fileName, true);
	xhttp.send();
}
