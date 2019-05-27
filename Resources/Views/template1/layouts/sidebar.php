<nav id="sidebar">
            

            <ul class="list-unstyled components">
                <li>
                        <div class="row">
                            <img class="mx-auto" src="Public/img/besidestek.png" style="width: 200px; height: 200px;padding: 15px; margin-bottom: 10px;"/>
                        </div>
                </li>
                    <div class="row">
                        <p class="mx-auto"> <?php $Auth->user(); echo $Auth->user_name; ?> </p>
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
                <li>
                    <a href="<?php echo APP_URL.'dashboard';?>">Dashboard</a>
                </li>

                <li>
                    <a href="#ticarisubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Ticari İşlem</a>
                     <ul class="collapse list-unstyled" id="ticarisubmenu">
                        <li>
                            <a href="<?php echo APP_URL.'satim';?>">Satım</a>
                        </li>
                        <li>
                            <a href="<?php echo APP_URL.'satinalim';?>">Satın Alım</a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a href="#bankaSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Gelir/Gider</a>
                    <ul class="collapse list-unstyled" id="bankaSubmenu">
                        <li>
                            <a href="<?php echo APP_URL.'gelir';?>">Satış Dışı Gelir Ekle</a>
                        </li>
                        <li>
                            <a href="<?php echo APP_URL.'gider';?>">Alım Dışı Gider Ekle</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#stokSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Stoklar</a>
                    <ul class="collapse list-unstyled" id="stokSubmenu">
                        <li>
                            <a href="<?php echo APP_URL.'stoklar';?>">Tüm Stoklar</a>
                         </li>
                        <li>
                            <a href="#">Depolar</a>
                        </li>
                    </ul>
                </li>
                <hr >
                <li>
                    <a href="#hayvanSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Hayvan</a>
                    <ul class="collapse list-unstyled" id="hayvanSubmenu">
                        <li>
                            <a href="<?php echo APP_URL.'stoklar';?>">Hayvanlar</a>
                         </li>
                        <li>
                            <a href="<?php echo APP_URL.'kategoriler';?>">Kategoriler</a>
                        </li>
                    </ul>
                </li>
              

                <!-- #END_Sidebarlayouts -->
                
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