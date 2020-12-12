//Modal Functions!!!!
// Get the modal
//modal1 is the dismiss modal
var modal1 = document.getElementById('Modal1');
var toomuchModal= document.getElementById('toomuchModal');
var toolessModal= document.getElementById('toolessModal');
var invalididModal= document.getElementById('invalididModal');
var deactivatedModal= document.getElementById('deactivatedModal');


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


for(var i=0; i<closeBtn.length; i++) {
	closeBtn[i].onclick = function() {
		modal1.style.display = "none";
		toomuchModal.style.display = "none";
		toolessModal.style.display = "none";
		invalididModal.style.display = "none";
		deactivatedModal.style.display = "none";
	}
	
}


window.onclick = function open(event) {

	//FOR POP-UP MODAL OBJECTS!!!!!
	//FOR ACCESS CARD PAGE!!!!!
	//When the user clicks anywhere outside of the modal, close it

	
	//REMEMBER TO ADD CLICKING ON ACCESS CARD ALSO closes the form
	if (event.target == modal1 ) {
        modal1.style.display = "none";

    }

	

}