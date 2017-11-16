function getGumballs() {
	var xmlhttp, myObj, x, txt = "";
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			myObj = JSON.parse(this.responseText);
			txt += "<table><tr>";
			for (x in myObj) {
				txt += "<td><div><img src='" + myObj[x].img_ad + "'>";
				txt += "<p>" + myObj[x].name + "</p></div></td>";
			}
			txt += "</tr></table>";
			document.getElementById("left-side").innerHTML = txt;
		}
	};
	var temp = document.title + ".json";
	xmlhttp.open("GET", temp, true);
	xmlhttp.send();
}
