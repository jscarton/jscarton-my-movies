import React from 'react'
const MovieDetails = ({movie}) => {
    console.log(movie)
    const {title, posterUrl, director, actors, plot, genres, year} = movie;
    const genresList = JSON.parse(genres);
    return (
      <>
      <div class="openbtn text-center">
      <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target={`#myModal${movie.id}`}
      >
        Details
      </button>
      <div class="modal" tabindex="-1" id={`myModal${movie.id}`}>
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title">Movie Details</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
          </div>
          <div class="modal-body">
            <h1>{title}</h1>
            <img src={posterUrl}></img>
            <hr/>
            <p><strong>Director:</strong>{director}</p>
            <p><strong>Actors:</strong>{actors}</p>
            <p><strong>Plot:</strong>{plot}</p>
            <p><strong>Genres:</strong>{genresList.join(', ')}</p>
            <p><strong>Year:</strong>{year}</p>
          </div>
          <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Close
          </button>
          <button type="button" class="btn btn-primary">
            Save changes
          </button>
          </div>
        </div>
        </div>
      </div>
      </div>
      </>
        
     );
}

export default MovieDetails;