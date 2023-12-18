import React from 'react';
import ListeCarte from '../components/ListeCarte';
import Filtre from '../components/Filtre';

const CardListPage = () => {
  const handleFilterChange = (filterType, value) => {
    
    console.log(`Filter changed - ${filterType}: ${value}`);
    
  };

  return (
    <div>
      <h1>Card List Page</h1>
      <Filter handleFilterChange={handleFilterChange} />
      <CardList />
    </div>
  );
};

export default CardListPage;
