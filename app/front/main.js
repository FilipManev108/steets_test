import sendRequest from "./exports/ajax.js";
import validate from "./exports/validator.js";

const mainForm = $("#main_form");

mainForm.submit((e) => {
    e.preventDefault();
    const year = $("#year").val();
    validate(year, $("#error"));
    sendRequest("./app/back/process/write.php", { input: year })
        .then((res) => {
            if (res == "success") {
                sendRequest("./app/back/process/read.php", { input: year })
                    .then((res) => JSON.parse(res))
                    .then((data) => {
                        $("#display_response").html("");
                        let count = 1;
                        data.forEach((e) => {
                            $("#display_response").append(`<tr>
                                                                <th scope="row">${count}</th>
                                                                <td>${e.id}</td>
                                                                <td>${e.year}</td>
                                                                <td>${e.encrypted_day}</td>
                                                            </tr>`);
                            count++;
                        });
                        $("table").removeClass("d-none");
                        $("#year").val("");
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
