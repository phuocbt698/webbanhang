<?php
if (isset($resultConfig)) {
    $resultConfig = $resultConfig;
}
if (isset($notifiLogin)) {
    $notifiLogin = $notifiLogin;
}
?>
</div>
<div class="footer">
    <div class="info-website">
        <h3>Demo website PHP-thuần</h3>
        <span>
            Author: BÙI THẾ PHƯỚC
            <br>
            Địa chỉ: LĨNH NAM, HOÀNG MAI, HÀ NỘI
            <br>
            Điện thoại: <?= $resultConfig['phone'] ?>
            <br>
            Email: <?= $resultConfig['email'] ?>
            <br>
        </span>
    </div>
    <div class="social-website">
        <h3>Liên hệ với chúng tôi:</h3>
        <div class="social">
            <a href="<?= $resultConfig['facebook'] ?>" title="Bùi Thế Phước">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="<?= $resultConfig['github'] ?>" title="Bùi Thế Phước">
                <i class="fab fa-github"></i>
            </a>
            <a href="tel:<?= $resultConfig['phone'] ?>" title="Bùi Thế Phước">
                <i class="fas fa-phone-alt"></i>
            </a>
            <a href="<?= $resultConfig['email'] ?>" title="Bùi Thế Phước">
                <i class="fas fa-envelope"></i>
            </a>
        </div>
    </div>
    <div class="address-store">
        <h3>Cửa hàng:</h3>
        <span>
            Địa chỉ: LĨNH NAM, HOÀNG MAI, HÀ NỘI
            <br>
            Địa chỉ: LĨNH NAM, HOÀNG MAI, HÀ NỘI
            <br>
            Địa chỉ: LĨNH NAM, HOÀNG MAI, HÀ NỘI
            <br>
            Địa chỉ: LĨNH NAM, HOÀNG MAI, HÀ NỘI
        </span>
    </div>
</div>
</div>
</body>
<script>
    //khai báo biến slideIndex đại diện cho slide hiện tại
    var slideIndex;
    // KHai bào hàm hiển thị slide
    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }

        slides[slideIndex].style.display = "block";
        dots[slideIndex].className += " active";
        //chuyển đến slide tiếp theo
        slideIndex++;
        //nếu đang ở slide cuối cùng thì chuyển về slide đầu
        if (slideIndex > slides.length - 1) {
            slideIndex = 0
        }
        //tự động chuyển đổi slide sau 5s
        setTimeout(showSlides, 7000);
    }
    //mặc định hiển thị slide đầu tiên 
    showSlides(slideIndex = 0);


    function currentSlide(n) {
        showSlides(slideIndex = n);
    }
</script>

<script>
    $(document).ready(function() {
        $('.btn-login').click(function() {
            $('.modal-login').css("display", "block");
            $('.img-preview').remove();
            $('.form-register').css("display", "none");
            $('.form-login').css("display", "flex");
            $('.btn-login').css("color", "blue");
            $('.btn-login').css("border-bottom", "solid 2px ghostwhite");
            $('.btn-register').css("color", "black");
            $('.btn-register').css("border-bottom", "0");
        });

        $('.modal-login').click(function(e) {
            if (e.target === e.currentTarget) {
                $('.modal-login').css("display", "none");

            }
        });

        $('.btn-login').click(function() {
            $('.form-register').css("display", "none");
            $('.form-login').css("display", "flex");
            $('.btn-register').css("color", "black");
            $('.btn-register').css("border-bottom", "0");
            $('.btn-login').css("color", "blue");
            $('.btn-login').css("border-bottom", "solid 2px ghostwhite");
        });

        $('.btn-register').click(function() {
            $('.form-login').css("display", "none");
            $('.form-register').css("display", "flex");
            $('.btn-login').css("color", "black");
            $('.btn-login').css("border-bottom", "0");
            $('.btn-register').css("color", "blue");
            $('.btn-register').css("border-bottom", "solid 2px ghostwhite");
        });

        $('#imgUser').change(function(e) {
            const preview = document.querySelector('.preview')
            const img_preview_old = document.querySelector('.img-preview');
            const files = e.target.files;
            const file = files[0];
            const fileType = file['type'];
            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);
            fileReader.onload = function() {
                const url = fileReader.result;
                if (img_preview_old) {
                    img_preview_old.remove();
                }
                if (!file['type'].search('image')) {
                    preview.insertAdjacentHTML(
                        'beforeend',
                        `<img src="${url}" alt="${file.name}" class="img-preview"/>`
                    )
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.more-text').click(function() {
            $('.content-product').css("height", "auto");
            $('.more-text').css("display", "none");
            $('.show-more').css("position", "relative");
            $('.show-more').css("bottom", "0");
            $('.less-text').css("display", "block");
        });
        $('.less-text').click(function() {
            $('.content-product').css("height", "230px");
            $('.less-text').css("display", "none");
            $('.show-more').css("position", "absolute");
            $('.show-more').css("bottom", "-5px");
            $('.more-text').css("display", "block");
        });
    });
</script>

</html>