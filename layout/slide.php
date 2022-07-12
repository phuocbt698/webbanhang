<?php
    $time_now = time();
    $time_now = date('Y-m-d', $time_now);
    $sqlBanner = "SELECT * FROM tbl_banner WHERE time_end > '$time_now' LIMIT 5";
    $sqlCountBanner = "SELECT COUNT(*) FROM tbl_banner WHERE time_end > '$time_now' LIMIT 5";
    $countBanner = getData($sqlCountBanner, 1)['COUNT(*)'];
    $resultBanner = getData($sqlBanner);
?>
<div class="slide-banner">
    <div class="slideshow-container">
        <?php foreach($resultBanner as $banner): ?>
            <div class="mySlides fade">
                <img src="<?=link_Image . 'banner/' . $banner['image']?>">
            </div>
        <?php endforeach; ?>
    </div>
    <br>

    <div class="dots">
        <?php for($i = 0; $i < $countBanner; $i++ ):?>
            <span class="dot" onclick="currentSlide(<?=$i?>)"></span>
        <?php endfor; ?>
    </div>
</div>