import React from "react";
import PropTypes from 'prop-types';
import {Provider} from 'mobx-react'

import {IconContext} from 'react-icons';

import {UserStore, MessageStore, SettingsStore} from "sdk/stores";

import Chat from "./Chat";


export default class App extends React.Component {
    static propTypes = {
        stores: PropTypes.shape({
            usersStore: PropTypes.instanceOf(UserStore),
            messagesStore: PropTypes.instanceOf(MessageStore),
            settingsStore: PropTypes.instanceOf(SettingsStore).isRequired,
        }).isRequired,
    };

    render() {
        return (
            <Provider {...this.props.stores}>
                <IconContext.Provider value={{style: {verticalAlign: 'middle'}}}>

                    <Chat isOpened={this.props.stores.settingsStore.chatSettings.isOpened}/>

                </IconContext.Provider>
            </Provider>
        )
    }
}
