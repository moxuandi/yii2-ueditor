<?php
namespace moxuandi\ueditor;

use Yii;
use yii\base\Exception;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Response;
use moxuandi\helpers\Uploader;

/**
 * UEditor 接收上传图片控制器.
 *
 * @author zhangmoxuan <1104984259@qq.com>
 * @link http://www.zhangmoxuan.com
 * @QQ 1104984259
 * @Date 2019-2-6
 */
class UploaderAction extends Action
{
    /**
     * @var array 上传配置信息接口
     */
    public $config = [];


    public function init()
    {
        parent::init();
        Yii::$app->request->enableCsrfValidation = false;  // 关闭csrf
        $_config = require(__DIR__ . '/config.php');  // 加载默认上传配置
        $this->config = array_merge($_config, $this->config);
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        switch(Yii::$app->request->get('action')){
            // 上传图片 & 截图工具上传 & 多图上传
            case 'uploadimage':
                // 上传涂鸦
            case 'uploadscrawl':
                // 上传视频
            case 'uploadvideo':
                // 上传文件
            case 'uploadfile': $result = $this->actionUpload(); break;
            // 图片在线管理器
            case 'listimage':
                // 文件在线管理器
            case 'listfile': $result = $this->actionList(); break;
            // 配置参数
            case 'config': $result = $this->config; break;
            // 抓取远程图片
            //case 'catchimage': $result = []; break;
            default: $result = ['state'=>'请求地址出错']; break;
        }

        // 输出结果
        if($callback = Yii::$app->request->get('callback')){
            if(preg_match("/^[\w_]+$/", $callback)){
                echo htmlspecialchars($callback) . '(' . $result . ')';
            }else{
                echo Json::encode(['state'=>'callback 参数不合法']);
            }
            exit();
        }else{
            $response = Yii::$app->response;
            $response->format = Response::FORMAT_JSON;
            $response->data = $result;
            $response->send();
        }
    }

    /**
     * 处理上传
     * @return array
     * @throws Exception
     */
    public function actionUpload()
    {
        $base64 = 'upload';
        switch(Yii::$app->request->get('action')){
            // 上传图片 & 截图工具上传 & 多图上传
            case 'uploadimage':
                $config = [
                    'pathFormat' => $this->config['imagePathFormat'],
                    'maxSize' => $this->config['imageMaxSize'],
                    'allowFiles' => $this->config['imageAllowFiles'],
                    'process' => ArrayHelper::getValue($this->config, 'process', false),
                ];
                $fieldName = $this->config['imageFieldName'];
                break;
            // 上传涂鸦
            case 'uploadscrawl':
                $config = [
                    'pathFormat' => $this->config['scrawlPathFormat'],
                    'maxSize' => $this->config['scrawlMaxSize'],
                    'realName' => 'scrawl.png'
                ];
                $fieldName = $this->config['scrawlFieldName'];
                $base64 = 'base64';
                break;
            // 上传视频
            case 'uploadvideo':
                $config = [
                    'pathFormat' => $this->config['videoPathFormat'],
                    'maxSize' => $this->config['videoMaxSize'],
                    'allowFiles' => $this->config['videoAllowFiles']
                ];
                $fieldName = $this->config['videoFieldName'];
                break;
            // 上传文件
            case 'uploadfile':
            default:
                $config = [
                    'pathFormat' => $this->config['filePathFormat'],
                    'maxSize' => $this->config['fileMaxSize'],
                    'allowFiles' => $this->config['fileAllowFiles']
                ];
                $fieldName = $this->config['fileFieldName'];
                break;
        }

        $config['rootPath'] = ArrayHelper::getValue($this->config, 'rootPath', dirname(Yii::$app->request->scriptFile));
        $config['rootUrl'] = ArrayHelper::getValue($this->config, 'rootUrl', Yii::$app->request->hostInfo);
        $config['saveDatabase'] = ArrayHelper::getValue($this->config, 'saveDatabase', false);

        // 生成上传实例对象并完成上传, 返回结果数据
        $upload = new Uploader($fieldName, $config, $base64);
        return [
            'original' => $upload->realName,   // 原始文件名, eg: 'img_6.jpg'
            'title' => $upload->fileName,      // 新文件名, eg: '171210_054500_8166.jpg'
            'url' => $upload->fullName,        // 返回的地址, eg: '/uploads/image/201712/171210_054500_8166.jpg'
            'size' => $upload->fileSize,       // 文件大小, eg: 108527
            'type' => '.' . $upload->fileExt,  // 文件类型, eg: '.jpg'
            'state' => Uploader::$stateMap[$upload->status],  // 上传状态, 上传成功时必须返回'SUCCESS'
        ];
    }

    /**
     * 图片/文件在线管理器
     * @return array
     */
    public function actionList()
    {
        switch(Yii::$app->request->get('action')){
            // 文件
            case 'listfile':
                $allowFiles = $this->config['fileManagerAllowFiles'];
                $listSize = $this->config['fileManagerListSize'];
                $path = $this->config['fileManagerListPath'];
                break;
            // 图片
            case 'listimage':
            default:
                $allowFiles = $this->config['imageManagerAllowFiles'];
                $listSize = $this->config['imageManagerListSize'];
                $path = $this->config['imageManagerListPath'];
                break;
        }

        // 允许列出的文件类型, eg: 'png|jpg|jpeg|gif|bmp'
        $allowFiles = substr(str_replace('.', '|', implode('', $allowFiles)), 1);

        // 获取参数
        $getStart = Yii::$app->request->get('start');
        $getSize = Yii::$app->request->get('size');
        $start = isset($getStart) ? htmlspecialchars($getStart) : 0;
        $size = isset($getSize) ? htmlspecialchars($getSize) : $listSize;
        $end = (int)$start + (int)$size;

        // 获取文件列表
        $rootPath = ArrayHelper::getValue($this->config, 'rootPath', dirname(Yii::$app->request->scriptFile));
        //$rootUrl = ArrayHelper::getValue($this->config, 'rootPath', Yii::$app->request->hostInfo);
        $path = $rootPath . $path;
        $files = $this->getFiles($path, $rootPath, $allowFiles);
        $length = count($files);  // 文件总数
        if($length === 0){  // 如果没有文件
            return ['state' => '没有匹配的文件', 'list' => [], 'start' => $start, 'total' => $length];  // 'state' => 'no match file'
        }

        // 获取指定范围的文件列表
        $list = [];
        $files = array_reverse($files);  // 倒序
        for($i = $start; $i < $end && $i < $length; $i++){
            $list[] = $files[$i];
        }

        // 返回数据
        return ['state' => 'SUCCESS', 'list' => $list, 'start' => $start, 'total' => $length];
    }

    /**
     * 获取文件列表
     * @param string $path
     * @param string $rootPath
     * @param string $allowFiles
     * @param array $files
     * @return array|null
     */
    public function getFiles($path, $rootPath, $allowFiles, &$files = [])
    {
        if(!is_dir($path)) return null;  // 不是目录, 返回 null

        // 最后一个字符必须是'/'
        if(substr($path, strlen($path) - 1) != '/'){
            $path .= '/';
        }

        if($handle = opendir($path)){  // 打开目录句柄
            while(false !== ($file = readdir($handle))){  // 循环获取文件, readdir()每次返回一个文件
                if(!in_array($file, ['.', '..'])){
                    $path2 = $path . $file;
                    if(is_dir($path2)){
                        $this->getFiles($path2, $rootPath, $allowFiles, $files);
                    }else{
                        if(preg_match('/\.(' . $allowFiles . ')$/i', $file)){
                            $files[] = [
                                'url' => substr($path2, strlen($rootPath)),
                                'mtime' => filemtime($path2)
                            ];
                        }
                    }
                }
            }
            closedir($handle);  // 关闭目录句柄
        }
        return $files;
    }
}
