var veri=fetch("sorular.json")
.then(response => response.json())
.then(data => {
    console.log(data);
    return data;
});