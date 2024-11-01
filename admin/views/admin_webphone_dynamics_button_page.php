<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

// Displays the page content for the custom Test Toplevel menu

// Read in existing options value from database
$objectid = get_option('objectidwph');
$gtelephone = "";
$gtuser = "";
$gtpassword = "";
$gtmailbox = "";
$gtserver = "";
$gobjectposwph = get_option('objectposwph');
$gtcall = '';

// See if the user has posted us some information
if (($_POST['hf_objectidwph'] != '') || ($_POST['hf_objectposwph'] != '' || ($_POST['ghf_gnumber2call'] != ''))) {

  // Read their posted value
  $objectidwph = stripslashes($_POST['objectidwph']);
  $gtcall = stripslashes($_POST['gnumber2call']);
  if (stripslashes($_POST['hf_objectposwph']) == "") $gobjectposwph = "r-b";
  else $gobjectposwph = stripslashes($_POST['hf_objectposwph']);

  // Save the posted value in the database
  update_option('objectidwph', $objectidwph);
  update_option('objectposwph', $gobjectposwph);
  update_option('gnumber2call', $gtcall);

} else {
  $gobjectposwph = "r-b";
}
?>

<!-- // Display the options editing screen -->
<div class="wrap">
  <!-- header -->
  <div class="wphHeader">
    <a title="Webphone" rel="alternate"><img
        src=" <?php echo plugins_url('../img/button-page-img/webphoneLogo.png', __FILE__) ?>" alt=""/></a>

    <?php
    if (get_option('objectidwph') == '' || get_option('objectposwph') == '') {
      ?>
      <div class="wpherror">
        <p>
        <div><b><i class="fa fa-exclamation-triangle"></i> <?php _e('THE WEBPHONE PLUG-IN IS NOT INSTALLED', 'webphone-dynamics-plugin');?></b></div>
         
        <div><?php _e('To activate the plug-in Webphone need an ID and indicates where you want to display your button. <br> Please perform the following steps.', 'webphone-dynamics-plugin');?>
        </div>
        </p>
      </div>
      <?php
    } else {
      ?>
      <div class="wphupdated">
        <p>
          <div><b><i class="fa fa-thumbs-up"></i> <?php _e('THE WEBPHONE PLUG-IN HAS BEEN ACTIVATED SUCCESSFULLY', 'webphone-dynamics-plugin');?> </b></div>
          <div><?php _e('Please make sure the widget ID is valid and start receiving calls right now. Welcome to <span class="wphcolor">Webphone!</span>!', 'webphone-dynamics-plugin');?></div>
        </p>
      </div>
      <?php
    }
    ?>
    <h2><?php _e('Activate your <span class="wphcolor">Webphone</span> in 3 easy steps', 'webphone-dynamics-plugin');?></h2>
  </div>

  <div class="wphcontainer">
    <div class="wphrow-fluid">
      <div class="wphspan4">
        <div class="wphcol">
          <div class="step">
            <?php _e('1. Register in <span class="wphcolor">Webphone</span>', 'webphone-dynamics-plugin');?>
          </div>
          <div class="wphcaption-icon">
            <!-- <i class="fa fa-laptop"></i> -->
            <img src=" <?php echo plugins_url('../img/button-page-img/register.png', __FILE__) ?>" alt=""/>
          </div>
          <div class="wphcaption">
            <?php _e('You need to be registered for Webphone to be used. Please, visit <a target="_blank" href="https://dashboard.webphone.net/create-account/"><span class="wphnormalcolor">dashboard.webphone.net/create-account</span></a> and sign up.', 'webphone-dynamics-plugin');?>
          </div>
        </div>
      </div>
      <div class="wphspan4">
        <div class="wphcol">
          <div class="step"><?php _e('2. Get your <span class="wphcolor">Webphone</span> ID', 'webphone-dynamics-plugin');?></div>
          <div class="wphcaption-icon-2">
            <!-- <i class="fa fa-tag"></i> -->
            <img src=" <?php echo plugins_url('../img/button-page-img/getid.png', __FILE__) ?>" alt=""/>
          </div>
          <div class="wphcaption">
            <?php _e('After signing up, your access details by emailed to you. Access your account at your WordPress panel (see below) or at <a target="_blank" href="https://dashboard.webphone.net/"><span class="wphnormalcolor">dashboard.webphone.net</span></a> and follow the instructions to set up your button and generate your ID.', 'webphone-dynamics-plugin');?>
          </div>
        </div>
      </div>
      <div class="wphspan4">
        <div class="wphcol">
          <div class="step"> <?php _e('3. Insert <span class="wphcolor">Webphone</span> in your website', 'webphone-dynamics-plugin');?></div>
          <div class="wphcaption">
            <form name="form1" method="post" action="">
              <input type="hidden" name="<?php echo 'hf_objectidwph'; ?>" value="id">
              <input type="hidden" name="<?php echo 'hf_objectposwph'; ?>" id="hf_objectposwph" value="">
              <input type="hidden" name="<?php echo 'hf_gnumber2call'; ?>" value="call">
              <!--[if lt IE 9]>
              <div id="objectbundle_object_follow_startPos" class="positionChoiceField-IE8">
              <![endif]-->
              <!--[if gt IE 8]>
              <div id="objectbundle_object_follow_startPos" class="positionChoiceField">
              <![endif]-->
              <!--[if !IE]>-->
              <div id="objectbundle_object_follow_startPos" class="positionChoiceField">
                <!--<![endif]-->
                <?php
                $gobjectposwph = get_option('objectposwph');
                if ($gobjectposwph == "l-t") {
                  $checked = 'checked';
                } else {
                  $checked = '';
                }
                ?>
                <div class="radio-wph" id="uniform-objectbundle_object_follow_startPos_l-t"
                     onclick="setPos(this,'l-t')"><span class="<?php echo $checked; ?>"><input type="radio"
                                                                                               checked="<?php echo $checked; ?>"
                                                                                               id="objectbundle_object_follow_startPos_l-t"
                                                                                               name="objectbundle_object_follow[startPos]"
                                                                                               required="required"
                                                                                               value="l-t"
                                                                                               style="opacity: 0;"></span>
                </div> <?php
                if ($gobjectposwph == "c-t") {
                  $checked = 'checked';
                } else {
                  $checked = '';
                }
                ?>
                <div class="radio-wph" id="uniform-objectbundle_object_follow_startPos_c-t"
                     onclick="setPos(this,'c-t')"><span class="<?php echo $checked; ?>"><input type="radio"
                                                                                               checked="<?php echo $checked; ?>"
                                                                                               id="objectbundle_object_follow_startPos_c-t"
                                                                                               name="objectbundle_object_follow[startPos]"
                                                                                               required="required"
                                                                                               value="c-t"
                                                                                               style="opacity: 0;"></span>
                </div><?php
                if ($gobjectposwph == "r-t") {
                  $checked = 'checked';
                } else {
                  $checked = '';
                }
                ?>
                <div class="radio-wph" id="uniform-objectbundle_object_follow_startPos_r-t"
                     onclick="setPos(this,'r-t')"><span class="<?php echo $checked; ?>"><input type="radio"
                                                                                               checked="<?php echo $checked; ?>"
                                                                                               id="objectbundle_object_follow_startPos_r-t"
                                                                                               name="objectbundle_object_follow[startPos]"
                                                                                               required="required"
                                                                                               value="r-t"
                                                                                               style="opacity: 0;"></span>
                </div><?php
                if ($gobjectposwph == "l-m") {
                  $checked = 'checked';
                } else {
                  $checked = '';
                }
                ?>
                <div class="radio-wph" id="uniform-objectbundle_object_follow_startPos_l-m"
                     onclick="setPos(this,'l-m')"><span class="<?php echo $checked; ?>"><input type="radio"
                                                                                               checked="<?php echo $checked; ?>"
                                                                                               id="objectbundle_object_follow_startPos_l-m"
                                                                                               name="objectbundle_object_follow[startPos]"
                                                                                               required="required"
                                                                                               value="l-m"
                                                                                               style="opacity: 0;"></span>
                </div>
                <div class="radio-wph" id="uniform-objectbundle_object_follow_startPos_c-m"><span
                    class="radio-hide"><input type="radio" id="objectbundle_object_follow_startPos_c-m"
                                              name="objectbundle_object_follow[startPos]" required="required"
                                              value="c-m" style="opacity: 0;"></span></div><?php
                if ($gobjectposwph == "r-m") {
                  $checked = 'checked';
                } else {
                  $checked = '';
                }
                ?>
                <div class="radio-wph" id="uniform-objectbundle_object_follow_startPos_r-m"
                     onclick="setPos(this,'r-m')"><span class="<?php echo $checked; ?>"><input type="radio"
                                                                                               checked="<?php echo $checked; ?>"
                                                                                               id="objectbundle_object_follow_startPos_r-m"
                                                                                               name="objectbundle_object_follow[startPos]"
                                                                                               required="required"
                                                                                               value="r-m"
                                                                                               style="opacity: 0;"></span>
                </div><?php
                if ($gobjectposwph == "l-b") {
                  $checked = 'checked';
                } else {
                  $checked = '';
                }
                ?>
                <div class="radio-wph" id="uniform-objectbundle_object_follow_startPos_l-b"
                     onclick="setPos(this,'l-b')"><span class="<?php echo $checked; ?>"><input type="radio"
                                                                                               checked="<?php echo $checked; ?>"
                                                                                               id="objectbundle_object_follow_startPos_l-b"
                                                                                               name="objectbundle_object_follow[startPos]"
                                                                                               required="required"
                                                                                               value="l-b"
                                                                                               style="opacity: 0;"></span>
                </div><?php
                if ($gobjectposwph == "c-b") {
                  $checked = 'checked';
                } else {
                  $checked = '';
                }
                ?>
                <div class="radio-wph" id="uniform-objectbundle_object_follow_startPos_c-b"
                     onclick="setPos(this,'c-b')"><span class="<?php echo $checked; ?>"><input type="radio"
                                                                                               checked="<?php echo $checked; ?>"
                                                                                               id="objectbundle_object_follow_startPos_c-b"
                                                                                               name="objectbundle_object_follow[startPos]"
                                                                                               required="required"
                                                                                               value="c-b"
                                                                                               style="opacity: 0;"></span>
                </div><?php
                if ($gobjectposwph == "r-b") {
                  $checked = 'checked';
                } else {
                  $checked = '';
                } ?>
                <div class="radio-wph" id="uniform-objectbundle_object_follow_startPos_r-b"
                     onclick="setPos(this,'r-b')"><span class="<?php echo $checked; ?>"><input type="radio"
                                                                                               checked="<?php echo $checked; ?>"
                                                                                               id="objectbundle_object_follow_startPos_r-b"
                                                                                               name="objectbundle_object_follow[startPos]"
                                                                                               required="required"
                                                                                               value="r-b"
                                                                                               style="opacity: 0;"></span>
                </div>
              </div>
              <div><i class="font-icon fa fa-arrow-circle-o-right"></i> <?php _e('Please select the Webphone position in the site', 'webphone-dynamics-plugin');?></div>
              <div class="separator-two"></div>
              <span style=""><?php _e('Enter your Webphone ID', 'webphone-dynamics-plugin');?></span>
              <?php
              $objectidwph = get_option('objectidwph');
              ?>
              <input type="text" size="15" class="input-id"
                     onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                     name="<?php echo 'objectidwph'; ?>" id="<?php echo 'objectidwph'; ?>"
                     value="<?php echo $objectidwph; ?>" maxlength="15">

              <p class="">
                <?php
                if (get_option('objectidwph') == '') {
                  ?>
                  <input type="submit" id="wph_submit" class="btn"
                         title="<?php _e('ACTIVE WEBPHONE', 'webphone-dynamics-plugin') ?>"
                         value="<?php _e('ACTIVE WEBPHONE', 'webphone-dynamics-plugin') ?>">
                  <?php
                } else {
                  ?>
                  <input type="submit" id="wph_submit" class="btn"
                         title="<?php _e('REFRESH WEBPHONE', 'webphone-dynamics-plugin') ?>"
                         value="<?php _e('REFRESH WEBPHONE', 'webphone-dynamics-plugin') ?>">
                  <?php
                }
                ?>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="separator"></div>

  <div class="blue-wph">
    <div>
      <div class="text">
        <div class="h2-wph"><?php _e('What is Webphone?', 'webphone-dynamics-plugin') ?></div>
        <div class="group">
          <div class="left"><?php _e('Webphone is the button to be inserted in your website so that your customers can call you for free. It prevents them to leave the site without contacting and helps you to increase your online sales.', 'webphone-dynamics-plugin') ?>
          </div>
          <div class="right"><img class="img-responsive"
                                  src="<?php echo plugins_url('../img/button-page-img/footer-wph.png', __FILE__) ?>"
                                  alt="What is Webphone?" title="What is Webphone?"></div>
        </div>
      </div>
      <div class="text"><?php _e('Discover more about Webphone at <a class="white" href="https://www.webphone.net/en/">www.webphone.net', 'webphone-dynamics-plugin') ?></a>
      </div>
    </div>
    <div class="grey-wph">
      <div class="wphcolor"><?php _e('Access your account', 'webphone-dynamics-plugin') ?></div>
      <div class="separator-tiny"></div>
      <form action="https://dashboard.webphone.net/wph_login" id="formLogin" method="post" class="loginForm" target="_blank">
        <div class="input-prepend">
          <input name="_username" id="user" type="text" class="loginInput" required="required" placeholder="<?php _e('Username', 'webphone-dynamics-plugin') ?>"
        </div>
        <div class="input-prepend">
          <input name="_password" id="password" type="password" class="loginInput" required="required" placeholder="<?php _e('Password', 'webphone-dynamics-plugin') ?>">
        </div>
        <div class="separator-tiny"></div>
        <input type="submit" id="wph_login" class="btn" value="Log in">
        <div class="input-prepend">
          <a href="https://dashboard.webphone.net/recover/password/" target="_blank" class="help-block"><?php _e('Forgot your password?', 'webphone-dynamics-plugin') ?></a>
        </div>
      </form>
    </div>
  </div>

</div>

