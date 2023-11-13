import sendRequest from "./exports/ajax.js";

const mainForm = $("#main_form");

mainForm.submit((e) => {
    e.preventDefault();
    const year = $("#year").val();
    console.log(year)
    // sendRequest("./main/php/process/write.php", { input: year })
    //     .then((res) => {
    //         console.log(res);
    //     })
    //     .catch((e) => {
    //         console.log(e);
    //     });
});
