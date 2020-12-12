//Tab Colour Function
var tablinks = document.getElementsByClassName("tablinks");


var btnColour = document.getElementsByClassName("tab_defaultColour");

for (var y = 0; y < btnColour.length; y++) {
 btnColour[y].addEventListener("click", function() {
		var current = document.getElementsByClassName("tab_colour");
        if (current.length > 0) {
            current[0].className = current[0].className.replace(" tab_colour", "");
        }             
        this.className += " tab_colour";
	});
}



// for (var y = 0; y < btnColour.length; y++) {
  
//     console.log(y);
    
//     btnColour[y].onclick = function(){
//         console.log(kl);
//       //  var y = 0;
//       //alert(kl); 
//     // document.getElementsByClassName("tab_defaultColour")[count].style.backgroundColor = "green" ;
//        this.style.backgroundColor = "Red";
     
//     }
    
      
// }

// btnColour[0].onclick = function(){
        
//     btnColour[0].style.backgroundColor = "green" ;

// }
// btnColour[1].onclick = function(){
        
//     btnColour[1].style.backgroundColor = "green" ;

//}