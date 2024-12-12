document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.querySelector('.contact-form form');
    const newsletterForm = document.querySelector('.newsletter-signup');
    const topicSelect = document.getElementById('topic');
    const customTopicContainer = document.getElementById('customTopicContainer');
    const customTopicInput = document.getElementById('customTopic');
    const emailInput = document.getElementById('newsletterEmail');

    emailjs.init('QN6ZWMxgzovaNwPuL');

    topicSelect.addEventListener('change', () => {
        if (topicSelect.value === 'Other') {
            customTopicContainer.style.display = 'block';
        } else {
            customTopicContainer.style.display = 'none';
            customTopicInput.value = '';
        }
    });

    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        clearErrors();

        const name = document.getElementById('name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
        const topic = topicSelect.value;
        const customTopic = customTopicInput.value.trim();

        if (!name) {
            alert('Error: Full name is required.');
            return;
        }
        if (!phone || !/^\d{3}-\d{3}-\d{4}$/.test(phone)) {
            alert('Error: Please enter a valid phone number format: 519-555-5555');
            return;
        }
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert('Error: Please enter a valid email address.');
            return;
        }
        if (topic === 'Select an option') {
            alert('Error: Please select a topic.');
            return;
        }
        if (topic === 'Other' && !customTopic) {
            alert('Error: Please specify your topic.');
            return;
        }
        if (!message) {
            alert('Error: A message is required.');
            return;
        }

        const data = {
            from_name: name,
            phone,
            email,
            topic: topic === 'Other' ? customTopic : topic,
            message,
        };

        emailjs
            .send('service_wgeoimg', 'template_fvq7w1k', data)
            .then((response) => {
                console.log('Message sent successfully:', response);
                alert('Your message has been sent successfully!');
                contactForm.reset();
                customTopicContainer.style.display = 'none';
            })
            .catch((error) => {
                console.error('Error sending message:', error);
                alert('An error occurred while sending your message. Please try again later.');
            });
    });

    newsletterForm.addEventListener('submit', (e) => {
        e.preventDefault();
        clearErrors();

        const email = emailInput.value.trim();

        if (!email) {
            alert('Error: Please enter an email to subscribe.');
            return;
        }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert('Error: Please enter a valid email address.');
            return;
        }

        const data = {
            to_name: 'Subscriber',
            email,
        };

        emailjs
            .send('service_wgeoimg', 'template_5r993dh', data)
            .then((response) => {
                console.log('Newsletter subscription email sent:', response);
                alert('Thank you for subscribing to our newsletter!');
                emailInput.value = '';
            })
            .catch((error) => {
                console.error('Error sending newsletter email:', error);
                alert('An error occurred while subscribing. Please try again later.');
            });
    });

    function clearErrors() {
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach((error) => (error.textContent = ''));

        const invalidFields = document.querySelectorAll('.invalid');
        invalidFields.forEach((field) => field.classList.remove('invalid'));
    }
});
