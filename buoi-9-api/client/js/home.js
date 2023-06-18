function getListNews() { 
    axios
    .get(
        "http://localhost:8000/api/v1/listNews.php", 
        {
            headers: {
                "Authorization": `Bearer ${localStorage.getItem("token")}`
            }
        }
    )
    .then(function (response) {
        if (response.data.code === 200) { 
            const html = response.data.data.map(
                item => `
                    <div class="card item-news">
                        <img class="card-img-top" src="${item.image}" alt="${item.title}">
                        <div class="card-body">
                            <h5 class="card-title">${item.title}</h5>
                            <p class="card-text">${item.description}</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                `
            ).join('')
    
            document.querySelector(".list-news").innerHTML = html
        }
    })
    .catch(function (error) {
        console.log(error);
    });
}

getListNews();