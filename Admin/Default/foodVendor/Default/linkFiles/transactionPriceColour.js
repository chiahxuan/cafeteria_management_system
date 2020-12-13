var priceClass = document.getElementsByClassName('trans_detail_price');
var priceValue = [];


for(i=0; i<priceClass.length; i++) {
    //Remove "RM" and whitespace
    priceValue[i] =  priceClass[i].innerText.replace(/Rm|RM|\s/g,'');
    //Convert data from string to float
    priceValue[i] = parseFloat(priceValue[i]);

    //If priceValue is negative, Price colour would be Red
    if(priceValue[i] < 0 ) {
        //priceClass[i].className.replace = ("reload_price" , " pay_price"  );  
        priceClass[i].className += " pay_price";
    }else {
        //Else, Price colour would be Green
        priceClass[i].className += " reload_price";
    }
}


