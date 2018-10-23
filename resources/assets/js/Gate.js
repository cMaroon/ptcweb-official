export default class Gate{

    constructor(user){
        this.user = user;
    }


    isSuperAdmin(){
        return this.user.usertype === 'superadmin';
    }

    isStudent(){
        return this.user.usertype === 'student';
    }
    // isAdminOrAuthor(){
    //     if(this.user.type === 'admin' || this.user.type === 'author'){
    //         return true;
    //     }

    // }
    // isAuthorOrUser(){
    //     if(this.user.type === 'user' || this.user.type === 'author'){
    //         return true;
    //     }

    // }



}