searchfun("", 1);

const container = document.querySelector("#container");
let searchvalue;
function searchfun(searchvalue, counter) {
  axios
    .get(`/api/wikis/read?search=${searchvalue}&page=${counter}&itemsPerPage=3`)
    .then(function (response) {
      const wiki = response.data;
      console.log(wiki);
      container.innerHTML = "";
      wiki.forEach((wiki) => {
        container.innerHTML += `
  <div class="post-preview"  >
  <a href="/wiki?id=${wiki.wikiID}">
      <h2 class="post-title">${wiki.title}</h2>
      <h3 class="post-subtitle">${wiki.description}</h3>
      </a>
  <p class="post-meta">
      Posted by
      <a href="#!">${wiki.username}</a>
      On ${wiki.creationDate}
  </p>
  </div>
<!-- Divider-->
<hr class="my-4" />
`;
      });
    });
}

const btn = document.querySelector("#btn");
let counter = 1;
btn.addEventListener("click", () => {
  counter++;
  searchfun(search.value, counter);
});

let search = document.querySelector("#search");
search.addEventListener("keyup", (e) => {
  let searchValue = e.target.value;
  console.log(searchValue);
  searchfun(searchValue, 1);
});
