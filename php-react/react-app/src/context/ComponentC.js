
import React from 'react';
import Context from './ThemeContext';
import A from "./ComponentA";
const C = () => (
    <Context.Consumer>
        {color => (
            <p style={{ color }}>
                Hello World
            </p>
        )}
    </Context.Consumer>
);

export default C;
