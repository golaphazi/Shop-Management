 
/* Search model for purchse*/
function search_model(data){
	var id = data.value;
	//alert(id);
	var options = '';
	document.getElementById('model_code').innerHTML  = '';		
	$.getJSON(url+"purchase/search_model", {item: id}, function(j){
		if(j.length > 0){
			options += '<option value="">Select</option>';
			for(var i =0; i < j.length; i++){
				options += '<option value="'+ j[i].optionValue+'"> ' +j[i].optionDisplay+'</option>';
			}
			document.getElementById('model_code').innerHTML  = options;
		}else{
			options += '<option value="">No Model Found</option>';
			document.getElementById('model_code').innerHTML  = options;
		}
	})
}


/*Add purchase data in table*/

function add_purchase_data(){
	
	var item = document.getElementById('item_id');
	var mass = 0;
	if(item.value == 0){
		item.focus();
		mass = 1;
		return false;
	}
	
	var model = document.getElementById('model_code');
	if(model.value == 0){
		model.focus();
		mass = 1;
		return false;
	}
	
	var qty = document.getElementById('stock_qty');	
	if(qty.value.length == 0){
		qty.focus();
		mass = 1;
		return false;
	}
	
	
	var supp = document.getElementById('supplier_id');
	if(supp.value == 0){
		supp.focus();
		mass = 1;
		return false;
	}
	
	var note = document.getElementById('remarks');
	
	if(mass == 0){
		
		$.getJSON(url+"purchase/search_model_info", {model: model.value}, function(j){
			var model_id = j[0].MODEL_ID;
			var model_code = j[0].MODEL_CODE;
			var price = j[0].MODEL_BUY_PRICE;
			var typeName = j[0].ITEM_TYPE_NAME;
			var typeId = j[0].ITEM_TYPE;
			var unitName = j[0].ITEM_UNIT_NAME;
			var unitId = j[0].ITEM_UNIT;
		
			/*Count Total table row*/
			var table, tbody, tr, td, i, tdCOunt;
			tbody = document.getElementById("addPurchaseTbody");
			tr = tbody.getElementsByTagName("tr");
			tdCOunt = Number(tr.length) + 1;
			
			
			/*Create node for tr*/
			var nodeTr = document.createElement("tr");
			nodeTr.setAttribute('id', 'tr__'+tdCOunt);
			
			/*Create node for td*/
			var nodetdT = '';
			var nodetd = '';
			var textnode = '';
			
			for(i = 1; i <= 10; i++){
				/*Fos SL*/
				var nodetd_1 = document.createElement("td");
				nodetd_1.setAttribute('id', 'td_'+i+'__'+tdCOunt);
				
				var htmlValue = '';
				var dataValue = '';
				
				var inputnode_1 = document.createElement("input");
				inputnode_1.id = 'input_'+i+'__'+tdCOunt;
				inputnode_1.name = 'input_'+i+'__[]';
				//inputnode_1.name = 'input_'+i+'__'+tdCOunt+'__[]';
				inputnode_1.type = "hidden";
				if(i == 1){
					htmlValue = tdCOunt;	
					inputnode_1.value = item.value;
					nodetd_1.appendChild(inputnode_1);	
				}else if(i == 2){
					htmlValue = model_code;
					inputnode_1.value = model_id;
					nodetd_1.appendChild(inputnode_1);
				}else if(i == 3){
					htmlValue = supp.value;
					inputnode_1.value = supp.value;
					nodetd_1.appendChild(inputnode_1);
				}else if(i == 4){
					htmlValue = qty.value;
					inputnode_1.value = qty.value;
					nodetd_1.appendChild(inputnode_1);
					nodetd_1.setAttribute('contenteditable', true);
					nodetd_1.setAttribute('onblur', 'change_data_int(this)');
					nodetd_1.style = 'cursor:text;';
				}else if(i == 5){
					htmlValue = Number(price);
					inputnode_1.value = Number(price);
					nodetd_1.appendChild(inputnode_1);
					nodetd_1.setAttribute('contenteditable', true);
					nodetd_1.setAttribute('onblur', 'change_data_int(this)');
					nodetd_1.style = 'cursor:text;';
				}else if(i == 6){
					htmlValue = (Number(price) * Number(qty.value)).toFixed(2);
					//htmlValue = price* qty.value;
					inputnode_1.value = (Number(price) * Number(qty.value)).toFixed(2);
					//inputnode_1.value = price * qty.value;
					nodetd_1.appendChild(inputnode_1);					
				}else if(i == 7){
					htmlValue = typeName;
					inputnode_1.value = typeId;
					nodetd_1.appendChild(inputnode_1);
				}else if(i == 8){
					htmlValue = unitName;
					inputnode_1.value = unitId;
					nodetd_1.appendChild(inputnode_1);
				}else if(i == 9){
					htmlValue = note.value;
					inputnode_1.value = note.value;
					nodetd_1.appendChild(inputnode_1);
					nodetd_1.setAttribute('contenteditable', true);
					nodetd_1.setAttribute('onblur', 'change_data(this)');
					nodetd_1.style = 'cursor:text;';
				}else if(i == 10){
					htmlValue = '';
					var inputnode_1 = document.createElement("button");
					inputnode_1.setAttribute('class', 'remove_button');
					inputnode_1.name = 'remove__'+tdCOunt;
					inputnode_1.id = 'button__'+tdCOunt;
					inputnode_1.title = 'Remove Model';
					inputnode_1.setAttribute('onclick', 'remove_data(this.id)');
					inputnode_1.innerHTML = '<span class="fa fa-trash" style="color:red;"></span>'
					
					nodetd_1.appendChild(inputnode_1);
				}else{
					htmlValue = '';
					
				}
				
				textnode_1 = document.createTextNode(htmlValue);
				nodetd_1.appendChild(textnode_1)
				nodeTr.appendChild(nodetd_1);
				
			}
			
			/*Total tr append*/
			tbody.appendChild(nodeTr);	
			
			/*Reset data*/
			qty.value = '';	
			note.value = '';	
			item.value = '0';	
			model.value = '';	
			item.focus();
			reveivePayment();
			
		});
		return true;
	}
}


/*change qty*/
function change_data_int(data){
	var idName = data.id;
	var idData = document.getElementById(data.id);
	var valData = idData.innerText;
	valData = valData.replace(/[^0-9,.]/g, ""); 
	var resId = idName.replace("td", "input");
	document.getElementById(resId).value = valData;
	
	
	var res = idName.split('__');
	var qty = document.getElementById('input_4__'+res[1]).value;
	var price = document.getElementById('input_5__'+res[1]).value;
	var netPrice = (Number(qty) * Number(price)).toFixed(2);;
	document.getElementById('input_6__'+res[1]).value = netPrice;
	var repId = document.getElementById('td_6__'+res[1]).innerText;
	var string = document.getElementById('td_6__'+res[1]).innerHTML;
	var replacedString = string.replace(repId, netPrice);
	document.getElementById('td_6__'+res[1]).innerHTML = replacedString; 
	//alert(string);
	reveivePayment();
}

function change_data(data){
	var idName = data.id;
	var idData = document.getElementById(data.id);
	var valData = idData.innerText;
	var resId = idName.replace("td", "input");
	document.getElementById(resId).value = valData;
	reveivePayment();
	
}

function reveivePayment(){
	subtotal();
	var sub = document.getElementById('sub_total').innerText;
	var rec = document.getElementById('receive_amount').value;
	var due = Number(sub) - Number(rec);
	//alert(due);
	document.getElementById('due_total').innerText = due.toFixed(2);
	return true;
}

function subtotal(){	
	var input = document.getElementsByName('input_6__[]');
	var total = input.length;
	var totalData = 0;
	for(var j = 0; j<total; j++){
		totalData = Number(totalData) + Number(input[j].value);
		document.getElementById('sub_total').innerText = totalData.toFixed(2);
		document.getElementById('receive_amount').value = '';
		
	}
}

function update_tr_id(id){
	var table, tbody, tr, td, i, j, tdCOunt;
	tbody = document.getElementById("addPurchaseTbody");
	tr = tbody.getElementsByTagName("tr");
	var trCOunt = Number(tr.length)+2;
	
	var removeTr = 1+Number(id);
	for(i = removeTr; i < trCOunt; i++){
		var setTr = Number(i) - 1;		
			
		document.getElementById('tr__'+i).setAttribute('id', 'tr__'+setTr);	
		
		for(j = 1; j < 11; j++){
			document.getElementById('td_'+j+'__'+i).setAttribute('id', 'td_'+j+'__'+setTr);
			
			if(j != 10 && j != 1){
				var input = document.getElementById('input_'+j+'__'+i);
				input.setAttribute('name', 'input_'+j+'__[]');
				input.setAttribute('id', 'input_'+j+'__'+setTr);
			}else if(j == 10){
				var input = document.getElementById('button__'+i);
				input.setAttribute('name', 'remove__'+setTr);
				input.setAttribute('id', 'button__'+setTr);
			}
		}
		document.getElementById('td_1__'+setTr).innerText = setTr;

	}
}


function remove_data(data){
	if(data.length > 0){
		if(!confirm('Are you want to remove this')){
			return true;
		}
		var idName = data;
		var idData = document.getElementById(data);
		var res = idName.split("__");
		var newTr = 'tr__'+res[1];
		
		var tr = document.getElementById(newTr);
		tr.parentNode.removeChild(tr);
		document.getElementById('item_id').focus();
		reveivePayment();
		update_tr_id(res[1]);
		
	}
}

