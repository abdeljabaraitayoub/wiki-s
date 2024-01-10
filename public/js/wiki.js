const urlParams = new URLSearchParams(window.location.search);
let id = urlParams.get("id");
let title = document.getElementsByClassName("title");
let description = document.getElementById("description");
let content = document.getElementById("content");
let author = document.getElementById("author");
let date = document.getElementById("date");
let tags = document.getElementById("tags");
function checked() {
  const checkedd = document.getElementById("inlineCheckbox1");
  console.log(checkedd);
}

axios
  .get(`/api/wikis/load?id=${id}`)
  .then(function (response) {
    data = response.data[0];
    // console.log(title);
    title[0].innerText = data.title;
    title[1].innerText = data.title;

    description.innerText = data.description;
    author.innerText = data.username;
    date.innerText = data.creationDate;

    content.innerHTML = data.content;
    // tags.innerText = data.tags;
    // console.log(response.data);
    id = data.wikiID;

    axios.get(`/api/tag/load?id=${id}`).then(function (response) {
      // handle success
      tagsjson = response.data;

      tagsjson.forEach((tag) => {
        tags.innerHTML += `<a href="#tags">${tag.Nom}</a>
        <a href="">  </a>
        `;
      });
      tags.innerHTML += `
        <span >...</span>
        `;
    });
  })
  .catch(function (error) {
    console.log(error);
  });
