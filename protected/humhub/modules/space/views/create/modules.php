<?php

use humhub\modules\space\assets\SpaceAsset;
use humhub\libs\Helpers;
use yii\helpers\Url;

SpaceAsset::register($this);

?>
<div class="modal-dialog modal-dialog-medium animated fadeIn">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">
                <?= Yii::t('SpaceModule.manage', 'Add <strong>Modules</strong>') ?>
            </h4>
        </div>
        <div class="modal-body">
            <br><br>

            <div class="row">

                <?php foreach ($availableModules as $moduleId => $module) : ?>
                    <div class="col-md-6">
                        <div class="media well well-small ">
                            <img class="media-object img-rounded pull-left" data-src="holder.js/64x64" alt="64x64"
                                 style="width: 64px; height: 64px;"
                                 src="<?= $module->getContentContainerImage($space); ?>">

                            <div class="media-body">
                                <h4 class="media-heading"><?= $module->getContentContainerName($space); ?></h4>

                                <p style="height: 35px;"><?=Helpers::truncateText($module->getContentContainerDescription($space), 75); ?></p>

                                <?php
                                $enable = '';
                                $disable = 'hidden';

                                if ($space->isModuleEnabled($moduleId)) {
                                    $enable = 'hidden';

                                    if (!$space->canDisableModule($moduleId)) {
                                        $disable = 'disabled';
                                    } else {
                                        $disable = '';
                                    }
                                }
                                ?>
                                <a href="#" class="btn btn-sm btn-primary enable" 
                                    data-action-click="content.container.enableModule" 
                                    data-ui-loader
                                    data-action-url="<?= $space->createUrl('/space/manage/module/enable', ['moduleId' => $moduleId]); ?>">
                                        <?= Yii::t('SpaceModule.manage', 'Enable'); ?>
                                </a>
                                
                                <a href="#" class="btn btn-sm btn-primary disable" 
                                   style="display:none"
                                    data-action-click="content.container.disableModule" 
                                    data-ui-loader
                                    data-action-url="<?= $space->createUrl('/space/manage/module/disable', ['moduleId' => $moduleId]); ?>">
                                        <?= Yii::t('SpaceModule.manage', 'Disable'); ?>
                                </a>
                            </div>
                        </div>
                        <br>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="modal-footer">
            <a href="#" class="btn btn-primary" 
               data-action-click="ui.modal.post" 
               data-ui-loader
               data-action-url="<?= Url::to(['/space/create/invite', 'spaceId' => $space->id]); ?>">
                   <?= Yii::t('SpaceModule.manage', 'Next'); ?>
            </a>
        </div>
    </div>
</div>
