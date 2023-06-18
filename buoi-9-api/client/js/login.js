const buttonLogin = document.querySelector(".btn-login");
const emailSelector = document.querySelector(".email");
const passwordSelector = document.querySelector(".password");

function handleClickLogin(event) {
    event.preventDefault();

    const emailValue = emailSelector.value;
    const passwordValue = passwordSelector.value;
     
    const data = { 
        email: emailValue,
        password: passwordValue, 
    }

    axios.post("http://localhost:8000/api/v1/login.php", data)
    .then(function (response) {
        if (response.data.code === 200) {
            localStorage.setItem('token', response.data.token);
            window.location.href = "/client/home/home.html";
        } else {
            console.log(response.data.message);
        }
    })
    .catch(function (error) {
        console.log(error);
    });
}

buttonLogin.addEventListener("click", handleClickLogin);