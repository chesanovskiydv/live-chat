import React from "react";
import PropTypes from 'prop-types';
import {inject} from "mobx-react";

import style from "./Badge.module.scss";


@inject('settingsStore')
export default class Badge extends React.Component {
    static propTypes = {
        amount: PropTypes.number,
    };
    static defaultProps = {
        amount: 0,
    };

    render() {
        const {settingsStore} = this.props;

        return (
            <span className={style.badge} style={{backgroundColor: settingsStore.theme.backgroundColor}}>
                {this.props.amount}
            </span>
        )
    }
}
