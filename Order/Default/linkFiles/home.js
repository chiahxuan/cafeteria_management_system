//Modal Functions!!!!
// Get the modal
//modal1 is the dismiss modal
var modal1 = document.getElementById('Modal1');

//modal2 is the sucessfully added modal
var modal2 = document.getElementById('Modal2');

var modal3 = document.getElementById('Modal3');

var modal4 = document.getElementById('Modal4');

var receiptModal = document.getElementById("receiptModal");


//accessCardStatus is the confirmation change access card status modal
//var accessCardStatus = document.getElementById('accessCardConfirm');


// Get the button that opens the modal
var btn1 = document.getElementById("popUp1");
var btn2 = document.getElementById("popUp1V2");
var btn3 = document.getElementById("popUp_successAdd");
var btn4 = document.getElementById("popUp_successDelete");

//var test = document.getElementsByClassName("LOL");

// Get the <span> element that closes the modal
var closeBtn = document.getElementsByClassName("close");


for(i=0; i<closeBtn.length; i++) {
	closeBtn[i].onclick = function() {
		// modal1.style.display = "none";
		// modal2.style.display = "none";
		// modal3.style.display = "none";
		modal4.style.display = "none";
		receiptModal.style.display = "none";
		
	}
	
}








// // When the user clicks on <span> (x), close the modal
// closeBtn[0].onclick = function() {
//  modal1.style.display = "none";
//  alert(closeBtn.length);
  
// }

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
	if (event.target == modal1 || event.target == userBtn) {
		modal1.style.display = "none";
		
  	}else if (event.target == modal2) {
    	modal2.style.display = "none";
	}else if (event.target == modal3) {
		modal2.style.display = "none";	
		modal3.style.display = "none";
	}else if (event.target == modal4) {
		modal1.style.display = "none";	
		modal4.style.display = "none";
	}

	//FOR TOP NOTIFICATINO MODELS MODALS!!!!!!
	if (event.target != userBtn) {
		userModal.style.display = "none";
		userStatus = false;
		
	}

}