package com.ptittaxi.client;

import android.os.Bundle;
import org.apache.cordova.*;

public class Main extends DroidGap {
	
	@Override 
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		super.loadUrl("file:///android_asset/www/index.html",9000);
		
	}
	
}

