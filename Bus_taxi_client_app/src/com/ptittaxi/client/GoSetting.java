package com.ptittaxi.client;

import org.apache.cordova.api.Plugin;
import org.apache.cordova.api.PluginResult;
import org.json.JSONArray;

import android.content.Context;
import android.content.Intent;
import android.telephony.SmsManager;
import android.telephony.TelephonyManager;
import android.telephony.gsm.GsmCellLocation;
import android.util.Log;

public class GoSetting extends Plugin {

	public static final String NATIVE_ACTION_STRING = "nativeAction";
	public static final String NATIVE_ACTION_SEND_SMS = "nativeActionSendSMS";
	public static final String NATIVE_ACTION_GET_LOCATION = "nativeActionGetLocation";
	public static final String SETTING_PARAMETER = "setting";
	public static final String IMSI_PARAMETER = "imsi";
	public static final String LOCATION_SETTING = "locationSetting";
	public static final String SEND_SMS = "sendSMS";
	//public static final String PHONE_NUMBER = "84973328004";

	@Override
	public PluginResult execute(String action, JSONArray data, String callbackId) {
		Log.d("HelloPlugin",
				"Hello, this is a native function called from PhoneGap/Cordova!");
		// only perform the action if it is the one that should be invoked
		if (NATIVE_ACTION_STRING.equals(action)) {
			String resultType = null;
			try {
				resultType = data.getString(0);
			} catch (Exception ex) {
				Log.d("HelloPlugin", ex.toString());
			}
			if (resultType.equals(SETTING_PARAMETER)) {
				Intent intent = new Intent(
						android.provider.Settings.ACTION_WIRELESS_SETTINGS);
				cordova.getActivity().startActivity(intent);
				return new PluginResult(PluginResult.Status.OK,
						"Yay, Success!!!");
			} else if (resultType.equals(IMSI_PARAMETER)) {
				Log.e("a", "a");
				TelephonyManager tm = (TelephonyManager) cordova.getActivity()
						.getSystemService(Context.TELEPHONY_SERVICE);
				Log.e("Pn: ", tm.getSimSerialNumber());
				return new PluginResult(PluginResult.Status.OK,tm.getSimSerialNumber());
				// Log.e("Pn: ", tm.getLine1Number());
				// return new PluginResult(PluginResult.Status.OK,tm.getLine1Number());
			} else if (resultType.equals(LOCATION_SETTING)) {
				Intent intent = new Intent(
						android.provider.Settings.ACTION_SECURITY_SETTINGS);
				cordova.getActivity().startActivity(intent);
				return new PluginResult(PluginResult.Status.OK,
						"Yay, Success!!!");
			} else if (resultType.equals(NATIVE_ACTION_GET_LOCATION)) {
				Log.e("getLocation", "0k");
				TelephonyManager tm = (TelephonyManager) cordova.getActivity()
						.getSystemService(Context.TELEPHONY_SERVICE);
				int cid = 0;
				int lac = 0;
				try {
					GsmCellLocation location = (GsmCellLocation) tm
							.getCellLocation();
					if (location != null) {
						Log.e("log", "get location by cell id");
						Log.e("log", "cell id: " + location.getCid() + ", lac: "
								+ location.getLac());
						cid = location.getCid();
						lac = location.getLac();
						// sendCellIdLocation(location.getCid(), location.getLac());
					} else {
						Log.e("log",
								"failed to get location cell id, location = null");
						throw new Exception("location = null");
					}
				} catch (Exception ex) {
					Log.e("log", "exception:" + ex.getMessage());
					Log.e("log", "try to get last known location");
				}
				
				return new PluginResult(PluginResult.Status.OK,cid+";"+lac);
			}

			else {
				return new PluginResult(PluginResult.Status.ERROR,
						"Oops, Error :(");
			}

		}
		if (NATIVE_ACTION_SEND_SMS.equals(action)) {
			int cid = 10;
			int lac = 10;
			String resultType = null;
			String textSms = null;
			try {
				resultType = data.getString(0);
			} catch (Exception ex) {
				Log.d("HelloPlugin", ex.toString());
			}
			TelephonyManager tm = (TelephonyManager) cordova.getActivity()
					.getSystemService(Context.TELEPHONY_SERVICE);
			try {
				GsmCellLocation location = (GsmCellLocation) tm
						.getCellLocation();
				if (location != null) {
					Log.e("log", "get location by cell id");
					Log.e("log", "cell id: " + location.getCid() + ", lac: "
							+ location.getLac());
					cid = location.getCid();
					lac = location.getLac();
					// sendCellIdLocation(location.getCid(), location.getLac());
				} else {
					Log.e("log",
							"failed to get location cell id, location = null");
					throw new Exception("location = null");
				}
			} catch (Exception ex) {
				Log.e("log", "exception:" + ex.getMessage());
				Log.e("log", "try to get last known location");
			}
			Log.e("sms", resultType);
			String[] str;
			String[] str2;
			str = resultType.split("/;");
			str2 = str[1].split(";");
			Log.e("status", str2[3]);

			if (str2[3].equals("0")) {
				textSms = str[1];
			} else {
				textSms = str[1] + ";" + String.valueOf(cid) + ";"
						+ String.valueOf(lac);

			}
			Log.e("text Sms: ", textSms);
			SmsManager sms = SmsManager.getDefault();
			sms.sendTextMessage(str[0], null, textSms, null, null);
			return new PluginResult(PluginResult.Status.OK);
		}
		return null;
	}
	// loaitaxiId;hangtaxiId;sodienthoai;flag;[lat||cellid];[lon||lac]
	// TelephonyManager tm = (TelephonyManager)
	// getSystemService(Context.TELEPHONY_SERVICE);
	// try {
	// GsmCellLocation location = (GsmCellLocation) tm.getCellLocation();
	// if (location != null) {
	// log("get location by cell id");
	// log("cell id: " + location.getCid() + ", lac: " + location.getLac());
	// sendCellIdLocation(location.getCid(), location.getLac());
	// } else {
	// log("failed to get location cell id, location = null");
	// throw new Exception("location = null");
	// }
	// } catch (Exception ex) {
	// log("exception:" + ex.getMessage());
	// log("try to get last known location");
	// }

	/*
	 * public PluginResult execute(String action, JSONArray args, String
	 * callbackId) { try { if (action.equals("echo")) { String echo =
	 * args.getString(0); if (echo != null && echo.length() > 0) { Intent
	 * intent=new Intent(android.provider.Settings.ACTION_WIRELESS_SETTINGS);
	 * cordova.getActivity().startActivity(intent); return new
	 * PluginResult(PluginResult.Status.ERROR); } else { return new
	 * PluginResult(PluginResult.Status.ERROR); } } else { return new
	 * PluginResult(PluginResult.Status.INVALID_ACTION); } } catch
	 * (JSONException e) { return new
	 * PluginResult(PluginResult.Status.JSON_EXCEPTION); } }
	 */
}
