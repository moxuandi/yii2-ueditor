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
                'saveDatabase' => false,  // 文件信息是否保存入库
                'process' => [  // 二维数组, 将按照子数组的顺序对图片进行处理
                    'match' => ['image', 'process'],  // 图片处理后保存路径的替换规则, 必须是两个元素的数组
                    'thumb' => [  // 缩略图配置
                        'width' => 300,  // 缩略图宽度
                        'height' => 200,  // 缩略图高度
                        'mode' => 'outbound',  // 生成缩略图的模式, 可用值: 'inset'(补白), 'outbound'(裁剪, 默认值)
                    ],
                    'crop' => [  // 裁剪图配置
                        'width' => 300,  // 裁剪图的宽度
                        'height' => 200,  // 裁剪图的高度
                        'top' => 200,  // 裁剪图顶部的偏移, y轴起点, 默认为`0`
                        'left' => 200,  // 裁剪图左侧的偏移, x轴起点, 默认为`0`
                    ],
                    'frame' => [  // 添加边框的配置
                        'margin' => 20,  // 边框的宽度, 默认为`20`
                        'color' => '666',  // 边框的颜色, 十六进制颜色编码, 可以不带`#`, 默认为`666`
                        'alpha' => 100,  // 边框的透明度, 可能仅`png`图片生效, 默认为`100`
                    ],
                    'watermark' => [  // 添加图片水印的配置
                        'watermarkImage' => '/uploads/watermark.png',  // 水印图片的绝对路径
                        'top' => 100,  // 水印图片的顶部距离原图顶部的偏移, y轴起点, 默认为`0`
                        'left' => 200,  // 水印图片的左侧距离原图左侧的偏移, x轴起点, 默认为`0`
                    ],
                    'text' => [  // 添加文字水印的配置
                        'text' => 'TONGMENGCMS',  // 水印文字的内容
                        'fontFile' => '@yii/captcha/SpicyRice.ttf',  // 字体文件, 可以是绝对路径或别名
                        'top' => 100,  // 水印文字距离原图顶部的偏移, y轴起点, 默认为`0`
                        'left' => 200,  // 水印文字距离原图左侧的偏移, x轴起点, 默认为`0`
                        'fontOptions' => [  // 字体属性
                            'size' => 12,  // 字体的大小, 单位像素(`px`), 默认为`12`
                            'color' => 'fff',  // 字体的颜色, 十六进制颜色编码, 可以不带`#`, 默认为`fff`
                            'angle' => 0,  // 写入文本的角度, 默认为`0`
                        ],
                    ],
                    'resize' => [  // 调整图片大小的配置
                        'width' => 300,  // 图片调整后的宽度
                        'height' => 200,  // 图片调整后的高度
                        'keepAspectRatio' => true,  // 是否保持图片纵横比, 默认为`true`
                        'allowUpscaling' => false,  // 如果原图很小, 图片是否放大, 默认为`false`
                    ],
                ],

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
