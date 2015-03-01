<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<head>
<body>
Convert EPOCH
<br>
<input type="text" name="dttm" id="dttm" size="25">
<input type="button" id="toepoch-btn" value="To epoch">
<br>
<input type="text" name="epoch" id="epoch" size="25">
<input type="button" id="todttm-btn" value="To date/time">
<br>
<input type="button" id="curtm-btn" value="Current time">
<hr>
Diff time
<br>
Date/Time1
<input type="text" name="dttm1" id="dttm1" size="25">
Date/Time2
<input type="text" name="dttm2" id="dttm2" size="25">
<input type="button" id="diffdttm-btn" value="Diff date/time">
<br>
Epoch1
<input type="text" name="epoch1" id="epoch1" size="25">
Epoch2
<input type="text" name="epoch2" id="epoch2" size="25">
<input type="button" id="diffepoch-btn" value="Diff epoch">
<br>
<input type="button" id="curtm2-btn" value="Current time">
<br>
<span id="diffval"></span>
<hr>
<script>
$("#diffepoch-btn").on("click",function(){
	epoch1=$("#epoch1").val();
	epoch2=$("#epoch2").val();

	epochdiff=Math.abs(epoch1-epoch2);
	diff_hour=Math.floor(epochdiff/3600)+"h"+Math.floor((epochdiff%3600)/60)+"m"+(epochdiff%60)+"s";
	diff_day=Math.floor(epochdiff/86400)+"d"+Math.floor((epochdiff%86400)/3600)+"h"+Math.floor((epochdiff%3600)/60)+"m"+(epochdiff%60)+"s";
	epochdiff_str="Diff : "+epochdiff+" s / "+diff_hour+" / "+diff_day+" ("+getUTCDateString(epochdiff)+")";
	$("#diffval").html(epochdiff_str);
});

$("#diffdttm-btn").on("click",function(){
	epoch1=getEpochVal($("#dttm1").val());
	epoch2=getEpochVal($("#dttm2").val());

	epochdiff=Math.abs(epoch1-epoch2);
	diff_hour=Math.floor(epochdiff/3600)+"h"+Math.floor((epochdiff%3600)/60)+"m"+(epochdiff%60)+"s";
	diff_day=Math.floor(epochdiff/86400)+"d"+Math.floor((epochdiff%86400)/3600)+"h"+Math.floor((epochdiff%3600)/60)+"m"+(epochdiff%60)+"s";
	epochdiff_str="Diff : "+epochdiff+" s / "+diff_hour+" / "+diff_day+" ("+getUTCDateString(epochdiff)+")";
	$("#diffval").html(epochdiff_str);
});

$("#curtm2-btn").on("click",function(){
	epochval=getCurrentEpoch();
	dttm=getDateString(epochval);

	$("#dttm1").val(dttm);
	$("#dttm2").val(dttm);
	$("#epoch1").val(epochval);
	$("#epoch2").val(epochval);
});

$("#curtm-btn").on("click",function(){
	epochval=getCurrentEpoch();
	dttm=getDateString(epochval);

	$("#dttm").val(dttm);
	$("#epoch").val(epochval);
});

$("#todttm-btn").on("click",function(){
	epochval=$("#epoch").val();
	$("#dttm").val(getDateString(epochval))
});

$("#toepoch-btn").on("click",function(){
	dttmval=$("#dttm").val();
	$("#epoch").val(getEpochVal(dttmval));
});

function getEpochVal(dttmstr){
	epoch="";
	ptrn0 = /^(\d{4})[-\/](\d{2})[-\/](\d{2})\s(\d{2}):(\d{2}):(\d{2})$/;
	re = new RegExp(ptrn0);
	if(dttmstr.match(re)){
		tm=new Date();
		tm.setFullYear((RegExp.$1)-0);
		tm.setMonth((RegExp.$2)-1);
		tm.setDate((RegExp.$3)-0);
		tm.setHours((RegExp.$4)-0);
		tm.setMinutes((RegExp.$5)-0);
		tm.setSeconds((RegExp.$6)-0);
		tm.setMilliseconds(0);
		epoch=Math.round(tm.getTime()/1000);
	}
	ptrn1 = /^(\d{4})[-\/](\d{2})[-\/](\d{2})$/;
	re = new RegExp(ptrn1);
	if(dttmstr.match(re)){
		tm=new Date();
		tm.setFullYear((RegExp.$1)-0);
		tm.setMonth((RegExp.$2)-1);
		tm.setDate((RegExp.$3)-0);
		tm.setHours(0);
		tm.setMinutes(0);
		tm.setSeconds(0);
		tm.setMilliseconds(0);
		epoch=Math.round(tm.getTime()/1000);
	}
	ptrn2 = /^(\d{2}):(\d{2}):(\d{2})$/;
	re = new RegExp(ptrn2);
	if(dttmstr.match(re)){
		tm=new Date();
		tm.setFullYear(1970);
		tm.setMonth(0);
		tm.setDate(1);
		tm.setHours((RegExp.$1)-0);
		tm.setMinutes((RegExp.$2)-0);
		tm.setSeconds((RegExp.$3)-0);
		tm.setMilliseconds(0);
		epoch=Math.round(tm.getTime()/1000);
	}

	return epoch;
}

function getDateString(epochval){
	dttm="";
	maxepoch=253402268399;		//9999-12-31 23:59:59
	if(epochval>=0 && epochval<=maxepoch){
		tm.setTime(epochval*1000);

		yy=tm.getFullYear();
		mm=tm.getMonth()+1;
		dd=tm.getDate();
		h=tm.getHours();
		m=tm.getMinutes();
		s=tm.getSeconds();

		if (mm < 10) { mm = "0" + mm; }
		if (dd < 10) { dd = "0" + dd; }
		if (h < 10) { h = "0" + h; }
		if (m < 10) { m = "0" + m; }
		if (s < 10) { s = "0" + s; }
		dttm=yy+"-"+mm+"-"+dd+" "+h+":"+m+":"+s;
	}

	return dttm;
}

function getUTCDateString(epochval){
	dttm="";
	maxepoch=253402268399;		//9999-12-31 23:59:59
	if(epochval>=0 && epochval<=maxepoch){
		tm.setTime(epochval*1000);

		yy=tm.getUTCFullYear()-1970;
		mm=tm.getUTCMonth();
		dd=tm.getUTCDate()-1;
		h=tm.getUTCHours();
		m=tm.getUTCMinutes();
		s=tm.getUTCSeconds();

		dttm=yy+"-"+mm+"-"+dd+" "+h+":"+m+":"+s;
	}

	return dttm;
}

function getCurrentEpoch(){
	tm=new Date();
	epochval=Math.floor(tm.getTime()/1000);
	return epochval;
}

</script>
</body>
</html>