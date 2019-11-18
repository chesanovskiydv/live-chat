import React from "react";

import App from 'sdk/components/App';


export default function (stores) {
    return class Root extends React.Component {
        render() {
            return (
                <App stores={stores}/>
            );
        }
    };
}
