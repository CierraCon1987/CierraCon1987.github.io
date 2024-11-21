// Enlarge blog post and staff pick titles on hover, keep article titles blue and underlined
document.querySelectorAll('.blog-post h2 a, .staff-pick h3 a').forEach((title) => {
    title.style.transition = "transform 0.3s ease, color 0.3s ease";
    title.addEventListener("mouseover", () => {
      title.style.transform = "scale(1.1)";   // Enlarge title
      title.style.color = "#007bff";          // Keep blue color
      title.style.textDecoration = "underline"; // Add underline
    });
    title.addEventListener("mouseout", () => {
      title.style.transform = "scale(1)";     // Revert title size
      title.style.color = "#2F4F4F";          // Return to default color
      title.style.textDecoration = "none";    // Remove underline when not hovered
    });
  });
  
  // Fade-in effect for blog posts on scroll
  const blogPosts = document.querySelectorAll('.blog-post');
  const options = { threshold: 0.2 };  // Trigger fade-in when 20% of post is visible
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = 1;
        entry.target.style.transform = "translateY(0)";
        observer.unobserve(entry.target);  // Stop observing once it's visible
      }
    });
  }, options);
  
  blogPosts.forEach(post => {
    post.style.opacity = 0;
    post.style.transform = "translateY(50px)";
    post.style.transition = "opacity 0.5s ease, transform 0.5s ease";
    observer.observe(post);
  });
  
  // Add a hover effect to staff picks
  document.querySelectorAll('.staff-pick').forEach((pick) => {
    pick.style.transition = "transform 0.3s ease, box-shadow 0.3s ease";
    pick.addEventListener("mouseover", () => {
      pick.style.transform = "scale(1.03)";    // Slightly enlarge staff pick container
      pick.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.15)";  // Add shadow
    });
    pick.addEventListener("mouseout", () => {
      pick.style.transform = "scale(1)";
      pick.style.boxShadow = "0 2px 4px rgba(0, 0, 0, 0.1)";   // Revert shadow
    });
  });