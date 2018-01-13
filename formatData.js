function getFateTable() {
	var xhttp = new XMLHttpRequest;
	xhttp.onreadystatechange = function () {
		if (this.status == 200 && this.readyState == 4) {
			if (this.responseText != null) {
				document.getElementById("text2").innerHTML = this.responseText;
				var json = JSON.parse(this.responseText);
				var text = "";
				for (x in json) {
					text += json[x].name + "<br>";
				}
				document.getElementById("text3").innerHTML = text;
			} else {
				document.getElementById("text2").innerHTML = "W success.";
			}
		}
	};

	xhttp.open("POST", "Fate/getFateTable.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var list = document.getElementById("form3").getElementsByTagName("input");

	var functionName = list.length;
	for (x in list) {
		if (list[x].type === "radio" && list[x].checked) {
			functionName = list[x].value;
		}
	}

	var temp = "function=" + functionName + "&fileName=" + document.getElementById("form3").getElementsByTagName("input")[0].value + "&content=" + encodeURIComponent(document.getElementById("form3").getElementsByTagName("textarea")[0].value);

	//document.getElementById("text1").innerHTML = temp;
	xhttp.send(temp);
}
