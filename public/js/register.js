console.log("loaded");
const Email = document.getElementById("Email");
const Username = document.getElementById("Username");
const Password = document.getElementById("Password");
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

const submit = document.getElementById("submit");

submit.addEventListener("click", function (e) {
  e.preventDefault();
  if (Email.value == "") {
    alert("Email cannot be empty");
  }

  if (!emailRegex.test(Email.value)) {
    alert("Invalid email format");
  }
  if (Username.value == "") {
    alert("Username cannot be empty");
  }
  if (Password.value == "") {
    alert("Password cannot be empty");
  }

  const data = {
    email: Email.value,
    username: Username.value,
    password: Password.value,
  };

  axios
    .post("api/user/register", data)
    .then((response) => {
      console.log(response.status);
      if (response.status == 200) {
        alert("Registered Successfully");
        window.location.href = "/login";
      } else {
        alert(response.data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});
