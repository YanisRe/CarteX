app.get("/cards", (req, res) => {
  connection.query("SELECT * FROM cards", (error, results) => {
    if (error) {
      console.error("Erreur lors de la récupération des données :", error);
      res.status(500).json({ error: "Erreur lors de la récupération des données" });
    } else {
      res.status(200).json(results);
    }
  });
});

fetch('/cards')
  .then(response => response.json())
  .then(cards => {
    cards.forEach(card => {
      const { nom, description, imageUrl } = card;
      const cardElement = document.createElement('div');
      cardElement.classList.add('card');
      cardElement.innerHTML = `
        <img src="${imageUrl}" alt="${nom}" />
        <h3>${nom}</h3>
        <p>${description}</p>
      `;
      document.body.appendChild(cardElement);
    });
  })
  .catch(error => console.error("Erreur lors de la récupération des données depuis l'API :", error));

