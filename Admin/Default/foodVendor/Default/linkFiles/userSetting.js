var profileEditName = document.getElementById('profileEditName');

var cancelBtn = document.getElementById('profileCancel');

profileEditName.onclick = function(){
    document.getElementById('profileConfirm').style.display = "flex";
    document.getElementById('profileCancel').style.display = "flex";
    document.getElementById('profileBack').style.display = "none";

    document.getElementById('profileNameInput').readOnly = false;

}

cancelBtn.onclick = function(){
    document.getElementById('profileConfirm').style.display = "none";
    document.getElementById('profileCancel').style.display = "none";
    document.getElementById('profileBack').style.display = "flex";

    document.getElementById('profileNameInput').readOnly = true;
}

function goBack() {
    window.history.back();
  }