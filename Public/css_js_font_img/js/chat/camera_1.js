var Camera=function(para)
{
	this.id=para.id;
	this.W=para.w;//视频宽度
	this.myPublisher='';//直播对象
	this.publish_url=para.publish_url;//直播对象
	this.path=para.path?para.path:'/';//直播对象
	this.autoplay=para.autoplay?para.autoplay:false//是否自动播放
}
Camera.prototype.show=function(show_type)
{
	 if(show_type)
	 {
		 this.create_live();
	 }
	 else
	 {
		 this.video_show();
	 }
}
Camera.prototype.create_live=function()
{
	        this.myPublisher = new nePublisher(this.id, {
                //viewOptions
                videoWidth: 960,
                videoHeight: 540,
                fps: 20,
                bitrate: 1500
            }, {
                //flashOptions
                previewWindowWidth: this.W,
                previewWindowHeight: this.H,
                wmode: 'transparent',
                quality: 'high',
                allowScriptAccess: 'always'
            }, function() {
                cameraList = this.getCameraList();
                microPhoneList = this.getMicroPhoneList();
				console.log(cameraList.length, microPhoneList);
                console.log(cameraList, microPhoneList);
				var cameraOptions="";
				var microPhoneOptions ="";
                for (var i = cameraList.length - 1; i >= 0; i--) {
                    cameraOptions = '<option value="' + i + '">摄像头（' + cameraList[i] + ')</option>' + cameraOptions;
                }
                for (var i = microPhoneList.length - 1; i >= 0; i--) {
                    microPhoneOptions = '<option value="' + i + '">' + microPhoneList[i] + '</option>' + microPhoneOptions;
                }
                document.getElementById('cameraSelect').innerHTML = cameraOptions;
                document.getElementById('microPhoneSelect').innerHTML = microPhoneOptions;
            }, function(code, desc) {
				alert(code+":"+desc);
            });
}

Camera.prototype.getCameraIndex=function()
{
	var cameraSelect =document.getElementById('cameraSelect');
    var cameraIndex = cameraSelect.selectedIndex;
    return cameraSelect.options[cameraIndex].value;
}

Camera.prototype.getMicroPhoneIndex=function()
{
	var microPhoneSelect =document.getElementById('microPhoneSelect');
	var microPhoneIndex = microPhoneSelect.selectedIndex;
	return microPhoneSelect.options[microPhoneIndex].value;
}

Camera.prototype.getQualityOption = function() {
	var qualitySelect =document.getElementById('qualitySelect');
	var qualityIndex = qualitySelect.selectedIndex;
	var qualityList = [
            {
                //流畅
                fps: 20,
                bitrate: 600,
                videoWidth:960,
                videoHeight:540
            },
            {
                //标清
                fps: 20,
                bitrate: 800,
                videoWidth:960,
                videoHeight:540
            },
            {
                //高清
                fps: 20,
                bitrate: 1500,
                videoWidth:960,
                videoHeight:540
            }
        ];
	return qualityList[qualityIndex];
};

Camera.prototype.Preview = function() {
	this.myPublisher.startPreview(this.getCameraIndex());
	
};

Camera.prototype.stopPublish = function() {
		this.myPublisher.stopPublish();
		//stopPublishCall();
};

Camera.prototype.startPublish = function() {
		var publishUrl =this.publish_url;
		this.myPublisher.setCamera(this.getCameraIndex());
		this.myPublisher.setMicroPhone(this.getMicroPhoneIndex());
		this.myPublisher.startPublish(publishUrl,this.getQualityOption(),function(code, desc) {
			console.log(code, desc);
			alert(code + '：' + desc);
		});
		this.Ticker(10000)
};

Camera.prototype.video_show = function(publish_url,open_camera,open_microphone) {
	 var my_options={
                        "controls":true,//是否显示控制条
						"autoplay": this.autoplay,//是否自动播放(ios不支持自动播放)
						/*预加载选项*/
						"preload": "auto",
						/*
						'auto'预加载视频（需要浏览器允许）;
						'metadata'仅预加载视频meta信息;
						'none'不预加载;
						*/
					
						"poster": "myPoster.jpg", //视频播放前显示的图片
						"loop": true, //是否循环播放
						"width": this.W,//设置播放器宽度
						"height": this.H,//设置播放器高度
					
						/*设置播放器控件*/
						controlBar: { 
							playToggle: true
						},
						TextTrackDisplay:true,
				}
      myPlayer = neplayer(this.id,my_options);
};

Camera.prototype.Ticker = function(interval) {
   interval=interval?interval:10000;
   this_str=this;
   setInterval_k=window.setInterval(function(){this_str.up_room_live()},interval);   
   return setInterval_k;
};

Camera.prototype.up_room_live = function() {
	  $.getJSON(this.path+"Index.php/Chat/UserAjax/update_room_time.php",function(result){});	   
};


Camera.prototype.stopPublish = function() {
	  this.myPublisher.stopPublish();
};


