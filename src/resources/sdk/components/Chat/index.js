import React from "react";
import PropTypes from 'prop-types';
import {observer, inject} from "mobx-react";
import clsx from "clsx";

import Collapse from 'react-collapse';
import Draggable from 'react-draggable';
import {FaMinus, FaPlus} from "react-icons/fa";

import Header from "./Header";
import Body from "./Body";
import Footer from "./Footer";
import Badge from "./Header/Badge";
import Tool from "./Header/Tool";
import MessageList from "./Body/MessageList";

import styles from "./index.module.scss";
import generalStyles from "sdk/sass/index.scss";


@inject('settingsStore', 'messagesStore')
@observer
export default class Chat extends React.Component {
    static propTypes = {
        isOpened: PropTypes.bool,
        isDraggable: PropTypes.bool,
    };
    static defaultProps = {
        isOpened: false,
        isDraggable: false,
    };

    constructor(props) {
        super(props);
        this.state = {isOpened: this.props.isOpened};
    }

    toggleHandler = () => {
        this.setState(state => ({
            isOpened: !state.isOpened
        }));
    };

    render() {
        const {settingsStore, messagesStore, isDraggable} = this.props;
        const {isOpened} = this.state;

        const tools = (
            <React.Fragment>
                <Badge amount={messagesStore.unreadCount}/>
                <Tool onClick={this.toggleHandler}>
                    {isOpened ? <FaMinus/> : <FaPlus/>}
                </Tool>
            </React.Fragment>
        );

        return (
            <Draggable axis="x" handle={`.${generalStyles['cursor-x']}`} bounds="html" disabled={!isDraggable}
                       defaultClassName={generalStyles['draggable']}
                       defaultClassNameDragging={generalStyles['draggable-dragging']}
                       defaultClassNameDragged={generalStyles['draggable-dragged']}>

                <div className={clsx(styles.chat, styles.fixed)}
                     style={{borderTopColor: settingsStore.theme.backgroundColor}}>

                    <Header className={isDraggable && generalStyles['cursor-x']} tools={tools}/>

                    <Collapse isOpened={isOpened} theme={{collapse: styles['collapse-wrapper']}}>
                        <Body>
                            <MessageList/>
                        </Body>
                        <Footer/>
                    </Collapse>

                </div>

            </Draggable>
        )
    }
}
