const buttonRegister = document.querySelector(".btn-register");
const nameSelector = document.querySelector(".name");
const emailSelector = document.querySelector(".email");
const passwordSelector = document.querySelector(".password");

// let name = document.getElementById("name").value;
// let email = document.getElementById("email").value;
// let password = document.getElementById("password").value;

function handleClickRegister(event) {
    event.preventDefault();

    const nameValue = nameSelector.value;
    const emailValue = emailSelector.value;
    const passwordValue = passwordSelector.value;
     
    const data = {
        name: nameValue,
        email: emailValue,
        password: passwordValue,
        roll: 1
    }

    axios.post("http://localhost:8000/api/v1/register.php", data)
    .then(function (response) {
        if (response.data.code === 201) {
            window.location.href = "/client/login/login.html"
        }
    })
    .catch(function (error) {
        console.log(error);
    });
}

buttonRegister.addEventListener("click", handleClickRegister);
