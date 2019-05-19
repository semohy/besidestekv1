<?php 
    require __DIR__.'/../../layouts/html_head.php';
?>

<!-- sayfa head !-->

<!-- #end_sayfa head !-->

<?php require __DIR__.'/../../layouts/header.php'; ?>

<!-- Content !-->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Kaydol</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo APP_URL.'register'; ?>">

                        <div class="form-group <?php echo (isset($returned_Inputs['name'])) ? 'has-error' : '' ?> ">
                            <label for="name" class="col-md-4 control-label">İsim</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo (isset($returned_Inputs['name'])) ? $returned_Inputs['name'] : '' ?>" required autofocus>

                                <?php echo (isset($returned_Inputs['name'])) ? `
                                    <span class="help-block">
                                        <strong>`.$returned_Inputs_message['name'].`</strong>
                                    </span>
                                    ` : ''
                                 ?>
                                
                            </div>
                        </div>

                        <div class="form-group <?php echo (isset($returned_Inputs['email'])) ? 'has-error' : '' ?> ">
                            <label for="email" class="col-md-4 control-label">Email Adresi</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo (isset($returned_Inputs['email'])) ? $returned_Inputs['email'] : '' ?>" required autofocus>

                                <?php echo (isset($returned_Inputs['email'])) ? `
                                    <span class="help-block">
                                        <strong>`.$returned_Inputs_message['email'].`</strong>
                                    </span>
                                    ` : ''
                                 ?>
                                
                            </div>
                        </div>

                        <div class="form-group <?php echo (isset($returned_Inputs['password'])) ? 'has-error' : '' ?> ">
                            <label for="password" class="col-md-4 control-label">Parola</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autofocus>

                                <?php echo (isset($returned_Inputs['password'])) ? `
                                    <span class="help-block">
                                        <strong>`.$returned_Inputs_message['password'].`</strong>
                                    </span>
                                    ` : ''
                                 ?>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Parola Tekrar</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Kaydol
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #end_Content !-->

<?php require __DIR__.'/../../layouts/footer_script.php'; ?>

<!-- Sayfa Alt Script !-->


<!-- #end_sayfa Alt Script !-->

<?php require __DIR__.'/../../layouts/footer.php'; ?>