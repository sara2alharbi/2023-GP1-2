#include <ESP8266WiFi.h> /*esp laibraly*/
#include "Arduino.h"
#include "DHT.h"
#include "Mic.h"
#include <math.h>


String apiKey = "TOO9UCVFHLWKEVO9"; /*API key*/
const char *ssid =  "HUAWEI-523B"; /*wifi name*/
const char *pass =  "516DA29HQ64"; /*wifi password*/
const char* server = "api.thingspeak.com"; /*IoT server*/

// Pin Definitions
#define DHT_PIN_DATA	5
#define MIC_3V3_PIN_SIG	A0


WiFiClient client;
DHT dht(DHT_PIN_DATA);
Mic mic_3v3 (MIC_3V3_PIN_SIG);


void setup() {
  Serial.begin(9600);
  delay(10);
  dht.begin();
  WiFi.begin(ssid, pass);

  while (WiFi.status() != WL_CONNECTED) { /*while conectting print ..*/
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected"); /*connection succseful*/
}

void loop() {
     float dhtHumidity;
     float dhtTempC;
     int mic_3v3Val;
     int Gas1 = digitalRead(D0);
     

     
     dhtHumidity = dht.readHumidity();
     dhtTempC = dht.readTempC();
     mic_3v3Val = mic_3v3.read();
     float dB_sound = readingToDecibels(mic_3v3Val); //convert to decibels

    if (isnan(dhtHumidity) || isnan(dhtTempC)) {
    Serial.println("Failed to read from sensor!"); /*sensor not connect corectlly*/
    delay(500);
    return;
  } 
  else if ( isnan(mic_3v3Val) || isnan(Gas1)) {
    Serial.println("Failed to read from sensor gas or sound!"); /*sensor not connect corectlly*/
    delay(500);
    return;
  }     
if (client.connect(server, 80)) {  /*start sending data to the cloud and printing*/ 
    String postStr = apiKey;
    postStr += "&field1=";
    postStr += String(dhtTempC);
    postStr += "&field2=";
    postStr += String(dhtHumidity);
    postStr += "&field3=";
    postStr += String(dB_sound);
    postStr += "&field4=";
    postStr += String(Gas1);
    postStr += "\r\n\r\n";

    client.print("POST /update HTTP/1.1\n");
    client.print("Host: api.thingspeak.com\n");
    client.print("Connection: close\n");
    client.print("X-THINGSPEAKAPIKEY: " + apiKey + "\n");
    client.print("Content-Type: application/x-www-form-urlencoded\n");
    client.print("Content-Length: ");
    client.print(postStr.length());
    client.print("\n\n");
    client.print(postStr);

    Serial.print("Temperature: ");
    Serial.print(dhtTempC);
    Serial.print(" Cْ ");
    Serial.print("\t");
    Serial.print("Humidity: ");
    Serial.println(dhtHumidity);
    Serial.print("sound: ");
    Serial.print(dB_sound);
    Serial.println(" DB");
    Serial.print("Air Level: ");
    Serial.print(Gas1);
    if (Gas1 == 1){
      Serial.println(" No Gas detecting");
    }
    else {
      Serial.println(" Some of Butane, Propane, Methane, Alcohol or Smoke was detecting ");
    }

  }
 delay(500); //5 sec
 client.stop();
 Serial.println("Waiting 1 Min...");

 delay(60000); //60000 milisecond = 60 sec = 1 MIN interval time
}


float readingToDecibels(int reading) {    
    float maxValue = 1023;  // Maximum sensor reading
    float dB = -20 * log10(reading / maxValue);
    return dB;
}
