<?php
namespace moxuandi\ueditor;

use yii\web\AssetBundle;

/**
 * Asset bundle for the UEditor
 *
 * @author zhangmoxuan <1104984259@qq.com>
 * @link http://www.zhangmoxuan.com
 * @QQ 1104984259
 * @Date 2019-2-6
 */
class UEditorAsset extends AssetBundle
{
    public $sourcePath = '@vendor/moxuandi/yii2-ueditor/assets';

    public $css = [];

    public $js = [
        'ueditor.config.js',
        'ueditor.all.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
