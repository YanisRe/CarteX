import React, { useState, useEffect } from 'react';
import axios from 'axios';

const CardList = () => {
  const [cards, setCards] = useState([]);

  useEffect(() => {
    const fetchCards = async () => {
      try {
        const response = await axios.get('https://db.ygoprodeck.com/api/v7/cardinfo.php');
        setCards(response.data.data);
      } catch (error) {
        console.error('Error fetching cards:', error);
      }
    };

    fetchCards();
  }, []);

  return (
    <div>
      <h2>Card List</h2>
      <ul>
        {cards.map((card) => (
          <li key={card.id}>
            <img src={card.card_images[0].image_url} alt={card.name} />
            <h3>{card.name}</h3>
            <p>{card.desc}</p>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default ListeCarte;

