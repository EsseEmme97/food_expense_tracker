document.addEventListener("alpine:init", () => {
  Alpine.data("monitoraCosti", () => ({
    costs: [],
    filteredCosts: [],
    mesi: [
      "Gennaio",
      "Febbraio",
      "Marzo",
      "Aprile",
      "Maggio",
      "Giugno",
      "Luglio",
      "Agosto",
      "Settembre",
      "Ottobre",
      "Novembre",
      "Dicembre",
    ],
    data_spesa: null,
    importo: 0,

    async init() {
      const response = await fetch("./recupera-costi.php");
      const json = await response.json();
      this.costs = json;
      this.filteredCosts = json;
    },

    async addCost() {
      const data = { data_spesa: this.data_spesa, importo: this.importo };
      this.costs.push(data);
      const request = await fetch("./aggiungi-costo.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });

      const response = await request.json();
    },

    calculateTotal() {
      const tot = this.filteredCosts.reduce(
        (sum, el) => sum + parseInt(el.importo),
        0
      );
      return `tot: ${tot}€`;
    },

    filteredMonth(e) {
      const selecteMonth = e.target.value;
      if (selecteMonth == "tutti") {
        this.filteredCosts = this.costs;
        return;
      }
      this.filteredCosts = this.costs.filter((element) => {
        return (
          this.mesi[new Date(element.data_spesa).getMonth()] == selecteMonth
        );
      });
    },

    async dropCost(id) {
      if (window.confirm("sei sicuro di voler elimiare questo elemento?")) {
        this.filteredCosts = this.filteredCosts.filter(el => el.id != id);
        this.costs = this.costs.filter(el => el.id != id);
        const request = await fetch("./elimina-costo.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ id }),
        });
      }
    },


  }));
});
