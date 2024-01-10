console.log("categories.js");

let container = document.querySelector("tbody");
let title = document.getElementById("titlee");
header = document.getElementById("exampleModalLabel");

const btn = document.getElementById("submit");
const createbtn = document.getElementById("create");

btn.addEventListener("click", submit);
createbtn.addEventListener("click", create);

loadcategories();

function deleteTag(e) {
  e.preventDefault();
  console.log(e.currentTarget.dataset.id);
  let id = e.currentTarget.dataset.id;
  const options = {
    url: "/api/categorie",
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
      console.log(`Deleted post with ID ${id}`);
      if (response.status == 200) {
        alert("Wiki deleted successfully!");
        loadWikis();
      }
    })
    .catch((error) => {
      console.error(error);
    });
  loadcategories();
}

function loadcategories() {
  axios.get("/api/categorie").then((response) => {
    data = response.data;
    console.log(data);
    container.innerHTML = "";
    data.forEach((category) => {
      container.innerHTML += `
      <tr>
                    <th scope="row">${category.id}</th>
                    <td>${category.title}</td>
                    <td><div class="d-flex">
                        <div>
                            <a href="#" onclick="deleteTag(event)" data-id="${category.id}"  class="m-2"><i class="delete ri-delete-bin-6-line m-2"></i></a>
                            <a href="#modify"  onclick="modifyTag(event)" data-id="${category.id}" class="m-2"  data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="ri-edit-line m-auto"></i></a>
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
  axios.get(`/api/categorie/loadsinglecategory?id=${ID}`).then((response) => {
    category = response.data;
    title.value = category[0].title;
    btn.setAttribute("data-id", category[0].id);
  });
}

function submit(e) {
  e.preventDefault();
  let id = e.currentTarget.dataset.id;
  console.log(title.value);
  const options = {
    url: "/api/categorie",
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
      loadcategories();
    }
  });
}

function create(e) {
  e.preventDefault();
  console.log(title.value);
  const options = {
    url: "/api/categorie",
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
      loadcategories();
    }
  });
}
