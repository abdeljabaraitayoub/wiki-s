console.log("wikis.js loaded");
var wikiID;
const btn = document.getElementById("button");
btn.addEventListener("click", clicked);

const checked = [];
function clicked(event) {
  event.preventDefault();
  submitform();
}
console.log("createwiki.js");

getcategory();
gettags();

function getcategory() {
  let container = document.getElementById("category");
  axios.get("/api/categorie").then((response) => {
    // console.log(response.data);
    data = response.data;
    data.forEach((category) => {
      container.innerHTML += `<option value="${category.id}">${category.title}</option>`;
    });
  });
}

function gettags() {
  let container = document.getElementById("checkboxs");
  axios.get("/api/tag/").then((response) => {
    // console.log(response.data);
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

function submitform() {}

function addtag(id) {
  checked.push(id);
}

function deletetag(id) {
  const index = checked.indexOf(id);
  if (index > -1) {
    checked.splice(index, 1);
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
