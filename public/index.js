const MainContent = () => {
  return (
    <div className="card">
      <div className="card-body">
        <div className="card-title">Formulaire de création</div>
        <p>Ajouter un produit à la facture</p>
        <div className="row">
            <div className="col-md-4 col-lg-4 col-xl-3">
              <div className="mb-3">
                <label for="profile" className="form-label">
                  Sélectionnez le produit
                </label>
                <select className="form-select " name="profile" id="profile">
                </select>
              </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-3">
            <div class="mb-3">
              <label for="quantity" class="form-label">Quantité (en Kg ou en Unité)</label>
              <input value="" required type="number" class="form-control" name="quantity" id="quantity" min="0" />
            </div>
          </div>
        </div>
        <h4>Liste des produits achetés</h4>
        <div className="table-responsive card-table mb-3">
          <table className="table table-vcenter">
            <thead>
              <tr>
                <th></th>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

        <div className="text-center mt-3">
          <div className="text-center">
            <div>Total TTC en FCFA</div>
            <div className="display-4">0</div>
          </div>
          <button type="submit" className="btn btn-success">
            Créer la facture
          </button>
        </div>
      </div>
    </div>
  );
};

//render the component to the DOM
ReactDOM.render(<MainContent />, document.getElementById("module"));
