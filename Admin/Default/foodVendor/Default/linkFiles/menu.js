var foodEdit = document.getElementById('foodEdit');

var cancelBtn = document.getElementById("cancelBtn");

var categoryCancel = document.getElementById("categoryCancel");

var editCategory =  document.getElementById("editCategory");


// var hideName = document.getElementsByClassName('deleteName');

foodEdit.onclick = function(){
       
    document.getElementById('foodNameinput').readOnly = false;
    document.getElementById('foodPriceinput').readOnly = false;
    document.getElementById('foodCategoryinput').readOnly = false;
    document.getElementById('foodCategoryInputDL').readOnly = false;
    document.getElementById('foodPhotoinput').disabled = false;

console.log('iwuefhiufhe');



    //SHOW HIDE BUTTONS
    document.getElementById('popUp1V2').style.visibility = "visible";
    document.getElementById('cancelBtn').style.visibility = "visible";
    document.getElementById('backBtn').style.visibility = "hidden";

}

cancelBtn.onclick = function(){

    document.getElementById('foodNameinput').readOnly = true;
    document.getElementById('foodPriceinput').readOnly = true;
    document.getElementById('foodCategoryinput').readOnly = true;
    document.getElementById('foodCategoryInputDL').readOnly = true;
    document.getElementById('foodPhotoinput').disabled = true;

        //SHOW HIDE BUTTONS
        document.getElementById('popUp1V2').style.visibility = "hidden";
        document.getElementById('cancelBtn').style.visibility = "hidden";
        document.getElementById('backBtn').style.visibility = "visible";
    


}

editCategory.onclick = function(){


    document.getElementById('CategoryInputDL').readOnly = false;
    document.getElementById('categoryPhotoinput').disabled = false;

            //SHOW HIDE BUTTONS
            document.getElementById('categoryConfirm').style.display = "flex";
            document.getElementById('categoryCancel').style.display = "flex";
            document.getElementById('categoryBack').style.display = "none";
}


categoryCancel.onclick = function(){


    document.getElementById('CategoryInputDL').readOnly = true;
    document.getElementById('categoryPhotoinput').disabled = true;

        //SHOW HIDE BUTTONS
        document.getElementById('categoryConfirm').style.display = "none";
        document.getElementById('categoryCancel').style.display = "none";
        document.getElementById('categoryBack').style.display = "flex";
    


}

