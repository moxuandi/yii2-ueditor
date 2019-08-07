[百度编辑器 Ueditor for Yii2](http://ueditor.baidu.com/website/index.html)
================
UEditor 是一套开源的在线HTML编辑器，主要用于让用户在网站上获得所见即所得编辑效果，开发人员可以用 UEditor 把传统的多行文本输入框(textarea)替换为可视化的富文本输入框。
UEditor 使用 JavaScript 编写，本扩展已完美实现与 Yii2 的兼容开发。

安装:
------------
使用 [composer](http://getcomposer.org/download/) 下载:
```
# 2.2.x(yii >= 2.0.24):
composer require moxuandi/yii2-ueditor:"~2.2.0"

# 2.x(yii >= 2.0.16):
composer require moxuandi/yii2-ueditor:"~2.1.0"
composer require moxuandi/yii2-ueditor:"~2.0.0"

# 1.x(非重要Bug, 不再更新):
composer require moxuandi/yii2-ueditor:"~1.0"

# 旧版归档(不再更新):
composer require moxuandi/yii2-ueditor:"~0.1"

# 开发版:
composer require moxuandi/yii2-ueditor:"dev-master"
```


使用:
-----

在`Controller`中添加:
```php
public function actions()
{
    return [
        'UeUpload' => [
            'class' => 'moxuandi\ueditor\UploaderAction',
            // 可选参数, 参考 config.php
            'config' => [
                'imageMaxSize' => 1*1024*1024,  // 上传大小限制, 单位B, 默认1MB, 注意修改服务器的大小限制
                'imageAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp'],  // 允许上传的文件类型
                'imagePathFormat' => '/uploads/image/{yyyy}{mm}{dd}/{hh}{ii}{ss}_{rand:6}',  // 文件保存路径

                // 如果`uploads`目录与当前应用的入口文件不在同一个目录, 必须做如下配置:
                'rootPath' => dirname(dirname(dirname(Yii::$app->request->scriptFile))),
                'rootUrl' => 'http://image.advanced.ccc',
                'imageUrlPrefix' => 'http://image.advanced.ccc',
                'scrawlUrlPrefix' => 'http://image.advanced.ccc',
                'videoUrlPrefix' => 'http://image.advanced.ccc',
                'fileUrlPrefix' => 'http://image.advanced.ccc',
                'imageManagerUrlPrefix' => 'http://image.advanced.ccc',
                'fileManagerUrlPrefix' => 'http://image.advanced.ccc',
            ],
        ]
    ];
}
```

在`View`中添加:
```php
1. 简单调用:
$form->field($model, 'content')->widget('moxuandi\ueditor\UEditor');

2. 带参数调用:
$form->field($model, 'content')->widget('moxuandi\ueditor\UEditor', [
    'editorOptions' => [
        //编辑区域的大小
        'initialFrameWidth' => '100%',
        'initialFrameHeight' => 400,
        //定制菜单
        'toolbars' => [[
            'fullscreen', 'source', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'removeformat', 'formatmatch', 'pasteplain', '|',
            'paragraph', 'fontfamily', 'fontsize', 'forecolor', 'lineheight', 'insertorderedlist', 'insertunorderedlist', '|',
            'indent', 'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
            'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'attachment', 'map', 'link', 'unlink', 'anchor', 'spechars', 'insertcode'
        ]],
    ],
]);

3. 不带 $model 调用:
\moxuandi\ueditor\UEditor::widget([
    'name' => 'content',
    'value' => '初始值',
    'editorOptions' => [
        'initialFrameWidth' => '100%',
        'initialFrameHeight' => 400,
    ]
]);
```

编辑器相关配置，请在视图`view`中配置，参数为`editorOptions`，比如定制菜单，编辑器大小等等，具体参数请查看[Ueditor官网文档](http://fex-team.github.io/ueditor/#start-config)

另可配置缩略图,裁剪图,水印等, 对图片做进一步处理; 详细配置请参考[moxuandi\helpers\Uploader](https://github.com/moxuandi/yii2-helpers)
```php
'config' => [
    // 缩略图
    'thumb' => [
        'width' => 300,
        'height' => 200,
        //'mode' => 'outbound',  // 'inset'(补白), 'outbound'(裁剪, 默认值)
        //'match' => ['image', 'thumb'],
    ],

    // 裁剪图像
    'crop' => [
        'width' => 300,
        'height' => 200,
        //'top' => 0,
        //'left' => 0,
        //'match' => ['image', 'crop'],
    ],

    // 添加边框
    'frame' => [
        'margin' => 20,
        //'color' => '666',
        //'alpha' => 100,
        //'match' => ['image', 'frame'],
    ],

    // 添加图片水印
    'watermark' => [
        'watermarkImage' => '@web/uploads/watermark.png',
        //'top' => 0,
        //'left' => 0,
        //'match' => ['image', 'watermark'],
    ],

    // 添加文字水印
    'text' => [
        'text' => '水印文字',
        'fontFile' => '@web/uploads/simhei.ttf',  // 字体文件的位置
        /*'fontOptions' => [
            'size' => 12,
            'color' => 'fff',
            'angle' => 0,
        ],*/
        //'top' => 0,
        //'left' => 0,
        //'match' => ['image', 'text'],
    ],

    // 调整图片大小
    'resize' => [
        'width' => 300,
        'height' => 200,
        //'keepAspectRatio' => true,  // 是否保持图片纵横比
        //'allowUpscaling' => false,  // 如果原图很小, 图片是否放大
        //'match' => ['image', 'resize'],
    ],
],
```
