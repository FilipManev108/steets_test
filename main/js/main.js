import sendRequest from "./exports/ajax.js";

const mainForm = $("#main_form");

mainForm.submit((e) => {
    e.preventDefault();
    const year = $("#year").val();
    // console.log(year)
    sendRequest("./main/php/process/write.php", { input: year })
        .then((res) => {
            console.log(res);
            if (res == "success") {
                sendRequest("./main/php/process/read.php", { input: year })
                    .then((res) => {
                        console.log(JSON.parse(res));
                    })
                    .catch((e) => {
                        console.log(e);
                    });
            }
        })
        .catch((e) => {
            console.log(e);
        });
    
    
});
