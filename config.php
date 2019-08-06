<?php
/**
 * 前后端通信相关的配置
 * @see [参考](http://fex.baidu.com/ueditor/#server-config)
 * @see assets/php/config.json
 */
return [
    /* 上传图片配置项 */
    'imageActionName' => 'uploadimage',  // 执行上传图片的action名称
    'imageFieldName' => 'upfile',  // 提交的图片表单名称
    'imageMaxSize' => 1*1024*1024,  // 上传大小限制, 单位B, 默认1MB, 注意修改服务器的大小限制
    'imageAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp'],  // 允许上传的文件类型
    'imagePathFormat' => '/uploads/image/{yyyy}{mm}{dd}/{hh}{ii}{ss}_{rand:6}',  // 文件保存路径
    'imageCompressEnable' => true,  // 是否压缩图片
    'imageCompressBorder' => 1600,  // 图片压缩最长边限制
    'imageInsertAlign' => 'none',  // 插入的图片浮动方式
    'imageUrlPrefix' => '',  // 图片访问路径前缀


    /* 涂鸦图片上传配置项 */
    'scrawlActionName' => 'uploadscrawl',  // 执行上传涂鸦的action名称
    'scrawlFieldName' => 'upfile',  // 提交的图片表单名称
    'scrawlPathFormat' => '/uploads/scrawl/{yyyy}{mm}{dd}/{hh}{ii}{ss}_{rand:6}',  // 文件保存路径
    'scrawlMaxSize' => 512*1024,  // 上传大小限制, 单位B, 默认512KB, 注意修改服务器的大小限制
    'scrawlUrlPrefix' => '',  // 图片访问路径前缀
    'scrawlInsertAlign' => 'none',  // 插入的图片浮动方式


    /* 截图工具上传 */
    'snapscreenActionName' => 'uploadimage',  // 执行上传截图的action名称
    'snapscreenPathFormat' => '/uploads/snapscreen/{yyyy}{mm}{dd}/{hh}{ii}{ss}_{rand:6}',  // 文件保存路径
    'snapscreenUrlPrefix' => '',  // 图片访问路径前缀
    'snapscreenInsertAlign' => 'none',  // 插入的图片浮动方式


    /* 抓取远程图片配置 */
    'catcherLocalDomain' => ['127.0.0.1', 'localhost', 'img.baidu.com'],  // 例外(不允许)的图片抓取域名
    'catcherActionName' => 'catchimage',  // 执行抓取远程图片的action名称
    'catcherFieldName' => 'source',  // 提交的图片表单名称
    'catcherPathFormat' => '/uploads/image/{yyyy}{mm}{dd}/{hh}{ii}{ss}_{rand:6}',  // 文件保存路径
    'catcherUrlPrefix' => '',  // 图片访问路径前缀
    'catcherMaxSize' => 1*1024*1024,  // 上传大小限制, 单位B, 默认1MB, 注意修改服务器的大小限制
    'catcherAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp'],  // 允许上传的文件类型


    /* 上传视频配置 */
    'videoActionName' => 'uploadvideo',  // 执行上传视频的action名称
    'videoFieldName' => 'upfile',  // 提交的视频表单名称
    'videoPathFormat' => '/uploads/media/{yyyy}{mm}{dd}/{hh}{ii}{ss}_{rand:6}',  // 文件保存路径
    'videoUrlPrefix' => '',  // 视频访问路径前缀
    'videoMaxSize' => 10*1024*1024,  // 上传大小限制, 单位B, 默认10MB, 注意修改服务器的大小限制
    'videoAllowFiles' => [  // 允许上传的文件类型
        '.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg',
        '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid'
    ],


    /* 上传文件配置 */
    'fileActionName' => 'uploadfile',  // 执行上传文件的action名称
    'fileFieldName' => 'upfile',  // 提交的文件表单名称
    'filePathFormat' => '/uploads/file/{yyyy}{mm}{dd}/{hh}{ii}{ss}_{rand:6}',  // 文件保存路径
    'fileUrlPrefix' => '',  // 文件访问路径前缀
    'fileMaxSize' => 10*1024*1024,  // 上传大小限制, 单位B, 默认10MB, 注意修改服务器的大小限制
    'fileAllowFiles' => [  // 允许上传的文件类型
        '.png', '.jpg', '.jpeg', '.gif', '.bmp',
        '.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg',
        '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid',
        '.rar', '.zip', '.tar', '.gz', '.7z', '.bz2', '.cab', '.iso',
        '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.pdf', '.txt', '.md', '.xml'
    ],


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
    'fileManagerAllowFiles' => [  // 列出的文件类型
        '.png', '.jpg', '.jpeg', '.gif', '.bmp',
        '.flv', '.swf', '.mkv', '.avi', '.rm', '.rmvb', '.mpeg', '.mpg',
        '.ogg', '.ogv', '.mov', '.wmv', '.mp4', '.webm', '.mp3', '.wav', '.mid',
        '.rar', '.zip', '.tar', '.gz', '.7z', '.bz2', '.cab', '.iso',
        '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.pdf', '.txt', '.md', '.xml'
    ],
];
