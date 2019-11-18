import React from "react";
import PropTypes from 'prop-types';
import clsx from 'clsx';

import style from "./index.module.scss";


export default class Header extends React.Component {
    static propTypes = {
        title: PropTypes.string,
        tools: PropTypes.node,
    };
    static defaultProps = {
        title: 'Chat',
    };

    render() {
        let tools;

        if (this.props.tools) {
            tools = <div className={style.tools}>
                {this.props.tools}
            </div>;
        }

        return (
            <header className={clsx(style.header, style['with-border'])}>
                {tools}
                <div className={style.title}>{this.props.title}</div>
            </header>
        )
    }
}
