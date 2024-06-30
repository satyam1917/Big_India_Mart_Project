let currentIndex = 0;
const images = document.querySelectorAll('.carousel-images img');
const totalImages = images.length;

function showNextImage() {
    currentIndex = (currentIndex + 1) % totalImages;
    updateCarousel();
}

function updateCarousel() {
    const newTransform = -currentIndex * 100 + '%';
    document.querySelector('.carousel-images').style.transform = `translateX(${newTransform})`;
}

setInterval(showNextImage, 2000);


$(document).ready(function() {
    // Function to auto rotate slider every 2 seconds
    function autoRotateSlider() {
      var currentSlide = $('.slider-wrapper .slider img.active');
      var nextSlide = currentSlide.next().length ? currentSlide.next() : currentSlide.siblings().first();
      currentSlide.removeClass('active');
      nextSlide.addClass('active');
    }
  
    // Set interval to call autoRotateSlider every 2 seconds
    setInterval(autoRotateSlider, 2000);
  });



  $(document).ready(function() {
    var currentIndex = 0;
    var slides = $('.slider img');
    var totalSlides = slides.length;
    var slideWidth = slides.eq(0).width(); // Assuming all images have the same width

    // Function to show the next slide
    function showNextSlide() {
        var newPosition = -(currentIndex * slideWidth);
        $('.slider').animate({ left: newPosition }, 1000);
        currentIndex = (currentIndex + 1) % totalSlides;
    }

    // Set interval to call showNextSlide every 2 seconds
    var intervalId = setInterval(showNextSlide, 2000);

    // Function to stop the auto rotation
    function stopAutoRotation() {
        clearInterval(intervalId);
    }

    // Function to restart the auto rotation
    function startAutoRotation() {
        intervalId = setInterval(showNextSlide, 2000);
    }

    // Pause auto rotation when mouse is over the slider
    $('.slider-wrapper').hover(stopAutoRotation, startAutoRotation);
});



document.addEventListener('DOMContentLoaded', () => {
    const services = [
      { id: 1, title: 'Grocery', description: 'Providing fresh and quality groceries to your doorstep. We ensure the best products reach you promptly, with a wide range of items from fresh produce to daily essentials.', image: 'https://via.placeholder.com/800x400' },
      { id: 2, title: 'Tax Consulting Service', description: 'Expert tax consulting to help you with your tax planning and compliance. Our experienced consultants offer personalized advice to maximize your tax savings and ensure full compliance.', image: 'https://via.placeholder.com/800x400' },
      { id: 3, title: 'Tours and Travel Service', description: 'Offering exciting travel packages and tours around the world. From adventure trips to relaxing getaways, we handle all your travel arrangements for a hassle-free experience.', image: 'https://via.placeholder.com/800x400' },
      { id: 4, title: 'Digital Sewa Service', description: 'Digital services including online applications and e-governance services. We assist in navigating government portals, filling applications, and ensuring timely submissions.', image: 'https://via.placeholder.com/800x400' },
      { id: 5, title: 'Event Management Service', description: 'Comprehensive event management solutions for all your events. From corporate events to weddings, we take care of everything to ensure your event is a success.', image: 'https://via.placeholder.com/800x400' },
      { id: 6, title: 'Mutual Fund Service', description: 'Investment advice and mutual fund management to grow your wealth. Our experts help you choose the right funds to meet your financial goals.', image: 'https://via.placeholder.com/800x400' },
      { id: 7, title: 'Share & Stock Trading', description: 'Real-time stock trading and investment services. We provide a platform for buying and selling shares, along with expert advice to maximize your returns.', image: 'https://via.placeholder.com/800x400' },
      { id: 8, title: 'Insurance Service', description: 'Offering a wide range of insurance products to protect you and your assets. From health to life insurance, we help you find the best coverage for your needs.', image: 'https://via.placeholder.com/800x400' },
      { id: 9, title: 'Courier and Cargo Service', description: 'Reliable courier and cargo services to ensure your packages arrive on time. We handle all types of shipments, providing tracking and secure delivery.', image: 'https://via.placeholder.com/800x400' },
      { id: 10, title: 'Civil Construction Service', description: 'Professional civil construction services for residential and commercial projects. Our skilled team handles all aspects of construction, from planning to execution.', image: 'https://via.placeholder.com/800x400' },
      { id: 11, title: 'Construction Material Supply Service', description: 'Supplying quality construction materials for your building projects. We offer a wide range of materials to ensure your project is completed with the best resources.', image: 'https://via.placeholder.com/800x400' },
      { id: 12, title: 'Man Power Supply', description: 'Providing skilled and unskilled manpower for various industries. We connect you with reliable workers to meet your labor needs efficiently.', image: 'https://via.placeholder.com/800x400' },
      { id: 13, title: 'Banking Service', description: 'Comprehensive banking services to cater to your financial needs. From savings accounts to loans, we offer a range of banking products and services.', image: 'https://via.placeholder.com/800x400' },
      { id: 14, title: 'House Rent Service', description: 'Find and rent houses and apartments with ease. Our platform connects you with property owners and helps you find the perfect home.', image: 'https://via.placeholder.com/800x400' },
      { id: 15, title: 'Education Service', description: 'Offering educational services and tutoring to help you excel. From academic support to professional training, we provide comprehensive educational solutions.', image: 'https://via.placeholder.com/800x400' },
      { id: 16, title: 'Tour And Travels', description: 'Organizing tours and travel services for memorable vacations. We plan and execute trips that cater to your preferences, ensuring an unforgettable experience.', image: 'https://via.placeholder.com/800x400' }
    ];
  
    const serviceList = document.getElementById('service-list');
    const serviceDetails = document.getElementById('service-details');
    const serviceTitle = document.getElementById('service-title');
    const serviceDescription = document.getElementById('service-description');
    const serviceImage = document.getElementById('service-image');
    const registerButton = document.getElementById('register-button');
  
    services.forEach(service => {
      // Create service list item
      const serviceItem = document.createElement('div');
      serviceItem.className = 'service-item';
      serviceItem.textContent = service.title;
      serviceItem.addEventListener('mouseover', () => {
        showServiceDetails(service);
        // Automatically scroll the service into view
        serviceItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
      });
      serviceList.appendChild(serviceItem);
  
      // Add event listener to image
      const serviceImage = document.getElementById(`image-${service.id}`);
      if (serviceImage) {
        serviceImage.addEventListener('click', () => {
          showServiceDetails(service);
          // Optionally, scroll the service details into view
          serviceDetails.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
      }
    });
  
    function showServiceDetails(service) {
      serviceTitle.textContent = service.title;
      serviceDescription.textContent = service.description;
      serviceImage.src = service.image;
      registerButton.onclick = () => registerForService(service.id);
      serviceDetails.classList.add('show');
    }
  
    function registerForService(serviceId) {
      alert(`Registered for service with ID: ${serviceId}`);
    }
  });

 
  
