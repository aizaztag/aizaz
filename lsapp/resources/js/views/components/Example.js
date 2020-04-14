import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

export default class Example extends Component {
    constructor(){
        super();
        this.state = {
            posts:[],
            arr:[
                'aizaz','fasdfs'
            ],
            msg:'message'
        }
    }
    componentDidMount(){
            axios.get('/post').then(response=> {
               this.setState({arr:this.state.arr  })
               this.setState({posts:response.data  })

            }).catch(errors=>{
            console.log(errors);

    })
    }
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">Example Component</div>
                            {
                                this.state.posts.map(
                                    data => data.title
                                )
                            }
                            {
                                this.state.arr.map(
                                data => data
                                )
                            }
                            <div className="card-body">I'm an exampleasds  sdasddsanpm component!</div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
