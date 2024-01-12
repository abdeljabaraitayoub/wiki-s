console.log("loaded");
const news = document.getElementById("news");
staistics();
loadwikis();
function staistics() {
  axios.get("/api/statistiques").then((response) => {
    console.log(response.data);
    let data = response.data;
    let wikis = document.getElementById("wikis");
    let users = document.getElementById("users");
    let tags = document.getElementById("tags");
    let category = document.getElementById("category");
    wikis.innerHTML = data.wiki;
    users.innerHTML = data.user;
    category.innerHTML = data.category;
    tags.innerHTML = data.tags;
  });
}

function loadwikis() {
  axios.get("/api/wikis/admin").then((response) => {
    let data = response.data;
    for (let i = 0; i < 5; i++) {
      news.innerHTML += `<div class="post-item clearfix">
                <img src="assets/img/news-1.jpg" alt="" />
                <h4><a href="/wiki?id=${data[i].id}">${data[i].title}</a></h4>
                <p>
                  ${data[i].description}
                </p>
              </div>
      
      `;
    }
  });
}
