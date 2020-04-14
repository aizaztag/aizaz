import React from 'react';
import Context from './ThemeContext';
import  C  from './ComponentC'

import App from "../App";
const A = () => (
    <Context.Provider value="green">
        <C />
    </Context.Provider>
);

export default A;
