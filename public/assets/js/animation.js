
const rippleBtns = document.getElementsByClassName("ripple");

function createRipple(event) {
  // Create the ripple span element
  let ripples = document.createElement("span");
  
  // Calculate the position relative to the button element
  let x = event.clientX - event.target.getBoundingClientRect().left;
  let y = event.clientY - event.target.getBoundingClientRect().top;
  
  // Set the position of the ripple within the button element
  ripples.style.left = x + "px";
  ripples.style.top = y + "px";
  
  // Append the ripple to the button
  event.target.appendChild(ripples);
  
  // Set a timeout to remove the ripple after 1000 milliseconds
  let clearTimeoutHandle = setTimeout(() => {
    ripples.remove();
  }, 1000);

  // Remove the ripple immediately if the mouse leaves the button
  event.target.addEventListener("mouseout", function () {
    clearTimeout(clearTimeoutHandle);
    ripples.remove();
  });
}

// Attach the createRipple function to each button
for (let i = 0; i < rippleBtns.length; i++) {
  const rippleBtn = rippleBtns[i];
  rippleBtn.addEventListener("mouseover", createRipple);
}


(function () {
  var parent = document.querySelector("#rangeSlider");
  if (!parent) return;
 
  var rangeS = parent.querySelectorAll("input[type=range]"),
    numberS = parent.querySelectorAll("input[type=number]");
 
  rangeS.forEach(function (el) {
    el.oninput = function () {
      var slide1 = parseFloat(rangeS[0].value),
        slide2 = parseFloat(rangeS[1].value);
 
      if (slide1 > slide2) {
        [slide1, slide2] = [slide2, slide1];
      }
 
      numberS[0].value = slide1;
      numberS[1].value = slide2;
    };
  });
 
  numberS.forEach(function (el) {
    el.oninput = function () {
      var number1 = parseFloat(numberS[0].value),
        number2 = parseFloat(numberS[1].value);
 
      if (number1 > number2) {
        var tmp = number1;
        numberS[0].value = number2;
        numberS[1].value = tmp;
      }
 
      rangeS[0].value = number1;
      rangeS[1].value = number2;
    };
  });
 })();


// line progress bar

let progress = $('#progress1').LineProgressbar({
  percentage: 100
});

let progress2 = $('#progress2').LineProgressbar({
  percentage: 98
});

let progress3 = $('#progress3').LineProgressbar({
  percentage: 97
});


if($('.reveal').length){gsap.registerPlugin(ScrollTrigger);let revealContainers=document.querySelectorAll(".reveal");revealContainers.forEach((container)=>{let image=container.querySelector("img");let tl=gsap.timeline({scrollTrigger:{trigger:container,toggleActions:"play none none none"}});tl.set(container,{autoAlpha:1});tl.from(container,1.5,{xPercent:-100,ease:Power2.out});tl.from(image,1.5,{xPercent:100,scale:1.3,delay:-1.5,ease:Power2.out});});}




// Create a circular progress bar using canvas
// you can change this class in here and in HTML file
var circlularProgress = document.querySelectorAll('.circularProgressMAF');
// some colors
var progressColor = ['#F0C73C', '#F0C73C', '#87D37C', '#F89406'];
var rad = Math.PI / 180;
var startArc = 270;
var fontSize = 22;
var i;

for (i = 0;i < circlularProgress.length;i++) {
  var ctx = circlularProgress[i].getContext('2d');
  var cd = circlularProgress[i].parentElement.clientWidth;
  circlularProgress[i].width = circlularProgress[i].height = cd;
  var progressValue = circlularProgress[i].getAttribute('data-progress-value');
  var endArc = (progressValue / 100) * 360;
  // create the circle
  ctx.arc(cd/2, cd/2, cd/6, startArc * rad,(startArc + endArc) * rad, false);
  // set the colors
  ctx.strokeStyle = progressColor[i];
  ctx.lineWidth = 5;
  ctx.textAlign = 'center';
  ctx.font = fontSize + 'px arial';
  ctx.fillText(progressValue + '%', cd/2, (fontSize + cd)/2);
  ctx.stroke();
}


// function openNav() {
//  // document.getElementById("sidebar").style.width = "400px"; /* Adjust width as needed */
//   document.getElementById("sidebar").style.right = "0px"; /* Adjust width as needed */
//   //document.getElementById("sidebar").style.padding = "30px"; /* Adjust width as needed */
//   document.getElementById("overlay").style.width = "100%"; /* Show overlay */
// }

// function closeNav() {
//  // document.getElementById("sidebar").style.width = "0";
//  document.getElementById("sidebar").style.right = "-460px"; /* Adjust width as needed */
//   document.getElementById("overlay").style.width = "0"; /* Hide overlay */
// }

// pricing of domain 

// const sliderInput = document.querySelector('.slider-input');
// const featureElements = document.querySelectorAll('.feature p'); // For GHz, RAM, Storage
// const pricingText = document.querySelector('.pricing p'); // For Price

// // Define the options for each slider value
// const planOptions = {
//   1: { cpu: '2GHz Core', ram: '16 GB', storage: '100 GB', price: '$30.00/mo' },
//   2: { cpu: '3GHz Core', ram: '32 GB', storage: '150 GB', price: '$40.00/mo' },
//   3: { cpu: '4GHz Core', ram: '64 GB', storage: '200 GB', price: '$50.00/mo' }
// };

// // Update the plan details dynamically when the slider is moved
// sliderInput.addEventListener('input', () => {
//   const value = sliderInput.value; // Get the current slider value
//   if (planOptions[value]) {
//     // Update the feature values
//     featureElements[0].textContent = planOptions[value].cpu;      // Update CPU
//     featureElements[1].textContent = planOptions[value].ram;      // Update RAM
//     featureElements[2].textContent = planOptions[value].storage;  // Update Storage
//     // Update the pricing text
//     pricingText.textContent = planOptions[value].price;           // Update Price
//   }
// });

// Preloader Script
// window.addEventListener("load", function () {
//   const preloader = document.getElementById("preloader");
//   const mainContent = document.getElementById("main-content");

//   // Simulate a delay for the preloader (you can remove this in production)
//   setTimeout(() => {
//     // Add exit animation class
//     preloader.classList.add("preloader-exit");

//     // Hide preloader and show main content after animation completes
//     setTimeout(() => {
//       preloader.style.display = "none";
//       mainContent.style.display = "block";
//     }, 500); // Match the duration of the exit animation
//   }, 3000); // Adjust the delay to match the preloader duration
// });

// Preloader Script
// window.addEventListener("load", function () {
//   const preloader = document.getElementById("preloader");
//   const mainContent = document.getElementById("main-content");

//   // Simulate a delay for the preloader (you can remove this in production)
//   setTimeout(() => {
//     // Add exit animation class
//     preloader.classList.add("preloader-exit");

//     // Hide preloader and show main content after animation completes
//     setTimeout(() => {
//       preloader.style.display = "none";
//       mainContent.style.display = "block";
//     }, 400); // Match the duration of the exit animation
//   }, 1500); // Adjust the delay to match the preloader duration
// });

// Preloader Script
// window.addEventListener("load", function () {
//   const preloader = document.getElementById("preloader");
//   const mainContent = document.getElementById("main-content");
//   const progressBar = document.querySelector(".progress-bar");

//   // Capture the time from DOMContentLoaded to window load
//   const loadTime = performance.now() / 1000; // Convert to seconds

//   // Set progress bar animation dynamically
//   progressBar.style.animation = `progress ${loadTime}s ease-in-out forwards`;

//   // Hide preloader and show main content after the progress completes
//   setTimeout(() => {
//     preloader.classList.add("preloader-exit");

//     setTimeout(() => {
//       preloader.style.display = "none";
//       mainContent.style.display = "block";
//     }, 500); // Adjust for exit animation
//   }, loadTime * 1000); // Convert back to milliseconds
// });


window.addEventListener("load", function () {
  const preloader = document.getElementById("preloader");
  const progressBar = document.querySelector(".progress-bar");

  // Ensure elements exist
  if (!preloader || !progressBar) {
      console.error("Preloader or Progress Bar not found in the DOM.");
      return;
  }

  // Calculate actual load time
  const loadTime = performance.now() / 1000; // Convert milliseconds to seconds

  // Apply dynamic animation duration to progress bar
  progressBar.style.animation = `progress ${loadTime}s ease-in-out forwards`;

  // Remove preloader after progress completes
  setTimeout(() => {
      preloader.classList.add("preloader-exit");

      setTimeout(() => {
          preloader.style.display = "none";
      }, 300); // Match exit animation time
  }, loadTime * 500); // Convert seconds back to milliseconds
});
