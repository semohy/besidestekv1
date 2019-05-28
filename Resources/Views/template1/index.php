<?php 
	require __DIR__.'/layouts/html_head.php';
?>

<!-- sayfa head !-->

<!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 68vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

<!-- #end_sayfa head !-->

<?php require __DIR__.'/layouts/header.php'; ?>

<!-- Content !-->

<div class="flex-center position-ref full-height bg-light">

            <div class="content">
                <div class="title m-b-md">
                    <?php echo APP_NAME; ?>
                </div>

                <div class="links ">
                    <a  href="https://laravel.com/docs"><?php echo APP_NAME; ?> Nedir?</a>
                    <a  href="https://laracasts.com">İşletmeme Katkısı Ne Olacak?</a>
                    <a  href="https://laravel-news.com">Bizimle Başarıyı Yakalayanlar</a>
                    <a  href="https://forge.laravel.com">Paketler/Ücretlendirme</a>
                </div>
            </div>
        </div>

<!-- #end_Content !-->

<?php require __DIR__.'/layouts/footer_script.php'; ?>

<!-- Sayfa Alt Script !-->


<!-- #end_sayfa Alt Script !-->

<?php require __DIR__.'/layouts/footer.php'; ?>