function _e(e,t="",o=null,c=null) {
	var el = document.createElement(e);
	if(t!=="") el.textContent=t;
	if(o!=null) for (var i in Object.keys(o)) el.setAttribute(Object.keys(o)[i],Object.values(o)[i]);
	if(c!=null) for (var i in Object.keys(c)) el.appendChild(Object.values(c)[i]);
	return el;
}
// have errors

if(SE_modal.hasOwnProperty("err")){
	console.log(3);
	function onError(str) {
		if(str!=""){
			str = str.trim();
			var a = str.split(" ");
			for(n in a){
				if(SE_modal.err.hasOwnProperty(a[n])){
					var d = _(SE_modal.err[a[n]][0])
					d.classList.toggle("x3e",1);
					d.parentNode.insertBefore(_e('div',SE_modal.err[a[n]][1],{"class":"x3s2"}),d.nextSibling);
				}
			}
		}
	}
	// to reset error messages and red borders in input fields
	function onfocusUndo() {
		var a = document.getElementsByClassName("x3e");
		for(i in a){
			a[i].onfocus=function () {
				this.classList.toggle("x3e",0);
				this.parentElement.getElementsByClassName("x3s2")[0].remove();
			}
		}
	}
}
onError(_("msgno").value);