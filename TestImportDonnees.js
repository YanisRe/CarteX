const axios = require("axios");
const mysql = require("mysql");

//on crée le systeme de connxion
const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "admin",
  database: "cartex"
});

//on se connecte à la BDD
connection.connect();

//on se connecte à l'API yugioh
const apiUrl = "https://db.ygoprodeck.com/api/v7/cardinfo.php?language=fr";

//on récupère les données de l'API et on les stock dans la BDD
const fetchAndStoreData = async () => {
  try {
    const response = await axios.get(apiUrl);
    const cards = response.data.data.slice(0, 300); //on récupère les données des 300 premières cartes

    //on rentre les données dans la BDD
    cards.forEach(async (card) => {
      const { name, desc, card_images, card_prices, card_sets, banlist_info} = card;
      const imageUrl = card_images[0]?.image_url;
      const price = card_prices[0]?.cardmarket_price; 
      const rarity = card_sets?.[0]?.set_rarity;
      const isBanned = banlist_info?.ban_tcg === "Banned" ? 1 : 0;
    
      const query = "INSERT INTO cards (nom, description, imageUrl, prix, rarete) VALUES (?, ?, ?, ?, ?)";
    
      connection.query(query, [name, desc, imageUrl, price, rarity], (error, results) => {
        if (error) {
          console.error("Erreur lors de l'insertion des données :", error);
        } else {
          console.log("Données insérées avec succès !");
        }
      });
    });
  } catch (error) {
    console.error("Erreur lors de la récupération des données depuis l'API :", error);
  } finally {
    connection.end(); //on se déconnecte de la BDD
  }
};

//on appelle la fonction
fetchAndStoreData();

