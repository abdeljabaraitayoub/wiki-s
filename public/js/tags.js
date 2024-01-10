console.log("tags.js");
let container = document.querySelector("tbody");
let title = document.getElementById("name");
const btn = document.getElementById("submit");
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
      console.log(`Deleted post with ID ${id}`);
      if (response.status == 200) {
        alert("Wiki deleted successfully!");
        loadWikis();
      }
    })
    .catch((error) => {
      console.error(error);
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
                            <a href="#modify" onclick="modifyTag(event)" data-id="${tag.id}" class="m-2"  data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="ri-edit-line m-auto"></i></a>
                        </div>
                    </td>
        </tr>
    `;
    });
  });
}

function singleTag(id) {}

function modifyTag(e) {
  let id = e.currentTarget.dataset.id;
  axios.get(`/api/tag/loadsignletag?id=${id}`).then((response) => {
    data = response.data;
  });
  singleTag(id);
  console.log(id);
  title.value = data[0].Nom;
}

function submit() {}
