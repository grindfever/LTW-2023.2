var filterTypeSelect = document.getElementById('filter-type-select');
var filterOptions = document.getElementById('filter-options').children;

// Hide all filter options initially
for (var i = 0; i < filterOptions.length; i++) {
  filterOptions[i].style.display = 'none';
}

filterTypeSelect.addEventListener('change', function() {
  var selectedOption = filterTypeSelect.value;

  // Hide all filter options
  for (var i = 0; i < filterOptions.length; i++) {
    filterOptions[i].style.display = 'none';
  }

  // Show the selected filter option
  if (selectedOption) {
    var selectedFilter = document.getElementById(selectedOption + '-filter');
    selectedFilter.style.display = 'block';
  }
});


  