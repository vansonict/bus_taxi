var GoSetting = {
    callNativeFunction: function (success, fail, resultType) {
    	console.log("AAAAAAAAAAAAAAAa");
    	return cordova.exec(success, fail, "GoSetting", "nativeAction", [resultType]);
    }
};