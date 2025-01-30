(function()
{
    const validateMovieForm = function (event) {
        //kontener na błędy
        const errorContainer = document.getElementById('error-messages');
        errorContainer.innerHTML = ''; //reset poprzednich errorów
    
        //przypisanie wartości
        const title = document.getElementById('title').value.trim();
        const director = document.getElementById('director').value;
        const genre = document.getElementById('genre').value;
        const releaseYear = document.getElementById('releaseYear').value;
        const description = document.getElementById('description').value.trim();
    
        let errors = [];
    
        if (!title) {
            errors.push("Tytuł filmu jest wymagany.");
        }
    
        if (!director) {
            errors.push("Reżyser jest wymagany.");
        }
    
        if (!genre) {
            errors.push("Gatunek jest wymagany.");
        }
    
        if (!releaseYear) {
            errors.push("Rok produkcji musi być poprawną datą.");
        }
    
        if (!description) {
            errors.push("Opis filmu jest wymagany.");
        }
    
        if (errors.length > 0) {
            event.preventDefault(); //stop wysyłanie formularza
    
            errors.forEach(error => {
                const errorItem = document.createElement('li');
                errorItem.textContent = error;
                errorContainer.appendChild(errorItem);
            });
        }
    };

    const validateReviewForm = function (event) {
        //kontener na błędy
        const errorContainer = document.getElementById('error-messages');
        errorContainer.innerHTML = ''; //reset poprzednich errorów
    
        //przypisanie wartości
        const content = document.getElementById('content').value.trim();
        const rating = document.getElementById('rating').value;
    
        let errors = [];
    
        if (!content) {
            errors.push("Tekst recenzji jest wymagany.");
        }
    
        if (!rating) {
            errors.push("Ocena jest wymagana.");
        }
    
        if (errors.length > 0) {
            event.preventDefault(); //stop wysyłanie formularza
    
            errors.forEach(error => {
                const errorItem = document.createElement('li');
                errorItem.textContent = error;
                errorContainer.appendChild(errorItem);
            });
        }
    };

    //nasłuchiwacz dla id=movieForm
    document.getElementById('movieForm').addEventListener('submit', function(event){validateMovieForm(event)}); //wywołanie funkcji

    //nasłuchiwacz dla id=reviewForm
    document.getElementById('reviewForm').addEventListener('submit', function(event){validateReviewForm(event)}); //wywołanie funkcji
    
})();