[百度编辑器 Ueditor for Yii2](http://ueditor.baidu.com/website/index.html)
================
UEditor 是一套开源的在线HTML编辑器，主要用于让用户在网站上获得所见即所得编辑效果，开发人员可以用 UEditor 把传统的多行文本输入框(textarea)替换为可视化的富文本输入框。
UEditor 使用 JavaScript 编写，本扩展已完美实现与 Yii2 的兼容开发。

安装:
------------
使用 [composer](http://getcomposer.org/download/) 下载:
```
# 2.x(yii >= 2.0.16):
composer require moxuandi/yii2-ueditor:"~2.0"

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
            'class' => 'moxuandi\ueditor\UEditorUpload',
            // 可选参数, 参考 config.php
            'config' => [
                'imageMaxSize' => 1*1024*1024,
                'imageAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp'],
                'imagePathFormat' => '/uploads/image/{yyyy}{mm}/{yy}{mm}{dd}_{hh}{ii}{ss}_{rand:4}',
                'thumbStatus' => false,
                'thumbWidth' => 300,
                'thumbHeight' => 200,
                'thumbMode' => 'outbound',
            ],
        ],
    ];
}
```

在`View`中添加:
```php
// 1. 简单调用(基于模型):
$form->field($model, 'content')->widget('moxuandi\ueditor\UEditor');

// 2. 带参数调用(此模式下仅`$editorOptions`参数可用):
$form->field($model, 'content')->widget('moxuandi\ueditor\UEditor',[
    'editorOptions' => [
        'initialFrameWidth' => 1000,
        'initialFrameHeight' => 500,
    ],
]);

// 3. 不带`$model`调用(已列出所有可用参数, 可适当忽略):
\moxuandi\ueditor\UEditor::widget([
    'id' => 'editor',
    'attribute' => 'content',
    //'name' => 'content',
    'value' => '初始化编辑器时的内容',
    'editorOptions' => [
        'initialFrameWidth' => 1000,
        'initialFrameHeight' => 500,
    ],
]);
```

编辑器相关配置，请在`view`中配置，参数为`editorOptions`，比如定制菜单，编辑器大小等等，具体参数请查看[Ueditor官网文档](http://fex-team.github.io/ueditor/#start-config)
