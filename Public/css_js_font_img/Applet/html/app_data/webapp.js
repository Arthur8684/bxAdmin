/**
 * JS代码规范：
 *   JS代码分为三部分，如下
 *       1.AppComponent对象模块(封装应用相关的数据和操作)
 *       2.各个组件对象模块(封装各组件对应的操作函数，在AppComponent中实例化 用于处理对应的操作)
 *       3.功能函数模块(RT)
 *
 */
var APP, deliveryID;

$(function() {

  var ORIGINAL_PHONE_WIDTH = 320,
      ORIGINAL_PHONE_HEIGHT = 474, // 手机高度会根据屏幕大小做适配，所以不是固定值
      DEVICE_WIDTH = $('body').width(),
      DEVICE_HEIGHT = $('body').height(),
      appData = {},
      formData = {},
      ratio = 1, // 部分的值并没有跟着page-containter缩放，需乘以这个缩放值，比如$.scrollTop()的值
      appId = GetQueryString('_app_id'),
      tempPageData = {}, // 临时存储详情页的请求数据。如果将请求数据当参数传入相关函数成本太高，故用全局变量来保存
      // unLogin = true,
			cdnUrl = "http://cdn.jisuapp.cn/zhichi_frontend",
      DEFAULTPHOTO = cdnUrl + '/static/webapp/images/default_photo.png',
      DEFAULTIMAGE = cdnUrl + '/static/webapp/images/default.png',
      ua = navigator.userAgent.toLowerCase(),
      isAndroid = ua.indexOf('android') > -1 || ua.indexOf('linux') > -1,
      isWeixin = ua.match(/MicroMessenger/i) == 'micromessenger' ? true : false,
      notFirstPage = false,
      isbusinessTimeFirstPage = false,
      has_app_shop, // app内是否有多商家组件
      relObj, // 保存当前bbs／计数组件关联的对象，如果将关联对象的值当参数传入相关函数成本太高，故用全局变量来保存。基本值有 appId（与app关联）、router（与某页关联）和form_id（数据对象某一项数据）
      EleObjects = {
        'album': new AlbumEle(),
        'audio': new AudioEle(),
        'bbs': new BbsEle(),
        'bottom-nav': new BottomNavEle(),
        'breakline': new BreakLine(),
        'button': new ButtonEle(),
        'carousel': new CarouselEle(),
        'citylocation' : new CitylocationEle(),
        'classify': new ClassifyEle(),
        'sort': new SortEle(), //分类组件的升级版，排序组件

        'count-ele': new CountEle(),
        'community': new CommunityEle(),
        'dynamic-vessel': new DynamicVesselEle(),
        'form-vessel': new FormVesselEle(),
        'form-button': new ButtonEle(), // 表单按钮也是对应到按钮
        'free-vessel': new FreeVessel(),
        'goods-list': new GoodsListEle(),
        'grade-ele': new GradeComponentEle(),
        'hotspot': new Hotspot(),
        'input-ele': new InputEle(),
        'layout-vessel': new LayoutVesselEle(),
        'list': new ListEle(),
        'list-vessel': new ListVesselEle(),
        'map': new MapEle(),
        'pay-ele': new PayEle(),
        'picture': new PictureEle(),
        'select-ele': new SelectEle(),
        'static-vessel': new StaticVesselEle(),
        'text': new TextEle(),
        'textarea-ele': new TextareaEle(),
        'time-ele': new TimeEle(),
        'title-ele': new TitleEle(),
        'top-nav': new TopNavEle(),
        'upload-img': new UploadImgEle(),
        'user-center': new UserCenterEle(),
        'video': new VideoEle(),
        'search': new SearchEle(),
        'waimai':new WaiMaiEle(),
        'waimai-pay-ele':new WaiMaiPayEle(),
        'tostore-pay-ele':new TostorePayEle(),
        'group-pay-ele':new GroupPayEle(),
        'franchisee-list':new FranchiseeListEle(),
        'suspension': new Suspension(),
        'seckill': new Seckill()
      },
      OfficialPages = {
        'address-dialog': new AddressDialog(),
        'appointment-page': new AppointmentPage(),
        'citylocation-page': new CitylocationPage(),
        'comment-page': new CommentPage(),
        'coupon-list' : new CouponList(),
        'coupon-detail' : new CouponDetail(),
        'coupon-receive-list' : new CouponReceiveListPage(),
        'franchisee-detail' : new FranchiseeDetailPage(),
        'goods-detail': new GoodsDetailPage(),
        'preview-goods-order': new PreviewGoodsOrder(),
        'goods-additional-info': new GoodsAdditionalInfo(),
        'login-dialog': new LoginDialog(),
        'logistics-page': new LogisticsPage(),
        'make-comment': new MakeComment(),
        'my-address': new MyAddressPage(),
        'my-message': new MyMessagePage(),
        'my-order': new MyOrderPage(),
        'order-detail': new OrderDetailPage(),
        'tostore-order-detail': new TostoreOrderDetailPage(),
        'goods-order-detail': new GoodsOrderDetailPage(),
        'pay-page': new PayPage(),
        'shopping-cart': new ShoppingCartPage(),
        'user-center-page': new UserCenterPage(),
        'search-page': new SearchPage(),
        'community-page' : new communityPage(),
        'community-detail' : new communityDetail(),
        'community-publish' : new communityPublish(),
        'community-usercenter' : new communityUsercenter(),
        'community-notify' : new communityNotify(),
        'vip-card' : new VipCard(),
        'my-integral' : new MyIntegralPage(),
        'reset-location' : new ResetLocationPage(),
        'tostore-detail': new TostoreDetailPage(),
        'tostore-payment': new TostorePaymentPage(),
        'verification-code-page': new VerificationCodePage(),
        'tostore-complete': new TostoreCompletePage(),
        'balance': new BalancePage(),
        'recharge': new RechargePage(),
        'transfer-pay': new TransferPayPage(),
        'transfer-detail': new TransferDetailPage(),
        'goods-order-pay-success': new GoodsOrderPaySuccess(),
        'myGroup': new myGroupPage(),
        'groupOrderDetail': new groupOrderDetailPage(),
        'groupCenter': new groupCenterPage(),
        'groupRules': new groupRulesPage(),
        'luckyWheelDetail': new luckyWheelDetail(),
        'winningRecord':new winningRecord(),
      };

  ua = null;

  var AppComponent = function() {
    var me = this;

    me.OfficialPages = OfficialPages;
    // 初始化
    me.initial = function() {
      // 解决click事件在手机端延迟的现象
      FastClick.attach(document.body);

      me.getAppData();

      me.bindEvents();

      if (!isAndroid) {
          $('head').append('<style rel="stylesheet"> .page-container, .page .scroll-ele, .modal { overflow-scrolling:touch;-webkit-overflow-scrolling: touch;} </style>');
      }
      $('head').append('<style rel="stylesheet"> .page { min-height:' + window.innerHeight + 'px; } </style>');
    };

    // 获取app所有数据
    me.getAppData = function() {
      var history = GetQueryString('history_id'),
          param = {
                  app_id: appId,
                  from: GetQueryString('from') || ''
                };

      history && (param.history_id = history);
      $ajax('/index.php?r=AppData/detail', 'get', param, 'json', function(data) {
        if (data.status === 0) {
          var info = data.data,
              router = GetQueryString('router'),
              $body = $('body'),
              login = $body.attr('data-user-token'),
              _color = GetQueryString('style_color'); // PC端预览模版时，可能会传入style_color

          if (!info.app_data) {
            alertTip('您的应用没有内容哦');
            return;
          }
          // 判断是为了兼容早期没转换把数据转换为字符串的app
          appData = typeof info.app_data === 'string' ? JSON.parse(info.app_data) : info.app_data;
          formData = info.form_data;

          me.addGoodsRelevantData();
          $body.attr('data-name', info.app_name).find('#transferPay .transfer-store-name').text(info.app_name);
          _color && me.setStyleColor(_color);
          has_app_shop = info.has_app_shop;

          if (login) {
            me.setLogin({
              cover_thumb: $body.attr('data-cover'),
              nickname: $body.attr('data-nickname')
            });
          }

          if (appData.version == 1) {
            if (!router || +router.substring(4) < 10000) {
              router = appData.data['homepage-router'];
              window.history.replaceState(null, '', modifyTargetUrl({ router: router }));
            }
          } else {
            if (!router) {
              router = 'page10000';
              window.history.replaceState(null, '', modifyTargetUrl({ router: router }));
            }
          }
          me.turnToPage({ router: router });

          if (isWeixin) {
            // 设置微信分享
            asyLoadScript('http://res.wx.qq.com/open/js/jweixin-1.0.0.js', 'js', function() {
                configWxSDK();
                wx.ready(function() {
                    configWxShare(info);
                });
            });
            $('body').addClass('inweixin');
          } else {
            // 修改PC端预览的滚动条样式
            $('head').append('<style rel="sheetstyle">body::-webkit-scrollbar, div::-webkit-scrollbar, p::-webkit-scrollbar, textarea::-webkit-scrollbar, section::-webkit-scrollbar, ul::-webkit-scrollbar, iframe::-webkit-scrollbar { width:0px;height:0;}</style>');
          }
        } else {
          alertTip(data.data);
        }
      }, function(data) {
          alertTip(data.data);
      });
    }
    me.addGoodsRelevantData = function() {
      appData['goodsDetail'] = {
        router: 'goodsDetail',
        customFeature: {
          title: '商品详情',
          form: {
            url: 'AppShop/getGoods',
            success: OfficialPages['goods-detail'].modifyGoodsDetail
          }
        }
      };
      appData['previewGoodsOrder'] = {
        router: 'previewGoodsOrder',
        customFeature: {
          title: '商品购买',
          form: {
            url: 'AppShop/cartList',
            success: OfficialPages['preview-goods-order'].modifyPreviewInfo
          },
          needLogin: true
        }
      };

      appData['goodsOrderPaySuccess'] = {
        router: 'goodsOrderPaySuccess',
        customFeature: { 
          title: '支付成功',
          needLogin: true,
          needInit: true,
          initFun: OfficialPages['goods-order-pay-success'].initial
        }
      };

      appData['goodsAdditionalInfo'] = {
        router: 'goodsAdditionalInfo',
        customFeature: {
          title: '补充信息',
          form: {
            url:'pc/AppShop/GetDelivery',
            success: OfficialPages['goods-additional-info'].modifyGoodsAdditionalInfo
          }
        }
      };

      //到店
      appData['tostoreDetail'] = {
        router: 'tostoreDetail',
        customFeature: {
          title: '商品详情',
          form: {
            url: 'AppShop/getGoods',
            success: OfficialPages['tostore-detail'].modifyTostoreDetail
          }
        }
      };

      //到店确认支付
      appData['tostorePayment'] = {
        router: 'tostorePayment',
        customFeature: {
          title: '确认支付',
          form: {
            url: 'AppShop/cartList',
            success: OfficialPages['tostore-payment'].modifyTostorePayment
          },
          needLogin: true
        }
      };

      //到店完成订单
      appData['tostoreComplete'] = {
        router: 'tostoreComplete',
        customFeature: {
          title: '完成订单',
          form: {
            url: 'AppShop/getOrder',
            success: OfficialPages['tostore-complete'].modifyTostoreComplete
          },
          needLogin: true
        }
      };

      appData['shoppingCart'] = {
        router: 'shoppingCart',
        customFeature: {
          title:'购物车',
          form: {url: 'AppShop/cartList', success: OfficialPages['shopping-cart'].initialShoppingCart },
          needLogin: true
        }
      };

      appData['orderDetail'] = {
        router: 'orderDetail',
        customFeature: {
          title: '订单详情',
          form: { url: 'AppShop/getOrder', success: OfficialPages['order-detail'].modifyOrderDetail },
          needLogin: true
        }
      };

      appData['tostoreOrderDetail'] = {
        router: 'tostoreOrderDetail',
        customFeature: {
          title: '到店订单详情',
          form: { url: 'AppShop/getOrder', success: OfficialPages['tostore-order-detail'].modifyTostoreOrderDetail },
          needLogin: true
        }
      };

      appData['goodsOrderDetail'] = {
        router: 'goodsOrderDetail',
        customFeature: {
          title: '电商订单详情',
          form: { url: 'AppShop/getOrder', success: OfficialPages['goods-order-detail'].modifyGoodsOrderDetail },
          needLogin: true
        }
      };

      appData['myOrder'] = {
        router: 'myOrder',
        customFeature: {
          title: '我的订单',
          form: {
            url: 'AppShop/orderList',
            success: OfficialPages['my-order'].modifyOrderList
          },
          needLogin: true
        }
      };
      
      appData['payPage'] = {
        router: 'payPage',
        customFeature: {
          title: '支付',
          form: {
                url: 'AppShop/getOrder',
                success: OfficialPages['pay-page'].initial
          },
          needLogin: true
        }
      };

      appData['loginDialog'] = { router: 'loginDialog', customFeature: { title: '登录' } };

      appData['userCenterPage'] = { router: 'userCenterPage', customFeature: { title: '个人中心', form: { url: 'AppData/getUserInfo', para: null, success: OfficialPages['user-center-page'].parseEdit }, needLogin: true } };

      appData['bindPhonePage'] = { router: 'bindPhonePage', customFeature: { title: '绑定手机号', needLogin: true } };

      appData['myAddress'] = { router: 'myAddress', customFeature: { title: '收货地址', form: { url: 'AppShop/addressList', para: null, success: OfficialPages['my-address'].modifyMyAddress }, needLogin: true } };

      appData['logisticsPage'] = { router: 'logisticsPage', customFeature: { title: '物流信息', form: { url: 'AppShop/expressFlow', success: OfficialPages['logistics-page'].modifyLogisticsInfo } } };

      appData['commentPage'] = { router: 'commentPage', customFeature: { title: '商品评价', form: { url: 'AppShop/GetAssessList', success: OfficialPages['comment-page'].dealCommentData } } };

      appData['makeComment'] = { router: 'makeComment', customFeature: { title: '发表评价', form: { url: 'AppShop/getOrder', success: OfficialPages['make-comment'].initialGoodsComment }, needLogin: true } };

      appData['appointmentPage'] = { router: 'appointmentPage', customFeature: { title: '预约', form: { url: 'AppShop/getAppointmentList', success: OfficialPages['appointment-page'].initialAppointmentInfo } } };

      appData['searchPage'] = { router: 'searchPage', customFeature: { title: '搜索' } };

      appData['CitylocationPage'] = {
        router: 'CitylocationPage', 
        customFeature: {
          title:'城市定位',
          form:{
            url: 'Region/getRegionInfoByIPAddress',
            success: OfficialPages['citylocation-page'].local,
            para: {}
          }
        }
      };

      appData['vipCard'] = {
        router: 'vipCard',
        customFeature: {
          title: '会员卡',
          form: {
            url: 'AppShop/GetVIPInfo',
            success: OfficialPages['vip-card'].initialPageData,
            para: {
              app_id: appId,
              sub_shop_app_id: GetQueryString('franchisee'),
              is_all: 1
            }
          },
          needLogin: true
        }
      };

      appData['myMessage'] = {
        router: 'myMessage',
        customFeature: {
          title: '系统通知',
          form: {
            url: 'AppNotify/GetUserAppNotifyMsg',
            success: OfficialPages['my-message'].parseMyMessagePage,
            para: {
              app_id: appId
            }
          },
          needLogin: true
        }
      };

      appData['communityPage'] = { router: 'communityPage', customFeature: { title: '社区' , form: { url: 'AppSNS/GetSectionByPage' ,success: OfficialPages['community-page'].initialSection } } };
      appData['communityDetail'] = { router: 'communityDetail', customFeature: { title: '社区-详情', form: { url: 'AppSNS/GetArticleByPage' ,success: OfficialPages['community-detail'].initialDetail }} };
      appData['communityPublish'] = { router: 'communityPublish', customFeature: { title: '社区-发布话题' , needLogin: true , form: {url: 'AppSNS/GetCategoryByPage' , success: OfficialPages['community-publish'].initialPublish }} };
      appData['communityReply'] = { router: 'communityReply', customFeature: { title: '社区-回复' , needLogin: true} };
      appData['communityUsercenter'] = { router: 'communityUsercenter', customFeature: { title: '社区-个人中心', form: { url: 'AppSNS/GetArticleByPage' ,success: OfficialPages['community-usercenter'].initialUsercenter }, needLogin: true} };
      appData['communityNotify'] = { router: 'communityNotify', customFeature: { title: '社区-通知中心', form: { url: 'AppSNS/GetLikeLogByPage' ,success: OfficialPages['community-notify'].initialNotify }, needLogin: true} };

      appData['couponList'] = {
        router: 'couponList',
        customFeature: {
          title: '优惠券',
          form: {
            url: 'AppShop/getMyCoupons',
            success: OfficialPages['coupon-list'].initialPageData,
            para: {
              app_id:appId,
              sub_shop_app_id:GetQueryString('franchisee'),
              type: -1
            }
          },
          needLogin: true
        }
      };

      appData['couponDetail'] = {
        router: 'couponDetail',
        customFeature: {
          title: '优惠券详情',
          needInit: true,
          initFun: OfficialPages['coupon-detail'].initialPageData,
          needLogin: true
        }
      };

      appData['couponReceiveListPage'] = {
        router: 'couponReceiveListPage',
        customFeature: {
          title: '优惠券领取列表',
          form: {
            url: 'AppShop/getCoupons',
            success: OfficialPages['coupon-receive-list'].initial,
            para: {
              app_id: appId,
              in_show_list: 1,
              enable_status: 1,
              stock: 1,
              page: -1
            }
          },
          needLogin: true
        }
      };
      
      appData['myIntegral'] = {
        router: 'myIntegral',
        customFeature: {
          title: '个人积分',
          form: {
            url: 'AppShop/GetIntegralInfo',
            success: OfficialPages['my-integral'].initMyMessagePage,
            para: {
              app_id: appId
            }
          },
          needLogin: true
        }
      };

      appData['franchiseeDetail'] = {
        router: 'franchiseeDetail',
        customFeature: {
          title: '商家详情',
          form: {
            url: 'AppShop/GetAppShopByPage',
            success: OfficialPages['franchisee-detail'].modifyFranchiseeDetail,
          },
          needLogin: false
        }
      };

      appData['resetLocation'] = {
        router: 'resetLocation',
        customFeature: { title: '选择地址' }
      };

      appData['addressDialog'] = {
        router: 'addressDialog',
        customFeature: {
          title: '选择地址',
          form: {
            url: 'AppShop/addressList',
            success: OfficialPages['address-dialog'].modifyAddressList
          }
        }
      };

      appData['verificationCodePage'] = {
        router: 'verificationCodePage',
        customFeature: {
          title: '核销码',
          form: {
            url: 'AppShop/GetOrderVerifyCode',
            success: OfficialPages['verification-code-page'].initial
          }
        }
      };

      appData['balance'] = {
        router: 'balance',
        customFeature: {
          title: '储值金',
          form: {
            url: 'AppShop/getAppUserBalance',
            success: OfficialPages['balance'].initial,
            para: {
              app_id: appId
            }
          },
          needLogin: true
        }
      };

      appData['recharge'] = {
        router: 'recharge',
        customFeature: {
          title: '充值',
          form: {
            url: 'AppShop/getStoredItems',
            success: OfficialPages['recharge'].initial,
            para: {
              app_id: appId
            }
          },
          needLogin: true
        }
      };

      appData['transferPay'] = {
        router: 'transferPay',
        customFeature: {
          title: '充值',
          form: {
            url: 'AppShop/calculationPrice',
            success: OfficialPages['transfer-pay'].modifyTransferPay,
            para: {
              app_id: appId
            }
          },
          needLogin: true
        }
      };

      appData['transferDetail'] = {
        router: 'transferDetail',
        customFeature: {
          title: '充值',
          form: { url: 'AppShop/getOrder', success: OfficialPages['transfer-detail'].modifyOrderDetail },
          needLogin: true
        }
      };

      //我的拼团
      appData['myGroup'] = {
        router: 'myGroup',
        customFeature: {
          title: '我的拼团',
          form: {
            url: 'AppGroupBuy/MyGroupBuy',
            success: OfficialPages['myGroup'].modifyMyGroupList,
            para: {
              app_id: appId,
              is_leader_order : 1,
              current_status : 0,
              page : 1,
              page_size : 999
            }
          },
          needLogin: true
        }
      };
      //我的拼团订单详情
      appData['groupOrderDetail'] = {
        router: 'groupOrderDetail',
        customFeature: {
          title: '拼团详情',
          form: {
            url: 'AppGroupBuy/GetGroupBuyOrderInfo',
            success: OfficialPages['groupOrderDetail'].initialPage,
            para: {
              app_id: appId,
              order_id:GetQueryString('order_id')
            }
          },
          needLogin: true
        }
      };
      //我的拼团中心
      appData['groupCenter'] = {
        router: 'groupCenter',
        customFeature: {
          title: '拼团中心',
          form: {
            url: 'AppGroupBuy/GetGroupBuyGoodsList',
            success: OfficialPages['groupCenter'].modifyGroupCenterList,
            para: {
              app_id: appId,
              current_status : 2, //0:全部 1:已过期 2:进行中 3:未进行
              page : 1,
              page_size : 999
            }
          },
          needLogin: false
        }
      };
      //拼团规则
      appData['groupRules'] = { router: 'groupRules', customFeature: { title: '拼团规则' } };

    
      //大转盘
      appData['luckyWheelDetail']={
        router:'luckyWheelDetail',
        customFeature:{
          title:" ",
          needLogin:true ,
          form: {
            url: 'appLotteryActivity/getActivity',
            success: OfficialPages['luckyWheelDetail'].modifypromotionWheelDetail,
            para: {
              app_id: appId
            }
          }
        }
      };
     // 中奖记录
     appData['winningRecord']={
      router:'winningRecord',
      customFeature:{
        title:'中奖记录',
        form:{
         url:'appLotteryActivity/myPrizeCenter',
         success:OfficialPages['winningRecord'].modifypromotionWinningRecord,
        },
        needLogin:true
      }
     };
    };
        // 预览模版传入风格颜色时的处理
    me.setStyleColor = function(color) {
      for (var router in appData) {
        var eles = appData[router].eles;
        me.setStyleEles(eles, color);
      }
    };
    me.setStyleEles = function(eles, color) {
      eles && $(eles).each(function(index, ele) {
        switch (ele.type) {
          case 'top-nav':
          case 'bottom-nav':
          case 'button':
          case 'form-button':
              ele.style = ele.style || {};
              ele.style['background-color'] = color;
              break;
          case 'classify':
              ele.customFeature = ele.customFeature || {};
              ele.customFeature['selectedColor'] = color;
              break;
          case 'sort':
              ele.customFeature = ele.customFeature || {};
              ele.customFeature['selectedColor'] = color;
              break;
          case 'breakline':
              ele.style = ele.style || {};
              ele.style['border-color'] = color;
              break;
          case 'title-ele':
              ele.customFeature = ele.customFeature || {};
              ele.customFeature['markColor'] = color;
              break;
          case 'static-vessel':
          case 'free-vessel':
          case 'list-vessel':
          case 'dynamic-vessel':
          case 'form-vessel':
              me.setStyleEles(ele.content, color);
              break;
          case 'layout-vessel':
              me.setStyleEles(ele.content.leftEles, color);
              me.setStyleEles(ele.content.rightEles, color);
              break;
        }
      });
    };
    /**
     * 跳转页面
     * @param  {object} para 包含字段router、detail(detail详情页时才有)
     */
    me.turnToPage = function(para, refresh) {
      var router = para.router,
          url, needLogin;

      if (!router || !appData[router]) {
        if (notFirstPage) {
          alertTip('跳转的页面不存在');
          return;
        } else {
          router = para.router = appData.data['homepage-router'];
          url = modifyTargetUrl(para);
          window.history.replaceState(null, '', url);
        }
      }

      me.beforeChangePage();

      needLogin = appData[router].customFeature.needLogin;
      if (needLogin && needLogin !== 'false' && !me.checkIfLogin()) {
        notFirstPage = true; // 一旦需要登录 则跳转登录页
        me.goLogin();
        return;
      }
      if (notFirstPage) { // 当前页面不是第一个页面
        var redirect = para.redirect;
        para.redirect = '';
        url = modifyTargetUrl(para);
        isbusinessTimeFirstPage = true;
        //console.log(url);
        redirect ? window.history.replaceState(null, '', url) : window.history.pushState(null, '', url);
      } else {
        if (navigator.userAgent.match(/QQ\//g)) {
          // qq内置浏览器进入应用时激活回退按钮
          window.location.hash = 'qq';
        }
        // 扫描二维码到店
        if(GetQueryString('location_id')){
          $('#tostorePayment .location-specialId').attr('data-locationId',GetQueryString('location_id'));
          $('#tostorePayment .location-specialId input').prop('checked',true);
        }else{
          $('#tostorePayment .location-specialId').hide();
        }
      }
      notFirstPage = true;
      refresh ? me.refreshPage(router) : me.showPage(router);
    };
    // 回退键返回页面
    me.backToPage = function(router){
      me.beforeChangePage();
      me.showPage(router);
    };
    // 跳转页面前做一些处理：隐藏弹出窗、关闭音频之类
    me.beforeChangePage = function() {
      var $page = $('.page.zShow');

      clearInterval(OfficialPages['pay-page'].timer); //清除支付请求轮询
      // 关闭当前页音频
      $page.attr('scroll', $(window).scrollTop()).find('audio').each(function(index, audio) {
        if (audio.src) {
          audio.src = '';
          $(audio).siblings('.audio-pause-thumb').css('display', 'inline').siblings('.audio-play-thumb').css('display', 'none');
        }
      });
      // 关闭登陆窗、支付窗
      // $('#loginDialog, #payDialog').css('display', 'none');
      $('#payDialog').css('display', 'none');
      // 关闭全屏地图
      $('.map-container').css('display', 'none');
      // 关闭商品购买的弹窗
      $('#tostorePayDialog').css('display', 'none');
      // 关闭日期插件弹窗
      laydate && laydate.close();
    };
    // 展示页面
    me.showPage = function(router, notReloadPage) {
      $('#' + router).attr('refresh', 0);
      me.parsePage({
        router: router,
        notReloadPage: notReloadPage
      });
    };
    // 刷新页面
    me.refreshPage = function(router) {
      $('#' + router).attr('refresh', 1);
      me.parsePage({
        router: router,
        refresh: true
      });
    };

    /*
     *  解析页面
     */
    me.parsePage = function(option) {
      var router = option.router,
          refresh = option.refresh,
          notReloadPage = option.notReloadPage,
          pageData = appData[router] || {},
          eles = $.extend(true, [], pageData.eles || []),
          pageCustomFeature = pageData.customFeature || {},
          $targetPage = $('#' + router),
          $pageContainer, // 弹出窗页和非弹出窗页是有不同的容器
          ifDialog = pageCustomFeature.ifDialog,
          ifLoaded = refresh ? false : $targetPage.length;

      if (ifDialog && ifDialog !== 'false') {
        $pageContainer = $('#dialog-page-container').css('display', 'block');
        fixbody();
      } else {
        // 该页面不是弹出框时
        relievebody();
        // dealNavs(router);
        $pageContainer = $('#page-container');

        // 隐藏dialog页面
        $('.page.zShow, .dialog-page.zShow').removeClass('zShow');
        $('#dialog-page-container').css('display', 'none');

        if (isWeixin) {
          // 微信下需执行以下代码才能更改页面标题
          var $iframe = $('<iframe src="/favicon.ico" height="0" width="0" style="visibility:hidden;opacity:0;border:none;margin:0;"></iframe>');
          $iframe.on('load', function() {
            setTimeout(function() {
              $iframe.off('load').remove();
              $iframe = null;
            }, 0);
          }).appendTo('body');
          setTimeout(function() {
            $iframe && $iframe.off('load').remove();
          }, 5000);
        }
        document.title = pageCustomFeature.title;

        var pageStyle = {};
        pageCustomFeature['background-color'] && (pageStyle['background-color'] = pageCustomFeature['background-color']);
        pageCustomFeature['background-image'] && (pageStyle['background-image'] = pageCustomFeature['background-image']);
        $('html, body').attr('style', '').css(pageStyle);
      }

      if (ifLoaded) {
        // 当页面已编译时
        $targetPage.addClass('zShow');
        $(window).scrollTop($targetPage.attr('scroll') || 0);
      } else {
        relObj = router;

        $targetPage = refresh ? $('#' + router).addClass('zShow') : $('<div id="' + router + '" class="page zShow" data-router="' + router + '"></div>');
        // 页面没有绑定数据对象
        if (!pageCustomFeature.form) {
          tempPageData = {};
          me.dealPageData($targetPage, eles, router, null, $pageContainer);
        }
        if (ifDialog && ifDialog !== 'false') {
          var _opacity = pageCustomFeature.opacity != undefined ? 'style="opacity:' + pageCustomFeature.opacity + '"' : '';

          $targetPage.addClass('dialog-page').css({
              height: DEVICE_HEIGHT + 'px'
          }).prepend('<div class="shadow" ' + _opacity + '></div>');
        }
        $(window).scrollTop(0);
      }

      if (pageCustomFeature.form && !notReloadPage) {
        // 为详情页时都必须重新请求数据并重新渲染页面
        var detail_id = GetQueryString('detail');

        if (detail_id) {
          relObj = pageCustomFeature.form + '_' + detail_id;
        } // 个人中心和收货地址页 不需要传参
        me.getFormSingleData(detail_id, $targetPage, eles, router, pageCustomFeature.form, $pageContainer);
      }
      if (pageCustomFeature.needInit && $.isFunction(pageCustomFeature.initFun)) {
        // 没有pageCustomFeature.form但需要初始化的OfficialPages(暂时只有电商订单支付成功页)
        pageCustomFeature.initFun();
      }
    };
    // 获取动态页的数据
    me.getFormSingleData = function(id, $page, eles, router, form, $pageContainer) {
      var action, para;

      if (form.url) {
        // 系统自带页面：商品详情页、订单详情页、购物车页面等
        action = form.url;
        para = form.para;

        switch (router) {
          case 'tostoreDetail':
              para = { app_id: appId, data_id: id, sub_shop_app_id: GetQueryString('franchisee')};
              break;
          case 'goodsDetail':
              para = { app_id: appId, data_id: id, sub_shop_app_id: GetQueryString('franchisee'), is_seckill: GetQueryString('goodsType') == 'seckill' ? 1 : ''};
              break;
          case 'franchiseeDetail':
              para = { app_id: appId, sub_shop_app_id: id };
              break;
          case 'shoppingCart':
          case 'tostorePayment':
          case 'previewGoodsOrder':
              para = { page:1, page_size:20, ck_id: GetCookiePara(), app_id: appId, sub_shop_app_id: GetQueryString('franchisee'), parent_shop_app_id: GetQueryString('franchisee') ? appId : '' };
              break;
          case 'goodsAdditionalInfo':
              para = { app_id: appId,delivery_ids: GetQueryString('additionalArr') ? GetQueryString('additionalArr').split(',') : ''};
              break;
          case 'myOrder':
              para = { page: 1, page_size: 20, app_id: appId, ck_id: GetCookiePara(),
                // sub_shop_app_id: GetQueryString('franchisee'),
                parent_shop_app_id: has_app_shop == 1 ? appId : '',
                use_default_goods_type: 1 // 进入myOrder页面 第一次请求时传入 use_default_goods_type 参数
              };
              break;
          case 'appointmentPage':
              para = { app_id: appId, goods_id: id, sub_shop_app_id:GetQueryString('franchisee')};
              break;
          case 'commentPage':
              para = { app_id: appId, goods_id: id, idx_arr: { idx: 'level', idx_value: 0 }, page: 1, page_size: 20, sub_shop_app_id: GetQueryString('franchisee') };
              break;
          case 'logisticsPage':
          case 'makeComment':
          case 'orderDetail':
          case 'tostoreOrderDetail':
          case 'goodsOrderDetail':
          case 'transferDetail':
          case 'tostoreComplete':
          case 'payPage':
              para = { order_id: id,app_id: appId, sub_shop_app_id:GetQueryString('franchisee') };
              break;
          case 'communityPage' :
              para = {app_id:appId, section_id :id};
              break;
          case 'communityDetail' :
              para = {app_id:appId, article_id :id};
              break;
          case 'communityUsercenter' :
              para = {app_id:appId, section_id :id , only_own_record : 1 , page : 1 };
              break;
          case 'communityPublish' :
              para = { app_id:appId, section_id :id , page : 1 , page_size: 100 };
          case 'communityNotify' :
              para = { app_id:appId, section_id :id ,  only_receiver_record : 1 , page : 1 };
              break;
          case 'verificationCodePage' :
              para = { app_id: appId, order_id: id , sub_shop_app_id: GetQueryString('franchisee')};
              break;
          case 'groupOrderDetail' :
            para = { app_id: appId, order_id: GetQueryString('order_id')};
            break;
          case 'luckyWheelDetail' :
            para = { app_id: appId,category:0};
            break ;
          case 'winningRecord':
            para = { app_id: appId, category: 1,page:1,page_size:999};
            break ; 
        }
      } else {
        action = 'AppData/getFormData';
        para = {
          app_id: appId,
          data_id: id,
          form: form
        };
        $page.empty();
      }

      $ajax('/index.php?r=' + action, 'get', para, 'json', function(data) {
        if (data.status === 0) {
          var targetData;
          targetData = data;
          tempPageData = targetData;
          me.dealPageData($page, eles, router, targetData, $pageContainer, form);
        } else if (data.status === 2) {
          alertTip('请先登录账号', function() {
            me.showLogin();
          }, 700);

        } else {
          alertTip('请求数据失败，' + data.data);
        }
      }, function() {
        alertTip('请求数据失败，请重试');
      });
    };

    me.dealPageData = function($page, eles, router, data, $pageContainer, form) {
      var element, bottomNav, topNav;
      $(eles).each(function(index, ele) {
        // if(ele.customFeature && ele.customFeature.segment){
        // 	ele.content = data.data[0].form_data[ele.customFeature.segment];
        // }
        $page.append((element = me.parseElement(ele)));
      });

      if (form && $.isFunction(form.success)) {
        form.success(data);
      } else {
        $pageContainer.append($page);
        topNav = $page.find('.top-nav');
        bottomNav = $page.find('.bottom-nav');
        $page.css({
          'padding-top': topNav ? topNav.height() : 0,
          'padding-bottom': bottomNav ? (bottomNav.height() + parseInt(bottomNav.css('padding-top')) + parseInt(bottomNav.css('padding-bottom'))) : 0
        });
      }

      me.initialCarousel(router);
      me.initialMap(router);
    };
    me.parseElement = function(ele, dynamicData, ifFreePattern) {
      var type = ele.type,
          $targetEle, firstAni, ifAddWrap;

      // 如果传入数据dynamicData 则优先使用，否则判断当前页是否请求了数据tempPageData 表单组件不用进行判断
      if (['input-ele','textarea-ele','grade-ele','select-ele','upload-img','time-ele','form-button'].indexOf(type) < 0) {
        if (dynamicData && ele.customFeature && ele.customFeature.segment) {
          if(ele.customFeature.segment == 'default_map'){
            var form_data = dynamicData.form_data;
            ele.content = (form_data.region_string || '') + (form_data.region_detail || '');
          }else{
            ele.content = dynamicData.form_data[ele.customFeature.segment];
          }
        } else if (tempPageData.data && tempPageData.data.length && ele.customFeature && ele.customFeature.segment) {
          if(ele.customFeature.segment == 'default_map'){ //绑定了地图字段
            var form_data = tempPageData.data[0].form_data;
            ele.form_data = form_data;
            ele.content = (form_data.region_string || '') + (form_data.region_detail || '');
          }else{
            ele.content = tempPageData.data[0].form_data[ele.customFeature.segment];
          }
        }
      }
      // 解析计数组件时 如果数据没有relValue 则不是需要的数据 不能传入组件
      if (type === 'count-ele' && dynamicData && !dynamicData.relValue) {
        dynamicData = null;
      }

      $targetEle = EleObjects[ele.type].parseElement(ele, dynamicData);

      if (!$targetEle) {
        return '';
      }
      ifAddWrap = !(ifFreePattern || type === 'hotspot' || type === 'bottom-nav' || type === 'top-nav' || type === 'suspension');
      switch (type) {
        case 'list-vessel':
        case 'dynamic-vessel':
            break;
        case 'audio':
        case 'waimai':
            break;
        default:
            // 设置组件样式
            var style = ele.style || {};
            if (style && style['background-image']) {
              if (style['background-image'].indexOf('url(') < 0) {
                style['background-image'] = 'url(' + style['background-image'] + ')';
              }
            }
            if(style && style.bottom){
              style.bottom = style.bottom + 'px';
            }
            $targetEle.css(style);
            break;
      }
      if (ele.animations && ele.animations.length) {
        firstAni = ele.animations[0];
        $targetEle.attr({
          'animations': JSON.stringify(ele.animations),
          'ani-index': 0
        })
        .css({
          '-webkit-animation-duration': firstAni.duration + 's',
          'animation-duration': firstAni.duration + 's',
          '-webkit-animation-delay': firstAni.delay + 's',
          'animation-delay': firstAni.delay + 's',
          '-webkit-animation-iteration-count': firstAni.count,
          'animation-iteration-count': firstAni.count
        })
        .addClass('animateEle ' + firstAni.name + firstAni.direction);
      }

      if (ifAddWrap) {
        $targetEle = $('<div class="ele-container"></div>').append($targetEle);
      }

      return $targetEle;
    };

    me.bindEvents = function() {

      $(window).on('popstate', function() {
        if (notFirstPage) {
          // me.hideLogin();
          me.backToPage(GetQueryString('router'));
        }

      }).on('scroll', function(event) {
        // 页面滚动加载
        // 一个页面有两个高度自适应的动态列表（bbs也算）时，只处理最后一个，因为设计本来就认为只有一个动态列表是高度自适应，并且放置于页面的最后
        var $target = $('.page.zShow .js-scroll-loading-ele');
        $target = $target.eq($target.length - 1);
        
        var $container = $target.find('.js-list-container');

        if ($container.length === 0 || $container.hasClass('js-no-more') || $container.hasClass('js-requesting')) {
          return;
        }

        var bodyH = document.body.scrollHeight,
            scrollTop = document.body.scrollTop,
            // screenH = window.screen.height,
            screenH = window.screen.availHeight,
            ifRequest = bodyH - (screenH + scrollTop) < 50;

        if (ifRequest) {
          $container.addClass('js-requesting');
          if($target.attr('data-page')){
            OfficialPages[$target.attr('data-page')].getListData($container);
          } else {
            var type = $target.attr('data-type');
            EleObjects[type].getListData($container);
          }
        }
      });

      $('body').on('click', '.js-count-ele', function(event) {
        event.preventDefault();
        event.stopPropagation();
        /* Act on the event */
        if (!$(this).hasClass('js-posting')) {
            EleObjects['count-ele'].addCount($(this));
        }
      }).on('click', '.router', function(event) {
        // 切换页面 router类为触发页面切换的元素标识，元素的data-router属性为切换到页面的路由
        event.preventDefault();
        event.stopPropagation();

        var router = $(this).attr('data-router'),
            para = {}, refresh,
            router_from =$(this).attr("data-from"),
            eleAttrs = this.attributes;

        for (var i = 0; i < eleAttrs.length; i++) {
          var attrName = eleAttrs[i].name;
          if(attrName.substring(0, 12) == 'data-router-') {
            para[attrName.substring(12)] = eleAttrs[i].value;
          }
        }

        if(router == 'appHomepage'){
          router = me.getHomepageRouter();
          para.goodsType = '';
          para.detail = '';
          para.hidestock = '';
        }else if(router == "seckillDetail"){
          router = 'goodsDetail';
          para.goodsType = 'seckill';
        }

        if (router.indexOf('http') === 0) {
          window.location.href = router;
          return;
        }
        if (router === 'prePage') {
          window.history.back();
        } else {
          para.router = router;

            //优惠券Id
          if(router=='couponDetail'){
          	para.sub_id = $(this).attr("data-appId") || appId;
          }else if(router == 'transferPay'){
            refresh = true;
          }
          if ($(this).hasClass('js-to-detail')) {
            // 跳转进动态页时 要传入对应项的id
            para.detail = $(this).attr('data-id');

            // 在商家详情页内点击商品列表跳转时需要传入分店id
            if($(this).attr('franchisee-id')){
              para.franchisee = $(this).attr('franchisee-id');
              para.cart_num = $(this).attr('cart-num');
            }
          }
          me.turnToPage(para, refresh);
          //  window.location.hash = hash;
        }

      }).on('click', '.refresh', function(event) {
        event.preventDefault();
        /* Act on the event */
        var $refresh = $(this),
            type = $refresh.attr('data-type');
        switch (type) {
          case 'page':
              // 刷新页面
              window.location.reload();
              break;
          case 'list':
              // 刷新动态列表组件
              var id = $refresh.attr('data-target'),
                  $list = $('.list-vessel-wrap[data-id="' + id + '"]').eq(0),
                  index_segment = $refresh.attr('data-index'),
                  index_value = $refresh.attr('data-value'),
                  sortKey = $refresh.attr('data-sortkey'),
                  sortBy = $refresh.attr('data-order');
              if ($list.find('.js-list-container').removeClass('js-no-more').hasClass('js-requesting')) {
                  return;
              }
              $list.data('sortkey',sortKey);
              $list.data('sortby',sortBy);

              EleObjects[$list.attr('data-type')].refresh($list, index_segment, index_value, sortKey, sortBy);
              break;
        }
      }).on('click','.to-promotion',function(){
        confirmTip({content: 'webapp推广功能暂未开启，请打包小程序进行操作'});
       
      }).on('click', '.shadow', function(event) {
        // 弹出层页面的阴影
        var $container = $(this).parent();
        if ($container.hasClass('dialog-page')) {
          window.history.back();
        } else {
          $container.removeClass('zShow');
        }
      }).on('focus', '.bbs textarea', function(event) {
        // bbs输入框获得焦点时
        var $bbs = $(this).parent().parent();
        if (!$bbs.hasClass('focus-box')) {
            $bbs.addClass('focus-box');
        }
      }).on('click', '.bbs .upload-wrap', function(event) {
        // bbs上传图片按钮
        var _this = $(this);
        _this.imgUpload(function(url) {
            _this.attr('img_url', url).find('img').attr('src', url);
            _this.children('.delete-img').show();
        });
      }).on('click', '.bbs .delete-img', function(event) {
        // bbs删除图片
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().attr('img_url', '').find('img').attr('src', '');
        $(this).hide();
      }).on('click', '.bbs .comment-btn', function(event) {
        // bbs评论
        event.preventDefault();
        event.stopPropagation();
        /* Act on the event */
        if (!me.checkIfLogin()) {
          // if(confirm('发表评论需要登录，您是否要去登录？')){
          me.goLogin();
          // }
        } else {
          EleObjects['bbs'].addComment($(this));
        };
      }).on('click', '.upload-text', function(event) {
        $(this).parent().find('.img-upload-input').trigger('click');
      }).on('click', '.bbs .comment-reply-btn', function(event) {
        event.preventDefault();
        event.stopPropagation();
        /* Act on the event */
        if (!me.checkIfLogin()) {
            // if(confirm('回复评论需要登录，您是否要去登录？')){
            me.goLogin();
            // }
        } else {
            EleObjects['bbs'].setReply($(this).closest('li'));
        };
      }).on('focus', '.dialog-page input, .dialog-page textarea', function(event) {
        if (isAndroid && isWeixin) {
          // 在安卓的微信下 输入框唤起键盘时输入框会被键盘挡住
          var $this = $(this);
          setTimeout(function() {
            var scroll = $this.offset().top - 60;
            window.scrollTo(0, scroll);
            $this = null;
          }, 300);
        }
      }).on('focusout', '.dialog-page input, .dialog-page textarea', function(event) {
        // if( $(this).closest('.dialog-page').length > 0 ){
        // 弹出页是禁止滚动的，所以输入框失去焦点时不会滚回原来的位置
        window.scrollTo(0, 0);
        // };
      }).on('webkitAnimationEnd', '.animateEle', function() {
        var ele = $(this),
            animations = ele.attr('animations'),
            preAniIndex = ele.attr('ani-index') || 0,
            nextAni;

        animations = JSON.parse(animations);

        if (animations[preAniIndex].name.indexOf('disappear') >= 0) {
          ele.css('display', 'none');
        }
        ele.removeClass(animations[preAniIndex].name + animations[preAniIndex].direction);

        nextAni = animations[+preAniIndex + 1];
        if (!nextAni) {
          ele.attr('ani-index', 0);
          return;
        }

        ele.attr('ani-index', +preAniIndex + 1)
          .css({
              '-webkit-animation-duration': nextAni.duration + 's',
              'animation-duration': nextAni.duration + 's',
              '-webkit-animation-delay': nextAni.delay + 's',
              'animation-delay': nextAni.delay + 's',
              '-webkit-animation-iteration-count': nextAni.count,
              'animation-iteration-count': nextAni.count
          });
        if (nextAni.name.substring(0, 6) == 'appear') {
          ele.css('display', 'none').addClass(nextAni.name + nextAni.direction);
          ele.css('display', 'block');
        } else {
          ele.addClass(nextAni.name + nextAni.direction);
        }

      }).on('click', '.video-iframe-mask', function() {
        $('.full-screen-iframe').css({
          display: '-webkit-box',
          // width: DEVICE_WIDTH,
          // height: DEVICE_HEIGHT
        }).find('iframe').attr('src', $(this).siblings('iframe').attr('src'));

      }).on('click', '.video-close', function() {
        $('.full-screen-iframe').css('display', 'none').find('iframe').remove();
        $('.full-screen-iframe').prepend('<iframe frameborder="0"></iframe>');

      }).on('click', '#goodsDetail .make-appointment', function(e) {
        // 预约
        APP.turnToPage({
          router: 'appointmentPage',
          detail: GetQueryString('detail')
        });

      }).on('click', '#goodsDetail .add-to-shoppingcart', function(e) {
        // 添加到购物车
        var goodsInfo = tempPageData.data[0].form_data;
        if(goodsInfo.is_seckill == 1 && goodsInfo.seckill_start_state == 2){
          alertTip("当前秒杀已结束，不能加入购物车");
          return ;
        }
        EleObjects['pay-ele'].showPayDialog('shoppingcart', tempPageData);

      }).on('click', '#goodsDetail .buy-goods-directly', function(e) {
        // 立即购买
        var goodsInfo = tempPageData.data[0].form_data;
        if(goodsInfo.is_seckill == 1 && goodsInfo.seckill_start_state != 1){
          alertTip("当前秒杀商品不在秒杀时间范围内，不能立即购买");
          return ;
        }
        EleObjects['pay-ele'].showPayDialog('buydirectly', tempPageData);

      }).on('click', "#goodsDetail .open-group", function(e) {
        // 打开开团弹窗
        EleObjects['group-pay-ele'].showPayDialog();
        EleObjects['group-pay-ele'].initialData(tempPageData);
      }).on('click', "#goodsDetail .join-group-btn", function(e) {
        // 打开参团弹窗
        EleObjects['group-pay-ele'].showPartPayDialog();
        EleObjects['group-pay-ele'].initialData(tempPageData);
        $('#joinGroup').data('token',$(this).data('token'));
        $('#groupPayDialog').find('.pills-list i').text($(this).data('num'));
      }).on('click', '#groupPayDialog .pay-close-dialog', function(e) {
        // 关闭开团弹团
        EleObjects['group-pay-ele'].closePayDialog();
      }).on('click', "#openGroup", function(e) {
        // 开团按钮
        EleObjects['group-pay-ele'].openGroup();
      }).on('click', "#joinGroup", function(e) {
        // 参团按钮
        EleObjects['group-pay-ele'].joinGroup($(this).data('token'));
      }).on('click', '#payDialog .pay-buy-next', function() {
        // 立即支付--下一步
        EleObjects['pay-ele'].payNextStep();

      }).on('click', '#tostorePayDialog .pay-add-to-shoppingcart', function() {
        // 到店支付框里"加入购物车"
        EleObjects['tostore-pay-ele'].addToShoppingCart();

      }).on('click', '#tostorePayDialog .pay-close-dialog', function() {
        // 关闭支付弹出框
        EleObjects['tostore-pay-ele'].closePayDialog();

      }).on('click', '#payDialog .pay-add-to-shoppingcart', function() {
        // 支付框里"加入购物车"
        EleObjects['pay-ele'].addToShoppingCart();

      }).on('click', '#payDialog .pay-close-dialog', function() {
        // 关闭支付弹出框
        EleObjects['pay-ele'].closePayDialog();

      }).on('click', '.shoppingCart-dialog-close', function() {
        // 关闭购物车弹框
        var $payDialog = $('.shoppingCart-pay-dialog');

        $payDialog.find('.page-bottom-content').slideUp(400, function() {
          $payDialog.css('display', 'none');
        });

      }).on('click', '.modal-backdrop', function() {
        // 关闭确认弹出框
        $(this).remove();
        $('#confirmModal').css('display', 'none').removeClass('in');

      }).on('click', '.close-bar', function() {
        $('body').removeClass('width-marketing-bar');

      }).on('click', '#myGroup .tabs .content', function() {
        $(this).addClass('active-tab').siblings().removeClass('active-tab');
        OfficialPages['myGroup'].switchGroupType($(this).data('type'));

      }).on('click', '#myGroup .sub-tabs .status', function() {
        $(this).addClass('active-sub-tab').siblings().removeClass('active-sub-tab');
        OfficialPages['myGroup'].switchGroupStatus($(this).data('status'));

      }).on('click', '#myGroup .goods-wrap', function() {
        var order_id = $(this).data('id');
        me.turnToPage({
          router: 'groupOrderDetail',
          order_id: order_id
        },true)

      }).on('click', '.once-more', function() {
        var id = $(this).data('id');
        me.turnToPage({
          router: 'goodsDetail',
          detail: id
        })

      }).on('click', '.see-order', function() {
        me.turnToPage({
          router: 'myOrder',
        })

      }).on('click', '.see-order', function() {
        me.turnToPage({
          router: 'myOrder',
        })

      }).on('click', '.map, .franchisee-address, .freight-loation-name, .preview-goods-store-name', function() {
        // 点击地图组件 和 商家详情页面地址 和 订单详情商家地址 和 previewGoodsOrder电商结算页商家地址
        if (isWeixin) {
          var data = { lat: $(this).attr('lat'), lng: $(this).attr('lng'), address: $(this).attr('address') };
            OpenWeixinMap(data);
        } else {
          if($(this).attr('lat')){
            var classArr = $(this).attr('class').split(' ');
            for(var i = 0; i < classArr.length; i++){
              switch(classArr[i]){
                case 'map':
                case 'franchisee-address':
                case 'freight-loation-name':
                case 'preview-goods-store-name':
                    me.setPhoneMap($(this)).showMap();
                    break;
              }
            }
          }
        }
      }).on('click', '.map-close', function() {
        me.closeMap();
      }).on('click', '.waimai-container-wrap .waimai-count-plus', function(event) {
        event.stopPropagation();
        EleObjects['waimai'].addGoods(event)
      }).on('click', '.waimai-container-wrap .waimai-count-minus', function(event) {
        event.stopPropagation();
        EleObjects['waimai'].deleteGoods(event);
      }).on('click', '.waimai-img', function(event) {
        event.stopPropagation();
        EleObjects['waimai'].previewTakeoutInfo(event);
      }).on('click', '.shoppingcart-total-money', function(){
        event.stopPropagation();
        EleObjects['waimai'].showCartsList(event);
      }).on('click', '.takeoutCartList', function(event) {
        // 弹出层购物车列表弹窗，阻止事件冒泡
        event.stopPropagation();
      }).on('click', '.takeout-pop-close', function(event) {
        event.stopPropagation();
        EleObjects['waimai'].hideTakeoutPop(event);
      }).on('click', '.takeoutModelDiv span', function(event) {
        event.stopPropagation();
        EleObjects['waimai'].chooseModel(event);
      }).on('click', '.sure-choose', function(event) {
        event.stopPropagation();
        EleObjects['waimai'].sureChooseModel(event);
      }).on('click', '.cartListPop', function(event) {
        // 弹出层购物车列表弹窗，点击蒙层隐藏
        $(this).hide();
      }).on('click', '.cartReduce', function(event) {
        event.stopPropagation();
        EleObjects['waimai'].cartReduce(event);
      }).on('click', '.cartPlus', function(event) {
        event.stopPropagation();
        EleObjects['waimai'].cartPlus(event);
      }).on('click', '.goods-picture', function(event) {
        $(event.currentTarget).hide();
      }).on('click','#winningRecord .record-tab-list>li',function(){
        $(this).addClass('active').siblings().removeClass('active');
         OfficialPages['winningRecord'].myPrizeCenter($(this).data('category'));
      })
    };

    me.initialCarousel = function(router) {
      var $carousels = $('#' + router + ' .slick-carousel');

      if (router === 'goodsDetail' || router === 'franchiseeDetail') {
        $carousels.css('height', $carousels.width());
      }
      $carousels.length && $($carousels).each(function(index, el) {
        var autoplay = $(el).attr('data-auto-play'),
            interval = +$(el).attr('data-interval'),
            id = $(el).attr('data-id'),
            param = {
              arrows: false,
              autoplay: autoplay === 'true' ? true : false,
              autoplaySpeed: interval,
              dots: true,
              mobileFirst: true,
              speed: 500,
              swipeToSlide: true
            };

        $(el).slick(param);
      });
    };
    me.initialMap = function(router) {
      var $maps = $('#' + router + ' .map');

      $maps.length && $maps.each(function(index, el) {
        EleObjects['map'].initMap(el); //嵌入地图初始化
      });
      $maps.length && me.initMap(); //地图弹窗初始化
    };
    // 去登录
    me.goLogin = function() {
      alertTip('请先登录账号', function() {
        me.showLogin();
      }, 700);
    };
    // 检测是否已登录
    me.checkIfLogin = function() {
      return OfficialPages['login-dialog'].checkIfLogin();
    };
    // 设置登录状态
    me.setLogin = function(data) {
      if (data) {
        EleObjects['user-center'].setLogin(data);
        $('body').attr('data-nickname', data.nickname);
        $('body').attr('data-cover', data.cover_thumb);
      }
      OfficialPages['login-dialog'].setLogin();
      return me;
    };
    // 隐藏登录框
    me.hideLogin = function() {
      OfficialPages['login-dialog'].hideLogin();
      return me;
    };
    // 展示登录框
    me.showLogin = function() {
      OfficialPages['login-dialog'].showLogin();
      return me;
    };
    // 获取购物车内容
    me.getShoppingCartData = function() {
      OfficialPages['shopping-cart'].getShoppingCartData();
      return me;
    };
    // 关闭地址框
    // me.closeAddressDialog = function() {
    //   OfficialPages['address-dialog'].closeAddressDialog();
    //   return me;
    // }
        // 打开地址栏
    // me.showAddressDialog = function() {
    //   OfficialPages['address-dialog'].showAddressDialog();
    //   return me;
    // }
        // 编辑地址列表
    // me.modifyAddressList = function(para) {
    //   OfficialPages['address-dialog'].modifyAddressList(para);
    //   return me;
    // };
    //获取地址列表
    me.getAddressList=function(){
      OfficialPages['address-dialog'].getAddress();
      return me;
    }
    // 展示订单支付框
    // me.showOrderPayDialog = function(){
    // 	$('.orderPay-dialog').css('display', 'block');
    // 		$('.orderPay-dialog .page-bottom-content').slideDown(400);
    // 	return me;
    // };
    // 获取订单列表
    me.getOrderList = function(li) {
      OfficialPages['my-order'].getOrderList(li);
      return me;
    };
    // 提交评价
    me.submitComment = function(para) {
      OfficialPages['make-comment'].submitComment(para);
      return me;
    };
    // 获取评价列表
    me.getComments = function(type, page) {
      OfficialPages['comment-page'].getComments(type || 0, page || 1);
      return me;
    };
    // 搜索数据
    me.search = function(keyword,$list,form,type){
      EleObjects[type].search(keyword,$list,form);
    };
    // 城市定位
    me.citylocation = function(type,region_id, form, $list){
      EleObjects[type].locationList(form, region_id, $list);
    }
    // 修改预约条件
    me.changeAppointmentCondition = function(){
      OfficialPages['appointment-page'].changeAppointmentCondition();
    };
    // 预约
    me.sureMakeAppointment = function(){
      OfficialPages['appointment-page'].sureMakeAppointment();
    };
    // 打开定位页面
    me.showResetLocation = function(options){
      OfficialPages['reset-location'].showResetLocation(options);
    }
    // 打开定位页面
    me.setLocation = function(options){
      EleObjects['franchisee-list'].setLocation(options);
    }
    // 点击商家详情页里的列表tab
    me.clickFranchiseeDetailTab = function(form){
      OfficialPages['franchisee-detail'].clickFranchiseeDetailTab(form);
    }
    //到店无规格加减添加购物车
    me.tostoreToShopcart = function(type){
      OfficialPages['tostore-detail'].tostoreToShopcart(type);
    }
    // 到店确认支付加减
    me.tostorePaymentToShopcart = function(type,_this){
      OfficialPages['tostore-payment'].tostorePaymentToShopcart(type,_this);
    }
    me.tostoreAddCartOrder = function(){
      OfficialPages['tostore-payment'].tostoreAddCartOrder();
    }
    me.getHomepageRouter = function(){
      return appData.data['homepage-router'];
    }
    me.preferentialWay = function(){
      OfficialPages['tostore-payment'].preferentialWay();
    }
    me.freightWayChangeOrder = function(){
      OfficialPages['order-detail'].freightWayChangeOrder();
    }
    // me.getClearGetOrder = function(){
    //   OfficialPages['pay-page'].timer;
    // }
    me.tostoreAddToShoppingCart = function(type){
      OfficialPages['tostore-detail'].addToShoppingCart(type);
    }
    me.ToShoppingCartIcon = function(type){
      EleObjects['tostore-pay-ele'].addToShoppingCart(type);
    }
    me.DeleteShoppingCartIcon = function(){
      EleObjects['tostore-pay-ele'].deleteToShoppingCart();
    }
    me.setPayPageCode = function(data){
      OfficialPages['pay-page'].setCode(data);
    }
    // 整个webapp除嵌入地图组件外的地图弹窗只需要一个
    me.mapModule = { 
      setPhoneMap: function(el, fn) {
        var _self = this,
            lat = el.attr('lat'),
            lng = el.attr('lng'),
            zoom = parseInt(el.attr('mapzoom')) || 13,
            latLng = new qq.maps.LatLng(lat, lng),
            geocoder = new qq.maps.Geocoder();

        _self.clearOverlays();

        geocoder.getAddress(latLng);
        geocoder.setComplete(function(result) {
          _self.qqMapMarker = new qq.maps.Marker({
              position: latLng,
              map: _self.map
          });
          _self.map.panTo(latLng);

          fn && fn(result);
        });
        _self.map.zoomTo(zoom);
      },
      clearOverlays: function(id) { //清除地图覆盖物
        this.qqMapMarker && this.qqMapMarker.setMap(null);
      },
      initPhoneMap: function() {
        this.map = new qq.maps.Map($('.map-container-module')[0], {
          zoom: 13,
          zoomControl: false,
          panControl: false,
          mapTypeControl: false
        });
      },
      hasInitMap : false,
      initMap: function() {
        if (!isWeixin && !this.hasInitMap) {
          this.hasInitMap = true;
          this.initPhoneMap();
        }
      },
    }
    me.initMap = function() {
      me.mapModule.initMap();
    }
    me.setPhoneMap = function(el, fn) {
      me.mapModule.setPhoneMap(el, fn);
      return this;
    }
    me.showMap = function() {
      $('.map-container').css('display', 'block');
    }
    me.closeMap = function() {
      $('.map-container').css('display', 'none');
    }

    me.initial();
  };

  APP = new AppComponent();




    /**
 * 组件对象, 包含各组件的特殊处理函数
     *
     */

  function TextEle() {
    var _text = this;

    if (typeof this.parseElement != 'function') {
      TextEle.prototype.parseElement = function(ele) {
        var $html,
            customFeature = ele.customFeature || {};

        ele.content = ele.content || '';
        switch (customFeature.action) {
          case 'none':
              $html = $('<div class="element text">' + ele.content + '</div>');;
              break;
          case 'inner-link':
              // 页面跳转
              $html = $('<div class="element text router" data-router="' + (customFeature['inner-page-link'] || customFeature['page-link']) + '">' + ele.content + '</div>');
              break;
          case 'custom-link':
              // 外部链接
              $html = $('<div class="element text"><a href="' + clearWeixinHash(customFeature['custom-page-link'] || customFeature['page-link']) + '" target="_blank">' + ele.content + '</a></div>');
              break;
          case 'weiye':
              // 微页
              $html = $('<div class="element text"><a href="' + (customFeature['weiye-link'] || customFeature['page-link']) + '" target="_blank">' + ele.content + '</a></div>');
              break;
          case 'call':
              // 拨打电话
              $html = $('<div class="element text"><a href="tel:' + customFeature['phone-num'] + '">' + ele.content + '</a></div>');
              break;
          case 'refresh-page':
              // 刷新页面
              $html = $('<div class="element text refresh" data-type="page">' + ele.content + '</div>');
              break;
          case 'refresh-list':
              // 刷新列表
              $html = $('<div class="element text refresh" data-type="list" data-target="' + customFeature.refresh_object + '" data-index="' + customFeature.index_segment + '" data-value="' + customFeature.index_value + '">' + ele.content + '</div>');
              break;
          case 'goods-trade':
              // 跳转指定商品详情页
              $html = $('<div class="element text router js-to-detail" data-router="'+(customFeature['goods-type'] == 3 ? 'tostoreDetail':'goodsDetail')+'" data-id="' + customFeature['goods-id'] + '">' + ele.content + '</div>');
              break;
          case 'to-seckill':
              // 跳转指定秒杀商品
              $html = $('<div class="element text router js-to-detail" data-router="seckillDetail" data-id="' + customFeature['seckill-id'] + '">' + ele.content + '</div>');
              break;
          case 'to-franchisee':
              // 跳转指定商家
              $html = $('<div class="element text router js-to-detail" data-router="franchiseeDetail" data-id="' + customFeature['franchisee-id'] + '">' + ele.content + '</div>');
              break;
          case 'community':
              // 跳转社区版块
              $html = $('<div class="element text router js-to-detail" data-router="communityPage" data-id="' + customFeature['community-id'] + '">' + ele.content + '</div>');
              break;
          case 'get-coupon':
              // 跳转优惠券详情页
              $html = $('<div class="element text router js-to-detail" data-router="couponDetail" data-id="' + customFeature['coupon-id'] + '">' + ele.content + '</div>');
              break;
         case 'coupon-receive-list':
              // 跳转优惠券领取列表
              $html = $('<div class="element text router js-to-detail" data-router="couponReceiveListPage" >' + ele.content + '</div>');
              break;
          case 'recharge':
              // 储值金充值
              $html = $('<div class="element text router js-to-detail" data-router="recharge" >' + ele.content + '</div>');
              break;
          case 'transfer':
              // 跳转支付(当面付)页面
              $html = $('<div class="element text router js-to-detail" data-router="transferPay">' + ele.content + '</div>');
              break;
           case 'to-promotion':
              // 跳转推广页面
              $html = $('<div class="element text to-promotion">' + ele.content + '</div>');
              break;
          case 'lucky-wheel':
              // 跳转大转盘
              $html = $('<div class="element text router js-to-detail" data-router="luckyWheelDetail" >' + ele.content + '</div>');
              break;
          default:
              $html = $('<div class="element text">' + ele.content + '</div>');;
        }

        if(ele.form_data){ //绑定了地图字段
          $html.attr({
            lat : ele.form_data.region_lat ,
            lng : ele.form_data.region_lng ,
            address : ele.content
          }).addClass('map');
        }

        return $html;
      };
    }
  };

  function ButtonEle() {
    var _button = this;

    if (typeof this.parseElement != 'function') {
      ButtonEle.prototype.parseElement = function(ele) {
        var customFeature = ele.customFeature || {},
            $html;
        if (customFeature.segment === 'submit-btn') {
          // 按钮组件在自定义表单组件中，设置了绑定字段为“提交数据”时
          $html = $('<div class="button background-ele">' + ele.content + '</div>');
          $html.click(function(event) {
              _button.submit($(this));
          });
        } else {
          switch (customFeature.action) {
            case 'none':
                $html = $('<div class="element button">' + ele.content + '</div>');
                break;
            case 'inner-link':
                // 页面跳转
                $html = $('<div class="element button router" data-router="' + (customFeature['inner-page-link'] || customFeature['page-link']) + '">' + ele.content + '</div>');
                break;
            case 'custom-link':
                // 外部链接
                $html = $('<div class="element button"><a href="' + clearWeixinHash(customFeature['custom-page-link'] || customFeature['page-link']) + '" target="_blank">' + ele.content + '</a></div>');
                break;
            case 'weiye':
                // 微页
                $html = $('<div class="element button"><a href="' + (customFeature['weiye-link'] || customFeature['page-link']) + '" target="_blank">' + ele.content + '</a></div>');
                break;
            case 'call':
                // 拨打电话
                $html = $('<div class="element button"><a href="tel:' + customFeature['phone-num'] + '">' + ele.content + '</a></div>');
                break;
            case 'refresh-page':
                // 刷新页面
                $html = $('<div class="element button refresh" data-type="page">' + ele.content + '</div>');
                break;
            case 'refresh-list':
                // 刷新列表
                $html = $('<div class="element button refresh" data-type="list" data-target="' + customFeature.refresh_object + '" data-index="' + customFeature.index_segment + '" data-value="' + customFeature.index_value + '">' + ele.content + '</div>');
                break;
            case 'goods-trade':
                // 跳转指定商品详情页
                $html = $('<div class="element button router js-to-detail" data-router="'+(customFeature['goods-type'] == 3 ? 'tostoreDetail':'goodsDetail')+'" data-id="' + customFeature['goods-id'] + '">' + ele.content + '</div>');
                break;
            case 'to-seckill':
                // 跳转指定秒杀商品
                $html = $('<div class="element button router js-to-detail" data-router="seckillDetail" data-id="' + customFeature['seckill-id'] + '">' + ele.content + '</div>');
                break;
            case 'to-franchisee':
                // 跳转指定商家
                $html = $('<div class="element button router js-to-detail" data-router="franchiseeDetail" data-id="' + customFeature['franchisee-id'] + '">' + ele.content + '</div>');
                break;
            case 'community':
                // 跳转社区版块
                $html = $('<div class="element button router js-to-detail" data-router="communityPage" data-id="' + customFeature['community-id'] + '">' + ele.content + '</div>');
                break;
            case 'get-coupon':
                // 跳转优惠券详情页
                $html = $('<div class="element button router js-to-detail" data-router="couponDetail" data-id="' + customFeature['coupon-id'] + '">' + ele.content + '</div>');
                break;
            case 'coupon-receive-list':
                // 跳转优惠券领取列表
                $html = $('<div class="element button router js-to-detail" data-router="couponReceiveListPage" >' + ele.content + '</div>');
                break;
            case 'recharge':
                // 储值金充值
                $html = $('<div class="element button router js-to-detail" data-router="recharge" >' + ele.content + '</div>');
                break;
            case 'transfer':
                // 跳转支付(当面付)页面
                $html = $('<div class="element button router js-to-detail" data-router="transferPay">' + ele.content + '</div>');
                break;
            case 'to-promotion':
                // 跳转推广页面
                $html = $('<div class="element button to-promotion">' + ele.content + '</div>');
                break;
            case 'lucky-wheel':
                // 跳转大转盘
                $html = $('<div class="element button router js-to-detail" data-router="luckyWheelDetail" >' + ele.content + '</div>');
                break;
            default:
                $html = $('<div class="element button">' + ele.content + '</div>');
          }
        }
        return $html;
      };
      ButtonEle.prototype.submit = function($btn) {
        if ($btn.hasClass('js-posting')) {
          return;
        };
        var $form = $btn.closest('.form-vessel'),
            form = $form.attr('data-form'),
            form_data = {},
            $eles = $form.find('.js-form-ele'),
            length = $eles.length,
            ifPost = true;

        for (var i = 0; i < length; i++) {
          var $ele = $eles.eq(i),
              segment = $ele.attr('data-segment'),
              type = $ele.attr('data-type'),
                value = EleObjects[type].getValue($ele);

          if (value == -1) {
            // 此时表示有要求必填的项，没有数据
            ifPost = false;
            return;
          } else {
            form_data[segment] = value;
          }

        };
    	  var param = {
    		app_id: appId,
              form: form,
              form_data: form_data
            };
        $btn.addClass('js-posting');
        $ajax('/index.php?r=AppData/addData', 'post', param, 'json', function(data) {
          if (data.status == 0) {
              alertTip('提交成功');
          } else {
              if(data.data === "您未登录"){
                APP.turnToPage({
                  router: 'loginDialog'
                })
              }
              alertTip('提交失败，请重试。' + data.data);
          };
          $btn.removeClass('js-posting');
        }, function() {
          $btn.removeClass('js-posting');
          alertTip('提交失败，请重试');
        });
      };
    }
  };

  function PictureEle() {
    var _picture = this;

    if (typeof this.parseElement != 'function') {
      PictureEle.prototype.parseElement = function(ele) {
        var customFeature = ele.customFeature || {},
            $html;
        ele.content = ele.content || DEFAULTIMAGE;

        switch (customFeature.action) {
          case 'none':
              $html = $('<div class="element picture"><img src="' + ele.content + '"/></div>');
              break;
          case 'inner-link':
              // 页面跳转
              $html = $('<div class="element picture router" data-router="' + (customFeature['inner-page-link'] || customFeature['page-link']) + '"><img src="' + ele.content + '"/></div>');
              break;
          case 'custom-link':
              // 外部链接
              $html = $('<div class="element picture"><a href="' + clearWeixinHash(customFeature['custom-page-link'] || customFeature['page-link']) + '" target="_blank"><img src="' + ele.content + '"/></a></div>');
              break;
          case 'weiye':
              // 微页
              $html = $('<div class="element picture"><a href="' + (customFeature['weiye-link'] || customFeature['page-link']) + '" target="_blank"><img src="' + ele.content + '"/></a></div>');
              break;
          case 'call':
              // 拨打电话
              $html = $('<div class="element picture"><a href="tel:' + customFeature['phone-num'] + '"><img src="' + ele.content + '"/></a></div>');
              break;
          case 'refresh-page':
              // 刷新页面
              $html = $('<div class="element picture refresh" data-type="page"><img src="' + ele.content + '"/></div>');
              break;
          case 'refresh-list':
              // 刷新列表
              $html = $('<div class="element picture refresh" data-type="list" data-target="' + customFeature.refresh_object + '" data-index="' + customFeature.index_segment + '" data-value="' + customFeature.index_value + '"><img src="' + ele.content + '"/></div>');
              break;
          case 'goods-trade':
              // 跳转指定商品详情页
              $html = $('<div class="element picture router js-to-detail" data-router="'+(customFeature['goods-type'] == 3 ? 'tostoreDetail':'goodsDetail')+'" data-id="' + customFeature['goods-id'] + '"><img src="' + ele.content + '"/></div>');
              break;
          case 'to-seckill':
              // 跳转指定秒杀商品
              $html = $('<div class="element picture router js-to-detail" data-router="seckillDetail" data-id="' + customFeature['seckill-id'] + '"><img src="' + ele.content + '"/></div>');
              break;
          case 'to-franchisee':
              // 跳转指定商家
              $html = $('<div class="element picture router js-to-detail" data-router="franchiseeDetail" data-id="' + customFeature['franchisee-id'] + '"><img src="' + ele.content + '"/></div>');
              break;
          case 'get-coupon':
              // 跳转优惠券详情页
              $html = $('<div class="element picture router js-to-detail" data-router="couponDetail" data-id="' + customFeature['coupon-id'] + '"><img src="' + ele.content + '"/></div>');
              break;
          case 'coupon-receive-list':
              // 跳转优惠券领取列表
              $html = $('<div class="element picture router js-to-detail" data-router="couponReceiveListPage" ><img src="' + ele.content + '"/></div>');
              break;
          case 'recharge':
              // 储值金充值
              $html = $('<div class="element picture router js-to-detail" data-router="recharge" ><img src="' + ele.content + '"/></div>');
              break;
          case 'community':
              // 跳转社区版块
              $html = $('<div class="element picture router js-to-detail" data-router="communityPage" data-id="' + customFeature['community-id'] + '"><img src="' + ele.content + '"/></div>');
              break;
          case 'transfer':
              // 跳转支付(当面付)页面
              $html = $('<div class="element picture router js-to-detail" data-router="transferPay"><img src="' + ele.content + '"/></div>');
              break;
          case 'to-promotion':
              // 跳转推广页面
              $html = $('<div class="element picture to-promotion"><img src="' + ele.content + '"/></div>');
              break;
          case 'lucky-wheel':
              // 跳转大转盘
              $html = $('<div class="element picture router js-to-detail" data-router="luckyWheelDetail" ><img src="' + ele.content + '"/></div>');
              break;
          default:
              $html = $('<div class="element picture"><img src="' + ele.content + '"/></div>');
        }
        ele.content instanceof Array ? $html = multiPicture($html, ele.content) : $html
        return $html;
      };
    }
  };

  function multiPicture(html, imgArr){
  	var _dom = '';
  	$.each(imgArr, function(index, val) {
  		html.find('img').attr('src',val);
  		_dom += html[0].outerHTML
  	});
  	return $(_dom);
  }

  function CarouselEle() {
    var _carousel = this;

    if (typeof this.parseElement != 'function') {
        CarouselEle.prototype.parseElement = function(ele) {
        var customFeature = ele.customFeature || {},
            content = ele.content,
              autoplay = customFeature.autoplay,
            interval = customFeature.interval ? +customFeature.interval * 1000 : 2000,
              html = '<div class="carousel"><div class="slick-carousel" data-auto-play="' + autoplay + '" data-interval="' + interval + '">';

            if(customFeature.carouselgroupId){
               //获取轮播分组下的轮播项
                $.ajax({
                  url:"/index.php?r=/AppExtensionInfo/carouselPhotoProjiect",
                  type:"GET",
                  async: false,
                  data:{type:customFeature.carouselgroupId},
                  dataType:"JSON",
                  success:function(res){
                      if(res.status == 0){
                    var items = res.data;
                    $.each(items,function(index,item){
                        var item_data = JSON.parse(item.form_data);
                        switch(item_data.action){
                          case "none":
                          //无
                            if(item_data.isShow == 1)
                            html += '<div><img class="carousel-img" src="' + item_data.pic + '"/></div>';
                            break;
                          case  "inner-link":
                            // 页面跳转
                            if(item_data.isShow == 1)
                            html += '<div><img class="carousel-img router" src="' + item_data.pic + '" data-router="' + item_data['page-link'] + '"/></div>';
                            break;
                          case  "custom-link":
                            // 外部链接
                            if(item_data.isShow == 1)
                            html += '<div><a href="' + clearWeixinHash(item_data['page-link']) + '" target="_blank"><img class="carousel-img" src="' + item_data.pic + '"/></a></div>';
                            break;
                          case  "weiye":
                            // 微页
                            if(item_data.isShow == 1)
                            html += '<div><a href="' + item_data['page-link'] + '" target="_blank"><img class="carousel-img" src="' + item_data.pic + '"/></a></div>';
                            break;
                          case  "call":
                            // 拨打电话
                            if(item_data.isShow == 1)
                            html += '<div><a href="tel:' + item_data['phone-num'] + '"><img class="carousel-img" src="' + item_data.pic + '"/></a></div>';
                            break;
                          case  "goods-trade":
                            //跳转指定商品详情
                            if(item_data.isShow == 1)
                            html += '<div><img class="carousel-img router js-to-detail" data-router="'+(item_data['goods-type'] == 3 ? 'tostoreDetail':'goodsDetail')+'" data-id="' + item_data['goods-id'] + '" src="' + item_data.pic + '"/></div>';
                            break;
                          case  "to-seckill":
                            //跳转指定秒杀商品
                            if(item_data.isShow == 1)
                            html += '<div><img class="carousel-img router js-to-detail" data-router="seckillDetail" data-id="' + item_data['seckill-id'] + '" src="' + item_data.pic + '"/></div>';
                            break;
                          case  "to-franchisee":
                            // 跳转指定商家
                            if(item_data.isShow == 1)
                            html += '<div><img class="carousel-img router js-to-detail" data-router="franchiseeDetail" data-id="' + item_data['franchisee-id'] + '" src="' + item_data.pic + '"/></div>';
                            break;
                          case  "community":
                           //跳转社区版块
                            if(item_data.isShow == 1)
                            html += '<div><img class="carousel-img router js-to-detail" data-router="communityPage" data-id="' + item_data['community-id'] + '" src="' + item_data.pic + '"/></div>';
                            break;
                          case  "get-coupon":
                            //跳转指定优惠券详情
                            if(item_data.isShow == 1)
                            html += '<div><img class="carousel-img router js-to-detail" data-router="couponDetail" data-id="' + item_data['coupon-id'] + '" src="' + item_data.pic + '"/></div>';
                            break;
                          case "coupon-receive-list":
                            // 跳转优惠券领取列表
                            if(item_data.isShow == 1)
                            html += '<div><img class="carousel-img router js-to-detail" data-router="couponReceiveListPage"  src="' + item_data.pic + '"/></div>';
                            break;
                          case "recharge":
                            // 储值金充值
                            if(item_data.isShow == 1)
                            html += '<div><img class="carousel-img router js-to-detail" data-router="recharge"  src="' + item_data.pic + '"/></div>';
                            break;
                          case  "transfer":
                            // 跳转支付(当面付)页面
                            if(item_data.isShow == 1)
                            html += '<div><img class="carousel-img router js-to-detail" data-router="transferPay" src="' + item_data.pic + '"/></div>';
                            break;
			  case  "to-promotion":
                            // 跳转推广页面
                            if(item_data.isShow == 1)
                            html += '<div><img class="carousel-img to-promotion" src="' + item_data.pic + '"/></div>';
                            break;
                          case  "lucky-wheel":
                            //跳转大转盘
                            if(item_data.isShow == 1)
                            html += '<div><img class="carousel-img router js-to-detail" data-router="luckyWheelDetail" src="' + item_data.pic + '"/></div>';
                            break;
                          default:
                            if(item_data.isShow == 1)
                            html += '<div><img class="carousel-img" src="' + item_data.pic + '"/></div>';
                        }
                    });
                     }
                  },
                  error:function(res){
                    alertToolsTip(res.data);
                  }
                });
                  html += '</div></div>';
                  console.log(html);
                  return $(html);
            }else{
                content && $(content).each(function(index, ele) {
                var customFeature = ele.customFeature || {};
                switch (customFeature.action) {
                  case 'none':
                      html += '<div><img class="carousel-img" src="' + ele.pic + '"/></div>';
                      break;
                  case 'inner-link':
                      // 页面跳转
                      html += '<div><img class="carousel-img router" src="' + ele.pic + '" data-router="' + (customFeature['inner-page-link'] || customFeature['page-link']) + '"/></div>';
                      break;
                  case 'custom-link':
                      // 外部链接
                      html += '<div><a href="' + clearWeixinHash(customFeature['custom-page-link'] || customFeature['page-link']) + '" target="_blank"><img class="carousel-img" src="' + ele.pic + '"/></a></div>';
                      break;
                  case 'weiye':
                      // 微页
                      html += '<div><a href="' + (customFeature['weiye-link'] || customFeature['page-link']) + '" target="_blank"><img class="carousel-img" src="' + ele.pic + '"/></a></div>';
                      break;
                  case 'call':
                      // 拨打电话
                      html += '<div><a href="tel:' + customFeature['phone-num'] + '"><img class="carousel-img" src="' + ele.pic + '"/></a></div>';
                      break;
                  case 'goods-trade':
                      //跳转指定商品详情
                      html += '<div><img class="carousel-img router js-to-detail" data-router="'+(customFeature['goods-type'] == 3 ? 'tostoreDetail':'goodsDetail')+'" data-id="' + customFeature['goods-id'] + '" src="' + ele.pic + '"/></div>';
                      break;
                  case 'to-seckill':
                      //跳转指定秒杀商品详情
                      html += '<div><img class="carousel-img router js-to-detail" data-router="seckillDetail" data-id="' + customFeature['seckill-id'] + '" src="' + ele.pic + '"/></div>';
                      break;
                  case 'to-franchisee':
                      // 跳转指定商家
                      html += '<div><img class="carousel-img router js-to-detail" data-router="franchiseeDetail" data-id="' + customFeature['franchisee-id'] + '" src="' + ele.pic + '"/></div>';
                      break;
                  case 'community':
                      //跳转社区版块
                      html += '<div><img class="carousel-img router js-to-detail" data-router="communityPage" data-id="' + customFeature['community-id'] + '" src="' + ele.pic + '"/></div>';
                      break;
                  case 'get-coupon':
                      //跳转指定优惠券详情
                      html += '<div><img class="carousel-img router js-to-detail" data-router="couponDetail" data-id="' + customFeature['coupon-id'] + '" src="' + ele.pic + '"/></div>';
                      break;
                  case 'coupon-receive-list':
                      // 跳转优惠券领取列表
                      html = '<div><img class="carousel-img router js-to-detail" data-router="couponReceiveListPage" src="' + ele.pic + '"/></div>';
                      break;
                  case 'recharge':
                      // 储值金充值
                      html = '<div><img class="carousel-img router js-to-detail" data-router="recharge" src="' + ele.pic + '"/></div>';
                      break;
                  case 'transfer':
                      // 跳转支付(当面付)页面
                      html += '<div><img class="carousel-img router js-to-detail" data-router="transferPay" src="' + ele.pic + '"/></div>';
                      break;
                  case 'to-promotion':
                      // 跳转推广页面
                      html += '<div><img class="carousel-img to-promotion" src="' + ele.pic + '"/></div>';
                      break;
                  case 'lucky-wheel':
                      //跳转大转盘
                      html += '<div><img class="carousel-img router js-to-detail" data-router="luckyWheelDetail"  src="' + ele.pic + '"/></div>';
                      break;
                  default:
                      html += '<div><img class="carousel-img" src="' + ele.pic + '"/></div>';
                }
              });
                html += '</div></div>';
                return $(html);
            }
      };
    }
  };

  function AlbumEle() {
    var _album = this;

    if (typeof this.parseElement != 'function') {
      AlbumEle.prototype.parseElement = function(ele) {
        var customFeature = ele.customFeature || {},
            content = ele.content,
            containerWidth = ele.style && ele.style.width ? parseInt(ele.style.width) : ORIGINAL_PHONE_WIDTH,
            mode = customFeature.mode && customFeature.mode == 1 ? 'sec-mode' : '',
            col = customFeature.col ? customFeature.col : 3,
            margin = customFeature.margin ? customFeature.margin : 3,
            paddingLeft = customFeature['padding-left'] || margin,
            paddingTop = customFeature['padding-top'] || margin,
            width = (containerWidth - paddingLeft) / col - paddingLeft,
            itemStyle = containerWidth == ORIGINAL_PHONE_WIDTH && col == 3 && paddingLeft == 3 ? {} : { width: width }, // 每一项的样式，宽度和右／下间距
            picStyle = {}, // 每一张图片的样式，高度和border-radius
            $container = $('<ul class="album-container background-ele clearfix"></ul>'),
            $html = $('<div class="element album ' + mode + '"></div>');

        itemStyle.marginRight = paddingLeft + 'px';
        itemStyle.marginBottom = paddingTop + 'px';

        $container.css({
          paddingLeft: paddingLeft + 'px',
          paddingTop: paddingTop + 'px'
        });
        customFeature.imgHeight && (picStyle.height = customFeature.imgHeight);
        customFeature.picBorderRadius && (picStyle['border-radius'] = customFeature.picBorderRadius);
        $(content).each(function(index, el) {
          var piccustomFeature = el.customFeature || {},
              $pic;
          switch (piccustomFeature.action) {
            case 'none':
                $pic = $('<li class="album-pic"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            case 'inner-link':
                // 页面跳转
                $pic = $('<li class="album-pic router" data-router="' + (piccustomFeature['inner-page-link'] || piccustomFeature['page-link']) + '"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            case 'custom-link':
                // 外部链接
                $pic = $('<li class="album-pic"><a href="' + clearWeixinHash(piccustomFeature['custom-page-link'] || piccustomFeature['page-link']) + '" target="_blank"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></a></li>');
                break;
            case 'weiye':
                // 微页
                $pic = $('<li class="album-pic"><a href="' + (piccustomFeature['weiye-link'] || piccustomFeature['page-link']) + '" target="_blank"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></a></li>');
                break;
            case 'call':
                // 拨打电话
                $pic = $('<li class="album-pic"><a href="tel:' + piccustomFeature['phone-num'] + '"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></a></li>');
                break;
            case 'refresh-page':
                // 刷新页面
                $pic = $('<li class="album-pic refresh" data-type="page"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            case 'refresh-list':
                // 刷新列表
                $pic = $('<li class="album-pic refresh" data-type="list" data-target="' + piccustomFeature.refresh_object + '" data-index="' + piccustomFeature.index_segment + '" data-value="' + piccustomFeature.index_value + '"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            case 'goods-trade':
                //跳转指定商品详情
                $pic = $('<li class="album-pic router js-to-detail" data-router="'+(piccustomFeature['goods-type'] == 3 ? 'tostoreDetail':'goodsDetail')+'" data-id="' + piccustomFeature['goods-id'] + '"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            case 'to-seckill':
                //跳转指定秒杀商品
                $pic = $('<li class="album-pic router js-to-detail" data-router="seckillDetail" data-id="' + piccustomFeature['seckill-id'] + '"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            case 'to-franchisee':
                // 跳转指定商家
                $pic = $('<li class="album-pic router js-to-detail" data-router="franchiseeDetail" data-id="' + piccustomFeature['franchisee-id'] + '"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            case 'community':
                //跳转社区版块
                $pic = $('<li class="album-pic router js-to-detail" data-router="communityPage" data-id="' + piccustomFeature['community-id'] + '"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            case 'get-coupon':
                //跳转指定优惠券详情
                $pic = $('<li class="album-pic router js-to-detail" data-router="couponDetail" data-id="' + piccustomFeature['coupon-id'] + '"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            case 'coupon-receive-list':
                // 跳转优惠券领取列表
                $pic = $('<li class="album-pic router js-to-detail" data-router="couponReceiveListPage" ><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            case 'recharge':
                // 储值金充值
                $pic = $('<li class="album-pic router js-to-detail" data-router="recharge" ><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            case 'transfer':
                // 跳转支付(当面付)页面
                $pic = $('<li class="album-pic router js-to-detail" data-router="transferPay"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            case 'to-promotion':
                // 跳转推广页面
                $pic = $('<li class="album-pic to-promotion"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            case 'lucky-wheel':
                //跳转大转盘
                $pic = $('<li class="album-pic router js-to-detail" data-router="luckyWheelDetail" ><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
                break;
            default:
                $pic = $('<li class="album-pic"><img src="' + el.pic + '"/><p class="title">' + el.title + '</p></li>');
          }
          itemStyle && $pic.css(itemStyle);
          picStyle && $pic.find('img').css(picStyle);
          $container.append($pic);
          piccustomFeature = $pic = null;
        });

        $html.append($container);
        return $html;
      };
    }
  };

  function ListEle() {
    var _list = this;

    if (typeof this.parseElement != 'function') {
      ListEle.prototype.parseElement = function(ele) {
        var customFeature = ele.customFeature || {},
            content = ele.content,
              containerWidth = ORIGINAL_PHONE_WIDTH - 10,
            mode = customFeature && customFeature.mode && customFeature.mode == 1 ? 'sec-mode' : '',
              listStyle = {},
              imgStyle = {},
              titleWidth = {},
              secTitleStyle = {},
            $container = $('<ul class="list-container ' + mode + '"></ul>'),
            $html = $('<div class="element list"></div>');

        if (customFeature) {
          if (customFeature.margin) {
            listStyle['margin-bottom'] = customFeature.margin + 'px';
          }
          if (customFeature.lineBackgroundColor) {
            listStyle['background-color'] = customFeature.lineBackgroundColor;
          }
          if (customFeature.lineBackgroundImage) {
            listStyle['background-image'] = 'url(' + customFeature.lineBackgroundImage + ')';
          }

          if (customFeature.lineHeight) {
            listStyle['height'] = customFeature.lineHeight + 'px';
          }
          if (customFeature.imgWidth) {
            imgStyle.width = customFeature.imgWidth;
            mode == '' && (titleWidth.width = ORIGINAL_PHONE_WIDTH - customFeature.imgWidth - 10 + 'px');
          }
          if (customFeature.imgHeight) {
            imgStyle.height = customFeature.imgHeight + 'px';
          }

          if (customFeature.secColor) {
            secTitleStyle.color = customFeature.secColor;
          }
          if (customFeature.secFontSize) {
            secTitleStyle['font-size'] = customFeature.secFontSize;
          }
          if (customFeature.secTextDecoration) {
            secTitleStyle['text-decoration'] = customFeature.secTextDecoration;
          }
          if (customFeature.secTextAlign) {
            secTitleStyle['text-align'] = customFeature.secTextAlign;
          }
          if (customFeature.secFontStyle) {
            secTitleStyle['font-style'] = customFeature.secFontStyle;
          }
          if (customFeature.secFontWeight) {
            secTitleStyle['font-weight'] = customFeature.secFontWeight;
          }
        }

        $(content).each(function(index, el) {
          var listcustomFeature = el.customFeature || {},
              $target,
              $list,
              $img = $('<img class="list-img" src="' + el.pic + '"/>'),
              $titles = $('<div class="title-container"><p class="title">' + el.title + '</p></div>'),
              $secTitle = $('<p class="sec-title">' + el.secTitle + '</p>');

          secTitleStyle && $secTitle.css(secTitleStyle);
          $titles.append($secTitle);

          imgStyle && $img.css(imgStyle);
          titleWidth && $titles.css(titleWidth);

          switch (listcustomFeature.action) {
            case 'none':
                $list = $('<li class="list-item background-ele"></li>');
                $target = $list;
                break;
            case 'inner-link':
                // 页面跳转
                $list = $('<li class="list-item background-ele router" data-router="' + (listcustomFeature['inner-page-link'] || listcustomFeature['page-link']) + '"></li>');
                $target = $list;
                break;
            case 'custom-link':
                // 外部链接
                $target = $('<a href="' + clearWeixinHash(listcustomFeature['custom-page-link'] || listcustomFeature['page-link']) + '" target="_blank"></a>')
                $list = $('<li class="list-item background-ele"></li>');
                $list.append($target);
                break;
            case 'weiye':
                // 微页
                $target = $('<a href="' + (listcustomFeature['weiye-link'] || listcustomFeature['page-link']) + '" target="_blank"></a>')
                $list = $('<li class="list-item background-ele"></li>');
                $list.append($target);
                break;
            case 'call':
                // 拨打电话
                $target = $('<a href="tel:' + listcustomFeature['phone-num'] + '"></a>')
                $list = $('<li class="list-item background-ele"></li>');
                $list.append($target);
                break;
            case 'refresh-page':
                // 刷新页面
                $list = $('<li class="list-item background-ele refresh" data-type="page"></li>');
                $target = $list;
                break;
            case 'refresh-list':
                // 刷新列表
                $list = $('<li class="list-item background-ele refresh" data-type="list" data-target="' + listcustomFeature.refresh_object + '" data-index="' + listcustomFeature.index_segment + '" data-value="' + listcustomFeature.index_value + '"></li>');
                $target = $list;
                break;
            case 'goods-trade':
                //跳转指定商品详情
                $list = $('<li class="list-item background-ele router js-to-detail" data-router="'+(listcustomFeature['goods-type'] == 3 ? 'tostoreDetail':'goodsDetail')+'" data-id="' + listcustomFeature['goods-id'] + '"></li>');
                $target = $list;
                break;
            case 'to-seckill':
                //跳转指定秒杀商品
                $list = $('<li class="list-item background-ele router js-to-detail" data-router="seckillDetail" data-id="' + listcustomFeature['seckill-id'] + '"></li>');
                $target = $list;
                break;
            case 'to-franchisee':
                //跳转指定商家详情
                $list = $('<li class="list-item background-ele router js-to-detail" data-router="franchiseeDetail" data-id="' + listcustomFeature['franchisee-id'] + '"></li>');
                $target = $list;
                break;
            case 'community':
                //跳转社区版块
                $list = $('<li class="list-item background-ele router js-to-detail" data-router="communityPage" data-id="' + listcustomFeature['community-id'] + '"></li>');
                $target = $list;
                break;
            case 'get-coupon':
                //跳转指定优惠券详情
                $list = $('<li class="list-item background-ele router js-to-detail" data-router="couponDetail" data-id="' + listcustomFeature['coupon-id'] + '"></li>');
                $target = $list;
                break;
            case 'coupon-receive-list':
                // 跳转优惠券领取列表
                $list = $('<li class="list-item background-ele router js-to-detail" data-router="couponReceiveListPage" ></li>');
                $target = $list;
                break;
            case 'recharge':
                // 储值金充值
                $list = $('<li class="list-item background-ele router js-to-detail" data-router="recharge" ></li>');
                $target = $list;
                break;
            case 'transfer':
                // 跳转支付(当面付)页面
                $list = $('<li class="list-item background-ele router js-to-detail" data-router="transferPay"></li>');
                $target = $list;
                break;
            case 'to-promotion':
                // 跳转推广页面
                $list = $('<li class="list-item background-ele to-promotion"></li>');
                $target = $list;
                break;
            case 'lucky-wheel':
                //跳转大转盘
                $list = $('<li class="list-item background-ele router js-to-detail" data-router="luckyWheelDetail" ></li>');
                $target = $list;
                break;
            default:
                $list = $('<li class="list-item background-ele"></li>');
                $target = $list;
          }

          listStyle && $list.css(listStyle);
          $target.append($img).append($titles);

          $container.append($list);
          listcustomFeature = $list = null;
        });

        $html.append($container);
        return $html;
      };
    }
  };

    function AudioEle() {
      var _audio = this;

      if (typeof this.parseElement != 'function') {
        AudioEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},style = ele.style || {},
              $html = $('<div style="zoom:1;overflow:hidden;"><div class="element audio img-thumb-wrap"><img class="audio-pause-thumb"'+' src='+customFeature['background-thumb']+'></div><div class="preview-audio-word"><p>'+customFeature["audioName"]+'</p><p class="audio-author-style">'+customFeature["audioAuthor"]+'</p></div></div>'),
              audio;

          if (style && style['background-image']) {
            if (style['background-image'].indexOf('url(') < 0) {
              style['background-image'] = 'url(' + style['background-image'] + ')';
            }
          }
          $html.css({"background-color":style['background-color']});
          $html.find(".img-thumb-wrap").css({
            "background-image":style['background-image'],
            "width":style['width'],
            'height':style['height'],
            'opacity':style['opacity'],
            'margin-left':style['margin-left'],
            'margin-top':style['margin-top'],
            'margin-right':style['margin-right'],
            'border-radius':style['border-radius'],
            'float':"left",
            'position':"relative"
          });
          $html.find(".audio-author-style").css({
            'font-size':style['font-size'],
            'font-weight':style['font-weight'],
            'color':style['color'],
            'font-style':style['font-style'],
            'text-decoration':style['text-decoration']
          });
          if (customFeature['file-src']) {
            $html.find(".img-thumb-wrap").append('<div class="inner-content-pause-preview"><div class="inner-content-pause-content-preview"><span class="pause-trangle-preview"></span></div></div><audio autoplay="autoplay"></audio>');
            audio = $html.find('audio');

            audio.on('ended, pause', function() {
              $html.find('.inner-content-pause-preview').show();
                    //.siblings('.audio-play-thumb').hide();
            }).on('play', function() {
              //$html.find('.audio-play-thumb').show()
                //  .siblings('.inner-content-pause-preview').hide();
              $html.find('.inner-content-pause-preview').hide();
              $('#' + GetQueryString('router')).find('audio').not($(audio)).each(function(index, au) {
                  au.paused || au.pause();
              });

            }).on('canplay', function() {
              this.play();
            });

            $html.on('click', function() {
              if (audio.attr('src')) {
                audio[0].paused ? audio[0].play() : audio[0].pause();
              } else {
                audio.attr('src', customFeature['file-src']);
              }
            });
          }
          return $html;
        };
      }
    }

    function VideoEle() {
      var _video = this;

      if (typeof this.parseElement != 'function') {
        VideoEle.prototype.parseElement = function(ele) {
          var $html;
          if(!ele.customFeature.usage || ele.customFeature.usage === 'webapp'){
            $html = $('<div class="element video">' +ele.content+ '<div class="video-iframe-mask"></div></div>');
          } else if (ele.customFeature.usage === 'xcx') {
            $html = $('<div class="element video"><video controls src='+ele.customFeature.videoSourceUrl+'></video></div>');
          }
          return $html;
        };
      }
    }

    function TopNavEle() {
      var _topNav = this;

      if (typeof this.parseElement != 'function') {
        TopNavEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},
              info = ele.content,
              style = ele.style || {},
              $html;

        $html = $('<div class="top-nav background-ele"><a href="javascript:;" class="left-btn' + (info.left.thumb ? ' img-thumb-wrap"' : '"') + ' style="font-size:' + info.left.fontSize + ';display:' + info.left.display + ';' + (info.left.spaceTop ? 'padding-top:' + info.left.spaceTop + ';' : '') + (info.left.spaceBottom ? 'padding-bottom:' + info.left.spaceBottom + ';' : '') + (info.left.spaceRight ? 'padding-right:' + info.left.spaceRight + ';' : '') + (info.left.spaceLeft ? 'margin-left:' + info.left.spaceLeft + ';' : '') + (info.left.width ? 'width:' + info.left.width + ';' : '') + '"><img class="nav-btn-img left-btn-img" ' + (info.left.thumb ? 'src=' + info.left.thumb : '') + '><span class="nav-btn-text">' + (info.left.text || '') + '</span></a><a href="javascript:;" class="right-btn' + (info.right.thumb ? ' img-thumb-wrap"' : '"') + ' style="font-size:' + info.right.fontSize + ';display:' + info.right.display + ';' + (info.right.spaceTop ? 'padding-top:' + info.right.spaceTop + ';' : '')+ (info.right.spaceBottom ? 'padding-bottom:' + info.right.spaceBottom + ';' : '') + (info.right.spaceLeft ? 'padding-left:' + info.right.spaceLeft + ';' : '') + (info.right.spaceRight ? 'margin-right:' + info.right.spaceRight + ';' : '') + (info.right.width ? 'width:' + info.right.width + ';' : '') + '" ' + (info.right.link ? 'data-link=' + info.right.link : '') + '><img class="nav-btn-img right-btn-img" ' + (info.right.thumb ? 'src=' + info.right.thumb : '') + '><span class="nav-btn-text">' + (info.right.text || '') + '</span></a><div class="page-title">' + info.title + '</div></div>');

          if (style && style['background-image']) {
            if (style['background-image'].indexOf('url(') < 0) {
              style['background-image'] = 'url(' + style['background-image'] + ')';
            }
          }
          $html.css(style);

          if (customFeature['left-page-link']) {
            // if( info.left ){
            $html.find('.left-btn').attr('data-router', customFeature['left-page-link']).addClass('router');
          }

          if (customFeature['right-page-link']) {
            $html.find('.right-btn').attr('data-router', customFeature['right-page-link']).addClass('router');
          }

          return $html;
        };
      }
    }

    function BottomNavEle() {
      var _bottomNav = this;

      if (typeof this.parseElement != 'function') {
        BottomNavEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},
              content = ele.content,
              style = ele.style || {},
              bottom_nav = '<div class="bottom-nav background-ele">',
              router = GetQueryString('router'),
              item_num,
              $nav_item;

          $(content).each(function(index, item) {
            switch(item.link)
            {
              case 'tabbarMyOrder':
                item.link = 'myOrder';
                break;
              case 'tabbarShoppingCart':
                item.link = 'shoppingCart';
                break;
              default:
                item.link = item.link;
            }
            bottom_nav += '<div class="item ' + (item.link ? (item.link === 'none' ? '' : 'router') : '') + '" data-router=' + item.link + ' ><a href="javascript:;" class="img-thumb-wrap" style="' + (customFeature['icon-size'] ? 'width:' + customFeature['icon-size'] + ';height:' + customFeature['icon-size'] + ';' : '') + '"><img class="img-before" src=' + item.imgBefore + '><img class="img-after" src=' + item.imgAfter + '></a><span' + ' class="bottom-text">' + item.text + '</span></div>';
            item_num = index + 1;
          });

          bottom_nav += '</div>';
          $html = $(bottom_nav);

          if (style && style['background-image']) {
            if (style['background-image'].indexOf('url(') < 0) {
              style['background-image'] = 'url(' + style['background-image'] + ')';
            }
          }
          $html.css(style);

          if (($nav_item = $html.find('.item[data-router="' + router + '"]')).length) {
            $nav_item.css('color', style['activated-color'] || 'inherit').find('.img-after').css('display', 'inline-block').siblings().css('display', 'none');
          }
          $html.find('.item').css('width', 100 / item_num + '%');

          // var scale = 'scale('+ratio+','+ratio+')';
          // $html.css({
          // 	'transform': scale,
          // 	'-moz-transform': scale,
          // 	'-webkit-transform': scale,
          // 	left: (window.innerWidth - ORIGINAL_PHONE_WIDTH)/2,
          // 	bottom: Math.round(content[0].height*(ratio - 1)/2)
          // });
          customFeature['bottom-nav-type'] == 'text' && $html.addClass('bottom-nav-without-img');
          return $html;
        };
      }
    }

    function StaticVesselEle() {
      var _staticvessel = this;

      if (typeof this.parseElement != 'function') {
        StaticVesselEle.prototype.parseElement = function(ele, dynamicData) {
          var customFeature = ele.customFeature || {},
              eles = ele.content,
              $html,
              $container;

          switch (customFeature.action) {
            case 'none':
                $html = $('<div class="element static-vessel"></div>');
                $container = $html;
                break;
            case 'inner-link':
                // 页面跳转
                $html = $('<div class="element static-vessel router" data-router="' + (customFeature['inner-page-link'] || customFeature['page-link']) + '"></div>');
                $container = $html;
                break;
            case 'custom-link':
                // 外部链接
                $html = $('<div class="element static-vessel"><a href="' + clearWeixinHash(customFeature['custom-page-link'] || customFeature['page-link']) + '" target="_blank"></a></div>');
                $container = $html.children('a');
                break;
            case 'weiye':
                // 微页
                $html = $('<div class="element static-vessel"><a href="' + (customFeature['weiye-link'] || customFeature['page-link']) + '" target="_blank"></a></div>');
                $container = $html.children('a');
                break;
            case 'call':
                // 拨打电话
                $html = $('<div class="element static-vessel"><a href="tel:' + customFeature['phone-num'] + '"></a></div>');
                $container = $html.children('a');
                break;
            case 'refresh-page':
                // 刷新页面
                $html = $('<div class="element static-vessel refresh" data-type="page"></div>');
                $container = $html;
                break;
            case 'refresh-list':
                // 刷新列表
                $html = $('<div class="element static-vessel refresh" data-type="list" data-target="' + customFeature.refresh_object + '" data-index="' + customFeature.index_segment + '" data-value="' + customFeature.index_value + '"></div>');
                $container = $html;
                break;
            case 'goods-trade':
                // 跳转指定商品详情页
                $html = $('<div class="element static-vessel router js-to-detail" data-router="'+(customFeature['goods-type'] == 3 ? 'tostoreDetail':'goodsDetail')+'" data-id="' + customFeature['goods-id'] + '"></div>');
                $container = $html;
                break;
            case 'to-seckill':
                // 跳转指定秒杀商品
                $html = $('<div class="element static-vessel router js-to-detail" data-router="seckillDetail" data-id="' + customFeature['seckill-id'] + '"></div>');
                $container = $html;
                break;
            case 'to-franchisee':
                // 跳转指定商家
                $html = $('<div class="element static-vessel router js-to-detail" data-router="franchiseeDetail" data-id="' + customFeature['franchisee-id'] + '"></div>');
                $container = $html;
                break;
            case 'community':
                // 跳转社区版块
                $html = $('<div class="element static-vessel router js-to-detail" data-router="communityPage" data-id="' + customFeature['community-id'] + '"></div>');
                $container = $html;
                break;
            case 'get-coupon':
                // 跳转指定商品详情页
                $html = $('<div class="element static-vessel router js-to-detail" data-router="couponDetail" data-id="' + customFeature['coupon-id'] + '"></div>');
                $container = $html;
                break;
            case 'coupon-receive-list':
                // 跳转优惠券领取列表
                $html = $('<div class="element static-vessel router js-to-detail" data-router="couponReceiveListPage" ></div>');
                $container = $html;
                break;
            case 'recharge':
                // 储值金充值
                $html = $('<div class="element static-vessel router js-to-detail" data-router="recharge" ></div>');
                $container = $html;
                break;
            case 'transfer':
                // 跳转支付(当面付)页面
                $html = $('<div class="element static-vessel router js-to-detail" data-router="transferPay"></div>');
                $container = $html;
                break;
            case 'to-promotion':
                // 跳转推广页面
                $html = $('<div class="element static-vessel to-promotion"></div>');
                $container = $html;
                break;
            case 'lucky-wheel':
                // 跳转大转盘
                $html = $('<div class="element static-vessel router js-to-detail" data-router="luckyWheelDetail" ></div>');
                $container = $html;
                break;
            default:
                $html = $('<div class="element static-vessel"></div>');
                $container = $html;
          }

          $(eles).each(function(index, el) {
            $container.append(APP.parseElement(el, dynamicData));
          });

          return $html;
        };
      }
    }

    function FreeVessel() {
      var _freevessel = this;

      if (typeof this.parseElement != 'function') {
        FreeVessel.prototype.parseElement = function(ele, dynamicData) {
          var customFeature = ele.customFeature || {},
              eles = ele.content,
              $html,
              $container;

          switch (customFeature.action) {
            case 'none':
                $html = $('<div class="element free-vessel"></div>');
                $container = $html;
                break;
            case 'inner-link':
                // 页面跳转
                $html = $('<div class="element free-vessel router" data-router="' + (customFeature['inner-page-link'] || customFeature['page-link']) + '"></div>');
                $container = $html;
                break;
            case 'custom-link':
                // 外部链接
                $html = $('<div class="element free-vessel"><a href="' + clearWeixinHash(customFeature['custom-page-link'] || customFeature['page-link']) + '" target="_blank"></a></div>');
                $container = $html.children('a');
                break;
            case 'weiye':
                // 微页
                $html = $('<div class="element free-vessel"><a href="' + (customFeature['weiye-link'] || customFeature['page-link']) + '" target="_blank"></a></div>');
                $container = $html.children('a');
                break;
            case 'call':
                // 拨打电话
                $html = $('<div class="element free-vessel"><a href="tel:' + customFeature['phone-num'] + '"></a></div>');
                $container = $html.children('a');
                break;
            case 'refresh-page':
                // 刷新页面
                $html = $('<div class="element free-vessel refresh" data-type="page"></div>');
                $container = $html;
                break;
            case 'refresh-list':
                // 刷新列表
                $html = $('<div class="element free-vessel refresh" data-type="list" data-target="' + customFeature.refresh_object + '" data-index="' + customFeature.index_segment + '" data-value="' + customFeature.index_value + '"></div>');
                $container = $html;
                break;
            case 'goods-trade':
                // 跳转指定商品详情页
                $html = $('<div class="element free-vessel router js-to-detail" data-router="'+(customFeature['goods-type'] == 3 ? 'tostoreDetail':'goodsDetail')+'" data-id="' + customFeature['goods-id'] + '"></div>');
                $container = $html;
                break;
            case 'to-seckill':
                // 跳转指定秒杀商品
                $html = $('<div class="element free-vessel router js-to-detail" data-router="seckillDetail" data-id="' + customFeature['seckill-id'] + '"></div>');
                $container = $html;
                break;
            case 'to-franchisee':
                // 跳转指定商家
                $html = $('<div class="element free-vessel router js-to-detail" data-router="franchiseeDetail" data-id="' + customFeature['franchisee-id'] + '"></div>');
                $container = $html;
                break;
            case 'community':
                // 跳转社区版块
                $html = $('<div class="element free-vessel router js-to-detail" data-router="communityPage" data-id="' + customFeature['community-id'] + '"></div>');
                $container = $html;
                break;
            case 'get-coupon':
                // 跳转指定优惠券详情页
                $html = $('<div class="element free-vessel router js-to-detail" data-router="couponDetail" data-id="' + customFeature['coupon-id'] + '"></div>');
                $container = $html;
                break;
            case 'coupon-receive-list':
                // 跳转优惠券领取列表
                $html = $('<div class="element free-vessel router js-to-detail" data-router="couponReceiveListPage" ></div>');
                $container = $html;
                break;
            case 'recharge':
                // 储值金充值
                $html = $('<div class="element free-vessel router js-to-detail" data-router="recharge" ></div>');
                $container = $html;
                break;
            case 'transfer':
                // 跳转支付(当面付)页面
                $html = $('<div class="element free-vessel router js-to-detail" data-router="transferPay"></div>');
                $container = $html;
                break;
            case 'to-promotion':
                // 跳转推广页面
                $html = $('<div class="element free-vessel to-promotion"></div>');
                $container = $html;
                break;
            case 'lucky-wheel':
                // 跳转大转盘
                $html = $('<div class="element free-vessel router js-to-detail" data-router="luckyWheelDetail" ></div>');
                $container = $html;
                break;
            default:
                $html = $('<div class="element free-vessel"></div>');
                $container = $html;
          }

          $(eles).each(function(index, el) {
            var $addElement;
            if(dynamicData){
              switch (el.type) {
                case 'count-ele':
                  // 当列表中有计数组件时，需额外传rel_obj和计数
                  var relValue = dynamicData.form + '_' + dynamicData.id;
                  $addElement = APP.parseElement(el, { relValue: relValue, count_num: dynamicData.count_num, has_count: dynamicData.has_count }, true);
                  break;
                default:
                  $addElement = APP.parseElement(el, dynamicData, true);
              }
            } else {
              $addElement = APP.parseElement(el, null, true);
            }
            $container.append($addElement);
          });

          return $html;
        };
      }
    }

    function ListVesselEle() {
      var _listvessel = this,
      		is_count = 0;

      if (typeof this.parseElement != 'function') {
        _listvessel.index = 0;

        ListVesselEle.prototype.listInfos = {};
        ListVesselEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},
              vesselStyle = ele.style || {},
              listStyle = {},
              ifAutoheight = customFeature.vesselAutoheight == 1 ? true : false,
              srcollLoading = customFeature.vesselAutoheight == 1 && customFeature.loadingMethod == 0,
              mode = customFeature.mode,
          		listEles = ele.content || [],
              source = customFeature.source || 'none',
              $html = $('<div class="element list-vessel-wrap scroll-ele ' + (srcollLoading ? 'js-scroll-loading-ele ' : '') + (mode ? 'mode-'+mode : '') + '" data-id="' + customFeature.id + '" data-form="' + customFeature.form + '" data-type="list-vessel"><ul class="js-list-container clearfix"  data-list-index="' + _listvessel.index + '"></ul></div>');

          _listvessel.checkIfCount(listEles); // isCount赋值之前必须先checkIfCount
          isCount = is_count;
          customFeature.height ? vesselStyle.height = customFeature.height : vesselStyle.height = '300px';
          customFeature['background-color'] && (vesselStyle['background-color'] = customFeature['background-color']);
          customFeature['background-image'] && (vesselStyle['background-image'] = 'url(' + customFeature['background-image'] + ')');
          (customFeature.margin >= 0) && (listStyle['margin-bottom'] = customFeature.margin + 'px');
          customFeature.lineBackgroundColor && (listStyle['background-color'] = customFeature.lineBackgroundColor);
          customFeature.lineBackgroundImage && (listStyle['background-image'] = customFeature.lineBackgroundImage);
          ifAutoheight && (vesselStyle.height = 'auto');
          $html.css(vesselStyle);

          var listInfo = { form: customFeature.form, mode: mode, source: source, page: 1, is_count: isCount, listStyle: listStyle, listEles: listEles, link: customFeature.link };
          _listvessel.listInfos[_listvessel.index++] = listInfo;

          var param = { form: customFeature.form, page: 1, app_id: appId, is_count: isCount };
          if (source != 'none') {
              param.idx_arr = {
                  idx: 'category',
                  idx_value: source
              };
              param.search_id = 1;
          }

          var $container = $html.children('.js-list-container');
          $container.data('data-customFeature' , customFeature);
          _listvessel.getData($container, param, listInfo);

          if(customFeature.mode == 2){ //样式为横滑的时候
            _listvessel.bindHorScrollEvent($html);
          }else if(customFeature.vesselAutoheight == 1 && customFeature.loadingMethod == 1){ //点击加载的加载样式
            var load = '';
            if(customFeature.loadingStyle == 'img'){
              load = '<div class="loading-btn"><img src="'+customFeature.loadingImg+'" alt="" /></div>';
            }else if(customFeature.loadingStyle == 'text'){
              load = '<div class="loading-btn" style="color:'+customFeature.loadingColor+';">'+customFeature.loadingText+'</div>';
            }
            $html.append(load);
            _listvessel.bindLoadingEvent($html);
          }else{
            _listvessel.bindScrollEvent($html, srcollLoading);
          }

          return $html;
        };
        // 获取列表数据
        ListVesselEle.prototype.getData = function($container, param, listInfo) {
          $container.addClass('js-requesting');

          var customFeature = $container.data('data-customFeature');
          if(customFeature.vesselAutoheight == 1 && customFeature.loadingMethod == 1){
            param.page_size = customFeature.loadingNum || '20';
          }

          $ajax('/index.php?r=AppData/getFormDataList', 'get', param, 'json', function(data) {
            if (data.status == 0) {
              if (data.is_more == 0) {
                $container.addClass('js-no-more');
              }
              _listvessel.parseData($container, data.data, listInfo);
            } else {
              alertTip('请求数据失败，请重试。' + data.data);
            };
            $container.removeClass('js-requesting');
          }, function() {
            $container.removeClass('js-requesting');
            alertTip('请求数据失败，请重试');
          });
        };
        // $container: 新增数据的列表，data: 数据，listInfo: 列表项的信息
        ListVesselEle.prototype.parseData = function($container, data, listInfo) {
          $(data).each(function(index, item) {
            $container.append(_listvessel.parseSingleData(item, listInfo));
          });
        };
        ListVesselEle.prototype.parseSingleData = function(item, listInfo) {
          var $li = $('<li class="list-vessel clearfix background-ele ' + ((listInfo.link && listInfo.link !== '-1') ? 'router js-to-detail' : '') + '"' + ((listInfo.link && (listInfo.link === 'goodsDetail' || listInfo.link === 'waimaiDetail' || listInfo.link === 'tostoreDetail')) ? 'data-id="' + item.form_data.id + '"' : 'data-id="' + item.id + '"') + ' ' + ((listInfo.link && listInfo.link !== '-1') ? 'data-router="' + listInfo.link + '"' : '') + '></li>').css(listInfo.listStyle),
              formData = item['form_data'],
              $addElement;

          $(listInfo.listEles).each(function(index, el) {
            switch (el.type) {
              case 'count-ele':
                  // 当列表中有计数组件时，需额外传rel_obj和计数
                  var relValue = listInfo.form + '_' + item.id;
                  $addElement = APP.parseElement(el, { relValue: relValue, count_num: item.count_num, has_count: item.has_count });
                  break;
                  // case 'layout-vessel':
                  // case 'free-vessel':
                  // 	$addElement = APP.parseElement(el, formData);
                  // 	break;
              default:
                  // 	el.customFeature && el.customFeature.segment && (el.content = formData[el.customFeature.segment]);
                  $addElement = APP.parseElement(el, item);
            }
            $li.append($addElement);
          });
          return $li;
        };
        // 绑定点击请求数据
        _listvessel.bindLoadingEvent = function($target) {
          $target.on('click', '.loading-btn', function(event) {
            var $container = $target.children('.js-list-container');
            if($container.hasClass('js-no-more')){
              alertTip('已经加载到最后了');
            }
            if ($container.hasClass('js-no-more') || $container.hasClass('js-requesting')) {
              return;
            }

            _listvessel.getListData($container);
          });
        }
        // 绑定滚动请求数据
        ListVesselEle.prototype.bindScrollEvent = function($target, ifAutoheight) {
          if (ifAutoheight) {
            // 自适应高度的列表滚动加载绑定在window上
            return;
          } else {
            _listvessel.bindSelfScrollEvent($target);
          }
        };
        // 高度固定的列表的滚动加载
        ListVesselEle.prototype.bindSelfScrollEvent = function($target) {
          var triggerSpot = 50,
              $container = $target.children('.js-list-container');

          $target.on('scroll', function(event) {
            if ($container.hasClass('js-no-more') || $container.hasClass('js-requesting')) {
              return;
            }
            var ifRequest = $container.height() - ($target.height() + $target.scrollTop() * ratio) < triggerSpot;

            if (ifRequest) {
              _listvessel.getListData($container);
            }
          });
        };
        // 横滑的列表的滚动加载
        ListVesselEle.prototype.bindHorScrollEvent = function($target) {
          var triggerSpot = 50,
              $container = $target.children('.js-list-container');

          $target.on('scroll', function(event) {
            if ($container.hasClass('js-no-more') || $container.hasClass('js-requesting')) {
              return;
            }
            var ifRequest = $container.width() - ($target.width() + $target.scrollLeft() * ratio) < triggerSpot;

            if (ifRequest) {
              _listvessel.getListData($container);
            }
          });
        };
        // 自适应高度滚动获取列表数据时调用的函数
        ListVesselEle.prototype.getListData = function($container) {
          // $container.addClass('js-requesting');
          var index = $container.attr('data-list-index'),
              targetListInfo = _listvessel.listInfos[index],
              param = {
                app_id: appId,
                page: ++targetListInfo.page,
                form: targetListInfo.form,
                is_count: targetListInfo.is_count,
                sort_key: $container.parent('.list-vessel-wrap').data('sortkey'),
                sort_direction : $container.parent('.list-vessel-wrap').data('sortby')
              };

          if (targetListInfo.source != 'none') {
            param.idx_arr = {
              idx: 'category',
              idx_value: targetListInfo.source
            };
            param.search_id = 1;
          };
          if ($container.hasClass('js-search-mode')) {
            param.idx_arr = {
              idx: $container.attr('data-index'),
              idx_value: $container.attr('data-value')
     };


    };
          _listvessel.getData($container, param, targetListInfo);
        };
		//
        ListVesselEle.prototype.checkIfCount = function(eles) {
          for (var i = eles.length - 1; i >= 0; i--) {
          	var el = eles[i];

            if (is_count || el.type === 'count-ele') {
            	is_count = 1;
              return;
            }
            switch (el.type){
            	case 'free-vessel':
            	case 'static-vessel': _listvessel.checkIfCount(el.content);
            												break;
            	case 'layout-vessel': _listvessel.checkIfCount(el.content.leftEles);
            												_listvessel.checkIfCount(el.content.rightEles);
            												break;
            							 default: break;
            }
          };
        };

        ListVesselEle.prototype.refresh = function($list, index_segment, index_value, sort_key, sort_direction) {
          var $container = $list.children('.js-list-container'),
              index = $container.attr('data-list-index'),
              targetListInfo = _listvessel.listInfos[index],
              param = {
                app_id: appId,
                page: 1,
                form: targetListInfo.form,
                is_count: targetListInfo.is_count,
                idx_arr: {
                  idx: (targetListInfo.source != 'none') ? 'category' : index_segment,
                  idx_value: (targetListInfo.source != 'none') ? targetListInfo.source : index_value
                },
                sort_key: sort_key,
                sort_direction: sort_direction
              };

          if(targetListInfo.source != 'none'){
            param.search_id = 1;
          }
          targetListInfo.page = 1;
          $container.addClass('js-search-mode').attr('data-index', index_segment).attr('data-value', index_value).empty();
          _listvessel.getData($container, param, targetListInfo);
        }

        ListVesselEle.prototype.search = function(keyword,$list,form){
          console.log(keyword + ' ' + appId);
          var $container = $list.children('.js-list-container'),
              index = $container.attr('data-list-index'),
              targetListInfo = _listvessel.listInfos[index];

          targetListInfo.page = 1;
          $container.addClass('js-requesting');
          showLoading();
          $.ajax({
            url: '/index.php?r=appData/search&search={"data":[{"_allkey":"'+keyword+'","form": "'+form+'"}],"app_id":"'+appId+'"}',
            type: 'post',
            dataType: 'json',
            success: function(data) {
              if (data.is_more == 0) {
                $container.addClass('js-no-more');
              };
              removeLoading();
              if(data.data.length === 0){
                $("#searchPage .quick-tags").show();
                $list.children("ul").empty();
                alertTip("没有找到"+ keyword +"相关的数据！");
                return;
              }
              $("#searchPage .quick-tags").hide();
              $list.children("ul").empty();
              _listvessel.parseData($container,data.data,targetListInfo);
              $container.removeClass('js-requesting');
              $list.parent().show();
            },
            error:function(data){
              removeLoading();
              alertTip("请求出错"+data.data);
              console.log(data.data);
            }
          });
        }

        ListVesselEle.prototype.locationList = function(form, region_id, $list ){
          var $container = $list.children('.js-list-container'),
              index = $container.attr('data-list-index'),
              targetListInfo = _listvessel.listInfos[index];

          targetListInfo.page = 1;
          $container.addClass('js-requesting');
          showLoading();
          $.ajax({
            url: '/index.php?r=appData/GetFormDataList',
            type: 'post',
            dataType: 'json',
            data: {
              app_id: appId,
              form : form,
              idx_arr:{
                idx:'region_id',
                idx_value: region_id
              }
            },
            success: function(data) {
              console.log(data);
              removeLoading();
              if(data.data.length === 0){
                  $list.children("ul").empty();
                  alertTip("没有找到相关的数据！");
                  return;
              }
              $("#searchPage .quick-tags").hide();
              $list.children("ul").empty();
              _listvessel.parseData($container,data.data,targetListInfo);
              $container.removeClass('js-requesting');
              $list.parent().show();
            },
            error:function(data){
              removeLoading();
              alertTip("请求出错"+data.data);
              console.log(data.data);
            }
          });
        }
      };
      return 0;
    };

    function DynamicVesselEle() {
      var _dynamicvessel = this;

      if (typeof this.parseElement != 'function') {
        DynamicVesselEle.prototype.parseElement = function(ele) {
          if (!isEmptyObject(ele.customFeature)) {
            var customFeature = ele.customFeature || {},
                eles = ele.content,
                isCount = _dynamicvessel.checkIfCount(eles),
                param = {
                  app_id: appId,
                  form: customFeature.form,
                  is_count: isCount,
                  page: 1,
                  idx_arr: {
                    idx: customFeature.search_segment,
                    idx_value: customFeature.param_segment == 'id' ? GetQueryString('detail') : ((tempPageData && tempPageData.data) ? tempPageData.data[0].form_data[customFeature.param_segment] : '')
                  }
                },
                $html = $('<div class="element dynamic-vessel"></div>');

            _dynamicvessel.getVesselData(param, $html, ele);

            return $html;
          }
        };
        DynamicVesselEle.prototype.getVesselData = function(param, $target, ele) {
          var elements = ele.content;
          var vesselStyle = ele.style;
          $ajax('/index.php?r=AppData/getFormDataList', 'get', param, 'json', function(data) {
            if (data.status == 0) {
              var targetData = data.data;

              if (targetData.length) {
                for (var i = 0, j = targetData.length - 1; i <= j; i++) {
                  var formData = targetData[i];
                  var list = $('<div class="router js-to-detail" data-router="'+ ele.customFeature.link +'" data-id="'+ formData.form_data.id +'"></div>');
                  $(elements).each(function(index, element) {
                    $add = APP.parseElement(element, formData);
                    list.css(vesselStyle).append($add);
                  });
                  $target.append(list);
                }                
              } else {
                $(elements).each(function(index, element) {
                  $target.append(APP.parseElement(element));
                });
              }
            } else {
              alertTip('请求数据失败，' + data.data);
            };
          }, function() {
            alertTip('请求数据失败，请重试');
          });
        };
        DynamicVesselEle.prototype.checkIfCount = function(eles) {
          for (var i = eles.length - 1; i >= 0; i--) {
            if (eles[i].type === 'count-ele') {
              return 1;
            }
          };
          return 0;
        };
      }
    }

    function FormVesselEle() {
      var _formvessel = this;

      if (typeof this.parseElement != 'function') {
        FormVesselEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},
              eles = ele.content,
              $html = $('<div class="element form-vessel" data-form="' + customFeature.form + '"></div>'),
              form = formData[customFeature.form],
              segment, element;

          $(eles).each(function(index, ele) {
            $html.append(APP.parseElement(ele));
          });

          form = form ? form.field_arr : [];
          $html.find('.js-form-ele').each(function(index, ele) {
            element = $(ele);
            segment = element.attr('data-segment');
            segment && $.each(form, function(index, field) {
              if (segment === field.field) {
                field.necessary == 1 ? element.addClass('must') : element.removeClass('must');
              }
            });
          });
          return $html;
        };
      }
    };

    function GradeComponentEle() {
      var _gradecomponent = this;

      if (typeof this.parseElement != 'function') {
        GradeComponentEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},
              icon = customFeature.icon ? customFeature.icon : 'star',
              // must =  customFeature.ifMust && customFeature.ifMust !== 'false' ? 'must' : '',
              html = '<div class="element grade-ele js-form-ele ' + icon + '-icon-grade-ele '
              // +must
              + '" data-segment="' + customFeature.segment + '" data-type="' + ele.type + '"><div class="grade-wrap"><p class="grade"></p><p class="empty-grade"></p><p class="operate-p" data-grade="5"></p><p class="grade-span-wrap"><span></span><span></span><span></span><span></span><span></span></p></div></div>',
              $html = $(html);

          $html.on('click', '.grade-span-wrap span', function(event) {
            event.preventDefault();
            /* Act on the event */
            var index = $(this).index() + 1,
                width = (5 - index) * 20 + '%';
            $(this).parent().siblings('.operate-p').css('width', width).attr('data-grade', index);
          });

          return $html;
        };
        GradeComponentEle.prototype.getValue = function($ele) {
          var value = $ele.find('.operate-p').attr('data-grade');
          return value;
        };
      }
    };

    function SelectEle() {
      var _select = this;

      if (typeof this.parseElement != 'function') {
        SelectEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},
              maxSelected = customFeature.selectAmount ? customFeature.selectAmount : 1,
              selectType = maxSelected > 1 ? 'checkbox' : 'radio',
              content = ele.content,
              // must = customFeature.ifMust && customFeature.ifMust !== 'false' ? 'must' : '',
              segmentStr = customFeature.segment ? 'data-segment="' + customFeature.segment + '"' : '',
              secTittleStyle = parseSecFontStyle(customFeature),
              html = '<div class="element select-ele js-form-ele '
              // +must
              + '" ' + segmentStr + ' data-type="' + ele.type + '"></div>',
              $container = $('<ul class="select-container"></ul>'),
              $title = $('<p class="title">' + content.title + '</p>'),
              flag = (Math.random()).toString().substring(2,17),
              $html = $(html);

          secTittleStyle && $title.css(secTittleStyle);
          $container.append($title);
          $(content.lists).each(function(index, el) {
            var list = '<li><label class="select-content">' + el + '</label><span class="select-span '+(selectType == 'radio' ? 'select-radio' : 'select-checkbox')+'"><input class="select-target" type="' + selectType + '" name="zhichi' + flag + '"><label class="icon-gou"></label></span></li>';
            $container.append(list);
          });
          $html.append($container);

          $html.on('click', 'input[type="checkbox"]', function(e) {
            var selecteds = $(this).closest('ul').find('input:checked').length;
            if (selecteds > maxSelected) {
                $(this).prop('checked', false);
            }
          }).on('click', 'label', function(event) {
            // 点击文本时 对应input也要选中／取消选中
            var $input = $(this).siblings('input'),
                checked = $input.prop('checked'),
                selecteds;
            if (maxSelected > 1) {
              selecteds = $(this).closest('ul').find('input:checked').length;
              if (checked) {
                $input.prop('checked', false);
              } else {
                if (selecteds < maxSelected) {
                  $input.prop('checked', true);
                }
              }
            } else {
              if (!checked) {
                $input.prop('checked', true);
              }
            }
          });
          return $html;
        };
        SelectEle.prototype.getValue = function($ele) {
          var $selects = $ele.find('.select-target:checked'),
              length = $selects.length,
              value = '';

          if (length > 1) {
            for (var i = 0; i < length; i++) {
              value += $selects.eq(i).closest('li').find('.select-content').text() + (i === 0 ? '' : ', ');
            };
          } else {
            if (length <= 0) {
              if ($ele.hasClass('must')) {
                value = -1;
                alertTip('请选择相应选项');
              }
            } else {
              value = $selects.closest('li').find('.select-content').text();
            }
          }
          return value;
        };
      }
    };

    function InputEle() {
      var _input = this;

      if (typeof this.parseElement != 'function') {
        InputEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},
              // must = customFeature.ifMust && customFeature.ifMust !== 'false' ? 'must' : '',
              segmentStr = customFeature.segment ? 'data-segment="' + customFeature.segment + '"' : '',
              placeholder = customFeature.placeholder ? customFeature.placeholder : '',
              html = '<div class="element input-ele js-form-ele '
              // +must
              + '" ' + segmentStr + ' data-type="' + ele.type + '"><input type="text" placeholder="' + placeholder + '"></div>',
              $html = $(html);

          return $html;
        };
        InputEle.prototype.getValue = function($ele) {
          var $input = $ele.find('input'),
              value = $input.val();

          if (!value && $ele.hasClass('must')) {
            value = -1;
            alertTip('请按要求输入对应项');
            $input.focus();
          }
          return value;
        };
      }
    };

    function TextareaEle() {
      var _textarea = this;

      if (typeof this.parseElement != 'function') {
        TextareaEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},
              // must = customFeature.ifMust && customFeature.ifMust !== 'false' ? 'must' : '',
              segmentStr = customFeature.segment ? 'data-segment="' + customFeature.segment + '"' : '',
              placeholder = customFeature.placeholder ? customFeature.placeholder : '',
              html = '<div class="element textarea-ele js-form-ele '
              // +must
              + '" ' + segmentStr + ' data-type="' + ele.type + '"><textarea placeholder="' + placeholder + '"></textarea></div>',
              $html = $(html);

          return $html;
        };
        TextareaEle.prototype.getValue = function($ele) {
          var $input = $ele.find('textarea'),
              value = $input.val();
          if (!value && $ele.hasClass('must')) {
            value = -1;
            alertTip('请按要求输入对应项');
            $input.focus();
          }
          return value;
        };
      }
    };

    function UploadImgEle() {
      var _uploadimg = this;

      if (typeof this.parseElement != 'function') {
        UploadImgEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},
              // must = customFeature.ifMust && customFeature.ifMust !== 'false' ? 'must' : '',
              segmentStr = customFeature.segment ? 'data-segment="' + customFeature.segment + '"' : '',
              content = ele.content ? '<img src="' + ele.content + '"/>' : '+'
              html = '<div class="element upload-img js-form-ele '
              // +must
              + '" ' + segmentStr + ' data-type="' + ele.type + '"><div class="plus-div">'+content+'<input type="file" class="img-upload-input" accept="image/jpg,image/jpeg, image/gif, image/bmp, image/jp2, image/x-ms-bmp, image/x-png"></div></div>',
              $html = $(html);

          $html.on('click', function(event) {
            var _this = $(this);
            	initUpload = _this.find('.plus-div');
            initUpload.imgUpload(function(url) {
            	var _img_span = $('<span class="showUploadImg"><span class="deleteUploadImg">-</span><img class="hasUploadImg" src="'+url+'" alt="" /></span>');
		          _this.find('.plus-div').parent().prepend(_img_span);
      		    _img_span.on('click', '.deleteUploadImg', function(e){
        		    $(this).closest('.showUploadImg').remove();
          		})
          		if (_this.find('.hasUploadImg').length == 9) {
          		  _this.addClass('js-uploaded');
          		}
            });
          });
          return $html;
        };
        UploadImgEle.prototype.getValue = function($ele) {

          var value = [];
          if (!$ele.find('.hasUploadImg').length && $ele.hasClass('must')) {
            alertTip('请上传图片');
          }
          $.each($ele.find('.hasUploadImg'), function(index, val) {
        		value.push($(val).attr('src'));
        	});
          if (value.length == 0 && $ele.hasClass('must')) {
            value = -1
          }
          return value;
        };
      }
    };

    function TimeEle() {
      var _time = this;

      if (typeof this.parseElement != 'function') {
        TimeEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},
              // must = customFeature.ifMust && customFeature.ifMust !== 'false' ? 'must' : '',
              segmentStr = customFeature.segment ? 'data-segment="' + customFeature.segment + '"' : '',
              html = '<div class="element time-ele js-form-ele '
              // +must
              + '" ' + segmentStr + ' data-type="' + ele.type + '"><div class="laydate-icon" onclick="laydate({istime: true, format: '+(customFeature.ifAllDay ? ' \'YYYY-MM-DD\'' : ' \'YYYY-MM-DD hh:mm:ss\'' )+'})">'+(customFeature.ifAllDay ? '2017-01-01' : '2017-01-01 00:00:00')+'</div></div>',
              $html = $(html);

          return $html;
        };
        TimeEle.prototype.getValue = function($ele) {
          var value = $ele.find('.laydate-icon').text();
          if (!value && $ele.hasClass('must')) {
            value = -1;
            alertTip('请选择时间');
          }
          return value;
        };
      }
    };

    function BbsEle() {
      var _bbs = this;

      if (typeof this.parseElement != 'function') {
        BbsEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},
              icon = customFeature.mode === 1 ? '' : '<p class="comment-amount-p"><span class="ca-span icon-bubble" style="color:'+customFeature.themeColor+';"><span class="ca-span-num bbs-comment-count">0</span></span>条评论</p>',
              count_span = customFeature.mode === 1 ? '<p class="lately-comment-p"><i style="background-color:'+customFeature.themeColor+';"></i>最近评论（<span class="bbs-comment-count">0</span>）</p>' : '',
              cl = customFeature.mode === 1 ? 'bbs-mode1' : '',
              btnStyle = customFeature.mode === 1 ? '' : 'background-color:'+customFeature.themeColor+';',
              text = customFeature.mode === 1 ? '' : '<span class="upload-text">添加图片</span>',
              html = '<div class="element bbs js-scroll-loading-ele '+ cl +'" data-type="bbs">' + icon + '<div class="comment-box"><div class="input-wrap"><textarea placeholder="我也来说几句..."></textarea></div>' + '<div class="comment-operate-wrap"><span class="comment-btn" style="'+btnStyle+'">发布</span><span class="upload-wrap icon-pic">' + '<img><span class="delete-img icon-delete"></span><input type="file" class="img-upload-input" accept="image/jpg,image/jpeg, image/gif, image/bmp, image/jp2, image/x-ms-bmp, image/x-png"></span>'+ text + '</div></div>' + count_span +'</div>',
              $html = $(html),
              relValue = customFeature.ifBindPage && customFeature.ifBindPage !== 'false' ? relObj : appId,
              ifLike = customFeature.ifLike && customFeature.ifLike !== 'false' ? 1 : 0,
              bbsContainer = '<ul class="comment-container js-list-container" data-page="1" data-rel="' + relValue + '" data-like="' + ifLike + '"><div class="comment-box reply-comment-box"><div class="input-wrap"><textarea placeholder="我也来说几句..."></textarea></div>' + '<div class="comment-operate-wrap"><span class="comment-btn reply-comment-btn" style="'+btnStyle+'">发布</span><span class="upload-wrap icon-pic">' + '<img><span class="delete-img icon-delete"></span><input type="file" class="img-upload-input" accept="image/jpg,image/jpeg, image/gif, image/bmp, image/jp2, image/x-ms-bmp, image/x-png"></span>'+text+'</div></div></ul>',
              $bbsContainer = $(bbsContainer);

          _bbs.getListData($bbsContainer);
          $html.append($bbsContainer);
          return $html;
        };
        BbsEle.prototype.getListData = function($container) {
          var page = +$container.attr('data-page'),
              relValue = $container.attr('data-rel'),
              ifLike = $container.attr('data-Like'),
              param = { form: 'bbs', page: page, app_id: appId, is_count: ifLike, idx_arr: { idx: 'rel_obj', idx_value: relValue } };
          if($container.hasClass('js-requesting')){
            return ;
          }
          $container.addClass('js-requesting');

          $ajax('/index.php?r=AppData/getFormDataList', 'get', param, 'json', function(data) {
            if (data.status === 0) {
              if (data.is_more === 0) {
                $container.addClass('js-no-more');
              }
              var targetData = data.data;
              $container.append(_bbs.parseData(targetData));
              if (!$container.hasClass('js-initial')) {
                $container.addClass('js-initial');
                $container.parent().find('.bbs-comment-count').text(data.count);
              }

              $container.attr('data-page', page + 1);
            } else {
              alertTip('请求评论数据失败，请重试。' + data.data);
            };
            $container.removeClass('js-requesting');
          }, function() {
            alertTip('请求评论数据失败，请重试');
            $container.removeClass('js-requesting');
          });
        };
        BbsEle.prototype.parseData = function(dataArr) {
          if (dataArr.length) {
            var html = '';
            $(dataArr).each(function(index, data) {
                html += _bbs.parseSingleData(data);
            });
            return html;
          } else {
            return '<div class="empty-tip"><img src="'+cdnUrl+'/static/webapp/images/none.png" alt="" /><p>快来抢沙发吧</p></div>';
          }
        };
        BbsEle.prototype.parseSingleData = function(fullData) {
          var data = fullData.form_data,
              content = data.content,
              cover = data.cover_thumb ? data.cover_thumb : DEFAULTPHOTO,
              reply = _bbs.parseReply(content.reply),
              contentImg = content.img ? '<img class="comment-img" src="' + content.img + '">' : '',
              likeStr = fullData.count_num >= 0 ? '<span class="bbs-content-btn icon-heart js-count-ele ' + (fullData.has_count == 1 && 'active') + '" data-rel="bbs_' + fullData.id + '"><span class="js-count-value">' + fullData.count_num + '</span></span>' : '',
              comment = '<li class="comment" data-user-token="'+(data.user_token||'')+'"><div><img class="cover-img" src="' + cover + '"><div class="nickname-wrap"><span class="nickname">' + data.nickname + '</span><span class="add-time">' + content.addTime + '</span></div>'+likeStr+'<span class="bbs-content-btn icon-reply comment-reply-btn">回复</span></div><div class="comment-content">' + reply + '<span class="js-comment-text">' + decodeURIComponent(content.text) + '</span>' + contentImg + '</div></li>';

          return comment;
        };
        // 渲染评论里的回复
        BbsEle.prototype.parseReply = function(reply) {
          if (reply) {
            var str = '<a class="replied-a">@'+reply.nickname+'</a>'
            return str;
          }else{
            return '';
          }
        };
        BbsEle.prototype.decodeComment = function($targetLi) {
          var $content = $targetLi.children('.comment-content'),
              $img = $content.children('.comment-img'),
              $replied = $content.children('.replied-box'),
              reply = {
                nickname: $targetLi.find('.nickname').text(),
                text: encodeURIComponent($content.children('.js-comment-text').text()),
                user_token: $targetLi.attr('data-user-token')
              };

          $img.length && (reply.img = $img.attr('src'));
          $replied.length && (reply.reply = _bbs.decodeReplied($replied)); // 回复的对象里还有回复的话

          return reply;
        };
        BbsEle.prototype.decodeReplied = function($replied) {
          var $img = $replied.children('.comment-img'),
              $innerReplied = $replied.children('.replied-box'),
              reply = {
                nickname: $replied.children('.nickname').text(),
                text: encodeURIComponent($replied.children('.js-comment-text').text()),
                user_token: $replied.attr('data-user-token')
              };

          $img.length && (reply.img = $img.attr('src'));
          if ($innerReplied.length) {
				reply.reply = arguments.callee($innerReplied);
          }

          return reply;
        }
        BbsEle.prototype.addComment = function($btn) {
          if ($btn.hasClass('js-posting')) {
              return;
          }
          var $textarea = $btn.parent().siblings('.input-wrap').find('textarea'),
              comment = encodeURIComponent($textarea.val());

          if (comment.length) {
            var $commentBox = $btn.parent().parent(),
                $upload = $btn.siblings('.upload-wrap'),
                img = $upload.attr('img_url'),
                $container,
                user_token = $('body').attr('data-user-token'),
                page_router = GetQueryString('router'),
                content = {
                  text: comment,
                  addTime: getTimeStr() // 这个字段暂时保留，因为添加时间也可以用这条回复后台记录的时间，可以不手动保存
                };

            img && (content.img = img);
            if ($commentBox.hasClass('reply-comment-box')) {
              // 此时是回复评论
              var $targetLi = $commentBox.prev(),
                  reply = _bbs.decodeComment($targetLi);

              content.reply = reply;
              $container = $btn.parent().parent().parent();
            } else {
              $container = $btn.parent().parent().siblings('.comment-container');
            }

            var form_data = {
                  nickname: $('body').attr('data-nickname'),
                  cover_thumb: $('body').attr('data-cover'),
                  content: content,
                  user_token: user_token,
                  rel_obj: $container.attr('data-rel'),
                  page_url: page_router
                },
                param = {
                  app_id: appId,
                  form: 'bbs',
                  form_data: form_data,
                };

            $btn.addClass('js-posting')
            $ajax('/index.php?r=AppData/addData', 'post', param, 'json', function(data) {
              if (data.status == 0) {
                alertTip('发布成功');

                var $emptyTip = $container.find('.empty-tip'),
                    $count = $container.parent().find('.bbs-comment-count'),
                    count = +$count.text() + 1,
                    fullData = { form_data: form_data, id: data.data },
                    ifLike = +$container.attr('data-like');

                $count.text(count);
                $emptyTip.length && $emptyTip.remove();
                if (ifLike == 1) {
                  fullData.has_count = 0;
                  fullData.count_num = 0;
                }
                $container.prepend(_bbs.parseSingleData(fullData));
                $textarea.val('');
                $upload.attr('img_url', '').find('img').attr('src', '');
                $upload.children('.delete-img').hide();
                // form_data = $textarea = $upload = null;
                 if ($commentBox.hasClass('reply-comment-box')) {
                  $commentBox.removeClass('zShow');
                 }
              } else {
                alertTip('发布失败，请重试。' + data.data);
              };
              $btn.removeClass('js-posting');
            }, function() {
              $btn.removeClass('js-posting');
              alertTip('发布失败，请重试');
            });
          } else {
            alertTip('请输入评论');
            $textarea.focus();
          }
        };
        // bbs组件输入框获得焦点时
        BbsEle.prototype.setReply = function($comment) {
          var $commentReplyBox = $comment.siblings('.reply-comment-box');
          $commentReplyBox.addClass('zShow');
          $comment.after($commentReplyBox);
          $commentReplyBox.find('textarea').focus();
        };
      }
    }

    function CountEle() {
      var _count = this;

      if (typeof this.parseElement != 'function') {
        CountEle.prototype.parseElement = function(ele, countInfo) {
          var customFeature = ele.customFeature || {},
              ifAutoCount = customFeature.ifAutoCount,
              relValue = countInfo ? countInfo.relValue : (customFeature && customFeature.ifBindPage && customFeature.ifBindPage !== 'false' ? relObj : appId),
              tip = ele.content ? ('<span class="count-tip">' + ele.content + '</span>') : '',
              icon = customFeature.icon ? customFeature.icon : 'love-icon',
              icon_size = customFeature.size ? customFeature.size : null,
              _relValue = ifAutoCount ? relValue + '_view' : relValue,
              _class = ifAutoCount ? '' : 'js-count-ele',
              _showIcon = customFeature.showicon
              $html = $(_count.parseHtml(_relValue, tip, icon, _class, icon_size, _showIcon));

          if (countInfo) {
            _count.setCount($html, countInfo.count_num, countInfo.has_count);
          } else {
            _count.getCurValue(_relValue, $html, ifAutoCount);
          }

          return $html;
        };
	CountEle.prototype.getCurValue = function(obj_rel, $count, ifAutoCount){
	  $ajax('/index.php?r=AppData/getCount', 'get', {obj_rel: obj_rel, app_id: appId}, 'json', function(data){
            if (data.status == 0) {
                var info = data.data,
                    count_num = info.count_num,
                    has_count = info.has_count;

                if (ifAutoCount) {
                    // count_num += 1,
                    has_count = 0;
                    _count.addCount($count);
                }
                _count.setCount($count, count_num, has_count);
            } else {
                alertTip('请求计数数据失败，请重试。' + data.data);
            };
          }, function() {
            alertTip('请求计数数据失败，请重试');
          });
        };
        CountEle.prototype.parseHtml = function(relValue, tip, icon, ifAutoClass, icon_size, showicon) {
          var sizeHtml = icon_size ? 'style="width:' + icon_size + ';height:' + icon_size + ';"' : '',
              html = '<div class="element count-ele ' + ifAutoClass + '" data-rel="' + relValue + '"><span class="'+(showicon ? 'count-icon' : '')+'" data-icon="' + (showicon ? icon : '')+ '" ' + sizeHtml + '></span>' + tip + '<span class="js-count-value">0</span></div>';

          return html;
        };
        CountEle.prototype.setCount = function($count, count_num, has_count) {
          $count.find('.js-count-value').text(count_num);
          if (has_count == 1) {
            $count.addClass('active');
          }
        }
        CountEle.prototype.addCount = function($target) {
          var relValue = $target.attr('data-rel'),
              ifDel = $target.hasClass('active'),
              url = ifDel ? '/index.php?r=AppData/delCount' : '/index.php?r=AppData/addCount';

          $target.addClass('js-posting');
			    $ajax(url, 'get', {obj_rel: relValue, app_id: appId}, 'json', function(data){
				    if(data.status == 0){
              var $value = $target.find('.js-count-value'),
                  value = +$value.text();

              if (ifDel) {
                value--;
              } else {
                value++;
              }
              $target.toggleClass('active');
              $value.text(value);
            } else {
              alertTip('操作失败，请重试。' + data.data);
            };
            $target.removeClass('js-posting');
          }, function() {
            alertTip('操作失败，请重试');
            $target.removeClass('js-posting');
          });
        };
      }
    };

    function UserCenterEle() {
      var _usercenter = this;

      if (typeof this.parseElement != 'function') {
        UserCenterEle.prototype.parseElement = function(ele) {
          var coverStr = $('body').attr('data-cover') || DEFAULTPHOTO,
              nicknamestr = $('body').attr('data-nickname') || '请先登录',
              appendComponentHtml = '',
              showHtml,
              style = ele.style || {},
              topSectionStyle = ele.customFeature.topSectionStyle || {
                  'background-image': 'url('+cdnUrl+'/static/webapp/images/top_bg.jpg)',
                  'background-color': ''
              },
              appendComponent = ele.customFeature.appendComponent || {
                  'myAddress': true ,
                  'myOrder': true ,
                  'shoppingCart': true
              },
              appendComponentAttr = ele.customFeature.appendComponentAttr,
              mode = ele.customFeature.mode || 1;

              // 根据ele.customFeature.appendComponent设置入口列表
          if (appendComponent) {
            $.each(appendComponent, function(entryIndex, entry){
              if (entry == true) {
                switch(entryIndex){
                  case 'myAddress':
                      appendComponentHtml += '<div class="router" data-router="myAddress"><p class="icon-location"></p>收货地址<span class="ico-arrow icon-arrow-right"></span></div>';
                      break;
                  case 'myOrder':
                      appendComponentHtml += '<div class="router" data-router="myOrder"><p class="icon-notebook"></p>我的订单<span class="ico-arrow icon-arrow-right" ></span></div>';
                      break;
                  case 'shoppingCart':
                      appendComponentHtml += '<div class="router" data-router="shoppingCart" ><p class="icon-shoppingcart"></p>购物车<span class="ico-arrow icon-arrow-right" ></span></div>';
                      break;
                  case 'myMessage':
                      appendComponentHtml += '<div class="router" data-router="myMessage" ><p class="icon-notify"></p>系统通知<span class="ico-arrow icon-arrow-right" ></span></div>';
                      break;
                  case 'vipCard':
                      appendComponentHtml += '<div class="router" data-router="vipCard" ><p class="icon-vip-card"></p>会员卡<span class="ico-arrow icon-arrow-right" ></span></div>';
                      break;
                  case 'coupon':
                      appendComponentHtml += '<div class="router" data-router="couponList" ><p class="icon-coupon"></p>优惠券<span class="ico-arrow icon-arrow-right" ></span></div>';
                      break;
                  case 'myIntegral':
                      appendComponentHtml += '<div class="router" data-router="myIntegral" ><p class="icon-integral"></p>积分<span class="ico-arrow icon-arrow-right" ></span></div>';
                      break;
                  case 'balance':
                      appendComponentHtml += '<div class="router" data-router="balance" ><p class="icon-balance"></p>储值金<span class="ico-arrow icon-arrow-right" ></span></div>';
                      break;
                  case 'myGroup':
                      appendComponentHtml += '<div class="router" data-router="myGroup" ><p class="icon-group-buy"></p>我的拼团<span class="ico-arrow icon-arrow-right" ></span></div>';
                      break;
                  case 'winningRecord':
                      appendComponentHtml += '<div class="router" data-router="winningRecord" ><p class="icon-winningRecord"></p>中奖记录<span class="ico-arrow icon-arrow-right" ></span></div>';
                      break;
                }
              }
            })
          }
          // 根据mode加入对应的样式的html
          switch(mode) {
            case 0:
                showHtml = '<div class="user-center background-ele"><div class="show-div"><span class="empty-span"></span><img class="cover-thumb" src="'
                    + coverStr + '"><span class="nickname">'
                    + nicknamestr + '</span><span class="icon-rightarrow"></span></div><div class="horizontal-div"><div class="horizontal-router-container">'
                    + appendComponentHtml + '</div></div>';
                break;
            case 1:
                showHtml = '<div class="user-center usercenter-mode1 background-ele"><div class="show-div"><span class="empty-span"></span><img class="cover-thumb" src="'
                    + coverStr + '"><span class="nickname">'
                    + nicknamestr + '</span><span class="icon-rightarrow"></span></div><div class="horizontal-div"><div class="horizontal-router-container1">'
                    + appendComponentHtml + '</div></div>';
                break;
          }
          $html = $( showHtml );

          // if(!style['background-color']){
          //  $html.css('background-image', 'url('+cdnUrl+'/static/webapp/images/top_bg.jpg)');
          // }
          //处理个人中心顶部部分背景
          if(topSectionStyle['background-image']){
            $html.find('.show-div').css('background-image', topSectionStyle['background-image']);
          } else if(topSectionStyle['background-color']){
            $html.find('.show-div').css('background-color', topSectionStyle['background-color']);
          } else {
            $html.find('.show-div').css('background-image', 'url('+cdnUrl+'/static/webapp/images/top_bg.jpg)');
          }
          // 处理个人中心添加项的上间距
          if(appendComponentAttr){
            for(var item in appendComponentAttr) {
              $html.find('.router[data-router=' + item + ']').css('margin-top', appendComponentAttr[item]['margin-top']);
            }
          }
          if (ele.customFeature) {
            ele.customFeature['with-horizontal'] && $html.addClass('with-horizontal-div');
          }
          // 处理旧数据，如果没有ele.customFeature.appendComponent的值时，高度应默认为235px
          if (!ele.customFeature.appendComponent) {
            $html.addClass('old-data-deal');
          }

          $html.on('click', '.show-div', function(event) {
            event.preventDefault();
            APP.turnToPage({
                router: 'userCenterPage'
            });
          });
          return $html;
        };

        UserCenterEle.prototype.setLogin = function(data) {
          var userCenter = $('.user-center');

          userCenter.find('.cover-thumb').attr('src', data.cover_thumb);
          userCenter.find('.nickname').text(data.nickname);
        };
      }
    }


    function LayoutVesselEle() {
      var _layoutvessel = this;

      if (typeof this.parseElement != 'function') {
        LayoutVesselEle.prototype.parseElement = function(ele, dynamicData) {
          var customFeature = ele.customFeature || {},
              cellWidth = customFeature.cellWidth || 50,
              CellBorderStyle = customFeature.CellBorderStyle,
              CellBorderWidth = customFeature.CellBorderWidth,
              CellBorderColor = customFeature.CellBorderColor,
              rightCellStyle = {},
              eles = (ele.content || {}),
              leftEles = eles && eles.leftEles ? eles.leftEles : false,
              rightEles = eles && eles.rightEles ? eles.rightEles : false,
              $leftEles = $('<div class="cell"></div>'),
              $rightEles = $('<div class="cell border-cell"></div>'),
              $html,
              $container;

          switch (customFeature.action) {
            case 'none':
                $html = $('<div class="element layout-vessel clearfix"></div>');
                $container = $html;
                break;
            case 'inner-link':
                // 页面跳转
                $html = $('<div class="element layout-vessel clearfix router" data-router="' + (customFeature['inner-page-link'] || customFeature['page-link']) + '"></div>');
                $container = $html;
                break;
            case 'custom-link':
                // 外部链接
                $html = $('<div class="element layout-vessel clearfix"><a href="' + clearWeixinHash(customFeature['custom-page-link'] || customFeature['page-link']) + '" target="_blank"></a></div>');
                // $container = $html.children('a');
                $container = $html;
            case 'weiye':
                // 微页
                $html = $('<div class="element layout-vessel clearfix"><a href="' + (customFeature['weiye-link'] || customFeature['page-link']) + '" target="_blank"></a></div>');
                // $container = $html.children('a');
                $container = $html;
                break;
            case 'call':
                // 拨打电话
                $html = $('<div class="element layout-vessel clearfix"><a href="tel:' + customFeature['phone-num'] + '"></a></div>');
                // $container = $html.children('a');
                $container = $html;
                break;
            case 'refresh-page':
                // 刷新页面
                $html = $('<div class="element layout-vessel clearfix refresh" data-type="page"></div>');
                $container = $html;
                break;
            case 'refresh-list':
                // 刷新列表
                $html = $('<div class="element layout-vessel clearfix refresh" data-type="list" data-target="' + customFeature.refresh_object + '" data-index="' + customFeature.index_segment + '" data-value="' + customFeature.index_value + '"></div>');
                $container = $html;
                break;
            case 'goods-trade':
                // 跳转指定商品详情页
                $html = $('<div class="element layout-vessel clearfix router js-to-detail" data-router="'+(customFeature['goods-type'] == 3 ? 'tostoreDetail':'goodsDetail')+'" data-id="' + customFeature['goods-id'] + '"></div>');
                $container = $html;
                break;
            case 'to-seckill':
                // 跳转指定秒杀商品
                $html = $('<div class="element layout-vessel clearfix router js-to-detail" data-router="seckillDetail" data-id="' + customFeature['seckill-id'] + '"></div>');
                $container = $html;
                break;
            case 'to-franchisee':
                // 跳转指定商家
                $html = $('<div class="element layout-vessel clearfix router js-to-detail" data-router="franchiseeDetail" data-id="' + customFeature['franchisee-id'] + '"></div>');
                $container = $html;
                break;
            case 'community':
                // 跳转社区版块
                $html = $('<div class="element layout-vessel clearfix router js-to-detail" data-router="communityPage" data-id="' + customFeature['community-id'] + '"></div>');
                $container = $html;
                break;
            case 'get-coupon':
                // 跳转指定优惠券详情页
                $html = $('<div class="element layout-vessel clearfix router js-to-detail" data-router="couponDetail" data-id="' + customFeature['coupon-id'] + '"></div>');
                $container = $html;
                break;
            case 'coupon-receive-list':
                // 跳转优惠券领取列表
                $html = $('<div class="element layout-vessel clearfix router js-to-detail" data-router="couponReceiveListPage" ></div>');
                $container = $html;
                break;
            case 'recharge':
                // 储值金充值
                $html = $('<div class="element layout-vessel clearfix router js-to-detail" data-router="recharge" ></div>');
                $container = $html;
                break;
            case 'transfer':
                // 跳转支付(当面付)页面
                $html = $('<div class="element layout-vessel clearfix router js-to-detail" data-router="transferPay"></div>');
                $container = $html;
                break;
            case 'to-promotion':
                // 跳转推广页面
                $html = $('<div class="element layout-vessel clearfix to-promotion"></div>');
                $container = $html;
                break;
            case 'lucky-wheel':
                // 跳转大转盘
                $html = $('<div class="element layout-vessel clearfix router js-to-detail" data-router="luckyWheelDetail" ></div>');
                $container = $html;
                break;
            default:
                $html = $('<div class="element layout-vessel clearfix"></div>');
                $container = $html;
          }

          $leftEles.css('width', cellWidth + '%');
          rightCellStyle['width'] = 100 - cellWidth + '%';
          // }
          if (CellBorderStyle) {
            rightCellStyle['border-left-style'] = CellBorderStyle;
          }
          if (CellBorderWidth) {
            rightCellStyle['border-left-width'] = CellBorderWidth;
          }
          if (CellBorderColor) {
            rightCellStyle['border-color'] = CellBorderColor;
          }
          rightCellStyle && $rightEles.css(rightCellStyle);

          leftEles && $(leftEles).each(function(index, el) {
            var $addElement;
            if(dynamicData){
              switch (el.type) {
                case 'count-ele':
                  // 当列表中有计数组件时，需额外传rel_obj和计数
                  var relValue = dynamicData.form + '_' + dynamicData.id;
                  $addElement = APP.parseElement(el, { relValue: relValue, count_num: dynamicData.count_num, has_count: dynamicData.has_count });
                  break;
                default:
                  $addElement = APP.parseElement(el, dynamicData);
              }
            } else {
              $addElement = APP.parseElement(el);
            }

            $leftEles.append($addElement);
          });

          rightEles && $(rightEles).each(function(index, el) {
            var $addElement;
            if(dynamicData){
              switch (el.type) {
                case 'count-ele':
                  var relValue = dynamicData.form + '_' + dynamicData.id;
                  $addElement = APP.parseElement(el, { relValue: relValue, count_num: dynamicData.count_num, has_count: dynamicData.has_count });
                  break;
                default:
                  $addElement = APP.parseElement(el, dynamicData);
              }
            } else {
              $addElement = APP.parseElement(el);
            }

            $rightEles.append($addElement);
          });

          if (leftEles.length || rightEles.length) {
            $container.css('min-height', 0);
          } else {
            $container.css('min-height', '45px');
          }
          $container.append($leftEles).append($rightEles);

          return $html;
        };
      }
    };

    function ClassifyEle() {
      var _classify = this;

      if (typeof this.parseElement != 'function') {
        ClassifyEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},
              content = ele.content,
              mode = customFeature.mode ? customFeature.mode : 0,
              color = customFeature.selectedColor ? customFeature.selectedColor : 'nope',
              selected = customFeature.selected || '-1',
              $html = $('<div class="element classify" mode="' + mode + '" data-color="' + color + '" data-index="' + selected + '"></div>'),
              style = ele.style,
              containerHeight = style && style.height ? 'style="height:' + (parseInt(style.height) + 15) + 'px;"' : '',
              $container = $('<ul ' + containerHeight + '></ul>');

          $(content).each(function(index, el) {
              var itemCustomFeature = el.customFeature || {},
                  $item;

              switch (itemCustomFeature.action) {
                  case 'none':
                      $item = $('<li class="item"><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  case 'inner-link':
                      // 页面跳转
                      $item = $('<li class="item router" data-router="' + (itemCustomFeature['inner-page-link'] || itemCustomFeature['page-link']) + '"><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  case 'custom-link':
                      // 外部链接
                      $item = $('<li class="item"><a href="' + clearWeixinHash(itemCustomFeature['custom-page-link'] || itemCustomFeature['page-link']) + '" target="_blank"><span>' + el.text + '</span><i class="underline"></i></a></li>');
                      break;
                  case 'weiye':
                      // 微页
                      $item = $('<li class="item"><a href="' + (itemCustomFeature['weiye-link'] || itemCustomFeature['page-link']) + '" target="_blank"><span>' + el.text + '</span><i class="underline"></i></a></li>');
                      break;
                  case 'call':
                      // 拨打电话
                      $item = $('<li class="item"><a href="tel:' + itemCustomFeature['phone-num'] + '"><span>' + el.text + '</span><i class="underline"></i></a></li>');
                      break;
                  case 'refresh-page':
                      // 刷新页面
                      $item = $('<li class="item refresh" data-type="page"><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  case 'refresh-list':
                      // 刷新列表
                      $item = $('<li class="item refresh" data-type="list" data-target="' + itemCustomFeature.refresh_object + '" data-index="' + itemCustomFeature.index_segment + '" data-value="' + itemCustomFeature.index_value + '"><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  case 'goods-trade':
                      // 跳转指定商品详情页
                      $item = $('<li class="item router js-to-detail" data-router="'+(customFeature['goods-type'] == 3 ? 'tostoreDetail':'goodsDetail')+'" data-id="' + itemCustomFeature['goods-id'] + '"><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  case 'to-seckill':
                      // 跳转指定秒杀商品
                      $item = $('<li class="item router js-to-detail" data-router="seckillDetail" data-id="' + itemCustomFeature['seckill-id'] + '"><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  case 'to-franchisee':
                      // 跳转指定商家
                      $item = $('<li class="item router js-to-detail" data-router="franchiseeDetail" data-id="' + itemCustomFeature['franchisee-id'] + '"><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  case 'community':
                      // 跳转社区版块
                      $item = $('<li class="item router js-to-detail" data-router="communityPage" data-id="' + itemCustomFeature['community-id'] + '"><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  case 'get-coupon':
                      // 跳转指定优惠券详情页
                      $item = $('<li class="item router js-to-detail" data-router="couponDetail" data-id="' + itemCustomFeature['coupon-id'] + '"><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  case 'coupon-receive-list':
                      // 跳转优惠券领取列表
                      $item = $('<li class="item router js-to-detail" data-router="couponReceiveListPage" ><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  case 'recharge':
                      // 储值金充值
                      $item = $('<li class="item router js-to-detail" data-router="recharge" ><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  case 'transfer':
                      // 跳转支付(当面付)页面
                      $item = $('<li class="item router js-to-detail" data-router="transferPay"><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  case 'to-promotion':
                      // 跳转推广页面
                      $item = $('<li class="item js-to-detail to-promotion"><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  case 'lucky-wheel':
                      // 跳转大转盘
                      $item = $('<li class="item router js-to-detail" data-router="luckyWheelDetail" ><span>' + el.text + '</span><i class="underline"></i></li>');
                      break;
                  default:
                      $item = $('<li class="item"><span>' + el.text + '</span><i class="underline"></i></li>');
              }
              $container.append($item);
          });

          $html.append($container).on('click', '.item', function(event) {
            if (!$(this).hasClass('selected')) {
              if ($(this).hasClass('router')) {
                var $classify = $(this).parent().parent();
                if ($classify.hasClass('js-initial')) {
                  var index = $(this).index(),
                      selected = +$classify.attr('data-index');
                  if (index == selected) {
                      _classify.setSelected($(this));
                  };
                } else {
                  $classify.addClass('js-initial');
                  _classify.setSelected($(this));
                }

              } else {
                _classify.setSelected($(this));
              }
            }
          });
	  selected && selected!='-1' && $container.find('li').eq(selected).trigger('click');
          return $html;
        };
        ClassifyEle.prototype.setSelected = function($target) {
          $target.addClass('selected');

          var $classify = $target.parent().parent(),
              color = $classify.attr('data-color'),
              $preSelected = $target.siblings('.selected').removeClass('selected');;

          if (color != 'nope') {
            var mode = $classify.attr('mode');
            if (mode === '0') {
              $target.find('span').css('background-color', color);
              $preSelected.find('span').attr('style', '');
            } else {
              $target.css('color', color).find('.underline').css('border-color', color);
              $preSelected.attr('style', '');
            }
          };
          $target = null;
        }
      }
    };

    /*排序组件*/
    function SortEle() {
      var _sort = this;

      if (typeof this.parseElement != 'function') {
        SortEle.prototype.parseElement = function(ele) {
          var customFeature = ele.customFeature || {},
              content = ele.content,
              color = customFeature.selectedColor ? customFeature.selectedColor : 'none',
              selected = customFeature.selected || '-1',
              $html = $('<div class="element sort" data-color="' + color + '" data-index="' + selected + '"></div>'),
              style = ele.style,
              containerHeight = style && style.height ? 'style="height:' + (parseInt(style.height) + 15) + 'px;"' : '',
              $container = $('<ul ' + containerHeight + '></ul>');

          $(content).each(function(index, el) {
            var arrUpColor = el.customFeature.sort_direction === 1 ? 'style="color:' + color + '"' : 'style="color:#ddd"';
            var arrDownColor = el.customFeature.sort_direction === 0 ? 'style="color:' + color + '"' : 'style="color:#ddd"';

            if(index === 0){
              var $item = $('<li class="item refresh" data-type="list" data-target="' + customFeature.sort_object + '" data-sortkey="' + el.customFeature.sort_key + '" data-order="' + el.customFeature.sort_direction + '"><span>' + el.text + '</span></li>');
            }else{
              var $item = $('<li class="item refresh" data-type="list" data-target="' + customFeature.sort_object + '" data-sortkey="' + el.customFeature.sort_key + '" data-order="' + el.customFeature.sort_direction + '"><span>' + el.text + '</span><span class="arr-wrap"><i ' + arrUpColor + ' class="sort-arr arr-up">▲</i><i ' + arrDownColor + ' class="sort-arr arr-down">▼</i></span></li>');
            }
            $container.append($item);
          });

          $html.append($container).on('click', '.item', function(event) {
            if (!$(this).hasClass('selected')) {
              if ($(this).hasClass('router')) {
                var $classify = $(this).parent().parent();
                if ($classify.hasClass('js-initial')) {
                  var index = $(this).index(),
                      selected = +$classify.attr('data-index');
                  if (index == selected) {
                      _sort.setSelected($(this));
                  };
                } else {
                  $classify.addClass('js-initial');
                  _sort.setSelected($(this));
                }

              } else {
                _sort.setSelected($(this));
              }
            } else {
              var direction = $(this).attr('data-order');
              direction == 0 ? $(this).attr('data-order', 1) : $(this).attr('data-order', 0);
              if(direction == 1){
                $(this).find(".arr-up").css("color","#ddd");
                $(this).find(".arr-down").css("color",color);
              }else{
                $(this).find(".arr-up").css("color",color);
                $(this).find(".arr-down").css("color","#ddd");
              }
            }
          });
          selected && selected != '-1' && $container.find('li').eq(selected).trigger('click'); // 渲染分类组件时，设置了第几项选中，选中项又有点击事件时，事件不会冒泡（因为此时组件还没插入body中），可以考虑用setTimeOut(function(){...},0)来执行
          return $html;
        };
        SortEle.prototype.setSelected = function($target) {
          $target.addClass('selected');

          var $sort = $target.parent().parent(),
              color = $sort.attr('data-color'),
              $preSelected = $target.siblings('.selected').removeClass('selected');

          if (color != 'none') {
            $target.css('color', color);
            $preSelected.attr('style', '');
          };
          $target = null;
        }
      }
    };

    /*搜索组件*/
    function SearchEle(){
      var _search = this;

      if(typeof this.parseElement != 'function'){
        SearchEle.prototype.parseElement = function(ele){
          var $html,
              content = ele.content;

          $html = $('<div class="element search"><div class="search-input"><i class="icon-search"></i><span>'+content.placeholder+'</span></div></div>');
          $html.click(function(){
            OfficialPages['search-page'].parseSearchPage(ele.customFeature);//初始化搜索页面
            APP.turnToPage({router:'searchPage'});
          })
          return $html;
        };
      }
    }

     /*---------外卖组件--------*/
    function WaiMaiEle() {
      var takeout = this;
      var _waimai = this;

      $("#waimai-shopping-cart").addClass("zShow").find(".sure-waimai-oreder button").addClass("disabledBtn");
      if (typeof this.parseElement != 'function') {
        WaiMaiEle.prototype.parseElement = function(ele) {
          this.href = window.location.href ;
          if (!GetQueryString('takeout')) {
            window.history.replaceState(null, '', takeout.href+"&takeout=1")
          }
          this.Ele = {};
          this.takeoutList = {},
          this.waimaiArr = {},
          this.takeoutModelGoods = {},
          this.totalPrice = 0.00,
          this.toalCount = 0;
          var $shopSet = '', $shopInfoShowDiv = '', $myCoupon='', shopInfo;

          $.ajax({
            url: '/index.php?r=AppShop/getTakeOutInfo',
            type: 'get',
            dataType: 'json',
            async : false,
            data: {app_id: appId},
            success:function(data){
              if (data.status != 0) {alertTip(data.data);return};
              shopInfo = data.data;
              $shopSet = '<div class="tokeout-shop-desc"><img src="'+shopInfo.cover+'" alt="" /><div class="shop-info"><p class="shop-name">'+shopInfo.title+'</p><p>'+shopInfo.deliver_time+'分钟送达&nbsp;|&nbsp;'+(shopInfo.deliver_type == 0 ? '商家配送' : '第三方配送')+'<a href="tel:' + shopInfo.phone + '"></a></p><p>起送价：'+shopInfo.min_deliver_price+'元&nbsp;&nbsp;|&nbsp;&nbsp;配送费：'+shopInfo.deliver_fee+'元</p></div><p><span class=""></span></p><p></p></div>';

              $shopInfoShowDiv = '<p>商家信息</p><div class="info-detail-desc"><label class="icon-tokeout-info"></label>'+shopInfo.description+'</div><div class="info-detail-num"><label class="icon-sales-num"></label>总销量：'+shopInfo.total_sales+'</div><div class="info-detail-businessTime"><label class="icon-business-time"></label>营业时间为：'+_waimai.returnBusinessTime(shopInfo.business_time)+'</div><div class="info-detail-phone"><label class="icon-tokeout-phone"></label><a href="tel:' + shopInfo.phone + ' ">' + shopInfo.phone + '</a></div><div class="info-detail-local"><label class="icon-location"></label>'+shopInfo.address+'</div><div class="info-detail-sendtype"><label class="icon-distribution"></label>'+(shopInfo.deliver_type == 0 ? '商家配送' : '第三方配送')+'</div>'
              +'<p>商家优惠和服务</p>'+_waimai.returnDiscount(shopInfo.coupon_list || []);
            }
          })

          $.ajax({
            url: '/index.php?r=AppShop/getAssessList',
            type: 'get',
            dataType: 'json',
            data: {
              app_id : appId,
              idx_arr : {idx: 'goods_type', idx_value: 2},
              page : 1,
              page_size : 10,
              sub_shop_app_id : GetQueryString('franchisee'),
              obj_name : 'app_id'
            },
            success:function(data){
              if (data.status != 0) {alertTip(data.data);return}
              takeout.assessInfo = data;
            }
          })
          if (!ele.customFeature.showShopInfo) {
            $shopSet = '';
          }
          var customFeature = ele.customFeature || {},
              content = ele.content,
              color = customFeature.selectedColor ? customFeature.selectedColor : 'none',
              backgroundColor = customFeature.selectedBackgroundColor ? customFeature.selectedBackgroundColor : 'none',
              selected = customFeature.selected || '-1',

              $html = $($shopSet + '<div class="waimai-goods-evaluate"><span><span class="active evaluate">商品</span></span><span><span class="evaluate">评价</span></span><span><span class="evaluate">店铺</span></span></div>'+'<div class="element waimai waimai-container-wrap" ><div class="tokeout-good-list"></div>'
                +'<div class="tokeout-shop-evaluate"><div style="border-bottom:1px solid #f3f3f3;margin:0 15px;"><div class="comprehensive-score">'+shopInfo.commont_stat.average_score+'<div style="font-size:11px;color:#333;font-weight:normal;">综合评分</div></div><div style="width:1px;height:60px;vertical-align:middle;display:inline-block;background:#f3f3f3;"></div><div class="other-score"><div style="font-size:12px;color:#666;margin-bottom: 10px;">服务态度<span style="margin-left:15px;'+(shopInfo.commont_stat.logistic_score>=1 ? 'color:#fc9e20': '')+'" class="icon-fullstar"></span><span style="'+(shopInfo.commont_stat.logistic_score>=2 ? 'color:#fc9e20': '')+'" class="icon-fullstar"></span><span style="'+(shopInfo.commont_stat.logistic_score>=3 ? 'color:#fc9e20': '')+'" class="icon-fullstar"></span><span style="'+(shopInfo.commont_stat.logistic_score>=4 ? 'color:#fc9e20': '')+'" class="icon-fullstar"></span><span style="'+(shopInfo.commont_stat.logistic_score>=5 ? 'color:#fc9e20': '')+'" class="icon-fullstar"></span></div><div style="font-size:12px;color:#666;">商品评分<span style="margin-left:15px;'+(shopInfo.commont_stat.score>=1 ? 'color:#fc9e20': '')+'" class="icon-fullstar"></span><span style="'+(shopInfo.commont_stat.score>=2 ? 'color:#fc9e20': '')+'" class="icon-fullstar"></span><span style="'+(shopInfo.commont_stat.score>=3 ? 'color:#fc9e20': '')+'" class="icon-fullstar"></span><span style="'+(shopInfo.commont_stat.score>=4 ? 'color:#fc9e20': '')+'" class="icon-fullstar"></span><span style="'+(shopInfo.commont_stat.score>=5 ? 'color:#fc9e20': '')+'" class="icon-fullstar"></span></div></div></div><div style="padding: 15px;"><span class="takeout-assess-btn">有图</span><span class="takeout-assess-btn">好评</span><span class="takeout-assess-btn">中评</span><span class="takeout-assess-btn">差评</span></div></div><div class="tokeout-shop-info">'+$shopInfoShowDiv+'</div>'
              	+'<div class="goods-bottom-opt"><div class="shoppingcart-total-money" style="width:70%;"><a href="javascript:void(0);" class="shopping-cart-wrap"><span class="icon-shoppingcart" data-from="waimai"></span><span class="waimai-count">0</span></a><a href="javascript:void(0);" class="shopping-money-wrap"><span>￥</span><span class="waimai-count-money">0.00</span></a></div>'
              	+'<div class="sure-waimai-oreder" style="width:30%;"><button type="button" class="disabledBtn" disabled="disabled">去结算</button></div></div><div class="cartListPop"><div class="takeoutCartList"><p>已选商品 <span class="icon-delete">清空</span></p><ul></ul></div></div></div>'
              	+'<div class="takeout-detail-pop"><div class="takeout-bottom"><p class="takeout-title"></p><div class="takeout-standard"></div><div class="takeout-buy-num"></div><div class="takeout-bottom-btn"><span class="takeout-price"></span><button class="sure-choose">选好了</button></div><span class="takeout-pop-close">×</span></div></div><div class="goods-picture"></div>'),
              style = ele.style,
              typeList = $('<div class="typeList"></div>'),
              waimaiGoodsList = $("<div class='waimaigoodslist'></div>");


          $.each(content,function(index, ele) {
            takeout.Ele[ele.source] = ele;
            var item = "<span class='waimaiType' data-source='" + ele.source + "'>" + ele.text + "</span>";
            typeList.append(item);
          });
          $($html).find('.tokeout-good-list').append(typeList, waimaiGoodsList);
          $html.find(".typeList").css({
            "width": customFeature.leftSpan.width,
            "height":ele.customFeature.showShopInfo ? ($(window).height() - 173) + 'px' : ($(window).height() - 78) + 'px',
            "background-color":customFeature.leftSpan['background-color'],
            
          });
          $html.find(".waimaigoodslist").css({
             "left": customFeature.leftSpan.width,
             "height":ele.customFeature.showShopInfo ? ($(window).height() - 173) + 'px' : ($(window).height() - 78) + 'px',
             "width":(document.documentElement.clientWidth - parseInt(customFeature.leftSpan.width))+"px"
          });
          $html.find(".waimaiType").css({
            "display": "block",
            "width": customFeature.leftSpan.width,
            "padding": customFeature.leftSpan.padding,
           // "line-height": customFeature.leftSpan["line-height"],
            'opacity': style.opacity,
            'font-weight': customFeature.leftSpan['font-weight'],
            'text-decoration': customFeature.leftSpan['text-decoration'],
            'font-style': customFeature.leftSpan['font-style'],
            'font-size': customFeature.leftSpan['font-size'],
            'background-color': customFeature.leftSpan['background-color'],
            'color': customFeature.leftSpan['color'],
            'text-align': "center",
            'cursor': 'pointer',
            'border-bottom': '1px solid #DDD',
            "float": "left",
            "transition":"all 0.5s",
            "-webkit-tap-highlight-color":"transparent",
            "box-sizing":'border-box',
            "padding-bottom": "10px",
          });
          $html.on("click", ".waimaiType", function() {
            if (!$(this).hasClass('selected')) {
              $(this).addClass('selected').css({
                "color": color,
                "background-color": backgroundColor
              }).siblings(".waimaiType").removeClass('selected').css({
                'color': customFeature.leftSpan['color'],
                'background-color': customFeature.leftSpan['background-color']
              });
            }
            takeout.takeoutList.data && _waimai.showCategoryGoodsList($html.find(".waimaigoodslist"))
          }).on('click', '.tokeout-pop-close', function(event) {
          	$(this).closest('.tokeout-detail-pop').hide();
          }).on('click', '.tokeout-bottom', function(event) {
          	event.stopPropagation();
          }).on('click', '.evaluate', function(){
            $(this).closest('.ele-container').find('.waimai-container-wrap > div').eq($(this).parent().index()).show().siblings().hide();
            $(this).closest('.waimai-goods-evaluate').find('.active').removeClass('active');
            $(this).addClass('active');
            if ($(this).parent().index() == 0) {
              $(this).closest('.ele-container').find('.goods-bottom-opt').show();
            }
          }).on('click', '.icon-delete', function(event) {
            if (!$(this).closest('.takeoutCartList').find('ul li').length) {alertTip('您的购物车还没有商品');return;}
            confirmTip({
              content: '确定清空购物车吗？',
            }, function(){
              console.log('清空了');
            }, function(){

            });
          });

          _waimai.getWaimaiGoodsList($html.find(".waimaigoodslist"));
          return $html;
        };
        _waimai.returnDiscount = function(takeoutCouponList){
          var takeoutDiscount = '';
          $.each(takeoutCouponList, function(index, val) {
            takeoutDiscount += '<p class="router" data-router="couponDetail" data-id="' + val.id + '"><label class="'+(val.type == 0 ? 'icon-tokeout-reduce' : 'icon-tokeout-discount')+'" style="color: #fff;width: 18px;height: 18px;display: inline-block;text-align: center;line-height: 16px;border-radius: 2px;vertical-align: top;margin-right: 10px;'+(val.type == 0 ? 'background: rgb(246,62,86);' : '')+'"></label>'+val.title+'</p>';
          });
          return takeoutDiscount;
        };
        _waimai.getWaimaiGoodsList = function($container,goodstype) {
          var latitude = '', longitude='';
          navigator.geolocation.getCurrentPosition(function(position){
            latitude = position.coords.latitude;
            longitude =position.coords.longitude;
          })
          $.ajax({
            url: '/index.php?r=AppShop/GetGoodsList',
            type: 'get',
            data: {
              app_id: appId,
              page: -1,
              form: 'takeout',
              latitude: latitude,
              longitude: longitude
            },
            dataType: 'json',
            success: function(data) {
              if (data.status == 0) {
                var franchiseeId=GetQueryString('franchisee');

                takeout.takeoutList = data;
                $.ajax({
                  url: '/index.php?r=AppShop/cartList',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                    page: 1,
                    page_size: 100,
                    sub_shop_app_id: franchiseeId,
                    parent_shop_app_id: franchiseeId ? appId : '',
                    app_id: appId
                  },
                  success:function(res){
                    if(res.status != 0){
                      alertTip(res.data);
                      return;
                    }
                    takeout.cartList = res.data;
                    $container.closest('.tokeout-good-list').find(".waimaiType:first").trigger("click");
                    var cartListPopLi = '';
                    $.each(res.data, function(index, val) {
                      cartListPopLi += '<li data-id="'+val.id+'" data-modelid="'+val.model_id+'" data-goodsid="'+val.goods_id+'"><div class="cartListInfo"><p>'+val.title+'</p><p>'+ (val.model_value ? _waimai.parseCartList(val.model_value) : '')+'</p></div><div class="cartListPrice">￥'+(val.price*val.num )+'</div><div class="cartListBtn"><span class="cartReduce" data-id="'+val.id+'" data-price="'+val.price+'">-</span><span class="cartVal">'+val.num+'</span><span class="cartPlus" data-id="'+val.id+'" data-price="'+val.price+'">+</span></div></li>'
                      if(!(takeout.takeoutModelGoods[val.goods_id] instanceof Object)){
                        takeout.takeoutModelGoods[val.goods_id] = {};
                      }
                      takeout.takeoutModelGoods[val.goods_id][val.model_id] = {
                        num: +val.num,
                        price: val.price,
                        modelId: val.model_id,
                      }
                    });
                    $container.closest('.tokeout-good-list').siblings('.cartListPop').find('ul').html(cartListPopLi)
                    _waimai.parseData($container);
                  }
                });
              } else {
                alertTip('请求数据失败，请重试。' + data.data);
              };
            },
            error: function(data) {
              alertTip('请求数据失败，请重试');
            }
          });
        };

        _waimai.parseCartList = function(model, type){
          var modelSpan = '';
          if (model instanceof Array && !type) {
            $.each(model, function(index, val) {
              modelSpan += '<span>'+val+'</span>';
            });
          }else if (model.length && type) {
            $.each(model, function(index, val) {
              modelSpan += '<span>'+$(val).text()+'</span>';
            });
          }
          return modelSpan;
        };
        _waimai.parseData = function($container) {
          
          // takeout.takeoutList.data[$container.siblings('.typeList').find('a.selected').attr('data-source')]
          // $.each($container.siblings('.typeList').find('a'),function(index,ele){
          _waimai.showCategoryGoodsList($container)
          
          
          _waimai.bindClickEvent($container);
        }
        _waimai.showCategoryGoodsList = function ($container) {
          var waimaiList =$("<ul class='waimai-ul'></ul>");
          var item = '',  description = '', list_id = $container.siblings('.typeList').find('span.selected').attr('data-source');
          $.each(takeout.takeoutList.data[list_id], function(index, val) {
            var ele = val.form_data,  takeout_model;
            if(!ele.description){
              description = '';
            }else{
              description = ele.description.replace(/<img[^>]+>|<\s*\>\/>/gi,"");
            }
            if (val.goods_model) {takeout_model=JSON.stringify(val.goods_model)};
            item += "<li class='goods-list-item waimai-list-li js-to-detail' data-id='"
                 +ele.id+"' data-router='waimaiDetail' style='position: relative;'><div class='inner-content'><img data-id='"+ele.id+"' class='waimai-img' src='"+ele.cover+"'/><div class='waimai-title'><p>"
                 +ele.title+"</p>"+(ele.goods_model ? "<span class='tokeout_model' data-id='"+list_id+"'>多规格</span>" : '')+"<p><span class='waimai-price-per'>￥"+ele.price+"</span>"+"<span class='waimai-number-change'><button class='waimai-count-minus "+(ele.goods_model ? 'has-model' : '')+"'></button><input type='text' class='waimai-number' readyonly='readonly' disabled='disabled' value='0' data-price='"
                 +ele.price+"'/><button class='waimai-count-plus "+(ele.goods_model ? 'has-model' : '')+"' data-modelId='"+list_id+"'></button></span>"+"</p></div></div></li>"
          });
          var item = $("<li scroll-id='"+list_id+"'><ul id='"+list_id+"'><p>"+takeout.Ele[list_id].text+"</p>"+item+"</ul></li>");
          waimaiList.append(item);
          $container.html(waimaiList);
          $container.find(".waimai-count-minus").addClass("disabledminusbtn").attr("disabled","disabled");
          $.each(takeout.cartList, function(index, val) {
            var goodsLi = $container.find('li[data-id="'+val.goods_id+'"]'),
                num = _waimai.takeoutModelGoods[val.goods_id] ? _waimai.takeoutModelGoods[val.goods_id][val.model_id || 0].num : val.num
            goodsLi.find('.waimai-number').val(Number(goodsLi.find('.waimai-number').val()) + Number(num)).siblings('.waimai-count-minus').removeClass('disabledminusbtn').prop('disabled', false).siblings('.waimai-count-plus').attr('cart-id', val.id);
            if (!takeout.totalPrice) {
              takeout.totalPrice += +val.num * +val.price;
              takeout.toalCount += +val.num;
            }
          });
          $container.closest('.ele-container').find('.waimai-count').text(takeout.toalCount);
          $container.closest('.ele-container').find('.waimai-count-money').text(takeout.totalPrice);
          takeout.totalPrice != 0 ? $container.parent().siblings('.goods-bottom-opt').find(".sure-waimai-oreder button").removeClass("disabledBtn").prop('disabled', false) : ''
        };
        _waimai.addGoods = function(e){
          var showModel = $(e.currentTarget),
              _this = this;
          if (showModel.hasClass('has-model')) {
            var thisLi = showModel.closest('li'),
                detailPop = showModel.closest('.ele-container').find('.takeout-detail-pop'),
                takeoutFormData = this.takeoutList.data[showModel.attr('data-modelId')][thisLi.index()-1].form_data;
            detailPop.attr({
              'goodsId': thisLi.attr('data-id'),
              'categoryId': thisLi.parent().attr('id'),
              'index': thisLi.index()-1,
              'hasChoose': thisLi.find('.waimai-number').val()
            })
            detailPop.find('.takeout-title').text(takeoutFormData.title);
            detailPop.find('.takeout-price').text('￥'+takeoutFormData.price);
            var modelItem = '';
            $.each(takeoutFormData.model, function(index, val) {
              modelItem += '<p style="font-weight: 600;padding-top: 15px;padding-bottom: 10px;">'+val.name+'：</p><div class="takeoutModelDiv">';
              $.each(val.subModelName, function(index, model) {
                modelItem += '<span class="" data-modelId="'+val.subModelId[index]+'">'+model+'</span>';
              });
              modelItem += '</div>'
            });
            detailPop.find('.takeout-standard').html(modelItem);
            detailPop.show().find('.tokeout-info img').attr('src', takeoutFormData.cover);
          }else{
            var takeoutGoodId = showModel.closest('li').attr('data-id'),
                tempinput = showModel.siblings("input");
            this.addWaiMaiGoodsToCart({
              app_id: appId,
              goods_id: showModel.closest("li").attr("data-id"),
              model_id: 0,
              num: +tempinput.val() || 1,
              ck_id: GetCookiePara(),
            },showModel.closest('.waimaigoodslist'), function(data){
              tempinput.val(+tempinput.val()+1);
              showModel.siblings(".waimai-count-minus").removeAttr("disabled").removeClass("disabledminusbtn");
              _this.toalCount++;
              _this.totalPrice = Number(+_this.totalPrice + +showModel.siblings(".waimai-number").attr("data-price")).toFixed(2);
              _this.countNumberMoney(showModel.closest('.waimaigoodslist'));
              if (!_this.takeoutModelGoods[showModel.closest("li").attr("data-id")]) {
                _this.takeoutModelGoods[showModel.closest("li").attr("data-id")] = {
                  0:{
                    modelId: 0,
                    num: +showModel.siblings('input').val(),
                    price: +showModel.closest('p').find('.waimai-price-per').text().split('￥')[1]
                  }
                };
              }else{
                _this.takeoutModelGoods[showModel.closest("li").attr("data-id")][0].num ++;
              }
              var thisGoodsInfo = _this.takeoutModelGoods[showModel.closest("li").attr("data-id")][0],
                  thisPrice = +showModel.closest('p').find('.waimai-price-per').text().split('￥')[1],
                  thisNum = +showModel.siblings('input').val();
              if (!showModel.closest('.tokeout-good-list').siblings('.cartListPop').find('ul li[data-id="'+data+'"]').length) {
                showModel.closest('.tokeout-good-list').siblings('.cartListPop').find('ul').append('<li data-category="'+showModel.closest('.tokeout-good-list').find('.waimaiType.selected').attr('data-source')+'" data-id="'+data+'" data-goodsid="'+showModel.closest("li").attr("data-id")+'"><div class="cartListInfo"><p>'+showModel.closest('.waimai-title').find('p').eq(0).text()+'</p><p></p></div><div class="cartListPrice">￥'+( thisPrice * thisNum).toFixed(2)+'</div><div class="cartListBtn"><span class="cartReduce" data-id="'+data+'" data-price="'+thisPrice+'">-</span><span class="cartVal">'+thisNum+'</span><span class="cartPlus" data-id="'+data+'" data-price="'+thisPrice+'">+</span></div></li>');
              }else{
                var cartListLi = showModel.closest('.tokeout-good-list').siblings('.cartListPop').find('ul li[data-id="'+data+'"]');
                cartListLi.find('.cartListPrice').text('￥' + (thisPrice * thisNum).toFixed(2) );
                cartListLi.find('.cartVal').text(tempinput.val())
              }
              showModel.closest('.waimai-ul').find('li[data-id="'+takeoutGoodId+'"]').find('.waimai-number').val( tempinput.val() ).siblings('.waimai-count-minus').removeClass('disabledminusbtn').prop('disabled', false);
            });
          }
        };
        _waimai.deleteGoods = function(e){
          var _this = $(e.currentTarget),
              takeoutGoodId = _this.closest('li').attr('data-id'),
              tempinput = _this.siblings("input");
          if (_this.hasClass('has-model')){
            alertTip('多规格商品只能去购物车删除');
            return;
          }else {
            if(tempinput.val().trim() == 1){
              tempinput.val(0)
              $(".waimai .goods-bottom-opt").find(".sure-waimai-oreder button").addClass("disabledBtn").attr("disabled","disabled");
              _this.addClass("disabledminusbtn").attr("disabled","disabled");
              takeout.toalCount--;
              takeout.totalPrice -= Number(_this.siblings(".waimai-number").attr("data-price"));
              _waimai.countNumberMoney(_this.closest('.waimaigoodslist'));
              var cart_id_arr=[];
              cart_id_arr.push(_this.siblings(".waimai-count-plus").attr("cart-id"));
              _waimai.deleWaiMaiGoodsCart(cart_id_arr);
              _this.closest('.waimai-ul').find('li[data-id="'+takeoutGoodId+'"]').find('.waimai-count-minus').addClass('disabledminusbtn').prop('disabled', true);
            }else{
              _waimai.addWaiMaiGoodsToCart({
                app_id: appId,
                goods_id: _this.closest("li").attr("data-id"),
                model_id:0,
                num: tempinput.val(),
                ck_id: GetCookiePara(),
              }, _this,function(data){
                tempinput.val(+tempinput.val()-1);
                takeout.toalCount--;
                takeout.totalPrice = (+takeout.totalPrice - +_this.siblings(".waimai-number").attr("data-price")).toFixed(2);
                _waimai.countNumberMoney(_this.closest('.waimaigoodslist'));
                var thisGoodsInfo = takeout.takeoutModelGoods[_this.closest("li").attr("data-id")][0],
                    thisPrice = +_this.closest('p').find('.waimai-price-per').text().split('￥')[1],
                    thisNum = +_this.siblings('input').val();
                if (!_this.closest('.tokeout-good-list').siblings('.cartListPop').find('ul li[data-id="'+data+'"]').length) {
                  _this.closest('.tokeout-good-list').siblings('.cartListPop').find('ul').append('<li data-category="'+_this.closest('.tokeout-good-list').find('.waimaiType.selected').attr('data-source')+'" data-id="'+data+'" data-goodsid="'+_this.closest("li").attr("data-id")+'"><div class="cartListInfo"><p>'+_this.closest('.waimai-title').find('p').eq(0).text()+'</p><p></p></div><div class="cartListPrice">￥'+( thisPrice * thisNum).toFixed(2)+'</div><div class="cartListBtn"><span class="cartReduce" data-id="'+data+'" data-price="'+thisPrice+'">-</span><span class="cartVal">'+thisNum+'</span><span class="cartPlus" data-id="'+data+'" data-price="'+thisPrice+'">+</span></div></li>');
                }else{
                  var cartListLi = _this.closest('.tokeout-good-list').siblings('.cartListPop').find('ul li[data-id="'+data+'"]');
                  cartListLi.find('.cartListPrice').text('￥' + (thisPrice * thisNum ).toFixed(2));
                  cartListLi.find('.cartVal').text(tempinput.val())
                }
                _this.closest('.waimai-ul').find('li[data-id="'+takeoutGoodId+'"]').find('.waimai-number').val( tempinput.val() )
              });
            }
          }
        };
        _waimai.previewTakeoutInfo = function(e){
          var thisTakeout = $(e.currentTarget), 
              waimaiTitle = thisTakeout.siblings('.waimai-title'), 
              desc = _waimai.takeoutList.data[thisTakeout.closest('.tokeout-good-list').find('.waimaiType.selected').attr('data-source')][thisTakeout.closest('li').index()-1].form_data.description;
          thisTakeout.closest('.ele-container').find('.goods-picture').html('<div><img src="'+thisTakeout.attr('src')+'" alt="" /><p class="tokeout-pop-title">'+waimaiTitle.find('p').eq(0).text()+'</p><p class="tokeout-pop-comment">'+desc+'</p><p class="tokeout-pop-price">'+waimaiTitle.find('.waimai-price-per').text()+'</p></div>').show();
        }
        _waimai.showCartsList = function(e){
          $(e.target).closest('.goods-bottom-opt').siblings('.cartListPop').show();
        }
        // 选择规格
        _waimai.sureChooseModel = function(e){
          var _this = $(e.currentTarget), popWin = _this.closest('.takeout-detail-pop');
            if (!popWin.data('goodsmodelid')) {
              alertTip('您未选择规格');
              return;
            }
            if (takeout.takeoutModelGoods[popWin.attr("goodsid")] instanceof Object) {
              if (!(takeout.takeoutModelGoods[popWin.attr("goodsid")][popWin.data('goodsmodelid')] instanceof Object)) {
                takeout.takeoutModelGoods[popWin.attr("goodsid")][popWin.data('goodsmodelid')]={
                  num:  0,
                  modelId:popWin.data('goodsmodelid'),
                  price: _this.siblings().text().split('￥')[1]
                }
              }
            }else{
              takeout.takeoutModelGoods[popWin.attr("goodsid")] = {};
              takeout.takeoutModelGoods[popWin.attr("goodsid")][popWin.data('goodsmodelid')]={
                num:  0,
                modelId:popWin.data('goodsmodelid'),
                price: _this.siblings().text().split('￥')[1]
              }
            }
            takeout.takeoutModelGoods[popWin.attr("goodsid")][popWin.data('goodsmodelid')].num ++;
            _waimai.addWaiMaiGoodsToCart({
              app_id: appId,
              goods_id: popWin.attr("goodsid"),
              model_id: popWin.data('goodsmodelid'),
              num: takeout.takeoutModelGoods[popWin.attr("goodsid")][popWin.data('goodsmodelid')].num,
              ck_id: GetCookiePara(),
            },_this.closest('.ele-container'), function(data){
              // 选择多规格商品后  回调
              popWin.hide();
              var thisGoodsNum = +$('li[data-id="'+popWin.attr("goodsid")+'"]').find('.waimai-number').val();
              $('li[data-id="'+popWin.attr("goodsid")+'"]').find('.waimai-number').val(++thisGoodsNum);
              takeout.toalCount ++;
              takeout.totalPrice = Number(takeout.totalPrice) + Number(takeout.takeoutModelGoods[popWin.attr("goodsid")][popWin.data('goodsmodelid')].price);
              if ($('li[data-id="'+data+'"]').length) {
                $('li[data-id="'+data+'"]').find('.cartVal').text(Number($('li[data-id="'+data+'"]').find('.cartVal').text())+1)
                $('li[data-id="'+data+'"]').find('.cartListPrice').text('￥'+ (Number(takeout.takeoutModelGoods[popWin.attr("goodsid")][popWin.data('goodsmodelid')].price) + Number($('li[data-id="'+data+'"]').find('.cartListPrice').text().split('￥')[1] )).toFixed(2))
              }else{
                var goodsInfo =takeout.takeoutModelGoods[popWin.attr("goodsid")][popWin.data('goodsmodelid')];

                popWin.siblings('.element.waimai.waimai-container-wrap').find('.cartListPop ul').append('<li data-category="'+_this.closest('.tokeout-good-list').find('.waimaiType.selected').attr('data-source')+'" data-id="'+data+'" data-goodsid="'+popWin.attr('goodsid')+'" data-modelid="'+popWin.data('goodsmodelid')+'"><div class="cartListInfo"><p>'+popWin.find('.takeout-title').text()+'</p><p>'+ _waimai.parseCartList(popWin.find('.takeoutModelDiv span.selected'), 1)+'</p></div><div class="cartListPrice">￥'+(goodsInfo.price )+'</div><div class="cartListBtn"><span class="cartReduce" data-id="'+data+'" data-price="'+goodsInfo.price+'">-</span><span class="cartVal">1</span><span class="cartPlus" data-id="'+data+'" data-price="'+goodsInfo.price+'">+</span></div></li>')
              }
              $('li[data-id="'+popWin.attr("goodsid")+'"]').find('.waimai-count-minus').removeClass('disabledminusbtn').prop('disabled', false);
              _waimai.countNumberMoney(_this.closest('.ele-container'));
            });
        };
        _waimai.hideTakeoutPop = function(e){
          $(e.currentTarget).closest('.takeout-detail-pop').hide();
        };
        _waimai.chooseModel = function(e){
          var _this = $(e.currentTarget);
          if (_this.hasClass('selected')) {return;}
          _this.addClass('selected').siblings().removeClass('selected');
          var takeoutGoodsData = takeout.takeoutList.data,
              takeoutGoodsId = takeout.takeoutList.data[_this.closest('.takeout-detail-pop').attr('categoryid')],
              index = _this.closest('.takeout-detail-pop').attr('index'),
              selectedArr = [];
          $.each(_this.closest('.takeout-standard').find('span.selected'), function(index, val) {
            selectedArr.push($(val).attr('data-modelid'));
          });
          $.each(takeoutGoodsId[index].form_data.goods_model, function(index, val) {
            if (selectedArr.sort().toString() == val.model.split(',').sort().toString()) {

              _this.closest('.takeout-bottom').find('.takeout-price').text('￥'+ val.price);
              _this.closest('.takeout-detail-pop').data({'goodsmodelid': val.id, 'hasChoose': +_this.closest('.takeout-detail-pop').data('hasChoose') +1 });
              console.log(_this.closest('.takeout-detail-pop').data())
            } else if (selectedArr.length != val.model.split(',').length) {
              _this.closest('.takeout-detail-pop').data({'goodsmodelid': val.id,'hasChoose': ''});
            }
          });
        };
        _waimai.cartReduce = function(e){
          // 弹出层购物车列表 减少商品数量
          var _this = $(e.currentTarget),
              price = Number(_this.attr('data-price'));
          if (_this.siblings('.cartVal').text() > 1) {
            _this.parent().siblings('.cartListPrice').text('￥'+ (Number(_this.parent().siblings('.cartListPrice').text().split('￥')[1]) - price).toFixed(2) );
            _this.siblings('.cartVal').text(Number(_this.siblings('.cartVal').text()) - 1 )
            _waimai.addWaiMaiGoodsToCart({
              app_id: appId,
              goods_id: _this.closest("li").attr("data-goodsid"),
              model_id: _this.closest("li").attr("data-modelid"),
              num: _this.siblings('.cartVal').text(),
              ck_id: GetCookiePara(),
            }, _this.closest('.ele-container'), function(){
              _waimai.toalCount--;
              _waimai.totalPrice -= price;
              _this.closest("li").attr("data-modelid") ? _waimai.takeoutModelGoods[_this.closest("li").attr("data-goodsid")][_this.closest("li").attr("data-modelid")].num -= 1 : _waimai.takeoutModelGoods[_this.closest("li").attr("data-goodsid")].num -= 1
              var totalNum = 0;
              $.each(_waimai.takeoutModelGoods[_this.closest("li").attr("data-goodsid")], function(index, val) {
                totalNum += Number(val.num);
              });
              _waimai.countNumberMoney(_this.closest('.ele-container'));
              $('li[data-id="'+_this.closest("li").attr("data-goodsid")+'"]').find('.waimai-number').val(totalNum);
            })
          }else{
            var cart_id_arr = [];
            cart_id_arr.push(_this.closest("li").attr('data-id'))
            _waimai.deleWaiMaiGoodsCart(cart_id_arr, function(){
              _this.closest("li").remove();
              _this.closest("li").attr("data-modelid") ? _waimai.takeoutModelGoods[_this.closest("li").attr("data-goodsid")][_this.closest("li").attr("data-modelid")].num = 0 : _waimai.takeoutModelGoods[_this.closest("li").attr("data-goodsid")].num = 0
              var totalNum = 0;
              $.each(_waimai.takeoutModelGoods[_this.closest("li").attr("data-goodsid")], function(index, val) {
                totalNum += Number(val.num);
              });
              $('li[data-id="'+_this.closest("li").attr("data-goodsid")+'"]').find('.waimai-number').val(totalNum);
              $('li[data-id="'+_this.closest("li").attr("data-goodsid")+'"]').find('.waimai-count-minus').addClass('disabledminusbtn').prop('disabled',true);
            });
            _waimai.toalCount--;
            _waimai.totalPrice -= price;
            _waimai.countNumberMoney(_this.closest('.ele-container'));

          }
        };
        _waimai.cartPlus = function(e){
          var _this = $(e.currentTarget);
              price = Number(_this.attr('data-price'));
          _this.parent().siblings('.cartListPrice').text('￥'+ (Number(_this.parent().siblings('.cartListPrice').text().split('￥')[1]) + price).toFixed(2) );
          _this.siblings('.cartVal').text(Number(_this.siblings('.cartVal').text()) + 1);
          _waimai.addWaiMaiGoodsToCart({
            app_id: appId,
            goods_id: _this.closest("li").attr("data-goodsid"),
            model_id: _this.closest("li").attr("data-modelid"),
            num: _this.siblings('.cartVal').text(),
            ck_id: GetCookiePara(),
          }, _this.closest('.ele-container'), function(){
            _waimai.toalCount++;
            _waimai.totalPrice += price;
            _waimai.countNumberMoney(_this.closest('.ele-container'));
            _waimai.takeoutModelGoods[_this.closest("li").attr("data-goodsid")][_this.closest("li").attr("data-modelid")].num += 1;
            var totalNum = 0;
            $.each(_waimai.takeoutModelGoods[_this.closest("li").attr("data-goodsid")], function(index, val) {
              totalNum += Number(val.num);
            });
            // $.each(_waimai.takeoutList.data., function(index, v) {
            //   $.each(v, function(index, val) {
                
            //   });
            // });
            $('li[data-id="'+_this.closest("li").attr("data-goodsid")+'"]').find('.waimai-number').val(totalNum);
            $('li[data-id="'+_this.closest("li").attr("data-goodsid")+'"]').find('.waimai-count-minus').removeClass('disabledminusbtn').prop('disabled',false);
          });
        }
        _waimai.bindClickEvent = function($container){
          $('body').on("click",".goods-bottom-opt .sure-waimai-oreder",function(){
            //选好外卖商品之后支付
            // console.log(takeout.waimaiArr);
            takeout.waimaiArr = []
            $.each($(this).closest('.goods-bottom-opt').siblings('.cartListPop').find('ul li'), function(index, ele) {
              takeout.waimaiArr.push($(ele).attr('data-id'));
            });

            EleObjects['waimai-pay-ele'].waiMaiPayNextStep(takeout);
          });

        };
        //当某一个外卖数量减到0的时候将购物车中的该商品也删除掉
        _waimai.deleWaiMaiGoodsCart = function (cart_id_arr, callback){
          $.ajax({
            url : '/index.php?r=AppShop/deleteCart',
            type: 'get',
            data: {
              app_id   : appId,
              ck_id: GetCookiePara(),
              cart_id_arr: cart_id_arr
            },
            dataType: 'json',
            success: function(data){
              if(data.status !== 0) { alertTip(data.data); return; }
              callback && callback();
            }
          });
        };
        //统计外卖数量以及总价格
        _waimai.countNumberMoney = function ($container){
          var temshoppingcart = $container.parent().siblings('.goods-bottom-opt').length ? $container.parent().siblings('.goods-bottom-opt') : $container.find('.goods-bottom-opt');
          if(takeout.toalCount == 0){
            temshoppingcart.find(".sure-waimai-oreder button").addClass("disabledBtn").attr("disabled","disabled");
          }else{
            temshoppingcart.find(".sure-waimai-oreder button").removeClass("disabledBtn").removeAttr("disabled");
          }
          temshoppingcart.find(".waimai-count").text(takeout.toalCount);
          temshoppingcart.find(".waimai-count-money").text((+takeout.totalPrice).toFixed(2));
        };
        _waimai.addWaiMaiGoodsToCart = function(param, takeoutList, callback){
          $.ajax({
            url: '/index.php?r=AppShop/addCart',
            type: 'get',
            data: param,
            dataType: 'json',
            success: function(data) {
                if (data.status !== 0 && data.status != 2) {
                    alertTip(data.data);
                    return;
                }
                if (data.status == 2) {
                  notFirstPage = true; // 一旦需要登录 则跳转登录页
                  APP.goLogin();
                  return
                }
                takeoutList.find('li[data-id="'+param.goods_id+'"] .waimai-count-plus').attr("cart-id",data.data);
                callback && callback(data.data);
            }
          });
        }
        _waimai.returnBusinessTime = function(time){
          var returnBusiness = '';
          $.each(time, function(index, val) {
            returnBusiness += val.start_time + '-' + val.end_time;
          });
          return returnBusiness;
        }
      }
    }

    function TitleEle() {
      var _title = this;

      if (typeof this.parseElement != 'function') {
        TitleEle.prototype.parseElement = function(ele) {
          var $html,
              customFeature = ele.customFeature || {},
              mode = customFeature.mode ? customFeature.mode : '0',
              markColor = customFeature.markColor ? customFeature.markColor : null;

          switch (customFeature.action) {
            case 'none':
                $html = $('<div class="element title-ele" mode="' + mode + '"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            case 'inner-link':
                // 页面跳转
                $html = $('<div class="element title-ele router" data-router="' + (customFeature['inner-page-link'] || customFeature['page-link']) + '" mode="' + mode + '"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            case 'custom-link':
                // 外部链接
                $html = $('<div class="element title-ele" mode="' + mode + '"><a href="' + clearWeixinHash(customFeature['custom-page-link'] || customFeature['page-link']) + '" target="_blank"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></a></div>');
                break;
            case 'weiye':
                // 微页
                $html = $('<div class="element title-ele" mode="' + mode + '"><a href="' + (customFeature['weiye-link'] || customFeature['page-link']) + '" target="_blank"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></a></div>');
                break;
            case 'call':
                // 拨打电话
                $html = $('<div class="element title-ele" mode="' + mode + '"><a href="tel:' + customFeature['phone-num'] + '"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></a></div>');
                break;
            case 'refresh-page':
                // 刷新页面
                $html = $('<div class="element title-ele refresh" data-type="page" mode="' + mode + '"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            case 'refresh-list':
                // 刷新列表
                $html = $('<div class="element title-ele refresh" data-type="list" data-target="' + customFeature.refresh_object + '" data-index="' + customFeature.index_segment + '" data-value="' + customFeature.index_value + '" mode="' + mode + '"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            case 'goods-trade':
                // 跳转指定商品详情页
                $html = $('<div class="element title-ele router js-to-detail" mode="' + mode + '" data-router="'+(customFeature['goods-type'] == 3 ? 'tostoreDetail':'goodsDetail')+'" data-id="' + customFeature['goods-id'] + '"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            case 'to-seckill':
                // 跳转指定秒杀商品
                $html = $('<div class="element title-ele router js-to-detail" mode="' + mode + '" data-router="seckillDetail" data-id="' + customFeature['seckill-id'] + '"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            case 'to-franchisee':
                // 跳转指定商家
                $html = $('<div class="element title-ele router js-to-detail" mode="' + mode + '" data-router="franchiseeDetail" data-id="' + customFeature['franchisee-id'] + '"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            case 'community':
                // 跳转社区版块
                $html = $('<div class="element title-ele router js-to-detail" mode="' + mode + '" data-router="communityPage" data-id="' + customFeature['community-id'] + '"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            case 'get-coupon':
                // 跳转优惠券详情页
                $html = $('<div class="element title-ele router js-to-detail" mode="' + mode + '" data-router="couponDetail" data-id="' + customFeature['coupon-id'] + '"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            case 'coupon-receive-list':
                // 跳转优惠券领取列表
                $html = $('<div class="element title-ele router js-to-detail" mode="' + mode + '" data-router="couponReceiveListPage" ><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            case 'recharge':
                // 储值金充值
                $html = $('<div class="element title-ele router js-to-detail" mode="' + mode + '" data-router="recharge"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            case 'transfer':
                // 跳转支付(当面付)页面
                $html = $('<div class="element title-ele router js-to-detail" mode="' + mode + '" data-router="transferPay"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            case 'to-promotion':
                // 跳转推广页面
                $html = $('<div class="element title-ele to-promotion" mode="' + mode + '"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            case 'lucky-wheel':
                // 跳转大转盘
                $html = $('<div class="element title-ele router js-to-detail" mode="' + mode + '" data-router="luckyWheelDetail" ><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');
                break;
            default:
                $html = $('<div class="element title-ele" mode="' + mode + '"><p><span class="title-text"><span class="mark"></span><span class="js-text">' + ele.content + '</span></span></p></div>');;
          }
          markColor && $html.find('.mark').css('background-color', markColor);
          return $html;
        };
      }
    };

    function BreakLine() {
      var _breakline = this;

      if (typeof this.parseElement != 'function') {
        BreakLine.prototype.parseElement = function(ele) {
          var $html = $('<div class="element breakline"></div>');
          return $html;
        };
      }
    };

    function Hotspot() {
      var _hotspot = this;

      if (typeof this.parseElement != 'function') {
        Hotspot.prototype.parseElement = function(ele) {
          var $html,
              customFeature = ele.customFeature || {},
              content = ele.content || '';

          switch (customFeature.action) {
            case 'none':
                $html = $('<div class="element hotspot">' + content + '</div>');;
                break;
            case 'inner-link':
                // 页面跳转
                $html = $('<div class="element hotspot router" data-router="' + (customFeature['inner-page-link'] || customFeature['page-link']) + '">' + content + '</div>');
                break;
            case 'custom-link':
                // 外部链接
                $html = $('<div class="element hotspot"><a href="' + clearWeixinHash(customFeature['custom-page-link'] || customFeature['page-link']) + '" target="_blank">' + content + '</a></div>');
                break;
            case 'weiye':
                // 微页
                $html = $('<div class="element hotspot"><a href="' + (customFeature['weiye-link'] || customFeature['page-link']) + '" target="_blank">' + content + '</a></div>');
                break;
            case 'call':
                // 拨打电话
                $html = $('<div class="element hotspot"><a href="tel:' + customFeature['phone-num'] + '">' + content + '</a></div>');
                break;
            case 'refresh-page':
                // 刷新页面
                $html = $('<div class="element hotspot refresh" data-type="page">' + content + '</div>');
                break;
            case 'refresh-list':
                // 刷新列表
                $html = $('<div class="element hotspot refresh" data-type="list" data-target="' + customFeature.refresh_object + '" data-index="' + customFeature.index_segment + '" data-value="' + customFeature.index_value + '">' + content + '</div>');
                break;
            case 'community':
                // 跳转到社区版块
                $html = $('<div class="element hotspot router js-to-detail " data-router="community" data-id="'+ customFeature['community-id'] +'">' + content + '</div>');
                break;
            default:
                $html = $('<div class="element hotspot">' + content + '</div>');;
          }
          return $html;
        };
      }
    }
    // 地图组件
    function MapEle() {
      var _map = this,
          mapApiLoaded = false,
          mapModule = {
            createMap: function(eleContent) {
              var mapInstance = new qq.maps.Map(eleContent.find('.map-module')[0], {
                      zoom: 13,
                      zoomControl: false,
                      panControl: false,
                      mapTypeControl: false
                  }),
                  lat, lng;

              if ((lat = eleContent.attr('lat')) && (lng = eleContent.attr('lng'))) {
                var latLng = new qq.maps.LatLng(lat, lng);

                this.qqMapMarker = new qq.maps.Marker({
                  map: mapInstance,
                  position: latLng
                });
                mapInstance.setCenter(latLng);
              } else {
                APP.mapModule.map && mapInstance.setCenter(APP.mapModule.map.center);
              }
              mapInstance.zoomTo(13);
            }
          };

      _map.parseElement = function(ele) {
        var customFeature = ele.customFeature || {},
            $html;

        $html = $('<div lat=' + customFeature.lat + ' lng=' + customFeature.lng + ' address=' + customFeature.address + ' class="element map" data-type="map"><div class="map-module"></div><div class="map-link">' + (customFeature.text || '') + '</div></div>');

        customFeature.type === 'withmap' && $html.addClass('withmap');
        return $html;
      };

      _map.initMap = function(eleContent) {
        mapModule.createMap($(eleContent));
      };

    }



    // 社区组件
    function CommunityEle() {
      var _community = this;

      _community.parseElement = function(ele) {
        var customFeature = ele.customFeature || {},
            $html, idarr = [],
            liStyle = '',   //行样式
            imgStyle = '',  //图标的样式
            secStyle = '';  //话题、简介样式

        secStyle = [
          'color:'+ customFeature.secColor ,
          'text-decoration:' + (customFeature.secTextDecoration || 'none'),
          'text-align:' + (customFeature.secTextAlign || 'left'),
          'font-size:' + customFeature.secFontSize,
          'font-style:' + (customFeature.secFontStyle || 'normal'),
          'font-weight:' + (customFeature.secFontWeight || 'normal')
        ].join(";");

        imgStyle = [
          'width :'+ customFeature.imgWidth + 'px',
          'height :'+ customFeature.imgHeight + 'px'
        ].join(";");

        liStyle = [
          'height :'+ customFeature.lineHeight + 'px',
          'margin-bottom :'+ customFeature.margin +'px'
        ];
        customFeature['lineBackgroundColor'] && (liStyle.push('background-color:' + customFeature['lineBackgroundColor']));
        customFeature['lineBackgroundImage'] && (liStyle.push('background-image:' + customFeature['lineBackgroundImage']));

        liStyle = liStyle.join(";");

        $html = $('<div class="element community" data-type="community"><ul class="community-list"></ul></div>');

        $.each(ele.content ,function(index, val) {
            idarr.push( val['community-id'] );
        });
        _community.getCommunityList( $html.children('.community-list') , idarr , secStyle , imgStyle , liStyle);

        return $html;
      }
        // 获取社区列表数据
      _community.getCommunityList = function( $container , dataId , secStyle , imgStyle , liStyle){
        var url = '/index.php?r=AppSNS/GetSectionByPage',
            param = {
              app_id: appId,
              page: 1 ,
              section_ids : dataId ,
              page_size: 100
            },
            successfn = function(data){
              if(data.status == 0){
                var _li = '',
                    ddata = {};
                $.each( data.data ,function(index, val) {
                    ddata[val.id] = val;
                });
                $.each( dataId ,function(index, val) {
                  if( ! ddata[val] ){  //如果找不到数据，则说明用户没有选择版块。
                      return ;
                  }
                  _li += _community.parseCommunityListTpl( ddata[val] , secStyle , imgStyle , liStyle);
                });
                $container.html( _li );

              }else{
                alertTip(data.data);
              }
            },
            errorfn = function(data){};

        $ajax( url , 'get', param, 'json', successfn , errorfn);
      }

      _community.communityListTpl = '<li class="community-item list-item router js-to-detail" data-router="communityPage" data-id="${id}" style="${liStyle}"><div class="inner-content"><img class="list-img" src="${img}" style="${imgStyle}">'
                            +  '<div class="title-container"><p><span class="community-title">${name}</span><span class="topic-num" style="${secStyle}">话题<span class="">${article_count}</span></span></p>'
                            +  '<p class="community-desc" style="${secStyle}">${description}</p></div></div></li>';

      _community.parseCommunityListTpl = function(data , secStyle , imgStyle , liStyle){
        var html = _community.communityListTpl.replace(/\$\{(\w+)\}/g, function($0, $1){
          switch($1){
            case 'secStyle'  : return secStyle;
            case 'imgStyle'  : return imgStyle;
            case 'liStyle'  : return liStyle;
            default :   return data[$1];
          }
        });
        return html;
      }
    }

    // 悬浮窗组件
    function Suspension(argument) {
      var _suspension = this;

      _suspension.parseElement = function(ele) {
        var customFeature = ele.customFeature || {},
            content = ele.content || {},
            appendComponent = customFeature.appendComponent || {
                    'service': true ,
                    'myOrder': true ,
                    'shoppingCart': true,
                    'top': true
                },
            $html = '',
            ahtml = '',
            liStyle = '';

        liStyle = [
          'margin-bottom :'+ customFeature.margin +'px' ,
          'background-color:'+ customFeature.lineBackgroundColor
        ];
        customFeature['lineBackgroundImage'] && (liStyle.push('background-image:' + customFeature['lineBackgroundImage']));
        liStyle = liStyle.join(";");
        // 用户自定义组件
        $.each(content, function(index, val) {
          switch(val.customFeature.action){
            case 'none':
                ahtml += '<li class="suspension-item diy" style="'+liStyle+'"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            case 'inner-link':
                // 页面跳转
                ahtml += '<li class="suspension-item router diy" style="'+liStyle+'" data-router="' + (val.customFeature['inner-page-link'] || val.customFeature['page-link']) + '"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            case 'custom-link':
                // 外部链接
                ahtml += '<li class="suspension-item diy" style="'+liStyle+'"><a href="' + clearWeixinHash(val.customFeature['custom-page-link'] || val.customFeature['page-link']) + '" target="_blank"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></a></li>';
                break;
            case 'weiye':
                // 微页
                ahtml += '<li class="suspension-item diy" style="'+liStyle+'"><a href="' + (val.customFeature['weiye-link'] || val.customFeature['page-link']) + '" target="_blank"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></a></li>';
                break;
            case 'call':
                // 拨打电话
                ahtml += '<li class="suspension-item diy" style="'+liStyle+'"><a href="tel:' + val.customFeature['phone-num'] + '"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></a></li>';
                break;
            case 'refresh-page':
                // 刷新页面
                ahtml += '<li class="suspension-item diy refresh" data-type="page" style="'+liStyle+'"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            case 'refresh-list':
                // 刷新列表
                ahtml += '<li class="suspension-item refresh diy" style="'+liStyle+'" data-type="list" data-target="' + val.customFeature.refresh_object + '" data-index="' + val.customFeature.index_segment + '" data-value="' + val.customFeature.index_value + '" ><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            case 'goods-trade':
                //跳转指定商品详情
                ahtml += '<li class="suspension-item router diy js-to-detail" style="'+liStyle+'" data-router="'+(val.customFeature['goods-type'] == 3 ? 'tostoreDetail':'goodsDetail')+'" data-id="' + val.customFeature['goods-id'] + '"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            case 'to-seckill':
                //跳转指定秒杀商品
                ahtml += '<li class="suspension-item router diy js-to-detail" style="'+liStyle+'" data-router="seckillDetail" data-id="' + val.customFeature['seckill-id'] + '"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            case 'to-franchisee':
                // 跳转指定商家
                ahtml += '<li class="suspension-item router diy js-to-detail" style="'+liStyle+'" data-router="franchiseeDetail" data-id="' + customFeature['franchisee-id'] + '"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            case 'community':
                //跳转社区版块
                ahtml += '<li class="suspension-item router diy js-to-detail" style="'+liStyle+'" data-router="communityPage" data-id="' + val.customFeature['community-id'] + '"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            case 'get-coupon':
                //跳转指定优惠券详情
                ahtml += '<li class="suspension-item router diy js-to-detail" style="'+liStyle+'" data-router="couponDetail" data-id="' + val.customFeature['coupon-id'] + '"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            case 'coupon-receive-list':
                // 跳转优惠券领取列表
                ahtml += '<li class="suspension-item router diy js-to-detail" style="'+liStyle+'" data-router="couponReceiveListPage"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            case 'recharge':
                // 储值金充值
                ahtml += '<li class="suspension-item router diy js-to-detail" style="'+liStyle+'" data-router="recharge"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            case 'transfer':
                // 跳转支付(当面付)页面
                ahtml += '<li class="suspension-item router diy js-to-detail" style="'+liStyle+'" data-router="transferPay"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            case 'to-promotion':
                // 跳转推广页面
                ahtml += '<li class="suspension-item diy to-promotion" style="'+liStyle+'"><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            case 'lucky-wheel':
                //跳转大转盘
                ahtml += '<li class="suspension-item router diy js-to-detail" style="'+liStyle+'" data-router="luckyWheelDetail" ><img style="width:'+ele.style['font-size']+';height:'+ele.style['font-size']+'" src="' + val.pic + '"/></li>';
                break;
            // default:
            //     ahtml = $('<li class="suspension-item"><img src="' + val.pic + '"/>');
          }
        });
        // 拼接用户选择了哪个组件
        $.each( appendComponent ,function(index, val) {
          if(val == true){
            switch (index) {
              case 'service':  //客服组件只能在小程序使用
                  ahtml += '<li class="suspension-item" data-type="service" style="'+liStyle+'"><span class="icon-service2"></span></li>';
                  break;
              case 'myOrder':
                  ahtml += '<li class="suspension-item router" data-router="myOrder" data-type="myOrder" style="'+liStyle+'"><span class="icon-notebook"></span></li>';
                  break;
              case 'shoppingCart':
                  ahtml += '<li class="suspension-item router" data-router="shoppingCart" data-type="shoppingCart" style="'+liStyle+'"><span class="icon-shoppingcart"></span></li>';
                  break;
              case 'top':
                  ahtml += '<li class="suspension-item" data-type="top" style="'+liStyle+'" ><span class="icon-top"></span></li>';
                  break;
            }
          }
        });

        $html = $('<div class="suspension" data-type="suspension"><ul class="">'+ahtml+'</ul></div>');
        _suspension.bindEvents($html);
        return $html;
      }

      _suspension.bindEvents = function(ele) {
        ele.on('click', 'li', function(event) {
          var type = $(this).attr("data-type");

          if(type == 'top'){
            $("body").scrollTop(0);
          }else if(type == 'service'){
            alertTip('客服组件只能在小程序使用');
          }
        });
      }
    }

    // 商品列表组件
    function GoodsListEle() {
      var _goodslist = this;

      _goodslist.index = 0;

      _goodslist.listInfos = {};
      _goodslist.parseElement = function(ele) {
        var customFeature = ele.customFeature || {},
            vesselStyle = ele.style || {},
            listStyle = {},
            containerWidth = ORIGINAL_PHONE_WIDTH - 10,
            titleWidth = {},
            imgStyle = {},
            ifAutoheight = customFeature.vesselAutoheight == 1 ? true : false,
            listEles = ele.content || [],
            isIntegral = customFeature.isIntegral ? 1 : 0,
            source = customFeature.source || 'none',
            $html = $('<div class="element goods-list list-vessel-wrap scroll-ele ' + (ifAutoheight ? 'js-scroll-loading-ele' : '') + '" data-id="' + customFeature.id + '" data-form='+customFeature.form+' data-type="goods-list"><ul class="js-list-container '+(customFeature.mode == 2 ? 'third-goods-list' : '')+'"   data-list-index="' + _goodslist.index + '"></ul></div>');

        customFeature.height ? vesselStyle.height = customFeature.height : vesselStyle.height = '300px';
        customFeature['background-color'] && (vesselStyle['background-color'] = customFeature['background-color']);
        customFeature['background-image'] && (vesselStyle['background-image'] = 'url(' + customFeature['background-image'] + ')');
        (customFeature.margin >= 0) && (listStyle['margin-bottom'] = customFeature.margin + 'px');
        customFeature.lineBackgroundColor && (listStyle['background-color'] = customFeature.lineBackgroundColor);
        customFeature.lineBackgroundImage && (listStyle['background-image'] = 'url(' + customFeature.lineBackgroundImage + ')');
        customFeature.lineHeight && (listStyle['height'] = customFeature.lineHeight);
        if (customFeature.imgWidth) {
          imgStyle.width = customFeature.imgWidth;
          titleWidth = { 'width': customFeature.mode == 1 ? '100%' : (customFeature.mode == 2 ? imgStyle.width : (containerWidth - imgStyle.width)) };
        }
        customFeature.imgHeight && (imgStyle.height = customFeature.imgHeight);
        ifAutoheight && (vesselStyle.height = 'auto');
        $html.css(vesselStyle);

        var listInfo = { form: customFeature.form, mode: customFeature.mode, source: source, page: 1, page_size: 20, listStyle: listStyle, listEles: listEles, link: customFeature.link, imgStyle: imgStyle, titleWidth: titleWidth, isIntegral: isIntegral , isShoppingCart: customFeature.isShoppingCart, isHideSales: customFeature.isHideSales, isHideStock:customFeature.isHideStock  ,isBuyNow: customFeature.isBuyNow };

        _goodslist.listInfos[_goodslist.index++] = listInfo;

        _goodslist.getListData($html.children('.js-list-container'));
        _goodslist.bindScrollEvent($html, ifAutoheight);
        _goodslist.bindEvent($html);

        return $html;
      };
      // 获取列表数据
      _goodslist.getData = function($container, param, listInfo) {
        $container.addClass('js-requesting');
        $ajax('/index.php?r=AppShop/GetGoodsList', 'get', param, 'json', function(data) {
          if (data.status == 0) {
            if (data.is_more == 0) {
              $container.addClass('js-no-more');
            };
            _goodslist.parseData($container, data.data, listInfo);
          } else {
            alertTip('请求数据失败，请重试。' + data.data);
          };
          $container.removeClass('js-requesting');
        }, function() {
          $container.removeClass('js-requesting');
          alertTip('请求数据失败，请重试');
        });
      };
      _goodslist.parseData = function($container, data, listInfo) {
        $(data).each(function(index, item) {
//        if(index>2){
//          $(".list-more-show .js-list-container").append(_goodslist.parseSingleData(item, listInfo));
//        }
          if(item.form_data.goods_type == 3){
            var data = item.form_data,
                maxMinArr = [],
                pri = '';

            if(data.goods_model && (data.goods_model.length >= 2)){
              for(var j = 0; j < data.goods_model.length; j++){
                maxMinArr.push(data.goods_model[j].price);
              }
              if(Math.min.apply(null, maxMinArr) != Math.max.apply(null, maxMinArr)){
                pri = Math.min.apply(null, maxMinArr).toFixed(2) +'-'+ Math.max.apply(null, maxMinArr).toFixed(2);
                data.price = pri;
              }
            }

            if(!isbusinessTimeFirstPage){
              var currentTime = new Date().getHours().toString()+ new Date().getMinutes().toString(),
                  showFlag = true,
                  showTime = '';
              $.ajax({
                url: '/index.php?r=pc/AppShop/getBusinessTime',
                type: 'get',
                data: {
                    app_id: appId
                },
                dataType: 'json',
                success: function(res) {
                  var businessTime = res.data.business_time;
                  if (businessTime){
                    for (var i = 0; i < businessTime.length;i++){
                      showTime += businessTime[i].start_time.substring(0, 2) + ':' + businessTime[i].start_time.substring(2, 4) + '-' + businessTime[i].end_time.substring(0, 2) + ':' + businessTime[i].end_time.substring(2, 4) + ' / ';
                      if (currentTime > businessTime[i].start_time && currentTime < businessTime[i].end_time){
                        showFlag = false;
                      }
                    }
                    if (showFlag){
                      showTime = showTime.substring(0,showTime.length - 2);
                      // _this.showModal({
                      //   content: '店铺休息中,暂时无法接单。营业时间为：' + showTime
                      // })
                      confirmTip({content:'店铺休息中,暂时无法接单。营业时间为：' + showTime },function(){})
                    }
                  }
                }
              });
            }

          }

          $container.append(_goodslist.parseSingleData(item, listInfo));
        });
      };
      _goodslist.parseSingleData = function(item, listInfo) {
        var formData = item['form_data'],
            $li = $('<li class="goods-list-item background-ele router js-to-detail ' + ((listInfo.mode && listInfo.mode == 1) ? 'double-goods-list' : '') + '"data-id=' + formData.id +' data-router='+ ((formData.goods_type == 3) ? '"tostoreDetail"' : '"goodsDetail"')+' data-router-hidestock="'+(listInfo.isHideStock || '')+'"></li>').css(listInfo.listStyle),
            $addElement;

        if (listInfo.listEles.length) {
          $(listInfo.listEles).each(function(index, el) {
            switch (el.type) {
              case 'count-ele':
                var relValue = listInfo.form + '_' + item.id;
                $addElement = APP.parseElement(el, { relValue: relValue, count_num: item.count_num, has_count: item.has_count });
                break;

              default:

                $addElement = APP.parseElement(el, item);
            }
            $li.append($addElement);
          });

        } else {
          $li.append(_goodslist.addItem(formData, listInfo));
        }

        return $li;
      };

      _goodslist.addItem = function(formData, listInfo) {
        var listStyle = listInfo.listStyle,
            imgStyle = listInfo.imgStyle,
            titleWidth = listInfo.titleWidth,
            fragment = $(document.createDocumentFragment()),
            $content = $('<div class="inner-content"></div>'),
            $img = $('<img class="list-img" src=' + formData.cover + '>'),
            $titles = $('<div class="title-container"><p class="title">' + formData.title + '</p></div>'),
            sales =  listInfo.isHideSales  ? '' : '<span class="sales">销量：' + formData.sales + '</span>',
            $titleP = $('<p><span class="price">￥' + formData.price + '</span>'+ sales + ((listInfo.isShoppingCart && (listInfo.form == 'goods' || listInfo.form == 'tostore')) ? '<span class="addShoppingcart icon-addshoppingcart '+(listInfo.form == 'tostore'? 'tostore' : '')+' '+(listInfo.isBuyNow ? 'isbuynow' : '')+'"></span>' : '') +'</p>');
          // $secTitle = $('<p class="sec-title js-sec-target">'+secTitle+'</p>');

            listStyle && listStyle.backgroundImage ? fragment.append('<img src="' + listStyle.backgroundImage + '" class="bg-img-ele full-img"/>') : '';

            imgStyle && $img.css(imgStyle);
            $content.append($img);

            titleWidth && $titleP.css(titleWidth);
            $titles.append($titleP);

        titleWidth && $titles.css(titleWidth);
        // secTittleStyle && $secTitle.css(secTittleStyle);
        // $titles.append($secTitle);
        $content.append($titles);

        listStyle && fragment.css(listStyle);
        fragment.append($content);

        return fragment;
      };

      // 绑定滚动请求数据
      _goodslist.bindScrollEvent = function($target, ifAutoheight) {
        if (ifAutoheight) {
          // 自适应高度的列表滚动加载绑定在window上
          return;
        } else {
          _goodslist.bindSelfScrollEvent($target);
        }
      };
      // 高度固定的列表的滚动加载
      _goodslist.bindSelfScrollEvent = function($target) {
        var triggerSpot = 50,
            $container = $target.children('.js-list-container');

        $target.on('scroll', function(event) {
          if ($container.hasClass('js-no-more') || $container.hasClass('js-requesting')) {
            return;
          }
          var ifRequest = $container.height() - ($target.height() + $target.scrollTop() * ratio) < triggerSpot;
          if (ifRequest) {
            _goodslist.getListData($container);
          }
        });
      };
      _goodslist.bindEvent = function($target) {
        // 绑定直接添加购物按钮事件
        $target.on('click', '.addShoppingcart', function(event) {
          event.stopPropagation();
          var _this = $(this),
              _li = _this.closest('li'),
              goods_id =  _li.attr("data-id");

          if (!APP.checkIfLogin()) {
            APP.goLogin();
          } else {
            if(_this.hasClass('loading')){
                return ;
            }
            _this.addClass('loading');

            $ajax('/index.php?r=AppShop/getGoods', 'get', {
              app_id: appId,
              data_id: goods_id
            }, 'json', function(data) {
              if (data.status === 0) {
                if(_this.hasClass('tostore')){
                  EleObjects['tostore-pay-ele'].showPayDialog('shoppingcart', data );
                }else if(_this.hasClass('isbuynow')){
                  EleObjects['pay-ele'].showPayDialog('listshopping', data );
                }else{
                  EleObjects['pay-ele'].showPayDialog('shoppingcart', data );
                }
              } else if (data.status === 2) {
                alertTip('请先登录账号', function() {
                    APP.showLogin();
                }, 700);
              } else {
                alertTip('请求数据失败，' + data.data);
              }
              _this.removeClass('loading');
            }, function() {
              _this.removeClass('loading');
              alertTip('请求数据失败，请重试');
            });
          };
        });
      }
      // 自适应高度滚动获取列表数据时调用的函数
      _goodslist.getListData = function($container) {
        // $container.addClass('js-requesting');
        var index = $container.attr('data-list-index'),
            targetListInfo = _goodslist.listInfos[index],
            param = {
              app_id: appId,
              page: targetListInfo.page++,
              page_size: targetListInfo.page_size,
              form: targetListInfo.form,
              sort_key: $container.parent('.list-vessel-wrap').data('sortkey'),
              sort_direction : $container.parent('.list-vessel-wrap').data('sortby'),
              is_integral: targetListInfo.isIntegral
            };

        if (targetListInfo.source != '' && targetListInfo.source != 'none') {
          param.idx_arr = {
            idx: 'category',
            idx_value: targetListInfo.source
          };
        }
        if ($container.hasClass('js-search-mode')) {
          param.idx_arr = {
            idx: $container.attr('data-index'),
            idx_value: $container.attr('data-value')
          };
        }
        _goodslist.getData($container, param, targetListInfo);
      };
      // 按参数请求刷新列表
      _goodslist.refresh = function($list, index_segment, index_value, sort_key, sort_direction) {
        var $container = $list.children('.js-list-container'),
            index = $container.attr('data-list-index'),
            targetListInfo = _goodslist.listInfos[index],
            param = {
              app_id: appId,
              page: 1,
              page_size: 20,
              form: targetListInfo.form,
              idx_arr: {
                idx: (targetListInfo.source != 'none') ? 'category' : index_segment,
                idx_value: (targetListInfo.source != 'none') ? targetListInfo.source : index_value
              },
              sort_key: sort_key,
              sort_direction: sort_direction,
              is_integral: _goodslist.listInfos[index].isIntegral
            };

        targetListInfo.page = 2;
        $container.addClass('js-search-mode').attr('data-index', index_segment).attr('data-value', index_value).empty();
        _goodslist.getData($container, param, targetListInfo);
      };
      // 按搜索结果刷新列表
      _goodslist.search = function(keyword,$list,form){
        console.log(keyword + ' ' + appId);
        var $container = $list.children('.js-list-container'),
            index = $container.attr('data-list-index'),
            targetListInfo = _goodslist.listInfos[index];

        targetListInfo.page = 2;
        $container.addClass('js-requesting');
        showLoading();
        $.ajax({
          url: '/index.php?r=appShop/search&search={"data":[{"_allkey":"'+keyword+'","form":"'+form+'"}], "app_id":"'+appId+'"}',
          type: 'post',
          dataType: 'json',
          success: function(data) {
            console.log(data);
            if (data.is_more == 0) {
              $container.addClass('js-no-more');
            };
            removeLoading();
            if(data.data.length === 0){
              $("#searchPage .quick-tags").show();
              $list.children("ul").empty();
              alertTip("没有找到"+ keyword +"相关的数据！");
              return;
            }
            $("#searchPage .quick-tags").hide();
            $list.children("ul").empty();
            _goodslist.parseData($container,data.data,targetListInfo);
            $container.removeClass('js-requesting');
            $list.parent().show();
          },
          error:function(data){
            removeLoading();
            alertTip("请求出错"+ keyword);
            console.log(data.data);
          }
        });
      }
      // 按城市定位刷新列表
      _goodslist.locationList = function(form, region_id, $list){
        var param = {
              'form':form,
              'app_id':appId,
              idx_arr:{
                idx:'region_id',
                idx_value: region_id
              }
            },
            $container = $list.children('.js-list-container'),
            index = $container.attr('data-list-index'),
            targetListInfo = _goodslist.listInfos[index];

        $.ajax({
          url: '/index.php?r=AppData/GetFormDataList',
          type: 'get',
          dataType: 'json',
          data: param,
          success:function(data){
            if(data.data.length === 0){
              $list.children("ul").empty();
              alertTip("没有找到相关的数据！");
              return;
            }
            $list.children("ul").empty();
            _goodslist.parseData($container,data.data,targetListInfo);
            $container.removeClass('js-requesting');
            $list.parent().show();
          },
          error:function(data){
            removeLoading();
            alertTip("请求出错");
          }
        })
      }
    }


    // 秒杀商品组件
    function Seckill() {
      var _seckill = this;

      _seckill.index = 0; // 商品列表组件的索引值，每编译一个容器列表便自增1
      /*
       * listInfos保存每个商品列表组件应该保存的信息，请求新数据渲染时需要用到，用唯一的index索引值来查找
       * form：数据对象，source：数据源，page：第几页数据，listStyle：每一项的样式，listEles：每一项包含的组件
       */
      _seckill.listInfos = {};
      _seckill.parseElement = function(ele) {
        var customFeature = ele.customFeature || {},
            vesselStyle = ele.style || {},
            listStyle = {},
            containerWidth = ORIGINAL_PHONE_WIDTH - 10,
            titleWidth = {},
            imgStyle = {},
            ifAutoheight = customFeature.vesselAutoheight == 1 ? true : false,
            listEles = ele.content || [],
            isIntegral = customFeature.isIntegral ? 1 : 0,
            source = customFeature.source || 'none',
            $html = $('<div class="element seckill list-vessel-wrap scroll-ele ' + (ifAutoheight ? 'js-scroll-loading-ele' : '') + '" data-id="' + customFeature.id + '" data-form='+customFeature.form+' data-type="goods-list"><ul class="js-list-container '+(customFeature.mode == 2 ? 'third-goods-list' : '')+'"   data-list-index="' + _seckill.index + '"></ul></div>');

        customFeature.height ? vesselStyle.height = customFeature.height : vesselStyle.height = '300px';
        customFeature['background-color'] && (vesselStyle['background-color'] = customFeature['background-color']);
        customFeature['background-image'] && (vesselStyle['background-image'] = 'url(' + customFeature['background-image'] + ')');
        (customFeature.margin >= 0) && (listStyle['margin-bottom'] = customFeature.margin + 'px');
        customFeature.lineBackgroundColor && (listStyle['background-color'] = customFeature.lineBackgroundColor);
        customFeature.lineBackgroundImage && (listStyle['background-image'] = 'url(' + customFeature.lineBackgroundImage + ')');
        customFeature.lineHeight && (listStyle['height'] = customFeature.lineHeight);
        if (customFeature.imgWidth) {
            imgStyle.width = customFeature.imgWidth;
            titleWidth = { 'width': customFeature.mode == 1 ? '100%' : (customFeature.mode == 2 ? imgStyle.width : (containerWidth - imgStyle.width)) };
        }
        customFeature.imgHeight && (imgStyle.height = customFeature.imgHeight);
        ifAutoheight && (vesselStyle.height = 'auto');
        $html.css(vesselStyle);

        var listInfo = { form: customFeature.form, mode: customFeature.mode, source: source, page: 1, page_size: 20, listStyle: listStyle, listEles: listEles, link: customFeature.link, imgStyle: imgStyle, titleWidth: titleWidth, isIntegral: isIntegral , isShoppingCart: customFeature.isShoppingCart};

        _seckill.listInfos[_seckill.index++] = listInfo;
        _seckill.getListData($html.children('.js-list-container'));
        _seckill.bindScrollEvent($html, ifAutoheight);
        _seckill.bindEvent($html);
        return $html;
      };
      // 获取列表数据
      _seckill.getData = function($container, param, listInfo) {
        $container.addClass('js-requesting');
        $ajax('/index.php?r=AppShop/GetGoodsList', 'get', param, 'json', function(data) {
          if (data.status == 0) {
            if (data.is_more == 0) {
              $container.addClass('js-no-more');
            };
            console.log(data);
            _seckill.parseData($container, data.data, listInfo);
          } else {
            alertTip('请求数据失败，请重试。' + data.data);
          };
          $container.removeClass('js-requesting');
        }, function() {
          $container.removeClass('js-requesting');
          alertTip('请求数据失败，请重试');
        });
      };
      // $container: 新增数据的列表，data: 数据，listInfo: 列表项的信息
      _seckill.parseData = function($container, data, listInfo) {
        $(data).each(function(index, item) {
          // if(index>2){
          //   $(".list-more-show .js-list-container").append(_seckill.parseSingleData(item, listInfo));
          // }
          $container.append(_seckill.parseSingleData(item, listInfo));
        });
      };
      _seckill.parseSingleData = function(item, listInfo) {
        var formData = item['form_data'],
            $li = $('<li class="goods-list-item background-ele router js-to-detail ' + ((listInfo.mode && listInfo.mode == 1) ? 'double-goods-list' : '') + '"data-id="' + formData.id +'" data-router="seckillDetail"></li>').css(listInfo.listStyle),
            $addElement;

        if (listInfo.listEles.length) {
          $(listInfo.listEles).each(function(index, el) {
            switch (el.type) {
              case 'count-ele':
                  // 当列表中有计数组件时，需额外传rel_obj和计数
                  var relValue = listInfo.form + '_' + item.id;
                  $addElement = APP.parseElement(el, { relValue: relValue, count_num: item.count_num, has_count: item.has_count });
                  break;
                  // case 'layout-vessel':
                  // case 'free-vessel':
                  //  $addElement = APP.parseElement(el, formData);
                  //  break;
              default:
                  //  el.customFeature && el.customFeature.segment && (el.content = formData[el.customFeature.segment]);
                  // $addElement = APP.parseElement(el);
                  $addElement = APP.parseElement(el, item);
            }
            $li.append($addElement);
          });
        } else {
          $li.append(_seckill.addItem(formData, listInfo));
          // $li.append('<img class="list-img" src="'+formData.cover+'"><div class="title-container"><p class="title">'+formData.title+'</p></div>');
          // <p><span class="purchase-trigger goods-purchase">&plus;</span></p>
        }
        return $li;
      };

      _seckill.addItem = function(formData, listInfo) {
        var listStyle = listInfo.listStyle,
            imgStyle = listInfo.imgStyle,
            titleWidth = listInfo.titleWidth,
            fragment = $(document.createDocumentFragment()),
            $content = $('<div class="inner-content"></div>'),
            $img = $('<img class="list-img" src=' + formData.cover + '>'),
            $titles = $('<div class="title-container"><p class="title">' + formData.title + '</p></div>'),
            // sales =  (listInfo.isShoppingCart && listInfo.mode == 1 && listInfo.form == 'goods') ? '' : '<span class="sales">数量：' + formData.sales + '</span>',
            $titleP = '',
            seckillStatus = 0;  //秒杀状态 0 未开始 1 正在进行 2 已结束

        seckillStatus = formData.seckill_start_state;

        if(listInfo.mode == 1 || listInfo.mode == 2){
           $titleP = $('<div class="seckill-list-bottom"><div><span class="price">￥' + formData.seckill_price + '</span><span class="oldprice">￥' + formData.price + '</span></div>'
              +'<div><div class="seckill-progress-wrap"><span>已售'+formData.seckill_progress+'%</span><div class="seckill-progress"><span style="width: '+formData.seckill_progress+'%;"></span></div></div>'
              +'<div class="countdown"><label></label><span class="hours">00</span>:<span class="minutes">00</span>:<span class="seconds">00</span></div></div></div>');
        }else{
          $titleP = $('<div class="seckill-list-bottom"><div><span class="price">￥' + formData.seckill_price + '</span><div class="countdown"><label>'+(seckillStatus == 0 ? '距开始' : '距结束')+'</label><span class="hours">00</span>:<span class="minutes">00</span>:<span class="seconds">00</span></div></div>'
              +'<div class="oldPrice-wrap"><span class="oldprice">￥' + formData.price + '</span>' + ((listInfo.isShoppingCart && (listInfo.form == 'goods' || listInfo.form == 'tostore')) ? '<span class="addShoppingcart icon-addshoppingcart"></span>' : '')
              +'<div class="seckill-progress-wrap"><span>已售'+formData.seckill_progress+'%</span><div class="seckill-progress"><span style="width: '+formData.seckill_progress+'%;"></span></div></div></div></div>');
        }

        if(seckillStatus == 0){
          _seckill.beforeDownCount($titleP , formData);
        }else if(seckillStatus == 1){
          _seckill.duringDownCount($titleP , formData);
        }else if(seckillStatus == 2){
          $titleP.addClass('seckill-end').find('.countdown').children('label').text('已结束');
        }

        listStyle && listStyle.backgroundImage ? fragment.append('<img src="' + listStyle.backgroundImage + '" class="bg-img-ele full-img"/>') : '';

        imgStyle && $img.css(imgStyle);
        $content.append($img);

        titleWidth && $titleP.css(titleWidth);
        $titles.append($titleP);

        titleWidth && $titles.css(titleWidth);
        $content.append($titles);

        listStyle && fragment.css(listStyle);
        fragment.append($content);

        return fragment;
      };

      // 秒杀开始之前倒计时
      _seckill.beforeDownCount = function( ele , formData ) {
        ele.find('.countdown').children('label').text('距开始');
        ele.removeClass('seckill-during seckill-end');
        downCount({
          ele : ele.find('.countdown') ,
          startTime : formData.server_time ,
          endTime : formData.seckill_start_time ,
          callback : function() {
            formData.server_time = formData.seckill_start_time;
            _seckill.duringDownCount( ele , formData );
          }
        });
      };
      // 秒杀正在进行倒计时
      _seckill.duringDownCount = function( ele , formData ) {
        ele.find('.countdown').children('label').text('距结束');
        ele.removeClass('seckill-end').addClass('seckill-during');
        downCount({
          ele : ele.find('.countdown') ,
          startTime : formData.server_time ,
          endTime : formData.seckill_end_time,
          callback : function() {
            ele.removeClass('seckill-during').addClass('seckill-end');
          }
        });
      };

      // 绑定滚动请求数据
      _seckill.bindScrollEvent = function($target, ifAutoheight) {
        if (ifAutoheight) {
          // 自适应高度的列表滚动加载绑定在window上
          return;
        } else {
          _seckill.bindSelfScrollEvent($target);
        }
      };
      // 高度固定的列表的滚动加载
      _seckill.bindSelfScrollEvent = function($target) {
        var triggerSpot = 50,
            $container = $target.children('.js-list-container');

        $target.on('scroll', function(event) {
          if ($container.hasClass('js-no-more') || $container.hasClass('js-requesting')) {
            return;
          }
          var ifRequest = $container.height() - ($target.height() + $target.scrollTop() * ratio) < triggerSpot;
          if (ifRequest) {
            _seckill.getListData($container);
          }
        });
      };
      _seckill.bindEvent = function($target) {
        // 绑定直接添加购物按钮事件
        $target.on('click', '.addShoppingcart', function(event) {
          event.stopPropagation();
          var _this = $(this),
              _li = _this.closest('li'),
              goods_id =  _li.attr("data-id");

          if (!APP.checkIfLogin()) {
            APP.goLogin();
          } else {
            if(_this.hasClass('loading')){
              return ;
            }
            _this.addClass('loading');

            $ajax('/index.php?r=AppShop/getGoods', 'get', {
              app_id: appId,
              data_id: goods_id
            }, 'json', function(data) {
              if (data.status === 0) {
                  EleObjects['pay-ele'].showPayDialog('shoppingcart', data );
              } else if (data.status === 2) {
                  alertTip('请先登录账号', function() {
                      APP.showLogin();
                  }, 700);
              } else {
                  alertTip('请求数据失败，' + data.data);
              }
              _this.removeClass('loading');
            }, function() {
              _this.removeClass('loading');
              alertTip('请求数据失败，请重试');
            });
          };
        });
      }

      // 自适应高度滚动获取列表数据时调用的函数
      _seckill.getListData = function($container) {
        // $container.addClass('js-requesting');
        var index = $container.attr('data-list-index'),
            targetListInfo = _seckill.listInfos[index],
            param = {
                app_id: appId,
                page: targetListInfo.page++,
                page_size: targetListInfo.page_size,
                form: targetListInfo.form,
                sort_key: $container.parent('.list-vessel-wrap').data('sortkey'),
                sort_direction : $container.parent('.list-vessel-wrap').data('sortby'),
                is_integral: targetListInfo.isIntegral,
                is_seckill: 1
            };

        if (targetListInfo.source != '' && targetListInfo.source != 'none') {
          param.idx_arr = {
            idx: 'category',
            idx_value: targetListInfo.source
          };
        }
        if ($container.hasClass('js-search-mode')) {
          param.idx_arr = {
            idx: $container.attr('data-index'),
            idx_value: $container.attr('data-value')
          };
        }
        _seckill.getData($container, param, targetListInfo);
      };
      // 按参数请求刷新列表
      _seckill.refresh = function($list, index_segment, index_value, sort_key, sort_direction) {
        var $container = $list.children('.js-list-container'),
            index = $container.attr('data-list-index'),
            targetListInfo = _seckill.listInfos[index],
            param = {
              app_id: appId,
              page: 1,
              page_size: 20,
              form: targetListInfo.form,
              idx_arr: {
                idx: (targetListInfo.source != 'none') ? 'category' : index_segment,
                idx_value: (targetListInfo.source != 'none') ? targetListInfo.source : index_value
              },
              sort_key: sort_key,
              sort_direction: sort_direction
            };

        targetListInfo.page = 2;
        $container.addClass('js-search-mode').attr('data-index', index_segment).attr('data-value', index_value).empty();
        _seckill.getData($container, param, targetListInfo);
      };
      // 按搜索结果刷新列表
      _seckill.search = function(keyword,$list,form){
        console.log(keyword + ' ' + appId);
        var $container = $list.children('.js-list-container'),
            index = $container.attr('data-list-index'),
            targetListInfo = _seckill.listInfos[index];

        targetListInfo.page = 2;
        $container.addClass('js-requesting');
        showLoading();
        $.ajax({
          url: '/index.php?r=appShop/search&search={"data":[{"_allkey":"'+keyword+'","form":"'+form+'"}], "app_id":"'+appId+'"}',
          type: 'post',
          dataType: 'json',
          success: function(data) {
            console.log(data);
            if (data.is_more == 0) {
              $container.addClass('js-no-more');
            };
            removeLoading();
            if(data.data.length === 0){
              $("#searchPage .quick-tags").show();
              $list.children("ul").empty();
              alertTip("没有找到"+ keyword +"相关的数据！");
              return;
            }
            $("#searchPage .quick-tags").hide();
            $list.children("ul").empty();
            _seckill.parseData($container,data.data,targetListInfo);
            $container.removeClass('js-requesting');
            $list.parent().show();
          },
          error:function(data){
            removeLoading();
            alertTip("请求出错"+ keyword);
            console.log(data.data);
          }
        });
      }

        // 按城市定位刷新列表
      _seckill.locationList = function(form, region_id, $list){
        var param = {
              'form':form,
              'app_id':appId,
              idx_arr:{
                idx:'region_id',
                idx_value: region_id
              }
            },
            $container = $list.children('.js-list-container'),
            index = $container.attr('data-list-index'),
            targetListInfo = _seckill.listInfos[index];

        $.ajax({
          url: '/index.php?r=AppData/GetFormDataList',
          type: 'get',
          dataType: 'json',
          data: param,
          success:function(data){
            if(data.data.length === 0){
              $list.children("ul").empty();
              alertTip("没有找到相关的数据！");
              return;
            }
            $list.children("ul").empty();
            _seckill.parseData($container,data.data,targetListInfo);
            $container.removeClass('js-requesting');
            $list.parent().show();
          },
          error:function(data){
            removeLoading();
            alertTip("请求出错");
          }
        })
      }
    }


    function FranchiseeListEle(){
      var _franchiseelist = this,
          latitude, longitude;

      _franchiseelist.index = 0; // 商家列表组件的索引值，每编译一个容器列表便自增1
      /*
       * listInfos保存每个商品列表组件应该保存的信息，请求新数据渲染时需要用到，用唯一的index索引值来查找
       * form：数据对象，source：数据分类，page：第几页数据，listStyle：每一项的样式
       */
      _franchiseelist.listInfos = {};
      _franchiseelist.parseElement = function(ele) {
        var customFeature = ele.customFeature || {},
            vesselStyle = ele.style || {},
            listStyle = {},
            containerWidth = ORIGINAL_PHONE_WIDTH - 10,
            titleWidth = {},
            imgStyle = {},
            ifAutoheight = customFeature.vesselAutoheight == 1 ? true : false,
            source = customFeature.source || 'none',
            $html = $('<div class="element franchisee-list list-vessel-wrap scroll-ele ' + (ifAutoheight ? 'js-scroll-loading-ele' : '') + '" data-id="' + customFeature.id + '" data-form='+customFeature.form+' data-type="franchisee-list"><div class="franchisee-title"><div class="franchisee-location"><span class="icon-location"></span> <label>定位中...</label></div>附近商家</div><ul class="js-list-container"  data-list-index="' + _franchiseelist.index + '"></ul></div>');

        customFeature.height ? vesselStyle.height = customFeature.height : vesselStyle.height = '300px';
        customFeature['background-color'] && (vesselStyle['background-color'] = customFeature['background-color']);
        customFeature['background-image'] && (vesselStyle['background-image'] = 'url(' + customFeature['background-image'] + ')');
        (customFeature.margin >= 0) && (listStyle['margin-bottom'] = customFeature.margin + 'px');
        customFeature.lineBackgroundColor && (listStyle['background-color'] = customFeature.lineBackgroundColor);
        customFeature.lineBackgroundImage && (listStyle['background-image'] = 'url(' + customFeature.lineBackgroundImage + ')');
        customFeature.lineHeight && (listStyle['height'] = customFeature.lineHeight);
        if (customFeature.imgWidth) {
          imgStyle.width = customFeature.imgWidth;
          titleWidth = { 'width': (containerWidth - imgStyle.width) };
        }
        customFeature.imgHeight && (imgStyle.height = customFeature.imgHeight);
        ifAutoheight && (vesselStyle.height = 'auto');
        $html.css(vesselStyle);

        var listInfo = { form: customFeature.form, mode: customFeature.mode, source: source, page: -1, page_size: 20, listStyle: listStyle, imgStyle: imgStyle, titleWidth: titleWidth };

        _franchiseelist.listInfos[_franchiseelist.index++] = listInfo;
        _franchiseelist.bindScrollEvent($html, ifAutoheight);

        if(!isWeixin){
          $html.find('.franchisee-title').css('text-align', 'left').find('.franchisee-location').css('display', 'none');
          _franchiseelist.getListData($html.children('.js-list-container'));

        } else {
          if(navigator.geolocation){
            //浏览器支持geolocation
            navigator.geolocation.getCurrentPosition(function(position){
              latitude = position.coords.latitude;
              longitude =position.coords.longitude;

              $.ajax({
                url: '/index.php?r=Region/GetAreaInfoByLatAndLng',
                data: {
                  latitude: latitude,
                  longitude: longitude
                },
                dataType: 'json',
                success: function(res){
                  if(res.status !== 0) { alertTip(data.data); return;}
                  var address = res.data.addressComponent.street + res.data.sematic_description;
                  $html.find('.franchisee-location > label').text(address).click(function(){
                    APP.showResetLocation({
                      address: address,
                      listId: customFeature.id
                    });
                  });
                }
              });
              _franchiseelist.getListData($html.children('.js-list-container'));
            }, function(){
              _franchiseelist.getListData($html.children('.js-list-container'));
            });
          } else {
            _franchiseelist.getListData($html.children('.js-list-container'));
            $html.find('.franchisee-location > label').text('您使用的浏览器不支持地理定位');
          }
        }
        return $html;
      };
      // 获取列表数据
      _franchiseelist.getData = function($container, param, listInfo) {
        $container.addClass('js-requesting');
        $ajax('/index.php?r=AppShop/GetAppShopByPage', 'get', param, 'json', function(data) {
          if (data.status == 0) {
            if (data.is_more == 0) {
              $container.addClass('js-no-more');
            }
            console.log(data);
            _franchiseelist.parseData($container, data.data, listInfo);

          }else if(data.status == 2){
            alertTip('请先登录账号', function() {
              APP.showLogin();
            }, 700);
            return;
          } else {
            alertTip('请求数据失败，请重试。' + data.data);
          }
          $container.removeClass('js-requesting');
        }, function() {
          $container.removeClass('js-requesting');
          alertTip('请求数据失败，请重试');
        });
      };
      // $container: 新增数据的列表，data: 数据，listInfo: 列表项的信息
      _franchiseelist.parseData = function($container, data, listInfo) {
        $(data).each(function(index, item) {
          $container.append(_franchiseelist.parseSingleData(item, listInfo));
        });
      };
      _franchiseelist.parseSingleData = function(item, listInfo) {
        var $li = $('<li class="franchisee-list-item background-ele router js-to-detail ' + ((listInfo.mode && listInfo.mode == 1) ? 'double-franchisee-list' : '') +' '+ (item.is_open == 0 ? 'not-open' : '') +'" data-id=' + item.app_id + ' data-router="franchiseeDetail"></li>').css(listInfo.listStyle);

        $li.append(_franchiseelist.addItem(item, listInfo));
        return $li;
      };

      _franchiseelist.addItem = function(item, listInfo) {


        var listStyle = listInfo.listStyle,
            imgStyle = listInfo.imgStyle,
            titleWidth = listInfo.titleWidth,
            fragment = $(document.createDocumentFragment()),
            $content = $('<div class="inner-content"><span class="not-open-tip">休息中</span></div>'),
            $goodsnum = $('<div class="cart-goods-num">'+item.cart_goods_num+'</div>'),
            $img = $('<img class="list-img" src=' + item.picture + '>'),
            $titles = $('<div class="title-container"><p class="title">' + item.name + '</p><p class="item-distance">距你：<span class="distance">'+(item.distance < 1000 ? Math.round(item.distance) + 'm' : (item.distance/1000).toFixed(1) + 'km')+'</span></p><p class="item-phone">电话：<span class="franchisee-phone">'+item.phone+'</span></p></div>'),
            $item_goods=$('<div class="franchisee-list-goods" style="height:'+listStyle.height+'px"></div>');
           //判断优惠券是否存在
           if(item.coupon_list.best_subtract_value==''&&item.coupon_list.best_discount==''){
          $coupon=$('<div class="discount-coupons"><div>');
           }else if(item.coupon_list.best_subtract_value==''&&item.coupon_list.best_discount!=''){
           	$coupon=$('<div class="discount-coupons"><p class="coupons-rebate"><span>折</span>进店领取'+item.coupon_list.best_discount+'折优惠券</p><div>')
           }else if(item.coupon_list.best_subtract_value!=''&&item.coupon_list.best_discount==''){
           	$coupon=$('<div class="discount-coupons"><p class="coupons-cash"><span>减</span>进店领取'+item.coupon_list.best_subtract_value+'元优惠券</p><div>')
           }else if(item.coupon_list.best_subtract_value!=''&&item.coupon_list.best_discount!=''){
           	$coupon=$('<div class="discount-coupons"><p class="coupons-cash"><span>减</span>进店领取'+item.coupon_list.best_subtract_value+'元优惠券</p><p class="coupons-rebate"><span>折</span>进店领取'+item.coupon_list.best_discount+'折优惠券</p><div>')
           }



        listStyle && listStyle.backgroundImage ? fragment.append('<img src="' + listStyle.backgroundImage + '" class="bg-img-ele full-img"/>') : '';

        item.cart_goods_num && item.cart_goods_num != 0 && $content.append($goodsnum);

        imgStyle && $img.css(imgStyle);
        $content.append($img);

        titleWidth && $titles.css(titleWidth);
        $titles.find('.description').html(item.description.replace(/\\n/g, '<br>'));
        $content.append($titles);

        //item.distance && $content.append('<view class="distance">'+(item.distance < 1000 ? Math.round(item.distance) + 'm' : (item.distance/1000).toFixed(1) + 'km')+'</view>');

        listStyle && fragment.css(listStyle);
        $item_goods.append($content);
        fragment.append($item_goods).append($coupon);
        return fragment;
      };

      // 绑定滚动请求数据
      _franchiseelist.bindScrollEvent = function($target, ifAutoheight) {
        if (ifAutoheight) {
          // 自适应高度的列表滚动加载绑定在window上
          return;
        } else {
          _franchiseelist.bindSelfScrollEvent($target);
        }
      };
      // 高度固定的列表的滚动加载
      _franchiseelist.bindSelfScrollEvent = function($target) {
        var triggerSpot = 50,
            $container = $target.children('.js-list-container');

        $target.on('scroll', function(event) {
          if ($container.hasClass('js-no-more') || $container.hasClass('js-requesting')) {
            return;
          }
          var ifRequest = $container.height() - ($target.height() + $target.scrollTop() * ratio) < triggerSpot;
          if (ifRequest) {
            _franchiseelist.getListData($container);
          }
        });
      };
      // 自适应高度滚动获取列表数据时调用的函数
      _franchiseelist.getListData = function($container) {
        // $container.addClass('js-requesting');
        var index = $container.attr('data-list-index'),
            targetListInfo = _franchiseelist.listInfos[index],
            param = { app_id: appId, page: targetListInfo.page++, page_size: targetListInfo.page_size, form: targetListInfo.form, longitude: longitude, latitude: latitude };

        if(longitude && latitude){
          param.sort_key = 'distance';
          param.sort_direction= 1;
        }

        if (targetListInfo.source != '' && targetListInfo.source != 'none') {
          param.idx_arr = {
            idx: 'category',
            idx_value: targetListInfo.source
          };
        }
        if ($container.hasClass('js-search-mode')) {
          param.idx_arr = {
            idx: $container.attr('data-index'),
            idx_value: $container.attr('data-value')
          };
        }
        _franchiseelist.getData($container, param, targetListInfo);
      };
      // 按参数请求刷新列表
      _franchiseelist.refresh = function($list, index_segment, index_value, sort_key, sort_direction) {
        var $container = $list.children('.js-list-container'),
            index = $container.attr('data-list-index'),
            targetListInfo = _franchiseelist.listInfos[index];
        var param = {
              app_id: appId,
              page: -1,
              page_size: 20,
              form: targetListInfo.form,
              idx_arr: {
                  idx: (targetListInfo.source != 'none') ? 'category' : index_segment,
                  idx_value: (targetListInfo.source != 'none') ? targetListInfo.source : index_value
              },
              sort_key: sort_key,
              sort_direction: sort_direction
            };
        targetListInfo.page = 2;
        $container.addClass('js-search-mode').attr('data-index', index_segment).attr('data-value', index_value).empty();
        _franchiseelist.getData($container, param, targetListInfo);
      };
      // 按搜索结果刷新列表
      _franchiseelist.search = function(keyword,$list,form){
        console.log(keyword + ' ' + appId);
        var $container = $list.children('.js-list-container'),
            index = $container.attr('data-list-index'),
            targetListInfo = _franchiseelist.listInfos[index];

        targetListInfo.page = 2;
        $container.addClass('js-requesting');
        showLoading();
        $.ajax({
          url: '/index.php?r=appShop/search',
          // url: '/index.php?r=appShop/search&search={data:[{_allkey:'+keyword+', form:'+form+'}], app_id:'+appId+'}',
          type: 'get',
          data: {
            search: {
              app_id: appId,
              form: form,
              longitude: longitude,
              latitude: latitude,
              data: [{
                _allkey: keyword
              }]
            }
          },
          dataType: 'json',
          success: function(data) {
            console.log(data);

            removeLoading();
            if(data.data.length === 0){
              $("#searchPage .quick-tags").show();
              $list.children("ul").empty();
              alertTip("没有找到"+ keyword +"相关的数据！");
              return;
            }
            $("#searchPage .quick-tags").hide();
            $list.children("ul").empty();
            _franchiseelist.parseData($container,data.data,targetListInfo);
            $container.removeClass('js-requesting');
            $list.parent().show();
          },
          error:function(data){
            removeLoading();
            alertTip("请求出错"+ keyword);
            console.log(data.data);
          }
        });
      };

      _franchiseelist.setLocation = function(options){
        var $list = $('.franchisee-list[data-id='+options.listId+']'),
            $container = $list.find('.js-list-container');
        latitude = options.location.lat;
        longitude = options.location.lng;
        options.address && $list.find('.franchisee-location label').text(options.address);
        _franchiseelist.listInfos[$container.attr('data-list-index')].page = 1;
        _franchiseelist.getListData($container.html(''));
      }
      // 按城市定位刷新列表
      _franchiseelist.locationList = function(form, region_id, $list){
        var $container = $list.children('.js-list-container'),
            index = $container.attr('data-list-index'),
            targetListInfo = _franchiseelist.listInfos[index];

        targetListInfo.page = 2;
        $container.addClass('js-requesting');
        showLoading();
        $.ajax({
          url: '/index.php?r=appData/GetFormDataList',
          type: 'get',
          data: {
              app_id: appId,
              form: form,
              extra_cond_arr:{county_id:region_id}
          },
          dataType: 'json',
          success: function(data) {
            console.log(data);

            removeLoading();
            if(data.data.length === 0){
              $list.children("ul").empty();
              alertTip("没有找到相关的数据！");
              return;
            }
            $list.children("ul").empty();
            _franchiseelist.parseData($container,data.data,targetListInfo);
            $container.removeClass('js-requesting');
            $list.parent().show();
          },
          error:function(data){
            removeLoading();
            alertTip("请求出错");
            console.log(data.data);
          }
        });
      }
    }

    // 城市定位
    function CitylocationEle(){
      var _citylocation = this;

      _citylocation.parseElement = function(ele){
        var $html,
            content = ele.content;

        if (!ele.customFeature.citylocation) {
          return;
        }
        $html = $('<div class="element citylocation" data-form="'+ele.customFeature.citylocation.customFeature.form+'"><div><span class="citylocationStr icon-location"></span></div></div>');
        $html.click(function(){
          OfficialPages['citylocation-page'].parseCitylocationPage(ele.customFeature);//初始化城市定位页面
          APP.turnToPage({router:'CitylocationPage'});
        })
        $.ajax({
          url: '/index.php?r=Region/getRegionInfoByIPAddress',
          type: 'get',
          dataType: 'json',
          data: {},
          success:function(data){
            if (data.status != 0) {alertTip(data.data);return;}
            $html.find('.citylocationStr').text(data.data.city);
          },
          error:function(data){

          }
        })
        return $html;
      }
    }

    // 支付组件
    function PayEle() {
      var _pay = this,
          $payDialog = $('#payDialog');

      _pay.addToShoppingCart = function(options) {
        // 加入购物车
        var completeInfo = this.ifSelectGoods();

        if (completeInfo) {
          alertTip(completeInfo);
          return;
        }

        $.ajax({
          url: '/index.php?r=AppShop/addCart',
          type: 'get',
    	    data: {
    	      app_id: appId,
    	      goods_id: $payDialog.attr('goods-id'),
            sub_shop_app_id: GetQueryString('franchisee'),
            model_id: $payDialog.attr('model-items') || 0,
            ck_id: GetCookiePara(),
            num: $payDialog.find('.pay-buy-count').val(),
            is_seckill : GetQueryString('goodsType') == 'seckill' ? 1 : ''
          },
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              alertTip(data.data);
              return;
            }
            $payDialog.find('.pay-close-dialog').trigger('click');
            if(options && options.buydirectly){
              APP.turnToPage({
                router: 'previewGoodsOrder',
                cart_arr: [data.data]
              });
              OfficialPages['preview-goods-order'].address_id = '';
            } else {
              alertTip('已添加到购物车');
            }
          }
        });
      };

      _pay.payNextStep = function() {
        //立即支付下一步
        // var completeInfo = this.ifSelectGoods();

        // if (completeInfo) {
        //   alertTip(completeInfo);
        //   return;
        // }

        // $.ajax({
        //   url: '/index.php?r=AppShop/addOrder',
        //   type: 'get',
    	   //  data: {
    	   //    app_id: appId,
    	   //    goods_id: $payDialog.attr('goods-id'),
        //     model_id: $payDialog.attr('model-items') || 0,
        //     ck_id: GetCookiePara(),
        //     num: $payDialog.find('.pay-buy-count').val(),
        //     sub_shop_app_id: GetQueryString('franchisee')
        //   },
        //   dataType: 'json',
        //   success: function(data) {
        //     if (data.status !== 0) {
        //       if (data.status === 2) {
        //         alertTip('请先登录账号', function() {
        //           APP.showLogin();
        //         }, 700);
        //       } else {
        //         alertTip(data.data);
        //       }
        //       return;
        //     }
        //     $payDialog.find('.pay-close-dialog').trigger('click');
        //     setTimeout(function() {
        //       APP.turnToPage({ router: 'orderDetail', detail: data.data });
        //     }, 400);
        //   }
        // });

        this.addToShoppingCart({
          buydirectly: 1
        });
      };

      _pay.ifSelectGoods = function() {
        var $models = $payDialog.find('.pay-goods-models ul'),
            count = Number($payDialog.find('.pay-buy-count').val()),
            completeInfo;

        $.each($models, function(index, list) {
          if ($(list).children('.select').length !== 1) {
            completeInfo = '请选择具体商品' + $(list).closest('dd').siblings('dt').text();
            return false;
          }
        });

        if (count <= 0) {
          completeInfo = '请选择商品数量';
        }

        return completeInfo;
      };

      _pay.showPayDialog = function(type, goods) {
        var goods = goods.data[0].form_data,
            payModelStr = '',
            price, highPrice, lowPrice, allStock,
            stock ;

        if(type === 'listshopping'){
          $payDialog.find('.payDialog-normal').hide().siblings('.payDialog-list-shopping').show().children().show();
        }else if (type === 'shoppingcart') {
          $payDialog.find('.payDialog-list-shopping').hide().siblings('.payDialog-normal').show().children('.pay-add-to-shoppingcart').show().siblings().hide();
        } else if (type === 'buydirectly') {
          $payDialog.find('.payDialog-list-shopping').hide().siblings('.payDialog-normal').show().children('.pay-buy-next').show().siblings().hide();
        } else if (!type) {
          $payDialog.find('.payDialog-list-shopping').hide().siblings('.payDialog-normal').show().children().show().siblings().hide();
        }


        if (goods.model_items.length) {
          $.each(goods.model, function(index, model) {
            payModelStr += '<dl><dt>' + model.name + '</dt><dd><ul class="pills-list">' + (function(str) {
                $.each(model.subModelName, function(i, name) {
                    str += '<li class="subModel" data-id=' + model.subModelId[i] + '>' + name + '</li>';
                });
                return str;
            })('') + '</ul></dd></dl>';
          });
          $.each(goods.model_items, function(index, item) {
            if(goods.is_seckill == 1){ //如果是秒杀商品
              allStock += Number(item.seckill_stock);
              price = Number(item.seckill_price);
            }else{
              allStock += Number(item.stock);
              price = Number(item.price);
            }
            highPrice = highPrice >= price ? highPrice : price;
            lowPrice = lowPrice <= price ? lowPrice : price;
          });
        }
        $payDialog.data('goods-info', goods);

        $payDialog.find('.payDialog-buy-limit').remove();
        if(goods.is_seckill == 1){ //如果是秒杀商品
          price = goods.seckill_price;
          stock = goods.seckill_stock;
          $payDialog.find('.payDialog-goods-num').append('<span class="payDialog-buy-limit">（限购'+goods.seckill_buy_limit+'件）</span>');
        }else{
          price = goods.price;
          stock = goods.stock;
        }

        $payDialog.removeAttr('model-items');
        $payDialog.find('.pay-buy-count').val(1);
        $payDialog.find('.pay-goods-title').text(goods.title);
        $payDialog.find('.pay-goods-stock').text(allStock || stock);
        $payDialog.find('.pay-goods-cover').attr('src', goods.cover);
        payModelStr
            ? $payDialog.find('.pay-goods-models').html(payModelStr).parent().css('display', 'block') : $payDialog.find('.pay-goods-models').html('').parent().css('display', 'none');
        $payDialog.find('.js-goods-price').text(highPrice > lowPrice ? lowPrice + ' ~ ' + highPrice : price);
        $payDialog.attr('goods-id', goods.id);

        if (goods.model_items.length) {
          $payDialog.find('.pills-list').each(function(index, list) {
            $(list).children('.subModel').eq(0).trigger('click');
          });
          $payDialog.find('.pay-checked-text').show();
        }else{
          $payDialog.find('.pay-checked-text').hide().text('');
        }

        $payDialog.css('display', 'block').find('.page-bottom-content').slideDown(400);
      };

      _pay.closePayDialog = function() {
        $payDialog.find('.page-bottom-content').slideUp(400, function() {
          $payDialog.css('display', 'none');
        });
      };
    }



    //到店支付组件
    function TostorePayEle() {
      var _tostorepay = this,
          $tostorePayDialog = $('#tostorePayDialog');

      _tostorepay.addToShoppingCart = function(type) {
        // 加入购物车
        var completeInfo = this.ifSelectGoods(),
            goodsNum = +$tostorePayDialog.find('.pay-buy-count').val();

        if (completeInfo) {
          alertTip(completeInfo);
          return;
        }
        if(type=="plus"){
          goodsNum = goodsNum + 1;
        }else{
          goodsNum = goodsNum - 1
        }
        $.ajax({
          url: '/index.php?r=AppShop/addCart',
          type: 'get',
          data: {
            app_id: appId,
            goods_id: $tostorePayDialog.attr('goods-id'),
            sub_shop_app_id: GetQueryString('franchisee'),
            model_id: $tostorePayDialog.attr('model-items') || 0,
            ck_id: GetCookiePara(),
            num: goodsNum
          },
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              alertTip(data.data);
              return;
            }
            $tostorePayDialog.attr('cart-id', data.data);
            $tostorePayDialog.find('.pay-buy-count').val(goodsNum);
            OfficialPages['tostore-detail'].tostoreRulePrice();
          }
        });
      };

      _tostorepay.deleteToShoppingCart = function() {
        // 删除商品
        // var completeInfo = this.ifSelectGoods();

        // if (completeInfo) {
        //     alertTip(completeInfo);
        //     return;
        // }
        $ajax('/index.php?r=AppShop/deleteCart','post',{
          app_id: appId,
          cart_id_arr: [$tostorePayDialog.attr('cart-id')],
          sub_shop_app_id: GetQueryString('franchisee')
        },'json',function(data) {
            if (data.status !== 0) {
                alertTip(data.data);
                return;
            }
          OfficialPages['tostore-detail'].tostoreRulePrice();
        })
        // $tostorePayDialog.find('.pay-close-dialog').trigger('click');
      };

      _tostorepay.ifSelectGoods = function() {
        var $models = $tostorePayDialog.find('.pay-goods-models ul'),
            count = Number($tostorePayDialog.find('.pay-buy-count').val()),
            completeInfo;

        $.each($models, function(index, list) {
          if ($(list).children('.select').length !== 1) {
            completeInfo = '请选择具体商品' + $(list).closest('dd').siblings('dt').text();
            return false;
          }
        });

        if (count < 0) {
          completeInfo = '请选择商品数量';
        }

        return completeInfo;
      };

      _tostorepay.showPayDialog = function(type, goods) {
        var goods = goods.data[0].form_data,
            payModelStr = '',
            price, highPrice, lowPrice, allStock,
            businesssTimeString = '';

        //显示出售时间
        if (goods.business_time && goods.business_time.business_time) {
          var goodBusinesssTime = goods.business_time.business_time;
          for (var i = 0; i < goodBusinesssTime.length; i++) {
            businesssTimeString += goodBusinesssTime[i].start_time.substring(0, 2) + ':' + goodBusinesssTime[i].start_time.substring(2, 4) + '-' + goodBusinesssTime[i].end_time.substring(0, 2) + ':' + goodBusinesssTime[i].end_time.substring(2, 4) + '/';
          }
          businesssTimeString = '出售时间：' + businesssTimeString.substring(0, businesssTimeString.length - 1);
        }
        $tostorePayDialog.find('.dialog-wrap-businessString').text(businesssTimeString);

        _tostorepay.precheckShoppingCart()
        // OfficialPages['tostore-detail'].tostoreRulePrice();
        if (type === 'shoppingcart') {
          $tostorePayDialog.find('.pay-add-to-shoppingcart').show().siblings().hide();
        } else if (type === 'buydirectly') {
          $tostorePayDialog.find('.pay-buy-next').show().siblings().hide();
        } else if (!type) {
          $tostorePayDialog.find('.pay-buy-next, .pay-add-to-shoppingcart').show();
        }

        if (goods.model_items.length) {
          $.each(goods.model, function(index, model) {
            payModelStr += '<dl><dt>' + model.name + '：</dt><dd><ul class="pills-list">' + (function(str) {
                $.each(model.subModelName, function(i, name) {
                    str += '<li class="subModel" data-id=' + model.subModelId[i] + '>' + name + '</li>';
                });
                return str;
            })('') + '</ul></dd></dl>';
          });
          $.each(goods.model_items, function(index, item) {
            price = Number(item.price);
            highPrice = highPrice >= price ? highPrice : price;
            lowPrice = lowPrice <= price ? lowPrice : price;
            allStock += Number(item.stock);
          });
        }
        $tostorePayDialog.data('goods-info', goods);
        $tostorePayDialog.removeAttr('model-items');
        $tostorePayDialog.find('.pay-goods-title').text(goods.title);
        $tostorePayDialog.find('.pay-goods-stock').text(allStock || goods.stock);
        $tostorePayDialog.find('.pay-goods-cover').attr('src', goods.cover);
        payModelStr
            ? $tostorePayDialog.find('.pay-goods-models').html(payModelStr).parent().css('display', 'block') : $tostorePayDialog.find('.pay-goods-models').html('').parent().css('display', 'none');
        $tostorePayDialog.find('.js-goods-price').text(highPrice > lowPrice ? lowPrice + ' ~ ' + highPrice : goods.price);
        $tostorePayDialog.attr('goods-id', goods.id);

        if (goods.model_items.length) {
          $tostorePayDialog.find('.pills-list').each(function(index, list) {
            $(list).children('.subModel').eq(0).trigger('click');
          });
        }
        $tostorePayDialog.find('.pay-buy-count').val(0);
        $tostorePayDialog.css('display', 'block').find('.page-bottom-content').slideDown(400);
      };


      _tostorepay.precheckShoppingCart = function(){
        $.ajax({
          url: '/index.php?r=AppShop/precheckShoppingCart',
          type: 'POST',
          dataType: 'json',
          data: {
            app_id: appId,
            sub_shop_app_id: GetQueryString('franchisee') || '',
            parent_shop_app_id: GetQueryString('franchisee') ? appId : ''
          },
          success:function(data){
            if(data.status == 0){
              OfficialPages['tostore-detail'].tostoreRulePrice();
            }else{
              OfficialPages['tostore-detail'].tostoreRulePrice('noRouter');
            }
          }
        });

      }

      _tostorepay.closePayDialog = function() {
        $tostorePayDialog.find('.page-bottom-content').slideUp(400, function() {
          $tostorePayDialog.css('display', 'none');
        });
      };
    }

  //拼团弹窗组件
  function GroupPayEle() {
    var _groupPay = this,
        $groupPayDialog = $('#groupPayDialog');

    _groupPay.showPayDialog = function() {
      $groupPayDialog.css('display', 'block').find('.page-bottom-content').slideDown(400);
      $groupPayDialog.find('.group-buy-num').last().hide();
      $groupPayDialog.find('.pay-buy-next').last().hide();
      $groupPayDialog.find('.group-buy-num').first().show();
      $groupPayDialog.find('.pay-buy-next').first().show();
      $groupPayDialog.find('.part').show();
    };

    _groupPay.showPartPayDialog = function() {
      $groupPayDialog.css('display', 'block').find('.page-bottom-content').slideDown(400);
      $groupPayDialog.find('.group-buy-num').first().hide();
      $groupPayDialog.find('.pay-buy-next').first().hide();
      $groupPayDialog.find('.part').hide();
      $groupPayDialog.find('.group-buy-num').last().show();
      $groupPayDialog.find('.pay-buy-next').last().show();
    };

    _groupPay.closePayDialog = function() {
      $groupPayDialog.find('.page-bottom-content').slideUp(400, function() {
        $groupPayDialog.css('display', 'none');
      });
    };

    _groupPay.initialData = function(goods) {
      var goods = goods.data[0].form_data,
          groupBuyInfo = goods.group_buy_info,
          payModelStr = '',
          groupNum = '',
          price, highPrice, lowPrice, allStock,
          stock ;

      $.each(groupBuyInfo.num_of_people_list,function(idx,num){
        groupNum += '<span class="subModel" data-num="'+num+'">'+num+'人</span>';
      })
      $groupPayDialog.find('.pic').attr('src',goods.cover);
      $groupPayDialog.find('.pills-list').first().html(groupNum);
      $groupPayDialog.find('.limit span').first().html(groupBuyInfo.user_limit_join);
      $groupPayDialog.find('.limit span').last().html(groupBuyInfo.user_limit_buy);
      $groupPayDialog.find('.group-info').last().find('span').first().html(groupBuyInfo.hour_of_duration);
      $groupPayDialog.find('.group-info').last().find('span').last().html(groupBuyInfo.minute_of_duration);

      if (goods.model_items.length) {
        $.each(goods.model, function(index, model) {
          payModelStr += '<dl><dt>' + model.name + '</dt><dd><ul class="pills-list">' + (function(str) {
                $.each(model.subModelName, function(i, name) {
                  str += '<li class="subModel" data-id=' + model.subModelId[i] + '>' + name + '</li>';
                });
                return str;
              })('') + '</ul></dd></dl>';
        });
        $.each(goods.model_items, function(index, item) {
          allStock += Number(item.stock);
          price = Number(item.price);
          highPrice = highPrice >= price ? highPrice : price;
          lowPrice = lowPrice <= price ? lowPrice : price;
        });
      }
      $groupPayDialog.data('goods-info', goods);

      $groupPayDialog.removeAttr('model-items');
      $groupPayDialog.find('.pay-buy-count').val(1);
      $groupPayDialog.find('.pay-goods-title').text(goods.title);
      $groupPayDialog.find('.pay-goods-stock').text(stock);
      $groupPayDialog.find('.pay-goods-cover').attr('src', goods.cover);
      payModelStr ? $groupPayDialog.find('.pay-goods-models').last().html(payModelStr).parent().css('display', 'block') : $groupPayDialog.find('.pay-goods-models').last().html('').parent().css('display', 'none');
      $groupPayDialog.find('.pay-current-price span').text(highPrice > lowPrice ? lowPrice + ' ~ ' + highPrice : price);
      $groupPayDialog.attr('goods-id', goods.id);

      if (goods.model_items.length) {
        $groupPayDialog.find('.pills-list').each(function(index, list) {
          $(list).children('.subModel').eq(0).trigger('click');
        });
        $groupPayDialog.find('.pay-checked-text').show();
      }else{
        $groupPayDialog.find('.pay-checked-text').hide().text('');
      }

      $groupPayDialog.css('display', 'block').find('.page-bottom-content').slideDown(400);
    };

    _groupPay.ifSelectGoods = function() {
      var $models = $groupPayDialog.find('.pay-goods-models ul'),
          count = Number($groupPayDialog.find('.pay-buy-count').val()),
          completeInfo;

      $.each($models, function(index, list) {
        if ($(list).children('.select').length !== 1) {
          completeInfo = '请选择具体商品' + $(list).closest('dd').siblings('dt').text();
          return false;
        }
      });

      if (count <= 0) {
        completeInfo = '请选择商品数量';
      }

      return completeInfo;
    };
    //确认开团
    _groupPay.openGroup = function(){
      var completeInfo = this.ifSelectGoods();

      if (completeInfo) {
        alertTip(completeInfo);
        return;
      }

      $.ajax({
        url: '/index.php?r=AppShop/addCart',
        type: 'POST',
        data: {
          app_id: appId,
          goods_id: $groupPayDialog.attr('goods-id'),
          sub_shop_app_id: GetQueryString('franchisee'),
          model_id: $groupPayDialog.attr('model-items') || 0,
          ck_id: GetCookiePara(),
          num: $groupPayDialog.find('.pay-buy-count').val(),
          is_group_buy: 1,
          num_of_group_buy_people: $groupPayDialog.find('.pills-list span.select').data('num'),
          team_token: ''
        },
        dataType: 'json',
        success: function(data) {
          if (data.status !== 0) {
            alertTip(data.data);
            return;
          }
          $groupPayDialog.find('.pay-close-dialog').trigger('click');
          APP.turnToPage({
            router: 'previewGoodsOrder',
            cart_arr: [data.data]
          });
          OfficialPages['preview-goods-order'].address_id = '';
        }
      });
    }
    //确认参团
    _groupPay.joinGroup = function(para){
      var completeInfo = this.ifSelectGoods();

      if (completeInfo) {
        alertTip(completeInfo);
        return;
      }

      $.ajax({
        url: '/index.php?r=AppShop/addCart',
        type: 'POST',
        data: {
          app_id: appId,
          goods_id: $groupPayDialog.attr('goods-id'),
          sub_shop_app_id: GetQueryString('franchisee'),
          model_id: $groupPayDialog.attr('model-items') || 0,
          ck_id: GetCookiePara(),
          num: $groupPayDialog.find('.pay-buy-count').val(),
          is_group_buy: 1,
          num_of_group_buy_people: '',
          team_token: para
        },
        dataType: 'json',
        success: function(data) {
          if (data.status !== 0) {
            alertTip(data.data);
            return;
          }
          $groupPayDialog.find('.pay-close-dialog').trigger('click');
          APP.turnToPage({
            router: 'previewGoodsOrder',
            cart_arr: [data.data]
          });
          OfficialPages['preview-goods-order'].address_id = '';
        }
      });
    }
  }

    //外卖支付组件
    function WaiMaiPayEle(){
      var _waimaipay = this;

      _waimaipay.waiMaiPayNextStep = function(takeout){
        $.ajax({
          url: '/index.php?r=AppShop/addCartOrder',
          type: 'get',
          data: {
            app_id   : appId,
            cart_id_arr: takeout.waimaiArr,
            ck_id: GetCookiePara(),
            sub_shop_app_id: GetQueryString('franchisee')
          },
          dataType: 'json',
          success: function(data){
            if(data.status !== 0) {
              if(data.status === 2) {
                alertTip('请先登录账号', function(){
                  APP.showLogin();
                }, 700);
              } else {
                alertTip(data.data);
              }
              return;
            }
            APP.turnToPage({router:'orderDetail', detail: data.data});
            takeout.toalCount =0;
            takeout.totalPrice =0.00;
            $("#waimaiDetail .sure-waimai-oreder button").addClass("disabledBtn").attr("disabled", "disabled");
            $(".waimai+.goods-bottom-opt .sure-waimai-oreder button").addClass("disabledBtn").attr("disabled", "disabled");
            $("#waimaiDetail .waimai-count").text(takeout.toalCount);
            $("#waimaiDetail .waimai-count-money").text(takeout.totalPrice.toFixed(2));
            var temshoppingcart = $(".waimai+.goods-bottom-opt");
            temshoppingcart.find(".waimai-count").text(takeout.toalCount);
            temshoppingcart.find(".waimai-count-money").text(takeout.totalPrice.toFixed(2));
            $("#waimaiDetail .waimai-number").val(0);
            $("#waimaiDetail .addToShoppingCart").show();
            $("#waimaiDetail .waimai-count-minus").attr("disabled","disabled").addClass("disabledminusbtn");
            $("#waimaiDetail .waimai-number-change-detail").hide();
            $(".waimai .waimai-number").val(0);
            $(".waimai .waimai-count-minus").attr("disabled","disabled").addClass("disabledminusbtn");
          }
        });
      }
    }

    // 商品详情页
    function GoodsDetailPage() {
      var _goodsdetail = this,
          seckill_downCount;
      // 填充商品详情页内容
      _goodsdetail.modifyGoodsDetail = function(goods) {
      	//商品显示与隐藏
        var goods = goods.data[0].form_data,
            $goodsPage = $('#goodsDetail'),
            coverStr = modelStr = payModelStr = '',
            price ,seckill_price,seckill_highPrice,seckill_lowPrice,
            highPrice = lowPrice = allStock = 0,
            cart_goods_num = GetQueryString('cart_num'),
            hidestock = GetQueryString('hidestock'),
            bottomBarClass,
            seckillStatus;

        if (!goods.img_urls) {
          coverStr += '<img src=' + goods.cover + '>';
          $goodsPage.find('.slick-carousel-container').css('height', DEVICE_WIDTH);
        } else {
          coverStr += '<div class="slick-carousel" data-auto-play="true" data-interval="2000">';
          $.each(goods.img_urls, function(index, ele) {
            coverStr += '<div><img class="carousel-img" src=' + ele + ' ></div>';
          });
          coverStr += '</div>';
          $goodsPage.find('.slick-carousel-container').removeClass('centered');
        }

        if(goods.express_fee){
          $goodsPage.find('.express-fee').text(goods.express_fee);
        }
        if (goods.model_items.length) {
          if(goods.model == undefined){
            goods.model = [];
          }
          $.each(goods.model, function(index, model) {
            modelStr += '<dl><dt>' + model.name + '</dt><dd>' + model.subModelName.join('、').toString() + '</dd></dl>';
          });
          
          $.each(goods.model_items, function(index, item) {
            price = Number(item.price);
            if(index == 0){
              highPrice = lowPrice = price;
            } else {
              highPrice = highPrice >= price ? highPrice : price;
              lowPrice = lowPrice <= price ? lowPrice : price;
            }
            allStock += Number(item.stock);
          });

          if(goods.is_seckill == 1){
            allStock = 0;
            $.each(goods.model_items, function(index, item) {
              seckill_price = Number(item.seckill_price);
              if(index == 0){
                seckill_highPrice = seckill_lowPrice = seckill_price;
              } else {
                seckill_highPrice = seckill_highPrice >= seckill_price ? seckill_highPrice : seckill_price;
                seckill_lowPrice = seckill_lowPrice <= seckill_price ? seckill_lowPrice : seckill_price;
              }
              allStock += Number(item.seckill_stock);
            });
          }
        }else{
          if(goods.is_seckill == 1){
            allStock = goods.seckill_stock;
          }else{
            allStock = goods.stock;
          }
        }

        seckill_downCount && seckill_downCount.clear();
        if(goods.is_seckill == 1){
          seckillStatus = goods.seckill_start_state;
          $goodsPage.find('.goods-goods').hide();
          $goodsPage.find('.goods-seckill').show();
          $goodsPage.find('.js-current-price').text(seckill_highPrice > seckill_lowPrice && seckill_lowPrice != 0 ? seckill_lowPrice + ' ~ ' + seckill_highPrice : goods.seckill_price);
          $goodsPage.find('.goods-original-price').text('￥'+ (highPrice > lowPrice && lowPrice != 0 ? lowPrice + ' ~ ' + highPrice : goods.price));
          if(seckillStatus == 0){
            seckill_downCount = _goodsdetail.beforeDownCount($goodsPage , goods);
            $goodsPage.find('.buy-goods-directly').addClass('disabled');
            $goodsPage.find('.add-to-shoppingcart').removeClass('disabled');
          }else if(seckillStatus == 1){
            seckill_downCount = _goodsdetail.duringDownCount($goodsPage , goods);
            $goodsPage.find('.buy-goods-directly').removeClass('disabled');
            $goodsPage.find('.add-to-shoppingcart').removeClass('disabled');
          }else if(seckillStatus == 2){
            $goodsPage.find('.goods-seckill-right').addClass('seckill-end').find('.countdown').children('label').text('已结束');
            $goodsPage.find('.countdown').children('span').text('00');
            $goodsPage.find('.buy-goods-directly').addClass('disabled');
            $goodsPage.find('.add-to-shoppingcart').addClass('disabled');
          }
        }else{
          $goodsPage.find('.buy-goods-directly').removeClass('disabled');
          $goodsPage.find('.add-to-shoppingcart').removeClass('disabled');
          $goodsPage.find('.goods-goods').show();
          $goodsPage.find('.goods-seckill').hide();
          $goodsPage.find('.js-current-price').text(highPrice > lowPrice && lowPrice != 0 ? lowPrice + ' ~ ' + highPrice : goods.price);
        }
        if (Number(goods.max_can_use_integral) != 0 ) {
          var discountHtml = '（积分可抵扣' + (Number(goods.max_can_use_integral) / 100) + '元）';
          $goodsPage.find('.goods-price-discount').text(discountHtml);
        } else {
          $goodsPage.find('.goods-price-discount').text('');
        }
        $goodsPage.find('.goods-title').text(goods.title);
        modelStr ? $goodsPage.find('.goods-models').html(modelStr).css('display', 'block') : $goodsPage.find('.goods-models').css('display', 'none');
        $goodsPage.find('.slick-carousel-container').html(coverStr);
        if(hidestock == 'true'){
          $goodsPage.find('.goods-all-stock').parent().hide();
        }else{
          $goodsPage.find('.goods-all-stock').parent().show();
        }
        $goodsPage.find('.goods-all-stock').text(allStock || goods.stock);
        $goodsPage.find('.goods-details').html(goods.description);
        $goodsPage.find('.goods-app-name').html(goods.app_name);
        $goodsPage.find('.goods-detail-nav .icon-shoppingcart').html(cart_goods_num && cart_goods_num != 0 ? '<span class="cart-goods-num">'+cart_goods_num+'</span>' : '');

        switch(goods.goods_type){
          case '0': bottomBarClass = '.goods-bottom-bar';   // 电商
                    break;
          case '1': bottomBarClass = '.goods-appointment-bottom-bar'; // 预约
                    break;
          case '2': break;
           default: bottomBarClass = '.goods-bottom-bar';
                    break;
        }
        if(bottomBarClass){
          $goodsPage.find('.goods-bottom-opt').css('display', 'block').find(bottomBarClass).show().siblings().hide();
          $goodsPage.find('.goods-other-info').css('display', goods.goods_type == 0 ? 'block':'none');
        } else {
          $goodsPage.find('.goods-bottom-opt').css('display', 'none');
        }
        
        if(goods.is_group_buy_goods == 1){
          var endTime = goods.group_buy_info.end_date == '9999-12-31' ? '长期' : goods.group_buy_info.end_date;
          var orginPrice = goods.highPrice > goods.lowPrice && goods.lowPrice != 0 ? (goods.lowPrice+'~'+goods.highPrice) : goods.price;
          $goodsPage.find('.goods-current-price text').text(goods.group_buy_info.group_buy_min_price + '~' + goods.group_buy_info.group_buy_max_price);
          endTime === '长期' ? $goodsPage.find('.group-times div').last().text(endTime): $goodsPage.find('.group-times div').last().text(goods.group_buy_info.start_date + '~' + endTime);
          $goodsPage.find('.goods-origin-price text').text('￥'+orginPrice);
          $goodsPage.find('.goods-all-stock').text(allStock/goods.group_buy_info.num_of_people_list.length || goods.stock);

          $("#goodsDetail .group-price").show();
          $("#group-rules").show();
          $("#groups-wrap").show();
          $("#group-bottom").show();
          $("#common-bottom").hide();
          $('#goodsDetail .goods-price').hide();

          var groups = '';
          $(goods.group_buy_team_list).each((function(idx,group){
            groups += '<div class="group-item"><img src="'+group.leader_thumb+'"/><div class="group-item-content"><div style="font-weight:bold;">'+group.leader_username+'</div><div style="color:#666;font-size:12px;">还差<text style="color:red;">'+(group.max_user_num - group.current_user_count)+'</text>人&nbsp;剩余<span id="'+group.team_token+'"></span></div></div><div class="group-item-price">￥'+group.price+'</div><div class="join-group-btn" data-num="'+group.max_user_num+'" data-token="'+group.team_token+'">去参团</div></div>';
            _goodsdetail.countDown(group.expired_time,group.team_token);
          }));
          $('#groups-wrap .group-item-wrap').html(groups);

          if(goods.group_buy_team_list.length == 0){
            $('#groups-wrap .no-group').show();
            $('#groups-wrap .more-group').hide();
          }else {
            $('#groups-wrap .no-group').hide();
          }

          if(goods.group_buy_team_list.length <= 2){
            $('#groups-wrap .more-group').hide();
          }else{
            $('#groups-wrap .group-item-wrap').css({'height':'152px','overflow':'hidden'});
            $('#groups-wrap .more-group').first().show();
            $('#groups-wrap .more-group').last().hide();

            $('#groups-wrap .more-group').first().click(function(){
              $(this).hide();
              $('#groups-wrap .group-item-wrap').css({'height':'auto','overflow':'initial'});
              $('#groups-wrap .more-group').last().show();
            });
            $('#groups-wrap .more-group').last().click(function(){
              $(this).hide();
              $('#groups-wrap .group-item-wrap').css({'height':'152px','overflow':'hidden'});
              $('#groups-wrap .more-group').first().show();
            });
          }
        }else{
          $("#goodsDetail .group-price").hide();
          $("#group-rules").hide();
          $("#groups-wrap").hide();
          $("#group-bottom").hide();
          $('#goodsDetail .goods-price').show();
          $("#common-bottom").show();
        }

        $.ajax({
          url: '/index.php?r=AppShop/GetAssessList',
          data: {
            app_id: appId,
            goods_id: GetQueryString('detail'),
            sub_shop_app_id: GetQueryString('franchisee'),
            idx_arr: {
              idx: 'level',
              idx_value: 0
            },
            page:1,
            page_size:999
          },
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              alertTip(data.data);
              return;
            }
            if(data.count>=3){
              $goodsPage.find('[data-router="commentPage"]').show();
            }else{
              $goodsPage.find('[data-router="commentPage"]').hide();
            }
            var comments = data.data,num,comment;
            var $item='';
            if (comments && comments.length) {
              num = data.num;
              //comment = comments[0];
              $goodsPage.find('.goods-comment-count').text(num[0]);
              // $goodsPage.find('.goods-positive-comment').text(num[1]);
              // $goodsPage.find('.goods-negative-comment').text(num[3]);
              // $goodsPage.find('.goods-neutral-comment').text(num[2]);
              // $goodsPage.find('.goods-pic-comment').text(num[4]);
              $.each(comments,function(index,comment){
                $item+='<div style="margin-bottom:10px;"><div><img class="comment-user-photo" src=' + (comment.buyer_headimgurl || DEFAULTPHOTO) + '><span style="display:inline-block;vertical-align:middle;">' + comment.buyer_nickname + '</span></div><div class="comment-date">' + comment.add_time  + '</div><p class="comment-content">' + comment.assess_info.content + '</p>'+(comment.assess_info.has_img ? function(){
                  var _li = '<ul class="comment-img">';
                  $.each(comment.assess_info.img_arr,function(index,item){
                    _li += '<li><img src="'+item+'" /></li>';
                  })
                  _li += '</ul>';
                  return _li;
                }() : '')+'</div>'
                if(index<1){
                  $goodsPage.find('.comment-item').html($item);
                }
              })
              //   // <span class="comment-goods-model">颜色分类：白色斑点  尺寸：L</span>
                
              //   //$goodsPage.find('[data-router="commentPage"]').show();
              // }
            } else {
              $goodsPage.find('.goods-comment-count').text(0);
              $goodsPage.find('.goods-positive-comment').text(0);
              $goodsPage.find('.goods-negative-comment').text(0);
              $goodsPage.find('.goods-neutral-comment').text(0);
              $goodsPage.find('.goods-pic-comment').text(0);
              $goodsPage.find('.comment-item').html('');
              $goodsPage.find('[data-router="commentPage"]').hide();
            }
          }
        })
      };
      _goodsdetail.beforeDownCount = function( ele , formData ) {
        var dc ;
        ele.find('.countdown').children('label').text('距开始');
        ele.find('.goods-seckill-right').removeClass('seckill-end');
        dc = downCount({
          ele : ele.find('.countdown') ,
          startTime : formData.server_time ,
          endTime : formData.seckill_start_time ,
          callback : function() {
            window.location.reload();
            formData.server_time = formData.seckill_start_time;
            _goodsdetail.duringDownCount(ele , formData);
          }
        });

        return dc;
      };
      _goodsdetail.duringDownCount = function( ele , formData ) {
        var dc ;
        ele.find('.countdown').children('label').text('距结束还剩');
        ele.find('.goods-seckill-right').removeClass('seckill-end');
        dc = downCount({
          ele : ele.find('.countdown') ,
          startTime : formData.server_time ,
          endTime : formData.seckill_end_time,
          callback : function() {
            window.location.reload();
            ele.find('.goods-seckill-right').addClass('seckill-end').find('.countdown').children('label').text('已结束');
          }
        });

        return dc;
      };

      _goodsdetail.countDown = function(time,id){
        var now = (new Date()).valueOf();
        var time = time * 1000 - now;
        setInterval(function(){
          if (time >= 0) {
            time -= 500;
            $('#goodsDetail').find('#'+id).text(_goodsdetail.date_format(time));
          } else {
            $('#goodsDetail').find('#'+id).text('已截止');
          }
        },500)
      };

      // 时间格式化输出，如03:25:19 86。
      _goodsdetail.date_format = function (micro_second) {
        // 秒数
        var second = Math.floor(micro_second / 1000);
        // 小时位
        var hr = Math.floor(second / 3600);
        // 分钟位
        var min = _goodsdetail.fill_zero_prefix(Math.floor((second - hr * 3600) / 60));
        // 秒位
        var sec = _goodsdetail.fill_zero_prefix((second - hr * 3600 - min * 60));// equal to => var sec = second % 60;

        return hr + ":" + min + ":" + sec;
      },

      // 位数不足补零
      _goodsdetail.fill_zero_prefix = function (num) {
        return num < 10 ? "0" + num : num
      }

    };



    function PreviewGoodsOrder(){
      var _previewGoodsOrder = this,
          $previewGoodsPage = $('#previewGoodsOrder');

      _previewGoodsOrder.cart_arr = [];
      _previewGoodsOrder.is_balance = 1;
      _previewGoodsOrder.selected_benefit = '';
      _previewGoodsOrder.address_id = '';
      _previewGoodsOrder.is_self_delivery = 0;
      _previewGoodsOrder.requesting = false;

      _previewGoodsOrder.modifyPreviewInfo = function(res){
        _previewGoodsOrder.cart_arr = GetQueryString('cart_arr') ? GetQueryString('cart_arr').split(',') : [];
        _previewGoodsOrder.is_balance = 1;
        _previewGoodsOrder.selected_benefit = '';
        _previewGoodsOrder.requesting = false;

        var goodsStr = _previewGoodsOrder.modifyGoodsList(res.data);

        $previewGoodsPage.find('.preview-goods-list').html(goodsStr);
        $previewGoodsPage.find('.preview-goods-switch-input').prop('checked', true);
        $previewGoodsPage.find('.preview-balance-deduction-section').show();

        _previewGoodsOrder.getStoreLocation();
        _previewGoodsOrder.getPreviewPrice();
        APP.initMap();
      };

      _previewGoodsOrder.getStoreLocation = function(){
        var franchiseeId = GetQueryString('franchisee');
        $.ajax({
          url: '/index.php?r=AppShop/getAppShopLocationInfo',
          data: {
            app_id: franchiseeId || appId
          },
          dataType: 'json',
          success: function(res){
            if(res.status !== 0) {
              alertTip(res.data);
              return;
            }
            $previewGoodsPage.find('.preview-goods-store-phone').html(res.data.shop_contact).attr('href', 'tel:'+res.data.shop_contact);
            $previewGoodsPage.find('.preview-goods-store-name').html(res.data.region_string+res.data.shop_location);
            if(res.data.is_self_delivery == 1){
              _previewGoodsOrder.locationMap(res.data.region_string+res.data.shop_location);
              $previewGoodsPage.find('.preview-goods-delivery-way').show();
            } else {
              $previewGoodsPage.find('.preview-goods-delivery-way .radio-box[pickup-way="express"]').trigger('click');
              $previewGoodsPage.find('.preview-goods-delivery-way').hide();
            }
          }
        })
      };

      _previewGoodsOrder.locationMap = function(address){
        var address = address.replace(/\s+/g,'');

        $.ajax({
          url: '/index.php?r=Map/GetLatAndLngByAreaInfo',
          type: 'POST',
          data: {
            location_info: address
          },
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              // alertTip(data.message);
              return;
            }
            $previewGoodsPage.find('.preview-goods-store-name').attr({
              'lat': data.result.location.lat,
              'lng': data.result.location.lng,
              'address': address
            });
          }
        });
      }

      _previewGoodsOrder.getPreviewPrice = function(){
        var franchiseeId = GetQueryString('franchisee'),
            additional_info_goods = [],
            delivery_id_arr = [];
        $.ajax({
          url: '/index.php?r=AppShop/calculationPrice',
          method: 'post',
          data: {
            app_id: appId,
            sub_shop_app_id: franchiseeId || '',
            is_balance: _previewGoodsOrder.is_balance,
            cart_id_arr: _previewGoodsOrder.cart_arr,
            address_id: _previewGoodsOrder.address_id,
            selected_benefit: _previewGoodsOrder.selected_benefit,
            is_self_delivery: _previewGoodsOrder.is_self_delivery
          },
          dataType: 'json',
          success: function(res){
            if(res.status !== 0) {
              if (res.data === 2) {
                alertTip('请先登录账号', function() {
                  APP.showLogin();
                }, 700);
              } else {
                alertTip(res.data);
              }
              return;
            }
            var previewInfo = res.data,
                discountList = previewInfo.can_use_benefit.data,
                selected_benefit = previewInfo.selected_benefit_info,
                address = previewInfo.address;

            previewInfo.address && (_previewGoodsOrder.address_id = previewInfo.address.id);
            _previewGoodsOrder.payment = previewInfo.price;
            if(_previewGoodsOrder.selected_benefit.no_use_benefit != 1){
              if(discountList.length){
                var discountStr = '',
                    selected = '';

                discountList.unshift({
                  name: '无',
                  title: '不使用优惠',
                  no_use_benefit: true
                });
                $.each(discountList, function(index, discount){
                  if(selected_benefit.discount_type == discount.discount_type){
                    if(selected_benefit.discount_type == 'coupon'){
                      selected = selected_benefit.coupon_id == discount.coupon_id ? 'selected' : '';
                    } else {
                      selected = 'selected';
                    }
                  } else {
                    selected = '';
                  }
                  discountStr += '<option value="'+index+'" '+selected+'>'+discount.title+'</option>';
                });
                $previewGoodsPage.find('.preview-goods-discount-box').css('display', 'block');
                $previewGoodsPage.find('.preview-goods-selected-discount').html(selected_benefit.name);
                $previewGoodsPage.find('.preview-goods-deduction-container').show();
                $previewGoodsPage.find('.preview-goods-discount-select').html(discountStr);
              } else {
                $previewGoodsPage.find('.preview-goods-discount-box').css('display', 'none');
              }
              _previewGoodsOrder.selected_benefit = selected_benefit;
              _previewGoodsOrder.benefit_list = discountList;
            }

            if(previewInfo.is_self_delivery == 0){
              $previewGoodsPage.find('.orderDetail-radio-box').removeClass('checked').eq(0).addClass('checked');
            }else{
              $previewGoodsPage.find('.orderDetail-radio-box').removeClass('checked').eq(1).addClass('checked');
            }

            if(address && address.address_info){
              _previewGoodsOrder.address_id = address.id;
              $previewGoodsPage.find('.preview-goods-address-detail').html(address.address_info.name +' '+ address.address_info.contact +'<br>'+ address.address_info.province.text+address.address_info.city.text+address.address_info.district.text+address.address_info.detailAddress);
            } else {
              $previewGoodsPage.find('.preview-goods-address-detail').html('添加地址');
            }

            for(var i = 0;i < previewInfo.goods_info.length;i++){
              if(previewInfo.goods_info[i].delivery_id != 0 && delivery_id_arr.indexOf(previewInfo.goods_info[i].delivery_id) < 0){
                delivery_id_arr.push(previewInfo.goods_info[i].delivery_id);
                additional_info_goods.push(previewInfo.goods_info[i]);
              }
            }
            if(additional_info_goods.length){
              $previewGoodsPage.find('.writeAdditionalInfo').show();
              $previewGoodsPage.find('.writeAdditionalInfo').data('additionalArr',additional_info_goods);
            }else{
              $previewGoodsPage.find('.writeAdditionalInfo').hide();
              $previewGoodsPage.find('.writeAdditionalInfo').attr('data-goodsinfo','');
            }

            if(previewInfo.balance == 0){
              $previewGoodsPage.find('.preview-goods-balance-section').hide();
            } else {
              $previewGoodsPage.find('.preview-goods-balance-section').show();
            }

            $previewGoodsPage.find('.preview-goods-total-count').html(previewInfo.original_price);
            $previewGoodsPage.find('.preview-goods-pay-count').html(previewInfo.price);
            $previewGoodsPage.find('.preview-goods-deduction').html(previewInfo.discount_cut_price);
            $previewGoodsPage.find('.preview-goods-express-fee').html(previewInfo.express_fee);
            $previewGoodsPage.find('.preview-goods-use-balance').html(previewInfo.use_balance);
          }
        })
      };

      _previewGoodsOrder.modifyGoodsList = function(goodsList){
        var goodsStr = '',
            cart_arr = _previewGoodsOrder.cart_arr,
            goodsIndex = 0;

        $.each(goodsList, function(index, goods){
          if(cart_arr.indexOf(goods.id) != -1){
            var model_value;
            if(goods.model_value){
              model_value = '<p>(' + goods.model_value + ')</p>';
            }else {
              model_value = '';
            }
            goodsStr += '<li price=' + goods.price + ' model-id=' + goods.model_id + ' id=' + goods.id + ' goods-id=' + goods.goods_id + ' goods-index='+(goodsIndex++)+' data-seckill="'+goods.is_seckill+'" class="preview-goods-section"><div class="goods-list-img"><img src="'+goods.cover+'"></div><div class="goods-list-title"><p>'+goods.title+'</p>'+model_value+'<p class="goods-title-price">￥'+goods.price+'</p></div><div class="preview-goods-num-options"><span class="goods-min-num" data-type="min"></span><span class="goods-sure-num">'+goods.num+'</span><span class="goods-add-num" data-type="add"></span></div></li>';
          }
        });
        return goodsStr;
      };

      _previewGoodsOrder.setAddressId = function(addressId){
        _previewGoodsOrder.address_id = addressId;
        _previewGoodsOrder.getPreviewPrice();
      }
    }


    function GoodsAdditionalInfo(){
      var _GoodsAdditionalInfo = this,
          $goodsAdditionalInfo = $('#goodsAdditionalInfo');

      _GoodsAdditionalInfo.modifyGoodsAdditionalInfo = function(res){
        if(!res.data)return;
        if( GetQueryString('from') == 'previewGoodsOrder'){
          $('#goodsAdditionalInfo .previewOrder').show().siblings('.goodsOrder').hide();
          var goodsData = $('#previewGoodsOrder .writeAdditionalInfo').data('additionalArr'),
            data = res.data,
            _list = '',
            goodsInfo = $('#previewGoodsOrder .writeAdditionalInfo').attr('data-goodsinfo');
            for(var i = 0;i < data.length;i++){
              _list += '<li data-id="'+goodsData[i].id+'"><div class="goods-header"><img src="'+goodsData[i].cover+'"><p class="goods-header-title">'+goodsData[i].title+'</p></div>';

              for(var j = 0;j < data[i].delivery_info.length;j++){
                var type = data[i].delivery_info[j].type;
                if(data[i].delivery_info[j].is_hidden == 1){
                  switch(type){
                    case 'text':
                    _list += '<div data-type="'+type+'"><span class="title">'+data[i].delivery_info[j].name+'</span><input type="" name=""></div>';
                    break;
                    case 'mul-text':
                    _list += '<div data-type="'+type+'"><span class="title">'+data[i].delivery_info[j].name+'</span><textarea></textarea></div>';
                    break;
                    case 'picture':
                    _list += '<div data-type="'+type+'"><span class="title">'+data[i].delivery_info[j].name+'</span><div class="uploadImg"><input type="file" class="img-upload-input" accept="image/jpg,image/jpeg, image/gif, image/bmp, image/jp2, image/x-ms-bmp, image/x-png"></div></div>';
                    break;
                  }
                }
              }
              _list += '</li>';

          }
          $goodsAdditionalInfo.find('.previewOrder').find('.goodsAdditionalInfo-list').html(_list);

          $('#goodsAdditionalInfo .uploadImg').on('click', function(event) {
            var _this = $(this);
                _this.imgUpload(function(url) {
                  var _img_span = $('<span class="showUploadImg"><span class="deleteUploadImg">-</span><img class="hasUploadImg" src="'+url+'" alt="" /></span>');
                  _this.parent().append(_img_span);
                  _img_span.on('click', '.deleteUploadImg', function(e){
                    $(this).closest('.showUploadImg').remove();
                  })
                })
                if (_this.find('.hasUploadImg').length == 9) {
                _this.addClass('js-uploaded');
                }
          });


          if(goodsInfo){
            goodsInfo = JSON.parse(goodsInfo);
            _GoodsAdditionalInfo.hasPreviewGoodsInfo(goodsInfo);
          }
        }else if(GetQueryString('from') == 'goodsOrderDetail'){
              $('#goodsAdditionalInfo .goodsOrder').show().siblings('.previewOrder').hide();
          var goodsData = $('#goodsOrderDetail .additional-info').data('additionalArr'),
              data = res.data,
              _list = '',
              goodsInfo = $('#goodsOrderDetail .additional-info').attr('data-goodsinfo');
            for(var i = 0;i < data.length;i++){
              _list += '<li data-id="'+goodsData[i].id+'"><div class="goods-header"><img src="'+goodsData[i].cover+'"><p class="goods-header-title">'+goodsData[i].goods_name+'</p></div>';

              for(var j = 0;j < data[i].delivery_info.length;j++){
                var type = data[i].delivery_info[j].type;
                if(data[i].delivery_info[j].is_hidden == 1){
                  switch(type){
                    case 'text':
                    _list += '<div data-type="'+type+'"><span class="title">'+data[i].delivery_info[j].name+'</span><input type="" name="" disabled></div>';
                    break;
                    case 'mul-text':
                    _list += '<div data-type="'+type+'"><span class="title">'+data[i].delivery_info[j].name+'</span><textarea disabled style="background: #fff;"></textarea></div>';
                    break;
                    case 'picture':
                    _list += '<div data-type="'+type+'"><span class="title">'+data[i].delivery_info[j].name+'</span></div>';
                    break;
                  }
                }
              }
              _list += '</li>';

          }
          $goodsAdditionalInfo.find('.goodsOrder').find('.goodsAdditionalInfo-list').html(_list);

          $('#goodsAdditionalInfo .uploadImg').on('click', function(event) {
            var _this = $(this);
                _this.imgUpload(function(url) {
                  var _img_span = $('<span class="showUploadImg"><span class="deleteUploadImg">-</span><img class="hasUploadImg" src="'+url+'" alt="" /></span>');
                  _this.parent().append(_img_span);
                  _img_span.on('click', '.deleteUploadImg', function(e){
                    $(this).closest('.showUploadImg').remove();
                  })
                })
                if (_this.find('.hasUploadImg').length == 9) {
                _this.addClass('js-uploaded');
                }
          });


          if(goodsInfo){
            goodsInfo = JSON.parse(goodsInfo);
            _GoodsAdditionalInfo.hasOrderDetailGoodsInfo(goodsInfo);
          }
        }


      }


      _GoodsAdditionalInfo.hasPreviewGoodsInfo = function(goodsInfo){
        var goodsData = $('#previewGoodsOrder .writeAdditionalInfo').data('additionalArr');
        $.each($('#goodsAdditionalInfo .previewOrder .goodsAdditionalInfo-list li'),function(index,ele){
          var dataInfo = goodsInfo[goodsData[index].id],
              _img_span = '';
          $.each($(ele).children('div').not('.goods-header'),function(i,el){
            switch($(el).attr('data-type')){
              case 'text':
                $(el).find('input').val(dataInfo[i]['value']);
              break;
              case 'mul-text':
                $(el).find('textarea').val(dataInfo[i]['value']);
              break;
              case 'picture':
                $.each(dataInfo[i]['value'],function(j,element){
                   _img_span = $('<span class="showUploadImg"><span class="deleteUploadImg">-</span><img class="hasUploadImg" src="'+element+'" alt="" /></span>');
                   $(el).append(_img_span);
                   _img_span.on('click', '.deleteUploadImg', function(e){
                    $(this).closest('.showUploadImg').remove();
                  })
                })
              break;
            }
          })

        })
      }


      _GoodsAdditionalInfo.hasOrderDetailGoodsInfo = function(goodsInfo){
        var goodsData = $('#goodsOrderDetail .additional-info').data('additionalArr');
        $.each($('#goodsAdditionalInfo .goodsOrder .goodsAdditionalInfo-list li'),function(index,ele){
          var dataInfo = goodsInfo[goodsData[index].goods_id],
              _img_span = '';
          $.each($(ele).children('div').not('.goods-header'),function(i,el){
            switch($(el).attr('data-type')){
              case 'text':
                $(el).find('input').val(dataInfo[i]['value']);
              break;
              case 'mul-text':
                $(el).find('textarea').val(dataInfo[i]['value']);
              break;
              case 'picture':
                $.each(dataInfo[i]['value'],function(j,element){
                   _img_span = $('<span class="showUploadImg"><img class="hasUploadImg" src="'+element+'" alt="" /></span>');
                   $(el).append(_img_span);

                })
              break;
            }
          })

        })
      }

    }


    function GoodsOrderPaySuccess(){
      var _goodsOrderPaySuccess = this,
          $goodsOrderPaySuccess = $('#goodsOrderPaySuccess');
      _goodsOrderPaySuccess.initial = function(){
          var status = 0; // 默认为0, 有集集乐则为1
          var orderId = GetQueryString('detail');
          if(GetQueryString('collectBenefit') == 1){
            status = 1;
          } 
          $goodsOrderPaySuccess.children().hide();
          // 执行对应状态的页面处理
          if(status == 0){
            $goodsOrderPaySuccess.find('.normal-area').show();
          } else if(status == 1){
            // 集集乐数据处理
            $.ajax({
              url: '/index.php?r=AppMarketing/CollectmeSendCoupon',
              type: 'get',
              data: {
                'app_id': appId,
                'order_id': orderId
              },
              dataType: 'json',
              success: function(res){
                if(res.status != 0){
                  // alertTip(res.data);
                  return false;
                }
                var starHtml = '';
                for(var i = 0; i < res.data.star_num; i++){
                  starHtml += '<img class="star-item" src="'+ res.data.light_img +'" />';
                }
                for(var i = 0; i < res.data.collect_num - res.data.star_num; i++){
                  starHtml += '<img class="star-item" src="'+ res.data.dark_img +'" />';
                }
                $goodsOrderPaySuccess.find('.collect-benefit-area .star-list').html(starHtml);
                $goodsOrderPaySuccess.find('.collect-benefit-area .star-number').text(res.data.star_num);
                $goodsOrderPaySuccess.find('.collect-benefit-area .collect-reward').text(res.data.coupon_title);
                $goodsOrderPaySuccess.find('.collect-benefit-area .collect-value').text(res.data.value);
                if(res.data.star_num == res.data.collect_num){
                  $goodsOrderPaySuccess.find('.collect-benefit-area .star-full').show();
                  $goodsOrderPaySuccess.find('.collect-benefit-area .full-tip').show().siblings().hide();
                } else {
                  $goodsOrderPaySuccess.find('.collect-benefit-area .star-full').hide();
                  $goodsOrderPaySuccess.find('.collect-benefit-area .no-full-tip').show().siblings().hide();
                }
                $goodsOrderPaySuccess.find('.collect-benefit-area').show();
              }
            });
          }
          $goodsOrderPaySuccess.find('.btn-area').show();
      }
    }


    //到店商品详情
    function TostoreDetailPage() {
      var _tostoreDetail = this,
          $tostorePage = $('#tostoreDetail');
      // 填充商品详情页内容
      _tostoreDetail.modifyTostoreDetail = function(goods) {
        var goods = goods.data[0].form_data,
            $tostorePage = $('#tostoreDetail'),
            coverStr = modelStr = payModelStr = '',
            highPrice = lowPrice = allStock = 0,
            cart_goods_num = GetQueryString('cart_num'),
            bottomBarClass,
            businesssTimeString = '';

        $tostorePage.removeAttr('model-items');
        _tostoreDetail.showPayDialog(goods);
        if (goods.business_time && goods.business_time.business_time){
          var goodBusinesssTime = goods.business_time.business_time;
          for (var i = 0; i < goodBusinesssTime.length;i++){
            businesssTimeString += goodBusinesssTime[i].start_time.substring(0, 2) + ':' + goodBusinesssTime[i].start_time.substring(2, 4) + '-' + goodBusinesssTime[i].end_time.substring(0, 2) + ':' + goodBusinesssTime[i].end_time.substring(2, 4) + '/';
          }
          businesssTimeString = '出售时间：'+businesssTimeString.substring(0, businesssTimeString.length - 1);
        }
        $tostorePage.find('.businesssTimeString').text(businesssTimeString);
        if (!goods.img_urls) {
          coverStr += '<img src=' + goods.cover + '>';
        } else {
          coverStr += '<div class="slick-carousel" data-auto-play="true" data-interval="2000">';
          $.each(goods.img_urls, function(index, ele) {
              coverStr += '<div><img class="carousel-img" src=' + ele + ' ></div>';
          });
          coverStr += '</div>';
          $tostorePage.find('.slick-carousel-container').removeClass('centered');
        }
        if (goods.model) {
          $('#tostoreDetail .goods-rules').show().siblings().hide();
        }else{
          $('#tostoreDetail .goods-price').show().siblings().hide();
        }
        $tostorePage.attr('goods-id',goods.id);
        // $tostorePage.attr('model_items',goods.model_items)
        $tostorePage.find('.js-current-price').text(highPrice > lowPrice && lowPrice != 0 ? lowPrice + ' ~ ' + highPrice : goods.price);
        if (Number(goods.max_can_use_integral) != 0 ) {
          var discountHtml = '（积分可抵扣' + (Number(goods.max_can_use_integral) / 100) + '元）';
          $tostorePage.find('.goods-price-discount').text(discountHtml);
        } else {
          $tostorePage.find('.goods-price-discount').text('');
        }
        $tostorePage.find('.goods-title').text(goods.title);
        modelStr ? $tostorePage.find('.goods-models').html(modelStr).css('display', 'block') : $tostorePage.find('.goods-models').css('display', 'none');
        $tostorePage.find('.slick-carousel-container').html(coverStr);
        $tostorePage.find('.goods-all-stock').text(allStock || goods.stock);
        $tostorePage.find('.goods-details').html(goods.description);
        $tostorePage.find('.goods-app-name').html(goods.app_name);
        $tostorePage.find('.goods-detail-nav .icon-shoppingcart').html(cart_goods_num && cart_goods_num != 0 ? '<span class="cart-goods-num">'+cart_goods_num+'</span>' : '');

          $tostorePage.find('.goods-bottom-opt').css('display', 'block').find(bottomBarClass).show().siblings().hide();
          $tostorePage.find('.goods-other-info').show();


        $.ajax({
          url: '/index.php?r=AppShop/cartList',
          type: 'POST',
          dataType: 'json',
          data: {
            page: 1,
            page_size: 100,
            sub_shop_app_id: GetQueryString('franchisee'),
            app_id: appId,
            parent_shop_app_id: GetQueryString('franchisee') ? appId : '',
          },
          success:function(res){
            if(res.status != 0){
              alertTip(res.data);
              return;
            }
            var price = 0,
                num = 0,
                typeFlag = false;
            for (var i = res.data.length - 1; i >= 0; i--) {
              var data = res.data[i];
              price += +data.num * +data.price;
              num   += +data.num;
              if(data.goods_type == 3){
                typeFlag = true;
              }
            }
            if(typeFlag) {
              $.ajax({
                url: '/index.php?r=AppShop/precheckShoppingCart',
                type: 'POST',
                dataType: 'json',
                data: {
                  app_id: appId,
                  sub_shop_app_id: GetQueryString('franchisee') || '',
                  parent_shop_app_id: GetQueryString('franchisee') ? appId : ''
                },
                success:function(data){
                  if(data.status == 0){
                    if(num){
                      $('#tostoreDetail .add-to-shoppingcart').addClass('router');
                    }else{
                      $('#tostoreDetail .add-to-shoppingcart').removeClass('router noRouter');
                    }
                  }else{
                    if(num){
                      $('#tostoreDetail .add-to-shoppingcart').removeClass('router').addClass('noRouter');
                    }else{
                      $('#tostoreDetail .add-to-shoppingcart').removeClass('router noRouter');
                    }
                  }
                }
              });
            }else{
              $('#tostoreDetail .add-to-shoppingcart').removeClass('router noRouter');
            }



            $('#tostoreDetail .totalPrice').text(price.toFixed(2));
            $('#tostoreDetail .shop-num').text(num);
            $('#tostoreDetail .goods-sure-num').text(0)


          }
        });
      };

      _tostoreDetail.showPayDialog = function(goods) {
        // var goods = goods.data[0].form_data,
        var payModelStr = '',
            price, highPrice, lowPrice, allStock;

        if (goods.model_items.length) {
          $.each(goods.model, function(index, model) {
            payModelStr += '<dl><dt>' + model.name + '：</dt><dd><ul class="pills-list">' + (function(str) {
              $.each(model.subModelName, function(i, name) {
                str += '<li class="subModel" data-id=' + model.subModelId[i] + '>' + name + '</li>';
              });
              return str;
            })('') + '</ul></dd></dl>';
          });
          $.each(goods.model_items, function(index, item) {
            price = Number(item.price);
            highPrice = highPrice >= price ? highPrice : price;
            lowPrice = lowPrice <= price ? lowPrice : price;
            allStock += Number(item.stock);
          });
        }
        $tostorePage.data('goods-info', goods);

        $tostorePage.find('.pay-goods-title').text(goods.title);
        $tostorePage.find('.pay-goods-stock').text(allStock || goods.stock);
        $tostorePage.find('.pay-goods-cover').attr('src', goods.cover);
        payModelStr
            ? $tostorePage.find('.pay-goods-models').html(payModelStr).parent().css('display', 'block') : $tostorePage.find('.pay-goods-models').html('').parent().css('display', 'none');
        $tostorePage.find('.js-goods-price').text(highPrice > lowPrice ? lowPrice + ' ~ ' + highPrice : goods.price);
        $tostorePage.attr('goods-id', goods.id);

        if (goods.model_items.length) {
          $tostorePage.find('.pills-list').each(function(index, list) {
            $(list).children('.subModel').eq(0).trigger('click');
          });
        }
        // $tostorePage.css('display', 'block').find('.page-bottom-content').slideDown(400);
      };

      // 有规格加减
      _tostoreDetail.addToShoppingCart = function(type) {
        // 加入购物车
        // var completeInfo = this.ifSelectGoods();

        // if (completeInfo) {
        //     alertTip(completeInfo);
        //     return;
        // }
        var num = +$tostorePage.find('.pay-buy-count').val();
        if(type == 'plus'){
          num = num + 1;
        }else{
          num = num - 1;
        }
        if(num <  0){
          return;
        }
        if(num == 0 ){
          $ajax('/index.php?r=AppShop/deleteCart','post',{
            app_id: appId,
            cart_id_arr: [$('#tostoreDetail').attr('delete-id')],
            sub_shop_app_id: GetQueryString('franchisee')
          },'json',function(data) {
            if (data.status !== 0) {
              alertTip(data.data);
              return;
            }
            _tostoreDetail.tostoreRulePrice();
          })
          return;
        }
        $tostorePage = $('#tostoreDetail');
        $.ajax({
          url: '/index.php?r=AppShop/addCart',
          type: 'get',
          data: {
            app_id: appId,
            goods_id: $tostorePage.attr('goods-id'),
            sub_shop_app_id: GetQueryString('franchisee'),
            model_id: $tostorePage.attr('model-items') || 0,
            ck_id: GetCookiePara(),
            num: num
          },
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              alertTip(data.data);
              if(data.status == 11 || data.status == 12){
                $tostorePage.find('.pay-buy-count').val(0)
              }
              return;
            }
            $tostorePage.find('.pay-buy-count').val(num)
            $('#tostoreDetail').attr('delete-id',data.data);
            OfficialPages['tostore-detail'].tostoreRulePrice();
          }
        });
      };

      _tostoreDetail.tostoreToShopcart = function(type){
        var num = type == 'add' ? +$('#tostoreDetail .goods-sure-num').text() + 1 : +$('#tostoreDetail .goods-sure-num').text() - 1;
        if(num <  0){
          return;
        }
        if( num > Number($tostorePage.find('.goods-price .pay-goods-stock').text()) ){
          alertTip('库存不足');
          return;
        }
        if(num == 0 ){
          $ajax('/index.php?r=AppShop/deleteCart','post',{
            app_id: appId,
            cart_id_arr: [$('#tostoreDetail').attr('delete-id')],
            sub_shop_app_id: GetQueryString('franchisee')
          },'json',function(data) {
            if (data.status !== 0) {
              alertTip(data.data);
              return;
            }
            $('#tostoreDetail .goods-sure-num').text(num);
            _tostoreDetail.tostoreRulePrice();
          })
          return;
        }

        // var totalNum = type == 'add' ? +$('#tostoreDetail .shop-num').text() + 1 : +$('#tostoreDetail .shop-num').text() - 1;

        // $('#tostoreDetail .shop-num').text(totalNum);
        $ajax(
          '/index.php?r=AppShop/addCart','get',{
            app_id: appId,
            goods_id: $('#tostoreDetail').attr('goods-id'),
            sub_shop_app_id: GetQueryString('franchisee'),
            model_id: 0,
            ck_id: GetCookiePara(),
            num: num
          },'json',function(data) {
            if (data.status != 0) {
              alertTip(data.data);
              return;
            }
            if(num){
              $('#tostoreDetail .add-to-shoppingcart').addClass('router');
            }else{
              $('#tostoreDetail .add-to-shoppingcart').removeClass('router noRouter');
            }
            $('#tostoreDetail .goods-sure-num').text(num);
            $('#tostoreDetail').attr('delete-id',data.data);
            _tostoreDetail.tostoreRulePrice();
          }
        );
      };

      _tostoreDetail.tostoreRulePrice = function(noRouter){
        var franchiseeId=GetQueryString('franchisee');
        $.ajax({
          url: '/index.php?r=AppShop/cartList',
          type: 'POST',
          dataType: 'json',
          data: {
            page: 1,
            page_size: 100,
            sub_shop_app_id: franchiseeId,
            parent_shop_app_id: franchiseeId ? appId : '',
            app_id: appId
          },
          success:function(res){
            if(res.status != 0){
              alertTip(res.data);
              return;
            }
            var price = 0,
                num = 0,
                typeFlag = false;
            for (var i = res.data.length - 1; i >= 0; i--) {
              var data = res.data[i];
              price += +data.num * +data.price;
              num   += +data.num;
              if(data.goods_type == 3){
                typeFlag = true;
              }
            }

            if(typeFlag){
              if(num && !noRouter){
                $('#tostoreDetail .add-to-shoppingcart,#tostorePayDialog .add-to-shoppingcart').addClass('router').removeClass('noRouter');
              }else if(!num){
                $('#tostoreDetail .add-to-shoppingcart,#tostorePayDialog .add-to-shoppingcart').removeClass('router noRouter');
              }else if(num && noRouter){
                $('#tostoreDetail .add-to-shoppingcart,#tostorePayDialog .add-to-shoppingcart').addClass('noRouter').removeClass('router');
              }
            }else{
              $('#tostoreDetail .add-to-shoppingcart,#tostorePayDialog .add-to-shoppingcart').removeClass('router noRouter');
            }
            $('#tostoreDetail .totalPrice,#tostorePayDialog .totalPrice').text(price.toFixed(2));
            $('#tostoreDetail .shop-num,#tostorePayDialog .shop-num').text(num);
          }
        });
      }
    }

    //到店确认支付
    function TostorePaymentPage(){
      var _tostorePayment = this,
          $tostorePayment = $('#tostorePayment'),
          selectDiscountInfo = '',
          isPaysuccessFlag = false;
      
      _tostorePayment.is_balance = 1;
      _tostorePayment.modifyTostorePayment = function(data){
        _tostorePayment.is_balance = 1;
        _tostorePayment.tostoreLocation();
        var data = data.data,
            price = 0,
            html = '',
            arrId = GetQueryString('bussinessId');

        $.ajax({
          url:'/index.php?r=AppData/getUserInfo',
          type:'get',
          data:null,
          dataType:"JSON",
          success:function(data){
            if(data.status == 0){
              $tostorePayment.find('.tostorePayment-phone').val(data.data.phone);
            }
          }
        })

        //筛选是否选中商品
        if(arrId && data.length && data){
          var businessData = [];
          arrId = arrId.split(',');
          $.each(data,function(index,ele){
            var id = ele.id;
            $.each(arrId,function(i,good){
              if(id == good){
                businessData.push(data[index]);
              }
            })
          })

          if(businessData && businessData.length){
            $.each(businessData,function(index,ele){
              html += _tostorePayment.goodList(ele);
              price += +ele.num * +ele.price;
            })
          }
        }

        if(!arrId){
          if(data && data.length){
            $.each(data,function(index,ele){
              if(ele.goods_type != 3){
                return;
              }
              html += _tostorePayment.goodList(ele);
              price += +ele.num * +ele.price;
            })
          }
        }
        $tostorePayment.find('.goods-list').html(html);
        _tostorePayment.GetCartCanUseBenefit();
      }

      _tostorePayment.GetCartCanUseBenefit = function(changeBenefit){
        var _li = $tostorePayment.find('.goods-list li'),
            cartArr = [],
            franchiseeId=GetQueryString('franchisee');
        $.each(_li,function(index,ele){
          cartArr.push($(ele).attr('id'))
        })
        $.ajax({
          url: '/index.php?r=AppShop/calculationPrice',
          type: 'get',
          dataType: 'json',
          data: {
            app_id: appId,
            sub_shop_app_id: franchiseeId || '',
            cart_id_arr: cartArr,
            is_self_delivery:1,
            is_balance: _tostorePayment.is_balance,
            selected_benefit: changeBenefit || ''
          },
          success:function(data){
            if(data.status != 0 ){
              alertTip(data.data);
              return;
            }
            var discounts = data.data.can_use_benefit.data;

            if(!discounts.length){
              selectDiscountInfo = '';
              $('#tostorePayment .preferential-way-box').hide();
            }else{
              $('#tostorePayment .preferential-way-box').show();
                var option = '';
                selectDiscountInfo = data.data.selected_benefit_info;
                option += '<option value="no_use_benefit">无优惠</option>';
                $.each(discounts,function(index,ele){
                  var eleValue = JSON.stringify(ele);
                      if( (selectDiscountInfo.discount_type == 'integral' && ele.discount_type == 'integral') || (selectDiscountInfo.discount_type == 'vip' && ele.discount_type == 'vip') || (selectDiscountInfo.discount_type == 'coupon'&& selectDiscountInfo.coupon_id == ele.coupon_id)){
                        option += "<option value='"+eleValue+"' selected>"+ele.title+"</option>";
                      }else{
                        option += "<option value='"+eleValue+"'>"+ele.title+"</option>";
                      }
                })
                $('#tostorePayment .preferential-way').html(option);
              $('#tostorePayment .tostore_benefit').text(selectDiscountInfo.title);
            }
            $tostorePayment.find('.tostorePayment-price').text(data.data.price.toFixed(2));
            $tostorePayment.find('.preview-goods-use-balance').html(data.data.use_balance);
          }
        })
      }

      _tostorePayment.goodList = function(ele){
        if(ele.model_value){
          model_value = '<p>(' + ele.model_value + ')</p>';
        }else {
          model_value = '';
        }
        return '<li price =' + ele.price + ' model-id =' + ele.model_id + ' id=' + ele.id + ' goods-id=' + ele.goods_id + ' class="goods-detail-section"><div class="goods-list-img"><img src="'+ele.cover+'"></div><div class="goods-list-title"><p>'+ele.title+'</p>'+model_value+'<p class="goods-title-price">￥'+ele.price+'</p></div><div class="tostorePayment-btn"><span class="goods-min-num" data-type="min"></span><span class="goods-sure-num">'+ele.num+'</span><span class="goods-add-num" data-type="add"></span></div></li>';
      }
      _tostorePayment.tostorePaymentToShopcart = function(type,_this){
        var number = +_this.closest('.tostorePayment-btn').find('.goods-sure-num').text(),
            // oldPrice = +$('#tostorePayment .tostorePayment-price').text(),
            price = +_this.closest('li').attr('price');
            number = type == 'add' ? number + 1 : number - 1;

        if(number < 1 ){
          confirmTip({content:'确定删除该商品？'},function(){
            $ajax('/index.php?r=AppShop/deleteCart','post',{
              app_id: appId,
              cart_id_arr: [_this.closest('li').attr('id')],
              sub_shop_app_id: GetQueryString('franchisee')
            },'json',function(data) {
              if (data.status !== 0) {
                alertTip(data.data);
                return;
              }
              _this.closest('li').remove();
              _tostorePayment.GetCartCanUseBenefit();

              // 到店无商品返回上一页
              if(!$('#tostorePayment .goods-list li').length){
                window.history.back();
              }


            })
          },function(){
            number = 1;
          });
          return;
        }

        $ajax(
          '/index.php?r=AppShop/addCart','get',{
            app_id: appId,
            goods_id: _this.closest('li').attr('goods-id'),
            sub_shop_app_id: GetQueryString('franchisee'),
            model_id: _this.closest('li').attr('model-id') || 0,
            ck_id: GetCookiePara(),
            num: number
          },'json',function(data) {
            if (data.status !== 0) {
              alertTip(data.data);
              return;
            }
            _this.closest('.tostorePayment-btn').find('.goods-sure-num').text(number);
            _tostorePayment.GetCartCanUseBenefit();
          }
        );
      }
      _tostorePayment.preferentialWay = function(){
        var selectBenefit = $('#tostorePayment .preferential-way option:checked').val();
        if(selectBenefit){
          if(selectBenefit == 'no_use_benefit'){
            selectDiscountInfo = 'no_use_benefit';
          }else{
            selectDiscountInfo = JSON.parse($('#tostorePayment .preferential-way option:checked').val());
          }
          _tostorePayment.GetCartCanUseBenefit(selectDiscountInfo)
        }
      }
      _tostorePayment.tostoreAddCartOrder = function(){
        var payIdArr = [],
            dataWay = $('#tostorePayment .yuan-active').attr('data-way'),
            data = new Date(),
            time = data.toLocaleDateString().replace(/\//g,'-') + ' ' +$('#tostorePayment .hour-select option:checked').text()+ ':' + $('#tostorePayment .minute-select option:checked').text(),
            phone = $('#tostorePayment .tostorePayment-phone').val(),
            locationDataId = "",
            locationRadio = $('#tostorePayment .location-box input:checked').val();

        if(locationRadio == 0){
          locationDataId = 0;
        }else if(locationRadio == 1){
          locationDataId = $('#tostorePayment .locationSelect option:checked').val();
        }else{
          locationDataId = $('#tostorePayment .location-specialId').attr('data-locationId');
        }
        $.each($('#tostorePayment .goods-list li'),function(i,ele){
          payIdArr.push({
            cart_id: $(ele).attr('id'),
            goods_id: $(ele).attr('goods-id'),
            model_id: $(ele).attr('model-id'),
            num: $(ele).find('.goods-sure-num').text()
          });
        })
        if( !/^1\d{10}$/.test(phone) ){
          alertTip('请输入正确的手机号');
          return;
        }
        if (isPaysuccessFlag){
          return;
        }
        isPaysuccessFlag = true;
        $ajax('/index.php?r=AppShop/addCartOrder','post',{
          app_id: appId,
          cart_arr: payIdArr,
          sub_shop_app_id: GetQueryString('franchisee'),
          selected_benefit: selectDiscountInfo,
          tostore_order_type: dataWay,
          tostore_appointment_time: time,
          tostore_buyer_phone: phone,
          tostore_remark: $('#tostorePayment .goods-content textarea').val(),
          is_balance: _tostorePayment.is_balance,
          location_id: dataWay == 2 ? '' : locationDataId
        },'json',function(data){
          if(data.status != 0){
            isPaysuccessFlag = false;
            if(data.status == 1 && data.expired_goods_arr){
              confirmTip({content:data.data},function(){
                window.history.back();
              });
              return;
            }else{
              alertTip(data.data);
              return;
            }

          }else if(data.status == 2){
            alertTip('请先登录账号', function() {
              APP.showLogin();
            }, 700);
            return;
          }
          isPaysuccessFlag = false;
          // 支付
          var id = data.data,
              payment = $('#tostorePayment .orderDetail-payment').find('.orderDetail-check-box.checked').attr('payment');
          
          // 支付成功回调
          function paySuccessCallback(){
            if(!GetQueryString('franchisee')){
              $.ajax({
                url: '/index.php?r=AppMarketing/CheckAppCollectmeStatus',
                type: 'get',
                data: {
                  'app_id': appId,
                  'order_id': id
                },
                dataType: 'json',
                success: function(res){
                  var collectBenefit = '';
                  if(res.valid == 0){
                    collectBenefit = 1;
                  }
                  APP.turnToPage({
                    router: 'tostoreComplete',
                    detail: id,
                    franchisee: GetQueryString('franchisee'),
                    collectBenefit: collectBenefit,
                    redirect: true
                  });
                }
              });
            } else {
              APP.turnToPage({
                router: 'tostoreComplete',
                detail: id,
                franchisee: GetQueryString('franchisee'),
                redirect: true
              });
            }
          }
          if ($tostorePayment.find('.tostorePayment-price').text().trim() == 0) {
            $.ajax({
              url: '/index.php?r=AppShop/paygoods',
              type: 'get',
              dataType: 'json',
              data: {
                  app_id: appId,
                  order_id: id,
                  total_price: 0
              },
              success: function(res){
                  if(res.status!=0){
                      alertTip(res.data);
                      return;
                  }
                  alertTip('支付成功', function(){
                      paySuccessCallback();
                  });
                }
            });
            return;
          }


          // 获取二维码
          $.ajax({
            url: '/index.php?r=AppShop/getOrder',
            type: 'GET',
            dataType: 'json',
            data: {
              order_id: id,
              app_id: appId,
              sub_shop_app_id:GetQueryString('franchisee')
            },
            success:function(data){
              OfficialPages['pay-page'].setCode(data);
              // $('.orderDetail-pay-qrcode').attr('src',data.code_url);
            }
          });
          if (payment == 1) {
            window.open('/index.php?r=AppShop/getUniPay&order_id=' + id + '&payment_id=1');
          } else {
            APP.turnToPage({
              router: 'payPage',
              detail: id,
              redirect:true
            });
          }
        },function(data){
          isPaysuccessFlag = false;
        })
      }
      // 位置管理
      _tostorePayment.tostoreLocation = function(){
        $.ajax({
          url: '/index.php?r=AppShop/locationDataList',
          type: 'GET',
          dataType: 'json',
          data: {
            app_id: appId,
            page_size: 1000
          },
          success:function(data){
            if(data.status != 0){
              alertTip(data.data);
              return;
            }
            var _option = "";
            if(!data.data.length){
              $('#tostorePayment .tostore-location-contain').attr('data-length',0);
              $('#tostorePayment .tostore-location-contain').hide();
            }
            $.each(data.data,function(index,ele){
              _option += "<option value='"+ele.id+"'>"+ele.title+"</option>"
            })
            $('#tostorePayment .locationSelect').html(_option);
          }
        });
        // 单个位置
        $.ajax({
          url: '/index.php?r=AppShop/getLocationData',
          type: 'GET',
          dataType: 'json',
          data: {
            app_id: appId,
            id: $('#tostorePayment .location-specialId').attr('data-locationId')
          },
          success:function(data){
            $('#tostorePayment .special-title').text(data.data.title);
          }
        });
      }
    }

    //到店支付完成
    function TostoreCompletePage(){
      var _tostoreComplete = this;
          $tostoreComplete = $('#tostoreComplete');

      _tostoreComplete.modifyTostoreComplete = function(data){
        var status = 0; // 页面状态
        var orderId = data.data[0].form_data.order_id;
        var tostore_data = data.data[0].form_data.tostore_data; // 到店数据
        var wayOfDine = tostore_data.tostore_order_type; // 到店订单类型
        var queueNum = tostore_data.formatted_queue_num; // 到店取餐号
        var durationTime = tostore_data.duration_time; // 到店点餐的取餐时间
        var appointmentTime = tostore_data.tostore_appointment_time.substr(11,5); // 到店预约的取餐时间
        // 有集集乐的状态为1
        if(GetQueryString('collectBenefit') == 1){
          status = 1;
        }
        $tostoreComplete.children().hide();
        // 不同状态执行不同页面处理
        if(status == 0){
          if(queueNum){
            $tostoreComplete.find('.queue-num').text(queueNum);
            if(wayOfDine == 1){
              $tostoreComplete.find('.normal-area .duration-time').text(durationTime).closest('div').show();
              $tostoreComplete.find('.normal-area .appointment-time').closest('div').hide();
            } else if(wayOfDine == 2) {
              $tostoreComplete.find('.normal-area .appointment-time').text(appointmentTime).closest('div').show();
              $tostoreComplete.find('.normal-area .duration-time').closest('div').hide();
            }
            $tostoreComplete.find('.normal-area .paySuccess-detail').show();
          } else {
            $tostoreComplete.find('.normal-area .paySuccess-detail').hide();
          }
          $tostoreComplete.find('.normal-area').show();
        } else if(status == 1){
          // 到店数据处理
          if(queueNum){
            $tostoreComplete.find('.queue-num').text(queueNum);
            if(wayOfDine == 1){
              $tostoreComplete.find('.has-collect-benefit .duration-time').text(durationTime).closest('p').show();
              $tostoreComplete.find('.has-collect-benefit .appointment-time').closest('div').hide();
              $tostoreComplete.find('.has-collect-benefit .dine-way-1').siblings('.dine-way-2').hide();
            } else if(wayOfDine == 2) {
              $tostoreComplete.find('.has-collect-benefit .appointment-time').text(appointmentTime).closest('p').show();
              $tostoreComplete.find('.has-collect-benefit .duration-time').closest('div').hide();
              $tostoreComplete.find('.has-collect-benefit .dine-way-2').siblings('.dine-way-1').hide();
            }
            $tostoreComplete.find('.has-collect-benefit .to-store-area').show();
          } else {
            $tostoreComplete.find('.has-collect-benefit .to-store-area').hide();
          }
          // 集集乐数据处理
          $.ajax({
            url: '/index.php?r=AppMarketing/CollectmeSendCoupon',
            type: 'get',
            data: {
              'app_id': appId,
              'order_id': orderId
            },
            dataType: 'json',
            success: function(res){
              if(res.status != 0){
                // alertTip(res.data);
                return false;
              }
              var starHtml = '';
              for(var i = 0; i < res.data.star_num; i++){
                starHtml += '<img class="star-item" src="'+ res.data.light_img +'" />';
              }
              for(var i = 0; i < res.data.collect_num - res.data.star_num; i++){
                starHtml += '<img class="star-item" src="'+ res.data.dark_img +'" />';
              }
              $tostoreComplete.find('.has-collect-benefit .star-list').html(starHtml);
              $tostoreComplete.find('.has-collect-benefit .star-number').text(res.data.star_num);
              $tostoreComplete.find('.has-collect-benefit .collect-reward').text(res.data.coupon_title);
              $tostoreComplete.find('.has-collect-benefit .collect-value').text(res.data.value);
              if(res.data.star_num == res.data.collect_num){
                $tostoreComplete.find('.has-collect-benefit .star-full').show();
                $tostoreComplete.find('.has-collect-benefit .full-tip').show().siblings().hide();
              } else {
                $tostoreComplete.find('.has-collect-benefit .star-full').hide();
                $tostoreComplete.find('.has-collect-benefit .no-full-tip').show().siblings().hide();
              }
              $tostoreComplete.find('.has-collect-benefit').show();
            }
          });
        }
        $tostoreComplete.find('.btn-area .check-order-btn').attr('data-order-id', orderId);
        $tostoreComplete.find('.btn-area').show();
      }
    }
    // 到店填充我的订单页
    function TostoreOrderDetailPage() {
      var _orderdetail = this,
          tostoreStatus = {
              '0': '待付款',
              '1': '待确认',
              '2': '已确认',
              '6': '已完成',
              '7': '已关闭'
          };

      _orderdetail.getAdditionalInfo = function(goods){
        if(goods.delivery_id && goods.delivery_id!="0"){
          var tempHtml = "<div data-goodsId='"+goods.goods_id+"'  class='leavemsg-wrap'>";
          $.ajax({
            url: "/index.php?r=pc/AppShop/GetDelivery",
            type: "GET",
            async: false,
            data: {
              app_id: appId,
              delivery_id: goods.delivery_id
            },
            dataType: "JSON",
            success: function(data) {
              $.each(data.data.delivery_info, function(index, ele) {
                switch (ele.type) {
                  case "text":
                    if(ele.is_hidden==1)
                    tempHtml += "<div data-value='"+ ele.name +"'><input type='text'  placeholder='" + ele.name + "'/></div>";
                    break;
                  case "mul-text":
                    if(ele.is_hidden==1)
                    tempHtml += "<div data-value='"+ ele.name +"'><input type='text'   placeholder='" + ele.name + "'/></div>";
                    break;
                  case "picture":
                    if(ele.is_hidden==1)
                        tempHtml += "<div class='leavePicForSeller' data-value='"+ ele.name +"'>" + '<span style="position:absolute;color:#AAA;">'+ele.name+'</span><a class="btn_addPic" href="javascript:void(0);" style="top:25px;"><img src="http://cdn.jisuapp.cn/zhichi_frontend/static/webapp/images/camera.png"><input type="file" class="filePrew"/></a><div class="imgList"></div></div>';
                    break;
                }
              });
              tempHtml+="</div>";
              $('#tostoreOrderDetail').on("click", ".btn_addPic", function() {
                var that=this;//.leavemsg-wrap
                $(this).imgUpload(function(url) {
                  var html = "<a><img src='" + url + "'/><span>&times;</span></a>";
                  $(that).closest(".leavePicForSeller").find(".imgList").append(html);

                  $(that).closest(".leavePicForSeller").find('.imgList a').on("mouseover",function(){
                      $(this).find("span").show();
                  }).on("mouseout",function(){
                      $(this).find("span").hide();
                  });
                  $(that).closest(".leavePicForSeller").find('.imgList a span').on("click",function(){
                      $(this).closest("a").remove();
                  });
                });
              });
            },
            error: function(data) {
              alertTip(data.data);
            }
          });
          return tempHtml;
        }else{
          return "";
        }
      };

      _orderdetail.modifyTostoreOrderDetail = function(order) {
        var tostoreOrderDetail = $('#tostoreOrderDetail'),
            detail = order.data[0].form_data,
            status = detail.status,
            html = '',
            btnStatus, addressInfo,
            benefit_html = '',
            can_use_benefit = detail.can_use_benefit,
            goods_type = detail.goods_type,
            express_fee = order.data[0].express_fee;

        // 到店取餐号显示
        if(detail.tostore_data.tostore_order_type == 1){
          var time = detail.tostore_data.appointed_time;
          // orderDetail.find('.tostoreAppointmentTime').closest('div').show();
          tostoreOrderDetail.find('.appointmentInfo').hide();
          tostoreOrderDetail.find('.tostoreAppointmentTime').text(time);
        }else{
          time = detail.tostore_data.tostore_appointment_time;
          tostoreOrderDetail.find('.appointmentInfo').show();
          // orderDetail.find('.tostoreAppointmentTime').closest('div').hide();
          tostoreOrderDetail.find('.orderDetail-appo-time').text(time);
        }
        var num = detail.tostore_data.formatted_queue_num;
        tostoreOrderDetail.find('.tostoreNum').closest('div').show();
        tostoreOrderDetail.find('.tostoreNum').text(num);

        //到店
        tostoreOrderDetail.find('.realTotalPrice').text(detail.total_price);
        tostoreOrderDetail.find('.tostoreBuyerPhone').text(detail.tostore_data.tostore_buyer_phone);
        tostoreOrderDetail.find('.addtime').text(detail.add_time);
        tostoreOrderDetail.find('.tostoreRemark').text(detail.tostore_data.tostore_remark);
        $('#tostoreOrderDetail .orderDetail-address-detail').hide();
        tostoreOrderDetail.find('.tostoreType').closest('div').show();
        tostoreOrderDetail.find('.tostoreLocation').text(detail.location_name);
        tostoreOrderDetail.find('.orderDetail-section.freight-since').hide();
        if(detail.tostore_data.tostore_order_type == 1){
          tostoreOrderDetail.find('.tostoreType').text('外带');
        }else{
          tostoreOrderDetail.find('.tostoreType').text('预约');
        }

        if(goods_type == 3 && status != 0){
          // 到店显示付款付款方式
          tostoreOrderDetail.find('.pay-way').find('span.checked').closest('div').show().siblings().hide();
        }else{
          tostoreOrderDetail.find('.pay-way').find('span').closest('div').show()
        }


        if(detail.selected_benefit != null){
          if(detail.selected_benefit.discount_type != null && detail.selected_benefit.discount_type == 'coupon'){
            var selected_content = detail.selected_benefit.title;
            tostoreOrderDetail.find('.discount-type').html(selected_content);
          }else if(detail.selected_benefit.discount_type == 'vip'){
            var selected_content = detail.selected_benefit.title;
            tostoreOrderDetail.find('.discount-type').html(selected_content);
          }else if(detail.selected_benefit.discount_type == 'integral'){
            var selected_content = '积分抵扣'+detail.selected_benefit.value+'元';
            tostoreOrderDetail.find('.discount-type').html(selected_content);
          }else {
            tostoreOrderDetail.find('.discount-type').html("暂无任何优惠");
          }
        }else{
          $('#tostoreOrderDetail .tostoreBenefit').hide();
        }
        
        
        if(goods_type == 3){
          tostoreOrderDetail.find('.orderDetail-status').text(tostoreStatus[status]);
        }else {
          tostoreOrderDetail.find('.orderDetail-status').text(orderStatus[status]);
        }
        tostoreOrderDetail.find('.orderDetail-order-id').text(detail.order_id);
        tostoreOrderDetail.find('.orderDetail-total-price').text(detail.original_price);

        // 优惠抵扣
        var benefitDeduction = detail.discount_cut_price;
        tostoreOrderDetail.find('.orderDetail-benefit-deduction').text(benefitDeduction);

        // 储值金
        tostoreOrderDetail.find('.orderDetail-balance-deduction').text(detail.use_balance);
        if(detail.use_balance == 0 ){
          tostoreOrderDetail.find('#isUseBalancePay').prop('checked', false);
        } else {
          tostoreOrderDetail.find('#isUseBalancePay').prop('checked', true);
        }
        if(status != 0){
          tostoreOrderDetail.find('.balance-area').hide();
          tostoreOrderDetail.find('.balance-deduction').show();
        } else {
          tostoreOrderDetail.find('.balance-deduction').hide();
          tostoreOrderDetail.find('.balance-area').show();
        }

        tostoreOrderDetail.find('.orderDetail-express-fee').text(express_fee);
        tostoreOrderDetail.find('.orderDetail-express-fee').attr('express_fee',express_fee);
        tostoreOrderDetail.find('.orderDetail-cancel-order .num').text(detail.total_price);
        tostoreOrderDetail.find('.orderDetail-pay-count').text('￥' + Number(detail.total_price));
        tostoreOrderDetail.find('.orderDetail-add-time').text(detail.add_time);

        var addressInfoId = '';
        if (addressInfo = detail.address_info) {
          if(addressInfo.address_id){
            addressInfoId = addressInfo.address_id
          }
          if(addressInfo.receiver){
            var defaultAddr = addressInfo.defaultAddress == 1 ? "<span style='color:#C40B1D;'>[默认]</span>" : "";

            tostoreOrderDetail.find('.orderDetail-address-detail').html('<div data-freight="'+addressInfoId+'"><span class="orderDetail-name">' + addressInfo.receiver + '</span>&nbsp;&nbsp;<span class="orderDetail-contact">' + addressInfo.phone + '</span></div><div class="orderDetail-address" style="color:#444;width: 274px;">' + defaultAddr + addressInfo.region + addressInfo.detailAddress + '</div>');
          }else{
            tostoreOrderDetail.find('.orderDetail-address-detail').html('<div data-freight="'+addressInfoId+'"><span class="orderDetail-name" data-freight="'+addressInfoId+'">'+addressInfo.name+'</span>&nbsp;&nbsp;<span class="orderDetail-contact">'+addressInfo.contact+'</span></div><div class="orderDetail-address">'+addressInfo.province.text+addressInfo.city.text+addressInfo.district.text+addressInfo.detailAddress+'</div>');
          }
        } else {
          tostoreOrderDetail.find('.orderDetail-address-detail').html('请选择地址');
        }
        $.each(detail.goods_info, function(index, goods) {
          html += '<li data-goodsId="'+goods.goods_id+'"><div class="dialog-block-item"><img class="list-goods-cover" src=' + goods.cover + '><div class="list-goods-content"><div class="list-goods-title">' + goods.goods_name + '<p class="pull-right" style="color:#ff8927;">￥' + goods.price + '</p></div><div class="list-goods-model">'+ (goods.model_value ? goods.model_value.join(',') : '') +'</div></div><div class="list-goods-right"><p><div class="quantity">' + '<span class="pay-buy-count">×'+Number(goods.num)+'件</span><div class="response-area response-area-minus" data-price="' + goods.price + '"></div><div class="response-area response-area-plus" data-stock="' + goods.stock + '" data-price="' + goods.price + '"></div></div></p></div></div>'+_orderdetail.getAdditionalInfo(goods)+'</li>';
        });

        tostoreOrderDetail.find('.orderDetail-order-list').html(html);

        var additionalInfo = detail.additional_info;
        if(additionalInfo){
          $("#tostoreOrderDetail .leavemsg-wrap").each(function(index,element){
            var tempgoodsId=$(element).attr("data-goodsId");
            if(tempgoodsId){
              if(additionalInfo[tempgoodsId]){
                $.each(additionalInfo[tempgoodsId],function(inde,ele){
                  switch(ele.type){
                    case "text":
                      $(element).find("div").not(".imgList").each(function(ind,el){
                        if($(el).attr("data-value")==ele.title){
                          $(el).find("input").val(ele.value);
                        }
                      });
                      break;
                    case "picture":
                      var imgStr = "";
                      ele.value && $.each(ele.value,function(i,e){
                        imgStr+="<a><img src='"+e+"' /><span>&times;</span></a>";
                      });
                      console.log(imgStr);
                      $(element).find("div").not(".imgList").each(function(ind,el){
                        if($(el).attr("data-value")==ele.title){
                          $(el).find(".imgList").append(imgStr);
                          $('#tostoreOrderDetail .leavemsg-wrap .imgList a').on("mouseover",function(){
                            $(this).find("span").show();
                          }).on("mouseout",function(){
                            $(this).find("span").hide();
                          });
                          $('#tostoreOrderDetail .leavemsg-wrap .imgList a span').on("click",function(){
                            $(this).closest("a").remove();
                          });
                        }
                      });
                    break;
                  }
                });
              }
            }
          });
        }else{
          console.log("No Additional Info!");
        }

        switch (status) {
          case '0':
              btnStatus = '<span class="btn btn-yellow orderDetail-pay-directly" data-goods-type="'+goods_type+'">去付款</span>';
              break;
          case '2':
              btnStatus = '<span class="btn btn-yellow orderDetail-verification-code">核销码</span>&nbsp;<span class="btn btn-yellow orderDetail-sure-receipt">确认</span>';
              break;
          case '3':
              btnStatus = '<span class="btn btn-yellow orderDetail-verification-code">核销码</span>&nbsp;<span class="btn orderDetail-check-logistics">查看物流</span>&nbsp;<span class="btn btn-yellow orderDetail-make-comment">去评价</span>';
              break;
          case '4':
              btnStatus = '<span>退款审核中</span>';
              break;
          case '5':
              btnStatus = '<span>退款中</span><span class="btn btn-yellow orderDetail-receive-drawback">收到退款</span>';
              break;
          case '7':
              btnStatus = '<span>已关闭</span>';
              break;
        }
        tostoreOrderDetail.find('.orderDetail-btn-status').html(btnStatus);

        OfficialPages['pay-page'].setCode(order);
      };
    }


    //电商填充我的订单页
    function GoodsOrderDetailPage() {
      var _goodsOrderDetail = this,
          orderStatus = {
              '0': '待付款',
              '1': '待发货',
              '2': '待收货',
              '3': '待评价',
              '4': '退款审核中',
              '5': '退款中',
              '6': '已完成',
              '7': '已关闭'
          };

      // 获取上门自提地址
      _goodsOrderDetail.getLocationFreight = function(){
        var goodsOrderDetail = $('#goodsOrderDetail');

        $.ajax({
          url: '/index.php?r=AppShop/getAppShopLocationInfo',
          type: 'POST',
          data: {
              app_id:appId
          },
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              alertTip(data.data);
              return;
            }
            goodsOrderDetail.find('.freight-loation-name').text(data.data.region_string + data.data.shop_location);
            goodsOrderDetail.find('.freight-loation-phone').text(data.data.shop_contact).attr('href','tel:'+data.data.shop_contact);
            _goodsOrderDetail.locationMap();
          }
        });
      }

      // 运费地址打开地图
      _goodsOrderDetail.locationMap = function(){
        var locationName =  $('#goodsOrderDetail').find('.freight-loation-name').text();
            locationName = locationName.replace(/\s+/g,'');

        $.ajax({
          url: '/index.php?r=Map/GetLatAndLngByAreaInfo',
          type: 'POST',
          data: {
            location_info:locationName
          },
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              // alertTip(data.message);
              return;
            }
            $('#goodsOrderDetail').find('.freight-loation-name').attr('lat',data.result.location.lat);
            $('#goodsOrderDetail').find('.freight-loation-name').attr('lng',data.result.location.lng);
            $('#goodsOrderDetail').find('.freight-loation-name').attr('address',locationName);
          }
        });
      }

      _goodsOrderDetail.modifyGoodsOrderDetail = function(order) {
        APP.initMap();
        var goodsOrderDetail = $('#goodsOrderDetail'),
            orderdata = order.data[0],
            detail = orderdata.form_data,
            status = detail.status,
            html = '',
            btnStatus, addressInfo,
            benefit_html = '',
            can_use_benefit = detail.can_use_benefit,
            goods_type = detail.goods_type,
            express_fee = order.data[0].express_fee,
            additional_info = detail.additional_info,
            delivery_id_arr = [],
            additional_info_goods = [];

        // 下单时间
          goodsOrderDetail.find('.goods-add-time').text(detail.add_time);
        //留言信息
          if(detail.remark){
            goodsOrderDetail.find('.remark').show().find('.remark-word').text(detail.remark);
          }else{
            goodsOrderDetail.find('.remark').hide();
          }


        //补充信息的展示
          if(additional_info){
            goodsOrderDetail.find('.additional-info').show();
            for(var i = 0;i < detail.goods_info.length;i++){
              if(detail.goods_info[i].delivery_id != 0 && delivery_id_arr.indexOf(detail.goods_info[i].delivery_id) < 0){
                delivery_id_arr.push(detail.goods_info[i].delivery_id);
                additional_info_goods.push(detail.goods_info[i]);
              }
            }
            goodsOrderDetail.find('.additional-info').data('additionalArr',additional_info_goods);
            goodsOrderDetail.find('.additional-info').attr('data-goodsinfo',JSON.stringify(additional_info));
          }else{
            goodsOrderDetail.find('.additional-info').hide();
          }

        // 运费
          if(detail.is_self_delivery == 1){
            goodsOrderDetail.find('.goods-shipping-method').text('上门自提');
            goodsOrderDetail.find('.no-self-delivery-loaction').hide();
            goodsOrderDetail.find('.freight-since').show();
            APP.initMap();
            _goodsOrderDetail.getLocationFreight();
          }else{
            goodsOrderDetail.find('.goods-shipping-method').text('快递');
            // 地址
            goodsOrderDetail.find('.no-self-delivery-loaction').show();
            goodsOrderDetail.find('.freight-since').hide();
            addressInfo = detail.address_info;
            $('#goodsOrderDetail .no-self-delivery-loaction').find('.name-number').text(addressInfo.name +' '+addressInfo.contact);
            $('#goodsOrderDetail .no-self-delivery-loaction').find('.address').text(addressInfo.province.text + addressInfo.city.text + addressInfo.district.text + addressInfo.detailAddress);
          }

          // 支付方式
          if (detail.status != 0) {
            if(detail.payment_id == 0){
              goodsOrderDetail.find('.pay-way').find('div').eq(0).show().siblings().hide();
            }else{
              goodsOrderDetail.find('.pay-way').find('div').eq(1).show().siblings().hide();
            }
          }else{
            goodsOrderDetail.find('.pay-way').children('div').show();
          }

        //当前选中优惠价格初始化
        if(detail.selected_benefit != null){
          if(detail.selected_benefit.discount_type != null && detail.selected_benefit.discount_type == 'coupon'){
            var selected_content = detail.selected_benefit.title;
            goodsOrderDetail.find('.discount-type').html(selected_content);
          }else if(detail.selected_benefit.discount_type == 'vip'){
            var selected_content = detail.selected_benefit.title;
            goodsOrderDetail.find('.discount-type').html(selected_content);
          }else if(detail.selected_benefit.discount_type == 'integral'){
            var selected_content = '积分抵扣'+detail.selected_benefit.value+'元';
            goodsOrderDetail.find('.discount-type').html(selected_content);
          }else {
            goodsOrderDetail.find('.discount-type').html("暂无任何优惠");
          }
        }
        //优惠信息列表
        if(can_use_benefit.coupon_benefit.length != 0){
          $.each(can_use_benefit.coupon_benefit, function(index, coupon) {
            benefit_html += '<li data-type="coupon" data-value="'+coupon.coupon_id+'">'+coupon.title+'</li>';
          });
        }
        if(can_use_benefit.vip_benefit.length != 0){
          benefit_html += '<li data-type="vip" data-value="'+can_use_benefit.vip_benefit.discount+'">'+can_use_benefit.vip_benefit.title+'</li>';
        }
        if(can_use_benefit.integral_benefit.length != 0){
          benefit_html += '<li data-type="integral" data-value="'+can_use_benefit.integral_benefit.value+'">积分抵扣'+can_use_benefit.integral_benefit.value+'</li>';
        }
        $("#discountDialog .discount-list ul").empty().append(benefit_html);
        $("#discountDialog .discount-list ul li").click(function(){
          $(this).addClass("clickliStyle").siblings("li").removeClass("clickliStyle");
        });
        goodsOrderDetail.find('.goodsOrderDetail-status').text(orderStatus[status]);
        goodsOrderDetail.find('.goodsOrderDetail-order-id').text(detail.order_id);



        goodsOrderDetail.find('.goodsOrderDetail-order-total-price').text(detail.order_total_price);
        goodsOrderDetail.find('.goodsOrderDetail-total-price').text(detail.total_price);

        // 秒杀
        if(detail.has_seckill == 1){
          goodsOrderDetail.find('.goodsOrderDetail-seckill').show().find('.seckill-cut-price').text(detail.seckill_cut_price);
          goodsOrderDetail.find('.goodsOrderDetail-original-price').text(detail.seckill_original_price);
        }else{
          goodsOrderDetail.find('.goodsOrderDetail-seckill').hide();
          goodsOrderDetail.find('.goodsOrderDetail-original-price').text(detail.original_price);
        }

        // 优惠抵扣
        var benefitDeduction = detail.discount_cut_price;
        goodsOrderDetail.find('.goodsOrderDetail-benefit-deduction').text(benefitDeduction);

        // 储值金
        goodsOrderDetail.find('.goodsOrderDetail-balance-deduction').text(detail.use_balance);
        if(detail.use_balance == 0 ){
          goodsOrderDetail.find('.balance-deduction').hide();
          goodsOrderDetail.find('#isUseBalancePay').prop('checked', false);
        } else {
          goodsOrderDetail.find('.balance-deduction').show();
          goodsOrderDetail.find('#isUseBalancePay').prop('checked', true);
        }

        goodsOrderDetail.find('.goodsOrderDetail-express-fee').text(express_fee);
        goodsOrderDetail.find('.goodsOrderDetail-express-fee').attr('express_fee',express_fee);
        goodsOrderDetail.find('.goodsOrderDetail-cancel-order .num').text(detail.total_price);
        goodsOrderDetail.find('.goodsOrderDetail-pay-count').text('￥' + Number(detail.total_price));
        goodsOrderDetail.find('.goodsOrderDetail-add-time').text(detail.add_time);

        var addressInfoId = '';
        if (addressInfo = detail.address_info) {
          if(addressInfo.address_id){
            addressInfoId = addressInfo.address_id
          }
          if(addressInfo.receiver){
            var defaultAddr = addressInfo.defaultAddress == 1 ? "<span style='color:#C40B1D;'>[默认]</span>" : "";

            goodsOrderDetail.find('.goodsOrderDetail-address-detail').html('<div data-freight="'+addressInfoId+'"><span class="goodsOrderDetail-name">' + addressInfo.receiver + '</span>&nbsp;&nbsp;<span class="goodsOrderDetail-contact">' + addressInfo.phone + '</span></div><div class="goodsOrderDetail-address" style="color:#444;width: 274px;">' + defaultAddr + addressInfo.region + addressInfo.detailAddress + '</div>');
          }else{
            goodsOrderDetail.find('.goodsOrderDetail-address-detail').html('<div data-freight="'+addressInfoId+'"><span class="goodsOrderDetail-name" data-freight="'+addressInfoId+'">'+addressInfo.name+'</span>&nbsp;&nbsp;<span class="goodsOrderDetail-contact">'+addressInfo.contact+'</span></div><div class="goodsOrderDetail-address">'+addressInfo.province.text+addressInfo.city.text+addressInfo.district.text+addressInfo.detailAddress+'</div>');
          }
        } else {
          goodsOrderDetail.find('.goodsOrderDetail-address-detail').html('请选择地址');
        }
        $.each(detail.goods_info, function(index, goods) {
          var sprice = '';
          if(goods.is_seckill == 1){
            sprice = '<p class="goodsPrice"><span class="goods-seckill-price">￥' + goods.price + '</span><span class="goods-original-price">'+goods.original_price+'</span></p><p class="goodsOrderDetail-seckill-sign">秒杀商品</p>';
          }else{
            sprice = '<p class="goodsPrice">￥' + goods.price + '</p>';
          }
          html += '<li><div class="dialog-block-item"><img class="list-goods-cover" src=' + goods.cover + '><div class="list-goods-content"><div class="list-goods-title">' + goods.goods_name + '</div><div class="list-goods-model">'+ (goods.model_value ? goods.model_value.join(',') : '') +'</div></div>'
            +'<div class="list-goods-right">'+sprice+'<div class="quantity">' + '<span class="pay-buy-count">×'+Number(goods.num)+'件</span><div class="response-area response-area-minus" data-price="' + goods.price + '"></div><div class="response-area response-area-plus" data-stock="' + goods.stock + '" data-price="' + goods.price + '"></div></div></div></div></li>';
        });

        goodsOrderDetail.find('.goodsOrderDetail-order-list').html(html);


        switch (status) {
          case '0':
              btnStatus = '<span class="btn btn-orange goodsOrderDetail-pay-directly" data-goods-type="'+goods_type+'">支付</span>';
              break;
          case '1':
              btnStatus = '<span>待发货</span>&nbsp;<span class="btn goodsOrderDetail-verification-code">核销码</span>&nbsp;<span class="btn goodsOrderDetail-apply-drawback">申请退款</span>';
              break;
          case '2':
            btnStatus = '<span class="btn goodsOrderDetail-verification-code">核销码</span>&nbsp;' + (detail.is_self_delivery == 0 ? '<span class="btn goodsOrderDetail-check-logistics">查看物流</span>&nbsp;': '')+'<span class="btn goodsOrderDetail-apply-drawback">申请退款</span>&nbsp;<span class="btn btn-orange goodsOrderDetail-sure-receipt">确认收货</span>';
            break;
          case '3':
            btnStatus = (detail.is_self_delivery == 0 ? '<span class="btn goodsOrderDetail-check-logistics">查看物流</span>&nbsp;':'')+'<span class="btn btn-orange goodsOrderDetail-make-comment">去评价</span>';
            break;
          case '4':
              btnStatus = '<span>退款审核中</span>';
              break;
          case '5':
              btnStatus = '<span>退款中</span><span class="btn goodsOrderDetail-receive-drawback">收到退款</span>';
              break;
          case '6':
            btnStatus = detail.is_self_delivery == 0 ? '<span class="btn goodsOrderDetail-check-logistics">查看物流</span>' : 0;
              break;
          case '7':
              btnStatus = '<span>已关闭</span>';
              break;
        }
        goodsOrderDetail.find('.goodsOrderDetail-btn-status').html(btnStatus);

        if(GetQueryString('franchisee')){
          $('#goodsOrderDetail .balance-area').hide();
        } else {
          // 判断当前储值金是否足够支付该订单(之前生成的使用储值金的订单)
          if((status == 0) && (Number(order.data[0].balance) < Number(detail.useA_balance))){
            alertTip('储值金不足，请及时充值', function(){
              $("#goodsOrderDetail #isUseBalancePay").trigger('click');
            });
          }
        }

        OfficialPages['pay-page'].setCode(order);
      };
    }

    // 购物车
    function ShoppingCartPage() {
      var _shoppingcart = this,
          $shoppingCart = $('#shoppingCart'),
          page = 1;

      _shoppingcart.initialShoppingCart = function(data) {
        var count = data.count,
            data = data.data,
            html = '';

        if (data && data.length) {
          $.each(data, function(index, goods) {
            html += _shoppingcart.getListHtml(goods);
          });
        }

        $shoppingCart.find('.shoppingCart-goods-list').html(html);
        $shoppingCart.find('.shoppingCart-edit-complete').trigger('click');
        page++;
        $shoppingCart.find('.shoppingCart-check-box').addClass('checked');
        if(data && data.length){
          _shoppingcart.notBusinessTime(data);
        }
        recalculateCartCountPrice();
      };

      _shoppingcart.getShoppingCartData = function() {
        var franchiseeId = GetQueryString('franchisee');
        $.ajax({
          url: '/index.php?r=AppShop/cartList',
          type: 'get',
          data: {
    	      app_id: appId,
    	      page: page++,
            page_size: 20,
            sub_shop_app_id: franchiseeId,
            parent_shop_app_id: franchiseeId ? appId : '',
          },
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              alertTip(data.data);
              return;
            }
            var html = '';
            if (data.data) {
              $.each(data, function(index, goods) {
                html += _shoppingcart.getListHtml(goods);
              });
            }
            $shoppingCart.find('.shoppingCart-goods-list').append(html);
          }
        });
      };
      _shoppingcart.getListHtml = function(goods) {
        var goodsValue = '',
            price = '';
        if(goods.model_value){
          goodsValue = '<div style="margin-top: 0;font-size:10px">('+goods.model_value.join('|')+')</div>';
        }

        if(goods.is_seckill == 1){
          price = '<p class="shoppingCart-goods-original-price">原价 <span>￥ '+goods.original_price+'</span></p><p class="shoppingCart-goods-price-wrap">秒杀特价 ￥<span class="shoppingCart-goods-price">' + goods.price + '</span></p>';
        }else{
          price = '<p class="shoppingCart-goods-price-wrap">价格 ￥<span class="shoppingCart-goods-price">' + goods.price + '</span></p>';
        }

        return '<li data-id="' + goods.id + '" goods-id="' + goods.goods_id + '" model-id="' + goods.model_id + '" goodsType="' + goods.goods_type +'" model="' + goods.model + '" is_seckill="'+goods.is_seckill+'"><span class="shoppingCart-check-box check-box pull-left"><img src="http://cdn.jisuapp.cn/zhichi_frontend/static/webapp/images/checked.png"></span><div class="shoppingCart-goods-content"><img class="shoppingCart-goods-cover" src=' + goods.cover + '><div class="ellipsis shoppingCart-goods-title">' + goods.title + '</div>'
        + goodsValue + price +'<p style="display:none;"">&times;<span class="shoppingCart-goods-count">'+goods.num+'</span></p></div><div class="shoppingCart-goods-right"><div class="quantity"><button class="minus ' + (Number(goods.num) <= 0 ? 'disabled' : '') + '" type="button"></button><input type="text" class="txt" value=' + goods.num + '><button class="plus" type="button"></button><div class="response-area response-area-minus"></div><div class="response-area response-area-plus"></div></div></div></li>';
      };
      _shoppingcart.notBusinessTime = function(goods){
        var franchiseeId = GetQueryString('franchisee');
        $.ajax({
          url: '/index.php?r=AppShop/precheckShoppingCart',
          data: {
            app_id: appId,
            sub_shop_app_id: franchiseeId || '',
            parent_shop_app_id: franchiseeId ? appId : '',
            cart_arr: ''
          },
          dataType: 'json',
          success: function (data) {
            if(data.status == 1) {
              confirmTip({content:data.data},function(){});
              var goodsId = data.expired_goods_arr || [],
                  list = goods;
              if (goodsId && goodsId.length){
                for (var i = 0; i < goodsId.length; i++) {
                  var id = goodsId[i].goods_id;
                  for (var j = list.length - 1; j >= 0; j--) {
                    if (id == list[j].goods_id) {
                      // list[j].selected = false;
                      // console.log(list[j].goods_id)
                      $shoppingCart.find('.shoppingCart-goods-list li[goods-id='+id+']').find('.check-box').removeClass('checked');
                      $shoppingCart.find('.shoppingCart-bottom-nav').find('.shoppingCart-select-all').removeClass('checked');
                    }
                  };
                }
              }

              recalculateCartCountPrice();
            } else if (data.status == 401 || data.status == 2){
              // 未登录
              // app.login();
              return;
            }
          }
        })
      }
    }
    // 填充我的订单页内容
    function OrderDetailPage() {
      var _orderdetail = this,
          orderStatus = {
              '0': '待付款',
              '1': '待发货',
              '2': '待收货',
              '3': '待评价',
              '4': '退款审核中',
              '5': '退款中',
              '6': '已完成',
              '7': '已关闭'
          };

      _orderdetail.getAdditionalInfo = function(goods){
        if(goods.delivery_id && goods.delivery_id!="0"){
          var tempHtml = "<div data-goodsId='"+goods.goods_id+"'  class='leavemsg-wrap'>";
          $.ajax({
            url: "/index.php?r=pc/AppShop/GetDelivery",
            type: "GET",
            async: false,
            data: {
              app_id: appId,
              delivery_ids: [goods.delivery_id]
            },
            dataType: "JSON",
            success: function(data) {
              $.each(data.data[0].delivery_info, function(index, ele) {
                switch (ele.type) {
                  case "text":
                    if(ele.is_hidden==1)
                    tempHtml += "<div data-value='"+ ele.name +"'><input type='text'  placeholder='" + ele.name + "'/></div>";
                    break;
                  case "mul-text":
                    if(ele.is_hidden==1)
                    tempHtml += "<div data-value='"+ ele.name +"'><input type='text'   placeholder='" + ele.name + "'/></div>";
                    break;
                  case "picture":
                    if(ele.is_hidden==1)
                        tempHtml += "<div class='leavePicForSeller' data-value='"+ ele.name +"'>" + '<span style="position:absolute;color:#AAA;">'+ele.name+'</span><a class="btn_addPic" href="javascript:void(0);" style="top:25px;"><img src="http://cdn.jisuapp.cn/zhichi_frontend/static/webapp/images/camera.png"><input type="file" class="filePrew"/></a><div class="imgList"></div></div>';
                    break;
                }
              });
              tempHtml+="</div>";
              $('#orderDetail').on("click", ".btn_addPic", function() {
                var that=this;
                $(this).imgUpload(function(url) {
                  var html = "<a><img src='" + url + "'/><span>&times;</span></a>";
                  $(that).closest(".leavePicForSeller").find(".imgList").append(html);

                  $(that).closest(".leavePicForSeller").find('.imgList a').on("mouseover",function(){
                      $(this).find("span").show();
                  }).on("mouseout",function(){
                      $(this).find("span").hide();
                  });
                  $(that).closest(".leavePicForSeller").find('.imgList a span').on("click",function(){
                      $(this).closest("a").remove();
                  });
                });
              });
            },
            error: function(data) {
              alertTip(data.data);
            }
          });
          return tempHtml;
        }else{
          return "";
        }
      };
      // 更改地址后获取商品信息
      _orderdetail.freightWayChangeOrder = function(){
        $.ajax({
          url: '/index.php?r=AppShop/ChangeOrder',
          type: 'POST',
          data: {
            app_id:appId,
            order_id:$('.orderDetail-order-id').text(),
            sub_shop_app_id: GetQueryString('franchisee')
          },
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              alertTip(data.data);
              return;
            }
            APP.turnToPage({
              router: 'orderDetail',
              detail: data.data[0].form_data.order_id,
              franchisee: GetQueryString('franchisee'),
              redirect: true
            }, 'refresh');
          }
        });
      }
      // 获取上门自提地址
      _orderdetail.getLocationFreight = function(){
        var orderDetail = $('#orderDetail');

        $.ajax({
          url: '/index.php?r=AppShop/getAppShopLocationInfo',
          type: 'POST',
          data: {
              app_id:appId
          },
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              alertTip(data.data);
              return;
            }
            if(data.data.is_self_delivery == 0){
              orderDetail.find('.freight-loation').hide();
              return;
            }else{
              orderDetail.find('.freight-loation').show();
            }
            orderDetail.find('.freight-loation-name').text(data.data.region_string + data.data.shop_location);
            orderDetail.find('.freight-loation-phone').text(data.data.shop_contact).attr('href','tel:'+data.data.shop_contact);
            _orderdetail.locationMap();
          }
        });
      }

      // 运费地址打开地图
      _orderdetail.locationMap = function(){
        var locationName =  $('#orderDetail').find('.freight-loation-name').text();
            locationName = locationName.replace(/\s+/g,'');

        $.ajax({
          url: '/index.php?r=Map/GetLatAndLngByAreaInfo',
          type: 'POST',
          data: {
            location_info:locationName
          },
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              // alertTip(data.message);
              return;
            }
            $('#orderDetail').find('.freight-loation-name').attr('lat',data.result.location.lat);
            $('#orderDetail').find('.freight-loation-name').attr('lng',data.result.location.lng);
            $('#orderDetail').find('.freight-loation-name').attr('address',locationName);
          }
        });
      }

      var mapModule = {
            setPhoneMap: function(el, fn) {
              var _self = this,
                  lat = el.attr('lat'),
                  lng = el.attr('lng'),
                  zoom = parseInt(el.attr('mapzoom')) || 13,
                  latLng = new qq.maps.LatLng(lat, lng),
                  geocoder = new qq.maps.Geocoder();

              _self.clearOverlays();

              geocoder.getAddress(latLng);
              geocoder.setComplete(function(result) {
                _self.qqMapMarker = new qq.maps.Marker({
                  position: latLng,
                  map: _self.map
                });
                _self.map.panTo(latLng);

                fn && fn(result);
              });
              _self.map.zoomTo(zoom);
            },
            clearOverlays: function(id) { //清除地图覆盖物
              this.qqMapMarker && this.qqMapMarker.setMap(null);
            },
            initPhoneMap: function() {
              this.map = new qq.maps.Map($('.map-container-module')[0], {
                zoom: 13,
                zoomControl: false,
                panControl: false,
                mapTypeControl: false
              });
            },
            initMap: function() {
              if (!isWeixin) {
                this.initPhoneMap();
              }
            }
          };

      _orderdetail.setPhoneMap = function(el, fn) {
        mapModule.setPhoneMap(el, fn);
        return this;
      };

      _orderdetail.initMap = function() {
        mapModule.initMap();
      };

      _orderdetail.showMap = function() {
        $('.map-container').css('display', 'block');
      };

      _orderdetail.closeMap = function() {
        $('.map-container').css('display', 'none');
      }

      _orderdetail.modifyOrderDetail = function(order) {
        _orderdetail.initMap();

        var orderDetail = $('#orderDetail'),
            detail = order.data[0].form_data,
            status = detail.status,
            html = '',
            btnStatus, addressInfo,
            benefit_html = '',
            can_use_benefit = detail.can_use_benefit,
            goods_type = detail.goods_type,
            express_fee = order.data[0].express_fee;



        // 电商运费
        if(goods_type == 0){
          _orderdetail.getLocationFreight();
          if(detail.is_self_delivery == 0){
            orderDetail.find('.orderDetail-radio-box').removeClass('checked').eq(0).addClass('checked');
          }else{
            orderDetail.find('.orderDetail-radio-box').removeClass('checked').eq(1).addClass('checked');
          }
          if(orderDetail.find('.orderDetail-radio-box.checked').attr('locaionRadio') == 1){
            orderDetail.find('.orderDetail-address-detail').show().siblings('.orderDetail-section.freight-since').hide();
          }else{
            orderDetail.find('.orderDetail-section.freight-since').show().siblings('.orderDetail-address-detail').hide();
          };
        }else{
          orderDetail.find('.freight-loation').hide();
        }

        //当前选中优惠价格初始化
        if(detail.selected_benefit != null){
          if(detail.selected_benefit.discount_type != null && detail.selected_benefit.discount_type == 'coupon'){
            var selected_content = detail.selected_benefit.title;
            orderDetail.find('.discount-type').html(selected_content);
          }else if(detail.selected_benefit.discount_type == 'vip'){
            var selected_content = detail.selected_benefit.title;
            orderDetail.find('.discount-type').html(selected_content);
          }else if(detail.selected_benefit.discount_type == 'integral'){
            var selected_content = '积分抵扣'+detail.selected_benefit.value+'元';
            orderDetail.find('.discount-type').html(selected_content);
          }else {
            orderDetail.find('.discount-type').html("暂无任何优惠");
          }
        }
       
        //优惠信息列表
        if(can_use_benefit.coupon_benefit.length != 0){
          $.each(can_use_benefit.coupon_benefit, function(index, coupon) {
            benefit_html += '<li data-type="coupon" data-value="'+coupon.coupon_id+'">'+coupon.title+'</li>';
          });
        }
        if(can_use_benefit.vip_benefit.length != 0){
          benefit_html += '<li data-type="vip" data-value="'+can_use_benefit.vip_benefit.discount+'">'+can_use_benefit.vip_benefit.title+'</li>';
        }
        if(can_use_benefit.integral_benefit.length != 0){
          benefit_html += '<li data-type="integral" data-value="'+can_use_benefit.integral_benefit.value+'">积分抵扣'+can_use_benefit.integral_benefit.value+'</li>';
        }
        $("#discountDialog .discount-list ul").empty().append(benefit_html);
        $("#discountDialog .discount-list ul li").click(function(){
          $(this).addClass("clickliStyle").siblings("li").removeClass("clickliStyle");
        });
        
        orderDetail.find('.orderDetail-status').text(orderStatus[status]);
        orderDetail.find('.orderDetail-order-id').text(detail.order_id);
        orderDetail.find('.orderDetail-total-price').text(detail.original_price);

        // 优惠抵扣
        var benefitDeduction = detail.discount_cut_price;
        orderDetail.find('.orderDetail-benefit-deduction').text(benefitDeduction);

        // 储值金
        var balanceNum = order.data[0].balance;
        if(balanceNum == 0){
          orderDetail.find('.orderDetail-balance').text(balanceNum);
          orderDetail.find('.imitate-wx-switch').hide();
        } else {
          orderDetail.find('.orderDetail-balance').text(balanceNum);
          orderDetail.find('.imitate-wx-switch').show();
        }
        orderDetail.find('.orderDetail-balance-deduction').text(detail.use_balance);
        if(detail.use_balance == 0 ){
          orderDetail.find('#isUseBalancePay').prop('checked', false);
        } else {
          orderDetail.find('#isUseBalancePay').prop('checked', true);
        }
        if(status != 0){
          orderDetail.find('.balance-area').hide();
          orderDetail.find('.balance-deduction').show();
        } else {
          orderDetail.find('.balance-deduction').hide();
          orderDetail.find('.balance-area').show();
        }

        orderDetail.find('.orderDetail-express-fee').text(express_fee);
        orderDetail.find('.orderDetail-express-fee').attr('express_fee',express_fee);
        orderDetail.find('.orderDetail-cancel-order .num').text(detail.total_price);
        orderDetail.find('.orderDetail-pay-count').text('￥' + Number(detail.total_price));
        orderDetail.find('.orderDetail-add-time').text(detail.add_time);

        var addressInfoId = '';
        if (addressInfo = detail.address_info) {
          if(addressInfo.address_id){
            addressInfoId = addressInfo.address_id
          }
          if(addressInfo.receiver){
            var defaultAddr = addressInfo.defaultAddress == 1 ? "<span style='color:#C40B1D;'>[默认]</span>" : "";

            orderDetail.find('.orderDetail-address-detail').html('<div data-freight="'+addressInfoId+'"><span class="orderDetail-name">' + addressInfo.receiver + '</span>&nbsp;&nbsp;<span class="orderDetail-contact">' + addressInfo.phone + '</span></div><div class="orderDetail-address" style="color:#444;width: 274px;">' + defaultAddr + addressInfo.region + addressInfo.detailAddress + '</div>');
          }else{
            orderDetail.find('.orderDetail-address-detail').html('<div data-freight="'+addressInfoId+'"><span class="orderDetail-name" data-freight="'+addressInfoId+'">'+addressInfo.name+'</span>&nbsp;&nbsp;<span class="orderDetail-contact">'+addressInfo.contact+'</span></div><div class="orderDetail-address">'+addressInfo.province.text+addressInfo.city.text+addressInfo.district.text+addressInfo.detailAddress+'</div>');
          }
        } else {
          orderDetail.find('.orderDetail-address-detail').html('请选择地址');
        }
        $.each(detail.goods_info, function(index, goods) {
          html += '<li><div class="dialog-block-item"><img class="list-goods-cover" src=' + goods.cover + '><div class="list-goods-content"><div class="list-goods-title">' + goods.goods_name + '</div><div class="list-goods-model">'+ (goods.model_value ? goods.model_value.join(',') : '') +'</div></div><div class="list-goods-right"><p>￥' + goods.price + '</p><p><div class="quantity">' + '<span class="pay-buy-count">×'+Number(goods.num)+'件</span><div class="response-area response-area-minus" data-price="' + goods.price + '"></div><div class="response-area response-area-plus" data-stock="' + goods.stock + '" data-price="' + goods.price + '"></div></div></p></div></div>'+_orderdetail.getAdditionalInfo(goods)+'</li>';
        });

        orderDetail.find('.orderDetail-order-list').html(html);

        var additionalInfo = detail.additional_info;
        if(additionalInfo){
          $("#orderDetail .leavemsg-wrap").each(function(index,element){
            var tempgoodsId=$(element).attr("data-goodsId");
            if(tempgoodsId){
              if(additionalInfo[tempgoodsId]){
                $.each(additionalInfo[tempgoodsId],function(inde,ele){
                  switch(ele.type){
                    case "text":
                      $(element).find("div").not(".imgList").each(function(ind,el){
                        if($(el).attr("data-value")==ele.title){
                          $(el).find("input").val(ele.value);
                        }
                      });
                      break;
                    case "picture":
                      var imgStr=""
                      ele.value && $.each(ele.value,function(i,e){
                        imgStr+="<a><img src='"+e+"' /><span>&times;</span></a>";
                      });
                      console.log(imgStr);
                    $(element).find("div").not(".imgList").each(function(ind,el){
                      if($(el).attr("data-value")==ele.title){
                        $(el).find(".imgList").append(imgStr);
                        $('#orderDetail .leavemsg-wrap .imgList a').on("mouseover",function(){
                          $(this).find("span").show();
                        }).on("mouseout",function(){
                          $(this).find("span").hide();
                        });
                        $('#orderDetail .leavemsg-wrap .imgList a span').on("click",function(){
                          $(this).closest("a").remove();
                        });
                      }
                    });
                    break;
                  }
                });
              }
            }
          });
        }else{
          console.log("No Additional Info!");
        }

        switch (status) {
          case '0':
              btnStatus = '<span class="orderDetail-cancel-order">应付金额:￥<span class="num">'+detail.total_price+'</span></span><span class="btn btn-orange orderDetail-pay-directly" data-goods-type="'+goods_type+'">去付款</span>';
              break;
          case '1':
              btnStatus = '<span>待发货</span>&nbsp;<span class="btn orderDetail-verification-code">核销码</span>&nbsp;<span class="btn orderDetail-apply-drawback">申请退款</span>';
              break;
          case '2':
              btnStatus = '<span class="btn orderDetail-verification-code">核销码</span>&nbsp;<span class="btn orderDetail-check-logistics">查看物流</span>&nbsp;<span class="btn orderDetail-apply-drawback">申请退款</span>&nbsp;<span class="btn btn-orange orderDetail-sure-receipt">确认收货</span>';
              break;
          case '3':
              btnStatus = '<span class="btn orderDetail-verification-code">核销码</span>&nbsp;<span class="btn orderDetail-check-logistics">查看物流</span>&nbsp;<span class="btn btn-orange orderDetail-make-comment">去评价</span>';
              break;
          case '4':
              btnStatus = '<span>退款审核中</span>';
              break;
          case '5':
              btnStatus = '<span>退款中</span><span class="btn orderDetail-receive-drawback">收到退款</span>';
              break;
          case '6':
              btnStatus = '<span class="btn orderDetail-verification-code">核销码</span>&nbsp;<span>已完成</span>&nbsp;<span class="btn orderDetail-check-logistics">查看物流</span>';
              break;
          case '7':
              btnStatus = '<span>已关闭</span>';
              break;
        }
        orderDetail.find('.orderDetail-btn-status').html(btnStatus);

        if(GetQueryString('franchisee')){
          $('#orderDetail .balance-area').hide();
        } else {
          // 判断当前储值金是否足够支付该订单(之前生成的使用储值金的订单)
          if((status == 0) && (Number(order.data[0].balance) < Number(detail.useA_balance))){
            alertTip('储值金不足，请及时充值', function(){
              $("#orderDetail #isUseBalancePay").trigger('click');
            });
          }
        }

        OfficialPages['pay-page'].setCode(order);
      };
    }

    // 我的地址
    function AddressDialog() {
      var _addressdialog = this,
          addressDialog = $('#addressDialog');

      // _addressdialog.showAddressDialog = function() {
        // if (!addressDialog.find('.addressDialog-address').length) {
        //     this.getAddress();
        // }
        // //addressDialog.find('.addressDialog-add-section').css('display', 'none');
        // // .siblings('.addressDialog-list-section').css('display', 'block');
        // addressDialog.addClass("zShow");
        // $(".page.zShow").removeClass("zShow");
        // addressDialog.find('.page-dialog-addressList').slideDown(400);
        // // if(id){
        // // 	addressDialog.find('.addressDialog-address[data-id='+id+'] .addressDialog-check-box').addClass('checked');
        // // }
      // };

      // _addressdialog.closeAddressDialog = function() {
      //   addressDialog.find('.page-bottom-content:visible').slideUp(400, function() {
      //     addressDialog.css('display', 'none');
      //   });
      // };

      _addressdialog.getAddress = function() {
        $.ajax({
          url: '/index.php?r=AppShop/addressList',
          type: 'get',
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              if (data.status === 2) {
                alertTip('请先登录账号', function() {
                  APP.showLogin();
                }, 700);
              } else {
                alertTip(data.data);
              }
              return;
            }
            _addressdialog.modifyAddressList(data);
          }
        });
      };

      _addressdialog.modifyAddressList = function(data) {
        var html = '',
            fragment = document.createDocumentFragment(),
            data = data.data,
            info;

        if (data.length) {
          $.each(data, function(list, address) {
            info = address.address_info;
            html += '<div class="dialog-block-item addressDialog-address" data-id=' + address.id + '>' + _addressdialog.getAddressListStr(address) + '</div>';
            $(fragment).append($(html).data('address-data', address));
            html = "";
          });
        } else if ($.isPlainObject(data)) {
          html += '<div class="dialog-block-item addressDialog-address" data-id=' + data.id + '>' + _addressdialog.getAddressListStr(data) + '</div>';
          $(fragment).append($(html).data('address-data', data));
          html = "";
        }

        //addressDialog.find('.addressDialog-address-list').prepend(html);
        addressDialog.find(".page-dialog-addressList").html("").append(fragment);

        addressDialog.find(".page-dialog-addressList .chooseaddressInfo span").each(function(index, ele) {
          if(!judgeBindEvent($(ele),"click")){
            $(ele).click(function() {
              if ($(ele).hasClass("address-checked")) {
                $(ele).removeClass("address-checked");
              } else {
                $(ele).addClass("address-checked");
                var tempVar=$(ele).closest(".chooseaddressInfo").next(".basicaddressInfo"),
                    freightAdressId = $(ele).closest(".addressDialog-address").attr('data-id');
                //     tempAddrStr= '<div data-freight="'+freightAdressId+'"><span class="orderDetail-name">' + tempVar.find("p:first-child span:first-child").text() + '</span>&nbsp;&nbsp;<span class="orderDetail-contact">' + tempVar.find("p:first-child span:last-child").text() + '</span></div><div class="orderDetail-address" style="color:#444;width: 274px;">' + tempVar.find("p:last-child span:last-child").text() + '</div>';
                switch(GetQueryString('from')){
                  case 'orderDetail':
                        // $('#orderDetail .orderDetail-address-detail').html(tempAddrStr);
                        _addressdialog.setOrderDetailAddress($(ele).closest('.addressDialog-address').attr('data-id'));
                        window.history.back();
                        break;
                  case 'previewGoodsOrder':
                        APP.OfficialPages['preview-goods-order'].setAddressId(freightAdressId);
                        APP.showPage('previewGoodsOrder', true); // 返回电商结算页 并且不刷新页面
                        break;
                }
                // $('#orderDetail').find('.orderDetail-address-detail').html(tempAddrStr);
                // addressDialog.removeClass("zShow");
                // $("#orderDetail").addClass("zShow");
              }
              addressDialog.find(".page-dialog-addressList .chooseaddressInfo span").not(ele).removeClass("address-checked");
            });
          }
        })
      };
      _addressdialog.getAddressListStr = function(d) {
        var info;

        if(d.address_info){
          info=d.address_info;
        }else{
          info=d;
        }
        if (d.is_default == 1) {
          if(info.receiver){
             return '<div class="chooseaddressInfo"><span class="shoppingCart-check-box address-check-box"><img src="http://cdn.jisuapp.cn/zhichi_frontend/static/webapp/images/checked.png"></span></div>' +
                           '<div class="basicaddressInfo"><p><span>' + info.receiver + '</span><span>' + info.phone + '</span></p><p><span class="defaultaddress">[默认]</span><span>' + info.region + "  " + info.detailAddress + '</span></p></div>' +
                           '<div class="addressDialog-right editaddressInfo"><span class="addressDialog-edit">编辑</span></div>';

          }else{
             return '<div class="chooseaddressInfo"><span class="shoppingCart-check-box address-check-box"><img src="http://cdn.jisuapp.cn/zhichi_frontend/static/webapp/images/checked.png"></span></div>' +
                           '<div class="basicaddressInfo"><p><span>' + info.name + '</span><span>' + info.contact + '</span></p><p><span class="defaultaddress">[默认]</span><span>' +_addressdialog.createAddressStr(info)+ '</span></p></div>' +
                          '<div class="addressDialog-right editaddressInfo"><span class="addressDialog-edit">编辑</span></div>';
          }
        } else {
          if(info.receiver){
                    //  return '<span class="addressDialog-check-box check-box"><img src="http://cdn.jisuapp.cn/zhichi_frontend/static/webapp/images/checked.png"></span><div class="addressDialog-content"><span class="addressDialog-name">'+info["收货人"]+'</span><span class="addressDialog-contact">'+info["电话"]+'</span><div class="addressDialog-address">'+info["收货地址"]/*+info.province.text+info.city.text+info.district.text+info.detailAddress*/+'</div></div><div class="addressDialog-right"><span class="addressDialog-delete">编辑</span></div>';
                return '<div class="chooseaddressInfo"><span class="shoppingCart-check-box address-check-box"><img src="http://cdn.jisuapp.cn/zhichi_frontend/static/webapp/images/checked.png"></span></div>' +
            '<div class="basicaddressInfo"><p><span>' + info.receiver + '</span><span>' + info.phone + '</span></p><p><span>' + info.region + "  " + info.detailAddress + '</span></p></div>' +
            '<div class="addressDialog-right editaddressInfo"><span class="addressDialog-edit">编辑</span></div>';

          }else{
                return '<div class="chooseaddressInfo"><span class="shoppingCart-check-box address-check-box"><img src="http://cdn.jisuapp.cn/zhichi_frontend/static/webapp/images/checked.png"></span></div>' +
                    '<div class="basicaddressInfo"><p><span>' + info.name + '</span><span>' + info.contact + '</span></p><p><span>' +_addressdialog.createAddressStr(info)+ '</span></p></div>' +
                    '<div class="addressDialog-right editaddressInfo"><span class="addressDialog-edit">编辑</span></div>';

          }
        }
      };
      _addressdialog.createAddressStr = function(info){
        //info.province.text+info.city.text+info.district.text+info.detailAddress
        var provice,city,district,detailAddress;
        if(!info.province.text){
          province = "";
        }else{
          provice = info.province.text;
        }
        if(!info.city){
          city = "";
        }else{
          city = info.city.text;
        }
        if(!info.district){
          district = "";
        }else{
          district = info.district.text;
        }
        if(!info.detailAddress){
          detailAddress = "";
        }else{
          detailAddress = info.detailAddress;
        }

        return provice+city+district+detailAddress;
      }
      _addressdialog.setOrderDetailAddress = function(addressId){
        $.ajax({
          url: '/index.php?r=AppShop/setAddress',
          type: 'get',
          data: {
            order_id: $('.orderDetail-order-id').text(),
            address_id: addressId,
            sub_shop_app_id: GetQueryString('franchisee')
          },
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              if (data.status === 2) {
                alertTip('请先登录账号', function() {
                  APP.showLogin();
                }, 700);
              } else {
                alertTip(data.data);
              }
              return;
            }
            console.log(data);
            OfficialPages['order-detail'].freightWayChangeOrder();
          },
          error:function(data){
            alertTip("网络状况可能不太好喔");
          }
        });
      }
    }
    function judgeBindEvent(jqElement,eventType){
      var objEvt = $._data(jqElement[0], "events");
      if (objEvt && objEvt[eventType]) {
        return true;
      }
      else {
        return false;
      }
    }
    // 我的订单
    function MyOrderPage() {
      var _myorder = this,
          $myOrder = $('#myOrder'),
          orderCategoryInfo = {
            0: {
              tabText: '电商',
              relatedContainer: 'myOrder-ebusiness',
              statusText: ['待付款','待发货','待收货','待评价','退款审核中','退款中','已完成','已关闭']
            },
            1: {
              tabText: '预约',
              relatedContainer: 'myOrder-appointment',
              statusText: ['待付款','待确认','待消费','待评价','退款审核中','退款中','已消费','已关闭']
            },
            2: {
              tabText: '外卖',
              relatedContainer: 'myOrder-takeout',
              statusText: ['待付款','待接单','待送餐','待评价','退款审核中','退款中','已完成','已关闭']
            },
            3: {
              tabText: '到店',
              relatedContainer: 'myOrder-tostore',
              statusText: ['待付款','待确认','已确认','','','','已完成','已关闭']
            },
            5: {
              tabText: '当面付',
              relatedContainer: 'myOrder-transfer',
              statusText: ['待付款','','','','','','已完成','已关闭']
            }
          };

      _myorder.modifyOrderList = function(data, container) {
        var goodsTypeList = data.goods_type_list,
            currentGoodsType = data.current_goods_type,
            html = tabs = '';

        data.data.length && $.each(data.data, function(index, order) {
          html += _myorder.getListStr(order.form_data, currentGoodsType);
        });
        // 传container时 为点击tab切换
        if (container) {
          $('.' + container).append(html);
        } else {
          // 不传container时 为第一次加载页面或者刷新页面

          // 清空列表
          $('.myOrder-list-wrap').remove();

          if(goodsTypeList.length > 1){
            var currentTab;
            $myOrder.find('.myOrder-single-wrap').css('display', 'none').siblings('.myOrder-multiple-wrap').css('display', 'block');
            $.each(goodsTypeList, function(index, goodsType){
              tabs += '<li class="flex-sub-box-'+goodsTypeList.length+'" data-href="'+orderCategoryInfo[goodsType].relatedContainer+'" data-page="1" data-goods-type="'+goodsType+'">'+orderCategoryInfo[goodsType].tabText+'</li>';
            });
            $myOrder.find('.myOrder-tab-list').html(tabs);

            currentTab = $('.myOrder-tab-list > li[data-goods-type='+currentGoodsType+']');
            $('.' + currentTab.attr('data-href')).html(html);
            $('.myOrder-tab-list > li').attr('data-page', 1);
            currentTab.attr('data-page', 2).trigger('click');

            if(data.is_more == 0){
              currentTab.addClass('js-nomore');
            }

          } else {
            if(goodsTypeList[0] == 5){
              tabs = '<li class="flex-sub-box-4 active" data-href="myOrder-all" data-page="1" data-goods-type='+currentGoodsType+'>全部</li><li class="flex-sub-box-4" data-href="myOrder-toPay" data-page="1" data-type="0" data-goods-type='+currentGoodsType+'>'+orderCategoryInfo[currentGoodsType].statusText[0]+'</li><li class="flex-sub-box-4" data-href="myOrder-complete" data-page="1" data-type="6" data-goods-type='+currentGoodsType+'>'+orderCategoryInfo[currentGoodsType].statusText[6]+'</li><li class="flex-sub-box-4" data-href="myOrder-closed" data-page="1" data-type="7" data-goods-type='+currentGoodsType+'>'+orderCategoryInfo[currentGoodsType].statusText[7]+'</li>';

              $('.myOrder-single-wrap .myOrder-content-container').addClass('myOrder-transfer');
            } else {
              tabs = '<li class="flex-sub-box-5 active" data-href="myOrder-all" data-page="1" data-goods-type='+currentGoodsType+'>全部</li><li class="flex-sub-box-5" data-href="myOrder-toPay" data-page="1" data-type="0" data-goods-type='+currentGoodsType+'>'+orderCategoryInfo[currentGoodsType].statusText[0]+'</li><li class="flex-sub-box-5" data-href="myOrder-sending" data-page="1" data-type="1" data-goods-type='+currentGoodsType+'>'+orderCategoryInfo[currentGoodsType].statusText[1]+'</li><li class="flex-sub-box-5" data-href="myOrder-receiving" data-page="1" data-type="2" data-goods-type='+currentGoodsType+'>'+orderCategoryInfo[currentGoodsType].statusText[2]+'</li><li class="flex-sub-box-5" data-href="myOrder-comment" data-page="1" data-type="3" data-goods-type='+currentGoodsType+'>'+orderCategoryInfo[currentGoodsType].statusText[3]+'</li>';
              if(goodsTypeList[0] == 0){
                $('.myOrder-single-wrap .myOrder-content-container').addClass('myOrder-goodsOrder');
              }
            }
            $myOrder.find('.myOrder-tab-list').html(tabs);
            $myOrder.find('.myOrder-multiple-wrap').css('display', 'none').siblings('.myOrder-single-wrap').css('display', 'block');
            $('.myOrder-all').html(html);
            $('.myOrder-tab-list > li').attr('data-page', 1).filter('[data-href="myOrder-all"]').attr('data-page', 2).trigger('click');
            if(data.is_more == 0){
              $('.myOrder-tab-list').children('[data-href="myOrder-all"]').addClass('js-nomore');
            }
          }
        }
      };

      _myorder.getListStr = function(data, currentGoodsType) {
        if(currentGoodsType == 5) {
          return _myorder.getTransferListStr(data, currentGoodsType);
        }
        var template = $('#myOrder-template').text(),
            btnStatus, goods_list, html;


        return template.replace(/\$\{(\w+?)\}/g, function($0, $1) {
          switch ($1) {
            case 'orderStatus':
              switch (data.status) {
                case '0':
                  btnStatus = '<span class="btn myOrder-cancel-order">取消订单</span>&nbsp;<span class="btn btn-orange myOrder-pay-directly">支付</span>';
                  return orderCategoryInfo[currentGoodsType].statusText[0];
                case '1':
                  btnStatus = (currentGoodsType == 3 ? '<span>待确认</span>&nbsp;':'')+'<span class="btn myOrder-verification-code">核销码</span>&nbsp;'+(currentGoodsType == 3 ?'' : '<span class="btn myOrder-apply-drawback">申请退款</span>');
                  return orderCategoryInfo[currentGoodsType].statusText[1];
                case '2':
                  btnStatus = ((currentGoodsType == 0 && data.is_self_delivery == 0) ? '<span class="btn myOrder-check-logistics">查看物流</span>&nbsp;' : '') + '<span class="btn myOrder-verification-code">核销码</span>'+(currentGoodsType == 3 ?'':'<span class="btn myOrder-apply-drawback">申请退款</span>&nbsp;<span class="btn btn-orange myOrder-sure-receipt">确认收货</span>');
                  return orderCategoryInfo[currentGoodsType].statusText[2];
                case '3':
                  btnStatus = ((currentGoodsType == 0 && data.is_self_delivery == 0) ? '<span class="btn myOrder-check-logistics">查看物流</span>&nbsp;' : '') + '<span class="btn myOrder-delete">删除订单</span>&nbsp;<span class="btn btn-orange myOrder-make-comment">去评价</span>';
                  return orderCategoryInfo[currentGoodsType].statusText[3];
                case '4':
                  btnStatus = '';
                  return orderCategoryInfo[currentGoodsType].statusText[4];
                case '5':
                  btnStatus = '';
                  return orderCategoryInfo[currentGoodsType].statusText[5];
                case '6':
                  btnStatus = ((currentGoodsType == 0 && data.is_self_delivery == 0) ? '<span class="btn myOrder-check-logistics">查看物流</span>' : '') + '<span class="btn myOrder-delete">删除订单</span>' ;
                  return orderCategoryInfo[currentGoodsType].statusText[6];
                case '7':
                  btnStatus = '<span class="btn myOrder-delete">删除订单</span>';
                  return orderCategoryInfo[currentGoodsType].statusText[7];
              }
              break;
            case 'btnStatus':
              return btnStatus;
            case 'orderPrice':
              return Number(data['total_price']);
            case 'goods_info':
              goods_list = '';
              $.each(data[$1], function(index, goods) {
                  goods_list += '<li><div class="dialog-block-item"><img class="myOrder-goods-cover" src=' + goods.cover + '><div class="myOrder-goods-title">' + goods.goods_name + '</div><div class="myOrder-goods-right"><p>￥<span class="myOrder-goods-price">' + goods.price + '</span></p><p>×<span class="myOrder-goods-count">' + goods.num + '</span></p></div></div></li>';
              });
              return goods_list;
            case 'franchisee_name':
              return (data.sub_shop_info && data.sub_shop_info.name) ? '<div class="myOrder-franchisee-name">'+data.sub_shop_info.name+'</div>' : '';
            default:
              return data[$1] || '';
          }
        });
      };

      _myorder.getTransferListStr = function(data, currentGoodsType) {
        var template = $('#myOrder-template').text(),
            btnStatus, goods_list, html;

        return template.replace(/\$\{(\w+?)\}/g, function($0, $1) {
          switch ($1) {
            case 'orderStatus':
              switch (data.status) {
                case '0':
                  btnStatus = '<span class="btn myOrder-cancel-order">取消订单</span>&nbsp;<span data-goods-type="5" class="btn btn-red myOrder-pay-directly">支付</span>';
                  return orderCategoryInfo[currentGoodsType].statusText[0];
                case '1':
                case '2':
                case '3':
                case '4':
                case '5':
                case '6':
                case '7':
                default:
                  btnStatus = '';
                  return orderCategoryInfo[currentGoodsType].statusText[data.status];
              }
              break;
            case 'btnStatus':
              return btnStatus;
            case 'orderPrice':
              return Number(data['total_price']);
            case 'goods_info':
              return '<li><div class="dialog-block-item"><div class="myOrder-goods-cover"><span class="ico-moon icon-store"></span></div><div class="myOrder-goods-title">当面付订单</div><div class="myOrder-goods-right"><p>￥<span class="myOrder-goods-price">'+ data.total_price +'</span></p></div></div></li>';
            case 'franchisee_name':
              return (data.sub_shop_info && data.sub_shop_info.name) ? '<div class="myOrder-franchisee-name">'+data.sub_shop_info.name+'</div>' : '';
            default:
              return data[$1] || '';
          }
        });
      };

      _myorder.getOrderList = function(li) {
        var _li = $(li),
            page = _li.attr('data-page'),
            status = _li.attr('data-type'),
            goodsType = _li.attr('data-goods-type'),
            para = {
              page: page,
              page_size: 20,
              goods_type: goodsType,
    					_app_id: appId,
    					app_id: appId,
              ck_id: GetCookiePara(),
              // sub_shop_app_id: GetQueryString('franchisee'),
              parent_shop_app_id: has_app_shop == 1 ? appId : ''
            };

        if (status !== undefined) {
          para.idx_arr = {
            idx: 'status',
            idx_value: status
          };
        }

        if(_li.hasClass('js-loading') || _li.hasClass('js-nomore')){
          return ;
        }
        _li.addClass('js-loading');

        $.ajax({
          url: '/index.php?r=AppShop/orderList',
          type: 'get',
          data: para,
          dataType: 'json',
          success: function(data) {
            _li.removeClass('js-loading');
            if (data.status !== 0) {
              if (data.status === 2) {
                alertTip('请先登录账号', function() {
                  APP.showLogin();
                }, 700);
              } else {
                alertTip(data.data);
              }
              return;
            }
            if(data.is_more == 0){
              _li.addClass('js-nomore');
            }
            _myorder.modifyOrderList(data, $(li).attr('data-href'));
            if (data.data.length) {
              $(li).attr('data-page', ++page);
            }
          },
          error : function() {
            _li.removeClass('js-loading');
          }
        });
      };
    }

    function MyAddressPage() {
      var _myaddresspage = this;

      _myaddresspage.modifyMyAddress = function(data) {
        var data = data.data,
            html = defaultAddress = '',
            info;

        if (data.length) {
          $.each(data, function(list, address) {
            info = address.address_info;
            if (address.is_default == 1) {
              defaultAddress = '<li data-id=' + address.id + '>' + _myaddresspage.getAddressStr(info) + '<div><span class="myAddress-delete">删除</span></div></li>';
            } else {
              html += '<li data-id=' + address.id + '><div class="myAddress-address">' + _myaddresspage.getAddressStr(info) + '</div><div><span class="myAddress-make-default">设为默认</span><span class="myAddress-delete">删除</span></div></li>';
            }
          });
        }

        if (!defaultAddress) {
          defaultAddress = '<li style="color:#a8a8a8; padding:15px 0;">暂无默认地址</li>';
        }
        if (!html) {
          html = '<li style="color:#a8a8a8; padding:15px 0;">暂无其他地址</li>';
        }

        $('.myAddress-defalut-address .myAddress-address').html(defaultAddress);
        $('#myAddress').find('.myAddress-address-list').html(html);
      };

      _myaddresspage.getAddressStr = function(info) {
        return '<dl><dt>收件人：</dt><dd>' + info.name + '</dd><dt>联系电话：</dt><dd>' + info.contact + '</dd><dt>联系地址：</dt><dd>' + info.province.text + info.city.text + info.district.text + info.detailAddress + '</dd></dl>';
      };
    }

    function LogisticsPage() {
      var _logistics = this,
          $logPage = $('#logisticsPage');

      _logistics.modifyLogisticsInfo = function(data) {
        var data = data.data,
            html = '';

        $logPage.find('.logistics-company').text(data.express_name);
        $logPage.find('.logistics-order-id').text(data.LogisticCode);
        switch (+data.State) {
          case 2:
              $logPage.find('.logistics-order-status').text('在途中').attr('status', '');
              break;
          case 3:
              $logPage.find('.logistics-order-status').text('已签收').attr('status', 'success');
              break;
          case 4:
              $logPage.find('.logistics-order-status').text('问题件').attr('status', 'error');
              break;
        }

        data.Traces.length && $.each(data.Traces, function(index, detail) {
          html = '<li><div>' + detail.AcceptStation + '</div><div>' + detail.AcceptTime + '</div></li>' + html;
        });
        $logPage.find('.logistics-info-list').html(html);
      };
    }

    function CommentPage() {
      var _comment = this,
          $commentPage = $('#commentPage');

      _comment.getComments = function(type, page) {
        $.ajax({
          url: '/index.php?r=AppShop/GetAssessList',
          data: {
            app_id: appId,
            goods_id: GetQueryString('detail'),
            sub_shop_app_id: GetQueryString('franchisee'),
            idx_arr: {
              idx: 'level',
              idx_value: type
            },
            page: page
          },
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              alertTip(data.data);
              return;
            }
            if (page == 1) {
              $commentPage.find('.comPage-comment-list').html(_comment.modifyCommentList(data.data));
            } else {
              $commentPage.find('.comPage-comment-list').append(_comment.modifyCommentList(data.data));
            }
            $commentPage.find('.comPage-comment-label[data-type=' + type + ']').attr('data-page', +page + 1);
          }
        });
      };

      _comment.dealCommentData = function(data) {
        _comment.setCommentNum(data.num);
        $commentPage.find('.comPage-comment-list').html(_comment.modifyCommentList(data.data));
        $commentPage.find('.comPage-bottom-section').css('top', +$commentPage.find('.comPage-top-section').height() + 36);
        $commentPage.find('.comPage-comment-label[data-type="0"]').attr('data-page', 2);
      };

      _comment.modifyCommentList = function(data) {
        var html = '',
            assess;

        data.length && $.each(data, function(index, comment) {
          assess = comment.assess_info;
          html += '<li class="comPage-comment-item"><div><img class="comPage-comment-photo" src=' + comment.buyer_headimgurl + '><span class="comPage-comment-name">' + comment.buyer_nickname + '</span></div><div><span class="comPage-comment-date">' + comment.add_time + '</span></div><p class="comPage-comment-content">' + assess.content + '</p>' + (assess.has_img ? (function(arr) {
              var pics = '<div class="comPage-comment-pics">';
              $.each(arr, function(i, pic) {
                  pics += '<img src=' + pic + '>';
              });
              pics += '</div>';
              return pics;
          })(assess.img_arr) : '') + '</li>';
          // <span class="comPage-comment-model">'+comment.model+'</span>
        });
        return html;
      };

      _comment.setCommentNum = function(num) {
        $commentPage.find('.comPage-positive-comment').text(num[1]);
        $commentPage.find('.comPage-neutral-comment').text(num[2]);
        $commentPage.find('.comPage-negative-comment').text(num[3]);
        $commentPage.find('.comPage-pic-comment').text(num[4]);
      };
    }

    function MakeComment() {
      var _makecomment = this,
          $makeComPage = $('#makeComment');

      _makecomment.initialGoodsComment = function(data) {
        var goods = data.data[0].form_data.goods_info,
            html = '';

        $.each(goods, function(index, info) {
          html += '<div class="makeCom-item makeCom-goods-comment" data-id=' + info.goods_id + '><div><img class="makeCom-goods-cover" src=' + info.cover + '><textarea class="makeCom-textarea" placeholder="写下购买体会为其他小伙伴提供参考，10字以上"></textarea></div><div class="makeCom-pic-container"><div class="makeCom-upload-pic"><p>&plus;</p><span>添加图片</span><input type="file" accept="image/jpg,image/jpeg, image/gif,image/png, image/bmp, image/jp2, image/x-ms-bmp, image/x-png"></div></div><div class="makeCom-level-container"><span class="makeCom-level-span active" data-level="1"><span class="icon-positive"></span><span class="icon-positive-active"></span>好评</span><span class="makeCom-level-span" data-level="2"><span class="icon-positive"></span><span class="icon-neutral-active"></span>中评</span><span class="makeCom-level-span" data-level="3"><span class="icon-negative"></span><span class="icon-negative-active"></span>差评</span></div></div>';
        });
        $makeComPage.find('.makeCom-goods-list').html(html);
      };

      _makecomment.submitComment = function(para) {
      	para.app_id = appId;
        $.ajax({
          url: '/index.php?r=AppShop/AddAssessList',
          type: 'post',
          data: para,
          dataType: 'json',
          success: function(data) {
            if (data.status !== 0) {
              alertTip(data.data);
              return;
            }
            alertTip('提交成功', function() {
              window.history.back();
            });
          }
        });
      }
    }

    function LoginDialog() {
      var _logindialog = this,
          dialog = $('#loginDialog');


      _logindialog.showLogin = function() {
        dialog.find('.center-wrap[data-type="login"]').show().siblings('.center-wrap').hide();
        dialog.find('.login-pic-code').attr('src', '/index.php?r=Login/GetNewIdentifyCode&i=' + parseInt(Math.random() * 10000000));
        APP.turnToPage({ router: 'loginDialog' });


        return _logindialog;
      };

      _logindialog.hideLogin = function() {
        // if(notFirstPage){
        window.history.back();
        // } else {
        // 	me.turnToPage({router: appData.data['homepage-router']});
        // }
        return _logindialog;
      };

      _logindialog.checkIfLogin = function() {
        return GetCookiePara('webappLogin') == 1;
      };

      _logindialog.setLogin = function() {
        var exdate = new Date();

        exdate.setMinutes(exdate.getMinutes() + 40);
        document.cookie = 'webappLogin=1; expires=' + exdate.toGMTString();
        return _logindialog;
      };
    }

    function PayPage() {
      var _paypage = this;
          _paypage.timer = '';

      _paypage.setCode = function(order){
        $('.orderDetail-pay-qrcode').attr('src', order.code_url);
      }
      _paypage.initial = function(order) {
        var orderId = order.data[0].form_data.order_id;

        _paypage.setCode(order);
        _paypage.timer = setInterval(function(){
          $.ajax({
            url:'/index.php?r=AppShop/getOrder',
            type: 'post',
            data: { order_id: orderId,app_id: appId, sub_shop_app_id: GetQueryString('franchisee') },
            dataType: 'json',
            success: function(data) {
              if (data.status != 0) {
                clearInterval(_paypage.timer);
                return;
              }
              if(data.data[0].form_data.status != 0){
                clearInterval(_paypage.timer);
                // 电商、到店订单支付完成调用
                function paySuccessCallback(param){
                  if(!GetQueryString('franchisee')){
                    // 多商家暂无集集乐等功能
                    $.ajax({
                      url: '/index.php?r=AppMarketing/CheckAppCollectmeStatus',
                      type: 'get',
                      data: {
                        'app_id': appId,
                        'order_id': orderId
                      },
                      dataType: 'json',
                      success: function(res){
                        if(res.valid == 0){
                          param['collectBenefit'] = 1;
                        }
                        APP.turnToPage(param);
                      }
                    });
                  } else {
                    setTimeout(function(){
                      APP.turnToPage(param);
                    },1500);
                  }                  
                }
                if(data.data[0].form_data.goods_type == 0){
                  paySuccessCallback({
                    router: 'goodsOrderPaySuccess',
                    detail: orderId,
                    franchisee: GetQueryString('franchisee'),
                    redirect: true
                  });
                } else if (data.data[0].form_data.goods_type == 3){
                  paySuccessCallback({
                    router: 'tostoreComplete',
                    detail: orderId,
                    redirect: true
                  });
                } else if (data.data[0].form_data.goods_type == 5) {
                  setTimeout(function(){
                    APP.turnToPage({
                      router: 'transferDetail',
                      detail: orderId,
                      redirect: true
                    });
                  },1500);
                }
              }
            },
            fail: function(){
              clearInterval(_paypage.timer);
            }
          })
        }, 2000);
      };
    }

    function UserCenterPage() {
      var _usercenterpage = this,
          centerPage = $('#userCenterPage');

      _usercenterpage.parseEdit = function(data) {
        var info = data.data,
            sex = info.sex == 0 ? '男' : '女',
            cover = info.cover_thumb || DEFAULTPHOTO,
            nickname = info.nickname || '',
            qq = info.qq || '';

        centerPage.find('.select-sex-dialog').removeClass('zShow');
        centerPage.find('.cover-thumb').attr('src', info.cover_thumb);
        centerPage.find('.nickname').val(info.nickname);
        centerPage.find('.centerPage-sex').text(info.sex == 0 ? '男' : '女').attr('data-sex', info.sex);
        centerPage.find('.js-qq').text(info.qq);
        centerPage.find('.js-tel').text(info.phone);
        $('body').attr('data-nickname', info.nickname).attr('data-cover', info.cover_thumb);
      };
    }

    function AppointmentPage(){
      var _appointmentPage = this,
          appoPage = $('#appointmentPage'),
          serviceLongSelect = appoPage.find('.appointment-service-long-select'),
          servicePeriodSelect = appoPage.find('.appointment-service-period-select'),
          servicePrice = appoPage.find('.appointment-service-price'),
          dateList = appoPage.find('.appointment-date-list'),
          periodList = appoPage.find('.appointment-period-list'),
          unit = '';

      _appointmentPage.initialAppointmentInfo = function(data){
        _appointmentPage.modifyAppointmentInfo(data, true);
      };

      _appointmentPage.modifyAppointmentInfo = function(data, initial){
        var timeSelect = periodSelect = dateListStr = periodListStr = '';

        unit = data.unit;

        appoPage.find('.appointment-time-unit').text(data.unit);

        $.each(data.can_select_long, function(index, time){
          timeSelect += '<option value="'+ time +'">'+ time +'</option>';
        });
        serviceLongSelect.html(timeSelect).val(data.selected_long);

        if(unit == '小时'){
          $.each(data.can_select_interval, function(index, period){
            periodSelect += '<option value="'+ period +'">'+ period +'</option>';
          });
          servicePeriodSelect.html(periodSelect).val(data.selected_interval);
        } else if(unit == '天'){
          servicePeriodSelect.closest('.appointment-model-field').remove();
        }

        servicePrice.text(data.price);

        $.each(data.day7from_now, function(index, day){
          dateListStr += '<div class="appointment-date-item '+ (day.date==data.selected_day ? 'selected' : '') + (day.ifBusiness == 0 ? ' disabled' : '') +'" data-ifBusiness="'+day.ifBusiness+'" data-date='+day.date+'><div>'+ day.week +'<span class="appointment-not-available">(不营业)</span></div><div>'+ _appointmentPage.formatDate(day.date+'') +'</div></div>';
        });
        dateList.html(dateListStr);

        $.each(data.appointment_info, function(index, period){
          periodListStr += '<div class="appointment-period-item '+(period.can_buy == 0 || period.expired == 1 ? 'disabled':'')+'" data-period='+period.interval+'><div>'+ period.interval +'</div><div class="appointment-not-available">'+ (period.expired == 1 ? '过期': '约满') +'</div></div>';
        });
        periodList.html(periodListStr);

      };

      _appointmentPage.formatDate = function(date){
        var month = date.substring(4, 6),
            day = date.substring(6);

        return month + '月' + day + '日';
      };

      _appointmentPage.changeAppointmentCondition = function(){
        var data = _appointmentPage.getAppointmentDetailParam();

        _appointmentPage.getAppointmentList(data);
      };

      _appointmentPage.getAppointmentDetailParam = function(){
        var param = {
              timelong: serviceLongSelect.val(),
              day: dateList.find('.appointment-date-item.selected').attr('data-date'),
              app_id: appId,
              goods_id: GetQueryString('detail'),
              sub_shop_app_id: GetQueryString('franchisee')
            };

        if(unit == '小时'){
          param.interval = servicePeriodSelect.val();
        }
        return param;
      };

      _appointmentPage.getAppointmentList = function(param){
        $ajax('/index.php?r=AppShop/getAppointmentList', 'get', param, 'json', function(data){
          if(data.status == 0){
            _appointmentPage.modifyAppointmentInfo(data, false);
          } else {
            alertTip(data.data);
          }
        });
      };

      _appointmentPage.sureMakeAppointment = function(){
        var selectPeriodItem = appoPage.find('.appointment-period-item.selected');

        if(!selectPeriodItem.length){
          alertTip('请选择具体时间');
          return;
        }
        var param = _appointmentPage.getAppointmentDetailParam();

        param.interval = selectPeriodItem.attr('data-period');
        param.model_id = 0;
        param.ck_id = GetCookiePara();
        param.num = 1;

        $ajax('/index.php?r=AppShop/addOrder', 'get', param, 'json', function(data){
          if (data.status !== 0) {
            if (data.status === 2) {
              alertTip('请先登录账号', function() {
                APP.showLogin();
              }, 700);
            } else {
              alertTip(data.data);
            }
            return;
          }
          APP.turnToPage({ router: 'orderDetail', detail: data.data });
        });
      };
    }



    function SearchPage(){
      var _searchPage = this;

      _searchPage.parseSearchPage = function(data){
        var hasQuickTags = data.hasQuickTags,
            quickTags = data.quickTags,
            searchItems = data.searchObject;

        if(hasQuickTags === true){
          var $html = '';
          for(var i=0,len=quickTags.length; i<len; i++){
              $html = $html + '<span>'+ quickTags[i] +'</span>'
          }
          $("#searchPage .tags").empty();
          $("#searchPage .tags").append($html);
          $("#searchPage .quick-tags").show();

          $("#searchPage .tags span").bind("click",function(){
              var keyword = $(this).html(),
                  $list = $('#searchPage .list-vessel-wrap').eq(0),
                  type = $list.data("type");
              $("#search").val(keyword);
              APP.search(keyword,$list,searchItems.customFeature.form,type);
          });

        }else{
          $("#searchPage .quick-tags").hide();
        }
        $('#searchPage .ele-container').eq(0).remove();
        //var searchDetail = APP.parseElement(searchItems);
        var searchDetail = $('.list-vessel-wrap[data-id="' + searchItems.customFeature.id + '"]').eq(0).parent(".ele-container").clone();
        $(searchDetail).hide();
        $("#searchPage").append(searchDetail);
        $('#searchPage .list-vessel-wrap').attr('data-id','');
        $("#searchPage").data("form",$('.list-vessel-wrap[data-id="' + searchItems.customFeature.id + '"]').eq(0).data("form"));
      }
    }

    // 城市组件
    function CitylocationPage(){
      var _CitylocationPage = this;

      _CitylocationPage.parseCitylocationPage = function(data){
        $('#CitylocationPage .location-province-select').html('<option>省</option>');
        $('#CitylocationPage .location-city-select').html('<option>城市</option>');
        $('#CitylocationPage .location-district-select').html('<option>区县</option>');
        getArea('.location-province-select', 0, '列表请求出错,请重试')
        $('#CitylocationPage .ele-container').eq(0).remove();
        var citylocationObject = data.citylocation,
            locationDetail = $('.list-vessel-wrap[data-id="' + citylocationObject.customFeature.id + '"]').eq(0).parent(".ele-container").clone();
        $(locationDetail).hide();
        $('#CitylocationPage').append(locationDetail).attr('data-form', data.citylocation.customFeature.form);
        $('#CitylocationPage .list-vessel-wrap').attr('data-id','');
        $("#CitylocationPage").data("form",$('.list-vessel-wrap[data-id="' + citylocationObject.customFeature.id + '"]').eq(0).data("form")).attr('data-type',citylocationObject.type);

      }
    }

    // 个人中心：系统通知 页面
    function MyMessagePage(){
      var _mymessagepage = this;
      var hasInit = false;

      _mymessagepage.parseMyMessagePage = function(data){
        _mymessagepage.initial();
        if(hasInit){
            return false;
        }
        hasInit = true;
        /*
            分支对象：
                data: 对应分支的数据
                html: 对新加载的数据解析出的html
                isMore: 是否拥有更多的新的数据
                currentPage: 当前已经加载到页数
                onload: 是否处在数据加载中， true加载中，false加载完毕
        */
        // 系统消息分支:
        var systemBranch = {
              data: data.data["5"].data,
              html: '',
              isMore: data.data["5"].is_more,
              currentPage: data.data["5"].current_page,
              onload: false,
              unreadCount: data.data["5"].unread_count
            };
        // 互动消息分支
        var interactBranch = {
              data: data.data["6"].data,
              html: '',
              isMore: data.data["6"].is_more,
              currentPage: data.data["6"].current_page,
              onload: false,
              unreadCount: data.data["6"].unread_count
            };

        // 解析数据：接受对应tab数据，返回插入对应ul的html
        var parseMessageData = function(data){
          var html = '';

          $.each(data, function(entryIndex, entry){
            switch(entry.type){
              // 系统通知消息
              case '1':
                  var content = entry.content && $.parseJSON(entry.content);
                  html += '<li class="message-item type-system" data-turnToPage="'
                          + entry.page_url + '" ><div class="message-title">'
                          + content.title + '</div><div class="message-time">'
                          + entry.add_time + '</div><img class="message-img" src="'
                          + ( content.pic || '' ) + '"><div class="message-content">'
                          + content.description + '</div></li>';
                  break;
              // 支付成功消息
              case '2':
                  var content = entry.content && $.parseJSON(entry.content);
                  html += '<li class="message-item type-pay"><div class="message-title">'
                          + '支付成功' + '</div><div class="message-time">'
                          + entry.add_time + '</div><div class="message-img"><span class="icon-message-pay"></span></div><div class="message-content"><div class="message-price"><span>支付金额：</span><span>'
                          + content.total_price + '</span></div><div class="message-orderNum"><span>订单号：</span><span>'
                          + content.order_id + '</span></div></div></li>';
                  break;
              // 表单提交成功消息
              case '3':
                  var content = entry.content && $.parseJSON(entry.content);
                  html += '<li class="message-item type-form" data-form="'
                          + content.form + '" data-form-id="'
                          + content.form_id + '" data-formData-id="'
                          + entry.sub_id + '" ><div class="message-title">'
                          + '表单提交成功' + '</div><div class="message-time">'
                          + entry.add_time + '</div><div class="message-img"><span class="icon-message-form"></span></div><div class="message-content">'
                          + content.form_name + '</div></li>';
                  break;
              // 评论消息
              case '4':
                  var content = entry.content;
                  html += '<li class="message-item type-comment" ><div class="message-title">'
                          + '评论消息' + '</div><div class="message-time">'
                          + entry.add_time + '</div><div class="message-img"><span class="icon-message-comment"></span></div><div class="message-content">'
                          + content + ' 回复了你的话题' + '</div></li>';
                  break;
              //  管理员通知
              case '8':
                  var content = entry.content;
                  html += '<li class="message-item type-Administrators" ><div class="message-title">'
                          + '管理员通知' + '</div><div class="message-time">'
                          + entry.add_time + '</div><div class="message-img"><span class="icon-notify"></span></div><div class="message-content">'
                          + content + '</div></li>';
                  break;
            }
          });
          return html;
        };
        // 获取数据
        var getMessageData = function(type, page){
          $.ajax({
            url: '/index.php?r=AppNotify/GetUserAppNotifyMsg',
            data: {
              "app_id": appId,
              "types": type,
              "page": page
            },
            type: 'get',
            dataType: 'json',
            success: function(data){
              if(data.status == 1) {
                alertTip(data.data);
                onload = false;
                return;
              }
              if(data.status == 2) {
                onload = false;
                return;
              }
              switch(type){
                case 5:
                    systemBranch.data = data.data[type].data;
                    systemBranch.html = systemBranch.data && parseMessageData(systemBranch.data);
                    $('#myMessage-system-message').append(systemBranch.html);
                    systemBranch.isMore = data.data[type].is_more;
                    systemBranch.currentPage = data.data[type].current_page;
                    systemBranch.onload = false;
                    break;
                case 6:
                    interactBranch.data = data.data[type].data;
                    interactBranch.html = interactBranch.data && parseMessageData(interactBranch.data);
                    $('#myMessage-interact-message').append(interactBranch.html);
                    interactBranch.isMore = data.data[type].is_more;
                    interactBranch.currentPage = data.data[type].current_page;
                    interactBranch.onload = false;
                    break;
              }
            }
          });
        }

        // 互动消息小红点
        interactBranch.unreadCount > 0 ? $('.myMessage-type-list .myMessage-type-item:eq(1)').addClass('has-noread') : $('.myMessage-type-list .myMessage-type-item:eq(1)').removeClass('has-noread');

        systemBranch.html = systemBranch.data && parseMessageData(systemBranch.data);
        interactBranch.html = interactBranch.data && parseMessageData(interactBranch.data);
        $('#myMessage-system-message').html(systemBranch.html);
        $('#myMessage-interact-message').html(interactBranch.html);

        // 绑定列表位置，加载数据
        // 系统消息分支
        $('#myMessage-system-message').on('scroll', function(){
          // 拥有更多消息 && 没有在加载中 && 据顶部高度为 1160（十个消息的高度）* 当前页数 - 712（六个消息的高度594加底部间距16）
          if (systemBranch.isMore && (!systemBranch.onload) && ($('#myMessage-system-message').scrollTop() >= (1160 * systemBranch.currentPage - 712))) {
            getMessageData(5, (systemBranch.currentPage + 1));
            systemBranch.onload = true;
          }
        });
        // 互动消息分支
        $('#myMessage-interact-message').on('scroll', function(){
          if (interactBranch.isMore && (!interactBranch.onload) && ($('#myMessage-interact-message').scrollTop() >= (1160 * interactBranch.currentPage - 712))) {
            getMessageData(6, (interactBranch.currentPage + 1));
            interactBranch.onload = true;
          }
        });
        // Tab切换
        $('.myMessage-type-list').on('click', '.myMessage-type-item', function(){
          var index = $(this).index();
          // 互动消息小红点
          if (index == 1) {
              interactBranch.unreadCount = 0;
          }
          $(this).addClass('active').siblings().removeClass('active');
          $('.myMessage-content-container .myMessage-content:eq(' + index + ')').addClass('active').siblings().removeClass('active');
        });
      }
      _mymessagepage.initial = function(){
        var _detail = GetQueryString('detail');
        if (!_detail) {
          $('.myMessage-detail-form').hide();
          $('.myMessage-top-nav, .myMessage-content-container').show();
          document.title = '系统通知';
        } else if(_detail == 'form') {
          $('.myMessage-top-nav, .myMessage-content-container').hide();
          $('.myMessage-detail-form').show();
          document.title = '表单消息';
        }
      }
    }

    // 社区首页页面
    function communityPage(){
      var _communitypage = this;

      _communitypage.initialSection =  function( data ){
        if(data.data.length == 0){
          _communitypage.clearData();
          return ;
        }
        var info = data.data[0];
        $("#communityPage").find('.communityPage-ul').empty();

        $("#communityPage").find('.communityPage-img').attr("src" , info.img );
        $("#communityPage").find('.communityPage-title').text( info.name );
        $("#communityPage").find('.communityPage-topic-num').text( info.article_count );
        $("#communityPage").find('.communityPage-comment-num').text( info.comment_count );

        _communitypage.setThemeColor( info.theme_color );

        _communitypage.getCategory();

        if(info.has_carousel == 1){
          _communitypage.getCarousel();
        }else{
          $("#communityPage-carousel").hide();
          if($("#communityPage-carousel").hasClass('slick-initialized')){
            $("#communityPage-carousel").slick('unslick')
          }
        }

        _communitypage.bindEvents();
      }

      // 清除数据
      _communitypage.clearData = function() {
        $("#communityPage").find('.communityPage-ul').empty();
        $("#communityPage-topic").empty();

        $("#communityPage").find('.communityPage-img').attr("src" , '' );
        $("#communityPage").find('.communityPage-title').text( '' );
        $("#communityPage").find('.communityPage-topic-num').text( 0 );
        $("#communityPage").find('.communityPage-comment-num').text( 0 );

        $("#communityPage-carousel").hide();
        if($("#communityPage-carousel").hasClass('slick-initialized')){
          $("#communityPage-carousel").slick('unslick')
        }
      }

      // 绑定事件
      var hasbind = false;
      _communitypage.bindEvents = function(){
        if(hasbind){  //假如绑定事件，直接返回
          return ;
        }
        hasbind = true;

        // 话题tab
        $("#communityPage-topic").on('click', 'a', function(event) {
          var _this = $(this);
              type = _this.attr("type");

          _this.addClass('active').siblings().removeClass('active');
          _communitypage.topicListData = {
            page : 1 ,
            loading : false,
            nomore : false
          }
          _communitypage.getTopicList();
        });

        // 话题列表点击进入详情
        $("#communityPage-ul").on('click', 'li.communityPage-li', function(event) {
            var _this = $(this);

            APP.turnToPage({ router: 'communityDetail' , detail: _this.attr("data-id") });
        }).on('click', '.communityPage-li-like', function(event) {
        // 点赞
          event.stopPropagation();

          var _this = $(this);
          OfficialPages['community-detail'].performLike( _this , {
            obj_type : 1 ,
            obj_id : _this.closest('li').attr("data-id")

          }, function() {
            var num = + _this.children('span').text(),
                $b = $('<b class="like-animate"></b>');

            if(_this.attr('is_liked') == 1){
              num -= 1 ;
              $b.text('-1');
              _this.children('i').addClass('icon-like').removeClass('icon-like-solid');
            }else{
              num += 1 ;
              $b.text('+1');
              _this.children('i').addClass('icon-like-solid').removeClass('icon-like');
            }
            _this.append($b).children('span').text( num );
            setTimeout(function(){
              $b.remove();
            }, 490);
          });

        }).on('click', '.communityPage-li-comment', function(event) {
        // 评论
          var _this = $(this);
          APP.turnToPage({ router: 'communityReply' , detail: _this.closest('li').attr("data-id") , section_id : GetQueryString('detail') });

          event.stopPropagation();
        });

        // 滚动加载
        var oldscrolltop = 0;
        $("#communityPage-scroll").on('scroll', function(event) {
          var _this = $(this),
              scrolltop = _this.scrollTop(),
              h = _this.height(),
              innerh= _this.children('.communityPage-list').height() + 340,
              _li = $('#communityPage-ul').children('li');

          if( innerh - h - scrolltop < 120 && _li.length > 0){ //判断li的长度是为了防止在返回的时候，清空数据时触发滚动事件
            _communitypage.getTopicList();
          }

          if(scrolltop - oldscrolltop > 60){
            $("#communityPage-publish-btn").addClass('bottom');
            oldscrolltop = scrolltop;
          }else if(oldscrolltop - scrolltop > 60){
            $("#communityPage-publish-btn").removeClass('bottom');
            oldscrolltop = scrolltop;
          }
        });
        $("#communityPage").on('click', '.communityPage-publish-btn', function(event) {
          APP.turnToPage({ router: 'communityPublish' });
        }).on('click', '.communityPage-topic-btn', function(event) {
          APP.turnToPage({ router: 'communityUsercenter' });
        }).on('click', '.communityPage-search-btn', function(event) {
          _communitypage.topicListData = {
            page : 1 ,
            loading : false,
            nomore : false
          }
          _communitypage.getTopicList();
        }).on('keydown', '#communityPage-search-input', function(event) {
          if(event.keyCode == 13){
            _communitypage.topicListData = {
              page : 1 ,
              loading : false,
              nomore : false
            }
            _communitypage.getTopicList();
            $(this).blur();
          }
        }).on('click', '.communityPage-notify-btn', function(event) {
          APP.turnToPage({ router: 'communityNotify' });
        });
      }

      // 获取话题列表 page--页数  section_id--版块的id
      _communitypage.topicListData = {
        page : 1 ,
        loading : false,  //是否正在加载
        nomore : false  //是否还有数据
      }
      _communitypage.getTopicList = function(jdata){
        if( _communitypage.topicListData.loading || _communitypage.topicListData.nomore ){
          return ;
        }
        _communitypage.topicListData.loading = true;

        var url = '/index.php?r=AppSNS/GetArticleByPage' ,
            param = {
              app_id: appId,
              page: _communitypage.topicListData.page ,
              section_id : GetQueryString('detail') ,
              category_id : $("#communityPage-topic").children('.active').attr("data-id") ,
              // orderby : 'id' ,
              article_id : '', // （如果传了这个话题id就能获取单条话题信息）
              top_flag : 0 , //如果为1 筛选置顶帖
              hot_flag: 0 , //如果为1 筛选精品贴
              start_date : '', // 查询开始日期
              end_date : '',  //查询结束日期
              search_value : $("#communityPage-search-input").val() , // 查询值
              page_size: 10
            },
            successfn = function(data){
              if(data.status == 0){
                var _li = '';
                $.each(data.data ,function(index, val) {
                  _li += _communitypage.topicParseTemplate(val);
                });

                if( _communitypage.topicListData.page == 1){
                    $("#communityPage").find('.communityPage-ul').empty();
                }
                data.is_more == 0 && (_li += '<li class="communityPage-li-nomore">没有更多了</li>');

                if(_communitypage.topicListData.page == 1 && data.data.length == 0){ //没有数据
                  _li = '<li class="communityPage-li-none"><img src="'+cdnUrl+'/static/webapp/images/none.png" alt="" /><p>还没话题，快来说两句</p></li>'
                }
                $("#communityPage").find('.communityPage-ul').append(_li);

                _communitypage.topicListData.page ++ ;
                _communitypage.topicListData.nomore = data.is_more == 1 ? false : true ;
              }else{
                alertTip(data.data);
              }
              _communitypage.topicListData.loading = false ;
            },
            errorfn = function(data){
              _communitypage.topicListData.loading = false ;
            };

        $ajax( url , 'get', param, 'json', successfn , errorfn);
      }
      _communitypage.TopicListTemplate = '<li class="communityPage-li" data-id="${id}"><div><div class="community-li-cover"><img src="${headimgurl}"></div>'
                +'<div class="community-li-author"><p class="community-li-name">${nickname}</p><p class="community-li-time">${add_time}</p></div>'
                +'${hot_flag}</div><p class="communityPage-li-title">${title}</p>${content_img}<div class="communityPage-li-content"><p>${content}</p></div>'
                +'<div class="communityPage-li-foot"><span class="communityPage-li-info communityPage-li-like" is_liked="${is_liked}">${like_icon}<span>${like_count}</span></span>'
                +'<span class="communityPage-li-info communityPage-li-comment"><i class="icon-reply"></i><span>${comment_count}</span></span></div></li>';
      _communitypage.topicParseTemplate = function(data){
        var html = _communitypage.TopicListTemplate.replace(/\$\{(\w+)\}/g, function($0, $1){
          switch($1){
            case 'title' : return unescape(data[$1].replace(/\\u/g, "%u"));
            case 'hot_flag' : return data[$1] == '1' ? '<span class="community-hot-wrap"><i class="community-hot icon-fire"></i>精品话题</span>' : '';
            // case 'content'  : return data[$1].text.replace(/\n/g , '<br>') ;
            case 'content'  : return _communitypage.showEllipsis( data[$1].text ) ;
            case 'content_img' : if(data.content.imgs){
                  var imgarr = data.content.imgs,
                      ul = '<ul class="communityPage-li-imgul">';
                  if(imgarr.length == 1){
                      ul += '<li class="communityPage-li-imgli communityPage-li-imgli-one"><img src="'+ imgarr[0] +'" alt="" /></li>';
                  }else{
                      for (var i = 0; i < imgarr.length; i++) {
                          ul += '<li class="communityPage-li-imgli"><img src="'+ imgarr[i] +'" alt="" onload="photovoteLoad(this)" /></li>';
                      }
                  }
                  ul += '</ul>';

                  return ul;
                }else{
                  return '';
                }
            case 'like_icon' : return data.is_liked == 1 ? '<i class="icon-like-solid"></i>' : '<i class="icon-like"></i>';
            default :   return data[$1];
          }
        });
        return html;
      }
      _communitypage.showEllipsis = function(oldtext) {
        var newtext = '',
            newtextarr = [],
            textarr = oldtext.split(/\n|\\n/),
            eachline = 290 / 12 * 2,
            total_line_num = 5,
            has_line_num = 0,
            isellipsis = false;

        for (var i = 0; i < textarr.length; i++) {
          var len = stringLength( textarr[i] ),
              lenline = Math.ceil(len /  eachline);

          if( has_line_num + lenline >= total_line_num ){
            var spare_line = total_line_num - has_line_num;
            newtextarr.push( subString( textarr[i] , (spare_line*eachline - 14) ) );
            isellipsis = true;
            break ;
          }else{
            has_line_num += lenline;
            newtextarr.push( textarr[i] );
          }
        }
        if(isellipsis){
          newtext = newtextarr.join('<br />') + '...<a class="ellipsis-a" href="javascript:;">全文</a>';
        }else{
          newtext = oldtext.replace(/\n|\\n/g , '<br>');
        }

        return newtext;
      }

      // 获取分类
      _communitypage.getCategory = function(){
        var url = '/index.php?r=AppSNS/GetCategoryByPage' ,
            param = {
              app_id: appId,
              page: 1 ,
              section_id : GetQueryString('detail') ,
              page_size: 100
            },
            successfn = function(data){
              if(data.status == 0){
                var _a = '<a class="active">全部</a>';
                $.each(data.data ,function(index, val) {
                  _a += '<a data-id="'+val.id+'">'+val.name+'</a>';
                });

                $("#communityPage-topic").html(_a);

                _communitypage.topicListData = {
                    page : 1 ,
                    loading : false,
                    nomore : false
                }
                _communitypage.getTopicList();

              }else{
                alertTip(data.data);
              }
            },
            errorfn = function(data){
            };

        $ajax( url , 'get', param, 'json', successfn , errorfn);
      }

      _communitypage.getCarousel = function(){
        var url = '/index.php?r=AppSNS/GetArticleByPage' ,
            param = {
              app_id: appId,
              page: 1 ,
              section_id : GetQueryString('detail') ,
              is_carousel : 1 ,
              orderby : 'id' ,
              page_size: 10
            },
            successfn = function(data){
              if(data.status == 0){
                var _div = '';
                $.each( data.data , function(index, val) {
                    _div += '<div><img class="router js-to-detail" data-router="communityDetail" data-id="'+val.id+'" src="'+val.carousel_img+'" alt="" /></div>';
                });
                if($("#communityPage-carousel").hasClass('slick-initialized')){
                    $("#communityPage-carousel").slick('unslick');
                }

                if(data.data.length == 0){
                    $("#communityPage-carousel").hide();
                }else{
                    $("#communityPage-carousel").html(_div).show().slick({
                        arrows: false,
                        autoplay:  true ,
                        autoplaySpeed: 5000,
                        dots: true,
                        mobileFirst: true,
                        speed: 500,
                        swipeToSlide: true
                    });
                }
              }else{
                alertTip(data.data);
              }
            },
            errorfn = function(data){
            };

        $ajax( url , 'get', param, 'json', successfn , errorfn);
      }

      _communitypage.getThemeColor = function(section_id) {
        var url = '/index.php?r=AppSNS/GetSectionByPage' ,
            param = {
              app_id: appId,
              page: 1 ,
              section_id : section_id
            },
            successfn = function(data){
              if(data.status == 0){
                var info = data.data[0];
                _communitypage.setThemeColor( info.theme_color );
              }
            },
            errorfn = function(data){
            };

        $ajax( url , 'get', param, 'json', successfn , errorfn);
      }
      _communitypage.setThemeColor = function(color) {
        $("#cmn-theme-style").remove();
        $("#communityPage").before('<style rel="stylesheet" id="cmn-theme-style">.cmn-theme-color{color:'+color+' !important;} .cmn-theme-color-active > .active{color: '+color+' !important;border-bottom: 1px solid '+color+' !important;}.cmn-theme-bgcolor{background-color:'+color+' !important;}</style>');
      }
    }


    // 社区详情页面
    function communityDetail() {
      var _communitydetail = this;

      // 初始化社区详情
      _communitydetail.initialDetail = function(data) {
        $("#communityDetail-scroll").scrollTop(0);
        $("#communityDetail").find('.communityDetail-ul').empty();

        var info = data.data[0],
            content = info.content;

        $("#communityDetail").attr("section_id" , info.section_id );
        $("#communityDetail").find('.communityDetail-head').attr("src" , info.headimgurl );
        $("#communityDetail").find('.communityDetail-name').text( info.nickname );
        $("#communityDetail").find('.communityDetail-time-time').text( info.add_time );
        $("#communityDetail").find('.communityDetail-popularity').text( +info.comment_count + (+info.like_count) );
        $("#communityDetail").find('.communityDetail-title').text( unescape(info.title.replace(/\\u/g, "%u")) );
        $("#communityDetail").find('.communityDetail-likebtn2').attr( 'is_liked', info.is_liked );
        if(info.is_liked == 1){
          $("#communityDetail").find('.communityDetail-likebtn2').addClass('icon-like-solid').removeClass('icon-like');
        }else{
          $("#communityDetail").find('.communityDetail-likebtn2').addClass('icon-like').removeClass('icon-like-solid');
        }
        $("#communityDetail").find('.community-hot-wrap').remove();
        if(info.hot_flag == '1'){
          $("#communityDetail").find('.communityDetail-author-p1').append('<label class="community-hot-wrap"><i class="community-hot icon-fire"></i>精品话题</label>');
        }
        $("#communityDetail").find('.communityDetail-content').html(content.text.replace(/\n/g , '<br>'));
        var imgli = '',
            imgarr = content.imgs || [];

        if(imgarr.length == 1){
          imgli += '<li class="communityDetail-imgli communityDetail-imgli-one"><img src="'+ imgarr[0] +'" alt="" /></li>';
        }else{
          for (var i = 0; i < imgarr.length; i++) {
            imgli += '<li class="communityDetail-imgli"><img src="'+ imgarr[i] +'" alt="" onload="photovoteLoad(this)" /></li>';
          }
        }
        $("#communityDetail").find('.communityDetail-img').html(imgli);

        OfficialPages['community-page'].getThemeColor( info.section_id );
        _communitydetail.topicData = {
          page : 1 ,
          loading : false,
          nomore : false
        }
        _communitydetail.getTopicComment();
        _communitydetail.getLikeLog({
          page : 1 ,
          obj_type : 1 ,
          obj_id : info.id
        });
        _communitydetail.bindEvents();
      }

      // 绑定事件
      var hasbind = false;
      _communitydetail.bindEvents = function() {
        if(hasbind){  //假如绑定事件，直接返回
          return ;
        }
        hasbind = true;

        var oldscrolltop = 0;
        $("#communityDetail-scroll").on('scroll', function(event) {
          // 滚动事件
          var _this = $(this),
              scrolltop = _this.scrollTop(),
              h = _this.height(),
              innerh= _this.children('.communityDetail-list').height() + 370;

          if( innerh - h - scrolltop < 120 ){
            _communitydetail.getTopicComment();
          }
          if(scrolltop - oldscrolltop > 60){
            $("#communityDetail-publish-btn").addClass('bottom');
            oldscrolltop = scrolltop;
          }else if(oldscrolltop - scrolltop > 60){
            $("#communityDetail-publish-btn").removeClass('bottom');
            oldscrolltop = scrolltop;
          }
        });
        $("#communityDetail").on('click', '.communityDetail-likebtn', function(event) {
          $("#communityDetail").find('.communityDetail-likebtn2').trigger('click');

        }).on('click', '.communityDetail-likebtn2', function(event) {
        // 给话题点赞，取消点赞
          var _this = $(this);
          _communitydetail.performLike( _this , {
              obj_type : 1 ,
              obj_id : GetQueryString('detail')
          } , function() {
              _communitydetail.getLikeLog({
                  page : 1 ,
                  obj_type : 1 ,
                  obj_id : GetQueryString('detail')
              });
              if(_this.attr('is_liked') == 1){
                  $("#communityDetail").find('.communityDetail-likebtn2').addClass('icon-like').removeClass('icon-like-solid');
              }else{
                  $("#communityDetail").find('.communityDetail-likebtn2').addClass('icon-like-solid').removeClass('icon-like');
              }

          });
        }).on('click', '.communityDetail-btn', function(event) {
        // 回复话题
          APP.turnToPage({ router: 'communityReply' , section_id : $("#communityDetail").attr("section_id") });

        }).on('click', '.communityDetail-item-like', function(event) {
        // 评论点赞，取消点赞
          var _this = $(this);
          _communitydetail.performLike( _this , {
            obj_type : 2 ,
            obj_id : _this.closest('li').attr("data-id")
          }, function(){
            var num = + _this.attr('data-likecount'),
                text = '',
                $b = $('<b class="like-animate"></b>');
            if(_this.attr('is_liked') == 1){
              num -= 1 ;
              $b.text("-1");
               _this.children('i').addClass('icon-like').removeClass('icon-like-solid');
            }else{
              num += 1 ;
              $b.text("+1");
               _this.children('i').addClass('icon-like-solid').removeClass('icon-like');
            }
            text = num <= 0 ? '赞' : (num > 10000 ? (Math.floor( num / 10000)+'万') : num);
            _this.attr('data-likecount' , num).append($b).children('span').text(text );
            setTimeout(function(){
              $b.remove();
            }, 490);
          });
        }).on('click', '.communityDetail-item-reply', function(event) {
          APP.turnToPage({
            router: 'communityReply' ,
            section_id : $("#communityDetail").attr("section_id") ,
            comment_id : $(this).closest('li').attr("data-id")
          });
        }).on('click', '.communityDetail-publish-btn', function(event) {
          var section_id = $("#communityDetail").attr("section_id");
          APP.turnToPage({ router: 'communityPublish' , detail: section_id });
        }).on('click', '.communityDetail-imgli', function(event) {
          var thisSrc = $(this).children('img').attr("src"),
              pswpElement = $("#communityDetail-pswp")[0],
              options = {
                history: false,
                // focus: false,
                index: 0 // start at first slide
              },
              items = [],
              imgArr = [];

          $.each( $("#communityDetail").find('.communityDetail-img').children('li') , function(index, el) {
            var imgsrc = $(el).children('img').attr("src"),
                image = new Image();
            image.src = imgsrc;

            imgArr.push(imgsrc);
            items.push({
              src: imgsrc,
              w: image.width || 320,
              h: image.height || 320
            });
          });

          var index = imgArr.indexOf(thisSrc);
          if(index < 0){
            index = 0;
          }
          options.index = index;

          var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
          gallery.init();

        });
      }
      // 获取评论
      _communitydetail.topicData = {
        page : 1 ,
        loading : false,  //是否正在加载
        nomore : false  //是否还有数据
      }
      _communitydetail.getTopicComment = function( ){
        if( _communitydetail.topicData.loading || _communitydetail.topicData.nomore){
          return ;
        }
        _communitydetail.topicData.loading = true;

        var url = '/index.php?r=AppSNS/GetCommentByPage' ,
            param = {
              app_id: appId,
              page:  _communitydetail.topicData.page ,
              article_id : GetQueryString('detail') ,
              page_size : 10
            },
            successfn = function(data){
              if(data.status == 0){
                $("#communityDetail").find('.communityDetail-all-post').text('全部跟帖（'+data.count+'）');

                var _li = '';
                $.each(data.data ,function(index, val) {
                  var content = val.content,
                      floor = (data.current_page - 1) * param.page_size + index + 1,
                      replyto = '',
                      likecount = val.like_count;

                  content.reply_to && (replyto = '<a class="communityDetail-replyto">@'+content.reply_to.nickname+'</a>');

                  likecount = likecount <= 0 ? '赞' : (likecount > 10000 ? (Math.floor( likecount / 10000)+'万') : likecount);

                  _li += '<li class="communityDetail-item" data-id="'+val.id+'"><div><div class="community-li-cover"><img src="'+content.headimgurl+'"></div>'
                        +'<div class="community-li-author"><p class="community-li-name">'+content.nickname+'</p><p class="community-li-time">'+content.add_time+'</p></div>'
                        +'<div class="communityDetail-item-right-top"><span class="communityDetail-item-reply tail-info"><i class="icon-reply"></i>回复</span>'
                        +'<span class="communityDetail-item-like tail-info" data-likecount="'+val.like_count+'" is_liked="'+val.is_liked+'"><i class="'+( val.is_liked == 1 ? 'icon-like-solid' : 'icon-like')+'"></i><span>'+likecount+'</span></span></div></div>'
                        +'<div class="communityDetail-floor">'+floor+'楼</div>'
                        +'<div class="communityDetail-item-content"><p>'+ replyto +(content.text.replace(/\n/g , '<br />'))+'</p></div></li>';
                });

                if( _communitydetail.topicData.page == 1){
                  $("#communityDetail").find('.communityDetail-ul').empty();
                }
                data.is_more == 0 && (_li += '<li class="communityDetail-li-nomore">没有更多了</li>');
                if(_communitydetail.topicData.page == 1 && data.data.length == 0){ //没有数据
                  _li = '<li class="communityDetail-li-none"><img src="'+cdnUrl+'/static/webapp/images/none.png" alt="" /><p>快来抢沙发</p></li>'
                }
                $("#communityDetail").find('.communityDetail-ul').append(_li);

                _communitydetail.topicData.page ++ ;
                _communitydetail.topicData.nomore = data.is_more == 1 ? false : true ;
              }else{
                alertTip(data.data);
              }
              _communitydetail.topicData.loading = false ;
            },
            errorfn = function(data){
              _communitydetail.topicData.loading = false ;
            };

        $ajax( url , 'get', param, 'json', successfn , errorfn);
      }
      // 话题、评论 点赞
      // ele--点赞按钮  data--数据{obj_type : '', obj_id: ''}
      // obj_type 1-话题 2-评论   \  obj_id 话题或评论的id
      _communitydetail.performLike = function(ele , data , sucfn) {
        if(ele.hasClass('loading')){
          return ;
        }
        ele.addClass('loading');

        var url = '/index.php?r=AppSNS/PerformLike' ,
            param = {
              app_id: appId,
              obj_type : data.obj_type ,
              obj_id : data.obj_id
            },
            successfn = function(data){
              if(data.status == 0){
                sucfn && sucfn();
                if(ele.attr('is_liked') == 1){
                  alertTip('取消点赞成功');
                  ele.attr('is_liked' , 0);
                }else{
                  ele.attr('is_liked' , 1);
                  alertTip('点赞成功');
                }
              }else if (data.status === 2){
                alertTip('请先登录账号', function() {
                  APP.showLogin();
                }, 700);
              }else{
                alertTip(data.data);
              }
              ele.removeClass('loading');
            },
            errorfn = function(data){
              ele.removeClass('loading');
            };

        $ajax( url , 'get', param, 'json', successfn , errorfn);
      }
      // 获取点赞的记录
      _communitydetail.getLikeLog =  function( data ) {
        var url = '/index.php?r=AppSNS/GetLikeLogByPage' ,
            param = {
              app_id: appId,
              page:  data.page || 1 ,
              obj_type : data.obj_type || 1 ,
              obj_id : data.obj_id ,
              page_size : 10
            },
            successfn = function(data){
              if(data.status == 0){
                $("#communityDetail").find('.communityDetail-like-count').text(data.count + '人赞了');
                $("#communityDetail").find('.communityDetail-likebtn-likecount').text(data.count);
                var _li = '';
                $.each(data.data ,function(index, val) {
                    _li += '<li class="communityDetail-like-li"><img src="'+val.headimgurl+'"></li>';
                });
                $("#communityDetail").find('.communityDetail-like-ul').html(_li);

              }else{
                alertTip(data.data);
              }
            },
            errorfn = function(data){
            };

        $ajax( url , 'get', param, 'json', successfn , errorfn);
      }
    }


    // 社区个人中心--我的话题和回帖
    function communityUsercenter() {
      var _communityusercenter = this;

      // 初始化
      _communityusercenter.initialUsercenter = function( data ){
        $("#communityUsercenter").find('.communityUsercenter-mytopic-count').text(data.count);

        $("#communityUsercenter").find('.communityUsercenter-mytopic-ul').empty();
        _communityusercenter.modfiyMyTopic(data);

        _communityusercenter.myTopicData.page = 2;
        _communityusercenter.myTopicData.loading = false;
        _communityusercenter.myTopicData.nomore = data.is_more == 1 ? false : true ;

        OfficialPages['community-page'].getThemeColor( GetQueryString('detail') );

        _communityusercenter.bindEvents();

        _communityusercenter.myCommentData = {
          page : 1 ,
          loading : false,
          nomore : false
        }
        _communityusercenter.getMyComment();
      }

      // 绑定事件
      var hasbind = false;
      _communityusercenter.bindEvents = function(){
        if( hasbind ){
          return ;
        }
        hasbind = true;

        $("#communityUsercenter-content > section").on('scroll', function(event) {
          var _this = $(this),
              scrolltop = _this.scrollTop(),
              h = _this.height(),
              innerh= _this.children('ul').height(),
              type = _this.attr("type");

          if( innerh - h - scrolltop < 120 ){
            if(type == 'publish'){
              _communityusercenter.getMyTopic();
            }else if( type == 'reply' ){
              _communityusercenter.getMyComment();
            }
          }
        }).on('click', '.communityUsercenter-myli-main', function(event) {
          APP.turnToPage({ router: 'communityDetail' , detail: $(this).closest('li').attr("data-id") });
        }).on('click', '.communityUsercenter-reply-li-post', function(event) {
          APP.turnToPage({ router: 'communityDetail' , detail: $(this).attr("data-articleid") });
        }).on('click', '.communityUsercenter-more-icon', function(event) {
          // 显示更多选项
          $(this).parent().children('.communityUsercenter-myli-more').toggleClass('show');

        }).on('click', '.communityUsercenter-edit', function(event) {
          // 话题编辑
          APP.turnToPage({ router: 'communityPublish' , articleId: $(this).closest('li').attr("data-id") });
          $(this).parent().removeClass('show');

        }).on('click', '.communityUsercenter-delete', function(event) {
          // 话题删除
          var _this = $(this),
              _li = _this.closest('li');
          var confirmCallback = function() {
            var url = '/index.php?r=AppSNS/DeleteArticle' ,
            param = {
              app_id: appId,
              article_id : _li.attr("data-id"),
              section_id : GetQueryString('detail')
            },
            successfn = function(data){
              if(data.status == 0){

                _li.remove();
                $("#communityUsercenter").find('.communityUsercenter-mytopic-count').text(function(arguments) {
                  return +$(this).text() - 1;
                });

              }else{
                alertTip(data.data);
              }
              
            },
            errorfn = function(data){
                
            };

            $ajax( url , 'get', param, 'json', successfn , errorfn);
          }
          confirmTip({content : '是否删除这个话题？'}, confirmCallback);
        }).on('click', '.communityUsercenter-reply-delete', function(event) {
          // 回复删除
          var _this = $(this),
              _li = _this.closest('li');
          var confirmCallback = function() {
            var url = '/index.php?r=AppSNS/DeleteComment' ,
            param = {
              app_id: appId,
              article_id : _li.attr("data-articleid"),
              section_id : GetQueryString('detail'),
              comment_id : _li.attr("data-id") // 评论id
            },
            successfn = function(data){
              if(data.status == 0){

                _li.remove();
                $("#communityUsercenter").find('.communityUsercenter-myreply-count').text(function(arguments) {
                  return +$(this).text() - 1;
                });

              }else{
                alertTip(data.data);
              }
              
            },
            errorfn = function(data){
                
            };

            $ajax( url , 'get', param, 'json', successfn , errorfn);
          }
          confirmTip({content : '是否删除这个评论？'}, confirmCallback);
        });

        $("#communityUsercenter").on('click' , '.communityUsercenter-tab > a' , function(){
          var _this = $(this),
              type  = _this.attr("type");

          _this.addClass('active').siblings().removeClass('active');
          $("#communityUsercenter-content").children('section[type="'+type+'"]').addClass('active').siblings().removeClass('active');
        }).on('click', '.communityUsercenter-back', function(event) {
          window.history.go(-1);
        });
      }

      _communityusercenter.myTopicData = {
        page : 1 ,
        loading : false,  //是否正在加载
        nomore : false  //是否还有数据
      }
      // 获取我的话题列表
      _communityusercenter.getMyTopic = function(data){
        var jdata = _communityusercenter.myTopicData;
        if( jdata.loading || jdata.nomore ){
          return ;
        }
        jdata.loading = true;

        var url = '/index.php?r=AppSNS/GetArticleByPage' ,
            param = {
              app_id: appId,
              page: jdata.page ,
              section_id : GetQueryString('detail') ,
              only_own_record : 1
            },
            successfn = function(data){
              if(data.status == 0){

                _communityusercenter.modfiyMyTopic(data);

                jdata.page ++ ;
                jdata.nomore = data.is_more == 1 ? false : true ;
              }else{
                alertTip(data.data);
              }
              jdata.loading = false ;
            },
            errorfn = function(data){
                jdata.loading = false ;
            };

        $ajax( url , 'get', param, 'json', successfn , errorfn);
      }
      _communityusercenter.myTopicListTpl = '<li class="communityUsercenter-li communityUsercenter-myli" data-id="${id}"><div><div class="community-li-cover"><img src="${headimgurl}"></div>'
                +'<div class="community-li-author"><p class="community-li-name">${nickname}</p><p class="community-li-time">${add_time}</p></div>${hot_flag}</div>'
                +'<div class="communityUsercenter-myli-main"><p class="communityUsercenter-myli-title">${title}</p><p class="communityUsercenter-myli-content">${content}</p>${content_img}</div>'
                +'<div class="communityUsercenter-myli-foot"><span class="communityUsercenter-myli-info"><i class="communityUsercenter-more-icon icon-more"></i><span class="communityUsercenter-myli-more"><span class="communityUsercenter-edit">编辑</span>'
                +'<em class="communityUsercenter-line"></em><span class="communityUsercenter-delete">删除</span></span></span>'
                +'<span class="communityUsercenter-myli-info"><i class="icon-like"></i>${like_count}</span><span class="communityUsercenter-myli-info"><i class="icon-reply"></i>${comment_count}</span></div></li>';
      _communityusercenter.myTopicParseTpl = function(data){
        var html = _communityusercenter.myTopicListTpl.replace(/\$\{(\w+)\}/g, function($0, $1){
          switch($1){
            case 'hot_flag' : return data[$1] == '1' ? '<label class="communityUsercenter-myli-label">精品</label>' : '';
            case 'content'  : return data[$1].text.replace(/\n|\\n/g , '<br>') ;
            case 'content_img' : if(data.content.imgs){
                  var imgarr = data.content.imgs,
                      ul = '<ul>';
                  if(imgarr.length == 1){
                      ul += '<li class="communityUsercenter-imgli communityUsercenter-imgli-one"><img src="'+ imgarr[0] +'" alt="" /></li>';
                  }else{
                      for (var i = 0; i < imgarr.length; i++) {
                          ul += '<li class="communityUsercenter-imgli"><img src="'+ imgarr[i] +'" alt="" onload="photovoteLoad(this)" /></li>';
                      }
                  }
                  ul += '</ul>';

                  return ul;
                }else{
                  return '';
                }
            default :   return data[$1];
          }
        });
        return html;
      }
      _communityusercenter.modfiyMyTopic = function(data){
        var _li = '';
        $.each(data.data ,function(index, val) {
          _li += _communityusercenter.myTopicParseTpl(val);
        });

        data.is_more == 0 && (_li += '<li class="communityUsercenter-li-none">没有更多了</li>');

        $("#communityUsercenter").find('.communityUsercenter-mytopic-ul').append(_li);
      }

      _communityusercenter.myCommentData = {
        page : 1 ,
        loading : false,  //是否正在加载
        nomore : false  //是否还有数据
      }
      // 获取我的评论
      _communityusercenter.getMyComment = function(){
        var jdata = _communityusercenter.myCommentData;
        if( jdata.loading || jdata.nomore ){
          return ;
        }
        jdata.loading = true;

        var url = '/index.php?r=AppSNS/GetCommentByPage' ,
            param = {
              app_id: appId,
              page: jdata.page ,
              section_id : GetQueryString('detail') ,
              only_own_record : 1
            },
            successfn = function(data){
              if(data.status == 0){
                var _li = '';
                $.each(data.data ,function(index, val) {
                  _li += _communityusercenter.myReplyParseTpl(val);
                });

                if( jdata.page == 1){
                  $("#communityUsercenter").find('.communityUsercenter-myreply-count').text(data.count);
                  $("#communityUsercenter").find('.communityUsercenter-myreply-ul').empty();
                }
                data.is_more == 0 && (_li += '<li class="communityUsercenter-li-none">没有更多了</li>');

                $("#communityUsercenter").find('.communityUsercenter-myreply-ul').append(_li);

                jdata.page ++ ;
                jdata.nomore = data.is_more == 1 ? false : true ;
              }else{
                alertTip(data.data);
              }
              jdata.loading = false ;
            },
            errorfn = function(data){
              jdata.loading = false ;
            };

        $ajax( url , 'get', param, 'json', successfn , errorfn);
      }
      _communityusercenter.myReplyTpl = '<li class="communityUsercenter-li" data-id="${id}" data-articleid="${obj_id}"><div><div class="community-li-cover"><img src="${headimgurl}"></div>'
                +'<div class="community-li-author"><p class="community-li-name">${nickname}</p><p class="community-li-time">${add_time}</p></div></div>'
                +'<div class="communityUsercenter-reply-li-content">${content}</div>'
                +'<div class="communityUsercenter-reply-li-post" data-articleid="${articleid}">${article_cover}<div>${article_title}</div></div>'
                +'<div class="communityUsercenter-myli-foot"><span class="communityUsercenter-myli-info communityUsercenter-reply-delete"><i class="icon-delete"></i></span></div></li>';
      _communityusercenter.myReplyParseTpl = function(data){
        var html = _communityusercenter.myReplyTpl.replace(/\$\{(\w+)\}/g, function($0, $1){
          switch($1){
            case 'content' :
                if( data.comment_id != 0 && !!data.comment_id ){
                    return '<a class="communityUsercenter-replyto" href="javascript:;">@'+data.content.reply_to.nickname+'</a>' + data[$1].text.replace(/\n|\\n/g , '<br>') ;
                }else{
                    return data[$1].text.replace(/\n|\\n/g , '<br>') ;
                }
            case 'article_cover' :
                var imgarr = data.obj.content.imgs;
                if(imgarr){
                    return '<img src="'+imgarr[0]+'" alt="" />'
                }else{
                    return '';
                }
            case 'article_title' : return unescape( data.obj.title.replace(/\\u/g, "%u") ) ;
            case 'articleid' : return data.obj.id ;
            default :   return data[$1];
          }
        });
        return html;
      }
    }

    // 社区发布话题
    function communityPublish(){
      var _communitypublish = this;

      _communitypublish.initialPublish = function(data) {
        var c = '<option value="0">全部</option>';

        $.each( data.data , function(index, val) {
          c += '<option value="'+val.id+'">'+val.name+'</option>';
        });

        $("#communityPublish-classify").html(c);

        OfficialPages['community-page'].getThemeColor( GetQueryString('detail') );

        $('#communityPublish-title-input').val('');
        $("#communityPublish-content-input").val('');
        $("#communityPublish-ul").children('li.communityPublish-item').remove();
        $("#communityPublish-classify").val(0);

        var article_id = GetQueryString('articleId');
        if(article_id){
           _communitypublish.getTopic( article_id );
        }
      }

      _communitypublish.getTopic = function( article_id ) {
        var url = '/index.php?r=AppSNS/GetArticleByPage' ,
            param = {
              app_id: appId,
              article_id: article_id
            },
            successfn = function(data){
              if(data.status == 0){
                var data = data.data[0];
                var imgli = '';

                $("#communityPublish-title-input").val(data.title);
                $("#communityPublish-classify").val(data.category_id);
                $("#communityPublish-content-input").val(data.content.text);

                if(data.content.imgs){
                  $.each(data.content.imgs , function(index, val) {
                    imgli += '<li class="communityPublish-item"><img src="'+val+'"><span class="communityPublish-item-delete">×</span></li>';
                  });
                  $("#communityPublish-ul").prepend(imgli);
                }

              }else{
                alertTip(data.data);
              };
            },
            errorfn = function(data){
            };

        $ajax( url , 'get', param, 'json', successfn , errorfn);
      }
    }

    function communityNotify() {
      var _communitynotify = this;

      _communitynotify.initialNotify = function(data) {
        $("#communityNotify-content").find('.communityNotify-like-ul').empty();
        _communitynotify.modfiyLike(data);

        _communitynotify.likeData.page = 2;
        _communitynotify.likeData.loading = false;
        _communitynotify.likeData.nomore = data.is_more == 1 ? false : true ;

        OfficialPages['community-page'].getThemeColor( GetQueryString('detail') );

        _communitynotify.commentData = {
          page : 1 ,
          loading : false,
          nomore : false
        }
        _communitynotify.getReceiverComment();

        _communitynotify.bindEvents();
      }

      // 绑定事件
      var hasbind = false;
      _communitynotify.bindEvents = function(){
        if( hasbind ){
          return ;
        }
        hasbind = true;

        $("#communityNotify-content > section").on('scroll', function(event) {
          var _this = $(this),
              scrolltop = _this.scrollTop(),
              h = _this.height(),
              innerh= _this.children('ul').height(),
              type = _this.attr("type");

          if( innerh - h - scrolltop < 120 ){
            if(type == 'like'){
              _communitynotify.getLikeLog();
            }else if( type == 'comment' ){
              _communitynotify.getReceiverComment();
            }
          }
        }).on('click', '.communityNotify-li-post', function(event) {
          APP.turnToPage({ router: 'communityDetail' , detail: $(this).attr("data-articleid") });
        });
      }

      _communitynotify.likeData = {
        page : 1 ,
        loading : false,  //是否正在加载
        nomore : false  //是否还有数据
      }
      // 获取别人点赞我的列表
      _communitynotify.getLikeLog = function(data){
        var jdata = _communitynotify.likeData;
        if( jdata.loading || jdata.nomore ){
          return ;
        }
        jdata.loading = true;

        var url = '/index.php?r=AppSNS/GetLikeLogByPage' ,
            param = {
              app_id: appId,
              page: jdata.page ,
              section_id : GetQueryString('detail') ,
              only_receiver_record : 1
            },
            successfn = function(data){
              if(data.status == 0){

                _communitynotify.modfiyLike(data);

                jdata.page ++ ;
                jdata.nomore = data.is_more == 1 ? false : true ;
              }else{
                alertTip(data.data);
              }
              jdata.loading = false ;
            },
            errorfn = function(data){
                jdata.loading = false ;
            };

        $ajax( url , 'get', param, 'json', successfn , errorfn);
      }
      _communitynotify.likeTpl = '<li class="communityNotify-li" data-id="${id}"><div><div class="community-li-cover"><img src="${headimgurl}"></div>'
                +'<div class="community-li-author"><p class="community-li-name">${nickname}</p><p class="community-li-time">${add_time}</p></div></div>'
                +'<div class="communityNotify-li-content">${content}</div>'
                +'<div class="communityNotify-li-post" data-articleid="${articleid}">${article_cover}<div class="communityNotify-li-post-text" >${article_title}</div></div></li>';
      _communitynotify.likeParseTpl = function(data){
        var html = _communitynotify.likeTpl.replace(/\$\{(\w+)\}/g, function($0, $1){
          switch($1){
            case 'content' :
                if( data.type == 1 ){
                  return '赞了你的话题';
                }else if( data.type == 2 ){
                  return '赞了你的评论';
                }else{
                  return '';
                }
            case 'article_cover' :
                if( data.type == 1){
                  var imgarr = data.obj.content.imgs;
                  if(imgarr){
                      return '<img src="'+imgarr[0]+'" alt="" />'
                  }else{
                      return '';
                  }
                }else{
                  return '';
                }
            case 'article_title' :
                if( data.type == 1 ){
                  return unescape( data.obj.title.replace(/\\u/g, "%u") );
                }else if( data.type == 2 ){
                  return data.obj.content.text.replace(/\n|\\n/g , '<br>');
                }else{
                  return '';
                } ;
            case 'articleid' :
                if( data.type == 1 ){
                  return data.obj_id;
                }else if( data.type == 2 ){
                  return data.obj.obj_id;
                }else{
                  return '';
                } ;
            default : return data[$1];
          }
        });
        return html;
      }
      _communitynotify.modfiyLike = function(data){
        var _li = '';
        $.each(data.data ,function(index, val) {
          _li += _communitynotify.likeParseTpl(val);
        });

        data.is_more == 0 && (_li += '<li class="communityNotify-li-none">没有更多了</li>');

       $("#communityNotify-content").find('.communityNotify-like-ul').append(_li);
      }

      _communitynotify.commentData = {
        page : 1 ,
        loading : false,  //是否正在加载
        nomore : false  //是否还有数据
      }
      // 获取别人评论我的评论
      _communitynotify.getReceiverComment = function(){
        var jdata = _communitynotify.commentData;
        if( jdata.loading || jdata.nomore ){
          return ;
        }
        jdata.loading = true;

        var url = '/index.php?r=AppSNS/GetCommentByPage' ,
            param = {
              app_id: appId,
              page: jdata.page ,
              section_id : GetQueryString('detail') ,
              only_receiver_record : 1
            },
            successfn = function(data){
              if(data.status == 0){
                var _li = '';
                $.each(data.data ,function(index, val) {
                  _li += _communitynotify.commentParseTpl(val);
                });

                if( jdata.page == 1){
                    $("#communityNotify").find('.communityNotify-comment-ul').empty();
                }
                data.is_more == 0 && (_li += '<li class="communityNotify-li-none">没有更多了</li>');

                $("#communityNotify").find('.communityNotify-comment-ul').append(_li);

                jdata.page ++ ;
                jdata.nomore = data.is_more == 1 ? false : true ;
              }else{
                alertTip(data.data);
              }
              jdata.loading = false ;
            },
            errorfn = function(data){
              jdata.loading = false ;
            };

        $ajax( url , 'get', param, 'json', successfn , errorfn);
      }

      _communitynotify.commentParseTpl = function(data){
        var html = _communitynotify.likeTpl.replace(/\$\{(\w+)\}/g, function($0, $1){
          switch($1){
            case 'content' :
                if( data.comment_id != 0 && !!data.comment_id ){
                  return '<a class="communityNotify-replyto" href="javascript:;">@'+data.content.reply_to.nickname+'</a>' + data.content.text.replace(/\n|\\n/g , '<br>');
                }else{
                  return data.content.text.replace(/\n|\\n/g , '<br>');
                }
            case 'article_cover' :
                var imgarr = data.obj.content.imgs;
                if(imgarr){
                  return '<img src="'+imgarr[0]+'" alt="" />';
                }else{
                  return '';
                }
            case 'article_title' : return unescape( data.obj.title.replace(/\\u/g, "%u") );
            case 'articleid' : return data.obj_id;
            default : return data[$1];
          }
        });
        return html;
      }
    }

    //会员卡页面
    function VipCard(){
      var _vipCard = this;
      var hasBind = false;
      _vipCard.initialPageData = function(data){
        // 绑定事件
        function bindEvents() {
          if(hasBind){
            return false;
          }
          hasBind = true;
          $("#vipCard .card-item").on("click", ".item-title", function(){
            $(this).toggleClass("active").siblings(".item-body").toggleClass("active");
            var otherItem = $(this).parents(".card-item").siblings(".card-item").find(".item-title, .item-body").removeClass("active");
          });
        }
        if(data.data.is_vip == 1){

          bindEvents();

          // 卡片信息
          $("#vipCard .yes-receive-card").show().siblings("div").hide();
          $("#vipCard .logo img").attr("src",data.data.logo);
          $("#vipCard .title").html(data.data.app_name);
          $("#vipCard .level").html(data.data.title);
          $("#vipCard .duration span").html(data.data.expire);
          if(data.data.background_type == 0){
              $("#vipCard .card").css("background-image","url("+data.data.background+")");
          }else{
              $("#vipCard .card").css("background",data.data.background);
          };

          // 会员权益
          data.data.is_free_postage == 1 && $("#vipCard .vipCard-rights .freePostage").show();
          data.data.discount != 0 && $("#vipCard .vipCard-rights .discount").show().find('.discount-num').text(Number(data.data.discount));
          data.data.giveCouponStr != '' && $("#vipCard .vipCard-rights .coupon").show().find('.give-coupon-str').text(data.data.giveCouponStr);
          data.data.integral != 0 && $("#vipCard .vipCard-rights .integral").show().find('.give-integral-num').text(data.data.integral);

          // 使用须知
          $("#vipCard .vipCard-notice .description").text(data.data.description);

          // 个人积分
          $("#vipCard .vipCard-points .current-integral-num").text(data.data.can_use_integral);
          $("#vipCard .vipCard-points .total-integral-num").text(data.data.total_integral);
          $("#vipCard .vipCard-points .consume-num").text(Number(data.data.consume_num));

          // 联系我们
          $("#vipCard .vipCard-contact .app-name").text(data.data.app_name);
          $("#vipCard .vipCard-contact .phone").text(data.data.phone);

        } else if (data.data.is_vip == 0) {
          $("#vipCard .no-receive-card").show().siblings("div").hide();
        }
      }
    }

    //优惠券列表页
    function CouponList(){
      var _coupon = this;

      _coupon.initialPageData = function(res){
        $('#couponList .tabs li[data-type="-1"]').addClass('active').siblings().removeClass('active');
        $('#couponList .ticket-list').html('');
        var couponListHtml = '';
        for(var i = 0; i < res.data.length; i++){
          var coupon = res.data[i];
          var conditionText = '';
          var backgroundWord = '';
          var functionBtnHtml = '';
          switch(parseInt(coupon.type)){
            case 0:
              conditionText = '满' + coupon.condition + '元，减' + coupon.value + '元';
              backgroundWord = '满';
              break;
            case 1:
              conditionText = '打' + coupon.value + '折';
              backgroundWord = '折';
              break;
            case 2:
              conditionText = '可抵扣' + coupon.value + '元';
              backgroundWord = '代';
              break;
            case 3:
              if(coupon.extra_condition == ''){
                conditionText = '直接兑换' + coupon.coupon_goods_info.title;
              } else if(coupon.extra_condition.price){
                conditionText = '消费满' + coupon.extra_condition.price + '可兑换' + coupon.coupon_goods_info.title;
              } else if(coupon.extra_condition.goods_id){
                conditionText = '购买' + coupon.condition_goods_info.title + '可兑换' + coupon.coupon_goods_info.title;
              }
              backgroundWord = '兑';
              break;
            case 4:
              conditionText = '储值金可充值' + coupon.value + '元';
              backgroundWord = '储';
              break;
            case 5:
              conditionText = coupon.extra_condition;
              backgroundWord = '通';
              break;
            default:
              break;
          }
          switch(parseInt(coupon.status)){
            case 1:
              if(coupon.type == 0 || coupon.type == 1 || coupon.type == 2){
                functionBtnHtml = '<div class="function-btn" style="background-color:'+ coupon.list_color +'" >立即买单</div>'; // 跳当面付
              } else if(coupon.type == 3){
                functionBtnHtml = ''; // 兑换券无跳转
              } else if(coupon.type == 4){
                functionBtnHtml = '<div class="function-btn" style="background-color:'+ coupon.list_color +'"  >立即充值</div>'; // 储值券直接充值
              } else if(coupon.type == 5){
                functionBtnHtml = '<div class="function-btn" style="background-color:'+ coupon.list_color +'"  >立即使用</div>'; // 跳详情
              }
              break;
            case 2:
              functionBtnHtml = '<div class="function-btn" >已使用</div>';
              break;
            case 3:
              functionBtnHtml = '<div class="function-btn" >已失效</div>';
              break;
          }
          couponListHtml += '<div class="ticket '+ ((coupon['status'] == 2 || coupon['status'] == 3) ? 'expired': '') 
                          +'" data-user-coupon-id="'+ coupon.id 
                          +'" data-coupon-type="'+ coupon.type +'"><div class="top-section" style="border-color:'+ coupon.list_color +'" >'
                          + '<div class="detail-info"><div class="name">'+ coupon['title'] +'</div>'
                          + '<div class="use-condition">使用条件：'+ conditionText +'</span></div></div>'
                          + '<div class="background-word-area" style="border-color:'+ coupon.list_color +'" ><div class="background-circle" style="background-color:'+ coupon.list_color +'" ></div><div class="background-word">' + backgroundWord + '</div></div>'
                          + functionBtnHtml + '</div>'
                          + '<div class="bottom-section"><div>有效期 '
                          + coupon.start_use_date + '至' + coupon.end_use_date + ' '
                          + ( coupon.exclude_holiday == 0 ? '' : '除去法定节假日' )  + ' '
                          + ( coupon.exclude_weekend == 0 ? '' : '除去周末' )  + ' '
                          + ( coupon.start_use_time + '-' + coupon.end_use_time) + '</div></div></div>';
        }
        $('#couponList .ticket-list').html(couponListHtml);
      }
    }

    //优惠券详情页
    function CouponDetail(){
      var _couponDetail = this;

      _couponDetail.initialPageData = function(data){
        var status = GetQueryString('couponStatus') || 'receive';
        if(status == 'receive'){
          $.ajax({
            url: '/index.php?r=AppShop/GetCouponInfo',
            type: 'get',
            data: {
              app_id: appId,
              sub_app_id: GetQueryString('sub_id'),
              coupon_id: GetQueryString('detail')
            },
            dataType: 'json',
            success: function(res){
              if(res.status != 0){
                alertTip(res.data);
              }
              _couponDetail.setCouponData(status, res.data);
            }
          });
        } else if(status == 'use'){
          $('#couponDetail .coupon-detail-wrap').show();
          $('#couponDetail .coupon-verify-wrap').hide();
          $.ajax({
            url: '/index.php?r=AppShop/getUserListCouponInfo',
            type: 'get',
            data: {
              app_id: appId,
              sub_app_id: GetQueryString('sub_id'),
              user_coupon_id: GetQueryString('detail')
            },
            dataType: 'json',
            success: function(res){
              if(res.status != 0){
                alertTip(res.data);
              }
              _couponDetail.setCouponData(status, res.data[0]);
            }
          });
        }
      },
      _couponDetail.setCouponData = function(status, data){
        var $couponDetail = $("#couponDetail");
        if(data.background){
          $couponDetail.css("background", data.background);
          $couponDetail.find('.left-circle').css("background", data.background);
          $couponDetail.find('.right-circle').css("background", data.background);
        }
        if(data.button_color){
          $couponDetail.find('.function-btn').css("background", data.button_color);
        }
        var functionBtnText = '';
        $couponDetail.find('.function-btn').removeClass('disabled').show();
        $couponDetail.find('.function-btn').attr('data-type', data['type']);
        $couponDetail.find('.coupon-detail-wrap .qrcode').hide();
        if(status == 'receive'){
          if(data.enable_status == 0){
            functionBtnText = '已下架';
            $couponDetail.find('.function-btn').addClass('disabled')
          } else if(data.stock == 0){
            functionBtnText = '已领完';
            $couponDetail.find('.function-btn').addClass('disabled')
          } else if(data.is_already_recv == 1){
            functionBtnText = '已领取';
            $couponDetail.find('.function-btn').addClass('disabled')
          } else if(data.is_already_recv == 0){
            functionBtnText = '立即领取';
          }
        } else if(status == 'use'){
          if(data.status == 2){
            functionBtnText = '已使用';
            $couponDetail.find('.function-btn').addClass('disabled')
          } else if(data.status == 3){
            functionBtnText = '已失效';
            $couponDetail.find('.function-btn').addClass('disabled')
          } else if(data.status == 1){
            if(data.type == 0 || data.type == 1 || data.type == 2){
              functionBtnText = '立即买单';
              var url = 'http://test.zhichiwangluo.com/index.php?r=AppShop/couponQrcode'
                      + '&app_id=' + appId
                      + '&user_coupon_id=' + data['id'];
              $couponDetail.find('.coupon-verify-wrap .qrcode').attr('src', url);
              $couponDetail.find('.coupon-verify-wrap .verify-code-text').html(data['verify_code']);
              $couponDetail.find('.coupon-detail-wrap .qrcode').show();
            } else if(data.type == 3 || data.type == 5){
              $couponDetail.find('.function-btn').hide();
              var url = 'http://test.zhichiwangluo.com/index.php?r=AppShop/couponQrcode'
                      + '&app_id=' + appId
                      + '&user_coupon_id=' + data['id'];
              $couponDetail.find('.coupon-verify-wrap .qrcode').attr('src', url);
              $couponDetail.find('.coupon-verify-wrap .verify-code-text').html(data['verify_code']);
              $couponDetail.find('.coupon-detail-wrap .qrcode').show();
            } else if(data.type == 4){
              functionBtnText = '立即充值';
            } 
          }
        }
        $couponDetail.find('.function-btn').html(functionBtnText);
        $couponDetail.find('.logo').attr("src", data.logo);
        $couponDetail.find('.name').html(data.app_name);
        $couponDetail.find('.title').html(data.title);
        $couponDetail.find('.sub-title').html(data.sub_title);    
        var conditionText = '';
        switch(data.type){
          case '0':
            conditionText = '满' + data.condition + '元，减' + data.value + '元';
            break;
          case '1':
            conditionText = '打' + data.value + '折';
            break;
          case '2':
            conditionText = '可抵扣' + data.value + '元';
            break;
          case '3':
            if(data.extra_condition == ''){
              conditionText = '直接兑换' + data.coupon_goods_info.title;
            } else if(data.extra_condition.price){
              conditionText = '消费满' + data.extra_condition.price + '可兑换' + data.coupon_goods_info.title;
            } else if(data.extra_condition.goods_id){
              conditionText = '购买' + data.condition_goods_info.title + '可兑换' + data.coupon_goods_info.title;
            }
            break;
          case '4':
            conditionText = '储值金可充值' + data.value + '元';
            break;
          case '5':
            conditionText = data.extra_condition;
            break;
          default:
            break;
        }
        $couponDetail.find('.detail-item.condition .item-content').html(conditionText);
        $couponDetail.find('.detail-item.time .date-duration').html(data.start_use_date + '至' + data.end_use_date);
        var otherCaseText = ( data.exclude_holiday == 0 ? '' : '除去法定节假日' ) + ( data.exclude_weekend == 0 ? '' : '除去周末' );
        $couponDetail.find('.detail-item.time .other-case').html(otherCaseText);
        $couponDetail.find('.detail-item.time .time-duration').html(data.start_use_time + '-' + data.end_use_time);
        $couponDetail.find('.detail-item.address .item-content').html(data.address);
        if(data.address){
          $couponDetail.find('.detail-item.address').show();
        } else {
          $couponDetail.find('.detail-item.address').hide();
        }
        $couponDetail.find('.detail-item.phone .item-content').html(data.phone);
        if(data.phone){
          $couponDetail.find('.detail-item.phone').show();
        } else {
          $couponDetail.find('.detail-item.phone').hide();
        }
      }
    }

    //优惠券领取列表页
    function CouponReceiveListPage(){
      var _couponReceiveListPage = this;

      _couponReceiveListPage.initial = function(res){
        $('#couponReceiveListPage .ticket-list').html('');
        var couponListHtml = '';
        for(var i = 0; i < res.data.length; i++){
          var coupon = res.data[i];
          var conditionText = '';
          var backgroundWord = '';
          switch(coupon.type){
            case '0':
              conditionText = '满' + coupon.condition + '元，减' + coupon.value + '元';
              backgroundWord = '满';
              break;
            case '1':
              conditionText = '打' + coupon.value + '折';
              backgroundWord = '折';
              break;
            case '2':
              conditionText = '可抵扣' + coupon.value + '元';
              backgroundWord = '代';
              break;
            case '3':
              if(coupon.extra_condition == ''){
                conditionText = '直接兑换' + coupon.coupon_goods_info.title;
              } else if(coupon.extra_condition.price){
                conditionText = '消费满' + coupon.extra_condition.price + '可兑换' + coupon.coupon_goods_info.title;
              } else if(coupon.extra_condition.goods_id){
                conditionText = '购买' + coupon.condition_goods_info.title + '可兑换' + coupon.coupon_goods_info.title;
              }
              backgroundWord = '兑';
              break;
            case '4':
              conditionText = '储值金可充值' + coupon.value + '元';
              backgroundWord = '储';
              break;
            case '5':
              conditionText = coupon.extra_condition;
              backgroundWord = '通';
              break;
            default:
              break;
          }
          couponListHtml += '<div class="ticket '+ (coupon['recv_status'] == 1 ? '': 'has-receive') +'" data-coupon-id="'+ coupon.id +'"><div class="top-section"  style="border-color:'+ coupon.list_color +'"  >'
                          + '<div class="detail-info"><div class="name">'+ coupon['title'] +'</div>'
                          + '<div class="use-condition">使用条件：'+ conditionText +'</span></div></div>'
                          + '<div class="background-word-area" style="border-color:'+ coupon.list_color +'" ><div class="background-circle" style="background-color:'+ coupon.list_color +'" ></div><div class="background-word">' + backgroundWord + '</div></div>'
                          + '<div class="function-btn" style="background-color:'+ coupon.list_color +'" >' + (coupon['recv_status'] == 1 ? '领取' : '已领取') + '</div></div>'
                          + '<div class="bottom-section"><div>有效期 '
                          + coupon.start_use_date + '至' + coupon.end_use_date + ' '
                          + ( coupon.exclude_holiday == 0 ? '' : '除去法定节假日' ) + ' '
                          + ( coupon.exclude_weekend == 0 ? '' : '除去周末' )  + ' '
                          + ( coupon.start_use_time + '-' + coupon.end_use_time ) +'</div></div></div>';
        }
        $('#couponReceiveListPage .ticket-list').html(couponListHtml);
      }
    }

    // 个人中心：个人积分 页面
    function MyIntegralPage(){
      var _this = this;

      _this.data = {
        hasBind: false,
        currentMessageType: 'income',    // income:收入 / outcome:支出
        /*
            分支对象 xxBranch：
            data: 对应分支的数据
            html: 对新加载的数据解析出的html
            isMore: 是否拥有更多的新的数据
            currentPage: 当前已经加载到页数
            onload: 是否处在数据加载中， true加载中，false加载完毕
        */
        incomeBranch: {
          data: [],
          html: '',
          isMore: 0,
          currentPage: 1,
          onload: false
        },
        outcomeBranch: {
          data: [],
          html: '',
          isMore: 0,
          currentPage: 1,
          onload: false
        }
      }
      _this.initMyMessagePage = function(data){
        var _detail = GetQueryString('detail');
        if (!_detail) {
          $('#myIntegral .message-content').html('');
          $('#myIntegral .myIntegral-content').show().siblings().hide();
          document.title = '个人积分';
        } else if(_detail == 'rule') {
          $('#myIntegral .myIntegral-rule').show().siblings().hide();
          document.title = '积分规则';
        }
        _this.bindEvents();
        _this.getIntegralDetailData(data); // data传递到这里
        _this.getIntegralRuleData();
        _this.getMessageData('income', 1, _this.checkMoreMessageData);
        _this.getMessageData('outcome', 1, _this.checkMoreMessageData);
      }
        // 绑定事件
      _this.bindEvents = function(){
        if(_this.data.hasBind){
          return false;
        }
        _this.data.hasBind = true;
        $('#myIntegral').on('click', '.message-nav .type-item', function(){
          _this.data.currentMessageType = $(this).attr('data-type');
          $(this).addClass('active').siblings().removeClass('active');
          $('#myIntegral .message-content[data-type="' + _this.data.currentMessageType + '"]').addClass('active').siblings().removeClass('active');
        }).on('click', '.detail-rule', function(){
          var url = modifyTargetUrl({
            router: GetQueryString('router'),
            detail: 'rule'
          });
          window.history.pushState(null, '', url);
          document.title = '积分规则';
          $('#myIntegral .myIntegral-content').hide().siblings().show();
        }).on('click', '.myIntegral-rule .confirm-btn', function(){
          $('#myIntegral .message-content').html('');
          window.history.back();
          document.title = '个人积分';
          $('#myIntegral .myIntegral-rule').hide().siblings().show();
        });
        // 固定消息导航条
        $('#myIntegral .myIntegral-content').on('scroll', function(){
          // 固定导航条
          if ($(this).scrollTop() >= 135) {
            $('#myIntegral .message-nav').css({
              'position': 'fixed',
              'top': 0,
              'left': 0
            });
          } else {
            $('#myIntegral .message-nav').css({
              'position': 'relative'
            });
          }
        });
      }
      // 获得对应消息数据
      _this.getMessageData = function(type, page, callback){
        var action = '';
        if (type == 'income') {
          action = "add";
        } else if (type == 'outcome') {
          action = 'minus';
        }
        $.ajax({
          url: '/index.php?r=AppShop/UserIntegralAction',
          data: {
            "app_id": appId,
            "action": action,
            "page": page || 1
          },
          type: 'get',
          dataType: 'json',
          success: function(res){
            if(res.status != 0) {
              alertTip(res.data);
              return;
            }
            switch(type){
              case 'income':
                _this.data.incomeBranch.data = res.data;
                _this.data.incomeBranch.html = _this.data.incomeBranch.data && _this.parseMessageData(_this.data.incomeBranch.data);
                $('#myIntegral .message-content[data-type="' + type + '"]').append(_this.data.incomeBranch.html);
                _this.data.incomeBranch.isMore = res.is_more;
                _this.data.incomeBranch.currentPage = res.current_page;
                _this.data.incomeBranch.onload = false;
                $.isFunction(callback) && callback(type);
                break;
              case 'outcome':
                _this.data.outcomeBranch.data = res.data;
                _this.data.outcomeBranch.html = _this.data.outcomeBranch.data && _this.parseMessageData(_this.data.outcomeBranch.data);
                $('#myIntegral .message-content[data-type="' + type + '"]').append(_this.data.outcomeBranch.html);
                _this.data.outcomeBranch.isMore = res.is_more;
                _this.data.outcomeBranch.currentPage = res.current_page;
                _this.data.outcomeBranch.onload = false;
                $.isFunction(callback) && callback(type);
                break;
            }
          }
        });
      }
      // 解析对应消息数据
      _this.parseMessageData = function(data){
        var html = '';
        $.each(data, function(index, item){
          html += '<div class="message-item"><div class="message-title">'
                + item.content + '</div><div class="message-time">'
                + item.time + '</div><div class="message-num">'
                + item.num + '</div></div>';
        });
        return html;
      }
      // 底部触发是否获取数据
      _this.checkMoreMessageData = function(type){
        var branch;
        if (type == 'income') {
          branch = _this.data.incomeBranch;
        } else if (type == 'outcome') {
          branch = _this.data.outcomeBranch;
        }
        $('#myIntegral .myIntegral-content').on('scroll', function(){
          // 拥有更多消息 && 没有在加载中 && 距顶部高度为 660（十个消息的最小高度）* n(当前页数) - (330 + 16)（六个消息的高度594加底部间距16）
          if (branch.isMore && (!branch.onload) && ($(this).scrollTop() >= (180 + 660 * branch.currentPage - 346) )) {
            _this.getMessageData(type, (branch.currentPage + 1));
            branch.onload = true;
          }
        });
      }
      // 获得积分详情数据
      _this.getIntegralDetailData = function(res){
        // $.ajax({
        //   url: '/index.php?r=pc/AppShop/UserIntegral',
        //   data: {
        //     "app_id": appId,
        //   },
        //   type: 'get',
        //   dataType: 'json',
        //   success: function(res){
        //     if (res.status != 0) {
        //       alertTip(res.data);
        //     }
              $("#myIntegral .can-use-integral").text(res.data.can_use_integral);
              $("#myIntegral .total-integral").text(res.data.total_integral);
        //   }
        // });
      }
      // 获得积分规则数据
      _this.getIntegralRuleData = function(){
        $.ajax({
          url: '/index.php?r=AppShop/IntegralRule',
          data: {
            "app_id": appId,
          },
          type: 'get',
          dataType: 'json',
          success: function(res){
            if (res.status != 0) {
              alertTip(res.data);
            }
            $("#myIntegral .consume-num").text(res.data.consume_num);
            $("#myIntegral .convert-num").text(res.data.convert_num);
            if (res.data.login_num !=0 ) {
              $("#myIntegral .login-num").text(res.data.login_num);
            } else {
              $("#myIntegral .rule-item.login").hide();
            }
            if (res.data.share_num !=0 ) {
              $("#myIntegral .share-num").text(res.data.share_num);
            } else {
              $("#myIntegral .rule-item.share").hide();
            }
            if (res.data.post_comment_num !=0 ) {
              $("#myIntegral .post-comment-num").text(res.data.post_comment_num);
            } else {
              $("#myIntegral .rule-item.post-comment").hide();
            }
          }
        });
      }
    }

    // 核销码 页面
    function VerificationCodePage() {
      var _verificationCodePage = this;

      _verificationCodePage.initial = function(res) {
        $('#verificationCodePage .verification-code-img').attr('src', res.data.qrcode_url);
        $('#verificationCodePage .verification-code-text .num').text(res.data.code);
        if(res.data.status == 0) {
          $('#verificationCodePage .verification-code-area').removeClass('finished')
        } else if(res.data.status == 1) {
          $('#verificationCodePage .verification-code-area').addClass('finished');
        }


      };
    }

    // 储值金 页面
    function BalancePage(){
      var _this = this;

      _this.data = {
        /*
            data: 对应的数据
            html: 对新加载的数据解析出的html
            isMore: 是否拥有更多的新的数据
            currentPage: 当前已经加载到页数
            onload: 是否处在数据加载中， true加载中，false加载完毕
        */
        messageData: {
          data: [],
          html: '',
          isMore: 0,
          currentPage: 1,
          onload: false
        }
      }
      _this.initial = function(data){
        $("#balance .detail-num").text(data.data.balance);
        $('#balance .message-content').html('');
        _this.getMessageData(1, _this.checkMoreMessageData);
      }
      // 获得对应消息数据
      _this.getMessageData = function(page, callback){
        $.ajax({
          url: '/index.php?r=AppShop/getStoredLogByUserToken',
          data: {
            "app_id": appId,
            "page": page || 1
          },
          type: 'get',
          dataType: 'json',
          success: function(res){
            if(res.status != 0) {
              alertTip(res.data);
              return;
            }
            _this.data.messageData.data = res.data;
            _this.data.messageData.html = _this.data.messageData.data && _this.parseMessageData(_this.data.messageData.data);
            $('#balance .message-content').append(_this.data.messageData.html);
            _this.data.messageData.isMore = res.is_more;
            _this.data.messageData.currentPage = res.current_page;
            _this.data.messageData.onload = false;
            $.isFunction(callback) && callback();
          }
        });
      }
      // 解析对应消息数据
      _this.parseMessageData = function(data){
        var html = '';
        $.each(data, function(index, item){
          var content = JSON.parse(item.stored_content);
          var type = item.type;
          var title = '';
          var num = 0;
          var typeStr = '';
          if(type == 1) {
            title = '自主充值';
            num = Number(content.price) + Number(content.g_price);
            num = '+' + num;
            typeStr = 'add';
          } else if(type == 2){
            title = '商家充值';
            num = Number(content.price);
            num = '+' + num;
            typeStr = 'add';
          } else if(type == 3){
            title = '商品买卖';
            num = Number(content.price);
            typeStr = 'minus';
          } else if(type == 4){
            title = "商品退款";
            num = Number(content.price);
            num = '+' + num;
            typeStr = "add";
          } else if(type == 5){
            title = "储值券充值";
            num = Number(content.g_price);
            num = '+' + num;
            typeStr = "add";
          } else if(type == 6){
            title = "自定义充值";
            num = Number(content.price) + Number(content.g_price);
            num = '+' + num;
            typeStr = "add";
          }
          html += '<div class="message-item"><div class="message-title">'
                + title + '</div><div class="message-time">'
                + item.add_time + '</div><div class="message-num ' + typeStr + '">'
                + num + '</div></div>';
        });
        return html;
      }
      // 底部触发是否获取数据
      _this.checkMoreMessageData = function(){
        var messageData = _this.data.messageData;
        $('#balance .balance-content').on('scroll', function(){
          // 拥有更多消息 && 没有在加载中 && 距顶部高度为 640（十个消息的最小高度）* n(当前页数) - (330)（六个消息的高度594）
          if (messageData.isMore && (!messageData.onload) && ($(this).scrollTop() >= (107 + 640 * messageData.currentPage - 576) )) {
            _this.getMessageData(messageData.currentPage + 1);
            messageData.onload = true;
          }
        });
      }
    }

    // 充值 页面
    function RechargePage(){
      var _this = this;
      _this.data = {
        hasBind: false,
        itemList: [],
        customItemInfo: {}
      }
      _this.initial = function(res){
        if(res.data){
          _this.parseItemData(res.data);
          _this.parseCustomItemData(res.stored_custom_info);
          _this.parseCouponItemData(res.user_coupon_list);
        }
        _this.bindEvents();
      }
      _this.bindEvents = function(){
        if(_this.data.hasBind){
          return false;
        }
        _this.data.hasBind = true;
        $('#recharge').on('click', '.select-item', function(){
          // 选中储值项
          var index = $(this).index();
          var description = _this.data.itemList[index]['description'];
          $(this).addClass('active').siblings().removeClass('active');
          if(!!description) {
            $('#recharge .instruction-area .area-content').text(description);
            $('#recharge .instruction-area').show();
          } else {
            $('#recharge .instruction-area').hide();
          }
          $('#recharge .payment-area').show();
          $('#recharge .custom-item').removeClass('active');
          $('#recharge .coupon-item').removeClass('active');
        }).on('click', '.custom-item', function(){
          // 选中自定义储值
          $(this).addClass('active');
          $('#recharge .select-item').removeClass('active');
          $('#recharge .instruction-area').hide();
          $('#recharge .instruction-area .area-content').text('');
          $('#recharge .payment-area').show();
          $('#recharge .coupon-item').removeClass('active');
        }).on('blur', '.custom-item .item-price-input', function(){
          _this.confirmCustomPrice();
        }).on('input', '.custom-item .item-price-input', function(){
          _this.confirmCustomPrice();
        }).on('click', '.coupon-item', function(){
          // 选中储值券
          $(this).addClass('active');
          $('#recharge .select-item').removeClass('active');
          $('#recharge .instruction-area').hide();
          $('#recharge .instruction-area .area-content').text('');
          $('#recharge .payment-area').hide();
          $('#recharge .custom-item').removeClass('active');
        }).on('click', '.recharge-btn', function(){
          _this.gotoRecharge();
        });
      },
      // 解析储值项数据
      _this.parseItemData = function(data){
        var html = '';
        var itemObj = {};
        _this.data.itemList = [];
        $.each(data, function(index, item){
          html += '<div class="select-item ' + (index == 0 ? 'active' : '' ) + '" data-id="' + item.id + '">'
                 + '<div class="recharge-money">' + Number(item.price) + '元</div>'
                 + (Number(item.g_price) == 0 ? '' : ('<div class="give-money">赠送' + item.g_price + '元</div>'))
                 + '</div>';
          itemObj = {
              'description': item.description
          }
          _this.data.itemList.push(itemObj);
          if((index == 0) && (item.description != '')){
            $('#recharge .instruction-area .area-content').text(item.description);
            $('#recharge .instruction-area').show();
          }
        });
        $('#recharge .select-list').html(html);
      },
      // 解析自定义储值数据
      _this.parseCustomItemData = function(data){
        _this.data.customItemInfo = data;
        var tip = '';
        if(data.type == 1){
          tip = '按充值金额x' + data.value + '比例赠送储值金';
        } else if(data.type == 2){
          tip = '每充值' + data.condition + '元，赠送' + data.value + '元';
        } else {
          tip = '';
        }
        $('#recharge .custom-item .item-tip').html(tip);
        if(data.status == 1){
          $('#recharge .custom-item').show();
        } else {
          $('#recharge .custom-item').hide();
        }
      },
      // 确认自定义储值价格
      _this.confirmCustomPrice = function(){
        var price = $('#recharge .custom-item .item-price-input').val();
        var customItemInfo = _this.data.customItemInfo;
        if(price == ''){
          if(customItemInfo.type == 1){
            tip = '按充值金额x' + customItemInfo.value + '比例赠送储值金';
          } else if(customItemInfo.type == 2){
            tip = '每充值' + customItemInfo.condition + '元，赠送' + customItemInfo.value + '元' ;
          } else {
            tip = '';
          }
        } else if(!(/^[0-9]+([.]{1}[0-9]{1,2})?$/.test(price))){
          tip = '充值的金额必须>=0，精确到小数点后2位!';
        } else {
          if(customItemInfo.type == 1){
            tip = '赠送储值金' + ( price*customItemInfo.value ) + '金';
          } else if(customItemInfo.type == 2){
            tip = '赠送储值金' + ( Math.floor(price/customItemInfo.condition)*customItemInfo.value ).toFixed(2) + '金';
          } else {
            tip = '';
          }
        }
        $('#recharge .custom-item .item-tip').html(tip);
      },
      // 解析储值券数据
      _this.parseCouponItemData = function(data){
        var html = '';
        $.each(data, function(index, item){
          html += '<div class="coupon-item" data-id="' + item.id + '">'
                 + '<div class="item-title">¥ <span class="price">' + Number(item.value) + '储值券</span></div>'
                 + '<div class="division-line"><div class="left-semicircle"></div><div class="right-semicircle"></div></div>'
                 + '<div class="bottom-section">'
                 + '<div class="date-duration">' + item.start_use_date.split('-').join('.') + '-' + item.end_use_date.split('-').join('.') + '</div>'
                 + '<div class="other-case">' + ( item.exclude_holiday == 1 ? '除法定节假日' : '') + ' ' + ( item.exclude_weekend == 1 ? '周一至周五' : '' ) + '</div>'
                 + '<div class="time-duration">' + item.start_use_time + '-' + item.end_use_time + '</div>'
                 + '</div>'
                 + '</div>';
        });
        $('#recharge .coupon-list').html(html);
        if(data.length > 0){
          $('#recharge .coupon-area').show();
        } else {
          $('#recharge .coupon-area').hide();
        }
      },
      // 充值
      _this.gotoRecharge = function(){
        var param = {
          app_id: appId
        };
        if($('#recharge .select-item.active').length > 0 ){
          param['type'] = 1;
          param['stored_id'] = $('#recharge .select-item.active').attr('data-id');
        } else if($('#recharge .custom-item.active').length > 0){
          param['type'] = 6;
          param['price'] = $('#recharge .custom-item .item-price-input').val();
          if(!(/^[0-9]+([.]{1}[0-9]{1,2})?$/.test(param['price']))){
            alertTip('输入金额错误!');
            return false;
          }
        } else if($('#recharge .coupon-item.active').length > 0){
          param['type'] = 5;
          param['user_coupon_id'] = $('#recharge .coupon-item.active').attr('data-id');
        } else {
          alertTip('商家尚未设置储值');
          return false;
        }
        $.ajax({
          url: '/index.php?r=AppShop/creatStoredItemOrder',
          type: 'get',
          data: param,
          dataType: 'json',
          success: function(res){
            if(param['type'] == 1 || param['type'] == 6){
              var orderId = res.data;
              var payWay = $('#recharge input[name="payment"]:checked').val();
              if(payWay == 'aliPay') {
                window.open('/index.php?r=AppShop/getUniPay&order_id=' + orderId + '&payment_id=1');
              } else if(payWay == 'wechatPay') {
                APP.turnToPage({
                  router: 'payPage',
                  detail: orderId
                });
              }
            } else if(param['type'] == 5){
              APP.turnToPage({
                router: 'balance',
                redirect: true
              });
            }
          }
        })
      }
    }


    function FranchiseeDetailPage(){
      var _franchiseeDetail = this;
      var listPage = 1;
      var franchiseeId, cart_goods_num, franchisee_goods_form;

      // 判断是否加载过
      var isTrue=false,
          couponTrue=false;
      //点击查看优惠券列表
      _franchiseeDetail.coupon_click=function(){
        if(couponTrue){
            return;
        }
        couponTrue=true;
        $('#franchiseeDetail').on("click",".get-goods-coupon",function(){
            var url = modifyTargetUrl({
                router: GetQueryString('router'),
                coupon: 'rule'
              });
          window.history.pushState(null, '', url);
          document.title = '优惠券列表';
            $('.franchiseeDetail-container ').hide();
          $(".goods-coupon-list").show();
        })
      }
      _franchiseeDetail.bindClick=function(){
        if(isTrue){
            return;
        }
        isTrue=true;
        //点击查看更多
        $('#franchiseeDetail').on("click",".goods-list-more",function(){
          // 获取商品的数据分类
          _franchiseeDetail.getAdmincategory( 0 , $('.list-more-show .categroyList'));
          var url = modifyTargetUrl({
                router: GetQueryString('router'),
                dist: 'goods'
              });
          window.history.pushState(null, '', url);
          document.title = '全部商品';
          $('.franchiseeDetail-container ').hide();
          $(".list-more-show").show();
        }).on("click",".order-list-more",function(){
          //预约分类
         _franchiseeDetail.getAdmincategory( 1 , $('.order-more-show .categroyList'));
          // 全部预约
          var url = modifyTargetUrl({
                router: GetQueryString('router'),
                dist: 'appointment'
              });
          window.history.pushState(null, '', url);
          document.title = '全部预约';
          $('.franchiseeDetail-container').hide();
          $(".order-more-show").show();
        }).on("click",".tostore-list-more",function(){
          //到店分类
         _franchiseeDetail.getAdmincategory( 3 , $('.tostore-more-show .categroyList'));
          // 全部到店
          var url = modifyTargetUrl({
                router: GetQueryString('router'),
                dist: 'tostore'
              });
          window.history.pushState(null, '', url);
          document.title = '全部到店';
          $('.franchiseeDetail-container').hide();
          $(".tostore-more-show").show();
        });

        //商品分类
        $(".list-more-show").on('scroll', function(event) {
          var _this = $(this),
              _wheight = _this.height(),
              _cheight = _this.children('.franchisee-goods-list-container').height(),
              _scrolltop = _this.scrollTop();

          if(_cheight - _wheight - _scrolltop < 150){
            _franchiseeDetail.getGoodsData(_this.find('.categroyList').children('li.active').attr('data-id') || '');
          }

        }).on("click",".categroyList > li",function(){
          $(this).addClass('active').siblings('.active').removeClass('active');
          _franchiseeDetail.getGoodsDataAjax = {
            loading : false,
            nomore : false,
            page : 1
          }
          _franchiseeDetail.getGoodsData($(this).attr('data-id') || '');
        });

        //预约分类
        $(".order-more-show").on('scroll', function(event) {
          var _this = $(this),
              _wheight = _this.height(),
              _cheight = _this.children('.franchisee-goods-list-container').height(),
              _scrolltop = _this.scrollTop();
              console.log(_this)
          if(_cheight - _wheight - _scrolltop < 150){
            _franchiseeDetail.getOrderData(_this.find('.categroyList').children('li.active').attr('data-id') || '');
          }

        }).on("click",".categroyList > li",function(){
          $(this).addClass('active').siblings('.active').removeClass('active');
          _franchiseeDetail.getOrderDataAjax = {
            loading : false,
            nomore : false,
            page : 1
          }
          _franchiseeDetail.getOrderData($(this).attr('data-id') || '');
        });
        //到店分类
        $(".tostore-more-show").on('scroll', function(event) {
          var _this = $(this),
              _wheight = _this.height(),
              _cheight = _this.children('.franchisee-goods-list-container').height(),
              _scrolltop = _this.scrollTop();
              console.log(_this)
          if(_cheight - _wheight - _scrolltop < 150){
            _franchiseeDetail.gettostoreData(_this.find('.categroyList').children('li.active').attr('data-id') || '');
          }

        }).on("click",".categroyList > li",function(){
          $(this).addClass('active').siblings('.active').removeClass('active');
          _franchiseeDetail.gettostoreDataAjax = {
            loading : false,
            nomore : false,
            page : 1
          }
          _franchiseeDetail.gettostoreData($(this).attr('data-id') || '');
        });
      }

      _franchiseeDetail.getAdmincategory=function( type , container){
        $ajax('/index.php?r=pc/AppAdminCategory/list', 'get', {
          form: 'goods',
          app_id: GetQueryString('detail'),
          goods_type: type
        }, 'json', function(data) {
          if (data.status == 0) {
            var category = data.data,
            html = '<li>全部</li>';
            $.each(category, function(index, cate) {
              html += '<li data-id=' + cate.id + '>' + cate.name + '</li>';
            });
            container.html(html).find('li:first-child').trigger('click');
          }else{
            alertTip('请求数据失败 ' + data.data);
          }

        }, function(){
           alertTip('请求数据失败，请重试');
        });
      }

      _franchiseeDetail.modifyFranchiseeDetail = function(data) {
      	//console.log(data)
        _franchiseeDetail.coupon_click();
      	_franchiseeDetail.bindClick();
        //查看优惠券
        var detail =GetQueryString('coupon');
        if(detail=='rule'){
             document.title = '优惠券列表';
            $('.goods-coupon-list').show();
          $('.franchiseeDetail-container').hide();
      }else{
         document.title = '商家详情';
        $('.goods-coupon-list').hide();
          $('.franchiseeDetail-container').show();
      }

        //查看更多
        var _detail =GetQueryString('dist');
        if(_detail == 'goods') {
           _franchiseeDetail.getAdmincategory( 0 , $('.list-more-show .categroyList'));
          $('.list-more-show').show();
          $('.franchiseeDetail-container').hide();
        }else if(_detail == 'appointment') {
          _franchiseeDetail.getAdmincategory( 1 , $('.order-more-show .categroyList'))
          $('.order-more-show').show();
          $('.franchiseeDetail-container').hide();
        }else if(_detail=='tostore'){
          _franchiseeDetail.getAdmincategory( 3 , $('.tostore-more-show .categroyList'))
          $('.tostore-more-show').show();
          $('.franchiseeDetail-container').hide();
        }
        else{
          $('.list-more-show').hide();
          $('.order-more-show').hide();
          $('.tostore-more-show').hide();
          $('.franchiseeDetail-container ').show();
        }


        var franchisee = data.data[0],
            $franchiseePage = $('#franchiseeDetail'),
            coverStr = discountStr = addressStr = goodsTabStr = '',
            goodsTypeLength;
        franchiseeId = franchisee.app_id;
        if (!franchisee.carousel_imgs.length && franchisee.carousel_imgs != null) {
          coverStr += '<img src=' + franchisee.picture + '>';
          $franchiseePage.find('.slick-carousel-container').addClass('thumbnail').css('max-height', DEVICE_WIDTH);
        } else {
          coverStr += '<div class="slick-carousel" data-auto-play="true" data-interval="2000">';
          $.each(franchisee.carousel_imgs, function(index, ele) {
            coverStr += '<div><img class="carousel-img" src=' + ele + ' ></div>';
          });
          coverStr += '</div>';
          $franchiseePage.find('.slick-carousel-container').removeClass('thumbnail');
        }

        $franchiseePage.find('.slick-carousel-container').html(coverStr);
        $franchiseePage.find('.franchisee-name').text(franchisee.name);
        $franchiseePage.find('.franchisee-description').html(franchisee.description.replace(/\\n/g, '<br>'));
        $franchiseePage.find('.franchisee-discount').html(discountStr);
        $franchiseePage.find('.franchisee-business-hours').html(franchisee.business_time_str.replace(/\,/g , '<br>'));
        $franchiseePage.find('.franchisee-phone').text(franchisee.phone).attr('href', 'tel:'+franchisee.phone);
        $franchiseePage.find(".franchisee-img").attr("src",franchisee.picture);
        addressStr = franchisee.province_name+franchisee.city_name+franchisee.county_name+franchisee.address_detail;
        $franchiseePage.find('.franchisee-address').text(addressStr).attr({
          'address': addressStr,
          lat: franchisee.latitude,
          lng: franchisee.longitude
        });
        //优惠券详情
        if(franchisee.coupon_list==''){
            $(".get-goods-coupon").hide();
        }else{
             $(".get-goods-coupon").show();
        }
        var $li='';

        $.each(franchisee.coupon_list, function(index,couponItem) {
          if(couponItem.type==0){
            // $li+="<li><div class='coupon-left'><div class='coupon-price'>￥"+couponItem.value+"</div><div class='coupon-news'><p>"+couponItem.title+"</p><p>满"+couponItem.condition+"元可用</p></div></div><div class='coupon-right router js-to-detail' data-router='couponDetail' data-id='"+couponItem.id+"' data-appId='"+GetQueryString('detail')+"'>领取</div></li>"
            $li+="<div class='coupon_ticket router js-to-detail' data-router='couponDetail' data-id='"+couponItem.id+"' data-appId='"+GetQueryString('detail')+"'><div class='ticket-wrap'><p class='price'>￥<span>"+couponItem.value+"</span></p><div class='coupon_right'><h2 class='coupon_name'>"+couponItem.title+"</h2><p>消费满"+couponItem.condition+"元减"+couponItem.value+"元</p><p>"+couponItem.start_use_date+"至"+couponItem.end_use_date+"</p></div></div></div>"
          }
          if(couponItem.type==1){
            // $li+="<li><div class='coupon-left'><div class='coupon-price'>"+couponItem.value+"折</div><div class='coupon-news'><p>"+couponItem.title+"</p><p>打折优惠</p></div></div><div class='coupon-right router js-to-detail' data-router='couponDetail' data-id="+couponItem.id+" data-appId='"+GetQueryString('detail')+"'>领取</div></li>"
            $li+="<div class='coupon_ticket router js-to-detail' data-router='couponDetail' data-id='"+couponItem.id+"' data-appId='"+GetQueryString('detail')+"'><div class='ticket-wrap'><p class='price'><span>"+couponItem.value+"折</span></p><div class='coupon_right'><h2 class='coupon_name'>"+couponItem.title+"</h2><p>打"+couponItem.value+"优惠</p><p>"+couponItem.start_use_date+"至"+couponItem.end_use_date+"</p></div></div></div>"

          }
        });
        $(".franchisee-goods-coupon-container").empty().append($li)

        $('#franchiseeDetail .franchisee-tip-bar').css('display', franchisee.is_open == 0 ? 'block' : 'none');
        $('#franchiseeDetail .js-list-container').html('');
        var goods_no = true,
            appointment_no = true,
            tostore_no=true;
        if(goodsTypeLength=franchisee.has_goods_type.length){
          for(var i = 0; i < goodsTypeLength; i++){
            switch(+franchisee.has_goods_type[i]){
               case 0: franchisee_goods_form = 'goods';
                      _franchiseeDetail.getListData($('#franchiseeDetail .goods-listData .js-list-container'));
                      goods_no = false;
               break;
               case 1: franchisee_goods_form = 'appointment';
                      _franchiseeDetail.getListData($('#franchiseeDetail .order-listData .js-list-container'));
                      appointment_no = false;
               break;
               case 3: franchisee_goods_form = 'tostore';
                      _franchiseeDetail.getListData($('#franchiseeDetail .tostore-listData .js-list-container'));
                      tostore_no=false;
               break;
            }

          }
          listPage = 1;
        }
         //无商品时显示
        if(goods_no==true){
          $('.goods-listData').css("display","none");
        }else{
          $('.goods-listData').css("display","block");
        }
        //无预约时显示
        if(appointment_no==true){
          $('.order-listData').css("display","none");
        }else{
          $('.order-listData').css("display","block");
        }
        //无到店时显示
        if(tostore_no==true){
          $('.tostore-listData').css("display","none");
        }else{
          $('.tostore-listData').css("display","block");
        }
        cart_goods_num = franchisee.cart_goods_num;
       APP.initMap();
    };

    _franchiseeDetail.getConData = function($container) {
        $container.addClass('js-requesting');
        var param = {
          app_id: appId,
          page: 1,
          page_size: 20,
          sub_shop_app_id: franchiseeId,
          form: franchisee_goods_form
        };
        $ajax('/index.php?r=AppShop/GetGoodsList', 'get', param, 'json', function(data) {
          if (data.status == 0) {
            if (data.is_more == 0) {
              $container.addClass('js-no-more');
            };
            _franchiseeDetail.parseData($container, data.data);
          } else {
              alertTip('请求数据失败 ' + data.data);
          };
          $container.removeClass('js-requesting');
        }, function() {
          $container.removeClass('js-requesting');
          alertTip('请求数据失败，请重试');
        });
    };
      // $container: 新增数据的列表，data: 数据
    _franchiseeDetail.parseData = function($container, data) {
    	$container.html('');

      $(data).each(function(index, item) {
      	//商品
      	if(item.form_data.goods_type==0){
    	   	if(index<2){
        		$container.append(_franchiseeDetail.parseSingleData(item));
        	}
  	    	if(index == 0){
  	    		$('.list-more-show .js-list-container').html('');
  	    	}
        	$('.list-more-show .js-list-container').append(_franchiseeDetail.parseSingleData(item));
        }
      	if(item.form_data.goods_type==1){
    	   	if(index<2){
      		  $container.append(_franchiseeDetail.parseSingleData(item));
    	    }
          if(index == 0){
            $('.order-more-show .js-list-container').html('');
          }
    	   	$('.order-more-show .js-list-container').append(_franchiseeDetail.parseSingleData(item));
  	    }
        //到店
        if(item.form_data.goods_type==3){
          if(index<2){
            $container.append(_franchiseeDetail.parseSingleData(item));
          }
          if(index == 0){
            $('.tostore-more-show .js-list-container').html('');
          }
          $('.tostore-more-show .js-list-container').append(_franchiseeDetail.parseSingleData(item));
        }
      });
    }
    _franchiseeDetail.getGoodsDataAjax = {
      loading : false,
      nomore : false,
      page : 1
    }
    // 获取子店商品
    _franchiseeDetail.getGoodsData = function(id){
      var jdata = _franchiseeDetail.getGoodsDataAjax;
      if(jdata.loading || jdata.nomore){
        return ;
      }
      jdata.loading = true;

      var url = '/index.php?r=AppShop/GetGoodsList',
          param = {
            app_id: GetQueryString('detail'),
            page: jdata.page ,
            form: 'goods',
            idx_arr: {
              idx: 'category',
              idx_value: id
            }
          },
          successfn = function(data) {
            jdata.loading = false;

            if (data.status == 0) {

              if(jdata.page == 1){
                $('.list-more-show .js-list-container').html('');
              }
              $(data.data).each(function(index, item) {
                $('.list-more-show .js-list-container').append(_franchiseeDetail.parseSingleData(item));
              });

              jdata.page ++;
              if(data.is_more == 0){
                jdata.nomore = true;
              }
            }else{
              alertTip(data.data);
            }
          },
          errorfn = function() {
            jdata.loading = false;
          };
      $ajax( url , 'get', param, 'json', successfn , errorfn);

    }

    _franchiseeDetail.getOrderDataAjax = {
      loading : false,
      nomore : false,
      page : 1
    }
    // 获取预约商品
    _franchiseeDetail.getOrderData=function(id){
      var jdata = _franchiseeDetail.getOrderDataAjax;
      if(jdata.loading || jdata.nomore){
        return ;
      }
      jdata.loading = true;
      var url = '/index.php?r=AppShop/GetGoodsList',
          param = {
            app_id: GetQueryString('detail'),
            page:  jdata.page ,
            form: 'appointment',
            idx_arr: {
              idx: 'category',
              idx_value: id
            }
          },
          successfn = function(data) {
            jdata.loading = false;
            if (data.status == 0){
              if(jdata.page == 1){
                $('.order-more-show .js-list-container').html('');
              }
              $(data.data).each(function(index, item) {
                $('.order-more-show .js-list-container').append(_franchiseeDetail.parseSingleData(item));
              });
              jdata.page ++;
              if(data.is_more == 0){
                jdata.nomore = true;
              }
            }else{
              alertTip(data.data);
            }
          },
          errorfn = function() {
            jdata.loading = false;
          };
      $ajax( url , 'get', param, 'json', successfn , errorfn);
    }
    //获取到店商品
    _franchiseeDetail.gettostoreDataAjax = {
      loading : false,
      nomore : false,
      page : 1
    }

    _franchiseeDetail.gettostoreData=function(id){
      var jdata = _franchiseeDetail.gettostoreDataAjax;
      if(jdata.loading || jdata.nomore){
        return ;
      }
      jdata.loading = true;
      var url = '/index.php?r=AppShop/GetGoodsList',
          param = {
            app_id: GetQueryString('detail'),
            page:  jdata.page ,
            form: 'tostore',
            idx_arr: {
              idx: 'category',
              idx_value: id
            }
          },
          successfn = function(data) {
            jdata.loading = false;
            if (data.status == 0){
              if(jdata.page == 1){
                $('.tostore-more-show .js-list-container').html('');
              }
              $(data.data).each(function(index, item) {
                $('.tostore-more-show .js-list-container').append(_franchiseeDetail.parseSingleData(item));
              });
              jdata.page ++;
              if(data.is_more == 0){
                jdata.nomore = true;
              }
            }else{
              alertTip(data.data);
            }
          },
          errorfn = function() {
            jdata.loading = false;
          };
      $ajax( url , 'get', param, 'json', successfn , errorfn);
    }

    _franchiseeDetail.parseSingleData = function(item) {

      var formData = item['form_data'];
      //console.log()
     if(formData.goods_type==3){
     var $li = $('<li class="franchisee-goods-item router js-to-detail" data-id=' + formData.id + ' franchisee-id='+franchiseeId+' cart-num='+cart_goods_num+' data-router="tostoreDetail"></li>');
     }else{
      var $li = $('<li class="franchisee-goods-item router js-to-detail" data-id=' + formData.id + ' franchisee-id='+franchiseeId+' cart-num='+cart_goods_num+' data-router="goodsDetail"></li>');
      }
      return $li.append(_franchiseeDetail.addItem(formData));
    };

    _franchiseeDetail.addItem = function(formData) {
      var fragment = $(document.createDocumentFragment()),
          $content = $('<div class="inner-content"></div>'),
          $img = $('<img class="list-img" src=' + formData.cover + '>'),
          $titles = $('<div class="title-container"><p class="title">' + formData.title + '</p><p><span class="price">￥' + formData.price + '</span><span class="sales">销量：' + formData.sales + '</span></p></div>');

      $content.append($img).append($titles);
      return fragment.append($content);
    };

    // 自适应高度滚动获取列表数据时调用的函数
    _franchiseeDetail.getListData = function(container) {
      //_franchiseeDetail.getData(container);
      _franchiseeDetail.getConData(container);
    };

   }


    function ResetLocationPage(){
      var _resetLocation = this,
          $resetLocationPage = $('#resetLocation');

      _resetLocation.showResetLocation = function(options){
        $resetLocationPage.find('.location_search_input').val('');
        $resetLocationPage.find('.location_address_text').text(options.address);
        APP.turnToPage({
          router: 'resetLocation',
          listId: options.listId
        })
      };
    }

    function TransferPayPage(){
      var _transferpay = this,
          $transferPage = $('#transferPay');

      _transferpay.modifyTransferPay = function(res){
        var balance = res.data.balance,
            discountList = res.data.can_use_benefit.data;

        if(balance == 0){
          $transferPage.find('.transfer-balance-switch').css('display', 'none');
        } else {
          $transferPage.find('.transfer-balance-switch').css('display', 'block');
        }

        if(discountList.length){
          $transferPage.find('.transfer-discount-section').css('display', 'block').find('.transfer-nodiscount-wrap').css('display', 'block').siblings('.transfer-discount-wrap').css('display', 'none');
        } else {
          $transferPage.find('.transfer-discount-section').css('display', 'none');
        }

        $transferPage.find('.transfer-balance-section').css('display', 'none');
        $transferPage.find('.transfer-switch-input').prop('checked', false);
        $transferPage.find('.transfer-count-input').val('');
        $transferPage.find('.transfer-remark').val('');
        $transferPage.find('.transfer-discount-select, .transfer-payment').html('');
      }
    }

    function TransferDetailPage(){
      var _transferDetail = this,
          $transferDetail = $('#transferDetail');

      _transferDetail.modifyOrderDetail = function(order){
        var detail = order.data[0].form_data,
            status = detail.status,
            html = '',
            btnStatus, addressInfo,
            benefit_html = '',
            can_use_benefit = detail.can_use_benefit,
            goods_type = detail.goods_type;

        $transferDetail.find('.transfer-order-id').text(detail.order_id);
        $transferDetail.find('.transfer-order-addtime').text(detail.add_time);
        $transferDetail.find('.transfer-order-original-price').text(detail.original_price);
        $transferDetail.find('.transfer-order-totalpay').text(detail.total_price);
        $transferDetail.find('.transfer-order-payway').text(detail.payment_id == 0 ? '微信支付':'支付宝');
        $transferDetail.find('.transfer-order-remark').text(detail.remark);

        if(detail.selected_benefit && detail.selected_benefit.discount_type){
          $transferDetail.find('.transfer-order-discount-section').show().find('.transfer-order-discount').text(detail.selected_benefit.title).siblings('.transfer-discount-cut').text(detail.discount_cut_price);

        } else {
          $transferDetail.find('.transfer-order-discount-section').hide();
        }

        if(detail.use_balance == 0){
          $transferDetail.find('.transfer-order-deduction-section').css('display', 'none');
        } else {
          $transferDetail.find('.transfer-order-deduction').text(detail.use_balance).closest('.transfer-order-deduction-section').css('display', 'block');
        }

        switch (detail.status) {
          case '0':
            $('.transfer-order-payway-section').css('display', 'none');
            $('.transfer-order-choose-payway').css('display', 'block');
            btnStatus = '<span class="btn transfer-order-cancel">取消支付</span><span class="btn btn-red transfer-order-pay">支付</span>';
            break;
          case '6':
            $('.transfer-order-payway-section').css('display', 'block');
            $('.transfer-order-choose-payway').css('display', 'none');
            btnStatus = '<span>已完成</span>';
            break;
          case '7':
            $('.transfer-order-payway-section').css('display', 'block');
            $('.transfer-order-choose-payway').css('display', 'none');
            btnStatus = '<span>已关闭</span>';
            break;
        }
        $transferDetail.find('.transfer-bottom-operation').html(btnStatus);
        OfficialPages['pay-page'].setCode(order);
      }
    }

    function myGroupPage() {
      var _myGroup = this,
          is_leader_order = 1,
          current_status = 0;

      _myGroup.modifyMyGroupList = function(data) {
        var data = data.data,
            html = '';
        console.log(data);

        $.each(data,function(idx,item){
          var orderStatus = '';
          var statusButton = '';
          var expiredTime = '';
          switch(Number(item.form_data.group_buy_order_info.current_status)){
            case 1:
              orderStatus = '待付款'
              statusButton = '<div class="group-btn white cancel-group" data-id="'+item.order_id+'">取消拼团</div><div class="group-btn red pay-group" data-id="'+item.order_id+'" data-type="'+item.goods_type+'">立即支付</div>'
              break;
            case 2:
              orderStatus = '拼团中'
              statusButton = ''
              expiredTime = '<div class="info">结束时间：'+item.form_data.group_buy_order_info.expired_time+'</div>';
              break;
            case 3:
              orderStatus = '拼团成功'
              statusButton = '<div class="group-btn white see-order">查看订单</div><div class="group-btn yellow once-more" data-id="'+item.form_data.goods_info[0].goods_id+'">再拼一次</div>'
              expiredTime = '<div class="info">结束时间：'+item.form_data.group_buy_order_info.expired_time+'</div>';
              break;
            case 4:
              orderStatus = '拼团失败'
              statusButton = '<div class="group-btn white confirm-money" data-id="'+item.order_id+'">已收到退款</div><div class="group-btn yellow once-more" data-id="'+item.form_data.goods_info[0].goods_id+'">再拼一次</div>'
              expiredTime = '<div class="info">结束时间：'+item.form_data.group_buy_order_info.expired_time+'</div>';
              break;
            case 5:
              orderStatus = '已关闭'
              statusButton = '<div class="group-btn yellow once-more" data-id="'+item.form_data.goods_info[0].goods_id+'">再拼一次</div>'
              break;
            default: orderStatus = ''
          }

          html += '<div class="orders"><div class="head"><div class="order-time">下单时间:'+item.add_time+'</div><div class="order-status">'+orderStatus+'</div></div><div class="goods-detail"><div class="goods-wrap" data-id="'+item.order_id+'"><img src="'+item.form_data.goods_info[0].cover+'" /><div class="middle"><div class="goods-name">'+item.form_data.goods_info[0].goods_name+'</div><div class="goods-spec">'+(item.form_data.goods_info[0].model_value || '')+'</div></div><div class="price"><div class="pay-price">￥'+item.form_data.goods_info[0].price+'</div><div class="origin-price">￥'+item.form_data.original_price+'</div><div class="num">x'+item.form_data.goods_info[0].num+'</div></div></div><div class="group-info"><div class="info">团长昵称：'+item.form_data.group_buy_order_info.leader_username+'</div><div class="info">拼团进度：'+item.form_data.group_buy_order_info.max_user_num+'人团|已拼'+item.form_data.group_buy_order_info.current_user_count+'人，还差'+(item.form_data.group_buy_order_info.max_user_num - item.form_data.group_buy_order_info.current_user_count)+'人成团</div>'+expiredTime+'</div></div><div class="order-info">共'+item.form_data.goods_info[0].num+'件商品 合计：￥<text style="font-size:30rpx;">'+item.total_price+'</text> (含运费￥'+item.express_fee+')</div><div class="order-btn">'+statusButton+'</div></div>';
        })
        $('#myGroup .list').children().remove();
        $('#myGroup .list').append(html);
      };

      _myGroup.switchGroupType = function(para){
        is_leader_order = para;
        current_status = 0;
        $('#myGroup .sub-tabs .active-sub-tab').removeClass('active-sub-tab');
        $('#myGroup .sub-tabs .status').first().addClass('active-sub-tab');
        if(para == 0){
          $('#myGroup .sub-tabs .leader').hide();
        }else{
          $('#myGroup .sub-tabs .leader').show();
        }
        _myGroup.requestData();
      }

      _myGroup.switchGroupStatus = function(para){
        current_status = para;
        _myGroup.requestData();
      }

      _myGroup.requestData = function(){
        $.ajax({
          url: '/index.php?r=AppGroupBuy/MyGroupBuy',
          data: {
            app_id: appId,
            is_leader_order: is_leader_order,
            current_status : current_status, //0:全部 1:已过期 2:进行中 3:未进行
            page : 1,
            page_size : 999
          },
          dataType: 'json',
          success: function(data){
            _myGroup.modifyMyGroupList(data);
          }
        })
      }

      _myGroup.payGroup = function(para){
        $.ajax({
          url: '/index.php?r=AppShop/GetWxWebappPaymentCode',
          data: {
            app_id: appId,
            order_id : para
          },
          dataType: 'json',
          success: function(){
            _myGroup.requestData;
          }
        })
      }

      _myGroup.cancelOrder = function(para){
        $.ajax({
          url: '/index.php?r=AppShop/CancelOrder',
          data: {
            app_id: appId,
            order_id : para
          },
          dataType: 'json',
          success: function(){
            _myGroup.requestData;
          }
        })
      }


    }

    function groupRulesPage() {
      var _groupRules = this;

      _groupRules.initial = function(data) {

      };

    }

    function groupOrderDetailPage(){
      var _groupOrder = this;

      _groupOrder.initialPage = function(data){
        var data = data.data,
            $groupOrder = $('#groupOrderDetail'),
            orderStatus = '',
            statusButton = '',
            headImg = '';

        switch(Number(data.form_data.group_buy_order_info.current_status)){
          case 1:
            orderStatus = '待付款'
            statusButton = '<div class="btn white cancel-group" data-id="'+data.order_id+'">取消拼团</div><div class="btn red pay-group" data-id="'+data.order_id+'" data-type="'+data.goods_type+'">立即支付</div>'
            $groupOrder.find('.centent').eq(3).hide()
            $groupOrder.find('.centent').eq(4).hide()
            break;
          case 2:
            orderStatus = '拼团中'
            statusButton = ''
            $groupOrder.find('.centent').eq(3).hide()
            $groupOrder.find('.centent').eq(4).hide()
            break;
          case 3:
            orderStatus = '拼团成功'
            statusButton = '<div class="btn white see-order">查看订单</div><div class="btn yellow once-more" data-id="'+data.form_data.goods_info[0].goods_id+'">再拼一次</div>'
            $groupOrder.find('.centent').eq(3).show()
            $groupOrder.find('.centent').eq(4).show()
            break;
          case 4:
            orderStatus = '拼团失败'
            statusButton = '<div class="btn white confirm-money" data-id="'+data.order_id+'">已收到退款</div><div class="btn yellow once-more" data-id="'+data.form_data.goods_info[0].goods_id+'">再拼一次</div>'
            $groupOrder.find('.centent').eq(3).hide()
            $groupOrder.find('.centent').eq(4).hide()
            break;
          case 5:
            orderStatus = '已关闭'
            statusButton = '<div class="btn yellow once-more" data-id="'+data.form_data.goods_info[0].goods_id+'">再拼一次</div>'
            $groupOrder.find('.centent').eq(3).hide()
            $groupOrder.find('.centent').eq(4).hide()
            break;
          default: orderStatus = ''
        }
        switch(data.form_data.group_buy_order_info.team_member_list.length){
          case 0:
            headImg = ''
            break;
          case 1:
            headImg = '<div class="group-leader"><img src="'+data.form_data.group_buy_order_info.team_member_list[0].thumb+'"/><div class="tag">团长</div></div><div class="omit">...</div><div class="more-members">?</div>'
            break;
          case 2:
            headImg = '<div class="group-leader"><img src="'+data.form_data.group_buy_order_info.team_member_list[0].thumb+'"/><div class="tag">团长</div></div><img class="members" src="'+data.form_data.group_buy_order_info.team_member_list[1].thumb+'"/><div class="omit">...</div><div class="more-members">?</div>'
            break;
          case 3:
            headImg = '<div class="group-leader"><img src="'+data.form_data.group_buy_order_info.team_member_list[0].thumb+'"/><div class="tag">团长</div></div><img class="members" src="'+data.form_data.group_buy_order_info.team_member_list[1].thumb+'"/><img class="members" src="'+data.form_data.group_buy_order_info.team_member_list[2].thumb+'"/><div class="omit">...</div><div class="more-members">?</div>'
            break;
          case 4:
            headImg = '<div class="group-leader"><img src="'+data.form_data.group_buy_order_info.team_member_list[0].thumb+'"/><div class="tag">团长</div></div><img class="members" src="'+data.form_data.group_buy_order_info.team_member_list[1].thumb+'"/><img class="members" src="'+data.form_data.group_buy_order_info.team_member_list[2].thumb+'"/><img class="members" src="'+data.form_data.group_buy_order_info.team_member_list[3].thumb+'"/><div class="omit">...</div><div class="more-members">?</div>'
            break;
          default:
            headImg = '<div class="group-leader"><img src="'+data.form_data.group_buy_order_info.team_member_list[0].thumb+'"/><div class="tag">团长</div></div><img class="members" src="'+data.form_data.group_buy_order_info.team_member_list[1].thumb+'"/><img class="members" src="'+data.form_data.group_buy_order_info.team_member_list[2].thumb+'"/><img class="members" src="'+data.form_data.group_buy_order_info.team_member_list[3].thumb+'"/><div class="omit">...</div><div class="more-members">?</div>'
        }
        $groupOrder.find('.team-token').html(data.form_data.team_token);
        $groupOrder.find('.order-status div').first().html(orderStatus);
        $groupOrder.find('.group-btn').html(statusButton);
        $groupOrder.find('.mail-man').html(data.form_data.address_info.name);
        $groupOrder.find('.mail-phone').html(data.form_data.address_info.contact);
        $groupOrder.find('.mail-address').html(data.form_data.address_info.province.text+data.form_data.address_info.city.text+data.form_data.address_info.district.text+data.form_data.address_info.detailAddress);
        $groupOrder.find('.massage').html(data.form_data.remark);
        $groupOrder.find('.order-id span').html(data.form_data.order_id);
        $groupOrder.find('.goods-wrap img').attr('src',data.form_data.goods_info[0].cover);
        $groupOrder.find('.pay-price span').html(data.form_data.goods_info[0].original_price);
        $groupOrder.find('.origin-price span').html(data.form_data.group_buy_order_info.discount_price);
        $groupOrder.find('.num span').html(data.form_data.goods_info[0].num);
        $groupOrder.find('.middle .goods-name').html(data.form_data.goods_info[0].goods_name);
        $groupOrder.find('.middle .goods-spec').html(data.form_data.goods_info[0].model_value);
        $groupOrder.find('.discount .icon-group-pay').siblings('span').html(data.form_data.use_balance);
        $groupOrder.find('.discount .icon-coupon').siblings('span').html(data.form_data.selected_benefit.title);
        $groupOrder.find('.order-info span').first().html(data.form_data.goods_info[0].num);
        $groupOrder.find('.order-info span').last().html(data.express_fee);
        $groupOrder.find('.order-info .red-price span').html(data.form_data.total_price);
        $groupOrder.find('.head-logo').html(headImg);
        $groupOrder.find('.total-mumber text').eq(0).html(data.form_data.group_buy_order_info.current_user_count);
        $groupOrder.find('.total-mumber text').eq(1).html(data.form_data.group_buy_order_info.max_user_num - data.form_data.group_buy_order_info.current_user_count);
        $groupOrder.find('.centent').eq(0).children('span').html(data.form_data.add_time);
        $groupOrder.find('.centent').eq(1).children('span').html(data.form_data.group_buy_order_info.max_user_num);
        $groupOrder.find('.centent').eq(2).children('span').first().html(data.form_data.group_buy_order_info.hour_of_duration);
        $groupOrder.find('.centent').eq(2).children('span').last().html(data.form_data.group_buy_order_info.minute_of_duration);
        $groupOrder.find('.centent').eq(3).children('span').html(data.form_data.group_buy_order_info.expired_time);
        $groupOrder.find('.centent').eq(4).children('span').html(data.form_data.group_buy_order_info.success_time);
      }
    }

    function groupCenterPage() {
      var _groupCenter = this;
      var page = 1;

      _groupCenter.modifyGroupCenterList = function(data) {
        $('#groupCenter').addClass('js-requesting');
        $('#groupCenter .list').children().remove();
        var html = '';
        //console.log(data);
        $(data.data).each(function(index,item){
          var imgHtml = '';
          var hasGroup = item.group_buy_team_count === 0;
          $(item.group_buy_team_list).each(function(i,img){
            imgHtml += '<img src="'+img.leader_thumb+'">'
          })
          html += '<div class="goods" onclick="turnToGoodsDetail('+item.goods_id+')"><img class="goods-img" src="'+item.goods_img+'"><div class="info"><div class="title">'+item.goods_title+'</div><div class="group-price">拼团价：￥<span>'+item.normal_min_price+'</span>~￥<span>'+item.normal_max_price+'</span><div class="discount-tag">减价</div></div><div class="single-price">单买价：￥'+item.goods_price+'</div><div class="grouping '+(hasGroup?'hide':'')+'"><span>'+item.group_buy_team_count+'个进行中的团：</span>'+ imgHtml +'</div><div class="grouping '+(hasGroup?'':'hide')+'"><span>暂无进行中的团</span></div></div></div>'
        });
        $('#groupCenter .list').append(html);
        $('#groupCenter').removeClass('js-requesting');
      };

      _groupCenter.getListData = function(){
        $('#groupCenter').addClass('js-requesting');
        $.ajax({
          url: '/index.php?r=AppGroupBuy/GetGroupBuyGoodsList',
          data: {
            app_id: appId,
            current_status : 2, //0:全部 1:已过期 2:进行中 3:未进行
            page : 1,
            page_size : 999
          },
          dataType: 'json',
          success: function(data){
            var html = '';
            $(data.data).each(function(index,item){
              var imgHtml = '';
              var hasGroup = item.group_buy_team_count === 0;
              $(item.group_buy_team_list).each(function(i,img){
                imgHtml += '<img src="'+img.leader_thumb+'">'
              });
              html += '<div class="goods" onclick="turnToGoodsDetail('+item.goods_id+')"><img class="goods-img" src="'+item.goods_img+'"><div class="info"><div class="title">'+item.goods_title+'</div><div class="group-price">拼团价：￥ <span>'+item.normal_min_price+'</span>~￥ <span>'+item.normal_max_price+'</span><div class="discount-tag">减价</div></div><div class="single-price">单买价：￥'+item.goods_price+'</div><div class="grouping '+(hasGroup?'hide':'')+'"><span>'+item.group_buy_team_count+'个进行中的团：</span>'+ imgHtml +'</div><div class="grouping '+(hasGroup?'':'hide')+'"><span>暂无进行中的团</span></div></div></div>'
            });
            $('#groupCenter .list').append(html);
            $('#groupCenter').removeClass('js-requesting');
          }
        })
      };

      _groupCenter.scrollBottomTest = function(){
        $("#groupCenter .list").scroll(function(){
          console.log('11');
          var $this =$(this),
              viewH =$(this).height(),//可见高度
              contentH =$(this).get(0).scrollHeight,//内容高度
              scrollTop =$(this).scrollTop();//滚动高度
          if(scrollTop/(contentH - viewH)>=0.95){ //到达底部100px时,加载新内容
            _groupCenter.getListData();// 加载数据..
          }
        });
      }
    }
    // 大转盘
    function luckyWheelDetail(){
      var _wheelDetail=this,
          activityData = {};

    _wheelDetail.modifypromotionWheelDetail=function(data){

      activityData = data.data;
      $(document).attr("title", activityData.title);
      $('#luckyWheelDetail .lucky-cantaniner').attr('src', activityData.background);
      $('#luckyWheelDetail .todayChance span').text(activityData.times);
      $('#luckyWheelDetail .personNum span').text(activityData.joined_show);
      $('#luckyWheelDetail .textValue').html(activityData.description.replace(/\\n/g,"<br>"));
      $('#luckyWheelDetail .specific-time').text(activityData.start_time+'-'+activityData.end_time);
      $('#luckyWheelDetail .prizedTotalBox span').text(activityData.user_times_initial);
      activityData.joined_show=='-1'?$('#luckyWheelDetail .personNum').css('display','none'):$('#luckyWheelDetail .personNum').css('display','inline-block');
      activityData.user_times=='-1'?$('#luckyWheelDetail .drawTotalTimes span').text('无数'):$('#luckyWheelDetail .drawTotalTimes span').text(activityData.user_times);
      activityData.time_share=='0'?$('#luckyWheelDetail .sharesTimes span:nth-child(1)').text('0'):$('#luckyWheelDetail .sharesTimes span:nth-child(1)').text(activityData.time_share);
      activityData.time_share_limit=='0'?$('#luckyWheelDetail .sharesTimes span:nth-child(2)').text('0'):$('#luckyWheelDetail .sharesTimes span:nth-child(2)').text(activityData.time_share_limit);
      if(activityData.time_share=='0'){
        $('#luckyWheelDetail .sharesTimes').hide();
      }else{
        $('#luckyWheelDetail .sharesTimes').show();
      }
      if(activityData.integral_exchange=='0'){
        $('#luckyWheelDetail .exchangeTimes span').text('0');
        $('#luckyWheelDetail .exchangePrize').css('display','none');
        $('#luckyWheelDetail .exchangeTimes').hide();
      }else{
        $('#luckyWheelDetail .exchangeTimes span').text(activityData.integral_exchange);
        $('#luckyWheelDetail .exchangePrize').css('display','inline-block');
         $('#luckyWheelDetail .exchangeTimes').show();
      }
      if(activityData.category==0){
        $('#plateDiv').hide();
        $('#luckyWheelDetail .outDiv').show();
        $('#tip').attr('data-id',activityData.id);
        $('#luckyWheelDetail .motive img').attr("src","http://cdn.jisuapp.cn/static/webapp/images/phone-motive.png");
        $('#luckyWheelDetail .motive').css({height:"75px",marginTop:"40px"});
        $.each(activityData.turntable,function(index,item){
          $('.zp'+(index+1)).attr('data-id',item.id);
          $('.zp'+(index+1)).find('span').text(item.prize_title);
          $('.zp'+(index+1)).find('img').attr('src',item.prize_logo);
        })
        $('.phoneCx').css('background','rgba(243,190,30,.3)');
        $('.todayChance').css("color","#6b3600");
        $('.todayChance span').css("color","#ff090f");
        $('.personNum').css("color","#6b3600");
        $('.personNum span').css("color","#ff090f");
        $('.winCon').css("background","#AE2C53");
        $('.strip-content').css("background","#AE2C53");
      }else if(activityData.category==1){
        $('.phoneCx').css('background','rgba(97,65,116,.6)');
        $('#plateDiv').show();
        $('#luckyWheelDetail .outDiv').hide();
        $('#plate_img').attr('data-id',activityData.id)
        $('#luckyWheelDetail .motive img').attr("src","http://cdn.jisuapp.cn/static/webapp/images/phone-surprise.png");
        $('#luckyWheelDetail .motive').css({height:"173px",marginTop:"5px"});

        $.each(activityData.turntable,function(index,item){
          $('.zf'+index).attr('data-id',item.id);
          $('.zf'+index).find('p').text(item.prize_title);
          $('.zf'+index).find('img').attr('src',item.prize_logo);
        })

        $('.todayChance').css("color","#fff");
        $('.todayChance span').css("color","#fed932");
        $('.personNum').css("color","#fff");
        $('.personNum span').css("color","#fed932");
        $('.winCon').css("background","#6b4780");
        $('.strip-content').css("background","#6b4780");
        
      }

      
      if(activityData.bgm=='0'){
        $('.pageMusic').hide();
        $('#luckyAudio')[0].pause();
        $('.pageMusic').removeClass('active');
      }else{
        $('#luckyAudio').attr('src',activityData.bgm);
        $('#luckyAudio')[0].play();
        $('.pageMusic').addClass('active');
        
      }
      _wheelDetail.bindEvents();
      _wheelDetail.getWinnerList(activityData.id);
       
    }

     var  isBindEvents=false;
    _wheelDetail.bindEvents=function(){
      if(isBindEvents){
        return;
      }
      isBindEvents=true;
      $('.Congratulations_sick').on('click','.Congratulations-confirm',function(){
        $('.Congratulations_sick').hide();
      }).on('click','.Congratulations-share',function(){
         $('.Congratulations_sick').hide();
        
      })
      $('#notwinning_sick').on('click','.notwinning_confirm',function(){
        $('#notwinning_sick').hide();
      }).on('click','.notwinning_share',function(){
        $('#notwinning_sick').hide();
        
        
      })
      //安慰奖弹窗
      $('.consolation_sick').on('click','.consolation_confirm',function(){
        $('.consolation_sick').hide();
      }).on('click','.consolation_share',function(){
        $('.consolation_sick').hide();
      })
      //我的奖品
      $('.pageMusic').on('click',function(){
       
        if($('#luckyAudio')[0].paused){
           $('#luckyAudio')[0].play();
           $('.pageMusic').addClass('active');
         }else{
           $('#luckyAudio')[0].pause();
           $('.pageMusic').removeClass('active');
         }
      })
      $('.lookPrize').on('click',function(){
        $('.record_sick').show();
        _wheelDetail.getMyPrize();
      })
      //点击我的中奖记录之外隐藏
      $('.record_sick').on('click',function(event){
        var _con=$('.record_wrap');
        if(!_con.is(event.target) && (_con.has(event.target).length ===0)){
          $('.record_sick').hide();
        }
      })
      //点击积分兑换按钮
      $('.exchangePrize').on('click',function(){
        $('.exchange').show();
        _wheelDetail.getMyIntegral();
      })
      //积分兑换弹窗
      $('.exchange').on('click','.exchange-confirm',function(){
        var num=$('.exchangeLimit input').val();
        _wheelDetail.getTime(num)
      }).on('click','.exchange-cancel',function(){
        $('.exchange').hide();
      }).on('click','.allSale',function(){
        var atimes=$('#luckyWheelDetail .exchangeCan span:nth-child(1)').text();
        $('.exchangeLimit input').val(atimes);
      })
      //次数用尽弹窗
      $('.duraMaxDiv').on('click','.duraMaxDiv-cancel',function(){
       $('.duraMaxDiv').hide();
      }).on('click','.duraMaxDiv-confirm',function(){
        $('.duraMaxDiv').hide();
      })
       //次数用尽不可分享好友弹窗
      $('.degreeDiv').on('click','.degreeDiv-cancel',function(){
       $('.degreeDiv').hide();
      }).on('click','.degreeDiv-confirm',function(){
        $('.degreeDiv').hide();
      })
     
      $("#plate_img").click(function(){
        if(parseInt($('.todayChance span').text())<=0){
          if(activityData.time_share==0){
          $('.degreeDiv').show();
          }else{
          $('.duraMaxDiv').show();
          }
        }else{
          if($('#plateDiv').hasClass('loading')){
            return;
          }
          $('#plateDiv').addClass('loading');
          _wheelDetail.prizeClisk( activityData.id );
        }
       
      });
       
      lottery.init('plateDiv');
     
      $('#tip').click(function (){
      if(parseInt($('.todayChance span').text())<=0){
        if(activityData.time_share==0){
        $('.degreeDiv').show();
        }else{
        $('.duraMaxDiv').show();
        }
      }else{
        if($('.outDiv').hasClass('loading')){
            return;
          }
          $('.outDiv').addClass('loading');
        _wheelDetail.prizeClisk( activityData.id );
      }
      });
      
    }


    var rotateFn = function ( angles, txt,id){
      $('.outer-cont').stopRotate();
      $('.outer-cont').rotate({
        angle:0,
        animateTo:angles+1800,
        duration:3000,
        callback:function (){
          if(id.is_comfort==1){
            $('.consolation_sick').show();
            _wheelDetail.getWinnerList(activityData.id);
          }else{
            if(txt=="谢谢参与"){
            $('.notwinning_sick').show();
          }else{
              $('.Congratulations_sick').show();
              $('.Congratulations-con span').text(txt); 
              _wheelDetail.getWinnerList(activityData.id);
          }
           $('.outDiv').removeClass('loading');
          }
          
        }
      })
    };

    // 圓的大转盘
    _wheelDetail.circleLottery = function(id){

      var index = _wheelDetail.getIndex(id.turntable_id),
          runDegs = (360 * 5 - index * (360 / 8) - 22.5);

      rotateFn( runDegs  , activityData.turntable[index].prize_title,id );
      

    }

    //方盘事件
    var lottery = {
      index: -1,    //当前转动到哪个位置，起点位置
      count: 8,    //总共有多少个位置
      timer: 0,    //setTimeout的ID，用clearTimeout清除
      speed: 20,    //初始转动速度
      times: 0,    //转动次数
      cycle: 32,    //转动基本次数：即至少需要转动多少次再进入抽奖环节
      prize: -1, 
      num: $('.todayChance span').text(),
        //中奖位置
      init: function(id){
        if ($("#"+id).find(".zf").length > 0) {
          $lottery = $("#"+id);
          $units = $lottery.find(".zf");
          this.obj = $lottery;
          this.count = $units.length;
          $lottery.find(".zf"+this.index).addClass("active");
        };
      },
      rolls: function(){
        var index = this.index;
        var count = this.count;
        var $lottery = this.obj;
        $lottery.find(".zf"+index).removeClass("active");
        index += 1;
        if (index>count-1) {
            index = 0;
        };
        $lottery.find(".zf"+index).addClass("active");
        this.index=index;
        return false;
      }
    };


    // 方的大转盘
    _wheelDetail.squareLottery = function(id){
      var index = _wheelDetail.getIndex(id.turntable_id);

      lottery.speed=100;

      function drawRolls(){
        lottery.times += 1;

        lottery.rolls(); 

        if (lottery.times > lottery.cycle+10 && lottery.prize == lottery.index) {
            clearTimeout( lottery.timer );
            lottery.prize = -1;
            lottery.times = 0;
             if(id.is_comfort==1){
              $('.consolation_sick').show();
              _wheelDetail.getWinnerList(activityData.id);
             }else{
              if($('.zf'+lottery.index).find('p').text()=="谢谢参与"){
              $('.notwinning_sick').show();
              }else{
                
                  $('.Congratulations_sick').show();
                  $('.Congratulations-con span').text($('.zf'+lottery.index).find('p').text());
                _wheelDetail.getWinnerList(activityData.id);
              }
             }
            $('#plateDiv').removeClass('loading');

        }else{
            if (lottery.times<lottery.cycle) {
                lottery.speed -= 10;
            }else if(lottery.times==lottery.cycle) {
                
                lottery.prize = index; 
                 
            }else{
                if (lottery.times > lottery.cycle+10 && ((lottery.prize==0 && lottery.index==7) || lottery.prize==lottery.index+1)) {
                    lottery.speed += 110;
                }else{
                    lottery.speed += 20;
                }
            }
            if (lottery.speed<40) {
                lottery.speed=40;
            };
            lottery.timer = setTimeout( drawRolls, lottery.speed );//循环调用
        }

        return false;
      }

      drawRolls(index);
      
       
    }

    _wheelDetail.getIndex = function(winId){
      var list = activityData.turntable,
          idx = 0;

      for(var i = 0 ; i < list.length ; i++){
        if(list[i].id == winId){
          idx = i;
        }
      }

      return idx;
    }
    _wheelDetail.getWinnerList = function(id){
      //中奖名单
     $.ajax({
        url:"/index.php?r=appLotteryActivity/getWinnerList",
        type:"post",
        dataType:"json",
        data:{
          activity_id:id
        },
        success:function(data){
          if(data.status!=0){alertTip(data.data);return;}
          var $li='';
          $.each(data.data,function(i,ele){
             $li+='<li>'+ele.nickname+' 抽中 '+ele.prize_title+'</li>';
          })
          $('.winList .winCon ul').html($li);
        }
      })
    },
    //积分数据
    _wheelDetail.getMyIntegral=function(){
      $.ajax({
        url:"/index.php?r=appLotteryActivity/getMyIntegralExchangeTimes",
        type:"post",
        dataType:"json",
        data:{
          activity_id:activityData.id
        },
        success:function(data){

          if(data.status!=0){alertTip(data.data);return;}
          $('.exchangeCan span:nth-child(1)').text(data.data.exchange_times);
          $('.exchangeRule span').text(data.data.integral_exchange);
          $('.exchangeBalance span').text(data.data.can_use_integral)
        }
      })
    }
    _wheelDetail.getTime=function(num){
      $.ajax({
        url:"/index.php?r=appLotteryActivity/getTime",
        type:"post",
        dataType:"json",
        data:{
          app_id:appId,
          activity_id:activityData.id,
          type:"integral",
          times:num
        },
        success:function(data){
          if(data.status!=0){alertTip(data.data);return;}
          $('.exchange').hide();
          $('.todayChance span').text(data.data);
        }
      })
    }
    _wheelDetail.prizeClisk = function(ele){
      //点击抽奖按钮进行抽奖
      $.ajax({
        url:"/index.php?r=appLotteryActivity/lottery",
        type:"post",
        dataType:"json",
        data:{
          app_id:appId,
          activity_id:ele
        },
        success:function(data){
          if(data.status!=0){
            alertTip(data.data);
            $('.outDiv').removeClass('loading');
            $('#plateDiv').removeClass('loading');
            return;
          }
          var num=parseInt($('.todayChance span').text());
          num--;
          
          
        $('.todayChance span').text(num);
          if (activityData.category == 0){
            _wheelDetail.circleLottery(data.data);
          }else{
            _wheelDetail.squareLottery(data.data);
          }
        }
      })
     }
     _wheelDetail.getMyPrize = function(){
      //查看我的奖品
      $.ajax({
        url:"/index.php?r=appLotteryActivity/getMyPrize",
        type:"post",
        dataType:"json",
        data:{
          activity_id:activityData.id
        },
        success:function(data){
          if(data.status!=0){alertTip(data.data);return;}
          if(data.data==''){
            $('.record_sick .record_fail').show();
            $('.record_sick .prizeList').hide();
            $('.record_sick .img_con').hide();
          }else{
            $('.record_sick .record_fail').hide();
            $('.record_sick .prizeList').show();
            $('.record_sick .img_con').show();
            var $li='';
            $.each(data.data,function(index,ele){
              $li+='<li><span>'+ele.add_time+'</span><span>'+ele.prize_title+'</span></li>';
            })
            $('.record_sick .prizeList').html($li);
          }
        }
      })
     }
    }
    //中奖记录
    function winningRecord(){
      var _winningRecord=this;
      _winningRecord.modifypromotionWinningRecord=function(data){
       //初始化信息
      $('#winningRecord .record-tab-list>li:nth-child(1)').trigger('click');
      _winningRecord.setTable(data);

      }
      _winningRecord.myPrizeCenter = function(category){
        //获取中奖记录列表
        $.ajax({
          url:"/index.php?r=appLotteryActivity/myPrizeCenter",
          type:"post",
          dataType:"json",
          data:{
            app_id:appId,
            category:category,
            page:1,
            page_size:999
          },
          success:function(data){
            _winningRecord.setTable(data);
          }
        })
      }

      _winningRecord.setTable = function(data){
        var $li='',
            $status='';
        if(data.data==''){
          $('#winningRecord .record-none').show();
          $('.record-luckyWheel ul').hide();
        }else{
        $('#winningRecord .record-none').hide();
        $('.record-luckyWheel ul').show();
        $.each(data.data,function(i,ele){
          if(ele.is_selected==0){
            $status='<span style="color:#ff7100;">未使用</span>';

          }else{
            $status='<span style="color:#ff7100;">已使用</span>';
          }
          $li+='<li data-id="'+ele.coupon_id+'"><div class="record-name">'+ele.prize_level+'：'+ele.prize_title+'</div><div class="record-start"><p>使用日期：'+ele.start_use_date+'至'+ele.end_use_date+'</p>'+$status+'</div><div class="record-end"><p>中奖时间：'+ele.add_time+'</p></div></li>'
        })
        $('.record-luckyWheel ul').html($li);
        
        }
      }
    }
    // 固定body 禁止滚动
    function fixbody() {
      $('body').attr({
        'ontouchmove': 'return false',
        'onmousewheel': 'return false'
      });
    };
    // 恢复body滚动
    function relievebody() {
      $('body').attr({
        'ontouchmove': '',
        'onmousewheel': ''
      });
    };

    function parseSecFontStyle(customFeature) {
      var style = {};
      if (customFeature) {
        if (customFeature.secColor) {
          style.color = customFeature.secColor;
        }
        if (customFeature.secFontSize) {
          style['font-size'] = customFeature.secFontSize;
        }
        if (customFeature.secTextDecoration) {
          style['text-decoration'] = customFeature.secTextDecoration;
        }
        if (customFeature.secTextAlign) {
          style['text-align'] = customFeature.secTextAlign;
        }
        if (customFeature.secFontStyle) {
          style['font-style'] = customFeature.secFontStyle;
        }
        if (customFeature.secFontWeight) {
          style['font-weight'] = customFeature.secFontWeight;
        }
        if (customFeature.lineBackgroundColor) {
          style['background-color'] = customFeature.lineBackgroundColor;
        }
        if (customFeature.secLineHeight) {
          style['line-height'] = customFeature.secLineHeight;
        }
      }
      return style;
    }


});





/**
 * common.js
 */
// 封装ajax请求
function $ajax(url, type, data, dataType, success, error) {
  showLoading();
  $.ajax({
    url: url,
    type: type || 'get',
    data: data || {},
    timeout: 30000,
    dataType: dataType || 'json',
    success: function(data) {
      removeLoading();
      $.isFunction(success) && success(data);
    },
    error: function(jqXHR, textStatus) {
      removeLoading();
      if (textStatus === 'timeout') {
        requestErrorTip();
      } else {
        requestTimeoutTip();
      }
      $.isFunction(error) && error(data);
    }
  });
}
// 展示loading
function showLoading(goal) {
    var _goal = goal || $("body");
    var loading = '<div class="loading_spinner loading_logo"><div class="spinner-container container1">'
        + '<div class="circle1"></div><div class="circle2"></div>'
        + '<div class="circle3"></div><div class="circle4"></div></div>'
                + '<div class="spinner-container container2"><div class="circle1"></div>'
                + '<div class="circle2"></div><div class="circle3"></div>'
                + '<div class="circle4"></div></div><div class="spinner-container container3">'
                + '<div class="circle1"></div><div class="circle2"></div><div class="circle3"></div>'
        + '<div class="circle4"></div></div></div>';
    _goal.append(loading);
}
// 移除loading
function removeLoading() {
  $('.loading_logo').length && $('.loading_logo').eq(0).remove();
}

//
$.tooltip = function(ops) {
  var ops = $.extend({
      html: '',
      delay: 2000,
      callback: null
  }, ops);

  var obj = null,
      text = ops.html,
      html= '<div id="tool_tip" style="position:fixed;z-index:9999999; top:0;width: 100%;height:100%;left:0; opacity:1;'
          + 'color:#fff; text-align:center; font-size:18px; font-weight:bold"><span style="display:inline-block;width:auto;max-width:90%;padding:8px 15px; margin-top: 60%;background:rgba(0,0,0,0.7);border-radius:3px;">'
          + text +'</span></div>';

  $('#tool_tip').remove();
  obj = $(html).appendTo('body').on('click', function() {
    $(this).off('click').remove();
  });

  setTimeout(function() {
    obj.animate({
      opacity: 0
    }, 500, 'linear', function() {
      obj.off('click').remove();
      $.isFunction(ops.callback) && ops.callback();
    });
  }, ops.delay);
};

//弹默认提示框
function alertTip(html, callback, delay) {
  $.tooltip({
    'html': html || '',
    'delay': $.isNumeric(callback) ? callback : (delay ? delay : 1500),
    'callback': $.isFunction(callback) ? callback : null
  });
}
//请求error提示框
function requestErrorTip() {
  alertTip('请求异常');
}
// 请求超时提示框
function requestTimeoutTip() {
  alertTip('网络状况可能不太好喔');
}

// 获取页面url的参数
function GetQueryString(name) {
  var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"),
      r = window.location.search.substr(1).match(reg);

  if (r != null) {
    return decodeURIComponent(r[2]);
  }
  return null;
}

function modifyTargetUrl(para) {
  var location = window.location,
	    search = location.search,
	    reg, match;

  if (!para || !$.isPlainObject(para)) {
    alertTip('error para');
    return;
  }

  $.each(para, function(key, value) {
    reg = new RegExp('&' + key + '=[^&]*');
    search = search.replace(reg, '');
    if(value && value !== 'undefined'){
      search += '&' + key + '=' + value;
    }
  });

  return location.origin + location.pathname + search + location.hash;
}

function clearWeixinHash(url) {
  var index;
  if (!url) {
    // alertTip('empty url');
    return;
  }
  if (url.indexOf('weixin.qq.com') >= 0) {
    index = url.indexOf('#');
    index >= 0 && (url = url.substr(0, index));
  }
  return url;
}
// 获取cookie里的参数
function GetCookiePara(name) {
  var name = name || 'PHPSESSID',
      reg = new RegExp("(^|\\D)" + name + "=([^&]*?)($|;)"),
      r = document.cookie.match(reg);

  if (r != null) {
    return decodeURIComponent(r[2]);
  }
  return null;
}
// 检测是否符合手机规格
function checkIfPhone(phone) {
  var regmTel = /^1\d{10}$/;
  if (regmTel.test(phone.trim())) {
    return true;
  } else {
    return false;
  }
}

function isEmptyObject(obj) {
  for (var name in obj) {
    return false;
  }
  return true;
};

function getTimeStr(para) {
  var now = para ? new Date(para) : new Date(),
      year = now.getFullYear(), //年
      month = now.getMonth() + 1, //月
      day = now.getDate(), //日
      hh = now.getHours(), //时
      mm = now.getMinutes(), //分
      clock = year + "-";

  if (month < 10)
    clock += "0";

  clock += month + "-";

  if (day < 10)
    clock += "0";

  clock += day + " ";

  if (hh < 10)
    clock += "0";

  clock += hh + ":";
  if (mm < 10) clock += '0';
  clock += mm;

  return (clock);
}
// 异步请求文件
function asyLoadScript(filename, fileType, callback) {
  var container = document.getElementsByTagName('body')[0],
      node;
  if (fileType == "js") {
    var oJs = document.createElement('script');
    oJs.setAttribute("type", "text/javascript");
    oJs.setAttribute("src", filename); //文件的地址 ,可为绝对及相对路径
    container.appendChild(oJs); //绑定
    node = oJs;
  } else if (fileType == "css") {
    var oCss = document.createElement("link");
    oCss.setAttribute("rel", "stylesheet");
    oCss.setAttribute("type", "text/css");
    oCss.setAttribute("href", filename);
    container.appendChild(oCss); //绑定
    node = oCss;
  }
  node.onload = function() {
    $.isFunction(callback) && callback();
  }
}
// 配置页面微信接口
function configWxSDK() {
	$.ajax({
		url : 'http://www.zhichiwangluo.com/index.php?r=Share/appJsConfig',
		type: 'get',
		data: null,
      dataType: 'json',
      success: function(data) {
          if (data.status === 0) {
              wx.config({
                  debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                  appId: data.appId, // 必填，公众号的唯一标识
                  timestamp: data.timestamp, // 必填，生成签名的时间戳
                  nonceStr: data.nonceStr, // 必填，生成签名的随机串
                  signature: data.signature, // 必填，签名，见附录1
                  jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'openLocation'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
              });
          }
      }
  });
};
//微信分享设置
function configWxShare(data) {
  wx.onMenuShareTimeline({
    title: data.app_name, // 分享标题
		// link: data.link, // 分享链接
    imgUrl: data.cover, // 分享封面
    type: data.type || '', // 分享类型,music、video或link，不填默认为link
    dataUrl: data.dataUrl || '', // 如果type是music或video，则要提供数据链接，默认为空
    success: function(msg) {
      // 用户确认分享后执行的回调函数
      $.isFunction(data.success) && data.success();
    },
    cancel: function(msg) {
      // 用户取消分享后执行的回调函数
      $.isFunction(data.cancel) && data.cancel();
    },
    fail: function(msg) {
      console.log(msg);
    }
  });

  wx.onMenuShareAppMessage({
    title: data.app_name, // 分享标题
    desc: data.description, // 分享描述
		// link: data.link, // 分享链接
    imgUrl: data.logo, // 分享图标
    type: data.type || '', // 分享类型,music、video或link，不填默认为link
    dataUrl: data.dataUrl || '', // 如果type是music或video，则要提供数据链接，默认为空
    success: function(msg) {
      // 用户确认分享后执行的回调函数
      $.isFunction(data.success) && data.success();
    },
    cancel: function(msg) {
      // 用户取消分享后执行的回调函数
      $.isFunction(data.cancel) && data.cancel();
    },
    fail: function(msg) {
      console.log(msg);
    }
  });
};

function OpenWeixinMap(data) {
  var lat = +data.lat,
      lng = +data.lng,
      address = data.address;

  wx.openLocation({
    latitude: lat,
    longitude: lng,
    name: '',
    address: address,
    scale: 13,
    fail:function(res){
      alert(res.errMsg);
    }
  });
}

function confirmTip(option, confirmCallback, cancelCallback) {
  var $modal = $('#confirmModal');

  $modal.find('.modal-body').html(option.content);

  $('.confirmModal-confirm').off('click').on('click', function() {
    $modal.css('display', 'none').removeClass('in');
    $('.modal-backdrop').remove();
    $.isFunction(confirmCallback) && confirmCallback();
  }).text(option.confirmText || '确定');

  $('.confirmModal-cancel').off('click').on('click', function() {
    $modal.css('display', 'none').removeClass('in');
    $('.modal-backdrop').remove();
    $.isFunction(cancelCallback) && cancelCallback();
  }).text(option.cancelText || '取消');



  $modal.css('display', 'block');
  setTimeout(function() {
    $modal.addClass('in');
  }, 100);
  $('.modal-backdrop').length || $('body').append('<div class="modal-backdrop fade in"></div>');
}

function isScrollToBottom(container, content, threshold) {
  var $container = $(container).length ? $(container) : $(window),
      containerHeight = $container.height(),
      scrollTop = $container.scrollTop(),
      $content = $(content).length ? $(content) : $('body'),
      contentHeight = $content.height(),
      t = threshold || 50;

  return (contentHeight - containerHeight - scrollTop < t);
}

// 图片根据外框等比例自适应
function photovoteLoad(img){
  var _w ,
    _h ,
    _div = $(img).parent( ),
    _div_w = _div.width(),
    _div_h = _div.height(),
    ra1 ;

  if( img.naturalWidth ){ // HTML5 browsers  --- Fixefox/Chrome/Safari/Opera/IE9
    _w = img.naturalWidth;
    _h = img.naturalHeight;
  }else{
    var i = new Image();
    i.src = img.src;
    _w = i.width;
    _h = i.height;
  }
  ra1 = _w / _h;

  if( ra1 > _div_w / _div_h){
    img.style.height = '100%';
    img.style.width = 'auto'
    img.style.marginLeft = '-' + (ra1 * _div_h - _div_w) / 2 + 'px';
  }else{
    img.style.height = 'auto';
    img.style.width = '100%'
    img.style.marginTop = '-' + (_div_w / ra1 - _div_h) / 2 + 'px';
  }
}

//字符长度
//获得字符串实际长度，中文2，英文1
function stringLength(str) {
  var realLength = 0, len = str.length, charCode = -1;
  for (var i = 0; i < len; i++) {
    charCode = str.charCodeAt(i);
    if(charCode > 128){
        realLength += 2;
    }else{
        realLength +=1;
    }
  }
  return realLength;
};
// 截取字符串 中文2，英文1
function subString(str, len) {
  var newLength = 0 ,
      newStr = "" ,
      chineseRegex = /[^\x00-\xff]/g ,
      singleChar = "",
      strLength = str.replace(chineseRegex,"**").length;
  for(var i = 0;i < strLength;i++) {
    singleChar = str.charAt(i).toString();
    if(singleChar.match(chineseRegex) != null) {
        newLength += 2;
    }else {
        newLength++;
    }
    if(newLength > len) {
        break;
    }
    newStr += singleChar;
  }
  if(strLength > len) {
    newStr += "...";
  }
  return newStr;
}

// 时间比较
function compareTime(start , end) {
  var startTime = new Date(start).getTime(),
      endTime = new Date(end).getTime();

  return startTime < endTime;
}

function downCount(opt) {
  var opt = $.extend({
                ele : null ,
                startTime : null,
                endTime : null
            }, opt),
      agent = navigator.userAgent.toLowerCase(),
      isiphone = agent.indexOf('iphone') != -1 || agent.indexOf('ipad') != -1;

  if(isiphone && /\-/g.test(opt.endTime)){
    opt.endTime = opt.endTime.replace(/\-/g , '/');
  }
  if(isiphone && /\-/g.test(opt.startTime)){
    opt.startTime = opt.startTime.replace(/\-/g , '/');
  }
  if(/^\d+$/.test(opt.endTime)){
    opt.endTime = opt.endTime * 1000;
  }
  if(/^\d+$/.test(opt.startTime)){
    opt.startTime = opt.startTime * 1000;
  }

  var container = opt.ele;
      target_date = new Date(opt.endTime),
      current_date = new Date(opt.startTime);

  var interval ,
      isfirst = true,
      difference = target_date - current_date;

  function countdown () {
      if (difference < 0) {
          clearInterval(interval);
          if (opt.callback && typeof opt.callback === 'function'){opt.callback();};
          return;
      }

      var _second = 1000,
          _minute = _second * 60,
          _hour = _minute * 60;

      var hours = Math.floor(difference / _hour),
          minutes = Math.floor((difference % _hour) / _minute),
          seconds = Math.floor((difference % _minute) / _second);

          hours = (String(hours).length >= 2) ? hours : '0' + hours;
          minutes = (String(minutes).length >= 2) ? minutes : '0' + minutes;
          seconds = (String(seconds).length >= 2) ? seconds : '0' + seconds;
      if(isfirst){
        container.find('.hours').text(hours);
        container.find('.minutes').text(minutes);
      }else{
        (minutes == '59' && seconds == '59') && container.find('.hours').text(hours);
        (seconds == '59') && container.find('.minutes').text(minutes);
      }
      container.find('.seconds').text(seconds);

      isfirst = false;
      difference -= 1000;
  };
  interval = setInterval(countdown, 1000);

  return {
      interval : interval ,
      clear : function() {
        clearInterval(interval);
      }
    };
}
