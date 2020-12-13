    // Add active class to the current button (highlight it)
    var header = document.getElementById("bottom_left");
    var btns = header.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("activeTab");
    current[0].className = current[0].className.replace(" activeTab", "");
    this.className += " activeTab";
    });
    }


    //Switch website if it is mobile           
    if (screen.width <= 699) {
    document.location = "../join.html";
    }
    
   
  
        
      //Tabs function
      function openCity(evt, report) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" buka", "");
        }
        document.getElementById(report).style.display = "flex";
        evt.currentTarget.className += " buka";
      }

      // Get the element with id="defaultOpen" and click on it
      document.getElementById("defaultOpen").click();