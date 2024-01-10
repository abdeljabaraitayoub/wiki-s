let button = document.getElementById("button");
let createbutton = document.getElementById("buttoncreate");
const Section = document.getElementById("modify");
Section.style.display = "none";

createbutton.addEventListener("click", submitform);
let cardtitle = document.getElementById("title");
const remove = document.getElementsByClassName("delete");
let id;
const table = document.querySelector("tbody");
const checked = [];
loadWikis();
getcategory();
gettags();

// load categories
function getcategory() {
  let container = document.getElementById("category");
  axios.get("/api/categorie").then((response) => {
    data = response.data;
    data.forEach((category) => {
      container.innerHTML += `<option value="${category.id}">${category.title}</option>`;
    });
  });
}

// load tags
function gettags() {
  let container = document.getElementById("checkboxs");
  axios.get("/api/tag/").then((response) => {
    data = response.data;
    data.forEach((tag) => {
      container.innerHTML += ` <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="${tag.id}">
            <label class="form-check-label">${tag.Nom}</label>
            </div>`;
    });
    checkboxx = document.querySelectorAll(".form-check-input");
    checkboxx.forEach((checkbox) => {
      checkbox.addEventListener("change", function () {
        if (this.checked) {
          addtag(this.value);
        } else {
          deletetag(this.value);
        }
      });
    });
  });
}

// LOAD THE WIKIS
function loadWikis() {
  axios.get("/api/wikis/authorload?id=2").then((response) => {
    const data = response.data;
    console.log(data);
    table.innerHTML = "";
    data.forEach((wiki) => {
      table.innerHTML += `<tr>
                <td>${wiki.title}</td>
                <td>${wiki.description}</td>
                <td>${wiki.creationDate}</td>
                <td>
                <div class="d-flex justify-content-center">
                <div>
                        <a href="/wiki?id=${wiki.wikiID}" class="m-2"><i class="ri-eye-line"></i></a>
                        <a href="#" onclick="deleteWiki(event)" data-id="${wiki.wikiID}"  class="m-2"><i class="delete ri-delete-bin-6-line m-2"></i></a>
                        <a href="#modify" onclick="loadsiglewiki(event)" data-id="${wiki.wikiID}" class="m-2"><i class="ri-edit-line m-auto"></i></a>
                        </div>
                        </div>
                        </td>
                        </tr>`;
    });
  });
}
//clear inputs
function clearinputs() {
  let note = document.getElementsByClassName("note-editable");
  let title = document.getElementById("inputNanme4");
  let description = document.getElementById("description");
  let category = document.getElementById("category");
  title.value = "";
  description.value = "";
  category.value = "";
  note[0].innerHTML = "";
  button.setAttribute("data-id", "");
  cardtitle.innerHTML = "Create a wiki";
  createbutton.style.display = "inline";
  button.style.display = "none";
  Section.style.display = "block";
}

// load a single wiki
function loadsiglewiki(e) {
  Section.style.display = "block";
  createbutton.style.display = "none";
  button.style.display = "inline";

  id = e.currentTarget.dataset.id;
  axios
    .get(`/api/wikis/load?id=${id}`)
    .then(function (response) {
      console.log(response.data);
      data = response.data[0];
      let note = document.getElementsByClassName("note-editable");
      let content = note[0].innerHTML;
      let title = document.getElementById("inputNanme4");
      let description = document.getElementById("description");
      let category = document.getElementById("category");
      let button = document.getElementById("button");

      content.innerHTML = data.content;
      title.value = data.title;
      description.value = data.description;
      category.value = data.CategorieID;
      note[0].innerHTML = data.content;
      button.innerHTML = "Modify";
      button.setAttribute("data-id", data.wikiID);
      cardtitle.innerHTML = "Modify a wiki";
    })
    .catch(function (error) {
      console.log(error);
    });
}

// modifyWiki

function modifyWiki(e) {
  e.preventDefault();
  id = e.currentTarget.dataset.id;
  let note = document.getElementsByClassName("note-editable");
  let content = note[0].innerHTML;
  let title = document.getElementById("inputNanme4").value;
  let description = document.getElementById("description").value;
  let category = document.getElementById("category").value;

  // Input validation
  if (title.trim() === "") {
    alert("Please enter a title.");
    return;
  }

  if (description.trim() === "") {
    alert("Please enter a description.");
    return;
  }

  if (category.trim() === "") {
    alert("Please select a category.");
    return;
  }

  console.log(category);
  const options = {
    url: "/api/wikis",
    method: "PUT",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json;charset=UTF-8",
    },
    data: {
      id: id,
      title: title,
      description: description,
      content: content,
      categorie: category,
    },
  };
  axios(options).then((response) => {
    console.log(response.status);
    if (response.status == 200) {
      alert("Wiki modified successfully!");
      Section.style.display = "none";
    }
  });
  WikiTag(checked, id);
  loadWikis();
  checked = [];
  clearinputs();
}
// create a wikitag
function addtag(id) {
  checked.push(id);
  console.log(checked);
}

function deletetag(id) {
  const index = checked.indexOf(id);
  if (index > -1) {
    checked.splice(index, 1);
    console.log(checked);
  }
}
function WikiTag(checked, wiki) {
  checked.forEach((check) => {
    console.log(check);
    const options = {
      url: "api/Wikitag/",
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json;charset=UTF-8",
      },
      data: {
        wikiID: wiki,
        tagID: check,
      },
    };
    axios(options).then((response) => {
      console.log(response.status);
    });
  });
}

// deletewikis
function deleteWiki(e) {
  id = e.currentTarget.dataset.id;
  console.log(id);
  clearinputs();
  const options = {
    url: "/api/wikis",
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
}
function submitform(e) {
  e.preventDefault();
  let note = document.getElementsByClassName("note-editable");
  let content = note[0].innerHTML;
  let title = document.getElementById("inputNanme4").value;
  let description = document.getElementById("description").value;
  let category = document.getElementById("category").value;
  let id = document.getElementById("id").value;

  // Input validation
  if (title.trim() === "") {
    alert("Please enter a title.");
    return;
  }

  if (description.trim() === "") {
    alert("Please enter a description.");
    return;
  }

  if (category.trim() === "") {
    alert("Please select a category.");
    return;
  }

  console.log(category);
  const options = {
    url: "/api/wikis",
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json;charset=UTF-8",
    },
    data: {
      id: id,
      title: title,
      description: description,
      content: content,
      categorie: category,
    },
  };
  axios(options).then((response) => {
    console.log(response.status);
    if (response.status == 200) {
      alert("Wiki created successfully!");
      Section.style.display = "none";
    }
    getid(title);
  });
  loadWikis();
  checked = [];
  clearinputs();
}
function getid(title) {
  axios.get(`/api/wikis/get_id?title=${title}`).then((response) => {
    wikiID = response.data[0].wikiID;
    WikiTag(checked, wikiID);
  });
}
