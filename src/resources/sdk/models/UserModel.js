export default class UserModel {

    /**
     * Unique id of this message.
     */
    id;

    /**
     * @type {String}
     */
    name;

    /**
     * @type {String}
     */
    avatar = null;

    /**
     * @param {String|Number} id
     * @param {String} name
     * @param {String} [avatar]
     */
    constructor(id, name, avatar = null) {
        this.id = id;
        this.name = name;
        this.avatar = avatar;
    }
}
