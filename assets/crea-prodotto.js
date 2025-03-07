document.addEventListener("alpine:init", () => {
  Alpine.data("shoppingList", () => ({
    list: [],
    quantita: 0,
    name: "",
    loading:false,

    async saveList() {
      const data = JSON.stringify({ list: this.list });

      try {
        this.loading=true
        const request = await fetch("./partials/crea-prodotto.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: data,
        });
        this.loading=false;
      } catch (error) {
        console.error(`errore nel inviare la richiesta:${error}`);
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
