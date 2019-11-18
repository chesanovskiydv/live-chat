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
     * @param {String|Number} id
     * @param {CustomerModel|UserModel} author
     * @param {String} text
     * @param {Date} createdAt
     */
    constructor(id, author, text, createdAt) {
        this.id = id;
        this.author = author;
        this.text = text;
        this.createdAt = createdAt;
    }
}
