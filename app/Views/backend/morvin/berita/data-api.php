 <?php if (!empty($news)) : ?>
     <ul>
         <?php foreach ($news as $item) : ?>
             <li>
                 <h2><?= esc($item['judul_berita']) ?></h2>
                 <p><?= esc($item['tgl_berita']) ?></p>
             </li>
         <?php endforeach; ?>
     </ul>
 <?php else : ?>
     <p>Tidak ada berita tersedia.</p>
 <?php endif; ?>