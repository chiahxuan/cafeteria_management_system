//Modal Functions!!!!
// Get the modal
//modal1 is the dismiss modal
var modal1 = document.getElementById('Modal1');

var foodDelete = document.getElementById('foodDelete');

//modal2 is the sucessfully added modal
var modal2 = document.getElementById('Modal2');

//modal3 is the successfully delete/edit modal
var modal3 = document.getElementById('Modal3');

var modal4 = document.getElementById('Modal4');

var modal5 = document.getElementById('Modal5');

var deleteCategory = document.getElementById("deleteCategory");

//accessCardStatus is the confirmation change access card status modal
var accessCardStatus = document.getElementById('accessCardConfirm');

//Get Access card button class
var accessCardBtn = document.getElementsByClassName("activeTab")[0];


// Get the button that opens the modal
// var btn1 = document.getElementById("popUp1");
 
 var btn2 = document.getElementById("popUp1V2");
// var btn3 = document.getElementById("popUp_CardStatus");

// Get the <span> element that closes the modal
var closeBtn = document.getElementsByClassName("close");

var btn4 = document.getElementById("popUpdelete");

var btn5 = document.getElementById("popUpadd");

var DeleteEditModal = document.getElementById("Modal3");

//When the user clicks the button, open the modal 
 //btn1.onclick = function(){
	 //modal1.style.display = "flex";
	//

 //btn2.onclick = function(){
 //	modal1.style.display = "flex";
 //}

//  btn4.onclick = function(){
//  	modal3.style.display = "flex";
//  }
 
//  btn5.onclick = function(){
//  	modal4.style.display = "flex";
//  }

 foodDelete.onclick = function(){
	modal3.style.display = "flex";

 }

 deleteCategory.onclick = function(){
	modal5.style.display = "flex";
 }

// btn3.onclick = function(){
	// accessCardStatus.style.display = "flex";	
// }



for(var i=0; i<closeBtn.length; i++) {
	closeBtn[i].onclick = function() {
        modal1.style.display = "none";
		modal3.style.display = "none";
		modal4.style.display = "none";
		modal2.style.display = "none";
		modal5.style.display = "none";

		//accessCardStatus.style.display = "none";
		//transModal.style.display= "none";
	}
	
}



 //Get Button Id
 var userBtn = document.getElementById("user");

 var userModal = document.getElementsByClassName("notif_setting_cage")[0];

 var userStatus = false;
 var notifStatus = false;


//If User clicks on User button
userBtn.onclick = function() {

		if (userStatus == false) {
				userModal.style.display = "flex";
				userStatus = true;

		}else if (userStatus == true) {
				userModal.style.display = "none";
				userStatus = false;
		}
}


//Transaction history Modal
var transModal = document.getElementById("transHistory");
//Transaction history button
var transBtn = document.getElementsByClassName("trans_detail2");

//Every transBtn would open the transHistory Modal
for (var g = 0; g < transBtn.length; g++) {
	transBtn[g].onclick = function(){
		transModal.style.display = "flex";
	}
}

//Refund button would trigger modal1
var content_inn = document.getElementsByClassName("content_inn")[0];

content_inn.onclick= function() {
	modal1.style.display ="flex";
}


window.onclick = function open(event) {

	//FOR POP-UP MODAL OBJECTS!!!!!
	//FOR ACCESS CARD PAGE!!!!!
	//When the user clicks anywhere outside of the modal, close it

	
	//REMEMBER TO ADD CLICKING ON ACCESS CARD ALSO closes the form
	if (event.target == userBtn || event.target == accessCardBtn) {
        modal1.style.display = "none";
		
  	}else if (event.target == modal1 ) {
        modal1.style.display = "none";

	}else if (event.target == modal3 ) {
        modal3.style.display = "none";	

    }else if (event.target == accessCardStatus ) {
        accessCardStatus.style.display = "none";

    }else if (event.target == transModal) {
		transModal.style.display = "none";
	}

	//FOR TOP NOTIFICATINO MODELS MODALS!!!!!!
	if ( event.target != userBtn) {
		userStatus = false;
	}
}
