import React from "react";
import {inject, observer} from "mobx-react";

import {CustomerModel} from "sdk/models";

import Message, {directions} from "./Message";

import styles from "./MessageList.module.scss";


@inject('messagesStore')
@observer
export default class MessageList extends React.Component {
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
