import React from 'react';
import Axios from 'axios';
class Actions extends React.Component{
    state = {
        users1:[],
    }

    // FETCH USERS FROM DATABASE
    fetchUsers = () => {
        Axios.get('http://localhost/php-react/all-users.php')
            .then(({data}) => {
                if(data.success === 1){
                    this.setState({
                        users1:data.users.reverse()
                    });
                }
            })
            .catch(error => {
                console.log(error);
            })
    }

    // ON EDIT MODE
    editMode = (id) => {
        let users = this.state.users.map(user => {
            if(user.id === id){
                user.isEditing = true;
                return user;
            }
            user.isEditing = false;
            return user;
        });

        this.setState({
            users
        });
    }

    //CANCEL EDIT MODE
    cancelEdit = (id) => {
        let users = this.state.users.map(user => {
            if(user.id === id){
                user.isEditing = false;
                return user;
            }
            return user

        });
        this.setState({
            users
        });
    }

    // UPDATE USER
    handleUpdate = (id,user_name,user_email) => {
        Axios.post('http://localhost/php-react/update-user.php',
            {
                id:id,
                user_name:user_name,
                user_email:user_email
            })
            .then(({data}) => {
                if(data.success === 1){
                    let users = this.state.users.map(user => {
                        if(user.id === id){
                            user.user_name = user_name;
                            user.user_email = user_email;
                            user.isEditing = false;
                            return user;
                        }
                        return user;
                    });
                    this.setState({
                        users
                    });
                }
                else{
                    alert(data.msg);
                }
            })
            .catch(error => {
                console.log(error);
            });
    }


    // DELETE USER
    handleDelete = (id) => {
        let deleteUser = this.state.users1.filter(user => {
            return user.id !== id;
        });

        Axios.post('http://localhost/php-react/delete-user.php',{
            id:id
        })
            .then(({data}) => {
                if(data.success === 1){
                    this.setState({
                        users1:deleteUser
                    });
                }
                else{
                    alert(data.msg);
                }
            })
            .catch(error => {
                console.log(error);
            });
    }
    //checkEmailExits
    checkEmailExits = (event ,user_email) => {
        /*email request */
        Axios.post('http://localhost/php-react/check-email-exits.php',{
            user_email:user_email
        })
            .then(function ({data}) {
                //console.log('this.setState' , this.setState);
                if(data.success === 1){
                    this.setState({errorSubmit: 1});
                    console.log('this.state.errorSubmit',this.state.errorSubmit);
                }
                else{
                    this.setState({errorSubmit: 0});
                    console.log('this.state.errorSubmit',this.state.errorSubmit);
                }
            }.bind(this))
            .catch(function (error) {
                console.log('error',error);
            });
        /*email request */

    }
    // INSERT USER
    insertUser = (event,user_name,user_email) => {
        event.preventDefault();
        event.persist();
        if(this.state.errorSubmit){
            alert('please validate from')
           return false;
        }

        Axios.post('http://localhost/php-react/add-user.php',{
            user_name:user_name,
            user_email:user_email
        })
            .then(function ({data}) {
                if(data.success === 1){
                    this.setState({
                        users1:[
                            {"id":data.id,"user_name":user_name,"user_email":user_email},
                            ...this.state.users1
                        ]
                    });
                    event.target.reset();
                }
                else{
                    alert(data.msg);
                }
            }.bind(this))
            .catch(function (error) {
                console.log(error);
            });
    }
}

export default Actions;