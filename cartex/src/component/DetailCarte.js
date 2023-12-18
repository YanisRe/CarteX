import React from 'react';

const CardDetail = ({ card }) => {
  return (
    <div>
      <h2>{card.name}</h2>
      <img src={card.card_images[0].image_url} alt={card.name} />
    </div>
  );
};

export default DetailCarte;
