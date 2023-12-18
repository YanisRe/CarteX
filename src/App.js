import React, { useState, useEffect } from 'react';
import axios from 'axios';

function test () {
  console.log('test');
}

function App() {
  const [cards, setCards] = useState([]);

  useEffect(() => {
    // Fonction pour récupérer les données des cartes depuis l'API Node.js
    const fetchCards = async () => {
      try {
        const response = await axios.get('http://votre_api_node/cards'); // Remplacez l'URL par votre endpoint réel
        setCards(response.data); // Mettre à jour l'état avec les données récupérées
      } catch (error) {
        console.error('Erreur lors de la récupération des cartes :', error);
      }
    };

    fetchCards(); // Appel de la fonction pour récupérer les cartes lors du chargement de l'application
  }, []);

  return (
    <div className="App">
      <h1>CarteX - Gestion des Cartes Yu-Gi-Oh!</h1>
      <div className="card-list">
        {cards.map((card, index) => (
          <div key={index} className="card">
            <h3>{card.name}</h3>
            <p>{card.description}</p>
            <img src={card.imageUrl} alt={card.name} />
            {/* Autres détails de la carte à afficher */}
          </div>
        ))}
      </div>
    </div>
  );
}

export default App;

