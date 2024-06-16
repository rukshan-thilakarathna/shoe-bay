// the element which modal-box's html are displayed in
var modalWrap = 'x9d0';
// close button ID of the modal box
var closeBtn = 'x9i'
// the element ID of the whole modal output (Top parent div of modalWrap)
var output = 'x9d';
// folder name of cms (where ajax files are placed)
var place = 'admin/';
// form id in modal
var formID = 'zf1';
// hidden input of error messages container
var errmsgID = 'msgno';
// class name of edit forms with edit IDs
var editCls = 'x5ys';
// edit form submit button ID
var editBtn = 'zysent';
// class name of view only forms with view IDs
var viewCls = 'x5yv';
// error displaying class name
var errCls = 'x3s2';
// form fields error class
var inputErrCls = 'x3e';

// add form submit button ID
var addBtn = 'zysentAdd';
//add new button ID
var addnewBtn = 'x5bt';
//add new button text ID
var addnewTxt = 'x5s';
//add new button icon
var addnewImg = 'x5i';

// class name of delete forms with edit IDs
var delCls = 'x5ys1';
// delete form submit button ID
var delBtn = 'zysentDel';

// edit
if(SE_modal.hasOwnProperty("edit")){
	classClickEvents(editCls,SE_modal.edit);
	submitEvents(editBtn,SE_modal.edit);
}

// view only
if(SE_modal.hasOwnProperty("view")){
	classClickEvents(viewCls,SE_modal.view);
}

// addnew 
if(SE_modal.hasOwnProperty("add")){
	document.addEventListener('click',function(e){
	    if(e.target && (e.target.id==addnewBtn || e.target.id==addnewImg || e.target.id==addnewTxt)){
			let id = e.target.getAttribute("data-main-id") ?? 0;
	    	 _(output).style.display="block";
			 _ap(place+SE_modal.add+'.php?mainId='+id,'',function(data){responseDo(data);});
	     }
	});
	submitEvents(addBtn,SE_modal.add);
}	 

// delete 
if(SE_modal.hasOwnProperty("del")){
	classClickEvents(delCls,SE_modal.del);
	submitEvents(delBtn,SE_modal.del);
}	 

// have errors
if(SE_modal.hasOwnProperty("err")){
	function onError(str) {
		if(str!=""){
			str = str.trim();
			var a = str.split(" ");
			for(n in a){
				if(SE_modal.err.hasOwnProperty(a[n])){
					var d = _(SE_modal.err[a[n]][0])
					d.classList.toggle(inputErrCls,1);
					d.parentNode.insertBefore(_e('div',SE_modal.err[a[n]][1],{"class":errCls}),d.nextSibling);
				}
			}
		}
	}
	// to reset error messages and red borders in input fields
	function onfocusUndo() {
		var a = document.getElementsByClassName(inputErrCls);
		for(i in a){
			a[i].onfocus=function () {
				this.classList.toggle(inputErrCls,0);
				this.parentElement.getElementsByClassName(errCls)[0].remove();
			}
		}
	}
}
/// to set event listener on each click button actions on class elements 
function classClickEvents(className,url){
	var a = document.getElementsByClassName(className);
	var l = a.length;
	for(i=0;i<l;i++){
		a[i].onclick=function () {
			var f = this.id;
			_(output).style.display="block";
			_ap(place+url+'.php',f,function(data){responseDo(data);});
		}
	}
}

/// to set event listener on each form submit action : edit,add & delete
function submitEvents(submitBtn,url){
	document.addEventListener('click',function(e){
	   if(e.target && e.target.id==submitBtn){
	    	var checkErr = document.getElementsByClassName(errCls);
	    	if(checkErr.length>0) console.log(0);
	    	else{
	        _ap(place+url+'.php',formID,function(data){
	        	responseDo(data);
				onError(_(errmsgID).value);
	        	onfocusUndo();
	        });
	    	}
	    	_(output).scrollTo(0,0);
	   }
	});
}

///ajax post 
/// u = url, d = form_id, f = success func
function _ap(u, d, f) {
    var x = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    x.open('POST', u);
    x.onreadystatechange = function() {
        if (x.readyState>3 && x.status==200) { f(x.responseText); }
    };
    if(d=="") x.send();
    else{
	    var fm = _(d);
	    var fd = new FormData(fm);
	    x.send(fd);
    }
    return x;
}

_(closeBtn).onclick=function () {
	_(modalWrap).innerHTML="";
	_(output).style.display="none";
	location.reload();
}

function _e(e,t="",o=null,c=null) {
	var el = document.createElement(e);
	if(t!=="") el.textContent=t;
	if(o!=null) for (var i in Object.keys(o)) el.setAttribute(Object.keys(o)[i],Object.values(o)[i]);
	if(c!=null) for (var i in Object.keys(c)) el.appendChild(Object.values(c)[i]);
	return el;
}

function responseDo(data) {
	_(modalWrap).innerHTML=data;
}
