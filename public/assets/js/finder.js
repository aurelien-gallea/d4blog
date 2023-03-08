const searchBar = document.querySelector("#searchBar");
const found = document.querySelectorAll(".found");
const selectDate = document.querySelector('#selectDate');
const filterDate = document.querySelector('#filterDate');

let arrayArticles = [];


for (let a = 0; a <found.length; a++) {
  arrayArticles.push(found[a]);
  
}

let reverseArt =  arrayArticles.reverse();
console.log(reverseArt[0].innerHTML);
console.log(arrayArticles[0][0]);
arrayArticles.reverse()
console.log(arrayArticles.innerHTML);
// notre belle barre de recherche
searchBar.addEventListener('keyup', () => {
    
    // on fait apparaître le résutat de notre recherche
    for (let i = 0; i < found.length; i++) {
      const result = found[i];
      // j'ai remplacé textContent par innerHTML, car je voulais avoir accès à la date de modification dans le tooltip
      let word = result.innerHTML.toLowerCase(); 
      
      if(word.includes(searchBar.value.toLowerCase()))  {
        
        result.classList.remove("d-none");
      } else {
        result.classList.add("d-none");

      }   
    }   
  });

// notre option de slection dans la barre de recherche 
selectDate.addEventListener('change', () => {
  // c'est parti pour les boucles
  if (selectDate.value === "asc") {
    filterDate.innerHTML="";
    for (let j = 0; j < found.length; j++) {
      filterDate.append(reverseArt[j].innerHTML.toString());  
    }
  } else {
    filterDate.innerHTML="";
    for (let j = 0; j < found.length; j++) {
      filterDate.innerHTML += arrayArticles[j].innerHTML;  
    }
    
  }

});