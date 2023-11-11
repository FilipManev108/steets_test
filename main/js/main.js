import sendRequest from "./exports/ajax.js";

const mainForm = $("#main_form");
mainForm.submit((e) => {
    e.preventDefault();
    const year = $("#year").val();
    sendRequest("./main/php/processing/test.php", { q: year })
        .then((res) => {
            console.log(res);
        })
        .catch((e) => {
            console.log(e);
        });
});
