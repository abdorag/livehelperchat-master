<div role="tabpanel" class="pt-0" id="tabs">

    <?php if (isset($Result['path'])) :
        $pathElementCount = count($Result['path'])-1;
        if ($pathElementCount >= 0): ?>
            <div id="path-container" style="margin-left: -8px;margin-right: -7px" ng-non-bindable>
                <ul class="breadcrumb rounded-0 border-bottom p-2 mb-0" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <li class="breadcrumb-item"><a rel="home" itemprop="url" href="<?php echo erLhcoreClassDesign::baseurl()?>"><span itemprop="title"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('pagelayout/pagelayout','Home')?></span></a></li>
                    <?php foreach ($Result['path'] as $key => $pathItem) : if (isset($pathItem['url']) && $pathElementCount != $key) { ?><li class="breadcrumb-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo $pathItem['url']?>" itemprop="url"><span itemprop="title"><?php echo htmlspecialchars(htmlspecialchars_decode($pathItem['title'],ENT_QUOTES))?></span></a></li><?php } else { ?><li class="breadcrumb-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php echo htmlspecialchars(htmlspecialchars_decode($pathItem['title'], ENT_QUOTES))?></span></li><?php }; ?><?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    <?php endif;?>

    <ul class="nav nav-pills d-none" role="tablist">
    </ul>
    <div class="tab-content ps-1">

        <div class="tab-pane active chat-tab-pane">

<div class="row" ng-non-bindable>
    <div class="col-sm-7 chat-main-left-column" id="chat-main-column-<?php echo $chat->id;?>">
        <a title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/chat','Show/Hide right column')?>" href="#" class="material-icons collapse-right" onclick="lhinst.processCollapse('<?php echo $chat->id;?>')">chevron_right</a>
        <?php include(erLhcoreClassDesign::designtpl('lhchat/part/above_messages_block.tpl.php')); ?>

        <div class="message-block">
            <div class="msgBlock msgBlock-admin" id="messagesBlock-<?php echo $chat->id?>">
                <?php include(erLhcoreClassDesign::designtpl('lhchat/lists/msg_obj_list_admin.tpl.php'));?>

                <?php if ($chat->user_status == 1) : ?>
                    <?php include(erLhcoreClassDesign::designtpl('lhchat/userleftchat.tpl.php')); ?>
                <?php elseif ($chat->user_status == 0) : ?>
                    <?php include(erLhcoreClassDesign::designtpl('lhchat/userjoined.tpl.php')); ?>
                <?php endif;?>
            </div>
        </div>

        <div class="user-is-typing" id="user-is-typing-<?php echo $chat->id?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/chat','User is typing now...')?></div>

        <?php if (!isset($modeArchiveView) || $modeArchiveView !== 'popup') : ?>
        <div class="btn-group">
            <a href="<?php echo erLhcoreClassDesign::baseurl('chatarchive/listarchivechats')?>/<?php echo $archive->id?>" class="btn btn-primary"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Return')?></a>
            <a href="<?php echo erLhcoreClassDesign::baseurl('chatarchive/deletearchivechat')?>/<?php echo $archive->id?>/<?php echo $chat->id?>" class="btn btn-danger btn-xs csfr-post csfr-required" data-trans="delete_confirm" ><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/closedchats','Delete chat')?></a>
        </div>
        <?php endif; ?>

        <?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?>

    </div>
    <div class="col-sm-5 chat-main-right-column" id="chat-right-column-<?php echo $chat->id;?>">
        <?php $hideActionBlock = true;?>
        <?php include(erLhcoreClassDesign::designtpl('lhchat/chat_tabs/chat_tabs_container.tpl.php')); ?>
    </div>
</div>
<script>ee.emitEvent('adminArchiveChatLoaded', [<?php echo $archive->id?>,<?php echo $chat->id;?>]);</script>

    </div>

    </div>
</div>