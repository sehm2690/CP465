const fs = require('fs')

fs.readFile('./MPC_AAPL_FSR.json', 'utf8', (err, jsonString) => {
    if (err) {
        console.log("Error reading file from disk:", err)
        return
    }
    try {
        const stockInfo = JSON.parse(jsonString)
        console.log(stockInfo.quoteResponse.result.length)
        var i = 0;
        while (i < stockInfo.quoteResponse.result.length) { 
            console.log("Market price for", stockInfo.quoteResponse.result[i].symbol,"is:", stockInfo.quoteResponse.result[i].regularMarketPrice)
            i+=1
        }
       
    } catch(err) {
        console.log('Error parsing JSON string:', err)
    }
})
