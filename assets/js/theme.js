// Sample JavaScript file for Hello Plus theme
document.addEventListener('DOMContentLoaded', function() {
  const menuToggle = document.querySelector('.menu-toggle')
  const navigation = document.querySelector('.main-navigation')

  if (menuToggle && navigation) {
    menuToggle.addEventListener('click', function() {
      navigation.classList.toggle('active')
      menuToggle.classList.toggle('active')
    })
  }

  // Smooth scrolling for anchor links
  const anchorLinks = document.querySelectorAll('a[href^="#"]')
  anchorLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault()
      const targetId = this.getAttribute('href').substring(1)
      const targetElement = document.getElementById(targetId)

      if (targetElement) {
        targetElement.scrollIntoView({
          behavior: 'smooth'
        })
      }
    })
  })
})
