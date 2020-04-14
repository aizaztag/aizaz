import React from 'react'
import ReactDOM from 'react-dom';

import HomePage from "../context/HomePage";


function formatDate(date) {
    return '12-12-12';//date.toLocaleDateString();
}

function Avatar(props) {
    return (
        <img
            className="Avatar"
            src={props.user.avatarUrl}
            alt={props.user.name}
        />
    );
}

function UserInfo(props) {
    return (
        <div className="UserInfo1">
            <Avatar user={props.user} />
            <div className="UserInfo1-name">{props.user.name}</div>
        </div>
    );
}

function Comment(props) {
    return (
        <div className="Comment">
            <UserInfo user={props.author} />
            <Emp emp={props.emp} />
            <div className="Comment-text">{props.text}</div>
            <div className="Comment-date">
                {formatDate(props.date)}
            </div>
        </div>
    );
}

function Info(props){
       return(
           <div className="Info">
               <p className="asd">{props.infoq.company}</p>
           </div>
       );
}

function Emp(props){
    console.log(props)
    return(
           <div className="Emp">
               <Info infoq={props.emp}/>
           </div>
       );
}

const co = {
    date: new Date(),
    text: 'I hope you enjoy learning React!',
    author: {
        name: 'Hello Kitty',
        avatarUrl: 'https://placekitten.com/g/64/64',
    },
    emp: {
        company: 'Right Soilutoin',
        salary: '29990',
    },
};
ReactDOM.render(
    <Comment
        date={co.date}
        text={co.text}
        author={co.author}
        emp={co.emp}
    />,
    document.getElementById('root')
);


export default Comment;

