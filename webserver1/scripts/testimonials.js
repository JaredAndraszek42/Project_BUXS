const testimonials = [
    { text: "Click Me", author: "Flint H.", clue: "There is a clue here....."},
    { text: "Switching to Lumino was one of the best decisions we made for our startup. The performance is unmatched, and our application loads significantly faster than before. Their global data centers ensure our customers experience minimal latency no matter where they are. The support team is also incredibly responsive—whenever we’ve had questions, they’ve been quick to help. Highly recommended!", author: "David R. (Startup Founder)", clue: "There is a clue here...."},
    { text: "Security and reliability were our top concerns when moving to the cloud, and Lumino delivered beyond expectations. We’ve experienced zero downtime since migrating, and their automated scaling features helped us cut costs by 30%. The intuitive dashboard makes managing our infrastructure effortless. It’s clear they prioritize both performance and customer satisfaction.", author: "Sarah W. (CTO of a SaaS Company)", clue: "There is a clue here..."},
    { text: "As a developer, I need a fast and flexible cloud provider, and Lumino has been an absolute game-changer. Deploying applications is seamless, and the documentation is well-written, making onboarding a breeze. I was particularly impressed with how easy it was to integrate their serverless computing services into my projects. If you’re looking for reliability, Lumino is the way to go!", author: "Mark S. (Freelance Developer)", clue: "There is a clue here.."},
    { text: "Our e-commerce platform saw a 40% improvement in page load speed after switching to Lumino. This directly translated to a better shopping experience and an increase in conversions. We also love the built-in security features, which give us peace of mind knowing our customers’ data is safe. If you need a cloud provider that’s both powerful and easy to use, look no further!", author: "Emily L. (E-commerce Business Owner)", clue: "There is a clue here."},
    { text: "Having worked with various cloud providers, I can confidently say that Lumino offers the best balance of performance, pricing, and support. Their infrastructure is fast and scalable, and their API integrations made our transition smooth. What really sets them apart, though, is the customer service—you’re not just another number to them. They take the time to ensure everything runs perfectly for your business.", author: "James T. (Tech Consultant)", clue: "Look at the URL in documents..."}
];

let index = 0;

function showTestimonial() {
    const box = document.getElementById("testimonial-box");
    const textElement = document.getElementById("testimonial-text");
    const authorElement = document.getElementById("testimonial-author");

    let currentTestimonial = testimonials[index];

    if (currentTestimonial.clue) {
	box.onclick = function () {
            alert(currentTestimonial.clue);
        };
    } else {
	box.onclick = null;
    }

    // Fade out first
    box.style.opacity = "0";

    setTimeout(() => {
        // Change content after fade out completes (1s delay)
        textElement.textContent = `"${testimonials[index].text}"`;
        authorElement.textContent = `- ${testimonials[index].author}`;

        // Fade in smoothly
        box.style.opacity = "1";
    }, 1000); // 1-second delay before fading back in

    // Move to the next testimonial
    index = (index + 1) % testimonials.length;
}

// Start cycle
setInterval(showTestimonial, 10000); // Now each testimonial lasts 10 seconds (including transition)
showTestimonial(); // Start immediately
