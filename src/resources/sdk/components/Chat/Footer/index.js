import React from "react";
import PropTypes from 'prop-types';

import MessageForm from "./MessageForm";

import styles from "./index.module.scss";


export default class Footer extends React.Component {
    static propTypes = {
        submitButtonText: PropTypes.string,
        inputPlaceholder: PropTypes.string,
    };
    static defaultProps = {
        submitButtonText: 'Send',
        inputPlaceholder: 'Type Message...'
    };

    render() {
        // @todo: tmp
        let submitHandler = (e) => {
            console.log('submitHandler', {e, arguments: arguments});

            e.preventDefault();
        };

        return (
            <footer className={styles.footer}>
                <MessageForm submitHandler={submitHandler}/>
            </footer>
        )
    }
}
