import React from "react";
import ReactDOM from "react-dom";

import mobx from './mobx';
import rootComponent from './react';

/**
 * @param {Element} container
 */
export default function (container) {
    const stores = mobx();
    const Root = rootComponent(stores);

    if (container) {
        ReactDOM.render(<Root/>, container);
    }
}
