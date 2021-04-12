function purchasePopup() {
    var txt;
    var r = confirm("Press a button!");
    if (r == true) {
        txt = "You pressed OK!";
    } else {
        txt = "You pressed Cancel!";
    }
    document.getElementById("test").innerHTML = txt;
}

function getStockInfo() {
    var ticker = document.getElementByName("tickersearch")[0].value;
    //console.log(ticker);
    //window.print(ticker);

    var url = "https://finance.yahoo.com/quote/";
    var url2 = url.concat(ticker);
    window.location.replace("https://finance.yahoo.com");
    //window.open(url2, '_blank');
    // location.href = "http://stackoverflow.com";

}