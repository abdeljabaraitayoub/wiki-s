let button = document.getElementById("button");
let createbutton = document.getElementById("buttoncreate");

let cardtitle = document.getElementById("title");
const remove = document.getElementsByClassName("delete");
let id;
const table = document.querySelector("tbody");
const checked = [];
loadWikis();

// LOAD THE WIKIS
function loadWikis() {
  axios.get("/api/wikis/admin").then((response) => {
    const data = response.data;
    console.log(data);
    table.innerHTML = "";
    data.forEach((wiki) => {
      let archiveIconHTML = "";

      if (wiki.DeleteDate == null) {
        archiveIconHTML = `<a  onclick="archive(event)" data-id="${wiki.wikiID}" class="m-2"><i class="delete ri-eye-off-fill"></i></a>`;
      } else {
        archiveIconHTML = `<a  onclick="desarchive(event)" data-id="${wiki.wikiID}" class="m-2"><i class="ri-eye-line"></i></a>`;
      }

      table.innerHTML += `<tr>
              <td>${wiki.title}</td>
              <td>${wiki.username}</td>
              <td>${wiki.description}</td>
              <td>${wiki.creationDate}</td>
              <td>${wiki.DeleteDate}</td>
              <td>
              <div class="d-flex justify-content-center">
              <div>
                  ${archiveIconHTML}
              </div>
              </div>
              </td>
              </tr>`;
    });
  });
}

// deletewikis

function archive(e) {
  id = e.currentTarget.dataset.id;
  console.log(id);
  const options = {
    url: "/api/wikis/archive",
    method: "PATCH",
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
        loadWikis();
      }
    })
    .catch((error) => {
      console.error(error);
    });
}
function desarchive(e) {
  id = e.currentTarget.dataset.id;
  console.log(id);
  const options = {
    url: "/api/wikis/desarchive",
    method: "PATCH",
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
        loadWikis();
      }
    })
    .catch((error) => {
      console.error(error);
    });
}
