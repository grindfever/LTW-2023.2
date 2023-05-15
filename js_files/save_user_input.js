const initialFormData = {
  username: document.querySelector('#username').value || '',
  first_name: document.querySelector('#first_name').value || '',
  last_name: document.querySelector('#last_name').value || '',
  email_address: document.querySelector('#email_address').value || '',
  phone_number: document.querySelector('#phone_number').value || '',
  home_address: document.querySelector('#home_address').value || '',
  postal_code: document.querySelector('#postal_code').value || '',
  password: document.querySelector('#password').value || '',
  confirm_password: document.querySelector('#confirm_password').value || ''
};

// Restore the form data if the user navigates back to the page
window.addEventListener('load', function() {
  const savedFormData = JSON.parse(sessionStorage.getItem('formData'));
  if (savedFormData) {
    document.querySelector('#username').value = savedFormData.username || '';
    document.querySelector('#first_name').value = savedFormData.first_name || '';
    document.querySelector('#last_name').value = savedFormData.last_name || '';
    document.querySelector('#email_address').value = savedFormData.email_address || '';
    document.querySelector('#phone_number').value = savedFormData.phone_number || '';
    document.querySelector('#home_address').value = savedFormData.home_address || '';
    document.querySelector('#postal_code').value = savedFormData.postal_code || '';
    document.querySelector('#password').value = savedFormData.password || '';
    document.querySelector('#confirm_password').value = savedFormData.confirm_password || '';
  }
});

// Save the form data when the user leaves the page
window.addEventListener('beforeunload', function() {
  const formData = {
    username: document.querySelector('#username').value || '',
    first_name: document.querySelector('#first_name').value || '',
    last_name: document.querySelector('#last_name').value || '',
    email_address: document.querySelector('#email_address').value || '',
    phone_number: document.querySelector('#phone_number').value || '',
    home_address: document.querySelector('#home_address').value || '',
    postal_code: document.querySelector('#postal_code').value || '',
    password: document.querySelector('#password').value || '',
    confirm_password: document.querySelector('#confirm_password').value || ''
  };
  sessionStorage.setItem('formData', JSON.stringify(formData));
});

  