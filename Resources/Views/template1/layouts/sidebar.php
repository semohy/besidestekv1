<nav id="sidebar">
            

            <ul class="list-unstyled components">
                <li>
                        <div class="row">
                            <img class="fas fa-user rounded-circle mx-auto" style="border: 2px solid;width: 100px;  height: 100px;padding: 15px; margin-bottom: 10px;"/>
                        </div>
                </li>
                    <div class="row">
                        <p class="mx-auto"> <?php echo $Auth->user_name; ?> </p>
                    </div>
                    <div class="row">
                        <b class="row mx-auto">İşletme:</b> <?php echo $Auth->user_email; ?>
                    </div>
                    <div class="row justify-content-center">

                       <ul id="sidebar-icons">
                            <li>
                                <a data-toggle="tooltip" data-placement="bottom" title="Hatırlatıcı Ekle"><i class="fas fa-plus"></i></a>
                            </li>
                            <li>

                                <div class="dropdown">
                                    <a  id="nofication_popup" data-toggle="dropdown" data-placement="bottom" role="button" title="4 Bildirim" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i><span class="badge">4</span></a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="nofication_popup">
                                        <ul>
                                            <li  class="dropdown-header">Simple thumbnail</li>
                                            <li>Bildirim1</li>
                                        </ul>
                                    </div>
                                </div>

                            </li>
                            <li>
                                <a class="nav-link"data-toggle="tooltip" data-placement="bottom" title="Çıkış Yap" href="<?php echo APP_URL.'logout';?>"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i></a>
                                <form id="logout-form" action="<?php echo APP_URL.'logout';?>" method="POST" style="display: none;"></form>
                            </li>
                            
                        </ul>

                    </div>

                    <br />
                </li>

                <!--sidebar contents here -->
                
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="#" class="download">Çıkıs</a>
                </li>
                <li>
                    <a href="#" class="btn btn-warning">Ayarlar</a>
                </li>
                <br />
            </ul>
        </nav>