const formRecipe = document.getElementById("form-recipe");
const recipeView = document.getElementById("view");
const ingredientInput = document.getElementById("ingredient-name");
const ingredientList = document.getElementById("ingredient-temp-list");
const ingredientButton = document.getElementById("newIng");

const keyIngredient = "ingredientList";
const keyRecipe = "recipeList";

let ingredientListFV = [];


document.addEventListener("DOMContentLoaded", function() {
    //Agregar evento al formulario
    formRecipe.addEventListener("submit", submitRecipe);
    paintRecipe();
    ingredientListFV = [];
});

function submitRecipe(e) {
    e.preventDefault(); 
    e.stopPropagation();

    let recipe = {
        id: Date.now(),
        title: formRecipe["title"].value,
        img_url: formRecipe["img_url"].value,
        description: formRecipe["description"].value,
        ing: ingredientInput.value
    };

    let list = getRecipe();

    list.push(recipe);

    localStorage.setItem(keyRecipe, JSON.stringify(list));

    paintRecipe();
}

function paintRecipe() {
    let list = getRecipe();

    let html = '';

    for(var i = 0; i < list.length; i++) {
        html += 
            `<h1 class="[ color-primary ] [ text-center ]">Listado de recetas</h1>
            <div class="[ row ] [ flex ]" data-state="wrap">
                <div class="[ col ]">
                    <div class="[ card ] [ bg-secondary color-white ] [ radius shadow ]" card-id="${i.id}">
                        <img src="${i.img_url}" alt="">
                        <div class="[ flow ]">
                            <h5>${i.title}</h5>
                            <div class="[ flex ]" data-state="justify-between">
                                <button class="[ btn ]" data-state="white" onclick="getRecipe(${i.id})">Ver</button>
                                <button class="[ btn ]" data-state="warning" onclick="deleteRecipe(${i.id})">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
    }

    recipeView.innerHTML = html;
}

function getRecipe() {
    let list = JSON.parse(localStorage.getItem(keyRecipe));

    if (list === null) {
        return [];
    }
    else {
        return list;
    }
}

function deleteRecipe(id) {
    let list = getRecipe();

    list = list.filter(i => i.id !== id);

    localStorage.setItem(keyRecipe, JSON.stringify(list));

    let recipe = document.getElementById(id);

    recipe.className += ' hide';

    setTimeout(() => {
        ingredient.remove();
    }, 300);
}




document.addEventListener("DOMContentLoaded", function() {
    //Agregar evento al formulario
    ingredientButton.addEventListener("click", submitIngredient);

    
    paintIngredient();
});

function submitIngredient(e) {
    e.preventDefault(); 
    e.stopPropagation();

    let ingredient = {
        id: Date.now(),
        text: ingredientInput.value
    };

    ingredientListFV.push(ingredientInput.value);
   
    let ingredientListTemp = getIngredient();

    //console.log(ingredient);

    ingredientListTemp.push(ingredient);

    localStorage.setItem(keyIngredient, JSON.stringify(ingredientListTemp));

    paintIngredient();
}

function paintIngredient() {
    let list = getIngredient();

    let html = '';

    for(var i = 0; i < list.length; i++) {
        html += 
            `<li class="[ bg-white color-gray ]" id="${list[i].id}">
                ${list[i].text}
                <button class="close" type="button" onclick="deleteIngredient(${list[i].id})">X</button>
            </li>`;
    }


    ingredientList.innerHTML = html;
}


function getIngredient() {
    let list = JSON.parse(localStorage.getItem(keyIngredient));

    if (list === null) {
        return [];
    }
    else {
        return list;
    }
}

function deleteIngredient(id) {
    let list = getIngredient();

    list = list.filter(i => i.id !== id);

    localStorage.setItem(keyIngredient, JSON.stringify(list));

    let ingredient = document.getElementById(id);

    ingredient.className += ' hide';

    setTimeout(() => {
        ingredient.remove();
    }, 300);
}