document.addEventListener("DOMContentLoaded", function() {
    const sections = document.querySelectorAll(".fade-in");
  
    const observer = new IntersectionObserver(
      entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add("show");
            observer.unobserve(entry.target); // Optional: stops observing once the element is shown
          }
        });
      },
      { threshold: 0.1 }
    );
  
    sections.forEach(section => {
      observer.observe(section);
    });
  });
  