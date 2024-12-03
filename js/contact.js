document.addEventListener('DOMContentLoaded', () => {
  const contactForm = document.querySelector('.contact-form form');
  const topicSelect = document.getElementById('topic');
  const customTopicContainer = document.getElementById('customTopicContainer');
  const customTopicInput = document.getElementById('customTopic');

  topicSelect.addEventListener('change', () => {
      if (topicSelect.value === 'Other') {
          customTopicContainer.style.display = 'block';
      } else {
          customTopicContainer.style.display = 'none';
          customTopicInput.value = ''; // Clear input if "Other" is deselected
      }
  });

  contactForm.addEventListener('submit', (e) => {
      e.preventDefault(); 
      clearErrors();
      
      // Form field values
      const name = document.getElementById('name').value.trim();
      const phone = document.getElementById('phone').value.trim();
      const email = document.getElementById('email').value.trim();
      const message = document.getElementById('message').value.trim();
      const topic = topicSelect.value;
      const customTopic = customTopicInput.value.trim();

      let hasError = false;

      // Validation
      if (!name) {
          showError('name', 'Full name is required.');
          hasError = true;
      }
      
      if (!phone || !/^\d{3}-\d{3}-\d{4}$/.test(phone)) {
          showError('phone', 'Please enter a valid phone number format: 519-555-5555');
          hasError = true;
      }
      
      if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
          showError('email', 'Please enter a valid email address.');
          hasError = true;
      }
      
      if (topic === 'Select an option') {
          showError('topic', 'Please select a topic.');
          hasError = true;
      } else if (topic === 'Other' && !customTopic) {
          showError('customTopic', 'Please specify your topic.');
          hasError = true;
      }
      
      if (!message) {
          showError('message', 'A message is required.');
          hasError = true;
      }

      if (!hasError) {
          alert(`Thank you for contacting us, ${name}! We will respond within 24-48 hours.`);
          contactForm.reset();
          customTopicContainer.style.display = 'none'; // Hide custom topic field on successful submission
      }
  });

  function showError(fieldId, message) {
      const field = document.getElementById(fieldId);
      const errorSpan = document.getElementById(`${fieldId}Error`);
      
      field.classList.add('invalid');
      errorSpan.textContent = message;
  }

  function clearErrors() {
      const errorMessages = document.querySelectorAll('.error-message');
      errorMessages.forEach(error => error.textContent = '');
      
      const invalidFields = document.querySelectorAll('.invalid');
      invalidFields.forEach(field => field.classList.remove('invalid'));
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const contactForm = document.querySelector('.contact-form form');
  const newsletterForm = document.querySelector('.newsletter-signup');
  const emailInput = document.getElementById('newsletterEmail');
  
  // Clear any existing error messages
  function clearErrors() {
      const errorMessages = document.querySelectorAll('.error-message');
      errorMessages.forEach(error => error.textContent = '');

      const invalidFields = document.querySelectorAll('.invalid');
      invalidFields.forEach(field => field.classList.remove('invalid'));
  };
});

  // Newsletter Signup Submit Handler
  document.getElementById('newsletterForm').addEventListener('submit', function (e) {
    e.preventDefault(); 

    const email = document.getElementById('newsletterEmail').value;
    const messageElement = document.getElementById('newsletterMessage');

    messageElement.textContent = '';

    // Simulating a successful subscription
    if (email) {
        messageElement.textContent = "Thank you for subscribing to our newsletter!";
        messageElement.style.color = "green"; 
    } else {
        messageElement.textContent = "Please enter a valid email.";
        messageElement.style.color = "red"; 
    }
});


function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -34.397, lng: 150.644},
      zoom: 8
    });
};
