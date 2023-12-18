import React from 'react';

const Filter = ({ handleFilterChange }) => {
  return (
    <div>
      <h2>Filter</h2>
      <label>
        Name:
        <input type="text" onChange={(e) => handleFilterChange('name', e.target.value)} />
      </label>
      <label>
        Price:
        <select onChange={(e) => handleFilterChange('price', e.target.value)}>
          <option value="">All</option>
          <option value="low">Low to High</option>
          <option value="high">High to Low</option>
        </select>
      </label>
    </div>
  );
};

export default Filtre;
