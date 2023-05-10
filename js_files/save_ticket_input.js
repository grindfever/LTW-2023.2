const form = document.querySelector('form');

form.addEventListener('submit', function(event) {
  const formData = {
    ticket_title: document.querySelector('#ticket_title').value,
    department: document.querySelector('#department').value,
    description_text: document.querySelector('#description_text').value
  };
  sessionStorage.setItem('formData', JSON.stringify(formData));
});

window.addEventListener('load', function() {
  const savedFormData = JSON.parse(sessionStorage.getItem('formData'));
  if (savedFormData) {
    document.querySelector('#ticket_title').value = savedFormData.ticket_title ? savedFormData.ticket_title : '';
    document.querySelector('#department').value = savedFormData.department ? savedFormData.department : '';
    document.querySelector('#description_text').value = savedFormData.description_text ? savedFormData.description_text : '';
  }
});



  
  
