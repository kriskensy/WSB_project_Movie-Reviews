// nasłuchiwanie zdarzeń w polach wyszukiwania i sortowania
document.addEventListener("DOMContentLoaded", function () {
    let searchBox = document.getElementById("searchBox");
    let sortSelect = document.getElementById("sortSelect");

    if (searchBox) {
        searchBox.addEventListener("input", filterMovies);
    }
    if (sortSelect) {
        sortSelect.addEventListener("change", sortMovies);
    }
});

// wyszukiwanie dynamiczne, bez uwzględnienia kapitalizacji liter
function filterMovies() {
    let searchQuery = document.getElementById("searchBox")?.value.toLowerCase();
    let rows = document.querySelectorAll("#movieTable tbody tr");

    if (!searchQuery) return;

    // można szukać po tytule, reżyserze, gatunku, roku wydania
    rows.forEach(row => {
        let title = row.cells[1]?.textContent.toLowerCase() || "";
        let director = row.cells[3]?.textContent.toLowerCase() || "";
        let genre = row.cells[4]?.textContent.toLowerCase() || "";
        let releaseYear = row.cells[2]?.textContent.toLowerCase() || "";

        if (title.includes(searchQuery) || director.includes(searchQuery) || genre.includes(searchQuery) || releaseYear.includes(searchQuery)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

// sortowanie
function sortMovies() {
    let table = document.getElementById("movieTable");
    if (!table) return;

    let tbody = table.querySelector("tbody");
    let rows = Array.from(tbody.querySelectorAll("tr"));
    let sortBy = document.getElementById("sortSelect")?.value;

    if (!sortBy) return;

    let columnIndex = {
        "Title": 1,
        "ReleaseYear": 2,
        "AverageRating": 6,
        "Genre": 4
    }[sortBy];

    if (columnIndex === undefined) return;

    rows.sort((a, b) => {
        let aValue = a.cells[columnIndex]?.textContent.trim() || "";
        let bValue = b.cells[columnIndex]?.textContent.trim() || "";

        // sortowanie w przypadku danych liczbowych
        if (sortBy === "ReleaseYear" || sortBy === "AverageRating") {
            return (parseFloat(aValue) || 0) - (parseFloat(bValue) || 0);
        }
        return aValue.localeCompare(bValue);
    });

    tbody.innerHTML = "";
    rows.forEach(row => tbody.appendChild(row));
}
