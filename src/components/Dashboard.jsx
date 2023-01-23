import React from 'react'
import { Movies } from './Movies'
import "bootstrap/dist/js/bootstrap.bundle.js";
import "bootstrap/dist/css/bootstrap.css";
import {Post} from 'react-axios'
const Dashboard = () => {

    const formData = new FormData();
    formData.append('action', 'movies_list');
    formData.append('_ajax_nonce', _wp_movies_nonce);
    return (
      <Post
        url={ajaxurl}
        data={formData}
      >
        {(error, response, isLoading, makeRequest) => {
          console.log(response);
          if(error) {
            return (<div>Something bad happened: {error.message} <button onClick={() => makeRequest({ params: { reload: true } })}>Retry</button></div>)
          }
          else if(isLoading) {
            return (<div>Loading...</div>)
          }
          else if(response?.data) {
            return (<Movies movies={response.data}/>)
          }
          return (<div>Loading...</div>)
        }}
      </Post>
        
     );
}

export default Dashboard;