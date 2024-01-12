console.log("loaded");
const Email = document.getElementById("Email");
const Password = document.getElementById("Password");
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const submit = document.getElementById("submit");

submit.addEventListener("click", function (e) {
  e.preventDefault();
  if (Email.value == "") {
    alert("Email cannot be empty");
    return;
  }
  if (!emailRegex.test(Email.value)) {
    alert("Invalid email format");
    return;
  }
  if (Password.value == "") {
    alert("Password cannot be empty");
    return;
  }
  const data = {
    email: Email.value,
    password: Password.value,
  };
  axios
    .post("/api/user/login", data)
    .then((response) => {
      response.data;
      if (response.status == 200) {
        document.cookie = `AUTHORIZATION=${response.data.jwt}`;
        if (response.data.role == "admin") {
          alert("admin");
          window.location.href = "/tags";
        } else if (response.data.role == "author") {
          alert("author");
          window.location.href = "/wikis";
        }
      } else {
        alert(response.data.message);
      }
    })
    .catch((error) => {
      if (error.response.status == 401) {
        alert("Invalid credentials");
      }
    });
  if (error.response.status == 401) {
    alert("Invalid credentials");
  }
});
