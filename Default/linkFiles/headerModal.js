// //Modal Functions!!!!
// // Get the modal
// var modal1 = document.getElementById('Modal1');
// var modal2 = document.getElementById('Modal2');

// //Get Access card button class
// var accessCardBtn = document.getElementsByClassName("activeTab")[0];


// // Get the button that opens the modal
// var btn1 = document.getElementById("popUp1");
// var btn2 = document.getElementById("popUp2");

// //var test = document.getElementsByClassName("LOL");

// // Get the <span> element that closes the modal
// var closeBtn = document.getElementsByClassName("close");




// // When the user clicks the button, open the modal 
// btn1.onclick = function() {
//   modal1.style.display = "flex";

// }


// When the user clicks on <span> (x), close the modal
/*closeBtn.onclick = function() {
  modal1.style.display = "none";
  
}

closeBtn.onclick = function() {
  modal2.style.display = "none";
}
*/










 //Get Button Id
//  var notifBtn = document.getElementById("notif");
 var userBtn = document.getElementById("user");


 //Get notification modal Id
 var notifModal = document.getElementsByClassName("notif_cage")[0];
 var notifModalStack = document.getElementsByClassName("notif_stack")[0];

 var userModal = document.getElementsByClassName("notif_setting_cage")[0];

 var userStatus = false;
 var notifStatus = false;



  //   //If User clicks on Notification button
	// notifBtn.onclick = function() {
	// 	if (notifStatus == false) {
	// 			notifModal.style.display = "flex";
	// 			notifStatus = true;
				

	// 			userModal.style.display = "none";
	// 			userStatus = false;

	// 	}else if (notifStatus == true) {
	// 			notifModal.style.display = "none";
	// 			notifStatus = false;
	// 	}
	// }
	

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

	// //FOR POP-UP MODAL OBJECTS!!!!!
	// //When the user clicks anywhere outside of the modal, close it

	// //REMEMBER TO ADD CLICKING ON ACCESS CARD ALSO closes the form
	// if (event.target == modal1 || event.target == closeBtn[0] || event.target == notifBtn || event.target == userBtn || event.target == accessCardBtn) {
	// 	modal1.style.display = "none";
		
  // 	}else if (event.target == modal2 || event.target == closeBtn) {
  //   	modal2.style.display = "none";
	// }

	//FOR TOP HEADER MODALS!!!!!!
	if (event.target != notifModal && event.target != userBtn && event.target != notifBtn) {
		// if (event.target == userBtn) {
		//     alert("Hey")
		// }else if (event.target == notifBtn) {
		//     alert("LOL");
		// }else {
		//     alert("NONE");
		// }
			
		notifModal.style.display = "none";
		notifStatus = false;

		userModal.style.display = "none";
		userStatus = false;
		
	}

}