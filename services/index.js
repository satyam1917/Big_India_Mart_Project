document.addEventListener("DOMContentLoaded", () => {
  const services = [
    {
      id: 1,
      title: "Educational Service",
      description:
        "Education\n\nWe believe in the power of education to transform lives. Our educational services are designed to help students of all ages achieve their academic goals. Whether you need tutoring, career counseling, or specialized courses, our team of experienced educators is here to guide you every step of the way.\n\n<h3>Our Services Include:</h3>\n<ul><li>Tutoring: Personalized tutoring sessions for a variety of subjects, tailored to your learning style and academic needs.</li><li>Career Counseling: Expert advice to help you choose the right career path and achieve your professional goals.</li><li>Specialized Courses: Courses in specialized subjects such as coding, language learning, and more, designed to enhance your skills and knowledge.</li></ul>",
    },
    {
      id: 2,
      title: "Legal Service",
      description:
        "Legal Opinion\n\nNavigating legal matters can be complex and overwhelming. Our team of expert lawyers is here to provide you with professional legal opinions and advice. We cover a wide range of legal issues to ensure you have the support you need to make informed decisions.\n\n<h3>Our Services Include:</h3>\n<ul><li>Consultations: One-on-one consultations to discuss your legal concerns and provide you with tailored advice.</li><li>Document Review: Thorough review of legal documents to ensure they meet your needs and comply with the law.</li><li>Representation: Legal representation in various legal proceedings and negotiations.</li><li>Company Registration: Assistance with the entire process of registering your business, including preparing and filing necessary documents, ensuring compliance with legal requirements, and providing ongoing legal support for your business operations.</li></ul>",
    },
    {
      id: 3,
      title: "Banking Service",
      description:
        "Manage Your Finances with Ease\n\nOur banking services at Big India Mart are designed to help you manage your finances efficiently. From setting up accounts to applying for loans, we offer a wide range of services to meet your financial needs.\n\n<h3>Our Services Include:</h3>\n<ul><li>Account Setup: Assistance with setting up savings, checking, and business accounts.</li><li>Loan Applications: Help with applying for personal, business, and mortgage loans.</li><li>Financial Planning: Expert financial planning services to help you achieve your financial goals.</li></ul>",
    },
    {
      id: 4,
      title: "Insurance Service",
      description:
        "Protect What Matters Most\n\nWe offer comprehensive insurance services to provide you with the peace of mind you deserve. From health and life insurance to property and auto insurance, we have you covered.\n\n<h3>Our Services Include:</h3>\n<ul><li>Health Insurance: Comprehensive health coverage for you and your family.</li><li>Life Insurance: Life insurance plans to secure your loved ones' future.</li><li>Property Insurance: Protect your home and belongings with our property insurance plans.</li><li>Auto Insurance: Coverage options to keep you and your vehicle safe on the road.</li></ul>",
    },
    {
      id: 5,
      title: "House Rent Service",
      description:
        "Find Your Perfect Home\n\nFinding the right home can be a challenging process. We make it easy for you to find and rent your ideal home. Our extensive selection of properties and personalized service ensure a smooth and hassle-free rental experience.\n\n<h3>Our Services Include:</h3>\n<ul><li>Property Listings: A wide range of properties to suit every need and budget.</li><li>Rental Assistance: Help with the entire rental process, from viewing properties to signing the lease.</li><li>Property Management: Ongoing support and management to ensure your rental experience is positive.</li></ul>",
    },
    {
      id: 6,
      title: "Grocery",
      description:
        "Convenient Grocery Shopping\n\nGet all your grocery needs delivered right to your doorstep with Big India mart. We offer a wide range of fresh and high-quality products, making your shopping experience convenient and easy.\n\n<h3>Our Services Include:</h3>\n<ul><li>Online Shopping: Browse our extensive selection of groceries online.</li><li>Home Delivery: Fast and reliable delivery service to bring your groceries to you.</li><li>Quality Assurance: Fresh and high-quality products guaranteed.</li></ul>",
    },
    {
      id: 7,
      title: "Shopping",
      description:
        "A New Way to Shop\n\nDiscover a new and exciting way to shop with Big India Mart. We offer a diverse range of products, from fashion to electronics, all available at the best prices. Our platform allows you to shop from various products across multiple stores, ensuring you have access to the best deals and a wide selection.\n\n<h3>Our Services Include:</h3>\n<ul><li>Product Variety: A wide selection of products from various stores to meet all your shopping needs, including fashion, electronics, home goods, and more.</li><li>Exclusive Deals: Access to exclusive deals and discounts, making sure you get the best value for your money.</li><li>Customer Support: Dedicated support to assist you with any inquiries or issues, ensuring a smooth and satisfying shopping experience.</li><li>Multiple Store Options: Shop from a variety of trusted stores, giving you the flexibility to choose products that best suit your preferences and budget.</li></ul>",
    },
    {
      id: 8,
      title: "Daily Needs",
      description:
        "Meet Your Daily Needs with Ease\n\nWe provide a comprehensive range of services to meet your daily needs. From household essentials to personal care products, we ensure you have everything you need at your fingertips.\n\n<h3>Our Services Include:</h3>\n<ul><li>Household Essentials: A wide variety of essential household items.</li><li>Personal Care Products: Quality personal care products for your everyday needs.</li><li>Convenient Delivery: Fast and reliable delivery service to bring your essentials to you.</li></ul>",
    },
    {
      id: 9,
      title: "Construction Material Supply Service",
      description:
        "Quality Construction Materials\n\nGet the best quality construction materials for your projects with Big India Mart. We understand that the foundation of any construction project is the quality of the materials used. That's why we supply a wide range of high-quality construction materials to ensure your work is efficient and meets the highest standards.\n\n<h3>Our Services Include:</h3>\n<ul><li>Material Supply: We offer a comprehensive range of construction materials, including cement, steel, bricks, sand, gravel, electrical supplies, plumbing supplies, and more. Whether you're working on residential, commercial, or industrial projects, we have the materials you need.</li><li>Quality Assurance: We are committed to providing only the best materials. All our products are sourced from reputable manufacturers and are guaranteed to meet industry standards. We perform rigorous quality checks to ensure the materials you receive are durable and reliable.</li><li>Timely Delivery: We understand the importance of timely delivery in construction projects. Our efficient logistics network ensures that your materials arrive on time, every time. We offer flexible delivery options to suit your schedule and project requirements.</li><li>Custom Orders: If you have specific material requirements, we can accommodate custom orders. Our team will work with you to source and supply the exact materials you need for your unique project.</li><li>Expert Advice: Our experienced staff is available to provide expert advice on material selection and usage. We can help you choose the best materials for your project, ensuring optimal performance and cost-effectiveness.</li></ul>",
    },
    {
      id: 10,
      title: "Civil Construction Service",
      description:
        "Professional Civil Construction Services\n\nBuild your dreams with our professional civil construction services at Big India Mart. Our experienced team provides comprehensive construction solutions for residential, commercial, and industrial projects. We are committed to delivering high-quality workmanship, on-time project completion, and exceptional customer satisfaction.\n\n<h3>Our Services Include:</h3>\n<ul><li>Residential Construction: Building quality homes to meet your specifications. From single-family homes to multi-unit complexes, we handle every aspect of residential construction with precision and care.</li><li>Commercial Construction: Constructing commercial spaces tailored to your business needs. Whether it's an office building, retail space, or hospitality project, we ensure your commercial property meets your operational requirements and aesthetic preferences.</li><li>Industrial Construction: Providing robust and efficient industrial construction services. We specialize in constructing warehouses, manufacturing plants, and other industrial facilities that are designed to optimize productivity and safety.</li><li>Labor Supply: Providing skilled and unskilled labor for your construction projects. We understand that a successful construction project requires a dedicated and competent workforce. Our labor supply services include a pool of experienced workers, including masons, carpenters, electricians, plumbers, and general laborers, ready to meet the demands of your project.</li></ul>",
    },
    {
      id: 11,
      title: "Tour And Travels",
      description:
        "Explore the World with Us\n\nDiscover new destinations and create unforgettable memories with tour and travel services. We offer customized travel packages, ticket bookings, and comprehensive travel planning to ensure your trips are memorable and hassle-free.\n\n<h3>Our Services Include:</h3>\n<ul><li>Customized Travel Packages: Tailored travel packages to suit your preferences and budget.</li><li>Ticket Bookings: Assistance with booking flights, trains, and other transportation.</li><li>Travel Planning: Expert travel planning to ensure a smooth and enjoyable trip.</li></ul>",
    },
    {
      id: 12,
      title: "Event Management Service",
      description:
        "Create Unforgettable Events\n\nMake your events unforgettable with Big India Mart's professional event management services. From corporate events to weddings, our expert planners ensure every detail is taken care of, making your event a success.\n\n<h3>Our Services Include:</h3>\n<ul><li>Corporate Events: Professional planning for conferences, seminars, and corporate parties.</li><li>Weddings: Comprehensive wedding planning to make your special day perfect.</li><li>Social Events: Planning and management of social events, including birthdays, anniversaries, and more.</li></ul>",
    },
    {
      id: 13,
      title: "Tax Consultancy Service",
      description:
        "At Big India Mart, our tax consultancy services are tailored to ensure you navigate the complexities of taxes with confidence. We provide comprehensive support to meet all your tax-related needs, from individual tax returns to corporate tax planning.\n\n<h3>Our Services Include:</h3>\n<ul><li>Tax Preparation: Professional assistance with preparing and filing individual and business tax returns.</li><li>Tax Planning: Strategic tax planning to optimize your tax situation and minimize liabilities.</li><li>Audit Support: Expert guidance and representation in case of tax audits or inquiries from tax authorities.</li><li>Corporate Tax Services: Specialized services for corporate tax compliance, including VAT and GST management.</li></ul>",
    }
  ];

  const serviceList = document.getElementById("service-list");
  const serviceDetails = document.getElementById("service-details");
  const serviceTitle = document.getElementById("service-title");
  const serviceDescription = document.getElementById("service-description");
  const registerButton = document.getElementById("register-button");

  services.forEach((service) => {
    const serviceItem = document.createElement("div");
    serviceItem.className = "service-item";
    serviceItem.id="service-item";
    serviceItem.textContent = service.title;
    serviceItem.addEventListener("click", () => {
      showServiceDetails(service);
      // Automatically scroll the service into view
      serviceItem.scrollIntoView({ behavior: "smooth", block: "center" });
    });
    serviceList.appendChild(serviceItem);
  });
  serviceList.addEventListener('click',function () {
    serviceList.style.marginLeft="-250px";
    serviceList.style.transition="margin 1s";
  });

  function showServiceDetails(service) {
    serviceTitle.textContent = service.title;
    serviceDescription.innerHTML = service.description; // Use innerHTML to render HTML content
    registerButton.onclick = () => registerForService(service.id);
    serviceDetails.classList.add("show");
  }

  const urlParams = new URLSearchParams(window.location.search);
  const serviceId = urlParams.get("serviceId");
  if (serviceId) {
    const selectedService = services.find((s) => s.id === parseInt(serviceId));
    showServiceDetails(selectedService);
    serviceList.style.marginLeft="-250px";
    serviceList.style.transition="margin 1s";
  }

  function registerForService(serviceId) {
    const text = "Do you really want to register?";
    if (confirm(text) == true) {
      let message = document.getElementById("message").value;
      jQuery.ajax({
        url: "add_data.php",
        type: "POST",
        data: {
          service: services[serviceId - 1].title,
          message:message
        },
        success: function (result) {
          if (result == "ok") {
            window.location.href = "../dashboard/index.php";
          } else {
            alert(result);
          }
        },
      });
    }
  }
  const menuToggle = document.getElementById("menu-toggle");
  const closeDrawer = document.getElementById("close-drawer");
  const drawerMenu = document.getElementById("drawer-menu");
  const mainContent = document.querySelector("main");

  menuToggle.addEventListener("click", function () {
    drawerMenu.classList.toggle("open");
    mainContent.classList.toggle("drawer-open");
  });

  closeDrawer.addEventListener("click", function () {
    drawerMenu.classList.remove("open");
    mainContent.classList.remove("drawer-open");
  });

  
});
