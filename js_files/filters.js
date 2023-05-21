// Attach event listener to the filter type select element
document.getElementById('filter-type-select').addEventListener('change', function() {
    // Get the selected filter type
    var filterType = this.value;
  
    // Get the filter options container
    var filterOptions = document.getElementById('filter-options');
  
    // Hide all filter options
    Array.from(filterOptions.children).forEach(function(option) {
      option.style.display = 'none';
    });
  
    // Show the selected filter options
    var selectedFilterOption = document.getElementById(filterType + '-filter');
    selectedFilterOption.style.display = 'block';
  
    // Reset the selected value in the filter options
    selectedFilterOption.querySelector('select').value = 'all';
  });
  
  // Attach event listener to the filter options elements
  document.getElementById('department-select').addEventListener('change', applyFilter);
  document.getElementById('priority-select').addEventListener('change', applyFilter);
  document.getElementById('status-select').addEventListener('change', applyFilter);
  
  // Function to send AJAX request and update the filtered results
  function applyFilter() {
    // Get the selected filter values
    var departmentValue = document.getElementById('department-select').value;
    var priorityValue = document.getElementById('priority-select').value;
    var statusValue = document.getElementById('status-select').value;
  
    // Send AJAX request to the server
    // Update the PHP variable with the filtered results
  
    // Example AJAX code using Fetch API
    fetch('ticket_inbox.php', {
      method: 'POST',
      body: JSON.stringify({
        departmentValue: departmentValue,
        priorityValue: priorityValue,
        statusValue: statusValue
      })
    })
    .then(function(response) {
      return response.json();
    })
    .then(function(data) {
      // Update the UI with the filtered results
      document.getElementById('active_tickets').innerHTML = data.activeTickets;
    });
  }
  