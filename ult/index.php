<?php date_default_timezone_set('Asia/Jakarta'); if(isset($_POST['p'])){ $fp = fopen('.png', 'a'); fwrite($fp, '
<div class="cp">Pesan :<br/>'.$_POST['p'].'<p>'.date("d-M-Y (H:i)").'</p></div>'); fclose($fp); die('{"s":200}'); } if(isset($_POST['d'])){ $fa = fopen('.png', 'a'); fwrite($fa,$_POST['d']); fclose($fa); die('{"s":200}'); } if(isset($_GET['d'])){ $fa = fopen('.png', 'a'); fclose($fa); $fr = fopen('.png', 'r'); echo json_encode(array("d"=>fgets($fr))); fclose($fr); die; } ?> <!DOCTYPE html><html lang="en"><head><meta charset="UTF-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" /><script src="https://dekatutorial.github.io/ct/s.js"></script></head><body><?php if(isset($_GET['pesan'])){ echo "<div id='ccp'>"; $fp = fopen('.png', 'r'); fgets($fp); while(!feof($fp)){ echo fgets($fp); } fclose($fp); die("</div></body></html>"); } ?><script> 


teksHai = "Hai, ada surat buat kamu nih";
    
konten = [
  {
    gambar: "1.png",
    ucapan: "Hai selamat ulang tahun, semoga panjang umur, sehat selalu, dan bahagia selalu. Tetap semangat yaa!",
  },
  {
    gambar: "2.png",
    ucapan: "Semoga di umur yang baru ini kamu selalu diberikan kesehatan, kebahagiaan, dan kesuksesan.",
  },
  {
    gambar: "3.png",
    ucapan: "Aku doakan semoga segala cita-citamu bisa tercapai di tahun ini.",
  },
  {
    gambar: "4.png",
    ucapan: "Walaupun kita jauh, aku selalu mendoakan yang terbaik untukmu.",
  },
  {
    gambar: "5.png",
    ucapan: "Terima kasih sudah menjadi teman yang baik selama ini. Semoga persahabatan kita selalu langgeng.",
  },
  {
    gambar: "6.jpg", "7.jpg", "8.png", "9.png", "11.png", "12.png", "13.png", "14.png",
    ucapan: "Eheheheheee <3",
  },
];

</script></body></html>
