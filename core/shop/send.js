function buttonClicked(RECIEVER,ITEM_ID,PRICE,COST_TYPE,ITEM_NAME){
	var txt;
	var price_text;
	if(COST_TYPE == 1){
		price_text = "Vote Points";
	}
	if(COST_TYPE == 2){
		price_text = "Donor Points";
	}
	if(COST_TYPE != 3){
		var r = confirm("About to buy " + ITEM_NAME + " - " + ITEM_ID + " for " + PRICE + " " + price_text + " to " + RECIEVER);
		if (r == true) {
			var prep_command = 'send mail ' + RECIEVER + ' "Test message" "This is a test message from website-shop"';
		} else {
			txt = "Item is not send!";
			alert(txt);
			//var prep_command = "error";
		}
	}else{
		alert("Item " + ITEM_NAME + " is not aviable!!!");
	}
}

       