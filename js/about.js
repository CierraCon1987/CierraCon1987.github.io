// Image zoom effect on hover with a smaller scale
document.querySelectorAll('img').forEach((img) => {
    img.style.transition = "transform 0.3s ease";
    img.addEventListener("mouseover", () => {
        img.style.transform = "scale(1.05)";  // Slight zoom in
    });
    img.addEventListener("mouseout", () => {
        img.style.transform = "scale(1)";    // Zoom out
    });
});
  
  // Button animation on hover
  document.querySelectorAll('.cta-button, .deal button').forEach((button) => {
    button.style.transition = "transform 0.2s ease, background-color 0.3s ease";
    button.addEventListener("mouseover", () => {
      button.style.transform = "scale(1.05)";
      button.style.backgroundColor = "#ff5722";  // Change to a darker shade on hover
    });
    button.addEventListener("mouseout", () => {
      button.style.transform = "scale(1)";
      button.style.backgroundColor = "#ff7a50";  // Revert to original color
    });
  });
  
  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", (e) => {
      e.preventDefault();
      const targetId = anchor.getAttribute("href").substring(1);
      document.getElementById(targetId)?.scrollIntoView({
        behavior: "smooth"
      });
    });
  });