<?php
/**
 * 前后端通信相关的配置
 * 详情请查看assets/php/config.json
 * see http://fex.baidu.com/ueditor/#server-config
 */
return [
    /* 上传图片配置项 */
    'imageActionName' => 'uploadimage',  // 执行上传图片的action名称
    'imageFieldName' => 'upfile',  // 提交的图片表单名称
    'imageMaxSize' => 5*1024*1024,  // 上传大小限制, 单位B, 默认5MB, 注意修改服务器的大小限制
    'imageAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp'],  // 上传图片格式显示
    'imageCompressEnable' => true,  // 是否压缩图片, 默认是 true
    'imageCompressBorder' => 1600,  // 图片压缩最长边限制
    'imageInsertAlign' => 'none',  // 插入的图片浮动方式
    'imageUrlPrefix' => '',  // 图片访问路径前缀
    'thumbStatus' => true,  // 是否生成缩略图
    'thumbWidth' => 300,  // 缩略图宽度
    'thumbHeight' => 200,  // 缩略图高度
    'thumbCut' => 1,  // 生成缩略图的方式, 0:留白, 1:裁剪
    'imagePathFormat' => 'uploads/image/{yyyy}{mm}/{yy}{mm}{dd}_{hh}{ii}{ss}_{rand:4}',  // 上传保存路径,可以自定义保存路径和文件名格式
    /* {filename} 会替换成原文件名[要注意中文文件乱码问题] */
    /* {rand:6} 会替换成随机数, 后面的数字是随机数的位数 */
    /* {time} 会替换成时间戳 */
    /* {yyyy} 会替换成四位年份 */
    /* {yy} 会替换成两位年份 */
    /* {mm} 会替换成两位月份 */
    /* {dd} 会替换成两位日期 */
    /* {hh} 会替换成两位小时 */
    /* {ii} 会替换成两位分钟 */
    /* {ss} 会替换成两位秒 */
    /* 非法字符 \ : * ? " < > | */
    /* 具请体看线上文档: http://fex.baidu.com/ueditor/#server-path 3.1 */


    /* 涂鸦图片上传配置项 */
    'scrawlActionName' => 'uploadscrawl',  // 执行上传涂鸦的action名称
    'scrawlFieldName' => 'upfile',  // 提交的图片表单名称
    'scrawlMaxSize' => 2*1024*1024,  // 上传大小限制, 单位B, 默认2MB, 注意修改服务器的大小限制
    'scrawlUrlPrefix' => '',  // 图片访问路径前缀
    'scrawlInsertAlign' => 'none',  // 插入的图片浮动方式
    'scrawlPathFormat' => 'uploads/scrawl/{yyyy}{mm}/{yy}{mm}{dd}_{hh}{ii}{ss}_{rand:4}',  // 上传保存路径


    /* 截图工具上传 */
    'snapscreenActionName' => 'uploadimage',  // 执行上传截图的action名称
    'snapscreenUrlPrefix' => '',  // 图片访问路径前缀
    'snapscreenInsertAlign' => 'none',  // 插入的图片浮动方式
    'snapscreenPathFormat' => 'uploads/snapscreen/{yyyy}{mm}/{yy}{mm}{dd}_{hh}{ii}{ss}_{rand:4}',  // 上传保存路径


    /* 抓取远程图片配置 */
    'catcherLocalDomain' => ['127.0.0.1', 'localhost', 'img.baidu.com'],  // 例外(不允许)的图片抓取域名
    'catcherActionName' => 'catchimage',  // 执行抓取远程图片的action名称
    'catcherFieldName' => 'source',  // 提交的图片列表表单名称
    'catcherUrlPrefix' => '',  // 图片访问路径前缀
    'catcherMaxSize' => 2*1024*1024,  // 上传大小限制, 单位B, 默认2MB, 注意修改服务器的大小限制
    'catcherAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp'],  // 抓取图片格式显示
    'catcherPathFormat' => 'uploads/image/{yyyy}{mm}/{yy}{mm}{dd}_{hh}{ii}{ss}_{rand:4}',  // 上传保存路径


    /* 上传视频配置 */
    'videoActionName' => 'uploadvideo',  // 执行上传视频的action名称
    'videoFieldName' => 'upfile',  // 提交的视频表单名称
    'videoUrlPrefix' => '',  // 视频访问路径前缀
    'videoMaxSize' => 20*1024*1024,  // 上传大小限制, 单位B, 默认20MB, 注意修改服务器的大小限制
    'videoPathFormat' => 'uploads/media/{yyyy}{mm}/{yy}{mm}{dd}_{hh}{ii}{ss}_{rand:4}',  // 上传保存路径
    'videoAllowFiles' => ['.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg', '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid'],  // 上传视频格式显示


    /* 上传文件配置 */
    'fileActionName' => 'uploadfile',  // 执行上传视频的action名称
    'fileFieldName' => 'upfile',  // 提交的文件表单名称
    'fileUrlPrefix' => '',  // 文件访问路径前缀
    'fileMaxSize' => 50*1024*1024,  // 上传大小限制, 单位B, 默认50MB, 注意修改服务器的大小限制
    'filePathFormat' => 'uploads/file/{yyyy}{mm}/{yy}{mm}{dd}_{hh}{ii}{ss}_{rand:4}',  // 上传保存路径
    'fileAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp', '.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg', '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid', '.rar', '.zip', '.tar', '.gz', '.7z', '.bz2', '.cab', '.iso', '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.pdf', '.txt', '.md', '.xml'],  // 上传文件格式显示



    /* 列出指定目录下的图片 */
    'imageManagerActionName' => 'listimage',  // 执行图片管理的action名称
    'imageManagerListPath' => '/uploads/image/',  // 指定要列出图片的目录
    'imageManagerListSize' => 20,  // 每次列出文件数量
    'imageManagerUrlPrefix' => '',  // 图片访问路径前缀
    'imageManagerInsertAlign' => 'none',  // 插入的图片浮动方式
    'imageManagerAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp'],  // 列出的文件类型


    /* 列出指定目录下的文件 */
    'fileManagerActionName' => 'listfile',  // 执行文件管理的action名称
    'fileManagerListPath' => '/uploads/file/',  // 指定要列出文件的目录
    'fileManagerUrlPrefix' => '',  // 文件访问路径前缀
    'fileManagerListSize' => 20,  // 每次列出文件数量
    'fileManagerAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp', '.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg', '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid', '.rar', '.zip', '.tar', '.gz', '.7z', '.bz2', '.cab', '.iso', '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.pdf', '.txt', '.md', '.xml'],  // 列出的文件类型

    // 保存上传信息到数据库, 使用前请导入'database'文件夹中的数据表'upload'和模型类'Upload'
    'saveDatabase' => false,
];
