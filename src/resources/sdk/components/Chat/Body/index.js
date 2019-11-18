import React from "react";

import styles from "./index.module.scss";


export default class Body extends React.Component {
    render() {
        return (
            <section className={styles.body}>
                {this.props.children}
            </section>
        )
    }
}
