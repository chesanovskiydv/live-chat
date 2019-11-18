import React from "react";
import PropTypes from 'prop-types';
import clsx from "clsx";
import dayjs from 'dayjs';
import Avatar from 'react-avatar';

import {MessageModel} from "sdk/models";

import styles from "./Message.module.scss";


export const directions = {
    left: 'left',
    right: 'right',
};

export default class Message extends React.Component {
    static propTypes = {
        direction: PropTypes.oneOf(Object.values(directions)),
        message: PropTypes.instanceOf(MessageModel).isRequired,
        avatarAlt: PropTypes.string,
        datetimeFormat: PropTypes.string,
    };
    static defaultProps = {
        direction: directions.left,
        avatarAlt: 'Avatar',
        datetimeFormat: 'D MMM h:mm a'
    };

    render() {
        const {direction, message, avatarAlt, datetimeFormat} = this.props;
        const datetime = dayjs(message.createdAt).format(datetimeFormat);

        return (
            <div className={clsx(styles.message, {[styles.right]: direction === 'right'})}>

                <div className={styles.info}>
                    <div className={styles.name}>
                        {message.author.name}
                    </div>
                    <div className={styles.time}>
                        {datetime}
                    </div>
                </div>

                {message.author.avatar
                    ? <img src={message.author.avatar} alt={avatarAlt} className={styles.avatar}/>
                    : <Avatar name={message.author.name} className={styles.avatar} round={true} size={'40px'}/>
                }

                <div className={styles.text}>
                    {message.text}
                </div>

            </div>
        )
    }
}
