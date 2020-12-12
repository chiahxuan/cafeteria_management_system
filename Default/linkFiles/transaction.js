var modal2 = document.getElementById('Modal2');
var closeBtn = document.getElementsByClassName("close");

for(var i=0; i<closeBtn.length; i++) {
    closeBtn[i].onclick = function() {
        modal1.style.display = "none";
        transModal.style.display= "none";
    }
    
}

