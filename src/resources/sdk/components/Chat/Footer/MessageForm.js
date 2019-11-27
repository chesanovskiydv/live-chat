import React from "react";
import PropTypes from 'prop-types';
import {inject} from "mobx-react";
import clsx from "clsx";

import generalStyles from "sdk/sass/index.scss";


@inject('settingsStore')
export default class MessageForm extends React.Component {
    static propTypes = {
        submitButtonText: PropTypes.string,
        inputPlaceholder: PropTypes.string,
        submitHandler: PropTypes.func.isRequired,
    };
    static defaultProps = {
        submitButtonText: 'Send',
        inputPlaceholder: 'Type Message...'
    };

    render() {
        const {settingsStore} = this.props;

        return (
            <form onSubmit={this.props.submitHandler}>
                <div className={generalStyles['input-group']}>

                    <input type="text" className={generalStyles['form-control']}
                           placeholder={this.props.inputPlaceholder}/>

                    <span className={generalStyles['input-group-btn']}>
                        <button className={clsx(generalStyles.btn, generalStyles['btn-flat'])}
                                style={{
                                    backgroundColor: settingsStore.theme.backgroundColor,
                                    borderColor: settingsStore.theme.backgroundColor,
                                    color: settingsStore.theme.fontColor
                                }}>
                            {this.props.submitButtonText}
                        </button>
                    </span>

                </div>
            </form>
        )
    }
}
