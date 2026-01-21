const filterButton = document.getElementById('filter-button');
const filterOptions = document.getElementById('filter-options');

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            searchForm.submit();
        }
    });
    
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            searchForm.submit();
        }, 500); 
    });
});
filterButton.addEventListener('click', () => {
    filterOptions.style.display = filterOptions.style.display === 'none' ? 'block' : 'none';
});

document.addEventListener('click', (e) => {
    if (!filterButton.contains(e.target) && !filterOptions.contains(e.target)) {
        filterOptions.style.display = 'none';
    }
});

let searchTimeout;
document.getElementById('searchInput').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        document.getElementById('searchForm').submit();
    }, 500); // Wait 500ms after user stops typing
});