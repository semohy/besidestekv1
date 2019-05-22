</head>

<body>
    <div id="main">
<!-- mobile haeader nav  -->
            <nav class="navbar navbar-expand-lg navs-shadow d-block d-lg-none  sticky-top">
                <div class="row">
                    <button type="button" id="sidebarCollapse" class="btn btn-info col-2">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <div class="text-white offset-3"><a class="navbar-brand" href="{{ url('/',app()->getLocale()) }}">
                        <?php echo APP_NAME; ?>
                    </a></div>
                </div>
            </nav>
          <!--#END_mobile haeader nav  -->


    <div class="wrapper">


        

        <!-- normal header nav  -->
        

            <nav class="navbar navbar-expand-lg navs-shadow sticky-top d-none d-lg-block">
                <div class="container-fluid"><h4 class="text-white"><a class="navbar-brand" href=" <?php echo APP_URL; ?>">
                        <?php echo APP_NAME; ?>
                    </a></h4>
                        <ul class="nav navbar-nav ml-auto text-white">
                            
                         <?php if( !isset($Auth->auth) ): ?>
    
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo APP_URL.'login'; ?>">Giriş</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo APP_URL.'register'; ?>">Register</a></li>

                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Hatırlatıcı Ekle"><i class="fas fa-plus"></i></a>
                            </li>
                            <li class="nav-item">

                                <div class="dropdown">
                                    <a class="nav-link " id="nofication_popup" data-toggle="dropdown" data-placement="bottom" role="button" title="4 Bildirim" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i><span class="badge">4</span></a>

                                    <div class="dropdown-menu dropdown-menu-right dropdown-notification" aria-labelledby="nofication_popup">
                                        <ul>
                                            <li><span class="dropdown-header">Bildirimler</span></li>
                                            <li>Bildirim1</li>
                                        </ul>
                                    </div>
                                </div>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link"data-toggle="tooltip" data-placement="bottom" title="Çıkış Yap" href="{{ route('logout',app()->getLocale())  }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i></a>
                                <form id="logout-form" action="<?php echo APP_URL.'logout'; ?>" method="POST" style="display: none;">
                                        </form>
                            </li>
                            <?php endif ?>
                        </ul>
                </div>
            </nav>

            <?php 

            //session_start();
            
             if( isset($Auth->auth) ){
                require __DIR__.'/sidebar.php';
            }
            echo `
                <script type="text/javascript">
                $('#content').css('width','calc(100% - 250px)');
            </script>
            `;
            ?>

            <!-- icerik -->
           <div id="content">
            <div id="sidebar-bg" ></div>
            <br /><br />