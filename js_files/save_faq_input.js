const form = document.querySelector('form');

form.addEventListener('submit', function(event) {
  const formData = {
    faq_question: document.querySelector('#question').value,
    faq_answer: document.querySelector('#answer').value
  };
  sessionStorage.setItem('formData', JSON.stringify(formData));
});

window.addEventListener('load', function() {
  const savedFormData = JSON.parse(sessionStorage.getItem('formData'));
  if (savedFormData) {
    document.querySelector('#question').value = savedFormData.faq_question ? savedFormData.faq_question : '';
    document.querySelector('#answer').value = savedFormData.faq_answer ? savedFormData.faq_answer : '';
  }
});