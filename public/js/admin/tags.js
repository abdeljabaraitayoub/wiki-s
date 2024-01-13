console.log("tags.js");

let container = document.querySelector("tbody");
const title = document.getElementById("titlee");
header = document.getElementById("exampleModalLabel");

const btn = document.getElementById("submit");
const createbtn = document.getElementById("create");

btn.addEventListener("click", submit);
createbtn.addEventListener("click", create);

loadtags();

function deleteTag(e) {
  e.preventDefault();
  console.log(e.currentTarget.dataset.id);
  let id = e.currentTarget.dataset.id;
  const options = {
    url: "/api/tag/",
    method: "DELETE",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json;charset=UTF-8",
    },
    data: {
      id: id,
    },
  };
  axios(options)
    .then((response) => {
      if (response.status == 200) {
        alert("Wiki deleted successfully!");
        loadWikis();
      }
    })
    .catch((error) => {
      if (error.response === 401) {
        window.location.href = "/"; // Redirect to login page
      }
    });
  loadtags();
}

function loadtags() {
  axios.get("/api/tag/").then((response) => {
    data = response.data;
    console.log(data);
    container.innerHTML = "";
    data.forEach((tag) => {
      container.innerHTML += `
      <tr>
                    <th scope="row">${tag.id}</th>
                    <td>${tag.Nom}</td>
                    <td><div class="d-flex">
                        <div>
                            <a href="#" onclick="deleteTag(event)" data-id="${tag.id}"  class="m-2"><i class="delete ri-delete-bin-6-line m-2"></i></a>
                            <a href="#modify"  onclick="modifyTag(event)" data-id="${tag.id}" class="m-2"  data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="ri-edit-line m-auto"></i></a>
                        </div>
                    </td>
        </tr>
    `;
    });
  });
}
function clicked() {
  btn.style.display = "none";
  createbtn.style.display = "block";
  title.value = "";
  header.innerHTML = "Create Tag";
}
function modifyTag(e) {
  btn.style.display = "block";
  createbtn.style.display = "none";
  let ID = e.currentTarget.dataset.id;
  axios.get(`/api/tag/loadsignletag?id=${ID}`).then((response) => {
    tag = response.data;
    title.value = tag[0].Nom;
    btn.setAttribute("data-id", tag[0].id);
  });
}

function submit(e) {
  e.preventDefault();
  let id = e.currentTarget.dataset.id;
  console.log(title.value);
  const options = {
    url: "/api/tag/",
    method: "PUT",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json;charset=UTF-8",
    },
    data: {
      id: id,
      title: title.value,
    },
  };
  axios(options).then((response) => {
    console.log(response.status);
    if (response.status == 200) {
      alert("Tag modified successfully!");
      loadtags();
    }
  });
}

function create(e) {
  e.preventDefault();
  console.log(title.value);
  const options = {
    url: "/api/tag/",
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json;charset=UTF-8",
    },
    data: {
      title: title.value,
    },
  };
  axios(options).then((response) => {
    console.log(response.status);
    if (response.status == 200) {
      alert("Tag created successfully!");
      loadtags();
    }
  });
}
