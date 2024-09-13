// // chat system
// const input = document.getElementById("inputMessege");
// const more = document.getElementById("moreInput");
// const send = document.getElementById("send");

// input.addEventListener("input", () => {
//   if (input.value !== "") {
//     more.style.display = "none";
//     send.classList.replace("fa-thumbs-up", "fa-paper-plane");
//   } else {
//     more.style.display = "flex";
//     send.classList.replace("fa-paper-plane", "fa-thumbs-up");
//   }
// });

// const infoBtn = document.getElementById("infoBtn");
// const info = document.getElementById("info");
// infoBtn.addEventListener("click", () => {
//   info.classList.toggle("d-none-toggle");
// });

// GPT
// Elements
const input = document.getElementById("inputMessege");
const more = document.getElementById("moreInput");
const send = document.getElementById("send");
const infoBtn = document.getElementById("infoBtn");
const info = document.getElementById("info");

// Helper function
const toggleSendIcon = (condition) => {
  more.style.display = condition ? "none" : "flex";
  send.classList.toggle("fa-paper-plane", condition);
  send.classList.toggle("fa-thumbs-up", !condition);
};

// Event listeners
input.addEventListener("input", () => toggleSendIcon(input.value !== ""));
infoBtn.addEventListener("click", () => info.classList.toggle("d-none-toggle"));

// -------------------- scrol event --------------------
const scrollableDiv = document.getElementById("scrollableDiv");
const targetElement = document.getElementById("targetElement");

scrollableDiv.addEventListener("scroll", () => {
  if (scrollableDiv.scrollTop > 0) {
    // Kalau udah di-scroll sedikit
    targetElement.style.borderBottom = "1px solid var(--darkSilver)";
  } else {
    // Kalau masih di posisi paling atas
    targetElement.style.border = "none";
  }
});
