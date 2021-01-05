const options = {
    data() {
        return {
            recipes : "",
            name : "",
            time : "",
            preparation : "",
            ingredients : "",
            people : ""
        }
    },
    methods : {
        deleteRecipe($id){
            fetch(`http://localhost:8089/api`, {
                method: 'DELETE',
                body:
                `
                {
                    "id" : ${$id}
                }
                `
            }).then(response => response.json());
            fetch("http://localhost:8089/api").then((response) => {
                response.json().then((data) => {
                    this.recipes = data;
                });
              });
              alert("Recette supprimée !")
        },
        postRecipe(){
            if (!this.name || !this.preparation || !this.ingredients || !this.time || !this.people)
            {
                alert("Il faut remplir tous les champs pour ajouter une recette !")
                return;
            }
              
            const data = new FormData();
            data.append('name', `${this.name}`);
            data.append('people', `${this.people}`);
            data.append('time', `${this.time}`);
            data.append('ingredients', `${this.ingredients}`);
            data.append('preparation', `${this.preparation}`);
            fetch(`http://localhost:8089/api`, {
                method: 'POST',
                body: data,
            }).then(response => response.json());
            fetch("http://localhost:8089/api").then((response) => {
                response.json().then((data) => {
                    this.recipes = data;
                });
              });
            alert("Recette ajoutée !")
            this.name = "";
            this.ingredients = "";
            this.preparation = "";
            this.time = "";
            this.people = "";
        }
    },
    mounted() {
        fetch("http://localhost:8089/api").then((response) => {
        response.json().then((data) => {
            this.recipes = data;
        });
      });
    },
}

const app = Vue.createApp(options);
app.mount("#app");