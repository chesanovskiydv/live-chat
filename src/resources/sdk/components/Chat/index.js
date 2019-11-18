import React from "react";
import PropTypes from 'prop-types';
import {inject} from "mobx-react";
import clsx from "clsx";

import Collapse from 'react-collapse';
import {FaMinus, FaPlus} from "react-icons/fa";

import {SettingsStore} from "sdk/stores";

import Header from "./Header";
import Body from "./Body";
import Footer from "./Footer";
import Badge from "./Header/Badge";
import Tool from "./Header/Tool";
import MessageList from "./Body/MessageList";

import styles from "./index.module.scss";


@inject('settingsStore')
export default class Chat extends React.Component {
    static propTypes = {
        isOpened: PropTypes.bool,
        settingsStore: PropTypes.instanceOf(SettingsStore).isRequired,
    };
    static defaultProps = {
        isOpened: false,
    };

    constructor(props) {
        super(props);
        this.state = {isOpened: this.props.isOpened};

        this.toggleHandler = this.toggleHandler.bind(this);
    }

    toggleHandler() {
        this.setState(state => ({
            isOpened: !state.isOpened
        }));
    }

    render() {
        const {settingsStore} = this.props;
        const {isOpened} = this.state;

        const tools = (
            <React.Fragment>
                <Badge/>
                <Tool onClick={this.toggleHandler}>
                    {isOpened ? <FaMinus/> : <FaPlus/>}
                </Tool>
            </React.Fragment>
        );

        return (
            <div className={clsx(styles.chat, styles.fixed)}
                 style={{borderTopColor: settingsStore.theme.backgroundColor}}>
                <Header tools={tools}/>

                <Collapse isOpened={isOpened} theme={{collapse: styles['collapse-wrapper'], content: ''}}>
                    <Body>
                        <MessageList/>
                    </Body>
                    <Footer/>
                </Collapse>
            </div>
        )
    }
}
