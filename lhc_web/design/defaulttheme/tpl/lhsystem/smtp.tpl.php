<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp','Mail settings');?></h1>

<?php if (isset($errors)) : ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<?php if (isset($updated) && $updated == 'done') : $msg = erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp','Settings updated'); ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success.tpl.php'));?>
<?php endif; ?>

<form action="" method="post" autocomplete="new-password" ng-non-bindable>

    <?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

	<div role="tabpanel">

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="nav-item"><a class="<?php echo (isset($tab) && $tab == 'mailsettings') ? 'active ' : ''; ?>nav-link" href="#mailsettings" aria-controls="mailsettings" role="tab" data-bs-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('front/default','Mail settings');?></a></li>
			<li role="presentation" class="nav-item"><a class="<?php echo (isset($tab) && $tab == 'SMTP') ? 'active ' : ''; ?>nav-link" href="#SMTP" aria-controls="SMTP" role="tab" data-bs-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('front/default','SMTP');?></a></li>
		</ul>


      
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane <?php echo (isset($tab) && $tab == 'mailsettings') ? 'active' : ''; ?>" id="mailsettings">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp','Sender address');?></label> <input type="text" class="form-control" name="sender" value="<?php (isset($smtp_data['sender']) && $smtp_data['sender'] != '') ? print htmlspecialchars($smtp_data['sender']) : print '' ?>" />
				</div>

				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp','Default from e-mail address');?></label> <input type="text" class="form-control" name="default_from" value="<?php (isset($smtp_data['default_from']) && $smtp_data['default_from'] != '') ? print htmlspecialchars($smtp_data['default_from']) : print '' ?>" />
				</div>

				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp','Default from name');?></label> <input type="text" class="form-control" name="default_from_name" value="<?php (isset($smtp_data['default_from_name']) && $smtp_data['default_from_name'] != '') ? print htmlspecialchars($smtp_data['default_from_name']) : print '' ?>" />
				</div>

				<div class="btn-group" role="group" aria-label="...">
					<input type="submit" class="btn btn-secondary" name="StoreMailSettings" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Save'); ?>" /> <input type="submit" class="btn btn-secondary" name="StoreMailSettingsTest" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Test'); ?>" />
				</div>
			</div>

			<div role="tabpanel" class="tab-pane <?php echo (isset($tab) && $tab == 'SMTP') ? 'active' : ''; ?>" id="SMTP">
				<label><input type="checkbox" name="use_smtp" value="1" <?php isset($smtp_data['use_smtp']) && ($smtp_data['use_smtp'] == '1') ? print 'checked="checked"' : '' ?> /> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp','SMTP enabled'); ?></label>

				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp','Login');?></label> <input type="text" class="form-control" name="username" autocomplete="new-password" value="<?php (isset($smtp_data['username']) && $smtp_data['username'] != '') ? print htmlspecialchars($smtp_data['username']) : print '' ?>" />
				</div>

				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp','Password');?></label> <input type="password" class="form-control" name="password" autocomplete="new-password" value="<?php (isset($smtp_data['password']) && $smtp_data['password'] != '') ? print htmlspecialchars($smtp_data['password']) : print '' ?>" />
				</div>

				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp','Host');?>*</label> <input type="text" class="form-control" name="host" value="<?php (isset($smtp_data['host']) && $smtp_data['host'] != '') ? print htmlspecialchars($smtp_data['host']) : print '' ?>" />
				</div>

				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp','Port');?>*</label> <input type="text" class="form-control" name="port" value="<?php (isset($smtp_data['port']) && $smtp_data['port'] != '') ? print htmlspecialchars($smtp_data['port']) : print '25' ?>" />
				</div>

                <div class="form-group">
                    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/smtp','Bind IP, multiple IP can be separated by comma. Random IP will be chosen.');?></label> <input type="text" class="form-control" name="bindip" value="<?php (isset($smtp_data['bindip']) && $smtp_data['bindip'] != '') ? print htmlspecialchars($smtp_data['bindip']) : print '' ?>" />
                </div>
            
                <div class="btn-group" role="group" aria-label="...">
					<input type="submit" class="btn btn-secondary" name="StoreSMTPSettings" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Save'); ?>" /> <input type="submit" class="btn btn-secondary" name="StoreSMTPSettingsTest" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Test'); ?>" />
				</div>
			</div>
		</div>
	</div>
</form>

<?php if (isset($content_connection)) : ?>
    <div class="my-2 fs14 text-muted"><?php echo $content_connection?></div>
<?php endif; ?>