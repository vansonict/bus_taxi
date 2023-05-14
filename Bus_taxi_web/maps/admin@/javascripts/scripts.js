function truebody() {
    return (document.compatMode && document.compatMode != "BackCompat") ? document.documentElement : document.body
}

function crossObj(id) {//Trả về 1 đối tượng
    if (document.getElementById) {
        return document.getElementById(id);
    } else if (document.all) {
        return document.all[id];
    } else if (document.layers) {
        return document.layers[id];
    } else {
        return null;
    }
}
/*Hàm tải dữ liệu bằng ajax*/
function datosServidor() {
};
datosServidor.prototype.iniciar = function() {
    try {
        // Mozilla / Safari
        this._xh = new XMLHttpRequest();
    } catch (e) {
        // Explorer
        var _ieModelos = new Array(
		'MSXML2.XMLHTTP.5.0',
		'MSXML2.XMLHTTP.4.0',
		'MSXML2.XMLHTTP.3.0',
		'MSXML2.XMLHTTP',
		'Microsoft.XMLHTTP'
		);
        var success = false;
        for (var i = 0; i < _ieModelos.length && !success; i++) {
            try {
                this._xh = new ActiveXObject(_ieModelos[i]);
                success = true;
            } catch (e) {
            }
        }
        if (!success) {
            return false;
        }
        return true;
    }
}

datosServidor.prototype.ocupado = function() {
    estadoActual = this._xh.readyState;
    return (estadoActual && (estadoActual < 4));
}

datosServidor.prototype.procesa = function() {
    if (this._xh.readyState == 4 && this._xh.status == 200) {
        this.procesado = true;
    }
}

datosServidor.prototype.enviar = function(urlget, datos, id, mesageTxt, alertTxt) {
    if (!this._xh) {
        this.iniciar();
    }
    if (!this.ocupado()) {
        this._xh.open("GET", urlget, false);
        this._xh.send(datos);
        if (id != '') crossObj(id).innerHTML = mesageTxt;
        if (this._xh.readyState == 4 && this._xh.status == 200) {
            return this._xh.responseText;
            if (alertTxt != "") alert(alertTxt);
        }
    }
    return true;
}
var ajaxComponent = new datosServidor;
/*Kết thúc hàm tải dữ liệu bằng ajax*/

//Các hàm sử dụng cho quản trị hệ thống
function SystemManagerScript() {
};
SystemManagerScript.prototype.reSizeBox = function(divMain, divLeft, divRight, w, ifm)
{
    //alert(truebody().clientHeight);
    var h;
    h = truebody().clientHeight - 67 + 'px';
    crossObj(divMain).style.height = h;
    crossObj(divLeft).style.height = h;
    crossObj(divRight).style.height = h;
    crossObj(ifm).style.height = h; //parseInt(h) + 'px';
	
    crossObj(divLeft).style.width = w + 'px';
    crossObj(divRight).style.width = truebody().clientWidth - parseInt(crossObj(divLeft).style.width) - 5 + 'px';
    crossObj(ifm).style.width = parseInt(crossObj(divRight).style.width) + 'px';
}
SystemManagerScript.prototype.reSizeBox2 = function(ifm)
{
    var h;
    h = truebody().clientHeight - 147 + 'px';
    crossObj(ifm).style.height = h;
    crossObj(ifm).style.width = truebody().clientWidth - 224 - 5 + 'px';
}

var SMS = new SystemManagerScript;

var lastelement = null;
function changeFunction(id, path)
{
    document.getElementById("divToolBarButton").innerHTML = "";
    if (lastelement)
    {
        lastelement.style.backgroundColor = "";
        lastelement.style.color = "#222222";
    }
    var el = document.getElementById(id);
    el.style.backgroundColor = "#eeeafe";
    el.style.color = "#7974d9";
    lastelement = el;
    document.getElementById("frameRight").contentWindow.document.location.replace(path);
}
function setCookie(c_name,value,exdays)
{
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
	document.cookie = c_name + "=" + c_value;
}
function getCookie(c_name)
{
	var i, x, y, ARRcookies = document.cookie.split(";");
	for (i = 0; i < ARRcookies.length; i ++)
	{
		x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
		y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
		x = x.replace(/^\s+|\s+$/g, "");
		if (x == c_name)
		{
			return unescape(y);
		}
	}
}

var title = "Bạn không được sửa thông tin này vì hồ sơ của bạn đã được duyệt!"

function setReadonly(selectElementId){
	var selectElement = document.getElementById(selectElementId);//Lấy đối tượng select muốn ẩn
	if (selectElement){		
		var parent = selectElement.parentElement;//Lấy đối tượng cha của select muốn ẩn
		var textValue = selectElement.options[selectElement.options.selectedIndex].innerText;//Lấy giá trị text của select để gán cho input box được tạo bên dưới
		if (!parent){
			parent=selectElement.parentNode;
			textValue = selectElement.options[selectElement.options.selectedIndex].text;
		}
		//Tạo đối tượng input, gán giá trị là text của select box, gán thuộc tính readOnly cho nó
		var input = document.createElement("input");
		input.setAttribute("id", "new_id_" + selectElement.id);
		input.setAttribute("type","text");
		input.setAttribute("value",textValue);
		input.style.background="#cccccc";
		input.style.width = selectElement.style.width;
		input.setAttribute("title", title);
		input.readOnly = true;
		parent.appendChild(input);
	}
	selectElement.style.display="none";//Ẩn đối tượng select box đi
}

function setDisabled(id, dis)
{
	if (!document.getElementById || !document.getElementsByTagName) return;
	var nodesToDisable = {td :'', button :'', input :'', optgroup :'', option :'', select :'', textarea :''};//Danh sách các loại đối tượng muốn ẩn
	var node, nodes;
	var div = document.getElementById(id);//Lấy đối tượng chứa các đối tượng muốn ẩn
	if (!div) return;
	nodes = div.getElementsByTagName('*');//Lấy tất cả các đối tượng con của đối tượng được lấy ở trên
	if (!nodes) return;
	var j = nodes.length;
	for(i = 0; i < j; i ++)
	{//Lần lượt xét tất cả các đối tượng để tìm đối tượng muốn ẩn
		node = nodes[i];
		if ( node.nodeName && node.nodeName.toLowerCase() in nodesToDisable )
		{//Nếu đối tượng này nằm trong danh sách các đối tượng muốn ẩn
			//node.disabled = dis;
			if(node.nodeName.toLowerCase() == "select")
			{//Nếu là đối tượng select, thì gọi hàm
				setReadonly(node.id);
				j = j + 1;//Sau khi gọi hàm, nó sẽ sinh ra thêm một đối tượng là input box (do đó phải tăng j lên 1), đối tượng này sẽ có giá trị là giá trị của select box, sau đó ẩn select box đi
			}
			if(node.nodeName.toLowerCase() == "input")
			{//Đối với các đối tượng là thẻ input thì đặt thuộc tính readOnly là xong
				node.readOnly = true;
				node.className = "disabled";
				node.setAttribute("title", title);
			}
		}
		node.removeAttribute("onclick");//Bỏ sự kiện onclick của đối tượng
		node.removeAttribute("onkeyup");//Bỏ sự kiện keyup
		node.removeAttribute("onkeydown");//Bỏ sự kiện keydown
	}
}