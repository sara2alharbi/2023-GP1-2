#include <ESP8266WiFi.h> /*esp laibraly*/
#include "Arduino.h"
#include "DHT.h"
#include "Mic.h"


String apiKey = "I3P3H6JGDN7IEMLK"; /*API key*/
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
     float Gas1 = digitalRead(D0);

     //float Gas = ((Gas1/1023)*100);
     dhtHumidity = dht.readHumidity();
     dhtTempC = dht.readTempC();
     mic_3v3Val = mic_3v3.read();

    if (isnan(dhtHumidity) || isnan(dhtTempC) || isnan(mic_3v3Val) || isnan(Gas1)) {
    Serial.println("Failed to read from sensor!"); /*sensor not connect corectlly*/
    return;
  }   
if (client.connect(server, 80)) {  /*start sending data and printing*/ 
    String postStr = apiKey;
    postStr += "&field1=";
    postStr += String(dhtTempC);
    postStr += "&field2=";
    postStr += String(dhtHumidity);
    postStr += "&field3=";
    postStr += String(mic_3v3Val);
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
    Serial.print("\t");
    Serial.print("Humidity: ");
    Serial.println(dhtHumidity);
    Serial.print("sound: ");
    Serial.println(mic_3v3Val);
    Serial.print("Air Level: ");
    Serial.println(Gas1);

  }
 delay(500);
 client.stop();
 Serial.println("Waiting...");

 delay(1500);
}
