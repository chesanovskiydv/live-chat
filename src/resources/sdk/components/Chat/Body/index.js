import React from "react";
import clsx from 'clsx';

import styles from "./index.module.scss";


export default class Body extends React.Component {
    render() {
        const {className, ...props} = this.props;

        return (
            <section className={clsx(styles.body, className)} {...props}>
                {this.props.children}
            </section>
        )
    }
}
