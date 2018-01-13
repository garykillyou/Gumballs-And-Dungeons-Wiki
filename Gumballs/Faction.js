function getGumballs() {
	var xmlhttp, myObj, x, txt = "";
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			myObj = JSON.parse(this.responseText);
			txt += "<table><tr>";
			for (x in myObj) {
				txt += "<td><div onclick='getGumballDetail(this)'><img src=\"" + myObj[x].img_ad + "\">";
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

function getGumballDetail(obj) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			//alert(this.responseText);
			var detail = JSON.parse(this.responseText);
			gName.innerHTML = detail[0].Name;
			gImg.src = detail[0].Img_website;
			gStarNum.innerHTML = detail[0].Star_Num;
			gFaction.innerHTML = detail[0].Faction;
			gType.innerHTML = detail[0].Type;
			gTalent.innerHTML = detail[0].Talent;
			gSkill.innerHTML = detail[0].Exclusive_skill;
		}
	};
	var s = "getGumballDetail.php?faction=" + document.body.title + "&gName=" + obj.getElementsByTagName("p")[0].innerHTML;
	xmlhttp.open("GET", s, true);
	//alert(s);
	xmlhttp.send();
}
