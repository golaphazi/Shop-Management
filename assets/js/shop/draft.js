			/*Fos SL*/
			var nodetd_1 = document.createElement("td");
			nodetd_1.setAttribute('id', 'td1__'+tdCOunt+'__'+model_id);
			
			var inputnode_1 = document.createElement("input");
			inputnode_1.id = 'input__'+tdCOunt+'__'+model_id;
			inputnode_1.name = 'input1__'+tdCOunt+'__'+model_id+'__[]';
			inputnode_1.value = tdCOunt;
			inputnode_1.type = "hidden";
			nodetd_1.appendChild(inputnode_1);
			
			textnode_1 = document.createTextNode(tdCOunt);
			nodetd_1.appendChild(textnode_1)
			nodeTr.appendChild(nodetd_1);
			
			/*Fos Model*/
			var nodetd_2 = document.createElement("td");
			nodetd_2.setAttribute('id', 'td2__'+tdCOunt+'__'+model_id);
			var textnode_2 = document.createTextNode(model_code);
			nodetd_2.appendChild(textnode_2)
			nodeTr.appendChild(nodetd_2);
			
			/*Fos Supplier*/
			var nodetd_3 = document.createElement("td");
			nodetd_3.setAttribute('id', 'td3__'+tdCOunt+'__'+model_id);
			var textnode_3 = document.createTextNode(supp.value);
			nodetd_3.appendChild(textnode_3)
			nodeTr.appendChild(nodetd_3);
			
			/*Fos Qty*/
			var nodetd_4 = document.createElement("td");
			nodetd_4.setAttribute('id', 'td4__'+tdCOunt+'__'+model_id);
			nodetd_4.setAttribute('contenteditable', true);
			
			var textnode_4 = document.createTextNode(qty.value);
			nodetd_4.appendChild(textnode_4)
			nodeTr.appendChild(nodetd_4);
			
			/*Fos price*/
			var nodetd_5 = document.createElement("td");
			nodetd_5.setAttribute('id', 'td5__'+tdCOunt+'__'+model_id);
			var textnode_5 = document.createTextNode(price);
			nodetd_5.appendChild(textnode_5)
			nodeTr.appendChild(nodetd_5);
			
			/*Fos type*/
			var nodetd_6 = document.createElement("td");
			nodetd_6.setAttribute('id', 'td6__'+tdCOunt+'__'+model_id);
			var textnode_6 = document.createTextNode(typeName);
			nodetd_6.appendChild(textnode_6)
			nodeTr.appendChild(nodetd_6);
			
			
			/*Fos unit*/
			var nodetd_7 = document.createElement("td");
			nodetd_7.setAttribute('id', 'td7__'+tdCOunt+'__'+model_id);
			var textnode_7 = document.createTextNode(unitName);
			nodetd_7.appendChild(textnode_7)
			nodeTr.appendChild(nodetd_7);
			
			
			/*Fos Note*/
			var nodetd_8 = document.createElement("td");
			nodetd_8.setAttribute('id', 'td8__'+tdCOunt+'__'+model_id);
			var textnode_8 = document.createTextNode(note.value);
			nodetd_8.appendChild(textnode_8)
			nodeTr.appendChild(nodetd_8);
			
			/*Fos Note*/
			var nodetd_9 = document.createElement("td");
			nodetd_9.setAttribute('id', 'td9__'+tdCOunt+'__'+model_id);
			var textnode_9 = document.createTextNode('Edit');
			//textnode_9 = '<span>Remove</span>';
			nodetd_9.appendChild(textnode_9);
			nodeTr.appendChild(nodetd_9);