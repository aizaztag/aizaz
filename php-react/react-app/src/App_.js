import React from "react";

import Actions from "./Actions/Actions";
import {Provider} from "./Context";
import AddUser from "./ components/GetUsers";
import AllUsers from "./ components/AddUser";


class App extends Actions {

    render() {
        const contextValue = {
            all_users: this.state.users1,
            get_users: this.fetchUsers,
            editMode: this.editMode,
            cancelEdit: this.cancelEdit,
            handleUpdate: this.handleUpdate,
            handleDelete: this.handleDelete,
            insertUser: this.insertUser,
            checkEmailExits:this.checkEmailExits,
            errorSubmit:this.state.errorSubmit
        }
        return (
            <Provider value={contextValue}>
                <div className="container-fluid bg-light">
                    <div className="container p-5">
                        <div className="card shadow-sm">
                            <h1 className="card-header text-center text-uppercase text-muted">
                                React PHP CRUD Application
                            </h1>
                            <div className="card-body">
                                <div className="row">
                                    <div className="col-md-12">
                                        <AddUser/>
                                    </div>
                                    <div className="col-md-8">
                                        <AllUsers/>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </Provider>
        );
    }
}
