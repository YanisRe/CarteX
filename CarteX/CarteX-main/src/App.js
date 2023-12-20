import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './App.css';

function test () {
  console.log('test');
}

function App() {
  const [cards, setCards] = useState([]);

  useEffect(() => {
    const fetchCards = async () => {
      try {
        const response = await axios.get('https://db.ygoprodeck.com/api/v7/cardinfo.php');
        setCards(response.data)
      } catch (error) {
        console.error('Erreur lors de la récupération des cartes :', error);
      }
    };

    fetchCards();
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
            {card.type === 'Monster' && (
              <div>
                <p>Attack : {card.attack}</p>
                <p>Defense : {card.defense}</p>
              </div>
            )}
          </div>
        ))}
      </div>
    </div>
  );
}

export default App;

