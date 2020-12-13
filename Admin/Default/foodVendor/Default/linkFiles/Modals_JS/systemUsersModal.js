//Modal Functions!!!!
// Get the modal
//modal1 is the dismiss modal
var modal1 = document.getElementById('Modal1');

//modal2 is the sucessfully added modal
var modal2 = document.getElementById('Modal2');

var modal3= document.getElementById('Modal3');

//accessCardStatus is the confirmation change access card status modal
//var accessCardStatus = document.getElementById('accessCardConfirm');

//Get Access card button class
var accessCardBtn = document.getElementsByClassName("activeTab")[0];


// Get the button that opens the modal
var btn1 = document.getElementById("popUp1");
//var btn2 = document.getElementById("popUp1V2");
//var btn3 = document.getElementById("popUp_CardStatus");

//var test = document.getElementsByClassName("LOL");

// Get the <span> element that closes the modal
var closeBtn = document.getElementsByClassName("close");


//Transaction history Modal
var transModal = document.getElementById("transHistory");
//Transaction history button
var transBtn = document.getElementsByClassName("trans_detail");

//Every transBtn would open the transHistory Modal
for (var g = 0; g < transBtn.length; g++) {
	transBtn[g].onclick = function(){
		transModal.style.display = "flex";
	}
}


// When the user clicks the button, open the modal 
/*btn1.onclick = function(){
	modal1.style.display = "flex";
	
}*/

/*btn2.onclick = function(){
	modal1.style.display = "flex";
}*/






/*for(i=0; i<closeBtn.length; i++) {
	closeBtn[i].onclick = function() {
		modal1.style.display = "none";
	}
	
}*/


//Refund button would trigger modal1
var content_inn = document.getElementsByClassName("content_inn")[0];

content_inn.onclick= function() {
	modal1.style.display ="flex";
}





// // When the user clicks on <span> (x), close the modal
// closeBtn[0].onclick = function() {
//  modal1.style.display = "none";
//  alert(closeBtn.length);
  
// }


  for(var i=0; i<closeBtn.length; i++) {
		closeBtn[i].onclick = function() {
			modal1.style.display = "none";
			modal2.style.display = "none";	
			modal3.style.display = "none";			
			transModal.style.display= "none";
		}
		
	}


 //Get Button Id
 var userBtn = document.getElementById("user");


 //Get notification modal Id
 var notifModalStack = document.getElementsByClassName("notif_stack")[0];

 var userModal = document.getElementsByClassName("notif_setting_cage")[0];

 var userStatus = false;


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





window.onclick = function open(event) {

	//FOR POP-UP MODAL OBJECTS!!!!!
	//FOR ACCESS CARD PAGE!!!!!
	//When the user clicks anywhere outside of the modal, close it

	
	//REMEMBER TO ADD CLICKING ON ACCESS CARD ALSO closes the form
	if (event.target == modal1 || event.target == userBtn || event.target == accessCardBtn) {
		modal1.style.display = "none";
		
  	}else if (event.target == modal2 || event.target == closeBtn) {
    	modal2.style.display = "none";
	}else if (event.target == transModal) {
		transModal.style.display = "none";
	}

	//FOR TOP NOTIFICATINO MODELS MODALS!!!!!!
	if (event.target != userBtn && event.target != notifBtn) {

		userModal.style.display = "none";
		userStatus = false;
		
	}

}