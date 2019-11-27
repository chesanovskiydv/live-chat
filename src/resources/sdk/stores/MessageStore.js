import {observable, computed} from "mobx";


export default class MessageStore {

    /**
     * @type {MessageModel[]}
     */
    @observable messages = [];

    /**
     * @type {Number}
     */
    @computed
    get unreadCount() {
        return this.messages.filter(
            message => !(message.readAt instanceof Date)
        ).length;
    }
}
