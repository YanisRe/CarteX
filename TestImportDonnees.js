const axios = require("axios");
const mysql = require("mysql");
const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "admin",
  database: "cartex"
});

connection.connect();

const apiUrl = "https://db.ygoprodeck.com/api/v7/cardinfo.php?language=fr";

const fetchAndStoreData = async () => {
  try {
    const response = await axios.get(apiUrl);
    const cards = response.data.data.slice(0, 300);

    cards.forEach(async (card) => {
      const { name, desc, card_images } = card;
      const imageUrl = card_images[0].image_url;

      const query = `INSERT INTO cards (nom, description, imageUrl) VALUES (?, ?, ?)`;
      connection.query(query, [name, desc, imageUrl], (error, results) => {
        if (error) {
          console.error("Erreur lors de l'insertion des données :", error);
        } else {
          console.log('Données insérées avec succès !');
        }
      });
    });
  } catch (error) {
    console.error("Erreur lors de la récupération des données depuis l'API :", error);
  } finally {
    connection.end();
  }
};

fetchAndStoreData();
