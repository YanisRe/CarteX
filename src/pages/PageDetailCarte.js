import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import DetailCarte from '../components/CardDetail';
import axios from 'axios';

const CardDetailPage = () => {
  const { id } = useParams();
  const [card, setCard] = useState(null);

  useEffect(() => {
    const fetchCardDetail = async () => {
      try {
        const response = await axios.get(`https://db.ygoprodeck.com/api/v7/cardinfo.php?id=${id}`);
        setCard(response.data.data[0]);
      } catch (error) {
        console.error('Error fetching card detail:', error);
      }
    };

    fetchCardDetail();
  }, [id]);

  return (
    <div>
      <h1>Card Detail Page</h1>
      {card ? <CardDetail card={card} /> : <p>Loading...</p>}
    </div>
  );
};

export default CardDetailPage;

