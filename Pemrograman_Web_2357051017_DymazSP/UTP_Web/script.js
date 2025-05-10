function zoomToPage(target) {
    const character = document.getElementById('character');
    character.classList.remove('zoom-out');
    character.classList.add('zoom-in');
  
    setTimeout(() => {
      window.location.href = target;
    }, 800);
  }
  document.querySelectorAll('.nav-vertical a').forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const character = document.getElementById('character');
      character.classList.add('zoom-in');
      setTimeout(() => {
        window.location.href = link.href;
      }, 700); // delay agar animasi jalan dulu
    });
  });
  
  // Fungsi Back: zoom-out ke kanan, lalu kembali ke index
function zoomOutAndBack() {
  const character = document.getElementById("character");
  character.classList.remove("zoomed-left");
  character.classList.add("zoom-out-right");

  setTimeout(() => {
    window.location.href = "index.html";
  }, 800);
}


  
const character = document.getElementById('character');
const links = document.querySelectorAll('.nav-link');

document.querySelectorAll(".nav-link").forEach(link => {
  link.addEventListener("click", (e) => {
    e.preventDefault();
    const page = link.getAttribute("data-page");
    const character = document.getElementById("character");

    // Tambahkan kelas animasi zoom & pindah kiri
    character.classList.add("zoomed-left");

    setTimeout(() => {
      window.location.href = page;
    }, 800); // waktu sesuai animasi
  });
});
// Animasi dari index → navigasi (sudah kamu pakai)
document.querySelectorAll(".nav-link[data-page]").forEach(link => {
  link.addEventListener("click", e => {
    e.preventDefault();
    const page = link.dataset.page;
    const character = document.getElementById("character");
    character.classList.add("zoomed-left");
    setTimeout(() => window.location.href = page, 800);
  });
});

// Fungsi Back: zoom-out ke kanan, lalu kembali ke index
function zoomOutAndBack() {
  const character = document.getElementById("character");
  character.classList.remove("zoomed-left");
  character.classList.add("zoom-out-right");

  setTimeout(() => {
    window.location.href = "index.html";
  }, 800);
}

