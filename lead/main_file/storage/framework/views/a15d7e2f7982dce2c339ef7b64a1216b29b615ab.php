
<?php
$settings = App\Models\Utility::settings();
    $company_favicon=Utility::getValByName('company_favicon');
    $color = isset($settings['color']) ? $settings['color'] : 'theme-4';
    $SITE_RTL = App\Models\Utility::getValByName('SITE_RTL');
    if($SITE_RTL == ''){
            $SITE_RTL == 'off';
        }
?>


<?php if($get == 'saved'): ?>
    <table class="messenger-list-item m-li-divider <?php if('user_'.Auth::user()->id == $id && $id != "0"): ?> m-list-active <?php endif; ?>">
        <tr data-action="0">
            
            <td>
            <?php if($color == "theme-1"): ?>
            <div class="avatar av-m" style="background-color: #D9EFFF; text-align: center;">
                <span class="far fa-bookmark" style="font-size: 22px; color: #51459D; margin-top: 12px !important;"></span>
            </div>
            <?php endif; ?>
             <?php if($color == "theme-2"): ?>
            <div class="avatar av-m" style="background-color: #D9EFFF; text-align: center;">
                <span class="far fa-bookmark" style="font-size: 22px; color: #1F3996; margin-top: 12px !important;"></span>
            </div>
            <?php endif; ?>
             <?php if($color == "theme-3"): ?>
            <div class="avatar av-m" style="background-color: #D9EFFF; text-align: center;">
                <span class="far fa-bookmark" style="font-size: 22px; color: #6FD943; margin-top: 12px !important;"></span>
            </div>
            <?php endif; ?>
             <?php if($color == "theme-4"): ?>
            <div class="avatar av-m" style="background-color: #D9EFFF; text-align: center;">
                <span class="far fa-bookmark" style="font-size: 22px; color: #584ED2; margin-top: 12px !important;"></span>
            </div>
            <?php endif; ?>
            </td>
            
            <td style="width: 100%;">
                <p data-id="<?php echo e('user_'.Auth::user()->id); ?>" style="text-align: start;">Saved Messages <span>You</span></p>
                <span>Save messages secretly</span>
            </td>
        </tr>
    </table>
<?php endif; ?>

<?php if($get == 'users'): ?>
    <table class="messenger-list-item <?php if($user->id == $id && $id != "0"): ?> m-list-active <?php endif; ?>" data-contact="<?php echo e($user->id); ?>">
        <tr data-action="0">
            
            <td style="position: relative">
                <?php if($user->active_status): ?>
                    <span class="activeStatus"></span>
                <?php endif; ?>
                <?php if(!empty($user->avatar)): ?>
                    <div class="avatar av-m"
                         style="background-image: url('<?php echo e(asset('/storage/'.config('chatify.user_avatar.folder').'/'.$user->avatar)); ?>');">
                    </div>
                <?php else: ?>
                    <div class="avatar av-m"
                         style="background-image: url('<?php echo e(asset('/storage/'.config('chatify.user_avatar.folder').'/avatar.png')); ?>');">
                    </div>
                <?php endif; ?>
            </td>
            
            <?php if(!empty($lastMessage)): ?>
            <td style="width: 100%;">
                <p data-id="<?php echo e($type.'_'.$user->id); ?>"  style="text-align: start;">
                    <?php echo e(strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name); ?>

                    <span><?php echo e($lastMessage->created_at->diffForHumans()); ?></span></p>
                <span>
            
                    <?php echo $lastMessage->from_id == Auth::user()->id
                        ? '<span class="lastMessageIndicator">'.__('You :').'</span>'
                        : ''; ?>

                    
                    <?php if($lastMessage->attachment == null): ?>
                        <?php echo e(strlen($lastMessage->body) > 30
                            ? trim(substr($lastMessage->body, 0, 30)).'..'
                            : $lastMessage->body); ?>

                    <?php else: ?>
                        <span class="fas fa-file"></span> <?php echo e(__('Attachment')); ?>

                    <?php endif; ?>
        </span>
                
                <?php echo $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : ''; ?>

            </td>
            <?php else: ?>
            <td></td>
            <?php endif; ?>
        </tr>
    </table>
<?php endif; ?>


<?php if($get == 'search_item'): ?>
    <table class="messenger-list-item" data-contact="<?php echo e($user->id); ?>">
        <tr data-action="0">
            
            <td style="position: relative">
                <?php if($user->active_status): ?>
                    <span class="activeStatus"></span>
                <?php endif; ?>
                <?php if(!empty($user->avatar)): ?>
                    <div class="avatar av-m"
                         style="background-image: url('<?php echo e(asset('/storage/'.config('chatify.user_avatar.folder').'/'.$user->avatar)); ?>');">
                    </div>
                <?php else: ?>
                    <div class="avatar av-m"
                         style="background-image: url('<?php echo e(asset('/storage/'.config('chatify.user_avatar.folder').'/avatar.png')); ?>');">
                    </div>
                <?php endif; ?>
            </td>
            
            <td>
                <p data-id="<?php echo e($type.'_'.$user->id); ?>">
                <?php echo e(strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name); ?>

            </td>

        </tr>
    </table>
<?php endif; ?>



<?php if($get == 'all_members'): ?>
    <table class="messenger-list-item" data-contact="<?php echo e($user->id); ?>">
        <tr data-action="0">
            
            <td style="position: relative">
                <?php if($user->active_status): ?>
                    <span class="activeStatus"></span>
                <?php endif; ?>
                <?php if(!empty($user->avatar)): ?>
                    <div class="avatar av-m"
                         style="background-image: url('<?php echo e(asset('/storage/'.config('chatify.user_avatar.folder').'/'.$user->avatar)); ?>');">
                    </div>
                <?php else: ?>
                    <div class="avatar av-m"
                         style="background-image: url('<?php echo e(asset('/storage/'.config('chatify.user_avatar.folder').'/avatar.png')); ?>');">
                    </div>
                <?php endif; ?>
            </td>
            
            <td>
                <p data-id="<?php echo e($type.'_'.$user->id); ?>">
                <?php echo e(strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name); ?>

            </td>

        </tr>
    </table>
<?php endif; ?>


<?php if($get == 'sharedPhoto'): ?>
    <div class="shared-photo chat-image" style="background-image: url('<?php echo e($image); ?>')"></div>
<?php endif; ?>


<?php /**PATH /home/shadecrm/giftsociety.shadecrm.com/lead/main_file/resources/views/vendor/Chatify/layouts/listItem.blade.php ENDPATH**/ ?>