import {observable} from "mobx";


export default class UserStore {

    /**
     * @type {CustomerModel}
     */
    @observable customer;

    /**
     * @type {UserModel[]}
     */
    @observable users = [];

    /**
     * @param {CustomerModel} customer
     * @param {UserModel[]} users
     */
    constructor(customer, users = []) {
        this.customer = customer;
        this.users = users;
    }
}
