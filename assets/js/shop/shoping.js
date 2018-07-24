
function removeChar(item)
	{ 
		//alert();
		var val = item.value;
		val = val.replace(/[^0-9,.]/g, "");  
		if (val == ' '){val = ''};   
		item.value=val;
	}
function removeDate(item)
	{ 
		//alert();
		var val = item.value;
		val = val.replace(/[^0-9-]/g, "");  
		if (val == ' '){val = ''};   
		item.value=val;
	}
function removeNumber(item)
	{ 
		//alert('hi therer');
		var val = item.value;
		val = val.replace(/[^A-Za-z.: ]/g, "");
		if (val == ' '){val = ''};   
		item.value=val;
		//alert();
	}

function setChar_int(item)
	{ 
		var val = item.value;
		val = val.replace(/[^A-Za-z0-9 ]/g, "");
		if (val == ' '){val = ''};   
		item.value=val;
		//alert();
	}

function removeSpcial(item)
	{ 
		var val = item.value;
		val = val.replace(/[^A-Za-z0-9@._-]/g, "");
		if (val == ' '){val = ''};   
		item.value=val;
		//alert();
	}
function removeSpace(item)
	{ 
		var val = item.value;
		val = val.replace(/[^A-Za-z0-9@_.-=>%^*()<!&#$]/g, "");
		if (val == ' '){val = ''};   
		item.value=val;
		//alert();
	}
	
function number_format(item){
	var valD = item.value;
	valD = valD.replace(/\,/g,"");  
	var id = item.id;
	var vlaue = valD.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
	$("#"+id).val(vlaue);
}


/*Search parametter*/
function mySearch() {
  var input, filter, table, tr, td, i, tdCOunt;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    td1 = tr[i].getElementsByTagName("td")[2];
    td2 = tr[i].getElementsByTagName("td")[3];
	if (td || td1 || td2) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }      
		
  }
}

/*Search parametter end*/


/*select search option*/

$(function(){
	
	var x = document.getElementById("item_id");
	x.addEventListener("focus", myFocusFunction, true);
	x.addEventListener("blur", myBlurFunction, true);

	function myFocusFunction() {
		//document.getElementById("item_id").style.display = "none";
		//document.getElementById("mySelect").style.display = "block";
		
	}

	function myBlurFunction() {
		//document.getElementById("item_id").style.display = "block";
		//document.getElementById("mySelect").style.display = "none";
		document.getElementById("mySelect").value = '';		
	}
})


$(window).keypress(function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 'f':
            event.preventDefault();
            document.getElementById('myInput').focus();
            break;
        case 'e':
            event.preventDefault();
			alert('ctrl-e');
            break;
        }
		
    }
	/*Page active*/
	if((event.ctrlKey && event.shiftKey) || event.metaKey){
		switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
			location.replace(url+'setup/supplier_info/');
			event.preventDefault();           
            break;
        case 'i':
		    location.replace(url+'setup/product_items/');
            event.preventDefault();          
            break;
        case 'm':
            location.replace(url+'setup/items_model/');
			event.preventDefault();
			break;
		case 'z':
			history.go(-1);
			event.preventDefault();
			break;
		case 'y':
			history.go(1);
			event.preventDefault();
			break;		
        }
	}
	
	/*Page active*/
	if((!event.ctrlKey && event.altKey)|| event.metaKey){
		//alert(String.fromCharCode(event.which).toLowerCase());
		switch (String.fromCharCode(event.which).toLowerCase()) {
        case 'a':
			location.replace(url+'purchase/add_stock/');
			event.preventDefault();           
            break;
        case 'p':
		    location.replace(url+'purchase/return_stock/');
            event.preventDefault();          
            break;
        case 'r':
            location.replace(url+'purchase/purchase_report/');
			event.preventDefault();
			break;
		case 'z':
			history.go(-1);
			event.preventDefault();
			break;
		case 'y':
			history.go(1);
			event.preventDefault();
			break;
        }
	}
	
	
});
