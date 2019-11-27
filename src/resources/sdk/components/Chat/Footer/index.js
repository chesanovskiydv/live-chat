import React from "react";
import PropTypes from 'prop-types';
import clsx from 'clsx';

import MessageForm from "./MessageForm";

import styles from "./index.module.scss";


export default class Footer extends React.Component {
    static propTypes = {
        submitButtonText: PropTypes.string,
        inputPlaceholder: PropTypes.string,
    };

    render() {
        const {submitButtonText, inputPlaceholder, className, ...props} = this.props;
        // @todo: implement this function
        let submitHandler = (e) => {
            console.log('submitHandler', {e, arguments: arguments});

            e.preventDefault();
        };

        return (
            <footer className={clsx(styles.footer, className)} {...props}>
                <MessageForm {...{submitButtonText, inputPlaceholder, submitHandler}}/>
            </footer>
        )
    }
}
