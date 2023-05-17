/*Temperature and Humidity monitoring system with Thingspeak
 */
 
#include <ESP8266WiFi.h> /*esp laibraly*/
#include "DHT.h" /*dht11 sensor*/

String apiKey = "I9F3CYB6H5WJA8WT"; /*API key*/
const char *ssid =  "S"; /*wifi name*/
const char *pass =  "S1234566"; /*wifi password*/
const char* server = "api.thingspeak.com"; /*IoT server*/

DHT dht(D2, DHT11);

WiFiClient client;

void setup() { /*start wifi connection*/
  Serial.begin(115200);
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
  float h = dht.readHumidity(); /*reading data from sensor*/
  float t = dht.readTemperature()*1.8+32;

  if (isnan(h) || isnan(t)) {
    Serial.println("Failed to read from DHT sensor!"); /*sensor not connect corectlly*/
    return;
  }

  if (client.connect(server, 80)) {  /*start sending data and printing*/ 
    String postStr = apiKey;
    postStr += "&field1=";
    postStr += String(t);
    postStr += "&field2=";
    postStr += String(h);
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
    Serial.print(t);
    Serial.print("\t");
    Serial.print("Humidity: ");
    Serial.println(h);

  }
  client.stop();
  delay(500);
}
