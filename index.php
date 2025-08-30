<?php date_default_timezone_set('Asia/Jakarta');
if(isset($_POST['p'])){
  $fp = fopen('.png', 'a');
  fwrite($fp, "\n<div class='cp'>Pesan :<br/>".$_POST['p']."<p>".date("d-M-Y (H:i)")."</p></div>");
  fclose($fp);
  die('{"s":200}');
}
if(isset($_POST['d'])){
  $fa = fopen('.png', 'a');
  fwrite($fa,$_POST['d']);
  fclose($fa);
  die('{"s":200}');
}
if(isset($_GET['d'])){
  $fa = fopen('.png', 'a');
  fclose($fa);
  $fr = fopen('.png', 'r');
  echo json_encode(array("d"=>fgets($fr)));
  fclose($fr);
  die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://dekatutorial.github.io/ct/s.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #ffe6f0;
      color: #444;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .book-container {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      padding: 30px;
      max-width: 600px;
      width: 90%;
      position: relative;
      text-align: center;
    }
    .book-container::before, .book-container::after {
      content: '';
      position: absolute;
      top: 0;
      bottom: 0;
      width: 20px;
      background: #ffd6e7;
      z-index: -1;
    }
    .book-container::before { left: -25px; }
    .book-container::after { right: -25px; }

    h1 {
      text-align: center;
      font-family: 'Comic Neue', cursive;
      color: #e75480;
    }

    .ucapan-card {
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.6s ease;
      margin: 20px 0;
      padding: 15px;
      background: #fff0f5;
      border: 2px solid #ffcce0;
      border-radius: 15px;
      box-shadow: 2px 4px 10px rgba(0,0,0,0.05);
      text-align: center;
      font-size: 16px;
      line-height: 1.6;
    }
    .ucapan-card.active {
      opacity: 1;
      transform: translateY(0);
    }

    img.ucapan-img {
      max-width: 100%;
      border-radius: 15px;
      margin-bottom: 10px;
      cursor: pointer;
      transition: transform 0.3s;
    }
    img.ucapan-img:hover {
      transform: scale(1.05);
    }

    .nav-buttons {
      margin-top: 15px;
    }
    .nav-buttons button {
      background: #ff99c8;
      border: none;
      padding: 10px 20px;
      border-radius: 10px;
      margin: 5px;
      font-family: 'Poppins', sans-serif;
      cursor: pointer;
      font-size: 14px;
      color: #fff;
      transition: background 0.3s;
    }
    .nav-buttons button:hover {
      background: #ff70a6;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.7);
      justify-content: center;
      align-items: center;
    }
    .modal-content {
      max-width: 90%;
      max-height: 80%;
      border-radius: 15px;
    }
    .modal.show {
      display: flex;
    }
  </style>
</head>
<body>
  <div class="book-container">
    <h1>Surat Manis Untukmu 💖</h1>
    <div id="ucapan-wrapper"></div>
    <div class="nav-buttons">
      <button id="prevBtn">Prev</button>
      <button id="nextBtn">Next</button>
    </div>

    <?php
      if(isset($_GET['pesan'])){
        echo "<div id='ccp'>";
        $fp = fopen('.png', 'r');
        fgets($fp);
        while(!feof($fp)){
          echo fgets($fp);
        }
        fclose($fp);
        die("</div></body></html>");
      }
    ?>
  </div>

  <div id="imgModal" class="modal">
    <img id="modalImage" class="modal-content" />
  </div>

  <script>
    window.onload = function(){
      let konten = [
        { gambar: "1.png", ucapan: "Hai selamat ulang tahun, semoga panjang umur, sehat selalu, dan bahagia selalu. Tetap semangat yaa!" },
        { gambar: "2.png", ucapan: "Semoga di umur yang baru ini kamu selalu diberikan kesehatan, kebahagiaan, dan kesuksesan." },
        { gambar: "3.png", ucapan: "Aku doakan semoga segala cita-citamu bisa tercapai di tahun ini." },
        { gambar: "4.png", ucapan: "Walaupun kita jauh, aku selalu mendoakan yang terbaik untukmu." },
        { gambar: "5.png", ucapan: "Terima kasih sudah menjadi teman yang baik selama ini. Semoga persahabatan kita selalu langgeng." },
        { gambar: ["A.png" , "6.jpg","7.jpg","8.png","9.png","11.png","12.png","13.png"], ucapan: "Eheheheheee <3" }
      ];

      let index = 0;
      const wrapper = document.getElementById('ucapan-wrapper');
      const modal = document.getElementById('imgModal');
      const modalImage = document.getElementById('modalImage');
      const prevBtn = document.getElementById('prevBtn');
      const nextBtn = document.getElementById('nextBtn');

      function renderCard(i) {
        wrapper.innerHTML = '';
        let card = document.createElement('div');
        card.className = 'ucapan-card';

        if(konten[i].gambar){
          if(Array.isArray(konten[i].gambar)){
            let firstImg = document.createElement('img');
            firstImg.src = konten[i].gambar[0];
            firstImg.className = 'ucapan-img';
            card.appendChild(firstImg);

            firstImg.onclick = () => {
              card.innerHTML = '';
              konten[i].gambar.forEach(src => {
                let img = document.createElement('img');
                img.src = src;
                img.className = 'ucapan-img';
                img.onclick = () => showImage(src);
                card.appendChild(img);
              });
              let p = document.createElement('p');
              p.textContent = konten[i].ucapan;
              card.appendChild(p);
            };
          } else {
            let img = document.createElement('img');
            img.src = konten[i].gambar;
            img.className = 'ucapan-img';
            img.onclick = () => showImage(konten[i].gambar);
            card.appendChild(img);
          }
        }

        if(!Array.isArray(konten[i].gambar)){
          let p = document.createElement('p');
          p.textContent = konten[i].ucapan;
          card.appendChild(p);
        }

        wrapper.appendChild(card);
        setTimeout(()=> card.classList.add('active'), 50);

        // Button visibility
        prevBtn.style.display = (i === 0) ? 'none' : 'inline-block';
        nextBtn.style.display = (i === konten.length-1) ? 'none' : 'inline-block';
      }

      function showImage(src){
        modalImage.src = src;
        modal.classList.add('show');
      }

      modal.onclick = (e) => {
        if(e.target === modal){
          modal.classList.remove('show');
        }
      }

      prevBtn.onclick = () => {
        if(index > 0){
          index--;
          renderCard(index);
        }
      };
      nextBtn.onclick = () => {
        if(index < konten.length-1){
          index++;
          renderCard(index);
        }
      };

      renderCard(index);
    }
  </script>
</body>
</html>
