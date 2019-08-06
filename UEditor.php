<?php
namespace moxuandi\ueditor;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\InputWidget;

/**
 * UEditor renders a editor js plugin for classic editing.
 *
 * @author zhangmoxuan <1104984259@qq.com>
 * @link http://www.zhangmoxuan.com
 * @QQ 1104984259
 * @Date 2019-2-6
 * @see http://ueditor.baidu.com/website/
 */
class UEditor extends InputWidget
{
    /**
     * @var array 配置接口, 参阅[UEditor 官方文档](http://fex.baidu.com/ueditor/#start-config)
     * @see assets/ueditor.config.js
     */
    public $editorOptions = [];


    public function init()
    {
        parent::init();
        $this->hasModel() ? $this->id = $this->options['id'] : $this->id = $this->options['id'] = $this->id . '_' . $this->name;
        $this->editorOptions = array_merge([
            'serverUrl' => Url::to(['UeUpload']),
            'initialFrameWidth' => '100%',
            'initialFrameHeight' => 320,
            'lang' => strtolower(Yii::$app->language) == 'en-us' ? 'en' : 'zh-cn'
        ], $this->editorOptions);
    }

    /**
     * 渲染输入域
     * @return string
     */
    public function run()
    {
        self::registerScript();
        return $this->hasModel() ? Html::activeTextarea($this->model, $this->attribute, $this->options) : Html::textarea($this->name, $this->value, $this->options);
    }

    /**
     * 注册客户端脚本
     */
    private function registerScript()
    {
        UEditorAsset::register($this->view);
        $editorOptions = Json::encode($this->editorOptions);
        $this->view->registerJs("UE.getEditor('{$this->id}', $editorOptions);");
    }
}
