import {observable} from "mobx";


export default class MessageStore {

    /**
     * @type {MessageModel[]}
     */
    @observable messages = [];
}
