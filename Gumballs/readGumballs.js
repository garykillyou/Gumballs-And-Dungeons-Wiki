function getFateTable() {
	var xhttp = new XMLHttpRequest;
	xhttp.onreadystatechange = function () {
		if (this.status == 200 && this.readyState == 4) {
			document.getElementById("text2").innerHTML = this.responseText;
			var json = JSON.parse(this.responseText);
			var text = "";
			for (x in json ) {
				text += json[x].name
			}
			document.getElementById("text3").innerHTML = text;
		}
	};

	xhttp.open("POST", "getFateTable.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var content = document.getElementById("form3").getElementsByTagName("textarea")[0].value;
	
	var temp = "function=getFateTable&content=" + content;
	document.getElementById("text1").innerHTML = temp;
	xhttp.send(temp);

}
