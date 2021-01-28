import axios from "axios";

const form = document.querySelector("form");
const btnLogin = document.querySelector("#btn-login");
const messages = document.querySelector("#messages");

btnLogin.addEventListener("click", async function (event) {
    event.preventDefault();

    try {
        const formData = new FormData(form);
        const { data } = await axios.post("/login", formData);

        messages.innerHTML = `
          <div class="success">${data.message}</div>
        `;

        setTimeout(() => {
            messages.innerHTML = "";
            window.location.href = "/";
        }, 3000);

        console.log(data);
    } catch (error) {
        const errorsValidate = error.response?.data;

        if (errorsValidate) {
            for (const index in errorsValidate) {
                if (errorsValidate.hasOwnProperty(index)) {
                    messages.innerHTML += `
                    <div class="error">${errorsValidate[index]}</div>
                  `;
                }
            }
            setTimeout(() => {
                messages.innerHTML = "";
            }, 3000);
        }
    }
});
