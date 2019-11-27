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
        const {tools, title, className, ...props} = this.props;
        let toolsList;

        if (tools) {
            toolsList = <div className={style.tools}>
                {tools}
            </div>;
        }

        return (
            <header className={clsx(style.header, style['with-border'], className)} {...props}>
                {toolsList}
                <div className={style.title}>{title}</div>
            </header>
        )
    }
}
