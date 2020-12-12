//Modal Functions!!!!
// Get the modal
//modal1 is the dismiss modal
var modal1 = document.getElementById('Modal1');
// var toomuchModal= document.getElementById('toomuchModal');
// var toolessModal= document.getElementById('toolessModal');

	

//modal2 is the sucessfully added modal
var modal2 = document.getElementById('Modal2');

//accessCardStatus is the confirmation change access card status modal
var accessCardStatus = document.getElementById('accessCardConfirm');

//Get Access card button class
var accessCardBtn = document.getElementsByClassName("activeTab")[0];


// Get the button that opens the modal
var btn1 = document.getElementById("popUp1");
var btn2 = document.getElementById("popUp1V2");
var btn3 = document.getElementById("popUp_CardStatus");

// Get the <span> element that closes the modal
var closeBtn = document.getElementsByClassName("close");




// When the user clicks the button, open the modal 
btn1.onclick = function(){
	modal1.style.display = "flex";
	
}

// btn2.onclick = function(){
// 	modal1.style.display = "flex";
// }



btn3.onclick = function(){
	accessCardStatus.style.display = "flex";
	
}



for(i=0; i<closeBtn.length; i++) {
	closeBtn[i].onclick = function() {
        modal1.style.display = "none";
		accessCardStatus.style.display = "none";

	}
	
}



 //Get Button Id
 var notifBtn = document.getElementById("notif");
 var userBtn = document.getElementById("user");


 //Get notification modal Id
 var notifModal = document.getElementsByClassName("notif_cage")[0];
 var notifModalStack = document.getElementsByClassName("notif_stack")[0];

 var userModal = document.getElementsByClassName("notif_setting_cage")[0];

 var userStatus = false;
 var notifStatus = false;



//If User clicks on Notification button
notifBtn.onclick = function() {
	if (notifStatus == false) {
			notifModal.style.display = "flex";
			notifStatus = true;
			
			userModal.style.display = "none";
			userStatus = false;

	}else if (notifStatus == true) {
			notifModal.style.display = "none";
			notifStatus = false;
	}
}


//If User clicks on User button
userBtn.onclick = function() {

		if (userStatus == false) {
				userModal.style.display = "flex";
				userStatus = true;

				notifModal.style.display = "none";
				notifStatus = false;

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
	if (event.target == notifBtn || event.target == userBtn || event.target == accessCardBtn) {
        modal1.style.display = "none";
        accessCardStatus.style.display = "none";
		
  	}else if (event.target == modal1 ) {
        modal1.style.display = "none";

    }else if (event.target == accessCardStatus ) {
        accessCardStatus.style.display = "none";

    }

	//FOR TOP NOTIFICATINO MODELS MODALS!!!!!!
	if (event.target != notifModal && event.target != userBtn && event.target != notifBtn) {
	
			
		notifModal.style.display = "none";
		notifStatus = false;

		userModal.style.display = "none";
		userStatus = false;
		
	}

}