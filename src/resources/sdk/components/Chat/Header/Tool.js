import React from "react";
import PropTypes from 'prop-types';
import clsx from "clsx";

import generalStyles from "sdk/sass/index.scss";
import styles from "./Tool.module.scss";


export default class Tool extends React.Component {
    static propTypes = {
        onClick: PropTypes.func.isRequired
    };

    render() {
        return (
            <button className={clsx(generalStyles.btn, styles.tool)} onClick={this.props.onClick}>
                {this.props.children}
            </button>
        )
    }
}
