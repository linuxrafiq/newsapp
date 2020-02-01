package com.mobile.testapplication;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.AppCompatButton;

import org.w3c.dom.Text;

public class MainActivity extends AppCompatActivity {
     TextView objMyText;
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

         objMyText = (TextView) findViewById(R.id.tvTextView);
        final EditText etUserName = (EditText) findViewById(R.id.etUserName);
        AppCompatButton objMyButton = (AppCompatButton) findViewById(R.id.btnClick);

        objMyButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Log.e(this.getClass().getName(), "objMyButton clicked");
                String userName = etUserName.getText().toString().trim()+"";

                if (userName.length() == 0){

                    Log.e(this.getClass().getName(), "please write user name");
                    return;

                }
                submitForm(userName);
            }
        });

        Log.e(this.getPackageName().getClass().getName(), "onCreate");

        // 1000 lins of my codes and works
        //
    }

    private void submitForm(String name){
        //call to server and send all data;
        //send name;

        // return back from server with message either registered successfully or failed;

        String serverResponce = " you are registerd successfully / failed";
        objMyText.setText(serverResponce);

    }

    @Override
    protected void onStart() {
        super.onStart();
        Log.e(this.getPackageName().getClass().getName(), "onStart");
    }

    @Override
    protected void onResume() {
        super.onResume();
        Log.e(this.getPackageName().getClass().getName(), "onResume");
    }

    @Override
    protected void onPause() {
        super.onPause();
        Log.e(this.getPackageName().getClass().getName(), "onPause");
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        Log.e(this.getPackageName().getClass().getName(), "onDestroy");
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        Log.e(this.getPackageName().getClass().getName(), "onActivityResult");
    }
}
