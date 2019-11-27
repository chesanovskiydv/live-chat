import {observable} from "mobx";

import UserModel from "./UserModel";

export default class MessageModel {

    /**
     * Unique id of this message.
     *
     * @type {String|Number}
     */
    id;

    /**
     * @type {String}
     */
    text = "";

    /**
     * Reference to an User object
     *
     * @type {CustomerModel|UserModel}
     */
    author;

    /**
     * @type {Date}
     */
    createdAt;

    /**
     * @type {Date|null}
     */
    @observable readAt;

    /**
     * @param {String|Number} id
     * @param {CustomerModel|UserModel} author
     * @param {String} text
     * @param {Date} createdAt
     * @param {Date|null} [readAt]
     */
    constructor(id, author, text, createdAt, readAt = null) {
        this.id = id;
        this.author = author;
        this.text = text;
        this.createdAt = createdAt;
        this.readAt = readAt;
    }
}
