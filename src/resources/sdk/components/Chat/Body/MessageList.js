import React from "react";
import PropTypes from 'prop-types';
import {inject, observer} from "mobx-react";

import {MessageStore} from "sdk/stores";
import {CustomerModel} from "sdk/models";

import Message, {directions} from "./Message";

import styles from "./MessageList.module.scss";


@inject('messagesStore')
@observer
export default class MessageList extends React.Component {
    static propTypes = {
        messagesStore: PropTypes.instanceOf(MessageStore).isRequired,
    };

    render() {
        const {messagesStore} = this.props;

        return (
            <div className={styles.messages}>
                {messagesStore.messages.map(message =>
                    <Message key={message.id} message={message}
                             direction={message.author instanceof CustomerModel ? directions.right : directions.left}/>
                )}
            </div>
        )
    }
}
