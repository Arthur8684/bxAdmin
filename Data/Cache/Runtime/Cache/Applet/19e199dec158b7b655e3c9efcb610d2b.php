<?php if (!defined('THINK_PATH')) exit();?><!--<!DOCTYPE html>-->
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>编辑</title>
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/edit.css" type="text/css">
    <link rel="stylesheet" href="/cowcms/Public/css_js_font_img/applet/css/icomoon.css" type="text/css">
    <script src="/cowcms/Public/css_js_font_img/applet/js/jquery-3.2.1.min.js" type="text/javascript"></script>
</head>
<body>
<div class="edit-components-wrap">
    <!-- 头部导航-->
    <div class="app-header">
        <div class="header-component">
            <ul class="nav-operation-wrap">
                <li>
                    <i class="icon-colorstyle icon-btn"></i>风格
                </li>
                <li>
                    <i class="icon-config icon-btn"></i>管理
                </li>
                <li>
                    <i class="icon-help icon-btn"></i>帮助
                </li>
                <li>
                    <i class="icon-earphone icon-btn"></i>客服
                </li>
                <li>
                    <i class="icon-history icon-btn"></i>历史
                </li>
            </ul>
        </div>
        <div class="header">
            <a href="#" class="preview-btn header-btn">预览</a>
            <div class="save-btn header-btn">保存</div>
            <a href="#" class="generate-btn">
                <i class="icon-publish icon-btn"></i>生成</a>
        </div>
    </div>
    <!-- 左侧面板-->
    <div class="left-contents">
        <!--左侧面板导航选项卡-->
        <div class="operate-navs">
            <span class="active"><i class="icon-page"></i>页面管理</span>
            <span><i class="icon-conponent"></i>组件库
            <i class="line"></i></span>
        </div>
        <div class="nav-component">
            <!--页面管理内容-->
            <div class="catalog-section active">
                <ul id="group-page-container" class="group-page-container">
                    <li class="group-page-nav active">
                        <div class="group-nav">
                        <span class="group-nav-text">
                            <i class="icon-folder"></i>
                            一级分组
                        </span>
                            <div class="group-page-nav-edit">
                                <span class="icon-delete" title="删除"></span>
                                <span class="icon-edit" title="编辑组名"></span>
                                <span class="icon-addpage" title="添加页面"></span>
                            </div>
                        </div>
                        <ul class="page-navs" style="display: block;">
                            <li class="page-nav active">
                                <span class="js-page-name">首页</span>
                                <span class="edit-group">
                                      <input  class="cate-name" type="text"/>
                                      <button class="confirm">确定</button>
                                      <button class="cancel">取消</button>
                                </span>
                                <div class="page-navs-edit curr">
                                    <span class="icon-delete" title="删除"></span>
                                    <span class="icon-copy" title="复制"></span>
                                    <span class="icon-collect" title="收藏"></span>
                                    <span class="icon-edit" title="编辑名称"></span>
                                </div>
                            </li>
                            <li class="page-nav">
                                <span>分类</span>
                                <span class="edit-group">
                                    <input  class="cate-name" type="text"/>
                                    <button class="confirm">确定</button>
                                    <button class="cancel">取消</button>
                                </span>
                                <div class="page-navs-edit">
                                    <span class="icon-delete" title="删除"></span>
                                    <span class="icon-copy" title="复制"></span>
                                    <span class="icon-collect" title="收藏"></span>
                                    <span class="icon-edit" title="编辑名称"></span>
                                </div>
                            </li>
                            <li class="page-nav">
                                <span>购物车</span>
                                <span class="edit-group">
                                    <input  class="cate-name" type="text"/>
                                    <button class="confirm">确定</button>
                                    <button class="cancel">取消</button>
                                </span>
                                <div class="page-navs-edit">
                                    <span class="icon-delete" title="删除"></span>
                                    <span class="icon-copy" title="复制"></span>
                                    <span class="icon-collect" title="收藏"></span>
                                    <span class="icon-edit" title="编辑名称"></span>
                                </div>
                            </li>
                            <li class="page-nav">
                                <span>我的</span>
                                <span class="edit-group">
                                    <input  class="cate-name" type="text"/>
                                    <button class="confirm">确定</button>
                                    <button class="cancel">取消</button>
                                </span>
                                <div class="page-navs-edit">
                                    <span class="icon-delete" title="删除"></span>
                                    <span class="icon-copy" title="复制"></span>
                                    <span class="icon-collect" title="收藏"></span>
                                    <span class="icon-edit" title="编辑名称"></span>
                                </div></li>
                        </ul>
                    </li>
                    <li class="group-page-nav">
                        <div class="group-nav">
                        <span class="group-nav-text">
                            <i class="icon-folder"></i>
                            二级分组
                        </span>
                        </div>
                        <ul class="page-navs">
                            <li class="page-nav">
                                <span>购物车</span>
                                <span class="edit-group">
                                    <input  class="cate-name" type="text"/>
                                    <button class="confirm">确定</button>
                                    <button class="cancel">取消</button>
                                </span>
                                <div class="page-navs-edit">
                                    <span class="icon-delete" title="删除"></span>
                                    <span class="icon-copy" title="复制"></span>
                                    <span class="icon-collect" title="收藏"></span>
                                    <span class="icon-edit" title="编辑名称"></span>
                                </div>
                            </li>
                            <li class="page-nav">
                                <span>购物车</span>
                                <span class="edit-group">
                                    <input  class="cate-name" type="text"/>
                                    <button class="confirm">确定</button>
                                    <button class="cancel">取消</button>
                                </span>
                                <div class="page-navs-edit">
                                    <span class="icon-delete" title="删除"></span>
                                    <span class="icon-copy" title="复制"></span>
                                    <span class="icon-collect" title="收藏"></span>
                                    <span class="icon-edit" title="编辑名称"></span>
                                </div>
                            </li>
                            <li class="page-nav">
                                <span>购物车</span>
                                <span class="edit-group">
                                    <input  class="cate-name" type="text"/>
                                    <button class="confirm">确定</button>
                                    <button class="cancel">取消</button>
                                </span>
                                <div class="page-navs-edit">
                                    <span class="icon-delete" title="删除"></span>
                                    <span class="icon-copy" title="复制"></span>
                                    <span class="icon-collect" title="收藏"></span>
                                    <span class="icon-edit" title="编辑名称"></span>
                                </div>
                            </li>
                            <li class="page-nav">
                                <span>购物车</span>
                                <span class="edit-group">
                                    <input  class="cate-name" type="text"/>
                                    <button class="confirm">确定</button>
                                    <button class="cancel">取消</button>
                                </span>
                                <div class="page-navs-edit">
                                    <span class="icon-delete" title="删除"></span>
                                    <span class="icon-copy" title="复制"></span>
                                    <span class="icon-collect" title="收藏"></span>
                                    <span class="icon-edit" title="编辑名称"></span>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="group-page-nav">
                        <div class="group-nav">
                        <span class="group-nav-text">
                            <i class="icon-folder"></i>
                            三级分组
                        </span>
                        </div>
                        <ul class="page-navs">
                            <li class="page-nav">
                                <span>购物车</span>
                                <span class="edit-group">
                                    <input  class="cate-name" type="text"/>
                                    <button class="confirm">确定</button>
                                    <button class="cancel">取消</button>
                                </span>
                                <div class="page-navs-edit">
                                    <span class="icon-delete" title="删除"></span>
                                    <span class="icon-copy" title="复制"></span>
                                    <span class="icon-collect" title="收藏"></span>
                                    <span class="icon-edit" title="编辑名称"></span>
                                </div>
                            </li>
                            <li class="page-nav">
                                <span>购物车</span>
                                <span class="edit-group">
                                    <input  class="cate-name" type="text"/>
                                    <button class="confirm">确定</button>
                                    <button class="cancel">取消</button>
                                </span>
                                <div class="page-navs-edit">
                                    <span class="icon-delete" title="删除"></span>
                                    <span class="icon-copy" title="复制"></span>
                                    <span class="icon-collect" title="收藏"></span>
                                    <span class="icon-edit" title="编辑名称"></span>
                                </div>
                            </li>
                            <li class="page-nav">
                                <span>购物车</span>
                                <span class="edit-group">
                                    <input  class="cate-name" type="text"/>
                                    <button class="confirm">确定</button>
                                    <button class="cancel">取消</button>
                                </span>
                                <div class="page-navs-edit">
                                    <span class="icon-delete" title="删除"></span>
                                    <span class="icon-copy" title="复制"></span>
                                    <span class="icon-collect" title="收藏"></span>
                                    <span class="icon-edit" title="编辑名称"></span>
                                </div>
                            </li>
                            <li class="page-nav">
                                <span>购物车</span>
                                <span class="edit-group">
                                    <input  class="cate-name" type="text"/>
                                    <button class="confirm">确定</button>
                                    <button class="cancel">取消</button>
                                </span>
                                <div class="page-navs-edit">
                                    <span class="icon-delete" title="删除"></span>
                                    <span class="icon-copy" title="复制"></span>
                                    <span class="icon-collect" title="收藏"></span>
                                    <span class="icon-edit" title="编辑名称"></span>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="new-page-wrap">
                    <span class="addpage"><i class="icon-addpage"></i>添加页面</span>
                    <span class="addfolder"><i class="icon-addfolder"></i>添加分组</span>
                </div>
                <!-- 添加页面对话框-->
                <div class="add-page-dialog dialog-box">
                    <div class="add-page-content">
                        <ul>
                            <li>
                                页面名称：
                                <input placeholder="建议10个字以内" type="text">
                            </li>
                            <li>
                                选择分组：
                                <select>
                                    <option value="一级分组">一级分组</option>
                                    <option value="二级分组">二级分组</option>
                                    <option value="三级分组">三级分组</option>
                                </select>
                            </li>
                        </ul>
                        <div class="add-page-btn-wrap">
                            <span class="tpl-btn cancel-btn">取消</span>
                            <span class="tpl-btn Determine">确定</span>
                        </div>
                    </div>
                </div>
                <!-- 添加分组对话框-->
                <div class="add-group-dialog dialog-box">
                    <div class="add-page-content">
                        <ul>
                            <li>
                                分组名称：
                                <input placeholder="建议10个字以内" type="text">
                            </li>
                        </ul>
                        <div class="add-page-btn-wrap">
                            <span class="tpl-btn cancel-btn">取消</span>
                            <span class="tpl-btn Determine">确定</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 组件库-->
            <div class="widget-container">
                <ul>
                    <li>
                        <i class="icon-text"></i>
                        <span>文本</span>
                        <a href="#" class="help-wrap">
                            <span class="help-text">？</span>
                            <span class="help"></span>
                        </a>
                    </li>
                    <li>
                        <i class="icon-picture"></i>
                        <span>图片</span>
                        <a href="#" class="help-wrap">
                            <span class="help-text">？</span>
                            <span class="help"></span>
                        </a>
                    </li>
                    <li>
                        <i class="icon-button"></i>
                        <span>按钮</span>
                        <a href="#" class="help-wrap">
                            <span class="help-text">？</span>
                            <span class="help"></span>
                        </a>
                    </li>
                    <li>
                        <i class="icon-text"></i>
                        <span>文本</span>
                        <a href="#" class="help-wrap">
                            <span class="help-text">？</span>
                            <span class="help"></span>
                        </a>
                    </li>
                    <li>
                        <i class="icon-picture"></i>
                        <span>图片</span>
                        <a href="#" class="help-wrap">
                            <span class="help-text">？</span>
                            <span class="help"></span>
                        </a>
                    </li>
                    <li>
                        <i class="icon-button"></i>
                        <span>按钮</span>
                        <a href="#" class="help-wrap">
                            <span class="help-text">？</span>
                            <span class="help"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- 中间手机模块-->
    <div class="app-phone">
        <!-- 手机内部组件-->
        <div class="phone-component">
            <div class="phone-top">
                <img src="/cowcms/Public/css_js_font_img/applet/image/phonetop.png"/>
            </div>
            <div class="phone-container">
                <img src="/cowcms/Public/css_js_font_img/applet/image/phone.jpg" style="width: 100%"/>
            </div>
            <div class="phone-bottom">
                <img src="/cowcms/Public/css_js_font_img/applet/image/phonebottom.png"/>
            </div>
        </div>
        <!--操作拦 -->
        <div class="operate-wrap">
            <span><i class="icon-forward"></i>前进</span>
            <span><i class="icon-backward"></i>后退</span>
            <span><i class="icon-template"></i>模板</span>
            <span><i class="icon-conponent"></i>元素</span>
            <span><i class="icon-page"></i>数据</span>
            <span><i class="icon-heart"></i>模块</span>
        </div>
    </div>
    <!--右侧数据面板-->
    <div class="right-contents">
        <div class="page-wrap">
            <div class="page-setting">
                <!--属性-->
                <div class="page-property">
                    <p class="setting-group-name">属性</p>
                    <div>

                    </div>
                </div>
                <!-- 数据管理-->
                <div class="data-setting">
                    <p class="setting-group-name active">数据管理</p>
                </div>
            </div>
            <div class="backstage">
                <div>
                    <i class="icon-config"></i>
                    后台管理
                </div>
            </div>
        </div>
    </div>
    <!--元素面板-->
    <div class="elements-setting">
        <div class="page-property">
            <div class="widget-tree-title">
                元素
                <i class="close icon-cross"></i>
            </div>
            <div class="scroll-wrap">
                <div class="setting-wrap">
                    <ul class="sortable">
                        <li>
                            <i class="icon icon-search"></i>搜索
                            <div class="ele-set">
                                <i class="delete icon-delete"></i>
                                <i class="drag-ele icon-drag"></i>
                            </div>
                        </li>
                        <li>
                            <i class="icon icon-search"></i>搜索
                            <div class="ele-set">
                                <i class="delete icon-delete"></i>
                                <i class="drag-ele icon-drag"></i>
                            </div>
                        </li>
                        <li>
                            <i class="icon icon-search"></i>搜索
                            <div class="ele-set">
                                <i class="delete icon-delete"></i>
                                <i class="drag-ele icon-drag"></i>
                            </div>
                        </li>
                        <li>
                            <i class="icon icon-search"></i>搜索
                            <div class="ele-set">
                                <i class="delete icon-delete"></i>
                                <i class="drag-ele icon-drag"></i>
                            </div>
                        </li>
                        <li>
                            <i class="icon icon-search"></i>搜索
                            <div class="ele-set">
                                <i class="delete icon-delete"></i>
                                <i class="drag-ele icon-drag"></i>
                            </div>
                        </li>
                        <li>
                            <i class="icon icon-search"></i>搜索
                            <div class="ele-set">
                                <i class="delete icon-delete"></i>
                                <i class="drag-ele icon-drag"></i>
                            </div>
                        </li>
                        <li>
                            <i class="icon icon-search"></i>搜索
                            <div class="ele-set">
                                <i class="delete icon-delete"></i>
                                <i class="drag-ele icon-drag"></i>
                            </div>
                        </li>
                        <li>
                            <i class="icon icon-search"></i>搜索
                            <div class="ele-set">
                                <i class="delete icon-delete"></i>
                                <i class="drag-ele icon-drag"></i>
                            </div>
                        </li>
                        <li>
                            <i class="icon icon-search"></i>搜索
                            <div class="ele-set">
                                <i class="delete icon-delete"></i>
                                <i class="drag-ele icon-drag"></i>
                            </div>
                        </li>
                        <li>
                            <i class="icon icon-search"></i>搜索
                            <div class="ele-set">
                                <i class="delete icon-delete"></i>
                                <i class="drag-ele icon-drag"></i>
                            </div>
                        </li>
                        <li>
                            <i class="icon icon-search"></i>搜索
                            <div class="ele-set">
                                <i class="delete icon-delete"></i>
                                <i class="drag-ele icon-drag"></i>
                            </div>
                        </li>
                        <li>
                            <i class="icon icon-search"></i>搜索
                            <div class="ele-set">
                                <i class="delete icon-delete"></i>
                                <i class="drag-ele icon-drag"></i>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--右侧模板面板-->
<div class="template-section">
    <div class="tpl-first-navs">
        <span class="active">我的模板</span>
        <span>常用</span>
        <span>高级</span>
    </div>
    <div class="tpl-contents">
        <div class="tpl-content active">
            <div class="tpl-sec-navs">
                <span class="active">全部</span>
                <span>常用</span>
                <span>主页</span>
                <span>列表页</span>
                <span>图片页</span>
                <span>内容页</span>
                <span>表单页</span>
            </div>
            <ul class="tpl-container">
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
            </ul>
        </div>
        <div class="tpl-content">
            <ul class="tpl-container">
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
                <li>
                    <img src="http://img.weiye.me/zcimgdir/album/file_585748dbaf787.png">
                    <p>蛋糕</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="btn-wrap">
        <span class="tpl-btn">使用</span>
        <span class="tpl-btn cancel-btn">取消</span>
    </div>
</div>
<!--遮罩层-->
<div class="full-screen-mask" style="display: none;"></div>
</body>
<script>
    //左侧折叠
    $(document).ready(function(){
        $('body').on('click', '#group-page-container .group-page-nav .group-nav', function () {
            var target = $(this).parent();
            target.toggleClass('active');
            $(this).siblings(".page-navs").slideToggle();
        }).on('click', '#group-page-container .page-nav', function (event) {
            event.stopPropagation();
            var target = $(this).parent();
            $('.page-nav.active').removeClass('active');
            $(this).addClass('active');
            $(this).children('.page-navs-edit').addClass('curr').parent().siblings().children().removeClass('curr');
        }).on('click','.page-navs-edit .icon-edit', function(event){  //左侧编辑//左侧修改分组名称对话框显示
            event.stopPropagation();
            $(this).parent().siblings('.edit-group').show();
            $(this).parents('.page-nav').children('span:first-child').hide();
            $(this).parent('.page-navs-edit').css('display','none');

        }).on('click','.page-navs .page-nav .edit-group .cancel', function(event){  //左侧编辑//左侧修改分组名称对话框隐藏
            event.stopPropagation();
            $(this).parent('.edit-group').css('display','none');
            $(this).parents('.edit-group').siblings().show();
        }).on('click','.left-contents .operate-navs span',function(){
            $('.operate-navs span.active').removeClass('active');
            $(this).addClass('active');
            var target = $(this).parent().siblings(".nav-component");
            target.children().toggleClass('active');
        }).on('click','.template-section .tpl-first-navs span',function(){
            $('.tpl-first-navs span.active').removeClass('active');
            $(this).addClass('active');
            var target = $(this).parent().siblings(".tpl-contents");
            target.children().toggleClass('active');
        }).on('click','.operate-wrap span i.icon-template',function(event){ //右侧模板模块显示
            event.stopPropagation(); //停止事件冒泡
            $(".template-section").css({"right":"0","transition":"all .3s"});
            $(".full-screen-mask").show();
            $(".app-phone .phone-component .phone-container").addClass('toTopIndex');
            $('.right-contents .page-wrap').addClass('active');
        }).on('click','.full-screen-mask',function(){
            $('.full-screen-mask').hide();
            $(".template-section").css({"right":"-200%","transition":"all .3s"});
            $(".app-phone .phone-component .phone-container").removeClass('toTopIndex');
        }).on('click','.template-section .btn-wrap span.cancel-btn',function(){
            $('.full-screen-mask').hide();
            $(".template-section").css({"right":"-200%","transition":"all .3s"});
        }).on('click','.operate-wrap span i.icon-conponent',function(event){
            event.stopPropagation(); //停止事件冒泡
            $('.elements-setting').addClass('active');
        }).on('click','.elements-setting .page-property .widget-tree-title .close',function(event){
            event.stopPropagation();
            $('.elements-setting').removeClass('active');
        }).on('click','.right-contents .page-setting .setting-group-name',function(){
            $(this).toggleClass('active');
        }).on('click','.operate-wrap span i.icon-page',function(event){
            event.stopPropagation();
            $('.right-contents .page-wrap').addClass('active');
        }).on('click','.left-contents .nav-component .catalog-section span.addpage',function(event){
            event.stopPropagation();
            $('.add-page-dialog').addClass('active');
        }).on('click','.nav-component .add-page-dialog .cancel-btn',function(event){
            event.stopPropagation();
            $('.add-page-dialog').removeClass('active');
        }).on('click','.left-contents .nav-component .catalog-section span.addfolder',function(event){
            event.stopPropagation();
            $('.add-group-dialog').addClass('active');
        }).on('click','.nav-component .add-group-dialog .cancel-btn',function(event){
            event.stopPropagation();
            $('.add-group-dialog').removeClass('active');
        });
    });
</script>

</html>