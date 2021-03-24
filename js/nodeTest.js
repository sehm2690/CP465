////////////////////////////////////////
////PRICE INFORAMTION CODE?


	const http = require("https");

	const options = {
		"method": "GET",
		"hostname": "apidojo-yahoo-finance-v1.p.rapidapi.com",
		"port": null,
		"path": "/market/v2/get-quotes?region=US&symbols=SFDSDFDS",
		"headers": {
			"x-rapidapi-key": "1351fd3e73mshf9c79221e8acff1p127f35jsn6272bcbd7b09",
			"x-rapidapi-host": "apidojo-yahoo-finance-v1.p.rapidapi.com",
			"useQueryString": true
		}
	};

	const req = http.request(options, function (res) {
		const chunks = [];

		res.on("data", function (chunk) {
			chunks.push(chunk);
		});

		res.on("end", function () {
			const body = Buffer.concat(chunks);
			console.log(body.toString());
		});
	});

    console.log("AMD")

	req.end();

// const http = require("https");

// const options = {
// 	"method": "GET",
// 	"hostname": "apidojo-yahoo-finance-v1.p.rapidapi.com",
// 	"port": null,
// 	"path": "/news/list?category=generalnews&region=US",
// 	"headers": {
// 		"x-rapidapi-key": "1351fd3e73mshf9c79221e8acff1p127f35jsn6272bcbd7b09",
// 		"x-rapidapi-host": "apidojo-yahoo-finance-v1.p.rapidapi.com",
// 		"useQueryString": true
// 	}
// };


// const req = http.request(options, function (res) {
// 	const chunks = [];

// 	res.on("data", function (chunk) {
// 		chunks.push(chunk);
// 	});

// 	res.on("end", function () {
// 		const body = Buffer.concat(chunks);
// 		console.log(body.toString());
// 	});
// });

// req.end();






/*

user inputs ticker -> add it to the datbase


*/