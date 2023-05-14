package com.ptittaxi.client;

import android.app.Activity;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.ImageView;



public class WellcomeActivity extends Activity{
	Button button;
	ImageView image;
	
	@Override
	public void onCreate(Bundle savedInstranceState){
		super.onCreate(savedInstranceState);
		setContentView(R.layout.main);
		addListenerOnButton();
	}
	
	public void addListenerOnButton(){
		image = (ImageView) findViewById(R.id.icon);
			button = (Button) findViewById(R.id.nextButton);
		button.setOnClickListener(new OnClickListener(){
			public void onClick(View arg0) {
				//start service and go to wellcome_first View
			}
		});
	}
}