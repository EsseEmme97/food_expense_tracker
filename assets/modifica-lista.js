document.addEventListener("alpine:init", () => {
  Alpine.data("shoppingList", () => ({
    list: [],
    quantita: 0,
    name: "",
    loading: false,

    async init() {
      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      const response = await fetch(
        `./recupera-prodotti.php?numero=${urlParams.get("numero")}`
      );
      const data = await response.json();
      this.list = JSON.parse(data.elements);
    },

    async updateList() {
      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      const data = JSON.stringify({
        id: urlParams.get("numero"),
        list: this.list,
      });
      try {
        this.loading = true;
        const request = await fetch("./aggiorna-prodotto.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: data,
        });
        this.loading = false;
      } catch (error) {
        console.error(`errore nel inviare la richiesta:${error}`);
      }
    },

    async duplicateList() {
      if (window.confirm("sei sicuro di voler duplicare la lista?")) {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        data = JSON.stringify({ id: urlParams.get("numero") });
        try {
          const request = await fetch("./duplica-lista.php", {
            method: "POST",
            body: data,
          });
        } catch (error) {
          console.error(error);
        }
      }
    },

    async deleteList() {
      if (window.confirm("vuoi davvero eliminare la lista?")) {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        data = JSON.stringify({ id: urlParams.get("numero") });
        try {
          const request = await fetch("./elimina-lista.php", {
            method: "POST",
            body: data,
          });
          window.location.href = "/partials/liste.php";
        } catch (error) {
          console.error(error);
        }
      }
    },

    addToList() {
      if (this.name.trim() && this.quantita > 0) {
        this.list.push({ name: this.name, quantita: this.quantita });
        this.quantita = 0;
        this.name = "";
      }
    },
  }));
});
