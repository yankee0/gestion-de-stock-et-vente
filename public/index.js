const getToken = () => {
  axios
    .get(window.location.href + "/token")
    .then((res) => {
      return res.data;
    })
    .catch((err) => {
      console.log(err);
      alert(
        "Une erreur s'est produite, veuillez raffraichir la page et recommencer"
      );
    });
};

const MainContent = () => {
  const [items, setItems] = React.useState([]);
  const [selectedItems, setSelectedItems] = React.useState([]);
  const [total, setTotal] = React.useState(0);
  const [item, setItem] = React.useState(null);
  const [quantity, setQuantity] = React.useState(1);
  const [loading, setLoading] = React.useState(false);

  const getTotal = () => {
    let total = 0;

    selectedItems.map((i) => {
      total += i.count * i.price_per_unit;
    });

    setTotal(total);
  };

  const getItems = () => {
    axios
      .get(window.location.href + "/getItems")
      .then((res) => {
        setItems(res.data);
      })
      .catch((err) => {
        console.log(err);
        alert(
          "Une erreur s'est produite, veuillez raffraichir la page et recommencer"
        );
      });
  };

  const addToInvoice = () => {
    if (!item) {
      return;
    }

    setSelectedItems([
      ...selectedItems,
      {
        ...JSON.parse(item),
        count: quantity,
      },
    ]);
    setItem({});
    setQuantity(1);
  };

  const deleteFromInvoice = (index) => {
    setSelectedItems((prev) => prev.filter((e, i) => i != index));
  };

  const decrement = (index) => {
    setSelectedItems((prev) => {
      const updatedItems = [...prev];
      if (updatedItems[index].count === 1) {
        return updatedItems;
      }
      updatedItems[index].count--;
      return updatedItems;
    });
  };

  const increment = (index) => {
    setSelectedItems((prev) => {
      const updatedItems = [...prev];
      updatedItems[index].count++;
      return updatedItems;
    });
  };

  const createInvoice = () => {
    if (!selectedItems.length) return;
    setLoading(true);
    axios
      .post(window.location.href + "/createInvoice", selectedItems)
      .then((res) => {
        window.location.href = res.data;
      })
      .catch((err) => {
        console.log(err);
        alert(
          "Une erreur s'est produite lors de la création de facture - " +
            err.response.data.messages.error || "ERROR SERVER"
        );
      })
      .finally(() => setLoading(false));
  };

  React.useEffect(() => {
    getTotal();
  }, [selectedItems]);

  React.useEffect(() => {
    getItems();
  }, []);

  return (
    <div className="card">
      <div className="card-body">
        <div className="card-title">Formulaire de création</div>
        <div className="row">
          <div className="col-md-4 col-lg-4 col-xl-3">
            <div className="mb-3">
              <label htmlFor="profile" className="form-label">
                Sélectionnez le produit
              </label>
              <select
                onChange={(e) => {
                  if (e.target.value) setItem(e.target.value);
                }}
                className="form-select"
                name="profile"
                id="profile"
              >
                <option value={false}>Sélectionnez</option>
                {items.map((i, count) => (
                  <option key={"opt" + count} value={JSON.stringify(i)}>
                    {i.name} - Restants: {i.quantity}
                  </option>
                ))}
              </select>
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-xl-3">
            <div class="mb-3">
              <label htmlFor="quantity" class="form-label">
                Quantité (en Kg , Litres ou Unité)
              </label>
              <input
                value={quantity}
                onChange={(e) => {
                  setQuantity(e.target.value);
                }}
                required
                type="number"
                step="0.001"
                className="form-control"
                name="quantity"
                id="quantity"
                min="0"
              />
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-xl-3 d-flex">
            <div className="flex-fill d-flex align-items-end">
              <button onClick={addToInvoice} className="mb-3 btn btn-primary">
                Ajouter à la facture
              </button>
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
            <tbody>
              {selectedItems.map((s, i) => (
                <tr key={"item" + i}>
                  <td>
                    <div className="d-flex gap-1">
                      <button
                        onClick={() => deleteFromInvoice(i)}
                        className="d-flex align-items-center text-danger mx-3"
                      >
                        <i className="ti ti-trash"></i>{" "}
                      </button>
                      <button
                        onClick={() => decrement(i)}
                        className="d-flex align-items-center"
                      >
                        <i className="ti ti-minus"></i>{" "}
                      </button>
                      <code className="d-flex align-items-center px-2">
                        {s.count}
                      </code>
                      <button
                        onClick={() => increment(i)}
                        className="d-flex align-items-center"
                      >
                        <i className="ti ti-plus"></i>{" "}
                      </button>
                    </div>
                  </td>
                  <td>{s.name}</td>
                  <td>{s.count}</td>
                  <td>{s.price_per_unit}</td>
                  <td>{s.count * s.price_per_unit}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>

        <div className="text-center mt-3">
          <div className="text-center">
            <div>Total TTC en FCFA</div>
            <div className="display-4">{total}</div>
          </div>
          <button
            disabled={loading}
            onClick={createInvoice}
            type="submit"
            className="btn btn-success"
          >
            {loading ? "Création en cours..." : "Créer la facture"}
          </button>
        </div>
      </div>
    </div>
  );
};

//render the component to the DOM
ReactDOM.render(<MainContent />, document.getElementById("module"));
