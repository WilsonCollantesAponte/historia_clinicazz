document.getElementById("search-input").addEventListener("keyup", getCodigos);

function getCodigos() {
  let inputCP = document.getElementById("search-input").value;
  let lista = document.getElementById("lista");

  if (inputCP.length > 0) {
    let url = "../php/getCodigos.php";
    let formData = new FormData();
    formData.append("search-input", inputCP);

    fetch(url, {
      method: "POST",
      body: formData,
      mode: "cors", //Default cors, no-cors, same-origin
    })
      .then((response) => response.json())
      .then((data) => {
        lista.style.display = "block";
        lista.innerHTML = data;
      })
      .catch((err) => console.log(err));
  } else {
    lista.style.display = "none";
  }
}

function mostrar(cp) {
  lista.style.display = "none";
  alert("CP: " + cp);
}
